export default (message) => {
    const prize = message.prize;

    const prizeTitle = document.getElementById('prize-title');
    const prizeDescription = document.getElementById('prize-description');
    const prizeWiningCondition = document.getElementById('prize-winning-condition');
    const nextPrize = document.getElementById('next-prize');

    prizeTitle.innerText = prize.title;
    prizeWiningCondition.innerText = prize.winningCondition;
    prizeDescription.innerText = prize.description;
    nextPrize.innerText = prize.nextPrize.title;
}
