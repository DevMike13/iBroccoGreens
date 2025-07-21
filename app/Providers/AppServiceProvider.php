<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_END,
            fn (): string => Blade::render('<livewire:filament.custom-notification />')
        );
        
        
        FilamentView::registerRenderHook(
            'panels::auth.login.form.after',
            fn (): View => view('filament.login-extra')
        );

        FilamentView::registerRenderHook(
            'panels::auth.register.form.after',
            fn (): View => view('filament.login-extra')
        );
        FilamentView::registerRenderHook(
            PanelsRenderHook::USER_MENU_BEFORE,
            fn (): string => Blade::render('<livewire:components.notification-bell />')
        );
        

        // FilamentView::registerRenderHook(
        //     PanelsRenderHook::USER_MENU_BEFORE,
        //     fn (): string => Blade::render('
        //         <button 
        //             x-data 
        //             x-on:click="$dispatch(\'toggle-custom-sidebar\')" 
        //             class="relative mr-3 text-gray-600 hover:text-primary-600 dark:text-gray-300"
        //             title="Open Notifications"
        //         >
        //             <x-heroicon-o-bell class="w-5 h-5" />
        //             <span 
        //                 class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full"
        //             >
        //                 3
        //             </span>
        //         </button>
        //     ')
        // );        
    }
}
