<?php include("db.php"); ?>
<?php include("login/db_login.php"); ?>
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

</style>
<div class="conatiner p-4">
    <div class="card">
        <div class="card-body">
            <p class="titulos">Codigos</p>
                <div class="card-body_content">
                    <div class="card-body_codigo">                 
                        <p><b>ESTADO:</b> <b>P:</b> En proceso <b>R:</b> Registrada <b>F:</b> Finalizada </p>  
                    </div>
                    <div class="card-body_codigo2">                 
                        <p><b>PRIORIDAD:</b> <b>1:</b> Urgencia <b>2:</b> Intermedio <b>3:</b> Lento </p>  
                    </div>
                
                </div>
                
        
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

            <?php
                if(isset($_SESSION['message'])){ ?>
                <div class="alert alert-<?= $_SESSION['message_type'];  ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>   
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
</div>
                <?php session_unset();} ?>
            <div class="card card-body">
                <form action="save_task.php" method="POST">
                    <div class="form-group">
                        <p class="titulos">Tarea</p>
                        <input type="text" name="title" class="form-control" placeholder="Tarea" autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Responsable</p>
                        <input type="text" name="responsable" class="form-control" placeholder="Responsable" autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Prioridad</p>
                        <input type="text" name="priority" class="form-control" placeholder="Prioridad de la tarea" value="2" autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Estado</p>
                        <input type="text" name="state" class="form-control" placeholder="Estado de la tarea" value="R" autofocus>
                    </div>
                    <div class="form-group">
                        <p class="titulos">Vencimiento tarea</p>
                        <input type="date" name="expiration" class="form-control" placeholder="Vencimiento de la tarea" autofocus>
                    </div>
                    <div class="form-grup">
                        <p class="titulos">Comentario</p>
                        <textarea name="description" id="" rows="2" class="form-control" placeholder="Comentario de la tarea"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar">
                </form>
            </div>
        </div>
        <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Comentario</th>
                            <th>Prioridad</th>
                            <th>Inicio</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th>Acción</th>
                            
                        </tr>
                    </thead>
                    
                       
                    <tbody>
                     <?php 
                       
                       $where = "";
                       if(isset($_POST['busqueda'])){
                           if(empty($_POST['buscar'])){
                               $buscar=$_POST['buscar'];
                               $where = "";
                           }
                           else{
                               $buscar=$_POST['buscar'];
                               $where = "WHERE title LIKE '%$buscar%'";
                           }
                       }   
                       $query = "SELECT * FROM task $where";
                        $result = mysqli_query($conn, $query);
                        
                        while ($row = mysqli_fetch_array($result)){ ?>
                            <tr>
                                <td> <?php echo $row['title'] ?> </td>
                                <td> <?php echo $row['description'] ?> </td>
                                <td> <?php echo $row['priority'] ?> </td>
                                <td> <?php echo $row['created_at'] ?> </td>
                                <td> <?php echo $row['expiration'] ?> </td>
                                <td> <?php echo $row['state'] ?> </td>
                                <td> <?php echo $row['responsable'] ?> </td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>

                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table> 
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>