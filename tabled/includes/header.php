
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="includes/styles.css">
    <!-- boostrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/a5c3a36fa7.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

<style>
    .search{
        border-radius:8px;
        width:200px;
    }

    .avatar{
        max-width: 35px;
    }

    :root{
        --primary: rgb(84, 26, 160); 
        --light: rgb(246, 251, 255);
        /* --dark: rgb(136, 109, 255); */
        --dark: rgb(95, 95, 84);
       
    }

    .bg-light{
        background-color: var(--light) !important;
    }

    .logo{
        max-width: 200px;
    }

    .bg-dark{
            background-color: var(--dark) !important;
        }
      
        #pointer{
          cursor: pointer;
        }

</style>



    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">  
          <a href="./index.php" class="navbar-brand"> <img class="logo" src="img/logoTABLED.png" alt=""></a> 
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="img/user.png" class="img-fluid rounded-circle avatar mr-2" alt="">
                  <?php echo $_SESSION['email']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="perfil.php?id=<?php echo $_SESSION['user_id'] ?>">Perfil</a>
                <!-- <a onclick="enconder()" class="dropdown-item" id="pointer">Codigos</a> -->
                <!-- <a onclick="enconderBusquedas()" class="dropdown-item" id="pointer">Busquedas</a> -->
                <?php
                if($_SESSION['email'] == 'admin@admin' or $_SESSION['rol'] == "admin"){ ?>

                    <a class="dropdown-item" href="view_user.php">Usuarios</a>
                    
                
                <?php } ?>
                  <div class="dropdown-divider"></div>
                  <a href="logout.php" class="dropdown-item" style="text-decoration:none;">Logout</a>
                </div>
              </li>
            </ul>
            
          </div>
        </div>
      </nav>

    <!-- <div class="container justify-content-center align-self-center">
        

        <form action="index.php" method="POST">
                <input class="text" type="text" name="buscar" placeholder="Busqueda por tarea...">
                <input class="btn btn-primary btn-sm" type="submit" name="busqueda" value="Buscar por tarea">
                <input class="text" type="text" name="buscarprioridad" placeholder="Busqueda por prioridad...">
                <input class="btn btn-primary btn-sm" type="submit" name="busquedaprioridad" value="Buscar por prioridad">
                <input class="text" type="text" name="buscarestado" placeholder="Busqueda por estado...">
                <input class="btn btn-primary btn-sm" type="submit" name="busquedaestado" value="Buscar por estado">
        </form>
    
    </div> -->



