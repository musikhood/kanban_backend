<?php

namespace App\Dashboard\Board\Application\Controller;

use App\Dashboard\Board\Application\Dto\UpdateColumnRequestDto;
use App\Dashboard\Board\Application\Model\Command\UpdateColumnCommand;
use App\Dashboard\Board\Domain\Entity\ValueObject\BoardId;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnColor;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnId;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnName;
use App\Dashboard\Board\Domain\Redis\BoardRedisInterface;
use App\Dashboard\Shared\Application\Service\DashboardServiceInterface;
use App\Shared\Application\Bus\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UpdateColumnController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly DashboardServiceInterface $dashboardService,
        private readonly BoardRedisInterface $boardRedis
    )
    {
    }

    #[Route('/api/board/{boardId}/column/{columnId}', name: 'app_put_board_column', methods: ['PUT'])]
    public function index(string $boardId, string $columnId,  #[MapRequestPayload] UpdateColumnRequestDto $updateColumnRequestDto): Response{
        $user = $this->dashboardService->findUser();

        $updateColumnCommand = new UpdateColumnCommand(
            $user->id(),
            new BoardId($boardId),
            new ColumnId($columnId),
            new ColumnName($updateColumnRequestDto->getName()),
            new ColumnColor($updateColumnRequestDto->getColor())
        );

        $this->commandBus->dispatch($updateColumnCommand);

        $this->boardRedis->clearCache();

        return new JsonResponse(['message'=>'Column Updated Successfully']);
    }
}