<?php

namespace App\Http\Controllers;
use App\Models\News;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(): InertiaResponse
    {
$newsItems = News::publishedInListings()
            ->orderBy('date', 'desc')
            ->with('medias')
            ->paginate(10);
        return Inertia::render('News/Index', [
        
            'items' => $newsItems->map(function (News $item) {
                return $item->only($item->publicAttributes);
            }),
            'paginator' => [
                'currentPage' => $newsItems->currentPage(),
                'lastPage' => $newsItems->lastPage(),
                'total' => $newsItems->total(),
            ],
        ]);
    }
    public function show(string $slug): InertiaResponse
    {
        $item = News::publishedInListings()->forSlug($slug)->firstOrFail();
        return Inertia::render('News/Show', [
            'item' => $item->only($item->publicAttributes),
        ]);
    }
}