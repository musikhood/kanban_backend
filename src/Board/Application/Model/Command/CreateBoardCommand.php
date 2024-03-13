<?php

namespace App\Board\Application\Model\Command;

readonly class CreateBoardCommand
{
    public function __construct(
        private string $name,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}