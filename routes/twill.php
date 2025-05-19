<?php

use A17\Twill\Facades\TwillRoutes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Twill\Base\PreviewController;

Route::get('preview', PreviewController::class)->name('preview');

// Register Twill routes here eg.
// TwillRoutes::module('posts');
Route::group(['prefix'=>'content'], function(){
    TwillRoutes::module('pages');
 
});

TwillRoutes::singleton('pageHome');
TwillRoutes::module('menuLinks');
TwillRoutes::module('profiles');
TwillRoutes::module('programs');
TwillRoutes::module('news');