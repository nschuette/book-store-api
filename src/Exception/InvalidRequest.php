<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

final class InvalidRequest extends Exception
{
    /** @var array<int, array<string, string>> */
    private array $errors;

    /** @param array<int, array<string, string>> $errors */
    private function __construct(array $errors)
    {
        parent::__construct('Invalid request', 1616237738);

        $this->errors = $errors;
    }

    /** @param mixed[] $errorMessages */
    public static function byErrorMessages(array $errorMessages): self
    {
        $errors = [];
        foreach ($errorMessages as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field'   => $field,
                    'message' => $message,
                ];
            }
        }

        return new self($errors);
    }

    /** @return array<int, array<string, string>> */
    public function getErrors(): array
    {
        return $this->errors;
    }
}