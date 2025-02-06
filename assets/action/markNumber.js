import tokenCreator from "../services/tokenCreator.js";

export default (message) => {
  console.log(message);
    const prizeNumber = message.prizeNumber;
    tokenCreator(prizeNumber.number);
}
