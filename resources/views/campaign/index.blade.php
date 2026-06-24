@extends('app')

@section('title', 'Daftar Campaign')

@section('content')
<style>
.page-hero{background:linear-gradient(135deg,#f0fdf4 0%,#dcfce7 100%);padding:58px 24px;text-align:center}.page-hero h1{font-size:2rem;font-weight:800;color:#16a34a;margin-bottom:8px}.page-hero p{color:#6b7280}.campaign-section{max-width:1120px;margin:0 auto;padding:44px 24px}.flash-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;padding:14px 18px;border-radius:10px;font-size:.875rem;font-weight:700;margin-bottom:24px}.toolbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px}.toolbar h2{font-size:1.35rem;font-weight:800;color:#1f2937}.btn-add,.btn-donasi{background:#16a34a;color:#fff;padding:10px 18px;border-radius:9px;font-size:.84rem;font-weight:800;display:inline-block}.btn-add:hover,.btn-donasi:hover{background:#15803d;color:#fff}.campaign-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:20px}.campaign-card{background:#fff;border:1px solid #d1fae5;border-radius:17px;box-shadow:0 4px 18px rgba(22,163,74,.08);position:relative;overflow:hidden;transition:.2s}.campaign-card:hover{transform:translateY(-3px);box-shadow:0 12px 28px rgba(22,163,74,.12)}.campaign-image{height:190px;background:linear-gradient(135deg,#dcfce7,#f0fdf4);overflow:hidden;display:flex;align-items:center;justify-content:center;color:#15803d;font-size:2.8rem}.campaign-image img{width:100%;height:100%;object-fit:cover;transition:transform .25s}.campaign-card:hover .campaign-image img{transform:scale(1.035)}.campaign-content{padding:20px 22px 22px}.card-title{font-size:1.05rem;font-weight:800;color:#1f2937;margin-bottom:8px}.card-desc{font-size:.83rem;color:#6b7280;line-height:1.5;margin-bottom:12px}.badge-wrap{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px}.badge{background:#dcfce7;color:#15803d;border-radius:999px;padding:3px 9px;font-size:.72rem;font-weight:800}.progress-label{display:flex;justify-content:space-between;font-size:.75rem;color:#6b7280;margin-bottom:5px}.progress-label span:last-child{font-weight:800;color:#16a34a}.progress-bar-bg{background:#dcfce7;border-radius:999px;height:8px;overflow:hidden}.progress-bar-fill{height:100%;border-radius:999px;background:#16a34a}.card-info{display:flex;flex-direction:column;gap:8px;margin:14px 0}.card-info-row{display:flex;justify-content:space-between;gap:10px;font-size:.82rem}.card-info-label{color:#6b7280;font-weight:600}.card-info-value{font-weight:800;color:#1f2937}.card-info-value.green{color:#16a34a}.deadline-badge{display:inline-block;background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;font-size:.75rem;font-weight:700;padding:5px 10px;border-radius:999px;margin-bottom:14px}.card-actions{display:grid;grid-template-columns:1fr 1fr;gap:8px;padding-top:14px;border-top:1px solid #f0fdf4}.btn-edit{background:#fff;color:#16a34a;border:2px solid #16a34a;text-align:center;padding:8px;border-radius:8px;font-size:.82rem;font-weight:800}.btn-edit:hover{background:#16a34a;color:#fff}.btn-hapus{background:#fff;border:2px solid #fca5a5;color:#dc2626;text-align:center;padding:8px;border-radius:8px;font-size:.82rem;font-weight:800;cursor:pointer;font-family:inherit;width:100%}.btn-hapus:hover{background:#dc2626;border-color:#dc2626;color:#fff}.btn-donasi{grid-column:1/-1;text-align:center}.empty-state{text-align:center;padding:64px 24px;background:#f0fdf4;border-radius:14px;border:2px dashed #bbf7d0}.empty-state h3{font-size:1.1rem;font-weight:800;color:#374151;margin-bottom:8px}.empty-state p{color:#6b7280;font-size:.875rem;margin-bottom:20px}.image-placeholder{font-size:.78rem;font-weight:800;letter-spacing:.08em;color:#15803d;text-transform:uppercase}.empty-label{display:inline-block;background:#dcfce7;color:#15803d;border-radius:8px;padding:8px 12px;font-size:.7rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;margin-bottom:14px}
</style>

<div class="page-hero">
    <h1>Daftar Campaign</h1>
    <p>Kelola campaign donasi beserta gambar, kategori, rekening, dan data donasi.</p>
</div>

<div class="campaign-section">
    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="toolbar">
        <h2>Semua Campaign</h2>
        <a href="{{ route('campaign.create') }}" class="btn-add">Tambah Campaign</a>
    </div>

    @if($campaigns->isEmpty())
        <div class="empty-state">
            <div class="empty-label">Belum Ada Data</div>
            <h3>Belum ada campaign</h3>
            <p>Mulai buat campaign donasi pertama kamu.</p>
            <a href="{{ route('campaign.create') }}" class="btn-add">Buat Campaign Pertama</a>
        </div>
    @else
        <div class="campaign-grid">
            @foreach($campaigns as $campaign)
                @php
                    $percent = $campaign->target_donation > 0 ? min(100, round(($campaign->collected_donation / $campaign->target_donation) * 100)) : 0;
                @endphp
                <article class="campaign-card">
                    <div class="campaign-image">
                        @if($campaign->image)
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" loading="lazy">
                        @else
                            <span class="image-placeholder">DonasiKu</span>
                        @endif
                    </div>
                    <div class="campaign-content">
                        <div class="badge-wrap">
                            @forelse($campaign->categories as $category)
                                <span class="badge">{{ $category->name }}</span>
                            @empty
                                <span class="badge">Tanpa Kategori</span>
                            @endforelse
                        </div>

                        <div class="card-title">{{ $campaign->title }}</div>
                        <p class="card-desc">{{ \Illuminate\Support\Str::limit($campaign->description, 105) }}</p>

                        <div class="progress-label">
                            <span>Progress Donasi</span>
                            <span>{{ $percent }}%</span>
                        </div>
                        <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: {{ $percent }}%"></div></div>

                        <div class="card-info">
                            <div class="card-info-row"><span class="card-info-label">Target</span><span class="card-info-value">Rp {{ number_format($campaign->target_donation, 0, ',', '.') }}</span></div>
                            <div class="card-info-row"><span class="card-info-label">Terkumpul</span><span class="card-info-value green">Rp {{ number_format($campaign->collected_donation, 0, ',', '.') }}</span></div>
                            <div class="card-info-row"><span class="card-info-label">Jumlah Donasi</span><span class="card-info-value">{{ $campaign->donations->count() }} data</span></div>
                            @if($campaign->account)
                                <div class="card-info-row"><span class="card-info-label">Rekening</span><span class="card-info-value">{{ $campaign->account->bank_name }}</span></div>
                            @endif
                        </div>

                        <div class="deadline-badge">Deadline: {{ $campaign->deadline }}</div>

                        <div class="card-actions">
                            <a href="{{ route('campaign.donation', $campaign) }}" class="btn-donasi">Donasi Sekarang</a>
                            <a href="{{ route('campaign.edit', $campaign) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('campaign.destroy', $campaign) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus campaign ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
