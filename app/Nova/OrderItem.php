<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Textarea;

class OrderItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OrderItem>
     */
    public static $model = \App\Models\OrderItem::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    //Hide from side menu
    public static $displayInNavigation = true;

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
            BelongsTo::make('Order'),
            BelongsTo::make('Product'),
            BelongsTo::make('Variant'),
            Number::make('Quantity'),
            Number::make('Price')->step(0.01),
			Textarea::make('comments'),
			Textarea::make('additional_comments'),
			Image::make('additional_image')->thumbnail(function($value) {
				return $value;
			})->preview(function($value) {
				return $value;
			}),
            Number::make('Tax')->step(0.01),
            Number::make('subtotal')->step(0.01),
            Number::make('Total')->step(0.01),
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
