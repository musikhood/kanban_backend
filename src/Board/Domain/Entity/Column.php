<?php

namespace App\Board\Domain\Entity;

class Column
{
    public function __construct(
        private readonly ColumnId $id,
        private Board $board,
        private ColumnName $name
    )
    {
    }

    public function id(): ColumnId
    {
        return $this->id;
    }
    public function name(): ColumnName
    {
        return $this->name;
    }
    public function rename(ColumnName $name): void{
        $this->name = $name;
    }

    public function board(): Board
    {
        return $this->board;
    }
}