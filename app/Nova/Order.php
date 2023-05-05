<?php

namespace App\Nova;

use App\Models\Product;
use Eshop\OrderBuilder\OrderBuilder;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Order>
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $group = 'Orders';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Customer')->searchable()->showCreateRelationButton(),
			BelongsTo::make('Store'),
            Text::make('External Code'),
			Date::make('Date')->required(),
            Select::make('Time')->options([
                'after 8:00' => 'after 8:00',
                'after 12:00' => 'after 12:00',
                'after 15:00' => 'after 15:00',
            ])->required(),
            Select::make('Payment Status')->options([
                'paid' => 'Paid',
                'unpaid' => 'Unpaid',
            ])->required(),
            Select::make('Status')->options([
                'initiated' => 'initiated',
                'pending' => 'Pending',
                'waitingprice' => 'Waiting Price',
                'processing' => 'Processing',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required(),

            OrderBuilder::make('Order Items')->products(Product::with(['variants','variants.options'])->get()),
            Number::make('Subtotal')->step(0.01)->exceptOnForms(),
            Number::make('Tax')->step(0.01)->exceptOnForms(),
            Number::make('Total')->step(0.01)->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
