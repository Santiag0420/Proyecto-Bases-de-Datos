const tablaUsuarios = document.getElementById('tablaUsuariosBody');
const emailAdmin = localStorage.getItem('mail');
const btnNewUser = document.getElementById('buttonNewUser');
const modalAgregarUsuario = document.getElementById('modalAgregarUsuario');
fetch("includes/vistaReportes.php", {
    method: "GET"
})
.then (response=>response.json())
.then (responseServer => {
    if(responseServer == "notAdmin"){
        tablaUsuarios.innerHTML = `
        <tr>
            <td>solo el admin puede acceder</td>
        </tr>`
    }else{
        const arrayOptionsEdit = Array.from(responseServer);
        arrayOptionsEdit.shift()
        var i = 0;
        arrayOptionsEdit.forEach(usuario => {
            const row = document.createElement("tr");
            row.id = "user-"+i;
            row.className = "user"
            row.innerHTML = `
            <tr>
                <td id="editUser-${i}" class="editar"><a href="#" >Editar</a></td>
                <td id="deleteUser-${i}" class="delete"><a href="#" >Borrar</a></td>
                <td id="nickname-${i}" value="${usuario[0]}">${usuario[0]}</td>
                <td id="email-${i}" value="${usuario[1]}">${usuario[1]}</td>
                <td id="phone-${i}" value="${usuario[2]}">${usuario[2]}</td>
                <td id="cedula-${i}" value="${usuario[3]}">${usuario[3]}</td>
                <td id="ocupattion-${i}" value="${usuario[4]}">${usuario[4]}</td>
                <td id="rol-${i}" value="${usuario[5]}">${usuario[5]}</td>
                <td id="seguro-${i}" value="${usuario[6]}">${usuario[6]}</td>
            </tr>`
            tablaUsuarios.appendChild(row);
            i++;
        });
    }
    var userId;
    const optionsEdit = document.querySelectorAll('.editar');
    
    var convertir = false;
    var i = 0;
    optionsEdit.forEach(option => {
        option.addEventListener('click', (e)=>{
            e.preventDefault();
            try {
                userId = parseInt((option.id).substr((option.id).lastIndexOf('-')+1, (option.id).length));
                var editUser = document.getElementById("editUser-"+userId);
                var nickname = document.getElementById("nickname-"+userId);
                var email = document.getElementById("email-"+userId);
                var phone = document.getElementById("phone-"+userId);
                var cedula = document.getElementById("cedula-"+userId);
                var ocupattion = document.getElementById("ocupattion-"+userId);
                var rol = document.getElementById("rol-"+userId);
                var seguro = document.getElementById("seguro-"+userId);
                if(!convertir){
                    editUser.innerHTML = `<a href="#">Guardar Cambios</a>`
                    nickname.innerHTML=`<input id="inputNick-${userId}" class="form-control inputRow" value="${nickname.innerHTML}"></input>`;
                    email.innerHTML=`<input id="inputEmail-${userId}" class="form-control inputRow" value="${email.innerHTML}"></input>`;
                    phone.innerHTML=`<input id="inputPhone-${userId}" class="form-control inputRow" value="${phone.innerHTML}"></input>`;
                    cedula.innerHTML=`<input id="inputCedula-${userId}" class="form-control inputRow" value="${cedula.innerHTML}"></input>`;
                    ocupattion.innerHTML=`<input id="inputOcupattion-${userId}" class="form-control inputRow" value="${ocupattion.innerHTML}"></input>`;
                    rol.innerHTML=`<input id="inputRol-${userId}" class="form-control inputRow" value="${rol.innerHTML}"></input>`;
                    seguro.innerHTML=`<input id="inputSeguro-${userId}" class="form-control inputRow" value="${seguro.innerHTML}"></input>`;
                    convertir = !convertir
                }else{
                    editUser.innerHTML = `<a href="#">editar</a>`
                    const inputNick = document.getElementById("inputNick-"+userId);
                    const inputEmail = document.getElementById("inputEmail-"+userId);
                    const inputPhone = document.getElementById("inputPhone-"+userId);
                    const inputCedula = document.getElementById("inputCedula-"+userId);
                    const inputOcupattion = document.getElementById("inputOcupattion-"+userId);
                    const inputRol = document.getElementById("inputRol-"+userId);
                    const inputSeguro = document.getElementById("inputSeguro-"+userId);

                    const formUserEdited = new FormData();
                    formUserEdited.append("nickname", inputNick.value)
                    formUserEdited.append("email", inputEmail.value)
                    formUserEdited.append("phone", inputPhone.value)
                    formUserEdited.append("cedula", inputCedula.value)
                    formUserEdited.append("ocupattion", inputOcupattion.value)
                    formUserEdited.append("rol", inputRol.value)
                    formUserEdited.append("seguro", inputSeguro.value)
                    fetch ("includes/updateUserAdmin.php", {
                        method: "POST",
                        body: formUserEdited
                    })
                    .then(response => response.json())
                    .then(responseServer =>{
                        nickname.innerHTML=`${inputNick.value}`;
                        email.innerHTML=`${inputEmail.value}`;
                        phone.innerHTML=`${inputPhone.value}`;
                        cedula.innerHTML=`${inputCedula.value}`;
                        ocupattion.innerHTML=`${inputOcupattion.value}`;
                        rol.innerHTML=`${inputRol.value}`;
                        seguro.innerHTML=`${inputSeguro.value}`;
                        convertir = !convertir
                    })
                    
                }
            } catch (error) {
                alert("guarde los cambios")
            }
            i++;
        })
    })

    const optionsDelete = document.querySelectorAll('.delete');
    
    optionsDelete.forEach( usuarioDelete =>{
        usuarioDelete.addEventListener('click',(e) => {
            e.preventDefault();
            userId = parseInt((usuarioDelete.id).substr((usuarioDelete.id).lastIndexOf('-')+1, (usuarioDelete.id).length));
            const emailUserDelete = document.getElementById("email-"+userId);
            const formUserDelete = new FormData();
            console.log(emailUserDelete.innerHTML);
            formUserDelete.append("user", emailUserDelete.innerHTML);
            fetch("includes/deleteUserAdmin.php", {
                method: "POST",
                body: formUserDelete
            })
            .then(response => response.json())
            .then(responseServer => {
                if(responseServer == "userDeleted"){
                    setTimeout(() => {
                        location.reload()
                    }, 500);
                }
            })
        })
    })

    btnNewUser.addEventListener("click", (e) =>{
        e.preventDefault();
        var modal = new bootstrap.Modal(modalAgregarUsuario);
        modal.show();
    })

    const btnAgregarUSuario = document.getElementById("btnAgregarUSuario")

    btnAgregarUSuario.addEventListener("click", (e) =>{
        e.preventDefault();
        var formRegister = document.getElementById('formNewUSer');
        var userAlert = document.getElementById('userAlert');
        var emailAlert = document.getElementById('emailAlert');
        var emptyAlert = document.getElementById('emptyAlert');

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
                user.append('ADMIN',true);
                console.log(user);
                fetch('includes/mailVerificacionRegister.php',{
                    method:'POST',
                    body: user
                })
                    .then (resp => resp.json())
                    .then (responseMail => {     
                        if(responseMail === 'mailSend'){
                            setTimeout(() => {
                                location.reload();
                            }, 500);
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
})