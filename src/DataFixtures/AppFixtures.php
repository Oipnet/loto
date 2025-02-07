<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Prize;
use App\Entity\User;
use App\Enum\GameState;
use App\Enum\PrizeState;
use App\Enum\WinningCondition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $date = new \DateTime();
        $date->setDate(2025, 2, 8);

        $game = new Game();
        $game->setOwner($user);
        $game->setName('Loto APE Barsacaise 2024');
        $game->setDate($date);
        $game->setState(GameState::PENDING);

        $prize = new Prize();
        $prize->setTitle('1er lot');
        $prize->setSort(1);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('2eme lot');
        $prize->setSort(2);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('3eme lot');
        $prize->setSort(3);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('4eme lot');
        $prize->setSort(4);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('5eme lot');
        $prize->setSort(5);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('6eme lot');
        $prize->setSort(6);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('7eme lot');
        $prize->setSort(7);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('8eme lot');
        $prize->setSort(8);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('9eme lot');
        $prize->setSort(9);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('10eme lot');
        $prize->setSort(10);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('11eme lot');
        $prize->setSort(11);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('12eme lot');
        $prize->setSort(12);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('Mitraillette 1');
        $prize->setSort(13);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('Mitraillette 2');
        $prize->setSort(14);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('13eme lot');
        $prize->setSort(15);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('14eme lot');
        $prize->setSort(16);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('15eme lot');
        $prize->setSort(17);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('16eme lot');
        $prize->setSort(18);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('17eme lot');
        $prize->setSort(19);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('18eme lot');
        $prize->setSort(20);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('19eme lot');
        $prize->setSort(21);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('20eme lot');
        $prize->setSort(22);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('21eme lot');
        $prize->setSort(23);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('22eme lot');
        $prize->setSort(24);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('23eme lot');
        $prize->setSort(25);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::LINE);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('24eme lot');
        $prize->setSort(25);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $prize = new Prize();
        $prize->setTitle('25eme lot');
        $prize->setSort(27);
        $prize->setState(PrizeState::PENDING);
        $prize->setWinningCondition(WinningCondition::CARD);
        $game->addPrize($prize);

        $manager->persist($game);
        $manager->flush();
    }
}
