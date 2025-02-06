import tokenCreator from "../services/tokenCreator.js";

export default (message) => {
    const numbers = message.numbers;
    numbers.forEach(number => {
        tokenCreator(number);
    })
}
