var buttons = document.querySelectorAll(".subject-list button:not(#all)")
var intervenants = Array.from(document.querySelectorAll(".teacher-list>li"))
var buttonAll = document.getElementById('all');

buttons.forEach(function(button){
    button.addEventListener("click",function(){
        buttons.forEach((button)=>button.classList.remove('selected-subject'))
        buttonAll.classList.remove('selected-subject')
        button.classList.add('selected-subject')

        var hidden = intervenants.filter(function(intervenant){
            return !intervenant.classList.contains(button.id)
        })
        var shown = intervenants.filter(function(intervenant){
            return intervenant.classList.contains(button.id)
        })
        hidden.forEach((elmt) => elmt.style.display = 'none')
        shown.forEach((elmt) => elmt.style.display = '')
    })
})

buttonAll.addEventListener('click',function(){
    intervenants.forEach(function(intervenant){
        buttons.forEach((button)=>button.classList.remove('selected-subject'))
        buttonAll.classList.add('selected-subject')
        intervenant.style.display=""
    })
})