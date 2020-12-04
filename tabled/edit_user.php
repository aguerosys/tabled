<?php session_start();

    include("db.php");

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

            $rol = $row['rol'];
            
            
        }
    }


if (isset($_POST['update'])){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $rol = $_POST['rol'];
    
    
    
    $query = "UPDATE user set name = '$name', rol = '$rol' WHERE id = $id";
    mysqli_query($conn, $query);

    /* $_SESSION['message'] = 'Task updated succesfully';
    $_SESSION['message_type'] = 'primary'; */
   
    header("Location: index.php");
}



?>

<?php include("includes/header.php"); ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit_user.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <p>Nombre</p>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Update nombre">                   
                    </div>
                    <div class="form-group">
                        <p>Rol</p>
                        <input type="text" name="rol" value="<?php echo $rol; ?>" class="form-control" placeholder="Update Rol">                   
                    </div>
                    
                    
                    <button class="btn btn-success" name="update">
                        Update
                    
                    </button>

                </form>
            </div>
        </div>
    </div>
    

</div>


<?php include("includes/footer.php"); ?>
