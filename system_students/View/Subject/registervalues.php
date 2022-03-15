<?php 

session_start();

if(!isset($_SESSION['id_user_S']))
{
	header("location: ../system_students");
}

$id = $_SESSION['id_user_S'];

$rol = $_SESSION['fk_rol_S'];

?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>System Students</title>
		<link rel="stylesheet" href="Styles/css/bootstrap.min.css" >
		<link rel="stylesheet" href="Styles/css/bootstrap-theme.min.css" >
		<script src="Styles/js/bootstrap.min.js" ></script>
		
		<style>
			body {
			padding-top: 20px;
			padding-bottom: 20px;
			}
		</style>
	</head>
	
	<body>
		<div class="container">
			
			<nav class='navbar navbar-default'>
				<div class='container-fluid'>
					<div class='navbar-header'>
						<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
							<span class='sr-only'>Men&uacute;</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
					</div>
					
					<div id='navbar' class='navbar-collapse collapse'>
						<ul class='nav navbar-nav'>
							<li class='active'><a href='?c=home'>Inicio</a></li>			
						</ul>					
						
                        <?php if($rol == 1){?>
						
                        <ul class='nav navbar-nav'>
                            <li><a href='?c=admin'>Administrar Usuarios</a></li>
                        </ul>
						<?php }; ?>

						<?php if($rol == 1){?>

                        <ul class='nav navbar-nav'>
                            <li><a href='?c=subject'>Asignaturas</a></li>
                        </ul>

						<?php }; ?>

						<?php if($rol == 3){?>

						<ul class='nav navbar-nav'>
                            <li><a href='?c=values'>Notas evaluativas</a></li>
                        </ul>
						<?php }; ?>
						
						<ul class='nav navbar-nav navbar-right'>
							<li><a href='?c=CloseSesion'>Cerrar Sesi&oacute;n</a></li>
						</ul>
					</div>
				</div>
			</nav>

            <div class="row">           

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">ASIGNATURAS ASIGNADAS <?php echo $id; ?></h3>
                        </div>
                        <div class="panel-body">

                            <table class="table table-bordered">
                                <thead>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>ASIGANTURA</th>
                                    <th>ESTADO</th>
                                </thead>
                                <tbody>
								<?php foreach($this->mod_sub->SearchRatingsSubject() as $ts): ?>
                                    <tr>									
                                        <td><?php echo $ts->first_name; ?></td>
                                        <td><?php echo $ts->second_name; ?></td>
                                        <td><?php echo $ts->rating_assign; ?></td>
                                        <td>
											<?php if($ts->rating_assign < 30){
													echo "REPROBADO";
											}
											else
											{ echo "APROBADO";
											}; 
											?></td>
                                        
                                    </tr>
								<?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div> 
                
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">REGISTRAR ASIGNATURA</h3>
                        </div>
                        <div class="panel-body">

                        <form id="loginform" class="form-horizontal" role="form" action="?c=saveratings" method="POST" autocomplete="off">						
							

                            <div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <select name="student" class="form-control" require>
								<?php foreach($this->mod_sub->OptionUserStudent() as $ot): ?>
                                    <option value="<?php echo $ot->id_user; ?>"><?php echo $ot->first_name." ".$ot->second_name; ?></option>
								<?php endforeach; ?>
                                </select>
							</div>

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <select name="subject" class="form-control" require>
								<?php foreach($this->mod_sub->OptionSubjectTeacher($id) as $oe): ?>
                                    <option value="<?php echo $oe->id_subject; ?>"><?php echo $oe->description_subject; ?></option>
								<?php endforeach; ?>
                                </select>
							</div>

							<div style="margin-bottom: 25px" class="input-group" require>
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="number" class="form-control" name="values" value="" placeholder="Nota" required>                                        

							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Registrar</a>
								</div>
							</div>
							
							   
						</form>

                        </div>

                    </div>
                </div> 
				
			

				

            </div>
            
		</div>
	</body>
</html>		