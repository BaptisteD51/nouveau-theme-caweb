(function languageSwitcher(){
    var button = document.querySelector("li.active-language a")
    var subMenu = document.querySelector("li.other-languages")
    var chevron = document.querySelector("li.active-language i")
    
    subMenu.style.display = "none"

    button.addEventListener('click', function(){
        if(subMenu.style.display == "none"){
            subMenu.style.display = ""
            chevron.classList.value = "fa-solid fa-chevron-up"
        }else if(subMenu.style.display != "none"){
            subMenu.style.display = "none"
            chevron.classList.value = "fa-solid fa-chevron-down"
        }
    })

    document.addEventListener('click', function(event){
        if((event.target != button) && (!button.contains(event.target))){
            subMenu.style.display = "none"
            chevron.classList.value = "fa-solid fa-chevron-down"
        }
    })
})()