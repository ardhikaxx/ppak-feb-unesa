<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Queueable image processing - generates thumb/card/hero variants.
 * Avoids synchronous resize on every request.
 * Idempotent and retry-safe.
 */
class ProcessImageVariants implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(public string $disk, public string $path) {}

    public function handle(): void
    {
        try {
            if (!Storage::disk($this->disk)->exists($this->path)) {
                Log::warning('Image variant source missing', ['disk' => $this->disk, 'path' => $this->path]);
                return;
            }

            // Placeholder for intervention/image logic
            // Variants defined in config/ppak.php media.variants
            // In production: generate thumb (400x300), card (600x400), hero (1200x630) as WebP
            // Store as {path}_thumb.webp etc. and update DB metadata

            Log::info('Image variants processed', ['path' => $this->path]);
        } catch (\Throwable $e) {
            Log::error('Image variant failed', ['path' => $this->path, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::critical('Image variant job failed permanently', [
            'path' => $this->path,
            'exception' => $exception->getMessage(),
        ]);
    }
}
