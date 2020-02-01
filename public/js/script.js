function handleOneBox(){
    document.addEventListener("click",(e)=>{
    let identityClass = e.target.classList[1];
    // Open button
    let openBtn = document.getElementsByClassName(identityClass)[0];
    // Close button
    let closeBtn = document.getElementsByClassName(identityClass)[1];
    // Form
    let form = document.getElementsByClassName(identityClass)[2];
    
    // Add project
    if(e.target.classList.contains("open-add-project")){
      form.style.display = "block";
      closeBtn.style.display = "block"
      openBtn.style.display = "none"
    }

    if(e.target.classList.contains("close-add-project")){
      form.style.display = "none";
      closeBtn.style.display = "none"
      openBtn.style.display = "block"
    }

    // Add Task
    if(e.target.classList.contains("add-task-open")){
      form.style.display = "block";
      closeBtn.style.display = "block"
      openBtn.style.display = "none"
    }

    if(e.target.classList.contains("add-task-close")){
      form.style.display = "none";
      closeBtn.style.display = "none"
      openBtn.style.display = "block"
    }
  })
  }
  handleOneBox();
  
function handleMultipleBoxes(){
    document.addEventListener("click",(e)=>{
        let id = e.target.classList[1]
        let box = document.getElementsByClassName(id)[1];
      
      // Note box
      if(e.target.classList.contains("open-note-box")){
         if(box.style.display === "block"){
            box.style.display = "none"
         }
         else{
            box.style.display = "block"
         }
      }
      if(e.target.classList.contains("close-note-box")){
        box.style.display = "none";
      }
      
      // Project box
      if(e.target.classList.contains("open-edit-project")){
        box.style.display = "block";
      }

      if(e.target.classList.contains("close-edit-project")){
        box.style.display = "none";
      }
      
    })
}
  handleMultipleBoxes();







