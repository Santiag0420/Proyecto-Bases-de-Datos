formVerification = document.getElementById('formVerification');
emailUser = document.getElementById('emailUser');
const email = localStorage.getItem('mail');

emailUser.innerHTML = ``+email;
formVerification.addEventListener('submit', function (event) {
    event.preventDefault();
    var datos = new FormData(formVerification);
    datos.append('email', email);
    fetch("includes/verificationUsers.php", {
        method: 'POST',
        body: datos
    })
    .then(resp => resp.json())
    .then(data => {
        console.log(data);
        if(data === "verificationSucessfully"){
            location.href = "loginPrueba.html";
        }else{
            
        }
    })
}) 