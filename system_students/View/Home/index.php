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
							<li class='active'><a href='?c=home'>Inicio </a></li>			
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
			
			<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">HOME</h3>
                </div>

                <div class="panel-body">

					<?php if($rol == 2){ ?>
                    <table class="table table-bordered">
						<thead>
							<th>ASIGNATURA</th>
							<th>CALIFICACIÓN</th>
							<th>ESTADO</th>

						</thead>
						<?php foreach($this->mod_sub->ValueStudent($id) as $qs): ?>
							<tr>									
								<td><?php echo $qs->description_subject; ?></td>
								<td><?php echo $qs->rating_assign; ?></td>
								<td>
											<?php if($qs->rating_assign < 30){
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
					<?php }; ?>
                </div>


            </div>
		</div>
	</body>
</html>		