

<?php session_start();
include("db.php");

    if (isset($_SESSION['email'])){
            
    }else{
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    }
        
    

    if(isset($_SESSION['email'])){
 
        $email = $_SESSION['email'];
        $query = "SELECT * FROM task where author='$email'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)){ ?>
            <?php 

                 ?>
                    
                    <tr> 
                        <td> <?php echo $row['title'] ?> </td>
                        <td> <?php echo $row['description'] ?> </td>
                        <?php
                            $datorojo= $row['priority'];

                            if ($datorojo == 1){
                                echo "<td style=\"background-color:red; color:white;\">". $row['priority'] . "</td>";
                            }  
                            else{
                                echo "<td style=\"background-color:none;\">". $row['priority'] ."</td>";
                            }
                        ?>                                            
                        <td> <?php echo $row['created_at'] ?> </td>
                        <td> <?php echo $row['expiration'];  ?> </td>
                        <td> <?php echo $row['state'] ?> </td>
                        <td> <?php echo $row['responsable'] ?> </td>
                        <td> <a href="show_file.php?id=<?php echo $row['id']?> "> <?php echo $row['attached'] ?> </a></td>
                        <td><?php echo $row['author'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>  
                    </tr>           
            
        <?php }
    }

?>
<?php include("includes/footer.php"); ?>