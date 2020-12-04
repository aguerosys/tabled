<?php 
	session_start();
 include("db.php");

    if (isset($_SESSION['email'])){
            
    }else{
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    }

 include ("includes/header.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM task where id=$id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_array($result)){ 
           if($row['attached'] == "") {?>    
                <p>No tiene archivos</p>
            
           <?php } else { ?>
           <div class="attached-center"><iframe src="upload_files/<?php echo $row['attached']; ?>"></iframe></div>
        <?php } }  
    }
?>

<style>
    .attached-center{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    iframe{
        width: 80%;
        height: 90vh;
    }

</style>
        


<?php  include ("includes/footer.php"); ?>
