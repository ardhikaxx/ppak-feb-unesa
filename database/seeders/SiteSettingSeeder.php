<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Services\PpakData;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Settings global dari data existing (PpakData + config/ppak).
     * Idempotent via updateOrCreate per key.
     */
    public function run(): void
    {
        $info = PpakData::getGeneralInfo();

        $rows = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'PPAk FEB UNESA', 'type' => 'text', 'label' => 'Nama website', 'sort_order' => 1],
            ['group' => 'general', 'key' => 'program_name', 'value' => $info['name'], 'type' => 'text', 'label' => 'Nama resmi program', 'sort_order' => 2],
            ['group' => 'general', 'key' => 'program_code', 'value' => $info['program_code'], 'type' => 'text', 'label' => 'Kode program', 'sort_order' => 3],
            ['group' => 'general', 'key' => 'faculty', 'value' => $info['faculty'], 'type' => 'text', 'label' => 'Fakultas', 'sort_order' => 4],
            ['group' => 'general', 'key' => 'university', 'value' => $info['university'], 'type' => 'text', 'label' => 'Universitas', 'sort_order' => 5],
            ['group' => 'general', 'key' => 'tagline', 'value' => $info['tagline'], 'type' => 'textarea', 'label' => 'Tagline', 'sort_order' => 6],
            ['group' => 'general', 'key' => 'footer_text', 'value' => 'Program Studi Pendidikan Profesi Akuntan, Fakultas Ekonomika dan Bisnis, Universitas Negeri Surabaya.', 'type' => 'textarea', 'label' => 'Teks footer', 'sort_order' => 7],
            ['group' => 'general', 'key' => 'copyright', 'value' => '© 2026 PPAk FEB UNESA. Hak cipta dilindungi.', 'type' => 'text', 'label' => 'Copyright', 'sort_order' => 8],

            // Kontak
            ['group' => 'contact', 'key' => 'address', 'value' => $info['address'], 'type' => 'textarea', 'label' => 'Alamat', 'sort_order' => 1],
            ['group' => 'contact', 'key' => 'email', 'value' => $info['email'], 'type' => 'email', 'label' => 'Email', 'sort_order' => 2],
            ['group' => 'contact', 'key' => 'phone', 'value' => $info['phone'], 'type' => 'text', 'label' => 'Telepon', 'sort_order' => 3],
            ['group' => 'contact', 'key' => 'whatsapp', 'value' => $info['whatsapp'], 'type' => 'text', 'label' => 'WhatsApp', 'sort_order' => 4],
            ['group' => 'contact', 'key' => 'office_hours', 'value' => $info['office_hours'], 'type' => 'text', 'label' => 'Jam layanan', 'sort_order' => 5],
            ['group' => 'contact', 'key' => 'maps_url', 'value' => 'https://maps.google.com/?q=Gedung+G6+FEB+UNESA+Ketintang+Surabaya', 'type' => 'url', 'label' => 'Link Google Maps', 'sort_order' => 6],

            // Sosial media
            ['group' => 'social', 'key' => 'instagram', 'value' => $info['socials']['instagram'] ?? '', 'type' => 'url', 'label' => 'Instagram UNESA', 'sort_order' => 1],
            ['group' => 'social', 'key' => 'instagram_feb', 'value' => $info['socials']['instagram_feb'] ?? '', 'type' => 'url', 'label' => 'Instagram FEB', 'sort_order' => 2],
            ['group' => 'social', 'key' => 'youtube', 'value' => $info['socials']['youtube'] ?? '', 'type' => 'url', 'label' => 'YouTube', 'sort_order' => 3],
            ['group' => 'social', 'key' => 'tiktok', 'value' => $info['socials']['tiktok'] ?? '', 'type' => 'url', 'label' => 'TikTok', 'sort_order' => 4],
            ['group' => 'social', 'key' => 'facebook', 'value' => $info['socials']['facebook'] ?? '', 'type' => 'url', 'label' => 'Facebook', 'sort_order' => 5],
            ['group' => 'social', 'key' => 'linkedin', 'value' => $info['socials']['linkedin'] ?? '', 'type' => 'url', 'label' => 'LinkedIn', 'sort_order' => 6],

            // SEO
            ['group' => 'seo', 'key' => 'site_title', 'value' => 'Pendidikan Profesi Akuntan FEB UNESA | Universitas Negeri Surabaya', 'type' => 'text', 'label' => 'Site title', 'sort_order' => 1],
            ['group' => 'seo', 'key' => 'meta_description', 'value' => 'Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya mempersiapkan akuntan profesional berkarakter, beretika, dan kompeten.', 'type' => 'textarea', 'label' => 'Meta description', 'sort_order' => 2],
            ['group' => 'seo', 'key' => 'og_image', 'value' => '/images/og-ppak-unesa.jpg', 'type' => 'image', 'label' => 'Open Graph image', 'sort_order' => 3],

            // Admisi
            ['group' => 'admission', 'key' => 'portal_url', 'value' => 'https://pmb.unesa.ac.id', 'type' => 'url', 'label' => 'Portal PMB', 'sort_order' => 1],
            ['group' => 'admission', 'key' => 'admisi_url', 'value' => 'https://admisi.unesa.ac.id', 'type' => 'url', 'label' => 'Portal Admisi', 'sort_order' => 2],
        ];

        foreach ($rows as $row) {
            SiteSetting::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}
