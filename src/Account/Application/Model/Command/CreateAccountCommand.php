<?php

namespace App\Account\Application\Model\Command;
use App\Shared\Application\Cqrs\CommandInterface;
use SensitiveParameter;

readonly class CreateAccountCommand implements CommandInterface
{
    public function __construct(
        private string $email,
        private array $roles,
        #[SensitiveParameter]
        private string $password
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}