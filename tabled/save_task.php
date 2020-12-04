<?php session_start();
include("db.php");

    if (isset($_SESSION['email'])){
            
    }else{
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    }

    if (isset($_POST['save_task'])){

        $nombre = $_FILES ['attached']['name'];
        $tipo = $_FILES ['attached']['type'];
        $size = $_FILES ['attached']['size'];
        $ruta = $_FILES ['attached']['tmp_name'];
        $destino = "upload_files/" . $nombre;
        if ($nombre !=""){
            copy($ruta, $destino);
        }
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $expiration = $_POST['expiration'];
        $responsable = $_POST['responsable'];
        $state = $_POST['state'];
        $email = $_SESSION['email'];
        $visible = $_POST['visible'];
       
    
        $query = "INSERT INTO task(title, description, priority, expiration, responsable, state, attached, author, visible) VALUES ('$title', '$description','$priority', '$expiration', '$responsable', '$state', '$nombre', '$email', '$visible')";
        $result = mysqli_query($conn, $query);

        if (!$result){
            die('Query Failed');
        }

        /* $_SESSION['message'] = 'Task Saved Succesfully';
        $_SESSION['message_type'] = 'success'; */

        header("Location: index.php");
    }

?>

