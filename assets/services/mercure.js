import gameHandler from "../handler/game-handler.js";
export default (url) => {
    const eventSource = new EventSource(url);
    eventSource.onmessage = (event) => {
        const message = JSON.parse(event.data);

        gameHandler.handle(message);
    }
}
