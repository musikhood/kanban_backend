<?php

namespace App\Board\Application\Model\Query;

readonly class FindBoardQuery
{
    public function __construct(
        private string $boardId
    )
    {
    }

    public function getBoardId(): string
    {
        return $this->boardId;
    }
}