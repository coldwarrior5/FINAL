<?php
	session_start();
	include_once('php_backend.php');
	
	if(!isset($_SESSION['id']))
	{
		echo "nemate pristup";
		exit(-1);
	}
	
	$id = $_SESSION['id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>KORISNIK - Parking Garaža</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>

<!-- MODALI -->




<div class="modal fade" id="change_info" tabindex="-1" role="dialog" aria-labelledby="change_info-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModal-label">Promijeni informacije</h4>
			</div>
			<div class="modal-body">
				
                <div class="">
                       
                       <?php $backend = backendCall('getUserInfo', array('id' => $id));?>
                       
                       		<form action="actions/edit_user_user.php" id="edit_user_form" method="post"><br>
                            
                            <input name="id" type="hidden" value="<?php echo $backend['id']; ?>">
Ime<br>

                	<input name="name" class="form-control" type="text" placeholder="Ime" value="<?php echo $backend['ime']; ?>"><br>
Prezime<br>

                    <input name="surname" class="form-control" type="text"  placeholder="Prezime" value="<?php echo $backend['prezime']; ?>"><br>
OIB<br>

                    <input name="oib" class="form-control" type="text"  placeholder="oib" value="<?php echo $backend['oib']; ?>"><br>
Adresa<br>

                    <input name="address" class="form-control" type="text"  placeholder="adresa" value="<?php echo $backend['adresa']; ?>"><br>
Email<br>

                    <input name="email" class="form-control" type="text"  placeholder="email" value="<?php echo $backend['email']; ?>">
                    <br>


Broj kreditne kartice<br>

                    <input name="card" class="form-control" type="text"  placeholder="broj kreditne kartice" value="<?php echo $backend['brojKartice']; ?>">
                <br>
                Telefon<br>

                <input name="phone" class="form-control" type="text"  placeholder="telefon" value="<?php echo $backend['telefon']; ?>">
                <br>

                
                </form>
                
               
                       </div>
                
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
				<button type="button" onClick="$('#edit_user_form').submit();" class="btn btn-primary">Spremi</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_password-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModal-label">Promjena lozinke/korisnickog imena</h4>
			</div>
			<div class="modal-body">
				
                <form action="actions/change_pass.php" id="change_pass_form" method="post">
                	<?php $backend_modal = backendCall('getUserInfo', array('id' => $id)); ?>
                    
                    
               	  <input name="id" type="hidden" value="<?php echo $id; ?>">
                    <input name="username" class="form-control" type="text"  value="<?php echo $backend_modal['korisnickoIme']; ?>"><br>
                	<input name="password" class="form-control" type="password"  placeholder="Nova lozinka"><br>
					<input name="repassword" class="form-control" type="password"  placeholder="Ponovite lozinku">
                
                </form>
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
				<button type="button" onclick="$('#change_pass_form').submit();" class="btn btn-primary">Spremi</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="change_subs" tabindex="-1" role="dialog" aria-labelledby="change_subs-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModal-label">Trajne rezervacije</h4>
			</div>
			<div class="modal-body">
				
                <table class="table bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" border="0">
						  <tr class="table_legend">
                          <td class=" sorting_1">Naziv</td>
								<td class="center ">Akcija</td>
                          </tr>
						  
					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                      
                       <?php 
					
						$backend = backendCall('getSubscriptions', array('id' => $id));
						
						foreach($backend as $element)
						{
					?>
                      <tr class="even" style="border: none important;">
								<td class="center "><?php echo $element['idParkiralista'];?></td>
								<td class="center "><span onClick="window.location = 'delete_subscription.php?id=<?php echo $element['id']; ?>'" class="label label-important" style="cursor: pointer;">Obriši</span></td>
	
							</tr>
                            <?php } ?>
                            
                            </tbody></table>
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
			</div>
		</div>
	</div>
</div>

<!-- END MODALI -->


		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><span>UPRAVLJAČKA PLOČA - korisnik</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">

						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Postavke</span>
								</li>
								<li><a href="logout.php"><i class="halflings-icon off"></i> Odjava</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="user.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Početna</span></a></li>	
						<li><a href="#" data-toggle="modal" data-target="#change_info"><i class="icon-edit"></i><span class="hidden-tablet"> Promijeni informacije</span></a></li>
						<li><a href="#" data-toggle="modal" data-target="#change_password"><i class="icon-edit"></i><span class="hidden-tablet"> Promijeni lozinku/korisničko ime</span></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#change_subs"><i class="icon-calendar"></i><span class="hidden-tablet"> Trajne rezervacije</span></a></li>
						
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" style="min-height: 1000px;" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">Početna</a> 
					<i class="icon-angle-right"></i>
                 
				</li>
				<li>&nbsp;</li>
			</ul>

					

			
			
	
			
            
            <div class="box black noMargin span10" ontablet="span10" ondesktop="span10">
            	<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Informacije o korisniku</h2>
					</div>
               	<div class="box-content">
                	<div class="ticket blue box_content">
                       
                       <div class="">
                       
                       	<?php 
							$backend = backendCall('getUserInfo', array('id' => $id));
							
							echo $backend['ime']." ".$backend['prezime'];
							
						?><br><br>


						OIB: <?php echo $backend['oib'];?><br><br>
                        <?php echo $backend['adresa'];?><br><br>
                        Datum rođenja: <?php echo $backend['datumRodenja'];?><br><br>
                        <?php echo $backend['email'];?><br><br>
                        <?php echo $backend['telefon'];?><br><br>
                        Broj kartice: <?php echo $backend['brojKartice'];?><br><br>


                       
                       </div>
                       
                    </div>

                </div>
                    
            </div>
			
			

            
            

					
			
			<!--/row-->
			
       
</div>
	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	
	
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 OPP projekt - Parking Garaža - Snjeguljice</span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
