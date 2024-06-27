<?php
 require_once 'includes/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Document</title>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php 
            $SQL ="SELECT * FROM usuarios";
            $sqlCant = "SELECT usuario, COUNT(archivo) AS cantidad_archivos
            FROM misarchivos
            GROUP BY usuario;";
            $consulta = mysqli_query($conexion, $SQL);
            $consultaCantidad = mysqli_query($conexion, $sqlCant);
            while($resultado = mysqli_fetch_assoc($consultaCantidad)){
                echo "['" .$resultado['usuario']."', " .$resultado['cantidad_archivos']."],";
          }

          ?>
        ]);

        var options = {
          title: 'Uso de la app usuarios'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="modalAgregarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3" id="formNewUSer" method="post">
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
                    <option value="Sanitos">Sanitos</option>
                    <option value="Sismeven">Sismeven</option>
                    <option value="SUS">SUS</option>
                    <option value="Cumdeva">Cumdeva</option>
                    <option value="La vieja eps">La vieja eps</option>
                    <option value="Diclofenalco">Diclofenalco</option>
                    <option value="No aplica">No aplica</option>
                </select>
            </div>

            <div class="col-md-12">
                <div id="emptyAlert" class="form-text text-warning"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btnAgregarUSuario">Agregar usuario</button>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-12 my-3">
          <h1>Cantidad de archivos compartidos por cada usuario</h1>
          <div id="piechart" style="width: 900px; height: 400px;"></div>
      </div>
      <div class="col-12 d-flex">
        <div class ="col-6 mr-5">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
        <div class="col-2 d-flex mx-5">
          <button id="buttonNewUser" type="button" class="btn btn-success">Agregar nuevo usuario</button>
        </div>
      </div>
      <div class="col-12 overflow-y-auto overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">---↓---</th>
            <th scope="col">------------||</th>
            <th scope="col">Usuario</th>
            <th scope="col">Correo</th>
            <th scope="col">telefóno</th>
            <th scope="col">Cedula</th>
            <th scope="col">Ocupacion</th>
            <th scope="col">Rol</th>
            <th scope="col">Seguro</th>
          </tr>
        </thead>
        <tbody id= "tablaUsuariosBody">
        </tbody>
      </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="scripts/vistaReporteEs.js"></script>
</body>

</html>
