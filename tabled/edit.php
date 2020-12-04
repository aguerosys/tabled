<?php session_start();

    include("db.php");

    if (isset($_SESSION['email'])){
        
    }else{
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM task WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $title = $row['title'];
            $description = $row['description'];
            $priority = $row['priority'];
            $expiration = $row['expiration'];
            $responsable = $row['responsable'];
            $state = $row['state'];
            $author = $row ['author'];
            $visible = $row['visible'];
            /* $attached = $row['attached']; */

        }
    }


if (isset($_POST['update'])){
    $id = $_GET['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $expiration = $_POST['expiration'];
    $responsable = $_POST['responsable'];
    $state = $_POST['state'];
    
    $visible = $_POST['visible'];
    
    $query = "UPDATE task set title= '$title', description = '$description', priority='$priority', expiration = '$expiration', responsable = '$responsable', state = '$state', visible = '$visible'  WHERE id = $id";
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
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <p>Tarea</p>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" placeholder="Update Title">                   
                    </div>
                    <div class="form-group">
                    <select name="responsable" class="form-control" id="responsable"  autofocus >                 
                        <?php
                            $query2 = "SELECT * FROM user";
                            $result_tasks2 = mysqli_query($conn, $query2);
                            while ($datos = mysqli_fetch_array($result_tasks2))
                            {
                        ?>
                            <option value="<?php echo $datos['email'] ?>"><?php echo $datos['email'] ?></option>
                            
                        <?php
                            }
                        ?>             
                    </select>                   
                    </div>
                    <div class="form-group">
                        <p>Prioridad de la tarea</p>
                        <input type="text" name="priority" value="<?php echo $priority; ?>" class="form-control" placeholder="Update Priority">                   
                    </div>
                    <div class="form-group">
                        <p>Estado de la tarea</p>
                        <input type="text" name="state" value="<?php echo $state; ?>" class="form-control" placeholder="Update State">                   
                    </div>
                    <div class="form-group">
                        <p>Vencimiento de la tarea</p>
                        <input type="date" name="expiration" class="form-control" placeholder="Update VTO" autofocus>
                    </div>
                    
                    <div class="form-group">
                        <p>Visible</p>
                        <input type="text" name="visible" value="<?php echo $visible; ?>" class="form-control" placeholder="Y o N" autofocus>
                    </div>


                    <div class="form-group">
                        <p>Comentario</p>
                        <textarea name="description" rows="10" class="form-control" placeholder="Update Description"> <?php echo $description; ?> </textarea>
                    
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
