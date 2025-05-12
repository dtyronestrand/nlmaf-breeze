<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function show(string $slug): InertiaResponse
    {
        // Get the current locale
        $locale = App::getLocale(); // Or use app()->getLocale()

        $item = Cache::rememberForever('program.' . $locale . '.' . $slug,
            function () use ($slug, $locale) { // Pass locale into closure if needed inside
                $item = Program::publishedInListings()
                    ->forSlug($slug)
                    ->first();

                if ($item !== null) {
                    $item->load( 'medias', 'blocks');
                    // Pass locale explicitly if computeBlocks needs it immediately
                    // though it defaults to app()->getLocale() anyway
                    $item->computeBlocks($locale);
                }
                return $item;
            }
        );

        // Add check for null item after cache retrieval
        abort_if($item === null, Response::HTTP_NOT_FOUND);

        return Inertia::render('Programs', [ 
            'item' => $item->only($item->publicAttributes),
            'locale' => $locale, // <--- ADD THIS LINE
        ]);
    }
}