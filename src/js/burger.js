function toggleBurgerMenu() {
  document
    .getElementById("burgermenu")
    .classList.toggle("[&>*:nth-child(2)]:opacity-0");
  document
    .getElementById("burgermenu")
    .classList.toggle("[&>*:nth-child(1)]:translate-y-2");
  document
    .getElementById("burgermenu")
    .classList.toggle("[&>*:nth-child(1)]:rotate-45");
  document
    .getElementById("burgermenu")
    .classList.toggle("[&>*:nth-child(3)]:-translate-y-2");
  document
    .getElementById("burgermenu")
    .classList.toggle("[&>*:nth-child(3)]:-rotate-45");
  document.getElementById("displaymenu").classList.toggle("hidden");
}
