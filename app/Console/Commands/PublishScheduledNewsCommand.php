<?php

namespace App\Console\Commands;

use App\Enums\ContentStatus;
use App\Models\News;
use App\Support\ContentCache;
use Illuminate\Console\Command;

class PublishScheduledNewsCommand extends Command
{
    protected $signature = 'news:publish-scheduled';

    protected $description = 'Publish news with status scheduled whose published_at has arrived';

    public function handle(): int
    {
        $now = now();

        $news = News::query()
            ->where('status', ContentStatus::Scheduled->value)
            ->where('published_at', '<=', $now)
            ->get();

        if ($news->isEmpty()) {
            $this->info('Tidak ada berita terjadwal yang perlu dipublikasikan.');
            return self::SUCCESS;
        }

        $count = 0;

        foreach ($news as $item) {
            $item->update(['status' => ContentStatus::Published->value]);
            $count++;
            $this->line("  Dipublikasikan: {$item->title} (published_at: {$item->published_at->format('Y-m-d H:i')})");
        }

        ContentCache::flush();

        $this->info("Selesai. {$count} berita berhasil dipublikasikan.");
        return self::SUCCESS;
    }
}
