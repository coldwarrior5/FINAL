<?php
session_start();
	include_once('php_backend.php');
	
	if(!isset($_SESSION['id']))
	{
		echo "Nemate pristup!";
		exit(-1);	
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ADMINISTRATOR - Parking Garaža</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
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


		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><span>UPRAVLJAČKA PLOČA</span></a>
								
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
						<li><a href="index.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Početna</span></a></li>	
						<li><a href="#" data-toggle="modal" data-target="#add_parking"><i class="icon-plus"></i><span class="hidden-tablet"> Dodaj parkiralište</span></a></li>
						<li><a href="#" data-toggle="modal" data-target="#parking_list"><i class="icon-edit"></i><span class="hidden-tablet"> Uredi parkiralište</span></a></li>
						<li><a href="#" data-toggle="modal" data-target="#edit_clients"><i class="icon-edit"></i><span class="hidden-tablet"> Uredi klijente</span></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#edit_discount" ><i class="icon-bar-chart"></i><span class="hidden-tablet"> Uredi popust</span></a></li>
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
                    
                    <?php if(isset($_GET['parking'])) { echo 'Uređivanje parkirališta'; }?>
                    
                     <?php if(isset($_GET['user'])) { echo 'Uređivanje klijenta'; }?>
				</li>
				<li>&nbsp;</li>
			</ul>

					

			
			
	
			<?php if(count($_GET) == 0) {?>
            
            <div class="box black noMargin span10" ontablet="span10" ondesktop="span10">
            	<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Popis parkirališta</h2>
					</div>
               	<div class="box-content">
                	<div class="ticket blue box_content">
                       
                       <div class="">
                       		<table class="table bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" border="0">
						  <tr class="table_legend">
                          <td class=" sorting_1">Naziv</td>
								<td class="center ">Adresa</td>
								<td class="center ">Broj mjesta</td>
								<td class="center ">Broj slobodnih mjesta</td>
                          </tr>
						  
					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                      
                       <?php 
					
						$backend = backendCall('getAllParkings', array());
						
						
						foreach($backend as $element)
						{
					?>
                      <tr class="even" style="border: none important;">
								<td class=" sorting_1"><?php echo $element['naziv'];?></td>
								<td class="center "><?php echo $element['adresa'];?></td>
								<td class="center "><?php echo $element['brojMjesta'];?></td>
								<td class="center "><?php echo $element['brojSlobodnihMjesta'];?></td>
	
							</tr>
                            <?php } ?>
                            
                            </tbody></table>
                       </div>
                       
                    </div>

                </div>
                    
            </div>
			
			<?php } ?>
            
            <?php if(isset($_GET['parking'])) {?>
            	
                <div class="box black noMargin span10" ontablet="span10" ondesktop="span10">
            	<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Uredi parkiralište</h2>
					</div>
               	<div class="box-content">
                	<div class="ticket blue box_content">
                       
                       <div class="">
                       
                       <?php $backend = backendCall('getParkingInfo', array('id' => $_GET['parking']));?>
                       
                       		<form action="actions/edit_parking.php" id="edit_parking_form" method="post"><br>
                            
                            <input name="id" type="hidden" value="<?php echo $backend['id']; ?>">
Naziv<br>

                	<input name="name" class="form-control" type="text" placeholder="Ime" value="<?php echo $backend['naziv']; ?>"><br>
Adresa<br>

                    <input name="address" class="form-control" type="text"  placeholder="Adresa" value="<?php echo $backend['adresa']; ?>"><br>
Zemljopisna Širina<br>

                    <input name="latitude" class="form-control" type="text"  placeholder="Zemljopisna širina" value="<?php echo $backend['zemljopisnaSirina']; ?>"><br>
Zemljopisna dužina<br>

                    <input name="longitude" class="form-control" type="text"  placeholder="Zemljopisna dužina" value="<?php echo $backend['zemljopisnaDuzina']; ?>"><br>
Broj mjesta<br>

                    <input name="spots" class="form-control" type="text"  placeholder="Broj mjesta" value="<?php echo $backend['brojMjesta']; ?>">
                    <br>

                    <?php 
					
						$backendx = backendCall('getParkingTypes', array());
						
						
					?>
         Tip parkirališta<br>
           
                    <select name="type" class="form-control">
                    	<?php foreach($backendx as $element) { ?>
                    
                      <option value="<?php echo $element['id'] ?>"><?php echo $element['name'] ?></option>
                      <?php } ?>
                    </select>
Cijena<br>

                    <input name="price" class="form-control" type="text"  placeholder="Cijena" value="<?php echo $backend['cijena']; ?>">
                <br>

                 <button type="button" class="btn btn-danger" onclick="$('#edit_parking_form').submit();" >Promijeni</button>
                </form>
                
               
                       </div>
                       
                    </div>

                </div>
                    
            </div>
                
                
            <?php } ?>
            
            
             <?php if(isset($_GET['user'])) {?>
            	
                <div class="box black noMargin span10" ontablet="span10" ondesktop="span10">
            	<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Uredi klijenta</h2>
					</div>
               	<div class="box-content">
                	<div class="ticket blue box_content">
                       
                       <div class="">
                       
                       <?php $backend = backendCall('getUserInfo', array('id' => $_GET['user']));?>
                       
                       		<form action="actions/edit_user.php" id="edit_user_form" method="post"><br>
                            
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

                 <button type="button" class="btn btn-danger" onclick="$('#edit_user_form').submit();" >Promijeni</button>
                </form>
                
               
                       </div>
                       
                    </div>

                </div>
                    
            </div>
                
                
            <?php } ?>
					
			
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
	
        <!-- MODALI -->
<div class="modal fade" id="add_parking" tabindex="-1" role="dialog" aria-labelledby="myLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModal-label1">Dodaj parkiralište</h4>
			</div>
			<div class="modal-body">
				
                <form action="actions/add_parking.php" id="app_parking_form" method="post">
                	<input name="name" class="form-control" type="text" placeholder="Ime">
                    <input name="address" class="form-control" type="text"  placeholder="Adresa">
                    <input name="latitude" class="form-control" type="text"  placeholder="Zemljopisna širina">
                    <input name="longitude" class="form-control" type="text"  placeholder="Zemljopisna dužina">
                    <input name="spots" class="form-control" type="text"  placeholder="Broj mjesta">
                    
                    <?php 
					
						$backend = backendCall('getParkingTypes', array());
						
					
					?>
                    
                    <select name="type" class="form-control">
                    	<?php foreach($backend as $element) { ?>
                    
                      <option value="<?php echo $element['id'] ?>"><?php echo $element['name'] ?></option>
                      <?php } ?>
                    </select>
                    <input name="price" class="form-control" type="text"  placeholder="Cijena">
                </form>
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
				<button type="button" class="btn btn-primary" onClick="$('#app_parking_form').submit();">Dodaj</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="parking_list" tabindex="-1" role="dialog" aria-labelledby="myLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModal-label">Uredi parkiralište</h4>
			</div>
			<div class="modal-body">
				
                <div class="">
                       		<table class="table bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" border="0">
						  <tr class="table_legend">
                          <td class=" sorting_1">Naziv</td>
								<td class="center ">Akcija</td>
								
                          </tr>
						  
					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                      
                       <?php 
					
						$backend = backendCall('getAllParkings', array());
						
						
						foreach($backend as $element)
						{
					?>
                      <tr class="even" style="border: none important;">
								<td class=" sorting_1"><?php echo $element['naziv']; ?></td>
								<td class="center "><span data-edit="<?php echo $element['id']; ?>" onClick="window.location = 'index.php?parking=<?php echo $element['id']; ?>'" class="label label-success" style="cursor: pointer;">Uredi</span></td>
	
							</tr>
                            
                           <?php } ?>
                            
                            
                            </tbody></table>
                       </div>
                
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="edit_clients" tabindex="-1" role="dialog" aria-labelledby="myLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModal-label">Uredit klijente</h4>
			</div>
			<div class="modal-body">
				
                
                <table class="table bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" border="0">
						  <tr class="table_legend">
                          <td class=" sorting_1">Ime i prezime</td>
								<td class="center ">Akcija</td>
                          </tr>
						  
					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                      
                       <?php 
					
						$backend = backendCall('getAllUsers', array());
						
						
						foreach($backend as $element)
						{
					?>
                      <tr class="even" style="border: none important;">
								<td class=" sorting_1"><?php echo $element['ime']." ".$element['prezime'];?></td>
								<td class="center "><span data-edit="<?php echo $element['id']; ?>" onClick="window.location = 'index.php?user=<?php echo $element['id']; ?>'" class="label label-success" style="cursor: pointer;">Uredi</span></td>

	
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


<div class="modal fade" id="edit_discount" tabindex="-1" role="dialog" aria-labelledby="myLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModal-label">Promjeni popust</h4>
			</div>
			<div class="modal-body">
				
                
                 <form action="actions/edit_discount.php" id="discount_form" method="post">
                 Postotak popusta za prijavljene korisnike<br>
                 
                 <?php
                 	$backend = backendCall('getDiscount', array());
				 ?>
                 
                	<input name="percent" class="form-control" type="text" placeholder="Ime" value="<?php echo $backend['iznos']; ?>">
                    </form>
                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
				<button type="button" class="btn btn-primary" onclick="$('#discount_form').submit();">Spremi</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODALI -->


        
        
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
