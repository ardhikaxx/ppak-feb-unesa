<?php

namespace App\Services;

/**
 * Scalable SEO architecture - reusable metadata via layout.
 * Single source for title, description, canonical, OG, Twitter, structured data.
 */
class SeoService
{
    public static function build(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        ?string $canonical = null,
        array $extra = []
    ): array {
        $config = config('ppak.seo');

        $title = $title ? $title . $config['title_suffix'] : $config['default_title'];
        $description = $description ?: $config['default_description'];
        $image = $image ?: $config['default_image'];
        $canonical = $canonical ?: url()->current();

        // Ensure absolute URL for OG image
        if (!str_starts_with($image, 'http')) {
            $image = asset(ltrim($image, '/'));
        }

        return array_merge([
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'og_type' => $extra['og_type'] ?? 'website',
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $image,
            'og_url' => $canonical,
            'twitter_card' => 'summary_large_image',
        ], $extra);
    }

    /**
     * Structured data for organization - helps SEO without per-page duplication.
     */
    public static function organizationJsonLd(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => config('ppak.institution.name') . ' ' . config('ppak.institution.faculty'),
            'url' => config('app.url'),
            'logo' => asset('images/logo-unesa.png'),
            'address' => config('ppak.institution.address'),
            'email' => config('ppak.institution.email'),
            'telephone' => config('ppak.institution.phone'),
        ];
    }

    /**
     * BreadcrumbList structured data.
     */
    public static function breadcrumbJsonLd(array $breadcrumbs): array
    {
        $items = [];
        $position = 1;
        foreach ($breadcrumbs as $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $crumb['label'],
                'item' => $crumb['url'] ?? url()->current(),
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }
}
