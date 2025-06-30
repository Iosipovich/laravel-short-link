<?php
namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    public function createShortLink(string $originalUrl): Link
    {
        // проверка на дубликаты
        $existingLink = Link::where('original_url', $originalUrl)->first();
        if ($existingLink) {
            return $existingLink;
        }

        // генерация уникального кода
        do {
            $shortCode = Str::random(6);
        } while (Link::where('short_code', $shortCode)->exists());

        // создаем запись
        return Link::create([
            'original_url' => $originalUrl,
            'short_code'   => $shortCode,
        ]);
    }
}