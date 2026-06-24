<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CampaignController extends Controller
{
    // READ: menampilkan semua campaign beserta relasi kategori, rekening, dan donasi.
    public function index(): View
    {
        $campaigns = Campaign::with(['categories', 'account', 'donations'])
            ->latest()
            ->get();

        return view('campaign.index', compact('campaigns'));
    }

    // CREATE: menampilkan form tambah campaign.
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('campaign.create', compact('categories'));
    }

    // STORE: menyimpan campaign, gambar, rekening campaign, dan kategori campaign.
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
                'target_donation' => ['required', 'numeric', 'min:0'],
                'collected_donation' => ['nullable', 'numeric', 'min:0'],
                'deadline' => ['required', 'date'],
                'bank_name' => ['required', 'string', 'max:100'],
                'account_number' => ['required', 'string', 'max:50'],
                'account_holder' => ['required', 'string', 'max:100'],
                'categories' => ['nullable', 'array'],
                'categories.*' => ['exists:categories,id'],
            ],
            [
                'image.required' => 'Gambar campaign wajib dipilih.',
                'image.image' => 'File campaign harus berupa gambar.',
                'image.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
                'image.max' => 'Ukuran gambar maksimal 5 MB.',
            ]
        );

        $imagePath = $request->file('image')->store('campaigns', 'public');

        $campaign = Campaign::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'target_donation' => $validated['target_donation'],
            'collected_donation' => $validated['collected_donation'] ?? 0,
            'deadline' => $validated['deadline'],
        ]);

        // Simpan relasi One-to-One: rekening penerimaan campaign.
        $campaign->account()->create([
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'account_holder' => $validated['account_holder'],
        ]);

        // Simpan relasi Many-to-Many: kategori campaign.
        $campaign->categories()->attach($validated['categories'] ?? []);

        return redirect('/campaign')->with('success', 'Data campaign dan gambar berhasil ditambahkan.');
    }

    // EDIT: menampilkan form edit campaign.
    public function edit(Campaign $campaign): View
    {
        $campaign->load(['categories', 'account']);
        $categories = Category::orderBy('name')->get();

        return view('campaign.edit', compact('campaign', 'categories'));
    }

    // UPDATE: memperbarui campaign, gambar, rekening, dan kategori.
    public function update(Request $request, Campaign $campaign): RedirectResponse
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
                'target_donation' => ['required', 'numeric', 'min:0'],
                'collected_donation' => ['nullable', 'numeric', 'min:0'],
                'deadline' => ['required', 'date'],
                'bank_name' => ['required', 'string', 'max:100'],
                'account_number' => ['required', 'string', 'max:50'],
                'account_holder' => ['required', 'string', 'max:100'],
                'categories' => ['nullable', 'array'],
                'categories.*' => ['exists:categories,id'],
            ],
            [
                'image.image' => 'File campaign harus berupa gambar.',
                'image.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
                'image.max' => 'Ukuran gambar maksimal 5 MB.',
            ]
        );

        $imagePath = $campaign->image;

        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('campaigns', 'public');

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $newImagePath;
        }

        $campaign->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'target_donation' => $validated['target_donation'],
            'collected_donation' => $validated['collected_donation'] ?? 0,
            'deadline' => $validated['deadline'],
        ]);

        $campaign->account()->updateOrCreate(
            ['campaign_id' => $campaign->id],
            [
                'bank_name' => $validated['bank_name'],
                'account_number' => $validated['account_number'],
                'account_holder' => $validated['account_holder'],
            ]
        );

        $campaign->categories()->sync($validated['categories'] ?? []);

        return redirect('/campaign')->with('success', 'Data campaign dan gambar berhasil diperbarui.');
    }

    // DELETE: menghapus gambar campaign dan data beserta relasi yang cascade di database.
    public function destroy(Campaign $campaign): RedirectResponse
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect('/campaign')->with('success', 'Data campaign berhasil dihapus.');
    }

    // VIEW DONATION: menampilkan form donasi untuk campaign terpilih.
    public function donation(Campaign $campaign): View
    {
        $campaign->load(['categories', 'account', 'donations']);

        return view('campaign.donation', compact('campaign'));
    }

    // STORE DONATION: menyimpan data donatur dan menambah total dana terkumpul.
    public function storeDonation(Request $request, Campaign $campaign): RedirectResponse
    {
        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $campaign->donations()->create($validated);
        $campaign->increment('collected_donation', $validated['amount']);

        return redirect()
            ->route('campaign.donation', $campaign)
            ->with('success', 'Terima kasih, data donasi berhasil disimpan.');
    }
}
