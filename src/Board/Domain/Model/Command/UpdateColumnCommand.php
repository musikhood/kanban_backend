<?php

namespace App\Board\Domain\Model\Command;

use App\Board\Domain\Entity\BoardId;
use App\Board\Domain\Entity\ColumnId;
use App\Board\Domain\Entity\ColumnName;
use App\Shared\Domain\Cqrs\CommandInterface;
use App\Shared\Domain\ValueObject\UserId;

readonly class UpdateColumnCommand implements CommandInterface
{
    public function __construct(
        private UserId $userId,
        private BoardId $boardId,
        private ColumnId $columnId,
        private ColumnName $columnName
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

    public function getColumnId(): ColumnId
    {
        return $this->columnId;
    }

    public function getColumnName(): ColumnName
    {
        return $this->columnName;
    }
}