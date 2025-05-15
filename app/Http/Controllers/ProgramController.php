<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App; // <-- Import App facade (or use app() helper

class ProgramController extends Controller
{
    public function show(string $slug): InertiaResponse
    {

        $item = Cache::rememberForever('program.' . '.' . $slug,
            function () use ($slug) { // Pass locale into
                $program = Program::publishedInListings()
                ->forSlug($slug)
                ->first();

                if (!$program) {
                    return null;
                }

                $program->load( 'medias', 'blocks');
                // Pass locale explicitly if computeBlocks needs it immediately
                // though it defaults to app()->getLocale() anyway
                $program->computeBlocks();
                return $program;
            });
            if (!$item) {
                abort(404, 'Program not found');
            }

            return Inertia::render('Programs', [
                'item' => $item->only($item->publicAttributes),
            ]);
        }
    }