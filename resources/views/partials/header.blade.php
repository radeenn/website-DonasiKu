<style>
header {
    background: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    position: sticky;
    top: 0;
    z-index: 100;
}
.header-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
}
.logo {
    font-size: 1.4rem;
    font-weight: 800;
    color: #16a34a;
    letter-spacing: -0.5px;
}
nav { display: flex; align-items: center; gap: 24px; }
nav a {
    color: #374151;
    font-weight: 500;
    font-size: 0.95rem;
    transition: color 0.2s;
}
nav a:hover { color: #16a34a; }
.btn-donate {
    display: inline-block;
    background: #16a34a;
    color: #fff;
    border: none;
    padding: 10px 22px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    font-family: inherit;
}
.btn-donate:hover { background: #15803d; }
@media (max-width: 900px) {
    .header-inner { height: auto; min-height: 64px; padding-top: 12px; padding-bottom: 12px; flex-wrap: wrap; gap: 12px; }
    nav { order: 3; width: 100%; overflow-x: auto; padding-bottom: 3px; gap: 20px; }
    nav a { white-space: nowrap; }
}
@media (max-width: 520px) { .btn-donate { display: none; } }
</style>

<header>
    <div class="header-inner">
        <a href="/" class="logo">DonasiKu</a>
        <nav>
            <a href="/">Home</a>
            <a href="/donasi">Donasi</a>
            <a href="/campaign">Campaign</a>
            <a href="{{ route('documentations.index') }}">File & Gambar</a>
            <a href="/profil">Profil</a>
            <a href="/kontak">Kontak</a>
        </nav>
        <a href="/donasi" class="btn-donate">Donasi Sekarang</a>
    </div>
</header>
