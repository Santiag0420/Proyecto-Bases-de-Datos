const buttonMyFiles = document.getElementById("buttonMyFiles");
const buttonShareWithMe = document.getElementById("buttonShareWithMe");
const sectionMyFiles = document.getElementById("sectionMyFiles");
const sectionSharedWithMe = document.getElementById("sectionSharedWithMe");
sectionSharedWithMe.style.display = 'none';
buttonMyFiles.addEventListener("click", (e) =>{
    e.preventDefault();
    sectionMyFiles.style.display = 'block';
    sectionSharedWithMe.style.display = 'none';
    
})

buttonShareWithMe.addEventListener("click", (e) =>{
    e.preventDefault();
    sectionSharedWithMe.style.display = 'block';
    sectionMyFiles.style.display = 'none';
    
})