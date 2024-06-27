<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/registerPrueba.css">
</head>

<body>
<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro exitoso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Por favor revise su correo para verificar su registro
                </div>
                <div class="modal-footer">
                    <button id="registerAccept" type="button" data-bs-dismiss="modal" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
  <img class="imagenFondo" src="images/fondoLogin.jpg" alt="fondo">
  <div class="overlay"></div>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                    <img src="images/Logo.svg" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Register</h4>
                  </div>
                  <form class="row g-3" id="formRegister" method="post">
                        <div class="col-md-6">
                            <label for="inputUsername" class="form-label text-success">Username</label>
                            <input type="text" class="form-control" id="inputUsername" name="username">
                            <div id="userAlert" class="form-text text-warning"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label text-success">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="password">
                        </div>
                        <div class="col-12">
                            <label for="inputE" class="form-label text-success">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="user@gmail.com" name="email">
                            <div id="emailAlert" class="form-text text-warning"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label text-success">ID</label>
                            <input type="text" class="form-control" id="inputID" name="id">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label text-success">Telephone</label>
                            <input type="text" class="form-control" id="inputTelephone" name="telephone">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label text-success">Ocupation</label>
                            <input type="text" class="form-control" id="inputOcupation" name="ocupation">
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label text-success">Health Insurance</label>
                            <select id="inputState" class="form-select" name="seguro">
                                <option selected>Seleccionar</option>
                                <option value="Sanitos"> Sanitos</option>
                                <option value="Sismeven">Sismeven</option>
                                <option value="SUS"> SUS</option>
                                <option value="Cumdeva"> Cumdeva</option>
                                <option value="La vieja eps">La vieja eps</option>
                                <option value="Diclofenalco">Diclofenalco</option>
                                <option value="No aplica">No aplica</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div id="emptyAlert" class="form-text text-warning"></div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-success" name="register">Register</button>
                        </div>
                    </form>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">

                <div class="text-white px-3 py-4 p-md-5 mx-md-4">



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
  <!-- <script src="scripts/verificacion.js"></script> -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="scripts/verificacionRegister.js"></script>

</body>

</html>