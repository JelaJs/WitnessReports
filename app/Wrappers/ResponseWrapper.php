<?php

namespace App\Wrappers;

use JsonSerializable;
class ResponseWrapper implements JsonSerializable
{
    public function __construct(
        private int $status,
        private mixed $data = null,
        private mixed $errors = null,
    ) {}

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getErrors(): array
    {
        if (is_array($this->errors)) {
            return $this->errors;
        }

        return [
            $this->errors
        ];
    }

    public function jsonSerialize(): array
    {
        return ($this->getStatus() >= 200 && $this->getStatus() < 300) ? [
            'success' => true,
            'data' => $this->getData(),
        ] : [
            'success' => false,
            'errors' => $this->getErrors()
        ];
    }
}
