<?php  session_start();

    include('db.php');
?>

<?php include('includes/header_login.php'); ?>
<!-- Conexion BD -->


<!-- si esta logeado no puede estar en esta pagina -->
    <?php if (isset($_SESSION['email'])){
	    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
        die();
        
    } 
    else{
        
    }

?>


<!-- comprobacion de datos -->
<?php 
    
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email']; 
		$records = mysqli_query($conn, "SELECT id, email, rol, pass FROM user WHERE email = '$email'");
        $result= mysqli_fetch_assoc($records);
        @$hash = $result['pass'];
        @$id = $result['id'];
        @$rol = $result['rol'];
        
        
        $message = '';

        if (password_verify($_POST['password'], $hash)){
	    	   
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = $rol;
            
	        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
            die();
             
	     
            
        }else{

            $message = 'Disculpe, la contraseña es incorrecta';
            $_SESSION['message'] = 'Cotraseña o email incorrectos';
            $_SESSION['message_type'] = 'danger';
        }
    }else{
        if (isset($_POST['enviar'])){
            $message = 'Campos vacios';
            
            $_SESSION['message'] = 'Campos vacios';
            $_SESSION['message_type'] = 'danger';
        }
    }

?>

<style>

    p{
        text-align: start;
    }

    input{
        width: 20px;
    }

</style>

<div class="container d-flex flex-row justify-content-center">

    <div class="p-2">
        
        <h1 class="m-5">LOGIN - TABLED</h1>  

        <form action="" method="POST">
                <?php
                        if(isset($_SESSION['message'])){ ?>
                        <div class="alert alert-<?= $_SESSION['message_type'];  ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message'] ?>   
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php session_unset();} ?>

                

            <div class="form-group">
                
                <input class="form-control mb-5" type="email" name="email" placeholder="@Email">
            </div>
            <div class="form-group">
                
                <input class="form-control" type="password" name="password" id="" placeholder="Password">
                
            </div>
            
            <button class=" form-control btn btn-success my-3" name="enviar">Ingresar</button>           
        </form>  

        <!-- REGISTRO -->
        <!-- <div class="form-group">
            <p>Aún no te registraste? <a href="register.php">Registrarse</a></p>
        </div> -->
    </div>

    

</div>

<?php 
    


?>















<?php include ('includes/footer.php'); ?>