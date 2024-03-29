<?php

namespace App\Dashboard\Board\Application\Controller;

use App\Dashboard\Board\Application\Dto\CreateColumnRequestDto;
use App\Dashboard\Board\Application\Model\Command\CreateColumnCommand;
use App\Dashboard\Board\Domain\Entity\ValueObject\BoardId;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnColor;
use App\Dashboard\Board\Domain\Entity\ValueObject\ColumnName;
use App\Dashboard\Board\Domain\Redis\BoardRedisInterface;
use App\Dashboard\Shared\Application\Service\DashboardServiceInterface;
use App\Shared\Application\Bus\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class CreateColumnController extends AbstractController
{
    public function __construct(
        private readonly DashboardServiceInterface $dashboardService,
        private readonly CommandBusInterface $commandBus,
        private readonly BoardRedisInterface $boardRedis
    ) {
    }

    /**
     * @throws Throwable
     */
    #[Route('/api/board/{boardId}/column', name: 'app_post_board_column', methods: ['POST'])]
    public function index(string $boardId, #[MapRequestPayload] CreateColumnRequestDto $createColumnRequestDto): JsonResponse
    {
        $user = $this->dashboardService->findUser();

        $createColumnCommand = new CreateColumnCommand(
            $user->id(),
            new BoardId($boardId),
            new ColumnName($createColumnRequestDto->getName()),
            new ColumnColor($createColumnRequestDto->getColor())
        );

        $this->commandBus->dispatch($createColumnCommand);

        $this->boardRedis->clearCache();

        return new JsonResponse(['message'=>'Column Created Successfully']);
    }
}