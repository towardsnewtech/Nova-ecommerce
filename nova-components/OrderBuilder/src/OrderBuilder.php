<?php

namespace Eshop\OrderBuilder;

use Laravel\Nova\ResourceTool;

class OrderBuilder extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Order Builder';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'order-builder';
    }
    
}
