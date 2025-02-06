export default (number) => {
    const tokenContainer = document.getElementById('token-container')
    const token = document.createElement("div");
    const infoNumber = document.querySelector('.info-number')

    infoNumber.innerText = number;
    token.classList.add("token");
    token.id = `token-${number}`;

    tokenContainer.appendChild(token);
    token.textContent = number;

    // Animation d'apparition
    token.classList.add("animate-scale");

    // Attendre que l'animation d'apparition soit terminée
    setTimeout(() => {
        const targetCell = document.querySelector(`.cell[data-number="${number}"]`);

        if (targetCell) {
            const cellRect = targetCell.getBoundingClientRect(); // Position de la cellule
            const tokenRect = token.getBoundingClientRect();     // Position du jeton

            // Calculer la position finale
            const offsetX = cellRect.left + cellRect.width / 2 - (tokenRect.left + tokenRect.width / 2);
            const offsetY = cellRect.top + cellRect.height / 2 - (tokenRect.top + tokenRect.height / 2);

            // Appliquer les positions finales pour l'animation
            token.style.setProperty("--final-x", `${offsetX}px`);
            token.style.setProperty("--final-y", `${offsetY}px`);

            // Lancer l'animation de déplacement
            token.classList.remove("animate-scale");
            token.classList.add("animate-curve");

            // Mettre en surbrillance la cellule après l'animation
            setTimeout(() => {
                targetCell.classList.add("highlight");
            }, 1500); // Temps de l'animation
        }
    }, 500); // Temps correspondant à la durée de l'animation de scale
};
