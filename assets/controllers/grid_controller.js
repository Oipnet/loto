import { Controller } from '@hotwired/stimulus';
import gridGenerator from "../services/gridGenerator.js";
import mercure from '../services/mercure.js'
import tokenCreator from "../services/tokenCreator.js";

export default class extends Controller {
  static targets = ["grid"];
  connect() {
    document.addEventListener("DOMContentLoaded", () => {
      const rows = 10; // Nombre de lignes
      const cols = 10; // Nombre de colonnes
      const url = JSON.parse(document.getElementById("mercure-url").textContent)

      gridGenerator(cols, rows, this.gridTarget);
      mercure(url);

      // setInterval(() => {
      //   const randomNumber = Math.floor(Math.random() * (rows * cols)) + 1;
      //   tokenCreator(randomNumber)
      // }, 3000);
    });
  }
}
