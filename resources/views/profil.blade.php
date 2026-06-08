@extends('app')

@section('title', 'Profil')

@section('content')
<style>
.page-hero { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); padding: 50px 24px; text-align: center; }
.page-hero h1 { font-size: 1.8rem; font-weight: 800; color: #16a34a; margin-bottom: 8px; }
.page-hero p { color: #6b7280; font-size: 0.95rem; }
.profil-section { max-width: 600px; margin: 0 auto; padding: 48px 24px; }
.profil-card { background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 40px; text-align: center; }
.avatar { width: 96px; height: 96px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 16px; }
.profil-card h2 { font-size: 1.4rem; font-weight: 800; margin-bottom: 4px; }
.profil-card .email { color: #6b7280; font-size: 0.9rem; margin-bottom: 24px; }
.divider { border: none; border-top: 1px solid #f3f4f6; margin: 24px 0; }
.info-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; font-size: 0.9rem; }
.info-row span:first-child { color: #6b7280; }
.info-row span:last-child { font-weight: 600; }
.stats-row { display: flex; gap: 16px; margin: 24px 0; }
.stat-box { flex: 1; background: #f0fdf4; border-radius: 12px; padding: 16px; text-align: center; }
.stat-box h3 { font-size: 1.4rem; font-weight: 800; color: #16a34a; }
.stat-box p { font-size: 0.78rem; color: #6b7280; margin-top: 2px; }
.btn-edit { background: #16a34a; color: #fff; border: none; padding: 12px 32px; border-radius: 8px; font-weight: 700; font-size: 0.9rem; font-family: inherit; cursor: pointer; width: 100%; margin-top: 8px; }
.btn-edit:hover { background: #15803d; }
</style>

<div class="page-hero">
    <h1>Profil Saya</h1>
    <p>Kelola informasi akun dan riwayat donasimu</p>
</div>

<div class="profil-section">
    <div class="profil-card">
        <div class="avatar">👤</div>
        <h2>Pino Fandu Winata</h2>
        <div class="email">pinofanduwinata@email.com</div>

        <div class="stats-row">
            <div class="stat-box">
                <h3>2301</h3>
                <p>Total Donasi</p>
            </div>
            <div class="stat-box">
                <h3>Rp 900Jt</h3>
                <p>Total Disumbang</p>
            </div>
            <div class="stat-box">
                <h3>5</h3>
                <p>Program Diikuti</p>
            </div>
        </div>

        <hr class="divider">
        <div class="info-row"><span>Nama Lengkap</span><span>Pino Fandu Winata</span></div>
        <div class="info-row"><span>Email</span><span>pinofanduwinata@email.com</span></div>
        <div class="info-row"><span>No. Telepon</span><span>0812-xxxx-xxxx</span></div>
        <div class="info-row"><span>Bergabung</span><span>Januari 2026</span></div>

        <button class="btn-edit">Edit Profil</button>
    </div>
</div>
@endsection
