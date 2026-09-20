# Panduan & Dokumentasi Lengkap Strategi SEO Teknis & Konten
## Program Studi Pendidikan Profesi Akuntan (PPAk) FEB Universitas Negeri Surabaya (UNESA)

Dokumen ini merupakan sumber referensi teknis dan editorial SEO untuk website resmi **Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya (FEB UNESA)** berbasis Laravel 13.

---

### 1. Fondasi Arsitektur & Prinsip Utama
1. **White-Hat & Search-Intent Centric**: Mengutamakan relevansi nyata bagi calon mahasiswa, akademisi, dan stakeholder tanpa manipulasi *keyword stuffing*, *doorway pages*, *cloaking*, atau *fake reviews*.
2. **Server-Side Rendered (SSR) with Blade**: Seluruh metadata, canonical URL, Open Graph, Twitter Cards, dan structured data JSON-LD dirender langsung dari server sehingga dapat di-crawl secara instan dan akurat oleh bot Google/Bing/Sosmed.
3. **Immutability of Official Verified Data**: Mengacu secara ketat pada SK Rektor No. 645/UN38/HK/2025, SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025 (Peringkat Baik), Kalender Akademik Resmi 2026/2027, dan UKT Admisi Rp5.500.000/semester.
4. **Hierarki Fallback Metadata Dinamis**:
   $$\text{Custom SEO Content} \longrightarrow \text{Excerpt/Judul Konten} \longrightarrow \text{Site Settings (CMS)} \longrightarrow \text{Config Default (ppak.php)}$$

---

### 2. Matriks Rute Publik & Keyword Mapping Berdasarkan Search Intent

| No | Rute / Entitas | Canonical URL | Search Intent | Keyword Utama & Target Long-Tail |
|:---|:---|:---|:---|:---|
| 1 | **Beranda** | `/` | Navigational & Brand | *PPAk UNESA, Pendidikan Profesi Akuntan UNESA, PPAk FEB UNESA, Profesi Akuntan Surabaya* |
| 2 | **Sejarah Program** | `/profil/sejarah` | Informational | *sejarah PPAk UNESA, pendirian profesi akuntan UNESA 2025, prodi 62902* |
| 3 | **Visi, Misi & Tujuan** | `/profil/visi-misi` | Informational | *visi misi PPAk FEB UNESA, tujuan pendidikan profesi akuntan UNESA* |
| 4 | **Struktur Organisasi** | `/profil/struktur-organisasi` | Informational / Authority | *pengelola PPAk UNESA, kaprodi PPAk FEB UNESA, pengurus profesi akuntan* |
| 5 | **Dosen & Pengajar** | `/profil/dosen-pengajar` | Academic / Authority | *dosen PPAk UNESA, pengajar profesi akuntan UNESA, tenaga pengajar akuntansi* |
| 6 | **Akreditasi** | `/profil/akreditasi` | Trust / Investigational | *akreditasi PPAk UNESA, akreditasi LAMEMBA PPAk FEB UNESA, akreditasi Baik 2025-2027* |
| 7 | **Kurikulum & CPL** | `/akademik/kurikulum` | Academic / Informational | *kurikulum PPAk UNESA, mata kuliah profesi akuntan UNESA, CPL SINDIG UNESA, SKS PPAk* |
| 8 | **Kalender Akademik** | `/akademik/kalender` | Informational / Schedule | *kalender akademik PPAk UNESA, jadwal perkuliahan profesi akuntan semester gasal genap* |
| 9 | **Gelar & Sertifikasi** | `/akademik/gelar-sertifikasi` | Investigational / Career | *gelar setelah PPAk, sebutan Ak., sertifikasi CA IAI setelah PPAk, CPA IAPI UNESA* |
| 10 | **Pedoman Akademik** | `/akademik/panduan` | Academic | *pedoman akademik PPAk UNESA, buku panduan mahasiswa profesi akuntan* |
| 11 | **Jalur & Syarat** | `/admisi/jalur-syarat` | Admission / Transactional | *syarat masuk PPAk UNESA, syarat pendaftaran profesi akuntan, PMB UNESA profesi* |
| 12 | **Biaya Pendidikan** | `/admisi/biaya` | Transactional / Investigational | *biaya PPAk UNESA, UKT profesi akuntan UNESA, biaya kuliah PPAk Rp5.500.000* |
| 13 | **Prosedur & Jadwal** | `/admisi/prosedur-jadwal` | Admission / Actionable | *cara daftar PPAk UNESA, jadwal pendaftaran PPAk UNESA gelombang 1 2, alur admisi* |
| 14 | **FAQ Admisi** | `/admisi/faq` | Question / Long-Tail | *tanya jawab pendaftaran PPAk, apakah lulusan luar UNESA bisa daftar PPAk* |
| 15 | **Riset & Publikasi** | `/riset-pengabdian/riset-publikasi` | Academic / Authority | *riset akuntansi terapan UNESA, publikasi jurnal dosen mahasiswa PPAk* |
| 16 | **Pengabdian (PKM)** | `/riset-pengabdian/pengabdian` | Community / Institutional | *PKM akuntansi UNESA, pengabdian masyarakat dosen PPAk FEB UNESA* |
| 17 | **Kerja Sama** | `/riset-pengabdian/kerja-sama` | Partnership / Trust | *kerja sama PPAk UNESA, mitra KAP IAI IAPI industri FEB UNESA* |
| 18 | **Alumni** | `/kemahasiswaan-alumni/alumni` | Career / Social Proof | *ikatan alumni PPAk UNESA, jaringan alumni akuntan profesional* |
| 19 | **Mahasiswa & Kegiatan**| `/kemahasiswaan-alumni/mahasiswa` | Community / Campus Life | *kegiatan mahasiswa PPAk UNESA, organisasi kemahasiswaan profesi* |
| 20 | **Testimoni & Karir** | `/kemahasiswaan-alumni/testimoni-karier`| Social Proof / Conversion | *testimoni lulusan PPAk UNESA, prospek karir akuntan publik manajemen* |
| 21 | **Berita & Kabar** | `/informasi/berita` | News / Freshness | *berita PPAk UNESA, kegiatan FEB UNESA, kabar terkini profesi akuntan* |
| 22 | **Detail Berita** | `/informasi/berita/{slug}` | Deep Content / Article | *Spesifik per artikel berita/pengumuman dengan schema NewsArticle* |
| 23 | **Agenda & Seminar** | `/informasi/agenda` | Event / Temporal | *agenda seminar akuntansi UNESA, webinar perpajakan, kuliah tamu pakar* |
| 24 | **Galeri Dokumentasi**| `/informasi/galeri` | Visual Proof | *dokumentasi kegiatan PPAk UNESA, foto kuliah perdana, seremoni yudisium* |
| 25 | **Lokasi & Kampus** | `/kontak/lokasi` | Local Intent | *lokasi PPAk UNESA, Gedung G6 FEB Kampus Ketintang Surabaya, peta kampus* |
| 26 | **Helpdesk & Kontak** | `/kontak/helpdesk` | Support / Actionable | *kontak PPAk FEB UNESA, helpdesk mahasiswa admisi email telepon* |
| 27 | **Unduhan Dokumen** | `/kontak/unduhan` | Resource / Document | *download formulir pendaftaran PPAk, kurikulum PDF, panduan akademik resmi* |

