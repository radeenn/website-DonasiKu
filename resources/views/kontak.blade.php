@extends('app')

@section('title', 'Kontak')

@section('content')
<style>
.page-hero { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); padding: 50px 24px; text-align: center; }
.page-hero h1 { font-size: 1.8rem; font-weight: 800; color: #16a34a; margin-bottom: 8px; }
.page-hero p { color: #6b7280; font-size: 0.95rem; }
.kontak-section { max-width: 900px; margin: 0 auto; padding: 48px 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
.kontak-info h2 { font-size: 1.3rem; font-weight: 800; margin-bottom: 20px; }
.info-item { display: flex; gap: 16px; margin-bottom: 24px; align-items: flex-start; }
.info-icon { width: 48px; height: 48px; background: #dcfce7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
.info-text h4 { font-weight: 700; margin-bottom: 4px; }
.info-text p { font-size: 0.85rem; color: #6b7280; }
.form-card { background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 32px; }
.form-card h2 { font-size: 1.2rem; font-weight: 800; margin-bottom: 20px; }
.form-group { margin-bottom: 18px; }
.form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 6px; }
.form-group input, .form-group textarea {
    width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px;
    font-family: inherit; font-size: 0.9rem; outline: none; transition: border-color 0.2s;
}
.form-group input:focus, .form-group textarea:focus { border-color: #16a34a; }
.form-group textarea { height: 110px; resize: vertical; }
.btn-send { background: #16a34a; color: #fff; border: none; padding: 12px 32px; border-radius: 8px; font-weight: 700; font-size: 0.9rem; font-family: inherit; cursor: pointer; width: 100%; }
.btn-send:hover { background: #15803d; }
@media (max-width: 680px) { .kontak-section { grid-template-columns: 1fr; } }
</style>

<div class="page-hero">
    <h1>Hubungi Kami</h1>
    <p>Kami siap membantu kamu kapanpun dibutuhkan</p>
</div>

<div class="kontak-section">
    <div class="kontak-info">
        <h2>Informasi Kontak</h2>
        <div class="info-item">
            <div class="info-icon">📧</div>
            <div class="info-text">
                <h4>Email</h4>
                <p>support@donasiku.com</p>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">📱</div>
            <div class="info-text">
                <h4>Telepon</h4>
                <p>0812-xxxx-xxxx</p>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">📍</div>
            <div class="info-text">
                <h4>Alamat</h4>
                <p>Jl. Adeirma Suryani No. 9, Pontianak, Kalimantan Barat</p>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">🕐</div>
            <div class="info-text">
                <h4>Jam Operasional</h4>
                <p>Senin – Jumat, 08.00 – 17.00 WIB</p>
            </div>
        </div>
    </div>

    <div class="form-card">
        <h2>Kirim Pesan</h2>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Masukkan nama lengkap">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="Masukkan email">
        </div>
        <div class="form-group">
            <label>Subjek</label>
            <input type="text" placeholder="Masukkan subjek pesan">
        </div>
        <div class="form-group">
            <label>Pesan</label>
            <textarea placeholder="Tuliskan pesanmu di sini..."></textarea>
        </div>
        <button class="btn-send">Kirim Pesan</button>
    </div>
</div>
@endsection
