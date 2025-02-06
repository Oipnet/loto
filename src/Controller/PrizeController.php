<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Prize;
use App\Entity\PrizeNumber;
use App\Enum\PrizeState;
use App\Form\PrizeNumberType;
use App\Mapper\MarkPrizeNumberMercureMapper;
use App\Mapper\ResendPrizeMercureMapper;
use App\Mapper\ResetPrizeMercureMapper;
use App\Mapper\StartPrizeMercureMapper;
use App\Processor\MercureProcessor;
use App\Provider\CurrentRouteProvider;
use App\Provider\NextPrizeProvider;
use App\Repository\PrizeNumberRepository;
use App\Repository\PrizeRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Workflow\WorkflowInterface;

class PrizeController extends AbstractController
{
    public function __construct(
        private MercureProcessor $mercureProcessor,
        private CurrentRouteProvider $currentRouteProvider,
        private NextPrizeProvider $nextPrizeProvider,
        private ResetPrizeMercureMapper $resetPrizeMercureMapper,
        private PrizeRepository $prizeRepository,
        private PrizeNumberRepository $prizeNumberRepository,
        private WorkflowInterface $prizeLifecycleStateMachine,
    )
    {
    }

    #[Route('/game/{game}/prize/{prize}', name: 'app_prize_show')]
    public function show(
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game,
        #[MapEntity(mapping: ['prize' => 'slug'])]
        Prize $prize,
        Request $request,
        StartPrizeMercureMapper $startPrizeMercureMapper,
        MarkPrizeNumberMercureMapper $markPrizeNumberMercureMapper,
    ): Response
    {
        $topic = $this->currentRouteProvider->provide();

        if ($prize->getState() === PrizeState::PENDING) {
            $this->mercureProcessor->process(
                $topic,
                $startPrizeMercureMapper->map($prize)
            );

            $this->prizeLifecycleStateMachine->apply($prize, 'to_in_progress');
            $this->prizeRepository->save($prize);
        }

        $prizeNumber = new PrizeNumber();
        $prizeNumber->setPrize($prize);

        $form = $this->createForm(PrizeNumberType::class, $prizeNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->prizeNumberRepository->save($prizeNumber);

            $this->mercureProcessor->process(
                $topic,
                $markPrizeNumberMercureMapper->map($prizeNumber)
            );

            return $this->redirectToRoute('app_prize_show', ['prize' => $prize->getSlug(), 'game' => $game->getSlug()]);
        }

        return $this->render('prize/show.html.twig', [
            'prize' => $prize,
            'form' => $form,
        ]);
    }

    #[Route('/game/{game}/prize/{prize}/next', name: 'app_prize_next')]
    public function next(
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game,
        #[MapEntity(mapping: ['prize' => 'slug'])]
        Prize $prize,
        ResetPrizeMercureMapper $resetPrizeMercureMapper,
    ): Response
    {
        $topic = $this->currentRouteProvider->provide();

        $this->prizeLifecycleStateMachine->apply($prize, 'to_in_finish');
        $this->prizeRepository->save($prize);

        $this->mercureProcessor->process(
            $topic,
            $resetPrizeMercureMapper->map()
        );

        $nextPrize = $this->nextPrizeProvider->provide($prize);

        return $this->redirectToRoute('app_prize_show', ['prize' => $nextPrize->getSlug(), 'game' => $game->getSlug()]);
    }

    #[Route('/game/{game}/prize/{prize}/resend', name: 'app_prize_resend')]
    public function resend(
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game,
        #[MapEntity(mapping: ['prize' => 'slug'])]
        Prize $prize,
        ResendPrizeMercureMapper $resendPrizeMercureMapper,
        StartPrizeMercureMapper $startPrizeMercureMapper,
    ): Response
    {
        $topic = $this->currentRouteProvider->provide();

        $this->mercureProcessor->process(
            $topic,
            $resendPrizeMercureMapper->map($prize)
        );

        $this->mercureProcessor->process(
            $topic,
            $startPrizeMercureMapper->map($prize)
        );

        return $this->redirectToRoute('app_prize_show', ['prize' => $prize->getSlug(), 'game' => $game->getSlug()]);
    }
}
