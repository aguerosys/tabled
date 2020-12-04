<?php session_start();
    include('db.php');

    if (isset($_SESSION['email'])){
        
    }else{
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    }


    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM user WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $email = $row['email'];  
            $rol = $row['rol'];      
        }
    }

    include('includes/header.php');

?>


<!-- CONTENT perfil -->
<div class="row justify-content-center">

<div class="card mt-5" style="width: 18rem;">
    <img src="img/user.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Datos personales</h5>
        <p class="card-text">Nombre: <?php echo $name ?></p>
        <p class="card-text">Email: <?php echo $email ?></p>
        <p class="card-text">Rol: <?php echo $rol ?></p>


        <!-- <a href="edit_user.php?id=<?php echo $id ?>" class="btn btn-primary">Editar información</a> -->

    </div>
</div>

</div>  



<?php
    include('includes/footer.php');
?>