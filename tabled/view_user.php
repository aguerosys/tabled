<?php session_start();
include("db.php"); 

if (isset($_SESSION['email'])){
        
}else{
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}

?>


<?php 
    if(isset($_SESSION['email']) && $_SESSION['email'] == 'admin@admin' or $_SESSION['rol'] == "admin"){

    }else{
        
        header('Location: login.php');
    }

?>

<?php include("includes/header.php"); ?>



<div class="row">
        <div class="col-md-4">
            <div class="card card-body">
                <form action="save_login.php" method="POST">
                    <div class="form-group">
                        <p class="titulos">Nombre</p>
                        <input type="text" name="name" class="form-control" placeholder="Nombre.." autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Email</p>
                        <input type="text" name="email" class="form-control" placeholder="Email.." autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Rol</p>
                        <input type="text" name="rol" class="form-control" placeholder="Rol.." autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Contraseña</p>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña.." autofocus>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_login" value="Guardar">
                </form>
            </div>
        </div>
        <div class="col-md-8">             
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Accion</th>
                           <!--  <th>Accion</th> -->
                            
                        </tr>
                    </thead>
                    
                       
                    <tbody>
                    <?php 

                        $where = "";
                        /* $where = ""; */
       
                        /* CONSULTA Y MUESTRA DE DATOS EN TABLA */
                        $query = "SELECT * FROM user $where";
                        $result_tasks = mysqli_query($conn, $query);
    
                        
                            while ($row = mysqli_fetch_array($result_tasks)){ ?>
                                <?php 

                                     ?>
                                        
                                        <tr> 
                                            <td> <?php echo $row['name'] ?> </td>
                                            <td> <?php echo $row['email'] ?> </td>
                                            <td> <?php echo $row['rol'] ?> </td>
                                            <td>
                                                <a href="edit_user.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="delete_user.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td> 
                                        </tr>         
   
                            <?php } ?>
                        
                    </tbody>
                </table> 
        </div>
    </div>

<?php include("includes/footer.php"); ?>