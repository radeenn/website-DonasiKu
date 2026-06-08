<style>
footer {
    background: #1e3a5f;
    color: #fff;
    margin-top: auto;
}
.footer-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 24px 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}
.footer-brand h2 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.footer-brand p, .footer-contact p {
    font-size: 0.85rem;
    color: #94a3b8;
    line-height: 1.6;
}
.footer-contact h2 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.footer-bottom {
    text-align: center;
    font-size: 0.8rem;
    color: #64748b;
    padding: 16px 24px;
    border-top: 1px solid #2d4a6b;
}
@media (max-width: 600px) {
    .footer-inner { grid-template-columns: 1fr; }
}
</style>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <h2>DonasiKu</h2>
            <p>Platform donasi sosial untuk membantu sesama dengan transparansi dan kemudahan.</p>
        </div>
        <div class="footer-contact">
            <h2>Kontak</h2>
            <p>Email: support@donasiku.com</p>
            <p>Telp: 0812-xxxx-xxxx</p>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} DonasiKu. All rights reserved.
    </div>
</footer>
