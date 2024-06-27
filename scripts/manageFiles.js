function showMyFiles(){
    const viewFiles = document.getElementById('viewFiles'); 
    const colFiles = document.getElementById('colFiles'); 
    const email = localStorage.getItem('mail');
    const userFolder = email.substring(0, email.lastIndexOf('@'));
    const nombreUsuario = document.getElementById('nombreUsuario');
    const buttonCloseModalShare = document.getElementById('buttonCloseModalShare');
    const selectPermissions = document.getElementById('selectPermissions');
    nombreUsuario.innerHTML = `
        ${email}
    `;
    var formData = new FormData();
    formData.append("email", email);
    fetch('includes/manageFiles.php', {
        method: 'POST',
        body: formData
        })
        .then(response => response.json())
        .then(files => {
            console.log(files);

            if(files != "FilesNotFound"){
                for(var i = 0; i < files.length; i++){
                    const fileType = files[i].substr(files[i].lastIndexOf('.')+1, files[i].length);
                    const fileName = files[i].substr(0, files[i].lastIndexOf('.'));
                    
                    
                    if(files[i].length > 17 && (fileType == 'png' || fileType == 'jpg' || fileType == 'jpeg')){
                        const carta = document.createElement('div');
                        carta.id = 'file-'+i;
                        var contenido = `
                            <div class="col mt-4">
                                <div class="card" id="${i}">
                                    <img src="uploads/${userFolder}/${fileName+"."+fileType}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title" id="fileName${i}">${fileName.substring(0, 17)}</h5>
                                    </div>
                                </div>
                            </div>
                        `;
                        carta.innerHTML = contenido;
                        viewFiles.appendChild(carta);
                    }else if(fileType == 'png' || fileType == 'jpg' || fileType == 'jpeg'){
                        const carta = document.createElement('div');
                        carta.id = 'file-'+i;
                        var contenido = `
                            <div class="col mt-4">
                                <div class="card" id="${i}">
                                    <img src="uploads/${userFolder}/${fileName+"."+fileType}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title" id="fileName${i}">${fileName}</h5>
                                    </div>
                                </div>
                            </div>
                        `;
                        carta.innerHTML = contenido;
                        viewFiles.appendChild(carta);
                    }else{
                        const carta = document.createElement('div');
                        carta.id = 'file-'+i;
                        var contenido = `
                            <div class="col mt-4">
                                <div class="card" id="${i}">
                                    <img src=".." class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title" id="fileName${i}">${fileName}</h5>
                                    </div>
                                </div>
                            </div>
                        `;
                        carta.innerHTML = contenido;
                        viewFiles.appendChild(carta);
                    }
                }
                const cartas = document.querySelectorAll(".card");
                var idFile;
                // Agregar el evento contextmenu a cada carta
                cartas.forEach( carta => {
                    carta.addEventListener('contextmenu', (e) => {
                        if(!carta.id.includes("compartido")){
                            e.preventDefault(); // Evitar que aparezca el menú de contexto predeterminado
                            idFile = carta.id;
                            const menu = document.getElementById('menuContext'); 
                            menu.style.display = 'block'; 
    
                            const posX = e.clientX;
                            const posY = e.clientY;
    
                            menu.style.left = `${posX}px`;
                            menu.style.top = `${posY}px`;
                        }
                    });
                });
                const OpcionCambiarNombre = document.querySelector('.OpcionCambiarNombre');
                const opcionDescargar = document.querySelector('.opcionDescargar');
                const opcionCompartir = document.querySelector('.opcionCompartir');
                const opcionEliminar = document.querySelector('.opcionEliminar');

                OpcionCambiarNombre.addEventListener('click', () => {
                    const typeCard = document.getElementById(idFile);
                    if(!typeCard.id.includes("compartido")){
                        var input = document.createElement("input");
                        var fieldNameFile = document.getElementById("fileName"+idFile);
                        var inputInitValue = fieldNameFile.innerHTML;
                        
                        input.type = "text";
                        input.value = inputInitValue;
                        input.style.width = "90%";
                        fieldNameFile.innerHTML ="";
                        fieldNameFile.appendChild(input);
                        input.focus();

                        input.addEventListener('change', updateField);

                        function updateField(e){
                            var updatedValue = input.value;
                            if(updatedValue.includes(".") || updatedValue.includes("/")){
                                console.log("error");
                                fieldNameFile.innerHTML=inputInitValue;
                                input.remove();
                            } else if (e.type === 'change' || e.key ==='Enter') {
                                e.preventDefault();
                                fieldNameFile.innerHTML = updatedValue;
                                input.remove();
                                var formFiles = new FormData();
                                const fileType = files[idFile].substr(files[idFile].lastIndexOf('.')+1, files[idFile].length);
                                formFiles.append("user", email);
                                formFiles.append("nameFile", files[idFile]);
                                formFiles.append("updatedNameFile", updatedValue);
                                formFiles.append("fileType", fileType); 
                                fetch('includes/changeFileName.php', {
                                    method: 'POST',
                                    body: formFiles
                                })  
                                .then(response => response.json())
                                .then(filesUpdated =>{
                                    console.log(filesUpdated);
                                    setTimeout(function() {
                                        location.reload();
                                    }, 500);
                                })
                            }
                        }
                    }  
                });
                opcionDescargar.addEventListener('click', () => {
                    const typeCard = document.getElementById(idFile);
                    if(!typeCard.id.includes("compartido")){
                        console.log(typeCard);
                        var pathFile = 'uploads/'+userFolder+"/"+files[idFile];
                        console.log(pathFile);
                        function descargarArchivo(url, nombreArchivo) {
                            var link = document.createElement("a");
                            link.href = url;
                            link.download = nombreArchivo;
                            link.target = "_blank";
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                        descargarArchivo(pathFile, files[idFile])
                    }
                });

                opcionCompartir.addEventListener('click', () => {
                    const typeCard = document.getElementById(idFile);
                    if(!typeCard.id.includes("compartido")){
                        const modalShare = new bootstrap.Modal(document.getElementById('modalShare'));
                        const nameFileModal = document.getElementById('nameFileModal');
                        const warningsModalShare = document.getElementById('warningsModalShare');
                        nameFileModal.innerHTML = files[idFile]; 
                        const inputTo = document.getElementById('inputTo');
                        modalShare.show(); 
                        warningsModalShare.value = ``
                        inputTo.value =``;
                        warningsModalShare.innerHTML = ``
                    }
                });

                const buttonShare = document.getElementById('buttonShare');
                buttonShare.addEventListener('click', () => {
                    if(inputTo.value !=''){
                        var formFile = new FormData();
                        formFile.append("file", files[idFile]);
                        formFile.append("remitente", email);
                        formFile.append("receptor", inputTo.value);
                        fetch('includes/shareFile.php', {
                            method: 'POST',
                            body: formFile
                        })
                        .then(response => response.json())
                        .then(responseShare => {
                            console.log(responseShare)
                            if(responseShare == 'fileShareWithYourself'){
                                warningsModalShare.className = 'text-danger'
                                warningsModalShare.innerHTML = `
                                    No puedes compartir archivos contigo mismo :).
                                `
                            }else if(responseShare == 'userNotFound'){
                                warningsModalShare.className = 'text-gray'
                                warningsModalShare.innerHTML = `
                                    El usuario no se encuentra registrado. Dile que se registre ;).
                                `
                            }else if(responseShare == 'fileAlreadyShare'){
                                warningsModalShare.className = 'text-gray'
                                warningsModalShare.innerHTML = `
                                    Ya has compartido este archvio con este usuario.
                                `
                            }else if(responseShare == 'sendMail'){
                                formFile.append("clearance", selectPermissions.value);
                                fetch("includes/mailShareImage.php", {
                                    method: 'POST',
                                    body: formFile
                                })
                                .then(response => response.json())
                                .then(responseMail => {
                                    console.log(responseMail)
                                })
                            }
                        })
                    }else{
                        warningsModalShare.className = 'text-warning'
                        warningsModalShare.innerHTML = `
                        No se ha seleccionado un usuario
                        `
                    }
                })

                opcionEliminar.addEventListener('click', () => {
                    const typeCard = document.getElementById(idFile);
                    var formFileToeliminate = new FormData();
                    formFileToeliminate.append("fileToEliminate", files[idFile]);
                    formFileToeliminate.append("user", email);
                    fetch('includes/deleteFile.php', {
                        method: 'POST',
                        body: formFileToeliminate
                    })
                    .then(response => response.json())
                    .then(fileDeleted => {
                        console.log(fileDeleted);
                        setTimeout(function() {
                            location.reload();
                        }, 250);
                    })
                });
            }else{
                sectionMyFiles.innerHTML = `
                    <div class="col-10">
                        <h1>No se han encontrado archivos</h1>
                    </div>
                `
            }
            
        })
        document.addEventListener('click', () => {
            const menu = document.getElementById('menuContext');
            menu.style.display = 'none';
            
        }); 
}