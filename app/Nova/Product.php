<?php

namespace App\Nova;

use Ardenthq\ImageGalleryField\ImageGalleryField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use OsTheNeo\NovaFields\BelongsToManyField;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Laravel\Nova\Fields\HasMany;
use Spatie\TagsField\Tags;
use ZiffMedia\NovaSelectPlus\SelectPlus;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group = 'Products';
    public static $resolveParentBreadcrumbs = false;



    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id,name',
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
            Panel::make('Basic Information',[
                ID::make()->sortable(),
                Text::make('External Code','ext_code'),
                Text::make('Name')->translatable()
                    ->sortable()
                    ->rules('required', 'max:255'),
                Trix::make('Description')->translatable(),
                Boolean::make('Active')
                ->default(1),
                BelongsToManyField::make('Categories', 'category', Category::class),
                Tags::make('Tags'),
                BelongsTo::make('Tax'),
                SelectPlus::make('Filters', 'filters', Filter::class),
            ]),
            Panel::make('Variants',[               
                HasMany::make('Variants', 'variants', Variant::class),
            ]),
            Panel::make('Images',[
                Images::make('Images', 'images') // second parameter is the media collection name
                ->conversionOnPreview('medium-size') // conversion used to display the "original" image
                ->conversionOnDetailView('thumb') // conversion used on the model's view
                ->conversionOnIndexView('thumb') // conversion used to display the image on the model's index page
                ->conversionOnForm('thumb') // conversion used to display the image on the model's form
                ->fullSize() // full size column
                // ->rules('required', 'size:3') // validation rules for the collection of images
                // validation rules for the collection of images
                ->singleImageRules('dimensions:min_width=100'),
          
                ]
            ),
            
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
        return [
            Breadcrumbs::make($request,$this)
        ];
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
