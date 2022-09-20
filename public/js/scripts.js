window.onload = () => {
  let buttons = document.querySelectorAll(".form-check-input");

  for ( let button of buttons){
    button.addEventListener("click", activer)
  }
}

function activer(){
  let xmlhttp = new XMLHttpRequest;

  xmlhttp.open('GET', '/projectsIndex/practicePHP_OOP_MVC/public/admin/activeAnnonce/'+this.dataset.id)
  xmlhttp.send()

  
}