import startPrice from "../action/startPrice.js";
import markNumber from "../action/markNumber.js";
import resetGrid from "../action/resetGrid.js";
import resendGrid from "../action/resendGrid.js";

const gameHandler = {
    _commands : {
        'start': (message) => startPrice(message),
        'mark-number': (message) => markNumber(message),
        'reset-grid': (message) => resetGrid(message),
        'resend-grid': (message) => resendGrid(message)
    },
    handle: (message) => {
        const action = gameHandler._commands[message.action];
        if (action) {
            action(message);
        } else {
            console.error(`No handler for action ${message.action}`);
        }
    }
}

export default gameHandler;
