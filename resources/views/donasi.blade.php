@extends('app')

@section('title', 'Donasi')

@section('content')
<style>
.page-hero{background:linear-gradient(135deg,#f0fdf4 0%,#dcfce7 100%);padding:50px 24px;text-align:center}.page-hero h1{font-size:1.9rem;font-weight:800;color:#16a34a;margin-bottom:8px}.page-hero p{color:#6b7280;font-size:.95rem}.donasi-section{max-width:1120px;margin:0 auto;padding:48px 24px}.donasi-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px}.card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.07);border:1px solid #ecfdf5;transition:transform .2s}.card:hover{transform:translateY(-4px)}.card-img{height:185px;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#dcfce7,#f0fdf4);overflow:hidden}.card-img img{width:100%;height:100%;object-fit:cover;transition:transform .25s}.card:hover .card-img img{transform:scale(1.035)}.card-body{padding:20px}.card-body h4{font-weight:800;margin-bottom:7px;color:#1f2937}.card-body p{font-size:.85rem;color:#6b7280;margin-bottom:16px;line-height:1.5}.progress-bar{background:#e5e7eb;border-radius:100px;height:8px;margin-bottom:8px;overflow:hidden}.progress-fill{height:100%;background:#16a34a;border-radius:100px}.progress-label{display:flex;justify-content:space-between;font-size:.78rem;color:#6b7280;margin-bottom:14px}.badge-wrap{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:10px}.badge{display:inline-block;background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:100px;font-size:.72rem;font-weight:800}.btn-card{display:block;text-align:center;width:100%;background:#16a34a;color:#fff;border:0;padding:11px;border-radius:8px;font-weight:800;font-size:.88rem;font-family:inherit;cursor:pointer}.btn-card:hover{background:#15803d;color:#fff}.empty-state{text-align:center;padding:64px 24px;background:#f0fdf4;border-radius:14px;border:2px dashed #bbf7d0}.empty-state h3{font-size:1.1rem;font-weight:800;color:#374151;margin-bottom:8px}.empty-state p{color:#6b7280;font-size:.875rem;margin-bottom:20px}.btn-add{background:#16a34a;color:#fff;padding:10px 18px;border-radius:9px;font-size:.84rem;font-weight:800;display:inline-block}.image-placeholder{font-size:.78rem;font-weight:800;letter-spacing:.08em;color:#15803d;text-transform:uppercase}.empty-label{display:inline-block;background:#dcfce7;color:#15803d;border-radius:8px;padding:8px 12px;font-size:.7rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;margin-bottom:14px}
</style>

<div class="page-hero">
    <h1>Program Donasi</h1>
    <p>Temukan dan dukung program sosial yang bermakna bagimu.</p>
</div>

<div class="donasi-section">
    @if($campaigns->isEmpty())
        <div class="empty-state">
            <div class="empty-label">Belum Ada Data</div>
            <h3>Belum ada program donasi</h3>
            <p>Silakan buat campaign terlebih dahulu melalui menu Campaign.</p>
            <a href="{{ route('campaign.create') }}" class="btn-add">Tambah Campaign</a>
        </div>
    @else
        <div class="donasi-grid">
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
                        <div class="badge-wrap">
                            @forelse($campaign->categories as $category)
                                <span class="badge">{{ $category->name }}</span>
                            @empty
                                <span class="badge">Donasi</span>
                            @endforelse
                        </div>
                        <h4>{{ $campaign->title }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($campaign->description, 115) }}</p>
                        <div class="progress-bar"><div class="progress-fill" style="width:{{ $percent }}%"></div></div>
                        <div class="progress-label">
                            <span>Rp {{ number_format($campaign->collected_donation, 0, ',', '.') }} terkumpul</span>
                            <span>{{ $percent }}%</span>
                        </div>
                        <a href="{{ route('campaign.donation', $campaign) }}" class="btn-card">Donasi Sekarang</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
