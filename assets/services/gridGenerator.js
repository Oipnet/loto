export default (cols, rows, grid) => {
    for (let row = 0; row < rows; row++) {
        for (let col = 0; col < cols; col++) {
            const number = col * rows + row; // Calcul du numéro (vertical)
            const cell = document.createElement("div");
            cell.classList.add("cell");
            if (number > 0) {
                cell.textContent = number; // Ajouter le numéro dans la cellule
                cell.dataset.number = number;
            }
            // Ajouter un attribut data-number
            grid.appendChild(cell);
        }
    }
};
