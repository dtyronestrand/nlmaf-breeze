<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Database\Eloquent\Relations\Relation;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        TwillNavigation::addLink(
            NavigationLink::make()
            ->title(Str::ucfirst(__('content')))
            ->forModule('pages')
            ->donotAddSelfAsFirstChild()
            ->setChildren([
                NavigationLink::make()
                ->title(Str::ucfirst(__('home')))
                ->forSingleton('pageHome'),
                NavigationLink::make()
                ->title(Str::ucfirst(__('pages')))
                ->forModule('pages'),
            ]),
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('menuLinks')->title(Str::ucfirst(__('Menu')))
        );
        Relation::enforceMorphMap([
            'page'=>'App\Models\Page',
            'pageHome'=>'App\Models\PageHome',
            'menuLink'=>'App\Models\MenuLink',
        ]);
    }
}
