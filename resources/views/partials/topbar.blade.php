<div class="top-infobar d-none d-md-block" role="complementary" aria-label="Informasi Kontak dan Utilitas">
    <div class="top-infobar-container">
        {{-- Left: Institutional Identity --}}
        <div class="top-infobar-brand-wrapper">
            <span class="top-infobar-brand">
                Pendidikan Profesi Akuntansi <span class="top-infobar-sep" aria-hidden="true">&bull;</span> Fakultas Ekonomika dan Bisnis <span class="top-infobar-sep" aria-hidden="true">&bull;</span> Universitas Negeri Surabaya
            </span>
        </div>

        {{-- Right: Utility Contact & Navigation Links --}}
        <div class="top-infobar-utility" role="list">
            <a href="mailto:ppak.feb@unesa.ac.id" class="top-infobar-link d-none d-xl-inline-flex" role="listitem">
                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                <span>ppak.feb@unesa.ac.id</span>
            </a>
            <a href="tel:+62318280009" class="top-infobar-link d-none d-xl-inline-flex ms-1" role="listitem">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                <span>+62 31 828 0009</span>
            </a>
            <span class="top-infobar-divider d-none d-xl-inline-block" aria-hidden="true"></span>
            <a href="{{ route('akademik.kalender') }}" class="top-infobar-link" role="listitem">
                <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                <span>Kalender</span>
            </a>
            <span class="top-infobar-divider" aria-hidden="true"></span>
            <a href="{{ route('kontak.unduhan') }}" class="top-infobar-link" role="listitem">
                <i class="fa-solid fa-download" aria-hidden="true"></i>
                <span>Unduhan</span>
            </a>
            <span class="top-infobar-divider" aria-hidden="true"></span>
            <a href="{{ route('admisi.faq') }}" class="top-infobar-link" role="listitem">
                <i class="fa-regular fa-circle-question" aria-hidden="true"></i>
                <span>FAQ</span>
            </a>
            <span class="top-infobar-divider" aria-hidden="true"></span>
            <a href="https://unesa.ac.id" target="_blank" rel="noopener noreferrer" class="top-infobar-link" role="listitem">
                <i class="fa-solid fa-building-columns" aria-hidden="true"></i>
                <span>UNESA Pusat</span>
            </a>
        </div>
    </div>
</div>
