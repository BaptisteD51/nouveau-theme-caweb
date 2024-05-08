function openPage(pageName, elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";  // Initially hide all tab contents
      tabcontent[i].classList.remove("active");  // Remove active class
    }
  
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    document.getElementById(pageName).style.display = "block";
    document.getElementById(pageName).classList.add("active");  // Add active class to the tab content
    elmnt.className += " active";
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.tablink.active').click();
  });
  