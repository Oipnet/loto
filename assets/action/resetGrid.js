export default (_) => {
    const tokens = [...document.querySelectorAll('#token-container div')]
    const hilightdCells = [...document.querySelectorAll('#grid .cell.highlight')]
    const infoNumber = document.querySelector('#game-info .info-number')

    tokens.forEach(token => {
        token.remove()
    })

    hilightdCells.forEach(cell => {
        cell.classList.remove('highlight')
    })

    infoNumber.innerText = ''
}
