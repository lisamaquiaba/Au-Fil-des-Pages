const nav = document.querySelector(".nav-mobile");
const buttonNav = document.querySelector(".nav-toggle");

buttonNav.addEventListener("click", () => {
  console.log("cpicpi")
  nav.classList.toggle("toggle-menu");
});
