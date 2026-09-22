{{ '<?xml version="1.0" encoding="UTF-8"?>' }}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    @foreach($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        @if(!empty($url['lastmod']))<lastmod>{{ $url['lastmod'] }}</lastmod>@endif
        <news:news>
            <news:publication>
                <news:name>PPAk FEB UNESA</news:name>
                <news:language>id</news:language>
            </news:publication>
            <news:publication_date>{{ $url['news_date'] }}</news:publication_date>
            <news:title>{{ $url['news_title'] }}</news:title>
        </news:news>
    </url>
    @endforeach
</urlset>
