<?php 
    
    session_start();

    include("db.php"); 

    if (isset($_SESSION['email'])){
        
    }else{
        header('Location: login.php');
    }

?>


<?php include("includes/header.php"); ?>



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
    .tableFixHead          {  }
    .tableFixHead thead th { position: sticky; top: 0; }
    
    
</style>

<div class="conatiner p-4">
    
    <!-- Explicacion de CODIGOS -->
    <div class="card">
        <div id="codigos" class="card-body ">
            <p><b>CODIGOS</b></p>
                <div class="card-body_content">
                    <div class="card-body_codigo">                 
                        <p><b>ESTADO:</b> <b>P:</b> En proceso <b>R:</b> Registrada <b>F:</b> Finalizada </p>  
                    </div>
                    <div class="card-body_codigo2">                 
                        <p><b>PRIORIDAD:</b> <b>1:</b> Urgente <b>2:</b> Intermedia <b>3:</b> Baja </p>  
                    </div>
                
                </div>
        </div>
    </div>

    <!-- INPUTS BUSQUEDA -->
    <div class="card" id="busquedas">
        <h4 class="text-dark m-2">Búsquedas</h4>
        <div class="card-body justify-content-center align-self-center">
            <div class="card-body_content">
                <div class="card-body_codigo">                 
                    <div class="container justify-content-center align-self-center">
                        <!-- INPUTS DE BUSQUEDA -->
                        
                        <form action="index.php" method="POST" class="form-inline form-group">
                            <input class="text m-2" type="text" name="buscar" placeholder="Busqueda por tarea...">
                            <input class="btn btn-primary btn-sm mx-2" type="submit" name="busqueda" value="Buscar por tarea">
                            <input class="text mx-2" type="text" name="buscarprioridad" placeholder="Busqueda por prioridad...">
                            <input class="btn btn-primary btn-sm mx-2" type="submit" name="busquedaprioridad" value="Buscar por prioridad">
                            <input class="text mx-2" type="text" name="buscarestado" placeholder="Busqueda por estado...">
                            <input class="btn btn-primary btn-sm mx-2" type="submit" name="busquedaestado" value="Buscar por estado">  
                            <input class="btn btn-success btn-sm mx-2" type="submit" name="orderasc" value="Ordenar ascendente">
                            <input class="btn btn-success btn-sm" type="submit" name="orderdesc" value="Ordenar descendente">
                        </form>
                        <div class="container">
                            <div class="row">
                                <form action="task_finish.php">
                                <input class="btn btn-warning btn-sm " type="submit" name="task_finish" value="Tareas finalizadas">
                                </form>
                                <form action="task_visible.php">
                                <input class="btn btn-warning btn-sm ml-2" type="submit" name="task_finish" value="Tareas No visibles">
                                </form>
                            </div>
                            
                        </div>
                        
    
                     </div> 
                </div>
            </div>
        </div>
    </div>

    
    <div class="card">
        
        <form action="save_task.php" method="POST" enctype="multipart/form-data">
            <div class="form-row" >
                <div class="col">
                    <p class="titulos">Tarea</p>
                    <input type="text" name="title" class="form-control" placeholder="Tarea" autofocus required>
                </div>
                <div class="col">
                    <p class="titulos">Responsable</p>
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
                <div class="col">
                    <p class="titulos">Prioridad</p>
                    <select name="priority" id="priority" class="form-control" autofocus required>
                        <option value="2">2 [Intermedia]</option>
                        <option value="1">1 [Urgente]</option>
                        <option value="3">3 [Baja]</option>
                    </select>
                </div>
                <div class="col">
                    <p class="titulos">Estado</p>
                    <select name="state" id="state" class="form-control" autofocus required>
                        <option value="R">R [Registrada]</option>
                        <option value="P">P [En proceso]</option>
                        <option value="F">F [Finalizada]</option>
                    </select>
                </div>
                <div class="col">
                    <p class="titulos">Vencimiento tarea</p>
                    <input type="date" name="expiration" class="form-control" placeholder="Vencimiento de la tarea" autofocus>
                </div>                         
            </div>
            <br>
            <div class="form-row">
                <div class="col">
                    <p class="titulos">Adjuntar archivo</p>
                    <input type="file" name="attached" class="form-control" autofocus>
                </div>
                <div class="col">
                        <p class="titulos">Visible</p>
                        <input type="text" name="visible" class="form-control" placeholder="Y o N" autofocus>
                    </div>
                    <div class="col">
                        <p class="titulos">Comentario</p>
                        <textarea name="description" id="" rows="1" class="form-control" placeholder="Comentario de la tarea"></textarea>
                    </div>
                                     
                </div>
                <br>
                <div class="col">
                        <input type="submit" class="btn btn-success btn-block " name="save_task" value="Guardar" autofocus>
                </div>   
                <br>
                
        </form>
    </div>
      
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
                            if ($_SESSION['email'] == "admin@admin"){
                                $where = "ORDER BY `task`.`created_at` DESC";
                            }
                        }

                             
                        
                        /* CONSULTA Y MUESTRA DE DATOS EN TABLA */
                        $query = "SELECT *, DATE_FORMAT(expiration, '%d-%m-%Y') as expiration, DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s') as created_at FROM task $where";
                        $result_tasks = mysqli_query($conn, $query);
                        
                        
                            while ($row = mysqli_fetch_array($result_tasks)){ ?>
                                <?php 

                                    
                                    
                                    if ($row['state'] != 'F' && $row['visible'] =='Y') { ?>
                                        
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