---

### 3. Arsitektur Structured Data (JSON-LD Schema.org)

Website menerapkan structured data valid tanpa *rating/review palsu*:
1. **`EducationalOrganization` (Global)**:
   - Diterapkan pada layout global (`app.blade.php`).
   - Menyediakan informasi resmi institusi: nama lengkap, nama singkat (*PPAk FEB UNESA*), logo UNESA, alamat pos (*Gedung G6 FEB Kampus Ketintang, Surabaya, Jawa Timur 60231*), kontak telepon, email resmi, dan link media sosial (*sameAs*).
2. **`WebSite` & `SearchAction` (Beranda)**:
   - Diterapkan pada `/` dengan target Sitelink Search Box ke endpoint publik `/search?q={search_term_string}`.
3. **`BreadcrumbList` (Seluruh Sub-halaman)**:
   - Otomatis di-generate dari komponen `page-header` sesuai hierarki breadcrumb visual.
4. **`NewsArticle` (Detail Berita `/informasi/berita/{slug}`)**:
   - Berisi `headline`, `description`, `image`, `datePublished`, `dateModified`, `author` (Organization/User), dan `publisher`.
5. **`Event` (Agenda `/informasi/agenda`)**:
   - Berisi nama kegiatan, lokasi (*Gedung G6 FEB Ketintang*), `startDate`, deskripsi, `eventStatus`, dan `organizer`.
6. **`Person` / Tenaga Pengajar (`/profil/dosen-pengajar`)**:
   - Memetakan profil dosen, gelar akademik, peran, email, dan afiliasi resmi UNESA.

---

### 4. Open Graph & Social Media Optimization

1. **Gambar Open Graph Institusional Statis**:
   - Gambar master: `public/images/og-ppak-unesa.jpg` (1200 x 630 piksel, rasio 1.91:1, ukuran file ~220 KB, format JPEG).
   - Dibuat dari asset berkualitas tinggi `background-hero.jpg`.
   - **Terkunci Statis**: Admin CMS tidak dapat mengubah file default ini agar konsistensi preview sosial saat URL dibagikan di WhatsApp, LinkedIn, Facebook, Telegram, dan X selalu terjaga.
