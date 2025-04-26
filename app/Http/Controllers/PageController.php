<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PageController extends Controller
{
    public function show(string $slug): InertiaResponse
    {
        $item = Cache::rememberForever('page.' . app()->getLocale() . '.' . $slug, 
        function ( ) use ($slug){
            $item = Page::publishedInListings()
        ->forSlug($slug)
        ->first();

        if($item !== null){
            $item->load('translations', 'medias', 'blocks');
        }
return $item;
    }
);
        return Inertia::render('Page', [
            'item'=>$item->only($item->publicAttributes),
        ]);
    }
}