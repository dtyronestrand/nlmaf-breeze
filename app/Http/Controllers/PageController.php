<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App; // <-- Import App facade (or use app() helper)

class PageController extends Controller
{
    public function show(string $slug): InertiaResponse
    {
        // Get the current locale
        $locale = App::getLocale(); // Or use app()->getLocale()

        $item = Cache::rememberForever('page.' . $locale . '.' . $slug,
            function () use ($slug, $locale) { // Pass locale into closure if needed inside
                $item = Page::publishedInListings()
                    ->forSlug($slug)
                    ->first();

                if ($item !== null) {
                    $item->load('translations', 'medias', 'blocks');
                    // Pass locale explicitly if computeBlocks needs it immediately
                    // though it defaults to app()->getLocale() anyway
                    $item->computeBlocks($locale);
                }
                return $item;
            }
        );

        // Add check for null item after cache retrieval
        abort_if($item === null, Response::HTTP_NOT_FOUND);

        return Inertia::render('Page', [ // Or 'Pages' if that's your component name
            'item' => $item->only($item->publicAttributes),
            'locale' => $locale, // <--- ADD THIS LINE
        ]);
    }
}
