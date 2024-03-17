<?php

namespace App\Board\Application\Model\Command;

use App\Board\Domain\Entity\Board;
use App\Board\Domain\Entity\BoardId;
use App\Board\Domain\Entity\ColumnName;
use App\Shared\Application\Cqrs\CommandInterface;
use App\Shared\Domain\ValueObject\UserId;

readonly class CreateColumnCommand implements CommandInterface
{
    public function __construct(
        private UserId $userId,
        private BoardId $boardId,
        private ColumnName $name,
    )
    {
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