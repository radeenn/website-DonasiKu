@extends('app')

@section('title', 'Manajemen File & Gambar')

@section('content')
<style>
.file-page{background:#f8fafc;min-height:calc(100vh - 130px)}
.file-hero{background:linear-gradient(135deg,#eefbf3 0%,#dcfce7 52%,#f7fdf9 100%);padding:64px 24px 56px;border-bottom:1px solid #d1fae5}
.file-hero-inner{max-width:1120px;margin:0 auto;display:grid;grid-template-columns:minmax(0,1.4fr) minmax(280px,.6fr);gap:36px;align-items:center}
.file-kicker{display:inline-block;color:#15803d;background:#fff;border:1px solid #bbf7d0;border-radius:999px;padding:7px 13px;font-size:.72rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;margin-bottom:16px}
.file-hero h1{font-size:2.2rem;line-height:1.2;font-weight:800;color:#14532d;margin-bottom:12px;letter-spacing:-.03em}
.file-hero p{max-width:680px;color:#64748b;font-size:.94rem;line-height:1.75}
.hero-summary{background:rgba(255,255,255,.82);border:1px solid #bbf7d0;border-radius:18px;padding:20px;box-shadow:0 14px 35px rgba(21,128,61,.08);backdrop-filter:blur(6px)}
.summary-label{font-size:.72rem;color:#64748b;text-transform:uppercase;letter-spacing:.07em;font-weight:800;margin-bottom:12px}
.summary-list{display:grid;gap:10px}
.summary-item{display:flex;justify-content:space-between;gap:18px;padding-bottom:10px;border-bottom:1px solid #ecfdf5;font-size:.8rem;color:#475569}
.summary-item:last-child{border-bottom:0;padding-bottom:0}.summary-item strong{color:#166534;text-align:right}
.file-container{max-width:1120px;margin:0 auto;padding:38px 24px 68px}
.alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;border-left:4px solid #16a34a;border-radius:12px;padding:14px 17px;margin-bottom:22px;font-size:.86rem;font-weight:700}
.error-box{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;border-left:4px solid #dc2626;border-radius:12px;padding:14px 18px;margin-bottom:22px;font-size:.85rem;line-height:1.55}
.upload-card{background:#fff;border:1px solid #e2e8f0;border-radius:20px;padding:28px;box-shadow:0 12px 34px rgba(15,23,42,.06);margin-bottom:42px}
.upload-head{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid #ecfdf5}
.upload-head h2{font-size:1.18rem;font-weight:800;color:#1f2937;margin-bottom:5px}.upload-head p{font-size:.82rem;color:#64748b;line-height:1.55}
.upload-step{min-width:76px;text-align:center;border-radius:10px;background:#ecfdf5;color:#15803d;padding:8px 12px;font-size:.7rem;font-weight:800;letter-spacing:.05em;text-transform:uppercase}
.upload-grid{display:grid;grid-template-columns:minmax(0,.85fr) minmax(0,1.15fr);gap:22px;align-items:start}
.field-label{display:block;font-size:.82rem;font-weight:800;color:#334155;margin-bottom:8px}.text-input{width:100%;height:49px;border:1.5px solid #cbd5e1;border-radius:11px;padding:0 14px;font-family:inherit;font-size:.89rem;outline:none;background:#fff;transition:.2s}
.text-input:focus{border-color:#16a34a;box-shadow:0 0 0 3px rgba(22,163,74,.1)}.field-help{font-size:.74rem;color:#64748b;line-height:1.55;margin-top:9px}
.dropzone{position:relative;min-height:184px;border:2px dashed #86efac;border-radius:16px;background:#f8fffb;display:flex;align-items:center;justify-content:center;text-align:center;padding:24px;cursor:pointer;transition:.2s}
.dropzone:hover,.dropzone.dragover{border-color:#16a34a;background:#f0fdf4;transform:translateY(-1px)}.dropzone input{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer}
.drop-mark{width:70px;height:38px;margin:0 auto 13px;border-radius:9px;background:#dcfce7;color:#15803d;display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:800;letter-spacing:.08em}
.drop-title{font-size:.92rem;font-weight:800;color:#1f2937}.drop-sub{font-size:.74rem;color:#64748b;margin-top:7px;line-height:1.55}
.selected-file{display:none;margin-top:12px;border:1px solid #d1fae5;border-radius:12px;padding:12px 14px;background:#fff;align-items:center;gap:12px}.selected-file.show{display:flex}
.selected-thumb{width:58px;height:52px;border-radius:10px;background:#ecfdf5;color:#15803d;display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;letter-spacing:.04em;overflow:hidden;flex:0 0 auto}.selected-thumb img{width:100%;height:100%;object-fit:cover}
.selected-meta{min-width:0}.selected-meta strong{display:block;font-size:.81rem;color:#1f2937;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.selected-meta span{display:block;font-size:.72rem;color:#64748b;margin-top:4px}
.upload-actions{display:flex;justify-content:flex-end;margin-top:22px}.btn-upload{border:0;border-radius:10px;background:#16a34a;color:#fff;padding:12px 23px;font-family:inherit;font-size:.84rem;font-weight:800;cursor:pointer;box-shadow:0 7px 18px rgba(22,163,74,.18)}.btn-upload:hover{background:#15803d}
.gallery-head{display:flex;justify-content:space-between;align-items:flex-end;gap:16px;margin-bottom:20px}.gallery-head h2{font-size:1.28rem;font-weight:800;color:#1f2937}.gallery-head p{font-size:.81rem;color:#64748b;margin-top:6px}.file-count{background:#ecfdf5;color:#15803d;border:1px solid #bbf7d0;border-radius:999px;padding:7px 12px;font-size:.73rem;font-weight:800}
.file-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:20px}.file-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;box-shadow:0 3px 14px rgba(15,23,42,.05);transition:.2s}.file-card:hover{transform:translateY(-3px);box-shadow:0 13px 30px rgba(15,23,42,.09)}
.file-preview{height:176px;background:linear-gradient(135deg,#ecfdf5,#f8fafc);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative}.file-preview img{width:100%;height:100%;object-fit:cover;transition:transform .25s}.file-card:hover .file-preview img{transform:scale(1.035)}
.file-mark{min-width:88px;height:58px;padding:0 16px;border-radius:13px;background:#fff;border:1px solid #bbf7d0;display:flex;align-items:center;justify-content:center;color:#15803d;font-size:.8rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase}
.file-type{position:absolute;top:12px;left:12px;background:rgba(15,23,42,.82);color:#fff;border-radius:999px;padding:5px 9px;font-size:.63rem;font-weight:800;text-transform:uppercase;letter-spacing:.05em}.file-body{padding:16px}.file-title{font-size:.9rem;font-weight:800;color:#1f2937;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.file-date{font-size:.71rem;color:#94a3b8;margin-top:5px}.file-actions{display:grid;grid-template-columns:1fr auto;gap:8px;margin-top:14px}.btn-preview{display:block;text-align:center;background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;border-radius:9px;padding:9px 12px;font-size:.76rem;font-weight:800;cursor:pointer;font-family:inherit}.btn-preview:hover{background:#dcfce7}.btn-delete{height:37px;border-radius:9px;border:1px solid #fecaca;background:#fff;color:#b91c1c;padding:0 13px;cursor:pointer;font-family:inherit;font-size:.74rem;font-weight:800}.btn-delete:hover{background:#fef2f2}
.empty-gallery{text-align:center;background:#fff;border:2px dashed #cbd5e1;border-radius:18px;padding:54px 24px;color:#64748b}.empty-label{display:inline-block;border-radius:9px;background:#f1f5f9;color:#475569;padding:8px 12px;font-size:.67rem;font-weight:800;letter-spacing:.08em;margin-bottom:14px}.empty-gallery h3{font-size:1rem;color:#334155;margin-bottom:6px}.empty-gallery p{font-size:.82rem}
.modal{display:none;position:fixed;inset:0;background:rgba(15,23,42,.82);z-index:9999;padding:28px;align-items:center;justify-content:center}.modal.show{display:flex}.modal-card{width:min(1000px,100%);max-height:92vh;background:#fff;border-radius:17px;overflow:hidden;box-shadow:0 25px 70px rgba(0,0,0,.35)}.modal-head{min-height:58px;display:flex;align-items:center;justify-content:space-between;gap:20px;padding:10px 18px;border-bottom:1px solid #e2e8f0}.modal-head strong{font-size:.88rem;color:#1f2937;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.modal-close{border-radius:9px;border:1px solid #e2e8f0;background:#f8fafc;color:#475569;padding:8px 12px;font-size:.74rem;font-weight:800;cursor:pointer;font-family:inherit}.modal-content{height:min(74vh,720px);background:#f8fafc;display:flex;align-items:center;justify-content:center}.modal-content img{max-width:100%;max-height:100%;object-fit:contain}.modal-content iframe{width:100%;height:100%;border:0}.modal-open-link{padding:13px 18px;border-top:1px solid #e2e8f0;text-align:right}.modal-open-link a{display:inline-block;background:#16a34a;color:#fff;border-radius:9px;padding:9px 14px;font-size:.76rem;font-weight:800}
@media(max-width:820px){.file-hero-inner{grid-template-columns:1fr}.hero-summary{max-width:520px}.upload-grid{grid-template-columns:1fr}}
@media(max-width:600px){.file-hero{padding:46px 20px}.file-hero h1{font-size:1.7rem}.file-container{padding-left:18px;padding-right:18px}.upload-card{padding:20px}.upload-head,.gallery-head{align-items:flex-start;flex-direction:column}.file-grid{grid-template-columns:1fr}.modal{padding:12px}.modal-content{height:70vh}}
</style>

<div class="file-page">
    <section class="file-hero">
        <div class="file-hero-inner">
            <div>
                <h1>Manajemen File & Gambar</h1>
                <p>Unggah gambar atau dokumen ke penyimpanan Laravel. Data yang berhasil disimpan akan langsung tampil pada galeri dan dapat dibuka kembali melalui halaman ini.</p>
            </div>
            <aside class="hero-summary">
                <div class="summary-label">Ketentuan unggah</div>
                <div class="summary-list">
                    <div class="summary-item"><span>Format gambar</span><strong>PNG, JPG, JPEG, WEBP</strong></div>
                    <div class="summary-item"><span>Format dokumen</span><strong>PDF, DOCX</strong></div>
                    <div class="summary-item"><span>Ukuran maksimum</span><strong>5 MB per file</strong></div>
                </div>
            </aside>
        </div>
    </section>

    <div class="file-container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error-box">
                <strong>Upload belum berhasil.</strong>
                <ul style="margin:7px 0 0 18px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('documentations.store') }}" method="POST" enctype="multipart/form-data" class="upload-card">
            @csrf
            <div class="upload-head">
                <div>
                    <h2>Unggah File Baru</h2>
                    <p>Masukkan judul file, kemudian pilih gambar atau dokumen dari perangkat.</p>
                </div>
                <div class="upload-step">Form Upload</div>
            </div>

            <div class="upload-grid">
                <div>
                    <label class="field-label" for="title">Nama Dokumen atau Gambar</label>
                    <input id="title" class="text-input" type="text" name="title" value="{{ old('title') }}" maxlength="100" required placeholder="Contoh: Dokumentasi Penyaluran Bantuan">
                    <p class="field-help">Nama ini akan digunakan sebagai judul kartu pada galeri file.</p>
                </div>

                <div>
                    <label class="field-label" for="attachment">Pilih File</label>
                    <div class="dropzone" id="file-dropzone">
                        <input id="attachment" type="file" name="attachment" accept=".pdf,.docx,.png,.jpg,.jpeg,.webp" required>
                        <div>
                            <div class="drop-mark">UPLOAD</div>
                            <div class="drop-title">Klik atau tarik file ke area ini</div>
                            <div class="drop-sub">PDF, DOCX, PNG, JPG, JPEG, atau WEBP<br>Ukuran maksimal 5 MB</div>
                        </div>
                    </div>
                    <div class="selected-file" id="selected-file">
                        <div class="selected-thumb" id="selected-thumb">FILE</div>
                        <div class="selected-meta">
                            <strong id="selected-name">Nama file</strong>
                            <span id="selected-size">Ukuran file</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="upload-actions">
                <button type="submit" class="btn-upload">Unggah dan Simpan</button>
            </div>
        </form>

        <div class="gallery-head">
            <div>
                <h2>File dan Gambar Tersimpan</h2>
                <p>Data terbaru ditampilkan lebih dahulu. Gunakan tombol preview untuk melihat isi file.</p>
            </div>
            <div class="file-count">{{ $files->count() }} file</div>
        </div>

        @if($files->isEmpty())
            <div class="empty-gallery">
                <div class="empty-label">BELUM ADA DATA</div>
                <h3>Belum ada file yang diunggah</h3>
                <p>File pertama yang berhasil disimpan akan tampil pada bagian ini.</p>
            </div>
        @else
            <div class="file-grid">
                @foreach($files as $file)
                    <article class="file-card">
                        <div class="file-preview">
                            <span class="file-type">{{ $file->file_type ?: 'file' }}</span>
                            @if($file->is_image)
                                <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->title ?: 'Gambar dokumentasi' }}" loading="lazy">
                            @else
                                <div class="file-mark">{{ strtoupper($file->file_type ?: 'FILE') }}</div>
                            @endif
                        </div>
                        <div class="file-body">
                            <div class="file-title" title="{{ $file->title }}">{{ $file->title ?: 'File tanpa judul' }}</div>
                            <div class="file-date">Diunggah {{ optional($file->created_at)->format('d M Y, H:i') ?: 'tanggal tidak tersedia' }}</div>
                            <div class="file-actions">
                                @if($file->is_image || strtolower((string) $file->file_type) === 'pdf')
                                    <button
                                        type="button"
                                        class="btn-preview js-preview"
                                        data-url="{{ asset('storage/' . $file->file_path) }}"
                                        data-type="{{ strtolower((string) $file->file_type) }}"
                                        data-title="{{ $file->title ?: 'Preview File' }}"
                                    >Preview File</button>
                                @else
                                    <a class="btn-preview" href="{{ asset('storage/' . $file->file_path) }}" target="_blank" rel="noopener">Buka File</a>
                                @endif
                                <form action="{{ route('documentations.destroy', $file) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus file ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="modal" id="preview-modal" aria-hidden="true">
    <div class="modal-card">
        <div class="modal-head">
            <strong id="modal-title">Preview File</strong>
            <button type="button" class="modal-close" id="modal-close">Tutup</button>
        </div>
        <div class="modal-content" id="modal-content"></div>
        <div class="modal-open-link"><a id="modal-link" href="#" target="_blank" rel="noopener">Buka di Tab Baru</a></div>
    </div>
</div>

<script>
(() => {
    const input = document.getElementById('attachment');
    const dropzone = document.getElementById('file-dropzone');
    const selected = document.getElementById('selected-file');
    const selectedThumb = document.getElementById('selected-thumb');
    const selectedName = document.getElementById('selected-name');
    const selectedSize = document.getElementById('selected-size');

    const showSelectedFile = (file) => {
        if (!file) return;

        selectedName.textContent = file.name;
        selectedSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;

        const extension = file.name.includes('.')
            ? file.name.split('.').pop().toUpperCase()
            : 'FILE';

        selectedThumb.replaceChildren();

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const image = document.createElement('img');
                image.src = event.target.result;
                image.alt = 'Preview file terpilih';
                selectedThumb.replaceChildren(image);
            };
            reader.readAsDataURL(file);
        } else {
            selectedThumb.textContent = extension;
        }

        selected.classList.add('show');
    };

    input.addEventListener('change', () => showSelectedFile(input.files[0]));
    ['dragenter', 'dragover'].forEach((eventName) => dropzone.addEventListener(eventName, () => dropzone.classList.add('dragover')));
    ['dragleave', 'drop'].forEach((eventName) => dropzone.addEventListener(eventName, () => dropzone.classList.remove('dragover')));

    const modal = document.getElementById('preview-modal');
    const modalContent = document.getElementById('modal-content');
    const modalTitle = document.getElementById('modal-title');
    const modalLink = document.getElementById('modal-link');
    const closeModal = () => {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        modalContent.replaceChildren();
    };

    document.querySelectorAll('.js-preview').forEach((button) => {
        button.addEventListener('click', () => {
            const url = button.dataset.url;
            const type = button.dataset.type;
            const title = button.dataset.title;
            modalTitle.textContent = title;
            modalLink.href = url;
            modalContent.replaceChildren();

            if (['png', 'jpg', 'jpeg', 'webp'].includes(type)) {
                const image = document.createElement('img');
                image.src = url;
                image.alt = title;
                modalContent.appendChild(image);
            } else {
                const frame = document.createElement('iframe');
                frame.src = url;
                frame.title = title;
                modalContent.appendChild(frame);
            }

            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
        });
    });

    document.getElementById('modal-close').addEventListener('click', closeModal);
    modal.addEventListener('click', (event) => {
        if (event.target === modal) closeModal();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeModal();
    });
})();
</script>
@endsection
