var burger = document.getElementById("burger");
var menu = document.getElementById("main-menu");
var iLogo = burger.children[0]

burger.addEventListener('click', function () {
    if (menu.style.display == "none" || menu.style.display == '') {
        menu.style.display = "block"
        iLogo.classList.value = "fa-solid fa-xmark"
    } else if (menu.style.display != "none" || menu.style.display != '') {
        menu.style.display = "none"
        iLogo.classList.value = "fa-solid fa-bars"
    }
})

window.addEventListener('resize', function () {
    menu.style = null
    iLogo.classList.value = "fa-solid fa-bars"
})