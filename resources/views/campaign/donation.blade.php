@extends('app')

@section('title', 'Form Donasi')

@section('content')
<style>
.page-hero{background:linear-gradient(135deg,#f0fdf4 0%,#dcfce7 100%);padding:54px 24px;text-align:center}.page-hero h1{font-size:2rem;font-weight:800;color:#16a34a;margin-bottom:8px}.page-hero p{color:#6b7280}.donation-section{max-width:1050px;margin:0 auto;padding:42px 24px;display:grid;grid-template-columns:1fr 1.05fr;gap:24px}.info-card,.form-card{background:#fff;border:1px solid #d1fae5;border-radius:16px;box-shadow:0 2px 12px rgba(22,163,74,.08);padding:26px}.campaign-cover{width:100%;height:235px;border-radius:14px;overflow:hidden;background:linear-gradient(135deg,#dcfce7,#f0fdf4);display:flex;align-items:center;justify-content:center;font-size:3rem;margin-bottom:18px}.campaign-cover img{width:100%;height:100%;object-fit:cover}.cover-placeholder{font-size:.78rem;font-weight:800;letter-spacing:.08em;color:#15803d;text-transform:uppercase}.badge-wrap{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px}.badge{display:inline-block;background:#dcfce7;color:#15803d;border-radius:999px;padding:5px 11px;font-size:.75rem;font-weight:800}.campaign-title{font-size:1.25rem;font-weight:800;color:#1f2937;margin-bottom:10px}.desc{color:#6b7280;font-size:.9rem;line-height:1.6;margin-bottom:18px}.progress-bar{height:10px;border-radius:999px;background:#dcfce7;overflow:hidden;margin:12px 0}.progress-fill{height:100%;background:#16a34a;border-radius:999px}.money-row{display:flex;justify-content:space-between;gap:10px;font-size:.85rem;margin-top:8px}.money-row strong{color:#15803d}.rekening{background:#f8fffb;border:1px dashed #86efac;border-radius:12px;padding:16px;margin-top:18px}.rekening h3{font-size:.9rem;color:#15803d;margin-bottom:10px}.rekening p{font-size:.86rem;color:#374151;margin-bottom:5px}.form-title{font-size:1.05rem;font-weight:800;color:#1f2937;margin-bottom:18px}.form-group{margin-bottom:18px}.form-label{display:block;font-size:.875rem;font-weight:700;color:#374151;margin-bottom:7px}.form-input{width:100%;border:1.5px solid #d1fae5;border-radius:10px;padding:12px 14px;font-family:inherit;font-size:.9rem;color:#1f2937;background:#f9fafb;outline:none}.form-input:focus{border-color:#16a34a;box-shadow:0 0 0 3px rgba(22,163,74,.1);background:#fff}textarea.form-input{resize:vertical}.btn-submit{width:100%;background:#16a34a;color:#fff;padding:13px 24px;border-radius:10px;font-weight:800;border:0;cursor:pointer;font-family:inherit}.btn-submit:hover{background:#15803d}.alert-success{background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;border-radius:10px;padding:14px 18px;margin-bottom:18px;font-size:.88rem;font-weight:700}.error-box{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:18px;font-size:.86rem}.donation-list{margin-top:20px}.donation-item{border-top:1px solid #ecfdf5;padding:12px 0}.donation-item strong{font-size:.88rem}.donation-item p{font-size:.8rem;color:#6b7280;margin-top:4px}@media(max-width:850px){.donation-section{grid-template-columns:1fr}}
</style>

@php
    $percent = $campaign->target_donation > 0 ? min(100, round(($campaign->collected_donation / $campaign->target_donation) * 100)) : 0;
@endphp

<div class="page-hero">
    <h1>Form Donasi</h1>
    <p>Isi data donasi untuk mendukung campaign pilihanmu.</p>
</div>

<div class="donation-section">
    <div class="info-card">
        <div class="campaign-cover">
            @if($campaign->image)
                <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}">
            @else
                <span class="cover-placeholder">DonasiKu</span>
            @endif
        </div>
        <div class="badge-wrap">
            @forelse($campaign->categories as $category)
                <span class="badge">{{ $category->name }}</span>
            @empty
                <span class="badge">Donasi</span>
            @endforelse
        </div>

        <h2 class="campaign-title">{{ $campaign->title }}</h2>
        <p class="desc">{{ $campaign->description }}</p>

        <div class="progress-bar"><div class="progress-fill" style="width: {{ $percent }}%"></div></div>
        <div class="money-row">
            <span>Terkumpul: <strong>Rp {{ number_format($campaign->collected_donation, 0, ',', '.') }}</strong></span>
            <span>{{ $percent }}%</span>
        </div>
        <div class="money-row">
            <span>Target: Rp {{ number_format($campaign->target_donation, 0, ',', '.') }}</span>
            <span>Deadline: {{ $campaign->deadline }}</span>
        </div>

        @if($campaign->account)
            <div class="rekening">
                <h3>Rekening Penerimaan Donasi</h3>
                <p><b>Bank:</b> {{ $campaign->account->bank_name }}</p>
                <p><b>No. Rekening:</b> {{ $campaign->account->account_number }}</p>
                <p><b>Atas Nama:</b> {{ $campaign->account->account_holder }}</p>
            </div>
        @endif

        <div class="donation-list">
            <h3 class="form-title">Donasi Terbaru</h3>
            @forelse($campaign->donations->take(5) as $donation)
                <div class="donation-item">
                    <strong>{{ $donation->donor_name }} — Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong>
                    @if($donation->message)
                        <p>“{{ $donation->message }}”</p>
                    @endif
                </div>
            @empty
                <p class="desc">Belum ada donasi untuk campaign ini.</p>
            @endforelse
        </div>
    </div>

    <div class="form-card">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

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

        <h2 class="form-title">Masukkan Data Donatur</h2>
        <form action="{{ route('campaign.donation.store', $campaign) }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Donatur</label>
                <input type="text" name="donor_name" value="{{ old('donor_name') }}" class="form-input" required placeholder="Contoh: Angel">
            </div>
            <div class="form-group">
                <label class="form-label">Jumlah Donasi (Rp)</label>
                <input type="number" name="amount" value="{{ old('amount') }}" class="form-input" min="1000" required placeholder="Contoh: 50000">
            </div>
            <div class="form-group">
                <label class="form-label">Pesan / Doa</label>
                <textarea name="message" rows="4" class="form-input" placeholder="Tulis pesan singkat...">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn-submit">Simpan Donasi</button>
        </form>
    </div>
</div>
@endsection
