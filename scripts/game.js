const pushClick = (e) => {
  let x = e.target.dataset.posX
  let y = e.target.dataset.posY
  let color = e.target.dataset.color

  console.log(x, y)
  location.href = `/game/game.php?x=${x}&y=${y}&color=${color}`
}

addEventListener('DOMContentLoaded', () => {
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('cell')) {
      pushClick(e)
    }
  })
})
