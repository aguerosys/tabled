
<?php session_start();

include("db.php");

if (isset($_SESSION['email'])){
        
}else{
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}

?>


<?php   
    
    if(isset($_SESSION['email'])){
        $user = $_SESSION['email'];
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "DELETE FROM user WHERE id = $id";
            $result = mysqli_query($conn, $query);
            if(!$result){
                die("Query Failed");
            }
    
           /*  $_SESSION['message'] = 'Task Removed Succesfully';
            $_SESSION['message_type'] = 'danger'; */
            /* header("Location: index.php"); */
            echo "<script language=Javascript> location.href=\"index.php\"; </script>";
            
        }  
    }   
?>    



