<?php

namespace App\Controller;

use App\Entity\Game;
use App\Enum\GameState;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\WorkflowInterface;

final class GameController extends AbstractController
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly ClockInterface $clock,
        private WorkflowInterface       $gamePreparingStateMachine,
        private Security $security
    )
    {
    }
    #[Route('/loto', name: 'app_game')]
    public function index(): Response
    {
        $startDate = $this->clock->now()->setTime(0, 0);
        $games = $this->gameRepository->findGameFromDate($startDate);

        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/loto/create', name: 'app_game_create')]
    public function create(Request $request): Response
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game->setState(GameState::PREPARING);
            $game->setOwner($this->security->getUser());

            $this->gameRepository->save($game, true);

            return $this->redirectToRoute('app_game');
        }

        return $this->render('game/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/loto/{game}/edit', name: 'app_game_edit')]
    public function edit(
        Request $request,
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game
    ): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->gameRepository->save($game, true);

            return $this->redirectToRoute('app_game');
        }

        return $this->render('game/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/loto/{game}', name: 'app_game_show')]
    public function show(
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game
    ): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/loto/{game}/next', name: 'app_game_next')]
    public function start(
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game
    ): Response
    {
        try {
            $nextTransitions = $this->gamePreparingStateMachine->getEnabledTransitions($game);
            $this->gamePreparingStateMachine->apply($game, $nextTransitions[0]->getName());

            $this->gameRepository->save($game, true);

            if ($nextTransitions[0]->getName() === 'to_in_progress') {
                return $this->redirectToRoute('app_home');
            }

            return $this->redirectToRoute('app_game');
        } catch (LogicException $exception) {
            $this->addFlash('error', $exception->getMessage());
        }
    }

    #[Route('/loto/{game}/play', name: 'app_game_play')]
    public function play(
        #[MapEntity(mapping: ['game' => 'slug'])]
        Game $game
    )
    {
        return $this->render('game/play.html.twig');
    }
}