2. **Per-Page OG Image**:
   - Pada halaman detail berita, gambar utama berita otomatis menjadi `og:image` artikel tersebut.
3. **Tag Lengkap**:
   - `og:type`, `og:url`, `og:title`, `og:description`, `og:image`, `og:image:secure_url`, `og:image:type`, `og:image:width`, `og:image:height`, `og:image:alt`, `og:site_name`, `og:locale` (`id_ID`), `twitter:card` (`summary_large_image`).

---

### 5. Pengelolaan SEO Dinamis Melalui CMS Admin

1. **Manajemen SEO Berita & Agenda**:
   - Form editor di CMS dilengkapi kartu **Optimasi SEO & Metadata** yang memiliki:
     - **SERP Google Search Preview**: Simulasi langsung hasil pencarian Google saat editor mengetik judul/deskripsi.
     - **Open Graph Social Preview**: Simulasi tampilan kartu medsos (WhatsApp/Facebook).
     - Field `seo_title` dengan indikator rekomendasi 50–60 karakter.
     - Field `seo_description` dengan indikator rekomendasi 140–160 karakter.
     - Field `canonical_url` untuk override kustom jika dibutuhkan.
     - Field `og_title` & `og_description` untuk override sosial.
     - Switch `robots_index` untuk mengatur apakah konten terindeks atau noindex.
2. **Dashboard Kesehatan SEO (`/admin/seo-health`)**:
   - Terintegrasi di CMS Admin pada menu **Website > Kesehatan SEO**.
   - Menyajikan audit real-time dari database: status 26 rute publik, jumlah berita terbit, berita tanpa gambar utama, status robots.txt, status sitemap, dan checklist kesiapan deployment.
   - Tombol **Segarkan Cache Sitemap** untuk membersihkan cache XML sitemap secara instan.

---

### 6. Technical SEO, Crawling & Indexing Rules

1. **Robots.txt (`/robots.txt`)**:
   ```
   User-agent: *
   Allow: /
   Disallow: /admin/
   Disallow: /admin
   Disallow: /search

   Sitemap: https://ppak.feb.unesa.ac.id/sitemap.xml
   ```
2. **Sitemap XML Otomatis (`/sitemap.xml`)**:
   - Mengambil seluruh 26 rute publik kanonis.
   - Mengambil seluruh artikel berita yang berstatus `published` dengan `lastmod` dari `updated_at`.
   - Mengambil seluruh file unduhan publik resmi.
   - Mengabaikan rute admin, login, filter pencarian internal, atau artikel berstatus draft/noindex.
3. **Canonical URLs & 301 Redirects**:
   - Setiap halaman memiliki tag `<link rel="canonical" href="...">` yang absolut.
   - Alias route lama (seperti `/profil/dosen` -> `/profil/dosen-pengajar`, `/akademik/sertifikasi` -> `/akademik/gelar-sertifikasi`, `/admisi/syarat` -> `/admisi/jalur-syarat`) dialihkan dengan HTTP 301 permanen tanpa rantai redirect (*redirect chain*).
4. **Proteksi Noindex**:
   - Halaman admin (`/admin/*`) dan login admin memiliki `<meta name="robots" content="noindex,nofollow">`.
   - Halaman hasil pencarian internal (`/search`) memiliki `<meta name="robots" content="noindex,follow">`.
   - Halaman error 403, 404, 419, 429, 500 memiliki `<meta name="robots" content="noindex,nofollow">`.

---

### 7. Internal SEO Audit Command (`php artisan seo:audit`)

Untuk memverifikasi kepatuhan teknis seluruh halaman tanpa alat eksternal, jalankan:
```bash
php artisan seo:audit
```
Command ini akan menguji:
- Status HTTP 200 pada seluruh rute
- Keberadaan tag `lang="id"`
- Aturan single `<h1>` per halaman
- Panjang dan keterisian `<title>` dan `<meta description>`
- Validitas tag `<link rel="canonical">` dan `<meta property="og:image">`
- Ketersediaan JSON-LD Structured Data
- Ketersediaan `/sitemap.xml` dan `/robots.txt`

---

### 8. Checklist Deployment Production & Google Search Console

1. **Konfigurasi Environment Production**:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_URL=https://ppak.feb.unesa.ac.id`
2. **Pendaftaran Google Search Console**:
   - Daftarkan properti domain `https://ppak.feb.unesa.ac.id`.
   - Buka menu **Sitemaps**, masukkan URL: `https://ppak.feb.unesa.ac.id/sitemap.xml`.
   - Lakukan **URL Inspection** pada Homepage dan halaman Biaya/Pendaftaran untuk memeriksa render bot.
   - Pantau tab **Enhancements** untuk memverifikasi validitas schema `EducationalOrganization`, `BreadcrumbList`, dan `NewsArticle`.
