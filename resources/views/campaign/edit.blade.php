@extends('app')

@section('title', 'Edit Campaign')

@section('content')
<style>
.page-hero{background:linear-gradient(135deg,#f0fdf4 0%,#dcfce7 100%);padding:58px 24px;text-align:center}.page-hero h1{font-size:2rem;font-weight:800;color:#16a34a;margin-bottom:8px}.page-hero p{color:#6b7280}.form-section{max-width:850px;margin:0 auto;padding:44px 24px}.form-card{background:#fff;border:1px solid #d1fae5;border-radius:16px;padding:30px;box-shadow:0 2px 12px rgba(22,163,74,.08)}.form-title{font-size:.78rem;font-weight:800;color:#16a34a;text-transform:uppercase;letter-spacing:.08em;margin:0 0 16px}.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}.form-group{margin-bottom:18px}.form-group.full{grid-column:1/-1}.form-label{display:block;font-size:.875rem;font-weight:700;color:#374151;margin-bottom:7px}.form-input{width:100%;border:1.5px solid #d1fae5;border-radius:10px;padding:11px 14px;font-family:inherit;font-size:.9rem;color:#1f2937;background:#f9fafb;outline:none}.form-input:focus{border-color:#16a34a;box-shadow:0 0 0 3px rgba(22,163,74,.1);background:#fff}textarea.form-input{resize:vertical}.section-box{background:#f8fffb;border:1px solid #d1fae5;border-radius:14px;padding:20px;margin-bottom:22px}.category-wrap{display:flex;gap:10px;flex-wrap:wrap}.category-item{display:inline-flex;align-items:center;gap:8px;border:1px solid #bbf7d0;background:#fff;color:#15803d;border-radius:999px;padding:9px 13px;font-size:.84rem;font-weight:700}.help-text{font-size:.78rem;color:#6b7280;margin-top:10px}.error-box{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:.86rem}.form-actions{display:flex;gap:12px;flex-wrap:wrap}.btn-submit{background:#16a34a;color:#fff;padding:12px 26px;border-radius:10px;font-weight:800;border:0;cursor:pointer;font-family:inherit}.btn-submit:hover{background:#15803d}.btn-cancel{background:#f0fdf4;color:#15803d;padding:12px 26px;border-radius:10px;font-weight:800;border:1.5px solid #bbf7d0}@media(max-width:700px){.form-grid{grid-template-columns:1fr}.form-card{padding:22px}}
</style>

@php
    $selectedCategories = old('categories', $campaign->categories->pluck('id')->toArray());
@endphp

<div class="page-hero">
    <h1>Edit Campaign Donasi</h1>
    <p>Perbarui data campaign, rekening penerimaan, dan kategori.</p>
</div>

<div class="form-section">
    @if ($errors->any())
        <div class="error-box">
            <strong>Data belum lengkap:</strong>
            <ul style="margin-left:18px;margin-top:6px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campaign.update', $campaign) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="section-box">
            <h2 class="form-title">Informasi Campaign</h2>
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label">Judul Campaign</label>
                    <input type="text" name="title" value="{{ old('title', $campaign->title) }}" required class="form-input">
                </div>
                <div class="form-group full">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" required class="form-input">{{ old('description', $campaign->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Target Donasi (Rp)</label>
                    <input type="number" name="target_donation" value="{{ old('target_donation', $campaign->target_donation) }}" required min="0" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Dana Terkumpul (Rp)</label>
                    <input type="number" name="collected_donation" value="{{ old('collected_donation', $campaign->collected_donation) }}" min="0" class="form-input">
                </div>
                <div class="form-group full">
                    <label class="form-label">Batas Waktu</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $campaign->deadline) }}" required class="form-input">
                </div>
            </div>
        </div>

        <div class="section-box">
            <h2 class="form-title">Info Rekening Pencairan / Penerimaan</h2>
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $campaign->account->bank_name ?? '') }}" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" name="account_number" value="{{ old('account_number', $campaign->account->account_number ?? '') }}" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Pemilik Rekening</label>
                    <input type="text" name="account_holder" value="{{ old('account_holder', $campaign->account->account_holder ?? '') }}" required class="form-input">
                </div>
            </div>
        </div>

        <div class="section-box">
            <h2 class="form-title">Pilih Kategori</h2>
            @if($categories->isEmpty())
                <p class="help-text">Kategori belum tersedia. Jalankan <b>php artisan db:seed</b> agar kategori contoh muncul.</p>
            @else
                <div class="category-wrap">
                    @foreach($categories as $category)
                        <label class="category-item">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" @checked(in_array($category->id, $selectedCategories))>
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="help-text">Anda bisa memilih lebih dari satu kategori.</p>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
            <a href="{{ route('campaign.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection
