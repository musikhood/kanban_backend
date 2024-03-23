<?php

namespace App\Dashboard\Board\Application\Handler;

use App\Dashboard\Board\Application\Model\Command\UpdateColumnCommand;
use App\Dashboard\Board\Application\Model\Query\FindSingleBoardQuery;
use App\Dashboard\Board\Domain\Entity\Board;
use App\Dashboard\Board\Domain\Exception\ColumnNotFoundException;
use App\Dashboard\Board\Domain\Repository\BoardRepositoryInterface;
use App\Dashboard\Board\Domain\Repository\ColumnRepositoryInterface;
use App\Shared\Application\Bus\QueryBusInterface;
use App\Shared\Domain\Cqrs\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UpdateColumnHandler implements CommandHandlerInterface
{
    public function __construct(
        private BoardRepositoryInterface $boardRepository,
        private ColumnRepositoryInterface $columnRepository,
        private QueryBusInterface $queryBus
    )
    {
    }

    /**
     * @throws ColumnNotFoundException
     */
    public function __invoke(UpdateColumnCommand $updateColumnCommand): void
    {

        $board = $this->boardRepository->findOneBy([
            'id' => $updateColumnCommand->getBoardId(),
            'userId' => $updateColumnCommand->getUserId()
        ]);

        $column = $board->changeColumn(
            $updateColumnCommand->getColumnId(),
            $updateColumnCommand->getColumnName(),
            $updateColumnCommand->getColumnColor()
        );

        $this->columnRepository->save($column);
    }
}