function openProjectForm(){
    let form = document.getElementById("project-form");
    let openButton = document.getElementById("open-form-btn");
    openButton.addEventListener("click",()=>{
      form.style.display="block";
    })  
  }
  openProjectForm();
  
  function closeProjectForm(){
    let form = document.getElementById("project-form");
    let closeButton = document.getElementById("close-form-btn");
    closeButton.addEventListener("click",()=>{
      form.style.display="none";
    })  
  }
  closeProjectForm();


function handleCommentBox(){
  document.addEventListener("click",(e)=>{
      let taskID = e.target.classList[1]
      let commentBox = document.getElementsByClassName(taskID)[1];
    if(e.target.classList.contains("open-comment-box")){
      commentBox.style.display = "block";
    }
    else if(e.target.classList.contains("close-comment-box")){
      commentBox.style.display = "none";
    }
    
  })
}
handleCommentBox();


