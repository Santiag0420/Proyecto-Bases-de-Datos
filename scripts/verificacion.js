var form = document.getElementById('form');
var alerta = document.getElementById('alerta');
alertaPassword = document.getElementById('alertaPassword');

form.addEventListener('submit', function(event){
    event.preventDefault();
    console.log("click")

    var datos = new FormData(form);
    console.log(datos.get('email'))
    console.log(datos.get('password'))
    console.log(datos)

    fetch('includes/verificacionLogin.php',{
        method: 'POST',
        body: datos
    })
        .then( res => res.json())
        .then( data => {
            console.log(data);
            if(data[0]==='loginSuccessfully'){
                localStorage.setItem('mail', data[1]);
                location.href = 'inicio.php';
            }else if(data[0] === 'unverifiedUser'){
                alerta.innerHTML = `
                    Por favor verifique su usuario
                `
                location.href = 'includes/verificationUsers.php'                 
            }else if(data[0]==='userNotRegistered'){
                alerta.innerHTML = `
                    El usuario no esta registrado
                `
                alertaPassword.innerHTML = `
                    
                `
            }else if(data[0] === 'incorrectPassword'){
                alertaPassword.innerHTML = `
                    <div class="form-text text-danger">Contraseña incorrecta</div>
                `
                alerta.innerHTML = `

                `
            }else if(data[0] === 'fieldsEmpty'){
                alerta.innerHTML = `
                    Por favor llene todos los campos
                `
                alertaPassword.innerHTML = `
                    
                `
            }
        })
})