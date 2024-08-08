<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Añadir Inmuebles</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="diseño.css" rel="stylesheet">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      
    </style>

    
    <!-- Custom styles for this template -->
    <link href="checkout.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

  </head>
  <body class="bg-body-tertiary">
  
<div class="container text-center ">
  <main>
    <div class="py-5 text-center">
      <h2>Alta de Inmuebles</h2>
    </div>
      <div class=""  >
        
        <form action="validacioninmueble.php" method="post" class="needs-validation" novalidate>
          <div class="row g-3">
            

            <div class="col-12">
              <label for="nombre_inmueble" class="form-label">Nombre del inmueble</label>
              <input type="text" class="form-control text-center" id="nombre_inmueble" name="nombre_inmueble" placeholder="Nombre" value="" required>
              <div class="invalid-feedback">
                Nombre del inmueble requerido
              </div>
            </div>

            <div class="col-sm-6">
              <label for="fecha_adquisicion" class="form-label">Fecha de Adquisición</label>
              <div class="input-group has-validation">
                <input type="date" class="form-control text-center" id="fecha_adquisicion" name="fecha_adquisicion" placeholder="dd/mm/aa" required>
              <div class="invalid-feedback">
                Fecha de Adquisición requerida
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <label for="costo" class="form-label">Costo <span class="text-body-secondary">(Cuando se adquirió)</span></label>
              <input type="text" class="form-control text-center" id="costo" name="costo" placeholder="$" required>
              <div class="invalid-feedback">
                Costo requerido
              </div>

            </div>

              <!-- Categoría -->
<div class="col-12">
    <label for="categoria" class="form-label">Categoría</label>
    <select id="categoria" name="categoria" class="form-control expanded form-select text-center" required>
        <option selected disabled>Categorias</option>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "proyecto";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT Id_categoria, Nombre_cat FROM alta_categoria";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Id_categoria'] . "'>" . $row['Nombre_cat'] . "</option>";
            }
        }
        $conn->close();
        ?>
    </select>
    <div class="invalid-feedback">
        Categoría requerida
    </div>
</div>

<!-- Asignación -->
<div class="col-12">
    <label for="asignacion" class="form-label">Asignación <span class="text-body-secondary">(No necesaria)</span></label>
    <select id="asignacion" name="asignacion" class="form-control expanded form-select text-center" required>
        <option selected disabled>Asignar a...</option>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "proyecto";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT Id,  Nombre_completo FROM colaboradores1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Id'] . "'>" . $row['Nombre_completo'] . "</option>";
            }
        }
        $conn->close();
        ?>
    </select>
</div>


          </div>

          <hr class="my-4">
            
          <button class="btn btn-primary btn-lg" name="agregarinmueble" type="submit" >Agregar</button>
        </form>
      </div>
    </div>
  </main>

</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
