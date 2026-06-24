@extends('app')

@section('title', 'Home')

@section('content')

<style>
/* Hero Section */
.hero {
    text-align: center;
    padding: 80px 24px 60px;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
}
.hero h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #16a34a;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.hero p {
    font-size: 1.05rem;
    color: #6b7280;
    max-width: 480px;
    margin: 0 auto 32px;
    line-height: 1.6;
}
.hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
.btn-hero-primary {
    display: inline-block;
    background: #16a34a;
    color: #fff;
    padding: 13px 32px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.95rem;
    font-family: inherit;
    border: none;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
}
.btn-hero-primary:hover { background: #15803d; transform: translateY(-1px); }
.btn-hero-secondary {
    display: inline-block;
    background: transparent;
    color: #16a34a;
    padding: 13px 32px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.95rem;
    font-family: inherit;
    border: 2px solid #16a34a;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-hero-secondary:hover { background: #f0fdf4; }

/* Stats */
.stats {
    background: #fff;
    padding: 40px 24px;
    border-bottom: 1px solid #e5e7eb;
}
.stats-inner {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    text-align: center;
}
.stat-item h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #16a34a;
}
.stat-item p { font-size: 0.9rem; color: #6b7280; margin-top: 4px; }

/* Program Cards */
.programs {
    padding: 60px 24px;
    background: #f9fafb;
}
.programs-inner { max-width: 1100px; margin: 0 auto; }
.section-title {
    text-align: center;
    font-size: 1.6rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 8px;
}
.section-sub {
    text-align: center;
    color: #6b7280;
    margin-bottom: 40px;
    font-size: 0.95rem;
}
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
}
.card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    transition: transform 0.2s, box-shadow 0.2s;
}
.card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
.card-img {
    height: 175px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    background: linear-gradient(135deg,#dcfce7,#f0fdf4);
    overflow: hidden;
}
.card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .25s; }
.card:hover .card-img img { transform: scale(1.035); }
.image-placeholder { font-size: .78rem; font-weight: 800; letter-spacing: .08em; color: #15803d; text-transform: uppercase; }
.card-body { padding: 20px; }
.card-body h4 { font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
.card-body p { font-size: 0.85rem; color: #6b7280; margin-bottom: 16px; line-height: 1.5; }
.progress-bar {
    background: #e5e7eb;
    border-radius: 100px;
    height: 8px;
    margin-bottom: 8px;
    overflow: hidden;
}
.progress-fill { height: 100%; background: #16a34a; border-radius: 100px; transition: width 0.6s; }
.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.78rem;
    color: #9ca3af;
    margin-bottom: 14px;
}
.btn-card {
    display: block;
    text-align: center;
    width: 100%;
    background: #16a34a;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.88rem;
    font-family: inherit;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-card:hover { background: #15803d; }

/* How it works */
.how {
    padding: 60px 24px;
    background: #fff;
}
.how-inner { max-width: 1100px; margin: 0 auto; }
.steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 32px; margin-top: 40px; }
.step { text-align: center; }
.step-icon {
    width: 64px; height: 64px;
    background: #dcfce7;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8rem;
    font-weight: 800;
    color: #15803d;
    letter-spacing: .05em;
    margin: 0 auto 16px;
}
.step h4 { font-weight: 700; margin-bottom: 6px; }
.step p { font-size: 0.85rem; color: #6b7280; line-height: 1.5; }

@media (max-width: 600px) {
    .hero h1 { font-size: 1.6rem; }
    .stats-inner { grid-template-columns: 1fr; }
}
</style>

<!-- Hero -->
<section class="hero">
    <h1>Selamat Datang di DonasiKu</h1>
    <p>Mari berbagi kebaikan dan bantu sesama melalui donasi yang transparan dan terpercaya.</p>
    <div class="hero-btns">
        <a href="/donasi" class="btn-hero-primary">Mulai Donasi</a>
        <a href="/campaign" class="btn-hero-secondary">Lihat Program</a>
    </div>
</section>

<!-- Stats -->
<section class="stats">
    <div class="stats-inner">
        <div class="stat-item">
            <h3>Rp 2,4M+</h3>
            <p>Total Dana Terkumpul</p>
        </div>
        <div class="stat-item">
            <h3>1.200+</h3>
            <p>Donatur Aktif</p>
        </div>
        <div class="stat-item">
            <h3>48</h3>
            <p>Program Berhasil</p>
        </div>
    </div>
</section>

<!-- Program Donasi -->
<section class="programs">
    <div class="programs-inner">
        <h2 class="section-title">Program Donasi Aktif</h2>
        <p class="section-sub">Pilih program yang ingin kamu dukung</p>
        @if($campaigns->isEmpty())
            <div style="text-align:center;padding:42px;background:#fff;border:2px dashed #bbf7d0;border-radius:16px;color:#6b7280">
                Belum ada campaign aktif. <a href="{{ route('campaign.create') }}" style="color:#16a34a;font-weight:800">Tambah campaign pertama</a>.
            </div>
        @else
            <div class="cards-grid">
                @foreach($campaigns as $campaign)
                    @php
                        $percent = $campaign->target_donation > 0 ? min(100, round(($campaign->collected_donation / $campaign->target_donation) * 100)) : 0;
                    @endphp
                    <div class="card">
                        <div class="card-img">
                            @if($campaign->image)
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" loading="lazy">
                            @else
                                <span class="image-placeholder">DonasiKu</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h4>{{ $campaign->title }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit($campaign->description, 105) }}</p>
                            <div class="progress-bar"><div class="progress-fill" style="width:{{ $percent }}%"></div></div>
                            <div class="progress-label"><span>Rp {{ number_format($campaign->collected_donation, 0, ',', '.') }} terkumpul</span><span>{{ $percent }}%</span></div>
                            <a href="{{ route('campaign.donation', $campaign) }}" class="btn-card">Donasi Sekarang</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Cara Berdonasi -->
<section class="how">
    <div class="how-inner">
        <h2 class="section-title">Cara Berdonasi</h2>
        <p class="section-sub">Mudah, cepat, dan transparan</p>
        <div class="steps">
            <div class="step">
                <div class="step-icon">01</div>
                <h4>Pilih Program</h4>
                <p>Temukan program donasi yang sesuai dengan niat baikmu.</p>
            </div>
            <div class="step">
                <div class="step-icon">02</div>
                <h4>Tentukan Nominal</h4>
                <p>Masukkan jumlah donasi sesuai kemampuanmu, berapapun berarti.</p>
            </div>
            <div class="step">
                <div class="step-icon">03</div>
                <h4>Konfirmasi Donasi</h4>
                <p>Selesaikan pembayaran dan terima konfirmasi donasi via email.</p>
            </div>
            <div class="step">
                <div class="step-icon">04</div>
                <h4>Pantau Progres</h4>
                <p>Lihat laporan penggunaan dana secara transparan dan real-time.</p>
            </div>
        </div>
    </div>
</section>

@endsection
