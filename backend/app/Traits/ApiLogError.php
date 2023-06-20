<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 *  ApiLogError is a trait the will used by all the model classes.
 */
trait ApiLogError
{
    /**
     * Handle api log errors.
     * @param  object  $mysqlError
     * @return  void
     */
    public function handleApiLogError($mysqlError)
    {
        $logError = [
            'code'        => $mysqlError->getCode(),
            'description' => $mysqlError->getMessage()
        ];
        Log::error($logError);
    }
}