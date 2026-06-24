<?php

namespace App\Http\Controllers;

use App\Models\DocumentationFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class DocumentationFileController extends Controller
{
    public function index(): View
    {
        $files = DocumentationFile::query()
            ->whereNotNull('file_path')
            ->where('file_path', '!=', '')
            ->latest()
            ->get();

        return view('documentation_files', compact('files'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'max:100'],
                'attachment' => ['required', 'file', 'mimes:pdf,docx,png,jpg,jpeg,webp', 'max:5120'],
            ],
            [
                'title.required' => 'Nama dokumen atau gambar wajib diisi.',
                'title.max' => 'Nama dokumen atau gambar maksimal 100 karakter.',
                'attachment.required' => 'Silakan pilih file yang akan diunggah.',
                'attachment.mimes' => 'Format file harus PDF, DOCX, PNG, JPG, JPEG, atau WEBP.',
                'attachment.max' => 'Ukuran file maksimal 5 MB.',
            ]
        );

        $file = $request->file('attachment');
        $extension = strtolower($file->getClientOriginalExtension());
        $folder = in_array($extension, ['pdf', 'docx'], true) ? 'documents' : 'images';
        $path = $file->store($folder, 'public');

        try {
            DocumentationFile::create([
                'title' => $validated['title'],
                'file_path' => $path,
                'file_type' => $extension,
            ]);
        } catch (Throwable $exception) {
            Storage::disk('public')->delete($path);
            throw $exception;
        }

        return redirect()
            ->route('documentations.index')
            ->with('success', 'File berhasil diunggah dan ditampilkan pada galeri.');
    }

    public function destroy(DocumentationFile $documentation): RedirectResponse
    {
        if ($documentation->file_path) {
            Storage::disk('public')->delete($documentation->file_path);
        }

        $documentation->delete();

        return redirect()
            ->route('documentations.index')
            ->with('success', 'File berhasil dihapus.');
    }
}
