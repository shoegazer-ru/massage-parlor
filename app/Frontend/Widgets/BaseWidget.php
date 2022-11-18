<?php

namespace App\Frontend\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Throwable;

/**
 * [Description ModelList]
 */
abstract class BaseWidget extends AbstractWidget
{
    /**
     * Пришлось так делать, т.к. в app/exceptions любое исключение приходит как ViewException
     * @param Throwable $e
     * 
     * @return [type]
     */
    protected function handleException(Throwable $e)
    {
        // if ($e instanceof AdminModelNotFoundException) {
        //     return view('admin.errors.404', [
        //         'message' => $e->getMessage()
        //     ]);
        // }

        throw $e;
    }
}
