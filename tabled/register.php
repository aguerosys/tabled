<?php include('includes/header_login.php'); ?>



<style>
    .inputs{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items: center;
    }
    input{
        width:420px;
        padding: 5px;
        margin: 5px;
    }
    p{
        text-align: start;
    }

</style>
<!-- 
    FORMULARIO REGISTER
 -->
<div class="container d-flex flex-row ">

    <div class="container">
        <h1 class="m-5">REGISTER</h1> 
        <p>or <a href="login.php">Iniciar sesión</a></p> 
       
        <form action="save_login.php" method="POST">
            <div class="form-group">
                <?php
                        if(isset($_SESSION['message'])){ ?>
                        <div class="alert alert-<?= $_SESSION['message_type'];  ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message'] ?>   
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php session_unset();} ?>
            
            </div>
            <div class="form-group">
                <p>Nombre</p>
                <input type="text" name="name" placeholder="Escriba su nombre..">
            </div>
            <div class="form-group">
                <p>Password</p>
                <input type="password" name="password" placeholder="Escriba su contraseña..">
            </div>
            <div class="form-group">
                <p>Email</p>
                <input type="email" name="email" id="" placeholder="Escriba su email..">
            </div>
            <input type="submit" class="btn btn-success" name="save_login" value="Guardar">
 
        </form>  
    </div>

    <div class="container d-flex justify-content-center align-items-center">
        <img src="img/logo.png" alt="" style="width:70%;">
    </div>

</div>







<?php include('includes/footer.php'); ?>