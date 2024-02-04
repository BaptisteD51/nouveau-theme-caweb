var burger = document.getElementById("burger");
var menu = document.getElementById("main-menu");
var iLogo = burger.children[0]
var dropLis = menu.querySelectorAll("li.menu-item-has-children")

/**
 * Js for burger
 */
burger.addEventListener('click', function () {
    if (menu.style.display == "none" || menu.style.display == '') {
        menu.style.display = "block"
        iLogo.classList.value = "fa-solid fa-xmark"
        document.body.classList.add("menu-open")
    } else if (menu.style.display != "none" || menu.style.display != '') {
        menu.style.display = "none"
        iLogo.classList.value = "fa-solid fa-bars"
        document.body.classList.remove("menu-open")
    }
})

/**
 * Js for the folding sub menu on mobile
 */
dropLis.forEach(function(dropLi){
    var arrowDown = document.createElement('i')
    arrowDown.classList.value = "fa-solid fa-chevron-down menu-arrow"
    
    var ul = dropLi.querySelector("ul")
    dropLi.insertBefore(arrowDown,ul)

    arrowDown.addEventListener("click", function(){
        if(ul.style.display == 'none' || ul.style.display == ''){
            ul.style.display="block";
            arrowDown.classList.value = "fa-solid fa-chevron-up menu-arrow"
        }else if(ul.style.display != "none" || ul.style.display != ''){
            ul.style.display="none";
            arrowDown.classList.value = "fa-solid fa-chevron-down menu-arrow"
        }
    })
})

/** 
 * Close and reset menu on resize
*/
window.addEventListener('resize', function () {
    menu.style = null
    iLogo.classList.value = "fa-solid fa-bars"
    
    dropLis.forEach(function(dropLi){
        var ul = dropLi.querySelector('ul')
        ul.style = null

        var i = dropLi.querySelector('i')
        i.style = null
        i.classList.value = "fa-solid fa-chevron-down menu-arrow"
    })
})