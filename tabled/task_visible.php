<?php session_start();
include("db.php"); 

if (isset($_SESSION['email'])){
        
}else{
    echo "<script language=Javascript> location.href=\"index.php\"; </script>";
}
?>


<?php include("includes/header.php"); ?>

<?php 
    if(isset($_SESSION['email'])){

    }else{
        
        header('Location: login.php');
    }

?>
<style>
    .card-body_content{
        display:flex;
        flex-direction:row;
        justify-content: space-between;
    }
    .card-body_codigo{
        display:flex;
        flex-direction:row;
    }
    .card-body_codigo2{
        display:flex;
        flex-direction:row;
    }

    .table{
        max-width: 100%;
        max-height: 55vh;  
    }
    .tableFixHead thead th { position: sticky; top: 0; }

</style>

<div class="conatiner p-4">
    
    <!-- Explicacion de CODIGOS -->
    
    <div class="row"> 
            <div class="tableFixHead">
                                         
                <table class="table table-sm table-hover table-responsive table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Título</th>
                            <th>Comentario</th>
                            <th>Prioridad</th>
                            <th>Inicio</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th>Adjunto</th>
                            <th>Autor</th>
                            <th>Visible </th>
                            <th>Acción</th>
                            
                        </tr>
                    </thead>  
                                                       
                    <tbody>
                    
                    <?php 
                        $email = $_SESSION['email'];
                        $rol = $_SESSION['rol'];
                        
                        /* BUSQUEDA POR TAREA */
                        $where = "where author='$email' or responsable='$email' ORDER BY `task`.`created_at` DESC";
                        if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin"){
                            $where = "ORDER BY `task`.`created_at` DESC";
                        }
                        /* $where = ""; */
                        if(isset($_POST['busqueda'])){
                            if(empty($_POST['buscar'])){
                                $buscar=$_POST['buscar'];
                                $where = "where author='$email' or responsable='$email' ";
                                if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin"){
                                    $where = "";
                                }
                                
                            }
                            else{
                                $buscar=$_POST['buscar'];
                                $where = "WHERE title LIKE '%$buscar%' and author='$email' or responsable='$email' and LIKE '%$buscar%' ";
                                if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin"){
                                    $where = "WHERE title LIKE '%$buscar%'";
                                }
                                /* where title LIKE '%$buscar%' */
                                /* $where = "WHERE title LIKE '%$buscar%'"."'&$buscarprioridad&'"; */
                            }
                        }   
                        /* BUSQUEDA POR PRIORIDAD */
                        if(isset($_POST['busquedaprioridad'])){
                            if(empty($_POST['buscarprioridad'])){
                                $buscarprioridad=$_POST['buscarprioridad'];
                                $where = "where author='$email' or responsable='$email' ";
                                if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin"){
                                    $where = "";
                                }

                            }
                            else{
                                $buscarprioridad=$_POST['buscarprioridad'];
                                $where = "WHERE priority LIKE '%$buscarprioridad%' and author='$email' or responsable='$email' and priority LIKE '%$buscarprioridad%' ";
                                /* where title LIKE '%$buscar%' */
                                /* $where = "WHERE title LIKE '%$buscar%'"."'&$buscarprioridad&'"; */
                                if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin" ){
                                    $where = "WHERE priority LIKE '%$buscarprioridad%'";
                                }
                            }
                        }

                        /* BUSQUEDA POR ESTADO */
                        if(isset($_POST['busquedaestado'])){
                            if(empty($_POST['buscarestado'])){
                                $buscarestado=$_POST['buscarestado'];
                                $where = "where author='$email' or responsable='$email' ";
                                if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin"){
                                    $where = "";
                                }

                            }
                            else{
                                $buscarestado=$_POST['buscarestado'];
                                $where = "WHERE state LIKE '%$buscarestado%' and author='$email' or responsable='$email' and state LIKE '%$buscarestado%'";
                                if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin"){
                                    $where = "WHERE state LIKE '%$buscarestado%'";
                                }
                                /* where title LIKE '%$buscar%' */
                                /* $where = "WHERE title LIKE '%$buscar%'"."'&$buscarprioridad&'"; */
                            }
                        }
                        if(isset($_POST ['orderasc'])){
                            $where = "where author='$email' or responsable='$email'  ORDER BY `task`.`created_at` ASC  ";
                            if ($_SESSION['email'] == "admin@admin" or $_SESSION['rol'] == "admin" ){
                                $where = "ORDER BY `task`.`created_at` ASC  ";
                            }
                        }

                        if(isset($_POST['orderdesc'])){
                            $where = "where author='$email' or responsable='$email' ORDER BY `task`.`created_at` DESC";
                            if ($_SESSION['email'] == "admin@admin"or $_SESSION['rol'] == "admin"){
                                $where = "ORDER BY `task`.`created_at` DESC";
                            }
                        }

                             
                        
                        /* CONSULTA Y MUESTRA DE DATOS EN TABLA */
                        $query = "SELECT *, DATE_FORMAT(expiration, '%d-%m-%Y') as expiration, DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s') as created_at FROM task $where";
                        $result_tasks = mysqli_query($conn, $query);
                        
                        
                            while ($row = mysqli_fetch_array($result_tasks)){ ?>
                                <?php 

                                    
                                    
                                    if ($row['visible'] == 'N') { ?>
                                        
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
                                            <td><?php echo $row['visible'] ?></td>
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
                                ?>

 
                            <?php } ?>
                        
                    </tbody>

                    <script> 
                        function abrirModificar(id) { 
                            window.open("edit.php?id="+id,"recogedor","width=500,height=550, top=50,left=50"); 
                            
                            return false; 
                        } 
                    </script>
                    
                </table>                 
            </div>                                    
    </div>
</div>

<?php include("includes/footer.php"); ?>