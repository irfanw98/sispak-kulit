const menuToggle = document.querySelector(".menu-toggle input");
const nav = document.querySelector("nav");
const navLogo = document.querySelector("nav .logo");
const navUl = document.querySelector("nav ul");

menuToggle.addEventListener("click", function () {
    nav.classList.toggle("color");
    navUl.classList.toggle("slide");
    navLogo.classList.toggle("logoSlide");
});
