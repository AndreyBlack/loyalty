<?php

namespace App\Exceptions;

use App\Exceptions\Contracts\DontReportException;
use Exception;
use Illuminate\Http\Response;
use Throwable;

class BadRequestException extends Exception implements DontReportException
{
    protected array $data = [];

    public function __construct(string $message = '', int $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message ?: $this->getDefaultMessage(), $code, $previous);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    protected function getDefaultMessage(): string
    {
        return __('common.error_default');
    }
}
