<?php

namespace App\Exceptions\Loyalty;

use Exception;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LoyaltyException extends Exception
{
    public function __construct(string $message = '', int $code = Response::HTTP_UNPROCESSABLE_ENTITY, Throwable $previous = null)
    {
        parent::__construct($message ?: __('common.error_default'), $code, $previous);
    }

    public function report()
    {
        Log::error($this->getMessage(), ['exception' => $this]);
    }
}
