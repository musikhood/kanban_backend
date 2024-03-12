<?php

namespace App\Shared\Domain\ValueObject;

abstract class EmailValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    protected function ensureIsValidEmail(string $email): void
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('The email <%s> is not valid', $email));
        }
    }
}