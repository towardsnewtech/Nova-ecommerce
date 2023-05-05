<?php

namespace App\Providers;

use App\Nova\Category;
use App\Nova\Customer;
use App\Nova\Dashboards\Main;
use App\Nova\Order;
use App\Nova\Product;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::footer(function (Request $request) {
            return Blade::render('<p class="text-center">Developed by Fosetico for SunFresh {!! date("Y") !!}</p>');
        });

        // $this->getCustomMenu();

        // Nova::mainMenu(function (Request $request) {
        //     return [
                
        //         MenuSection::dashboard(Main::class)->icon('chart-bar'),

        //         // MenuSection::make('Customers', [
        //         //     MenuItem::resource(Trip::class),
        //         //     MenuItem::resource(Customer::class),
        //         //     MenuItem::resource(Ticket::class),
        //         // ])->icon('user')->collapsable(),

        //         // MenuSection::make('Manage', [
        //         //     MenuItem::resource(Route::class),
        //         //     MenuItem::resource(InventoryItem::class),
        //         //     MenuItem::resource(Vessel::class),
        //         // ])->icon('document-text')->collapsable(),

        //         // MenuSection::make('User Management', [
        //         //     MenuItem::resource(User::class),
        //         // ])->icon('user')->collapsable(),
        //     ];
        // });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {        
        return [
            // ...
            \Outl1ne\MenuBuilder\MenuBuilder::make()
            ->icon('adjustments') // Customize menu icon, supports heroicons
            ->hideMenu(false) // Hide MenuBuilder defined MenuSection.
        ];

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function getCustomMenu()
    {
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),
                MenuSection::make('Orders', [
                    MenuItem::resource(Order::class, 'Orders'),
                    MenuItem::resource(Customer::class, 'Customers'),
                ]),
                MenuSection::make('Inventory', [
                    MenuItem::resource(Category::class, 'Categories'),
                    MenuItem::resource(Product::class, 'Products'),
                ]),
            ];
        });
    }
}
