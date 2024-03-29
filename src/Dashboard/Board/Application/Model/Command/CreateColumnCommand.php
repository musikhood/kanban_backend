<?php

namespace App\Dashboard\Board\Application\Model\Command;

use App\Dashboard\Board\Domain\Entity\ValueObject\BoardId;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnColor;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnName;
use App\Dashboard\User\Domain\Entity\UserId;
use App\Shared\Application\Cqrs\CommandInterface;

readonly class CreateColumnCommand implements CommandInterface
{
    public function __construct(
        private UserId   $userId,
        private BoardId     $boardId,
        private ColumnName  $name,
        private ColumnColor $color
    )
    {
    }

    public function getColor(): ColumnColor
    {
        return $this->color;
    }


    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getBoardId(): BoardId
    {
        return $this->boardId;
    }

    public function getName(): ColumnName
    {
        return $this->name;
    }
}