@extends('app')

@section('title', 'Tambah Campaign')

@section('content')
<style>
.page-hero{background:linear-gradient(135deg,#f0fdf4 0%,#dcfce7 100%);padding:58px 24px;text-align:center}.page-hero h1{font-size:2rem;font-weight:800;color:#16a34a;margin-bottom:8px}.page-hero p{color:#6b7280}.form-section{max-width:900px;margin:0 auto;padding:44px 24px}.form-card{background:#fff;border:1px solid #d1fae5;border-radius:18px;padding:30px;box-shadow:0 8px 30px rgba(22,163,74,.08)}.form-title{font-size:.78rem;font-weight:800;color:#16a34a;text-transform:uppercase;letter-spacing:.08em;margin:0 0 16px}.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}.form-group{margin-bottom:18px}.form-group.full{grid-column:1/-1}.form-label{display:block;font-size:.875rem;font-weight:700;color:#374151;margin-bottom:7px}.form-input{width:100%;border:1.5px solid #d1fae5;border-radius:10px;padding:11px 14px;font-family:inherit;font-size:.9rem;color:#1f2937;background:#f9fafb;outline:none}.form-input:focus{border-color:#16a34a;box-shadow:0 0 0 3px rgba(22,163,74,.1);background:#fff}textarea.form-input{resize:vertical}.section-box{background:#f8fffb;border:1px solid #d1fae5;border-radius:14px;padding:20px;margin-bottom:22px}.category-wrap{display:flex;gap:10px;flex-wrap:wrap}.category-item{display:inline-flex;align-items:center;gap:8px;border:1px solid #bbf7d0;background:#fff;color:#15803d;border-radius:999px;padding:9px 13px;font-size:.84rem;font-weight:700}.help-text{font-size:.78rem;color:#6b7280;margin-top:10px;line-height:1.5}.error-box{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:.86rem}.form-actions{display:flex;gap:12px;flex-wrap:wrap}.btn-submit{background:#16a34a;color:#fff;padding:12px 26px;border-radius:10px;font-weight:800;border:0;cursor:pointer;font-family:inherit}.btn-submit:hover{background:#15803d}.btn-cancel{background:#f0fdf4;color:#15803d;padding:12px 26px;border-radius:10px;font-weight:800;border:1.5px solid #bbf7d0}.upload-box{position:relative;border:2px dashed #86efac;border-radius:16px;background:#fff;padding:26px;text-align:center;cursor:pointer;transition:.2s}.upload-box:hover,.upload-box.dragover{border-color:#16a34a;background:#f0fdf4}.upload-box input{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer}.upload-icon{width:58px;height:58px;border-radius:16px;background:#dcfce7;color:#15803d;margin:0 auto 12px;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:800;letter-spacing:.08em}.upload-title{font-weight:800;color:#1f2937;margin-bottom:5px}.upload-sub{font-size:.8rem;color:#6b7280}.preview-wrap{display:none;margin-top:16px;border:1px solid #d1fae5;border-radius:14px;overflow:hidden;background:#fff}.preview-wrap.show{display:grid;grid-template-columns:180px 1fr}.preview-wrap img{width:180px;height:130px;object-fit:cover}.preview-info{padding:18px;display:flex;flex-direction:column;justify-content:center;min-width:0}.preview-info strong{font-size:.9rem;color:#1f2937;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.preview-info span{font-size:.78rem;color:#6b7280;margin-top:5px}@media(max-width:700px){.form-grid{grid-template-columns:1fr}.form-card{padding:20px}.preview-wrap.show{grid-template-columns:1fr}.preview-wrap img{width:100%;height:190px}}
</style>

<div class="page-hero">
    <h1>Tambah Campaign Donasi</h1>
    <p>Lengkapi data campaign dan unggah gambar utama agar program lebih menarik.</p>
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

    <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf

        <div class="section-box">
            <h2 class="form-title">Informasi Campaign</h2>
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label" for="title">Judul Campaign</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required class="form-input" placeholder="Contoh: Bantu Korban Banjir">
                </div>
                <div class="form-group full">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" required class="form-input" placeholder="Deskripsi lengkap campaign...">{{ old('description') }}</textarea>
                </div>
                <div class="form-group full">
                    <label class="form-label" for="campaign-image">Gambar Utama Campaign</label>
                    <div class="upload-box" id="campaign-dropzone">
                        <input id="campaign-image" type="file" name="image" accept="image/png,image/jpeg,image/webp" required>
                        <div class="upload-icon">IMG</div>
                        <div class="upload-title">Klik atau tarik gambar ke area ini</div>
                        <div class="upload-sub">Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.</div>
                    </div>
                    <div class="preview-wrap" id="campaign-preview-wrap">
                        <img id="campaign-preview" alt="Preview gambar campaign">
                        <div class="preview-info">
                            <strong id="campaign-file-name">Nama file</strong>
                            <span id="campaign-file-size">Ukuran file</span>
                        </div>
                    </div>
                    <p class="help-text">Gambar disimpan ke <b>storage/app/public/campaigns</b> dan akan tampil pada daftar campaign.</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="target_donation">Target Donasi (Rp)</label>
                    <input id="target_donation" type="number" name="target_donation" value="{{ old('target_donation') }}" required min="0" class="form-input" placeholder="10000000">
                </div>
                <div class="form-group">
                    <label class="form-label" for="collected_donation">Dana Terkumpul (Rp)</label>
                    <input id="collected_donation" type="number" name="collected_donation" value="{{ old('collected_donation', 0) }}" min="0" class="form-input" placeholder="0">
                </div>
                <div class="form-group full">
                    <label class="form-label" for="deadline">Batas Waktu</label>
                    <input id="deadline" type="date" name="deadline" value="{{ old('deadline') }}" required class="form-input">
                </div>
            </div>
        </div>

        <div class="section-box">
            <h2 class="form-title">Info Rekening Pencairan / Penerimaan</h2>
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label" for="bank_name">Nama Bank</label>
                    <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}" required class="form-input" placeholder="Contoh: BRI, BSI, BCA">
                </div>
                <div class="form-group">
                    <label class="form-label" for="account_number">Nomor Rekening</label>
                    <input id="account_number" type="text" name="account_number" value="{{ old('account_number') }}" required class="form-input" placeholder="Nomor rekening">
                </div>
                <div class="form-group">
                    <label class="form-label" for="account_holder">Nama Pemilik Rekening</label>
                    <input id="account_holder" type="text" name="account_holder" value="{{ old('account_holder') }}" required class="form-input" placeholder="Nama pemilik rekening">
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
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" @checked(in_array($category->id, old('categories', [])))>
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="help-text">Anda bisa memilih lebih dari satu kategori.</p>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Publikasikan Campaign</button>
            <a href="{{ route('campaign.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

<script>
(() => {
    const input = document.getElementById('campaign-image');
    const dropzone = document.getElementById('campaign-dropzone');
    const previewWrap = document.getElementById('campaign-preview-wrap');
    const preview = document.getElementById('campaign-preview');
    const fileName = document.getElementById('campaign-file-name');
    const fileSize = document.getElementById('campaign-file-size');

    const showPreview = (file) => {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (event) => {
            preview.src = event.target.result;
            fileName.textContent = file.name;
            fileSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
            previewWrap.classList.add('show');
        };
        reader.readAsDataURL(file);
    };

    input.addEventListener('change', () => showPreview(input.files[0]));
    ['dragenter', 'dragover'].forEach((eventName) => dropzone.addEventListener(eventName, () => dropzone.classList.add('dragover')));
    ['dragleave', 'drop'].forEach((eventName) => dropzone.addEventListener(eventName, () => dropzone.classList.remove('dragover')));
})();
</script>
@endsection
