<?php

namespace Gtrig\PageBuilder;

use Illuminate\Support\Arr;
use Laravel\Nova\Fields\Expandable;
use Laravel\Nova\Fields\Field;

class PageBuilder extends Field
{
    use Expandable;
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'page-builder';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->hideFromIndex();
    }

    /**
     * Prepare the element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'shouldShow' => $this->shouldBeExpanded(),
        ]);
    }
}
