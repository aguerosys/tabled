<?php session_start();

include ("db.php");

    if (isset($_SESSION['email'])){
            
    }else{
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    }

    if (isset($_POST['save_login'])){
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT) ;
        $email = $_POST['email'];
        $rol = $_POST['rol'];
        
        $query = "INSERT INTO user(name, pass, email, rol) VALUES ('$name', '$password','$email', '$rol')";
        $result = mysqli_query($conn, $query);

        if (!$result){
            die("Query Failed");
        }

        header('Location: login.php');
        /* $_SESSION['message'] = 'Register Saved Succesfully';
        $_SESSION['message_type'] = 'success'; */


    }

?>