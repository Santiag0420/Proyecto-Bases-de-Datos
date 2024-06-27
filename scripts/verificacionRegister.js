
const modalRegister = new bootstrap.Modal(document.getElementById('modalRegister'))

var formVerification = document.getElementById('formVerification');
var emailUser = document.getElementById('emailUser');
var formRegister = document.getElementById('formRegister');
var userAlert = document.getElementById('userAlert');
var emailAlert = document.getElementById('emailAlert');
var emptyAlert = document.getElementById('emptyAlert');
var registerAccept = document.getElementById('registerAccept');

formRegister.addEventListener('submit', function(event){
    event.preventDefault();
    var datos = new FormData(formRegister);
    fetch('includes/verificacionRegister.php',{
        method: 'POST',
        body: datos
    })
        .then( res => res.json())
        .then( data => {
            if(data.response ==='verifyUser'){
                var user = new FormData();
                user.append('mail',data.mail);
                user.append('user',data.user);
                user.append('password',data.password);
                user.append('phone',data.phone);
                user.append('id',data.id);
                user.append('ocupation',data.ocupation);
                user.append('lifeInsurance',data.lifeInsurance);
                user.append('code',data.code);
                console.log(user);
                fetch('includes/mailVerificacionRegister.php',{
                    method:'POST',
                    body: user
                })
                    .then (resp => resp.json())
                    .then (responseMail => {     
                        if(responseMail === 'mailSend'){
                            modalRegister.show();
                            localStorage.setItem('mail', data.mail);
                            registerAccept.addEventListener("click", function(){
                                location.href = 'verification.html';
                            })
                        }else{
                            emailAlert.innerHTML =`
                                Ingrese un correo valido
                            `
                        }
                }) 
            }else if(data.response==='userRegistered'){
                userAlert.innerHTML = `
                    El usuario ingresado ya se encuentra registrado
                `
            }else if(data.response ==='emailRegistered'){
                emailAlert.innerHTML =`
                    El email ingresado ya se encuentra registrado
                `
            }else if(data.response === 'fieldsEmpty'){
                emptyAlert.innerHTML = `
                    Por favor rellene todos los campos
                `   
            }
        })
})
