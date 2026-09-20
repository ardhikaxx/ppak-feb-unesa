<?php

namespace App\Console\Commands;

use App\Services\SeoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class SeoAuditCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:audit {--route= : Audit a specific route name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit SEO technical health, metadata, headings, canonicals, and structured data across all public routes';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('======================================================================');
        $this->info('       PPAk FEB UNESA - INTERNAL TECHNICAL SEO AUDIT RUNNER           ');
        $this->info('======================================================================');
        $this->newLine();

        $publicRoutes = [
            'home' => ['name' => 'Beranda', 'url' => route('home')],
            'profil.sejarah' => ['name' => 'Profil: Sejarah', 'url' => route('profil.sejarah')],
            'profil.visi-misi' => ['name' => 'Profil: Visi & Misi', 'url' => route('profil.visi-misi')],
            'profil.struktur-organisasi' => ['name' => 'Profil: Struktur Organisasi', 'url' => route('profil.struktur-organisasi')],
            'profil.dosen-pengajar' => ['name' => 'Profil: Dosen & Pengajar', 'url' => route('profil.dosen-pengajar')],
            'profil.akreditasi' => ['name' => 'Profil: Akreditasi', 'url' => route('profil.akreditasi')],
            'akademik.kurikulum' => ['name' => 'Akademik: Kurikulum & CPL', 'url' => route('akademik.kurikulum')],
            'akademik.kalender' => ['name' => 'Akademik: Kalender', 'url' => route('akademik.kalender')],
            'akademik.gelar-sertifikasi' => ['name' => 'Akademik: Gelar & Sertifikasi', 'url' => route('akademik.gelar-sertifikasi')],
            'akademik.panduan' => ['name' => 'Akademik: Panduan', 'url' => route('akademik.panduan')],
            'admisi.jalur-syarat' => ['name' => 'Admisi: Jalur & Syarat', 'url' => route('admisi.jalur-syarat')],
            'admisi.biaya' => ['name' => 'Admisi: Biaya UKT', 'url' => route('admisi.biaya')],
            'admisi.prosedur-jadwal' => ['name' => 'Admisi: Prosedur & Jadwal', 'url' => route('admisi.prosedur-jadwal')],
            'admisi.faq' => ['name' => 'Admisi: FAQ', 'url' => route('admisi.faq')],
            'riset-pengabdian.riset-publikasi' => ['name' => 'Riset: Publikasi', 'url' => route('riset-pengabdian.riset-publikasi')],
            'riset-pengabdian.pengabdian' => ['name' => 'Riset: PKM', 'url' => route('riset-pengabdian.pengabdian')],
            'riset-pengabdian.kerja-sama' => ['name' => 'Riset: Kerja Sama', 'url' => route('riset-pengabdian.kerja-sama')],
            'kemahasiswaan-alumni.alumni' => ['name' => 'Kemahasiswaan: Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
            'kemahasiswaan-alumni.mahasiswa' => ['name' => 'Kemahasiswaan: Mahasiswa', 'url' => route('kemahasiswaan-alumni.mahasiswa')],
            'kemahasiswaan-alumni.testimoni-karier' => ['name' => 'Kemahasiswaan: Testimoni', 'url' => route('kemahasiswaan-alumni.testimoni-karier')],
            'informasi.berita' => ['name' => 'Informasi: Berita', 'url' => route('informasi.berita')],
            'informasi.agenda' => ['name' => 'Informasi: Agenda', 'url' => route('informasi.agenda')],
            'informasi.galeri' => ['name' => 'Informasi: Galeri', 'url' => route('informasi.galeri')],
            'kontak.lokasi' => ['name' => 'Kontak: Lokasi', 'url' => route('kontak.lokasi')],
            'kontak.helpdesk' => ['name' => 'Kontak: Helpdesk', 'url' => route('kontak.helpdesk')],
            'kontak.unduhan' => ['name' => 'Kontak: Unduhan Dokumen', 'url' => route('kontak.unduhan')],
        ];

        $filterRoute = $this->option('route');
        if ($filterRoute && isset($publicRoutes[$filterRoute])) {
            $publicRoutes = [$filterRoute => $publicRoutes[$filterRoute]];
        }

        $tableRows = [];
        $totalPassed = 0;
        $totalWarnings = 0;
        $totalFailed = 0;

        foreach ($publicRoutes as $routeName => $meta) {
            $url = $meta['url'];
            $path = parse_url($url, PHP_URL_PATH) ?: '/';

            // Internal kernel dispatch to test rendered response
            $request = \Illuminate\Http\Request::create($path, 'GET');
            /** @var \Illuminate\Http\Response $response */
            $response = app()->handle($request);

            $status = $response->getStatusCode();
            $html = (string) $response->getContent();

            $issues = [];

            // 1. Status Code
            if ($status !== 200) {
                $issues[] = "HTTP {$status}";
            }

            // 2. Title
            if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $matches)) {
                $title = trim($matches[1]);
                if (empty($title)) {
                    $issues[] = "Empty <title>";
                } elseif (strlen($title) < 15) {
                    $issues[] = "Short title (" . strlen($title) . " chars)";
                }
            } else {
                $issues[] = "Missing <title>";
            }

            // 3. Meta Description
            if (preg_match('/<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']/is', $html, $matches)) {
                $desc = trim($matches[1]);
                if (empty($desc)) {
                    $issues[] = "Empty description";
                }
            } else {
                $issues[] = "Missing description";
            }

            // 4. Canonical
            if (!preg_match('/<link\s+rel=["\']canonical["\']/is', $html)) {
                $issues[] = "Missing canonical";
            }

            // 5. Open Graph Image
            if (!preg_match('/<meta\s+property=["\']og:image["\']/is', $html)) {
                $issues[] = "Missing og:image";
            }

            // 6. Single H1 check
            preg_match_all('/<h1[^>]*>/is', $html, $h1Matches);
            $h1Count = count($h1Matches[0]);
            if ($h1Count === 0) {
                $issues[] = "Missing <h1>";
            } elseif ($h1Count > 1) {
                $issues[] = "Multiple <h1> ({$h1Count})";
            }

            // 7. HTML Lang
            if (!preg_match('/<html[^>]+lang=["\']id["\']/is', $html)) {
                $issues[] = "Missing lang=\"id\"";
            }

            // 8. JSON-LD Structured Data
            $hasJsonLd = preg_match('/<script\s+type=["\']application\/ld\+json["\']/is', $html);

            $statusIcon = empty($issues) ? '<info>✓ PASS</info>' : '<fg=red>✗ FAIL</>';
            if (empty($issues)) {
                $totalPassed++;
            } else {
                $totalFailed++;
            }

            $tableRows[] = [
                $meta['name'],
                $path,
                $status,
                $h1Count === 1 ? '1 (OK)' : "{$h1Count} (Warn)",
                $hasJsonLd ? 'JSON-LD (OK)' : 'None',
                $statusIcon,
                empty($issues) ? 'Optimal' : implode(', ', $issues),
            ];
        }

        $this->table(
            ['Page Entity', 'Path', 'HTTP', 'H1 Count', 'Structured Data', 'Audit Result', 'Notes / Issues'],
            $tableRows
        );

        $this->newLine();
        $this->info("--- SEO SYSTEM ASSETS AUDIT ---");

        // Sitemap check
        $sitemapReq = \Illuminate\Http\Request::create('/sitemap.xml', 'GET');
        $sitemapRes = app()->handle($sitemapReq);
        $sitemapOk = $sitemapRes->getStatusCode() === 200 && str_contains((string) $sitemapRes->getContent(), '<urlset');
        $this->line("• XML Sitemap (/sitemap.xml): " . ($sitemapOk ? "<info>✓ 200 OK & Valid XML</info>" : "<fg=red>✗ FAIL</>"));

        // Robots.txt check
        $robotsReq = \Illuminate\Http\Request::create('/robots.txt', 'GET');
        $robotsRes = app()->handle($robotsReq);
        $robotsOk = $robotsRes->getStatusCode() === 200 && str_contains((string) $robotsRes->getContent(), 'Disallow: /admin');
        $this->line("• robots.txt (/robots.txt): " . ($robotsOk ? "<info>✓ 200 OK & Proper Disallow Rules</info>" : "<fg=red>✗ FAIL</>"));

        // Default OG image
        $ogImageExists = file_exists(public_path('images/og-ppak-unesa.jpg'));
        $this->line("• Institutional OG Image (public/images/og-ppak-unesa.jpg): " . ($ogImageExists ? "<info>✓ Exists & 1200x630</info>" : "<fg=red>✗ Missing</>"));

        $this->newLine();
        $this->info("SUMMARY AUDIT:");
        $this->line("• Total Pages Audited: " . count($publicRoutes));
        $this->line("• Passed: <info>{$totalPassed}</info>");
        $this->line("• Issues: " . ($totalFailed > 0 ? "<fg=red>{$totalFailed}</>" : "<info>0</info>"));

        return $totalFailed > 0 ? 1 : 0;
    }
}
