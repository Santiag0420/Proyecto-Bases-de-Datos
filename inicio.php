<?php
include("includes/verificacionLogin.php");
$usuario = $_SESSION['usuario'];
if (!isset($usuario)) {
    header("Location: loginPrueba.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/estiloInicio.css">
    <script src="scripts/manageFiles.js"></script>
    <title>Document</title>
</head>

<body>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showMyFiles();
        });
    </script>
    <!-- munu contextual -->
    <div id="menuContext" class="menu-contextual">
        <ul>
            <li class="OpcionCambiarNombre"><a href="#">Cambiar nombre</a></li>
            <li class="opcionDescargar"><a href="#" >Descargar</a></li>
            <li class="opcionCompartir"><a href="#" >Compartir</a></li>
            <li class="opcionEliminar"><a href="#" >Eliminar</a></li>
        </ul>
    </div>
    <!-- menu contextual imagenes compartidas -->
    <div id="menuContextMC" class="menu-contextual">
        <ul>
            <li class="OpcionCambiarNombreMC"><a href="#">Cambiar nombre</a></li>
            <li class="opcionDescargarMC"><a href="#" >Descargar</a></li>
            <li class="opcionCompartirMC"><a href="#" >Compartir</a></li>
            <li class="opcionEliminarMC"><a href="#" >Eliminar</a></li>
        </ul>
    </div>
    <!-- modal subida archivos -->
    <div class="modal fade" id="modalFiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal">Subiendo el archivo...</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="progress-bar-container" id="barProgressContainer">
                        <div class="progress-bar" id="barProgress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal compartir archivo-->
    <div class="modal fade" id="modalShare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="exampleModalLabel">Compartir archivo</h1>
                    <button type="button" class="btn-close" id="buttonCloseModalShare"data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nombre del archivo:</h1>
                    <p class="text-md-start" id="nameFileModal"></p>
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Para:</label>
                            <input type="text" class="form-control" id="inputTo" value ="">
                            <p id="warningsModalShare"></p>
                            <select id="selectPermissions" class="form-select" name="filePermissions">
                                <option value="editor">Editor</option>
                                <option value="lector">Lector</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="buttonShare">Compartir</button>     
                </div>
            </div>
        </div>
    </div>

    <!--modal compartir archivo compartido  -->
    <div class="modal fade" id="modalShareMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="exampleModalLabel">Compartir archivo</h1>
                    <button type="button" class="btn-close" id="buttonCloseModalShareMC"data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nombre del archivo:</h1>
                    <p class="text-md-start" id="nameFileModalMC"></p>
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Para:</label>
                            <input type="text" class="form-control" id="inputToMC" value ="">
                            <p id="warningsModalShareMC"></p>
                            <select id="selectPermissionsMC" class="form-select" name="filePermissionsMC">
                                <option value="editor">Editor</option>
                                <option value="lector">Lector</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="buttonShareMC">Compartir</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid text-center">
        <div class="row align-items-center">
            
         
            <nav class="navbar bg-body-tertiary">
            <div class="col-2">
            <a class="navbar-brand text-success" style="font-size:25px;" href="#">
                    <img src="images/logo.svg" alt="Logo" width="30" height="24"
                        class="d-inline-block align-text-bottom">
                    Valledelulu
                    </a>
            </div>
                    <div class="container-fluid">
                    <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="inputSearch">
                            <button class="btn btn-outline-success">
                            <img src="images/lupa.png" alt="Logo" width="30" height="24">
                            </button>
                        </form>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-end" tabindex="-10" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="nombreUsuario"></h5>
                            </div>
                            <hr>
                            <div class="offcanvas-body" id="opcionesA">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item d-flex justify-content-start">
                                        <a class="nav-link active" aria-current="page"
                                        href="includes/cerrarSesion.php">Cerrar
                                        sesion<img src="images/cerrar.png" alt="Logo" width="30" height="24"> 
                                        </a>
                                    </li>
                                    <li class="nav-item d-flex justify-content-start">
                                        <a class="nav-link active" aria-current="page" href="faceRecognition.html">Inicio de sesion mediante Reconocimiento facial</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
         
            <div class="col-10">
                
            </div>
        </div>
        <div class="row">
            <div class="col-2-padding-y" style="border-right: 2px solid rgb(223, 223, 223);">
                <ul class="nav d-block nav-tabs">
                    <form enctype="multipart/form-data" id="formArchivos">
                        <input type="file" id="file" name="files[]" multiple style="display: none;">
                        <button id="botonArchivo"><img src="images/anadir.png" id="iconoSubirArchivo">Subir archivo</button> 
                    </form>
                    <br>
                    <li class="nav-item" id="buttonMyFiles">
                        <a class="nav-link" id="misArchi" href="#">
                            <img src="images/archivos.png" alt="Logo" width="30" height="24">
                                Mis archivos
                        </a>
                    </li>
                    <li class="nav-item" id="buttonShareWithMe">
                        <a class="nav-link" id="compar" href="#">
                            <img src="images/Compartidos.png" alt="Logo" width="30" height="24">
                            Compartido conmigo
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-10" id="colFiles">
                <div id="sectionMyFiles">
                    <div class="row row-cols-1 row-cols-md-5 g-4" id="viewFiles">

                    </div>
                </div>
                <div id="sectionSharedWithMe">
                    <div class="row row-cols-1 row-cols-md-5 g-4" id="viewShareWithMe">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="scripts/uploadFile.js"></script>
    <script src="scripts/searchFiles.js"></script>
    <script src="scripts/changeViewHome.js"></script>
    <script src="scripts/showFilesShared.js"></script>
</body>

</html>