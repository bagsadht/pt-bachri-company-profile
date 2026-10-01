<style>
    .site-footer { background: #060a10; color: #94a3b8; padding: 4rem 0 2rem; border-top: 1px solid rgba(255,255,255,.08); }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1.2fr; gap: 3rem; max-width: 1100px; margin: 0 auto 3rem; padding: 0 1rem; }
    .footer-col h4 { color: #fff; font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem; }
    .footer-col p { font-size: .9rem; line-height: 1.6; color: #94a3b8; }
    .footer-links { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: .75rem; }
    .footer-links a, .footer-col a.footer-contact-link { color: #94a3b8; text-decoration: none; font-size: .9rem; transition: color .2s; }
    .footer-links a:hover, .footer-col a.footer-contact-link:hover { color: #f1c40f; }
    .footer-contact-item { margin-bottom: .75rem; font-size: .9rem; }
    .footer-bottom { max-width: 1100px; margin: 0 auto; padding: 1.5rem 1rem 0; border-top: 1px solid rgba(255,255,255,.05); display: flex; justify-content: space-between; font-size: .85rem; color: #64748b; }
    @media (max-width: 767.98px) { .footer-grid { grid-template-columns: 1fr; gap: 2rem; } .footer-bottom { flex-direction: column; gap: .5rem; } }
</style>
<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-col">
            <h4>PT Bachri Samudera Indonesia</h4>
            <p>Perusahaan profesional yang bergerak di bidang layanan dan solusi terpercaya, berkomitmen memberikan pelayanan terbaik bagi setiap klien dengan standar kualitas tinggi.</p>
        </div>
        <div class="footer-col">
            <h4>Menu Utama</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
                <li><a href="{{ url('/services') }}">Layanan</a></li>
                <li><a href="{{ route('careers.index') }}">Karir</a></li>
                <li><a href="{{ url('/contact') }}">Hubungi Kami</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <div class="footer-contact-item">Email: <a href="mailto:bachrisamuderaindonesia@gmail.com" class="footer-contact-link">bachrisamuderaindonesia@gmail.com</a></div>
            <div class="footer-contact-item">Telepon: <a href="tel:085714141802" class="footer-contact-link">0857 1414 1802</a></div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} PT Bachri Samudera Indonesia. All rights reserved.</p>
        <p>Professional &amp; Reliable Service</p>
    </div>
</footer>