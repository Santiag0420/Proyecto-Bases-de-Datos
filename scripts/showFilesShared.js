user;
var formUser = new FormData();
const viewShareWithMe = document.getElementById('viewShareWithMe');
const adminOpc = document.getElementById('opcionesA');

if(user == "admin@gmail.com"){
    const opcion1 = document.createElement("li");
    const opcion2 = document.createElement("li");
    opcion1.innerHTML = `
    <li class="nav-item d-flex justify-content-start">
        <a class="nav-link active" aria-current="page" href="reporteEstadistico.php">Reporte grafico y crud admin</a>
    </li>`
    opcion2.innerHTML = `<li class="nav-item d-flex justify-content-start">
        <a class="nav-link active" aria-current="page" href="reportePdf.php">Reporte pdf</a>
    </li>`
    adminOpc.append(opcion1);
    adminOpc.append(opcion2);
}
formUser.append("user",user);
fetch("includes/showFilesShared.php", {
    method: 'POST',
    body: formUser
})
.then(response => response.json())
.then(files => {
    if(files != "filesNotFound"){
        for(var i = 0; i < files.length; i++){
            const fileType = files[i][0].substr(files[i][0].lastIndexOf('.')+1, files[i][0].length);
            const fileName = files[i][0].substr(0, files[i][0].lastIndexOf('.'));
            const userFolder = files[i][1].substring(0, files[i][1].lastIndexOf('@'));
            if(files[i][0].length > 17 && (fileType == 'png' || fileType == 'jpg' || fileType == 'jpeg')){
                const carta = document.createElement('div');
                var contenido = `
                    <div class="col mt-4">
                        <div class="card" id="compartido-${i}">
                            <img src="uploads/${userFolder}/${fileName+"."+fileType}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" id="filenameCompartido-${i}">${fileName.substring(0, 17)}</h5>
                            </div>
                        </div>
                    </div>
                `;
                carta.innerHTML = contenido;
                viewShareWithMe.appendChild(carta);
            }else if(fileType == 'png' || fileType == 'jpg' || fileType == 'jpeg'){
                const carta = document.createElement('div');
                carta.id = 'filefileShared-'+i;
                var contenido = `
                    <div class="col mt-4">
                        <div class="card" id="compartido-${i}">
                            <img src="uploads/${userFolder}/${fileName+"."+fileType}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title" id="filenameCompartido-${i}">${fileName}</h5>
                            </div>
                        </div>
                    </div>
                `;
                carta.innerHTML = contenido;
                viewShareWithMe.appendChild(carta);
            }else{
                const carta = document.createElement('div');
                var contenido = `
                    <div class="col mt-4">
                        <div class="card" id="compartido-${i}">
                            <img src=".." class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title" id="filenameCompartido-${i}">${fileName}</h5>
                            </div>
                        </div>
                    </div>
                `;
                carta.innerHTML = contenido;
                viewShareWithMe.appendChild(carta);
            }
        }
        cartas = document.querySelectorAll(".card");
        var cartaCompartirId;
        OpcionesCambiarNombreMC = document.querySelectorAll(".OpcionCambiarNombreMC");
        opcionesDescargarMC = document.querySelectorAll(".opcionDescargarMC");
        opcionesCompartirMC = document.querySelectorAll(".opcionCompartirMC");
        opcionesEliminarMC = document.querySelectorAll(".opcionEliminarMC");
        cartas.forEach( carta => {
            carta.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                cartaCompartirId = parseInt((carta.id).substr((carta.id).lastIndexOf('-')+1, (carta.id).length));
                if(carta.id.includes("compartido")){
                   if(files[cartaCompartirId][2] == "lector"){
                        const menu = document.getElementById('menuContextMC'); 
                        console.log(menu);
                        OpcionesCambiarNombreMC.forEach(opcionCambiarNombre => {
                            opcionCambiarNombre.style.display='none';
                        });
                        opcionesCompartirMC.forEach(opcionCompartir => {
                            opcionCompartir.style.display='none';
                        });
                        opcionesEliminarMC.forEach(opcionEliminar => {
                            opcionEliminar.style.display='none';
                        });
                        menu.style.display = 'block'; 

                        const posX = e.clientX;
                        const posY = e.clientY;

                        menu.style.left = `${posX}px`;
                        menu.style.top = `${posY}px`;
                   }else if(files[cartaCompartirId][2] == "editor"){
                        const menu = document.getElementById('menuContextMC'); 
                        OpcionesCambiarNombreMC.forEach(opcionCambiarNombre => {
                            opcionCambiarNombre.style.display='block';
                        });
                        opcionesCompartirMC.forEach(opcionCompartir => {
                            opcionCompartir.style.display='block';
                        });
                        opcionesEliminarMC.forEach(opcionEliminar => {
                            opcionEliminar.style.display='block';
                        });

                        menu.style.display = 'block'; 

                        const posX = e.clientX;
                        const posY = e.clientY;

                        menu.style.left = `${posX}px`;
                        menu.style.top = `${posY}px`; 
                   }else{
                    OpcionesCambiarNombreMC.forEach(opcionCambiarNombre => {
                        opcionCambiarNombre.style.display='none';
                    });
                    opcionesCompartirMC.forEach(opcionCompartir => {
                        opcionCompartir.style.display='none';
                    });
                    opcionesEliminarMC.forEach(opcionEliminar => {
                        opcionEliminar.style.display='none';
                    });
                   }
                }else{
                    OpcionesCambiarNombreMC.forEach(opcionCambiarNombre => {
                        opcionCambiarNombre.style.display='block';
                    });
                    opcionesCompartirMC.forEach(opcionCompartir => {
                        opcionCompartir.style.display='block';
                    });
                    opcionesEliminarMC.forEach(opcionEliminar => {
                        opcionEliminar.style.display='block';
                    });
                } 
            });
            cartaCompartirId++; 
        });
        opcionCambiarNombreMC = document.querySelector(".OpcionCambiarNombreMC");
        opcionDescargarMC = document.querySelector(".opcionDescargarMC");
        opcionCompartirMC = document.querySelector(".opcionCompartirMC");
        opcionEliminarMC = document.querySelector(".opcionEliminarMC");
        opcionCambiarNombreMC.addEventListener('click', () => {
            const typeCard = document.getElementById("compartido-"+cartaCompartirId)
            if(typeCard.id.includes("compartido")){
                var input = document.createElement("input");
                var fieldNameFileMC = document.getElementById("filenameCompartido-"+cartaCompartirId);
                var inputInitValue = fieldNameFileMC.innerHTML;
                
                input.type = "text";
                input.value = inputInitValue;
                input.style.width = "90%";
                fieldNameFileMC.innerHTML ="";
                fieldNameFileMC.appendChild(input);
                input.focus();
    
                input.addEventListener('change', updateField);
                function updateField(e){
                    var updatedValue = input.value;
                    if(updatedValue.includes(".") || updatedValue.includes("/")){
                        console.log("error");
                        fieldNameFileMC.innerHTML=inputInitValue;
                        input.remove();
                    }else if (e.type === 'change' || e.key ==='Enter') {
                        e.preventDefault();
                        fieldNameFileMC.innerHTML = updatedValue;
                        input.remove();
                        var formFiles = new FormData();
                        const fileType = files[cartaCompartirId][0].substr(files[cartaCompartirId][0].lastIndexOf('.')+1, files[cartaCompartirId][0].length);
                        formFiles.append("user", files[cartaCompartirId][1]);
                        formFiles.append("nameFile", files[cartaCompartirId][0]);
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

        opcionDescargarMC.addEventListener('click',()=>{
            const typeCard = document.getElementById("compartido-"+cartaCompartirId)
            if(typeCard.id.includes("compartido")){
                const userFolder = files[cartaCompartirId][1].substring(0, files[cartaCompartirId][1].lastIndexOf('@'));
                var pathFile = 'uploads/'+userFolder+"/"+files[cartaCompartirId][0];
                console.log(pathFile);
                console.log(files[cartaCompartirId][0]);
                function descargarArchivo(url, nombreArchivo) {
                    var link = document.createElement("a");
                    link.href = url;
                    link.download = nombreArchivo;
                    link.target = "_blank";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
                descargarArchivo(pathFile, files[cartaCompartirId][0])
            }
        })
        
        opcionCompartirMC.addEventListener('click',()=>{
            const typeCard = document.getElementById("compartido-"+cartaCompartirId)
            if(typeCard.id.includes("compartido")){
                const modalShareMC = new bootstrap.Modal(document.getElementById('modalShareMC'));
                const nameFileModalMC = document.getElementById('nameFileModalMC');
                const warningsModalShareMC = document.getElementById('warningsModalShareMC');
                nameFileModalMC.innerHTML = files[cartaCompartirId][0]; 
                const inputToMC = document.getElementById('inputToMC');
                modalShareMC.show(); 
                warningsModalShareMC.value = ``
                inputToMC.value =``;
                warningsModalShareMC.innerHTML = ``
            }
        })

        const buttonShareMC = document.getElementById('buttonShareMC');
        buttonShareMC.addEventListener('click', () => {
            if(inputToMC.value !=''){
                var formFile = new FormData();
                formFile.append("file", files[cartaCompartirId][0]);
                formFile.append("remitente", email);
                formFile.append("receptor", inputToMC.value);
                fetch('includes/shareFile.php', {
                    method: 'POST',
                    body: formFile
                })
                .then(response => response.json())
                .then(responseShare => {
                    console.log(responseShare)
                    if(responseShare == 'fileShareWithYourself'){
                        warningsModalShareMC.className = 'text-danger'
                        warningsModalShareMC.innerHTML = `
                            No puedes compartir archivos contigo mismo :).
                        `
                    }else if(responseShare == 'userNotFound'){
                        warningsModalShareMC.className = 'text-gray'
                        warningsModalShareMC.innerHTML = `
                            El usuario no se encuentra registrado. Dile que se registre ;).
                        `
                    }else if(responseShare == 'fileAlreadyShare'){
                        warningsModalShareMC.className = 'text-gray'
                        warningsModalShareMC.innerHTML = `
                            Ya has compartido este archvio con este usuario.
                        `
                    }else if(responseShare == 'sendMail'){
                        formFile.append("clearance", selectPermissionsMC.value);
                        console.log(formFile.get("file"))
                        console.log(formFile.get("remitente"))
                        console.log(formFile.get("receptor"))
                        console.log(formFile.get("clearance"))
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
                warningsModalShareMC.className = 'text-warning'
                warningsModalShareMC.innerHTML = `
                No se ha seleccionado un usuario
                `
            }
        })

        opcionEliminarMC.addEventListener('click', () => {
            //const typeCard = document.getElementById("compartido-"+cartaCompartirId)
            var formFileToeliminate = new FormData();
            formFileToeliminate.append("fileToEliminate", files[cartaCompartirId][0]);
            formFileToeliminate.append("user",  files[cartaCompartirId][1]);
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
        console.log("hola")});

        document.addEventListener('click', () => {
            const menu = document.getElementById('menuContextMC');
            menu.style.display = 'none';
            
        }); 
    }
    
    
    
})