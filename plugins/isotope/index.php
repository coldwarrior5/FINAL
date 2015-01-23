<?php
	session_start();
	include_once('admin/php_backend.php');
	
	$UserId = NULL;
	
	if(isset($_SESSION['id']))
	{
    	 $UserId = $_SESSION['id'];
	}
	
?>
<!DOCTYPE html>
<html data-ng-app="myApp" lang="hr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Gradski parking">
        <meta name="author" content="Snjeguljice">
        <link rel="icon" href="http://www.regencysecureparking.co.uk/images/128px-Parking_icon.png">
        
        <title>Gradski parking d.o.o.</title>
        
        <!-- Web Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Font Awesome CSS -->
	<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- Plugins -->
	<link href="css/animations.css" rel="stylesheet">

	<!-- Worthy core CSS file -->
	<link href="css/style.css" rel="stylesheet">

	<!-- Custom CSS --> 
	<link href="css/custom.css" rel="stylesheet">

	<!-- Html Coder Add -->
	<link href="css/style.css" rel="stylesheet">
        
        <!-- Datepicker CSS -->
	<link href="css/datepicker.css" rel="stylesheet">
        
        <!-- Google maps CSS -->
        <link href="css/mapStyle.css" rel="stylesheet">
        
        <!-- Google Maps api -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        
        <!-- Google Maps javascript -->
        <script src="js/mapScript.js"></script>
        
        <!-- Angluar.js -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.8/angular.min.js"></script>
        <script type="text/javascript" src="js/promise-tracker.js"></script>
        <script type="text/javascript" src="plugins/jquery.min.js"></script>
        
        <!-- Backstretch javascript -->
        <script type="text/javascript" src="plugins/jquery.backstretch.min.js"></script>

        <!-- Appear javascript -->
        <script type="text/javascript" src="plugins/jquery.appear.js"></script>
        
        <script type="text/javascript" src="js/app.js"></script>
        
         <!-- Datepicker -->
         <script src="js/bootstrap-datepicker.js" charset="UTF-8"></script>
         
         <!-- Datepicker croatian -->
         <script src="js/locales/bootstrap-datepicker.hr.js" charset="UTF-8"></script>
        
        <!-- reCaptcha javascript -->
        <script type="text/javascript">
            var userId = '<?php echo $UserId; ?>';
            var response;
            var verifyCallback = function(input) {
                response=input;
            };
            var widgetId;
            var onloadCallback = function() {
                // Renders the HTML element with id 'example1' as a reCAPTCHA widget.
                // The id of the reCAPTCHA widget is assigned to 'widgetId1'.
                widgetId=grecaptcha.render('example1', {
                    'sitekey' : '6LcjUQATAAAAACms3TpJpw8511P_fdojuSnQTlLK',
                    'callback' : verifyCallback,
                    'theme' : 'light'
                });
                resetCaptcha();
            };
            function resetCaptcha(){
                angular.element(document.querySelectorAll('.pls-container')).remove();
                grecaptcha.reset(widgetId); 
            };
        </script>
        <!-- User location -->
        <script>
            userLocate();
           <?php $map = backendCall('getAllParkings', array());
                    foreach($map as $element) { ?>
                        addParking(<?php echo str_replace(",", ".", $element["zemljopisnaSirina"]);?>,<?php echo str_replace(",", ".", $element["zemljopisnaDuzina"]);?>, "<?php echo $element["naziv"]; ?>","<?php echo $element["adresa"]."<br/>Vrsta parkirališta: ".$element["tip"]."<br/>Broj slobodnih mjesta: ".$element["brojSlobodnihMjesta"]."<br/>Cijena parkirališta: ".$element["cijena"]." HRK"; ?>");
            <?php    
                    }
            ?>
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    </head>
    <body class="no-trans">
		<div id="fb-root"></div>
                <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=513799982095485&version=v2.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                  </script>

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

		<!-- header start -->
		<!-- ================ --> 
		<header class="header fixed clearfix navbar navbar-fixed-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4">

						<!-- header-left start -->
						<!-- ================ -->
						<div class="header-left clearfix">

							<!-- logo -->
							<div class="logo smooth-scroll" style="text-align: left">
                                                            <a href="#banner"><img id="logo" src="images/logo.jpg" alt="Logo tvrtke" ></a>
							</div>

							<!-- name-and-slogan -->
							<div class="site-name-and-slogan smooth-scroll">
								<div class="site-name"><a href="#banner">Zagreb Parking</a></div>
                                                                <div class="site-slogan"><a href="#banner" onmouseover="" style="text-decoration: none;color: white">Online usluge parkinga</a></div>
							</div>

						</div>
						<!-- header-left end -->

					</div>
					<div class="col-md-8">

						<!-- header-right start -->
						<!-- ================ -->
						<div class="header-right clearfix">

							<!-- main-navigation start -->
							<!-- ================ -->
							<div class="main-navigation animated">

								<!-- navbar start -->
								<!-- ================ -->
								<nav class="navbar navbar-default" role="navigation">
									<div class="container-fluid">

										<!-- Toggle get grouped for better mobile display -->
										<div class="navbar-header">
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
										</div>

										<!-- Collect the nav links, forms, and other content for toggling -->
										<div class="collapse navbar-collapse scrollspy smooth-scroll" id="navbar-collapse-1">
											<ul class="nav navbar-nav navbar-right">
                                                                                                <li><a href="#clients">Parkirališta</a></li>
												<li><a href="#about">O nama</a></li>
												
                                                                                                <?php if($UserId !== NULL){ echo "<li><a href=\"#reservation\">Rezerviraj</a></li>";}
                                                                                                else {}?>
												<li><a href="#contact">Kontakt</a></li>
                                                <?php if($UserId != NULL) { ?><li><a href="admin/user.php">Upravljačka ploča</a></li><?php }?>
                                                                                                <?php if($UserId === NULL){ echo "<li  onmouseover=\"\" style = \"cursor: pointer\" ><a  data-toggle=\"modal\" data-target=\"#loginModal\">Prijava</a></li>";}
                                                                                                else { echo "<li> <a href=\"logout.php\">Odjava</a> </li>"; }?>
											</ul>
										</div>
                                                                                
									</div>
								</nav>
								<!-- navbar end -->

							</div>
							<!-- main-navigation end -->

						</div>
						<!-- header-right end -->

					</div>
				</div>
			</div>
		</header>
		<!-- header end -->

		<!-- banner start -->
		<!-- ================ -->
		<div id="banner" class="banner">
			<div class="banner-image"></div>
			<div class="banner-caption">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 object-non-visible" data-animation-effect="fadeIn">
							<h1 class="text-center">Mi smo <span>Zagreb parking</span></h1>
                                                            <div class="space">
                                                        </div>
							<p class="lead text-center">Već 80 godina surađujemo sa tijelima uprave grada Zagreba kako bi osigurali jednostavno i ugodno parkiranje u gradu Zagrebu.<br/> Naše usluge dostupne su svim vlasnicima automobila i motora.<br/> Veselimo se suradnji sa vama.</p>
							
                                                        
                                                        
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- banner end -->
                
                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-ng-controller="login">
                  <div class="modal-dialog" >
                    <div class="modal-content">
                            <div class="modal-header">
                        <div class="row">
                              <div class="col-xs-2"><img src="images/logo.jpg" alt="Logo tvrtke"  /></div><div class="col-xs-4" style="text-align: left; "><h4 style="font-size: 20px">Zagreb parking</h4></div>
                          </div>
                        </div>
                      <div class="modal-body">
                          <div id="messages_login" class="alert alert-success" data-ng-show="messages_login" data-ng-bind="messages_login"></div>
                          <form role="form" id="footer-form1" name="loginForm" novalidate>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Korisničko ime" name="username" data-ng-model="username" required>
                                        <i class="fa fa-user form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && loginForm.username.$error.required">Potrebno je  korisničko ime!</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Lozinka" name="password" data-ng-model="password" required>
                                        <i class="fa fa-lock form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && loginForm.password.$error.required">Lozinka je potrebna!</div>
                                
                        </form>
                      </div>
                      <div class="modal-footer">
                          <div class="row">
                              <div class="col-xs-4" style="text-align: left">Niste registrirani?<br/><b onmouseover="" style = "cursor: pointer;color: blue" onclick="javascript:register();">Registracija</b></div>
                              <div class="col-xs-8">
                                    <button type="button" class="btn btn-default" aria-hidden="true" data-dismiss="modal">Zatvori</button>
                                    <button type="button" class="btn btn-primary" data-ng-click="submit(loginForm)">Prijavi se</button>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-ng-controller="register">
                  <div class="modal-dialog" >
                    <div class="modal-content">
                            <div class="modal-header">
                        <div class="row">
                              <div class="col-xs-2"><img src="images/logo.jpg" alt="Logo tvrtke"  /></div><div class="col-xs-4" style="text-align: left; "><h4 style="font-size: 20px">Zagreb parking</h4></div>
                          </div>
                        </div>
                      <div class="modal-body">
                          <div id="messages_login" class="alert alert-success" data-ng-show="messages_register" data-ng-bind="messages_register"></div>
                          <form role="form" id="footer-form2" name="registerForm" novalidate>
                                <div class="form-group has-feedback">
                                    <label class="sr-only" for="nameUser">nameUser</label>
                                    <input type="text" class="form-control" id="nameUser" placeholder="Ime" name="nameUser" data-ng-model="nameUser" required>
                                    <i class="fa fa-tag form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.nameUser.$error.required">Potrebno je ime!</div>
                                <div class="form-group has-feedback">
                                    <label class="sr-only" for="surnameUser">surnameUser</label>
                                    <input type="text" class="form-control" id="surnameUser" placeholder="Prezime" name="surnameUser" data-ng-model="surnameUser" required>
                                    <i class="fa fa-tag form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.surnameUser.$error.required">Potrebno je prezime!</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="usernameRegister">Username</label>
                                        <input type="text" class="form-control" id="usernameRegister" placeholder="Korisničko ime" name="usernameRegister" data-ng-model="usernameRegister" required>
                                        <i class="fa fa-user form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.username.$error.required">Potrebno je  korisničko ime!</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email adresa" name="email" data-ng-model="email" required>
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.email.$error.required">Email adresa potrebna!</div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.$error.email">Pogrešna email adresa!</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" ng-class="passwordRegister" ng-keyup="validate()" class="form-control" id="passwordRegister" placeholder="Lozinka" name="passwordRegister" data-ng-model="passwordRegister" required>
                                        <i class="fa fa-lock form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.passwordRegister.$error.required">Lozinka je potrebna!</div>
                                <div class="form-group has-feedback" data-ng-show="showPassword">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" ng-class="passwordRegister2" ng-keyup="checkup()" class="form-control" id="passwordRegister2" placeholder="Ponovi lozinku" name="passwordRegister2" data-ng-model="passwordRegister2" required>
                                        <i class="fa fa-shield form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.passwordRegister2.$error.required">Lozinke se ne poklapaju!</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="OIB">OIB</label>
                                        <input type="text" maxlength="11"   class="form-control" id="OIB" placeholder="OIB" name="OIB" data-ng-model="OIB" required>
                                        <i class="fa fa-male form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.OIB.$error.required">OIB je potreban</div>
                                <div class="form-group has-feedback">
                                    <label class="sr-only" for="datepicker">Date</label>
                                    <script type = "text/javascript">
                                        var date_register = new Date();
                                        date_register.setYear(date_register.getFullYear()-18);
                                            $(document).ready(function () {
                                                $("#datepicker").datepicker({
                                                        format: "dd/mm/yyyy",
                                                        startView: 2,
                                                        clearBtn: true,
                                                        language: "hr",
                                                        endDate: date_register
                                                    }
                                                ).on('changeDate', function(e){
                                                    $(this).datepicker('hide');
                                                });
                                            });
                                        </script>
                                        <input type = "text" id = "datepicker" datepicker class="form-control" placeholder="Datum rođenja" name="datepicker" data-ng-model="datepicker" required/>
                                    <i class="fa fa-calendar form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.datepicker.$error.required">Datum rođenja je potreban!</div>
                                <div class="form-group has-feedback" >
                                        <label class="sr-only" for="Address">Adresa</label>
                                        <input type="text" ng-class="Address" class="form-control" id="Address" placeholder="Adresu stanovanja" name="Address" data-ng-model="Address" required>
                                        <i class="fa fa-home form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.Address.$error.required">Adresa je potrebna!</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="telephone">Telefon</label>
                                        <input type="text" maxlength="16"   class="form-control" id="telephone" placeholder="Telefonski broj" name="telephone" data-ng-model="telephone" required>
                                        <i class="fa fa-credit-card form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.telephone.$error.required">Broj telefona je potreban</div>
                                <div class="form-group has-feedback">
                                        <label class="sr-only" for="Credit">Kartica</label>
                                        <input type="text" maxlength="16"   class="form-control" id="Credit" placeholder="Broj kreditne kartice" name="Credit" data-ng-model="Credit" required>
                                        <i class="fa fa-credit-card form-control-feedback"></i>
                                </div>
                                <div class="alert alert-danger" data-ng-show="submitted && registerForm.Credit.$error.required">Kreditna kartica je potrebna</div>
                                
                        </form>
                      </div>
                      <div class="modal-footer">
                          <div class="row">
                              <div class="col-xs-12">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                                    <button type="button" class="btn btn-primary" data-ng-click="submit(registerForm)">Registriraj se</button>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="section translucent-bg bg-image-2 pb-clear">
			<div class="container object-non-visible" data-animation-effect="fadeIn">
				<h1 id="clients" class="title text-center">Prijedlog parkirališta</h1>
				<div class="space"></div>
                                <div class="hidden" id="warnMe" style="text-align: right; padding-right: 10%">Isključili ste lokacijski servis. Kako ga osposobiti pronađite <a href="https://support.google.com/chrome/answer/142065?hl=hr">ovdje</a></div>
                                <div id="map-canvas"></div>
                                <div class="space"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-1.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Sjajna aplikacija!</h3>
								<blockquote>
									<p>Ova aplikacija mi je uistinu skratila vrijeme pronalaska parkirališta.</p>
									<footer><cite title="Source Title">Brankica</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-2.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Hvala</h3>
								<blockquote>
									<p>Nebrojeno puta mi se dogodilo da sam došao na parkiralište te sam se morao okrenuti jer nije više bilo slobodnih mjesta.</p>
									<footer><cite title="Source Title">Marko</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-3.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Uredu je</h3>
								<blockquote>
									<p>Mislio sam da će aplikacija biti malo bolja, ali i ovo je uredu, radi što treba.</p>
									<footer><cite title="Source Title">Ivan</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- section start -->
			<!-- ================ -->
			<div class="translucent-bg blue">
				<div class="container">
					<div class="list-horizontal">
						<div class="row">
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-1.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-2.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-3.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-4.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-5.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-6.png" alt="client">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section end -->
		</div>
		<!-- section end -->
                
		<!-- section start -->
		<!-- ================ -->
		<div class="section clearfix object-non-visible" data-animation-effect="fadeIn">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 id="about" class="title text-center">O <span>nama</span></h1>
                                                <p class="lead text-center">Zagreb parking je podružnica tvrtke Gradski parking d.o.o. te je tvrtka sa primarnim područjem rada u gradu Zagrebu.</p>
						<div class="space"></div>
						<div class="row">
                                                    <img src="images/tradition.jpg" alt="">
                                                    <div class="space"></div>
                                                </div>
                                                
                                                <div class="space"></div>
						<div class="row">
							
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Tko smo mi
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												Gradski parking d.o.o. je privatna tvrtka koja se bavi prostornim uređenjem parkirališta i garaža. U svom širikom spektru usluga najvažnija je usluga pružanja mogućnosti parkiranja u gradovima i manjim mjestima. Ponekad lokalna vlast ne može adekvatno organizirati i implementirati usluge parkiranja, te tu mi nastupamo. Ako želite stupiti s nama u kontakt u vezi osmišljanja, dizajniranja i implementiranja parkirališta možete to učiniti pomoću kontakt obrasca koji se nalazi na dnu stranice. 
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingTwo">
											<h4 class="panel-title">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
													Čime se bavimo
												</a>
											</h4>
										</div>
										<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
											<div class="panel-body">
												Bavimo se širokim rasponom usluga kao što je pružanje usluge planiranja i dizajniranja parkirališta i garaža, savjetovanja, pružanja donacija, te podipiranje projekata.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingThree">
											<h4 class="panel-title">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
													Gdje to radimo
												</a>
											</h4>
										</div>
										<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												Sjedište naše tvrtke je u Zagrebu, Trg žrtava fašizma 3, 10000. Lokalne subdivizije se nalaze u vašoj gradskoj upravi, naše lokalne subdivizije se nalaze u Splitu, Zadru, Osijeku, Rijeci, Sisku, te Varaždinu.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="section translucent-bg bg-image-1 pb-clear">
			<div class="container object-non-visible" data-animation-effect="fadeIn">
				<h1 id="services"  class="text-center title">Naše usluge</h1>
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <img src="images/portfolio-2.jpg" alt="First slide">
                                        </div>
                                        <div class="item">
                                            <img src="images/portfolio-3.jpg" alt="Second slide">
                                        </div>
                                        <div class="item">
                                            <img src="images/ExhibitOpening10.jpg" alt="Third slide">
                                        </div>
                                        <div class="item">
                                            <img src="images/disabled.jpg" alt="Third slide">
                                        </div>
                                        <div class="item">
                                            <img src="images/tower.jpg" alt="Third slide">
                                        </div>
                                        <div class="item">
                                            <img src="images/nature.jpg" alt="Third slide">
                                        </div>
                                        <div class="item">
                                            <img src="images/garage.jpg" alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                     </a>
                                </div>
				<div class="space"></div>
				<div class="row">
					<div class="col-sm-6">
						<div class="media">
							<div class="media-body text-right">
								<h4 class="media-heading">Usluge parkiranja</h4>
								<p>Nudimo našim klijentima mogućnost parkiranja svojih vozila u naše garaže ili otvorena parkirališta. Sva parkirališta su lako dostupna te imaju odgovarajuću signalizaciju da bi vam što više ubrazali postupak parkiranja.</p>
							</div>
							<div class="media-right">
								<i class="fa fa-cog"></i>
							</div>
						</div>
						<div class="media">
							<div class="media-body text-right">
								<h4 class="media-heading">Zaštita parkirališta</h4>
								<p>Sva naša parkirališta imaju implementirane visoke sigurnosne mjere. Svako parkiralište opremljeno je sa sigurnosnim kamerama, detektorima pokreta, te imaju nekoliko zaštitnih čuvara koji obilaze parkiralište. Naše videosnimke se spremaju tako da imamo snimke od prije maksimalno tri dana. U slučaju potrebe diskriminirajuće snimke kontaktirajte našu odvjetničku agenciju.</p>
							</div>
							<div class="media-right">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="media">
							<div class="media-body text-right">
								<h4 class="media-heading">Modernizacija</h4>
								<p>Imamo tim stručnjaka sa područja informatike, elektronike i prometnog inženjerstva kako bi sve naše usluge bile na razini današnjih zahtjeva. Svi podatci su ditalizirani, svi procesi su automatizirani, a sva parkirališta građena po standardu.</p>
							</div>
							<div class="media-right">
								<i class="fa fa-desktop"></i>
							</div>
						</div>
					</div>
					<div class="space visible-xs"></div>
					<div class="col-sm-6">
						<div class="media">
							<div class="media-left">
								<i class="fa fa-leaf"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Zaštita okoliša</h4>
								<p>Implementirana je usluga prijedloga parkirališta koja našim klijentima preporuča najbliže parkiralište a da na njemi ima minimalno 10 mjesta kako bi bili sigurni da ću klijent imati mijesto kada stigne. Također unaprijeđena signalizacija i prolanazak mjesta na samom parkiralištu skraćuje vrijeme pronalaska slobodnog mjesta. Time štedimo vaš novčanik i našu okoliš.</p>
							</div>
						</div>
						<div class="media">
							<div class="media-left">
								<i class="fa fa-users"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Društvene mreže</h4>
								<p>Društvene mreže postale su poprilično popularne stoga smo i mi u skladu odlučili se pridružiti njima a sve kako bi našim klijentima omogućili što bolju komunikaciju te lakše dobijali prijedloge, pohvale i kritike..</p>
							</div>
						</div>
						<div class="media">
							<div class="media-left">
								<i class="fa fa-child"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Suradnja</h4>
								<p>Ne samo da pružamo usluge našim klijentima nego sudjelujemo u radu drugih tvrtki. Među ostalim nudimo donacije za projekte iz naše domene, sudjelujemo na sastancima o zaštiti okoliša, modernizaciji, implementaciji novih tehnologija, održivom razvoju.</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="default-bg space">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h1 class="text-center">Dođite i vi!</h1>
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		

		<!-- section start -->
		<!-- ================ -->
		<div class="default-bg space">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h1 class="text-center">10000+ Zadovoljnih vozača!</h1>
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->
                
                <!-- section start -->
		<!-- ================ -->
                <div class="section clearfix object-non-visible" data-ng-controller="Peek" data-ng-show="toShow" data-ng-init="init(<?php if($UserId === NULL){ echo "false";}else {echo "true";} ?>)" data-animation-effect="fadeIn">		
                    <div class="container">
                            <div class="row">
                                    <div class="col-md-12">
                                            <h1 id="reservation" class="title text-center">Rezervacije</h1>
                                            <p class="lead text-center">Sve vaše rezervacije na jednom mjestu.</p>
                                            <div class="space"></div>
                                            <div class="row">
                                                    <div class="col-md-6">
                                                           <h2>Vaše postojeće rezervacije</h2>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h2>Rezervirajte novo mjesto</h2>
                                                            <div class="panel-group" id="accordionReserve" role="tablist" aria-multiselectable="true">
                                                                    <div class="panel panel-default">
                                                                            <div class="panel-heading" role="tab" id="headingOne">
                                                                                    <h4 class="panel-title">
                                                                                            <a data-toggle="collapse" data-parent="#accordionReserve" href="#reserveOne" aria-expanded="true" aria-controls="reserveOne">
                                                                                                    Jednokratna rezervacija
                                                                                            </a>
                                                                                    </h4>
                                                                            </div>
                                                                            <div id="reserveOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                                
                                                                                    <div class="panel-body">
                                                                                        <form name="single" novalidate>
                                                                                            <div id="messages_single" class="alert alert-success" data-ng-show="messages_single" data-ng-bind="messages_single"></div>
                                                                                            <div class="form-group has-feedback">
                                                                                                <label class="sr-only" for="datepicker_single">Date</label>
                                                                                                <script type = "text/javascript">
                                                                                                    var date_1 = new Date();
                                                                                                        $(document).ready(function () {
                                                                                                            $("#datepicker_single").datepicker({
                                                                                                                    format: "dd/mm/yyyy",
                                                                                                                    clearBtn: true,
                                                                                                                    language: "hr",
                                                                                                                    startDate: date_1
                                                                                                                }
                                                                                                            ).on('changeDate', function(e){
                                                                                                                $(this).datepicker('hide');
                                                                                                            });
                                                                                                        });

                                                                                                </script>

                                                                                                <input type = "text" id = "datepicker_single" class="form-control" placeholder="Datum rezervacije" name="datepicker_single" data-ng-model="datepicker_single" required/>
                                                                                                <i class="fa fa-calendar form-control-feedback"></i>
                                                                                            </div>
                                                                                            <div class="alert alert-danger" data-ng-show="submitted && Peek.datepicker_single.$error.required">Datum rezervacije je potreban!</div>
                                                                                            <div class="row">
                                                                                                        <div class="col-sm-6">
                                                                                                            <h4>Od:</h4>
                                                                                                            <select id="od_single" class="form-control">
                                                                                                                <option value="01">1h</option>
                                                                                                                <option value="02">2h</option>
                                                                                                                <option value="03">3h</option>
                                                                                                                <option value="04">4h</option>
                                                                                                                <option value="05">5h</option>
                                                                                                                <option value="06">6h</option>
                                                                                                                <option value="07">7h</option>
                                                                                                                <option value="08">8h</option>
                                                                                                                <option value="09">9h</option>
                                                                                                                <option value="10">10h</option>
                                                                                                                <option value="11">11h</option>
                                                                                                                <option value="12">12h</option>
                                                                                                                <option value="13">13h</option>
                                                                                                                <option value="14">14h</option>
                                                                                                                <option value="15">15h</option>
                                                                                                                <option value="16">16h</option>
                                                                                                                <option value="17">17h</option>
                                                                                                                <option value="18">18h</option>
                                                                                                                <option value="19">19h</option>
                                                                                                                <option value="20">20h</option>
                                                                                                                <option value="21">21h</option>
                                                                                                                <option value="22">22h</option>
                                                                                                                <option value="23">23h</option>
                                                                                                                <option value="00">24h</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="col-sm-6">
                                                                                                            <h4>Do:</h4>
                                                                                                            <select id="dox_single" class="form-control">
                                                                                                                <option value="01">1h</option>
                                                                                                                <option value="02">2h</option>
                                                                                                                <option value="03">3h</option>
                                                                                                                <option value="04">4h</option>
                                                                                                                <option value="05">5h</option>
                                                                                                                <option value="06">6h</option>
                                                                                                                <option value="07">7h</option>
                                                                                                                <option value="08">8h</option>
                                                                                                                <option value="09">9h</option>
                                                                                                                <option value="10">10h</option>
                                                                                                                <option value="11">11h</option>
                                                                                                                <option value="12">12h</option>
                                                                                                                <option value="13">13h</option>
                                                                                                                <option value="14">14h</option>
                                                                                                                <option value="15">15h</option>
                                                                                                                <option value="16">16h</option>
                                                                                                                <option value="17">17h</option>
                                                                                                                <option value="18">18h</option>
                                                                                                                <option value="19">19h</option>
                                                                                                                <option value="20">20h</option>
                                                                                                                <option value="21">21h</option>
                                                                                                                <option value="22">22h</option>
                                                                                                                <option value="23">23h</option>
                                                                                                                <option value="00">24h</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                 </div>
                                                                                                 
                                                                                                 <?php $backend = backendCall('getAllParkings', array());?><input name="" type="hidden" id="hidden_single" value="<?php echo $UserId; ?>">
                                                                                            <select id="parking_single" class="form-control">
                                                                                              <?php foreach($backend as $element) {?>
                                                                                                <option value="<?php echo $element['id'];?>"><?php echo $element['naziv'];?></option><?php } ?>
                                                                                            </select>
                                                                                            <button type="button" class="btn btn-primary" data-ng-click="submit(single)">Rezerviraj</button>
                                                                                         </form>

                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="panel panel-default">
                                                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                                                    <h4 class="panel-title">
                                                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionReserve" href="#reserveTwo" aria-expanded="false" aria-controls="reserveTwo">
                                                                                                    Ponavljajuća rezervacija
                                                                                            </a>
                                                                                    </h4>
                                                                            </div>
                                                                            <div id="reserveTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                                                    <div class="panel-body">
                                                                                            <form name="rep" novalidate>
                                                                                                <div id="messages_rep" class="alert alert-success" data-ng-show="messages_rep" data-ng-bind="messages_rep"></div>
                                                                                            <div class="form-group has-feedback">
                                                                                                <label class="sr-only" for="datepicker_rep">Date</label>
                                                                                                <script type = "text/javascript">
                                                                                                    var date_2 = new Date();
                                                                                                        $(document).ready(function () {
                                                                                                            $("#datepicker_rep").datepicker({
                                                                                                                    format: "dd/mm/yyyy",
                                                                                                                    clearBtn: true,
                                                                                                                    language: "hr",
                                                                                                                    startDate: date_2,
                                                                                                                    multidate: true
                                                                                                                }
                                                                                                            ).on('changeDate', function(e){
                                                                                                                $(this).datepicker('hide');
                                                                                                            });
                                                                                                        });

                                                                                                </script>

                                                                                                <input type = "text" id = "datepicker_rep" class="form-control" placeholder="Selektivni dani rezervacije" name="datepicker_rep" data-ng-model="datepicker_rep" required/>
                                                                                                <i class="fa fa-calendar form-control-feedback"></i>
                                                                                            </div>
                                                                                            <div class="alert alert-danger" data-ng-show="submitted && Peek.datepicker_rep.$error.required">Datumi rezervacije su potrebni!</div>
                                                                                                <?php $backend = backendCall('getAllParkings', array());?><input name="" type="hidden" id="hidden_single" value="<?php echo $UserId; ?>">
                                                                                            <select id="parking_single" class="form-control">
                                                                                              <?php foreach($backend as $element) {?>
                                                                                                <option value="<?php echo $element['id'];?>"><?php echo $element['naziv'];?></option><?php } ?>
                                                                                            </select>
                                                                                                <button type="button" class="btn btn-primary" data-ng-click="submit(rep)">Rezerviraj</button>
                                                                                         </form>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="panel panel-default">
                                                                            <div class="panel-heading" role="tab" id="headingThree">
                                                                                    <h4 class="panel-title">
                                                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionReserve" href="#reserveThree" aria-expanded="false" aria-controls="reserveThree">
                                                                                                    Trajna rezervacija u svatko doba dana
                                                                                            </a>
                                                                                    </h4>
                                                                            </div>
                                                                            <div id="reserveThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                                                    <div class="panel-body">
                                                                                            <form name="perm" novalidate>
                                                                                            <div id="messages_perm" class="alert alert-success" data-ng-show="messages_perm" data-ng-bind="messages_perm"></div>
                                                                                            <div class="form-group has-feedback">
                                                                                                <label class="sr-only" for="datepicker_perm">Date</label>
                                                                                                <script type = "text/javascript">
                                                                                                    var date_3 = new Date();
                                                                                                        $(document).ready(function () {
                                                                                                            $("#datepicker_perm").datepicker({
                                                                                                                    format: "dd/mm/yyyy",
                                                                                                                    clearBtn: true,
                                                                                                                    language: "hr",
                                                                                                                    startDate: date_3
                                                                                                                }
                                                                                                            ).on('changeDate', function(e){
                                                                                                                $(this).datepicker('hide');
                                                                                                            });
                                                                                                        });

                                                                                                </script>

                                                                                                <input type = "text" id = "datepicker_perm" class="form-control" placeholder="Od kojeg datuma želite rezervirati" name="datepicker_perm" data-ng-model="datepicker_perm" />
                                                                                                
                                                                                                <i class="fa fa-calendar form-control-feedback"></i>
                                                                                                 
                                                                                            </div>
                                                                                                <div class="alert alert-danger" data-ng-show="submitted && Peek.datepicker_perm.$error.required">Prvi dan rezervacije je potreban!</div>
                                                                                                <?php $backend = backendCall('getAllParkings', array());?><input name="" type="hidden" id="hidden_single" value="<?php echo $UserId; ?>">
                                                                                            <select id="parking_single" class="form-control">
                                                                                              <?php foreach($backend as $element) {?>
                                                                                                <option value="<?php echo $element['id'];?>"><?php echo $element['naziv'];?></option><?php } ?>
                                                                                            </select>
                                                                                                
                                                                                            <button type="button" class="btn btn-primary" data-ng-click="submit(perm)">Rezerviraj</button>
                                                                                         </form>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                </div>
		<!-- footer start -->
		<!-- ================ -->
		<footer id="footer">

			<!-- .footer start -->
			<!-- ================ -->
			<div class="footer section">
				<div class="container">
					<h1 class="title text-center" id="contact">Kontaktirajte nas</h1>
					<div class="space"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="footer-content">
								<p class="large">Imate li pitanja, nedoumice, pritužbe, pohvale ili prijedloge kontaktirajte nas odmah. Kontaktirajte nas putem telefona, obrasca za kontakt, društvenih mreža ili dođite osobno u naše poslovnice.</p>
								<ul class="list-icons">
									<li><i class="fa fa-map-marker pr-10"></i> Trg žrtava fašizma 3, 10000, Zagreb</li>
									<li><i class="fa fa-phone pr-10"></i> +00385 013370240</li>
									<li><i class="fa fa-fax pr-10"></i> +00385 013370240</li>
									<li><i class="fa fa-envelope-o pr-10"></i> opp_user@outlook.com</li>
								</ul>
								<ul class="social-links">
									<li class="facebook"><a target="_blank" href="https://www.facebook.com/martin.dakovic?fref=ts"><i class="fa fa-facebook"></i></a></li>
									<li class="twitter"><a target="_blank" href="https://twitter.com/coldwarrior5"><i class="fa fa-twitter"></i></a></li>
									<li class="googleplus"><a target="_blank" href="https://plus.google.com/108869783565424911879/posts"><i class="fa fa-google-plus"></i></a></li>
									<li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
									<li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
									<li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube"></i></a></li>
									<li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
									<li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="footer-content" data-ng-controller="help">
                                                            <div id="messages" class="alert alert-success" data-ng-show="messages" data-ng-bind="messages"></div>
                                                            <form role="form" id="footer-form" name="helpForm" novalidate action="javascript:resetCaptcha();">
									<div class="form-group has-feedback">
										<label class="sr-only" for="name">Name</label>
										<input type="text" class="form-control" id="name" placeholder="Ime" name="name" data-ng-model="name" required>
										<i class="fa fa-user form-control-feedback"></i>
									</div>
                                                                        <div class="alert alert-danger" data-ng-show="submitted && helpForm.name.$error.required">Potrebno je ime!</div>
									<div class="form-group has-feedback">
										<label class="sr-only" for="email">Email address</label>
										<input type="email" class="form-control" id="email" placeholder="Email adresa" name="email" data-ng-model="email" required>
										<i class="fa fa-envelope form-control-feedback"></i>
									</div>
                                                                        <div class="alert alert-danger" data-ng-show="submitted && helpForm.email.$error.required">Email adresa potrebna!</div>
                                                                        <div class="alert alert-danger" data-ng-show="submitted && helpForm.$error.email">Pogrešna email adresa!</div>
									<div class="form-group has-feedback">
										<label class="sr-only" for="message">Message</label>
										<textarea class="form-control" rows="8" id="message" placeholder="Poruka" name="message" data-ng-model="message" required></textarea>
										<i class="fa fa-pencil form-control-feedback"></i>
									</div>
                                                                        <div class="alert alert-danger" data-ng-show="submitted && helpForm.message.$error.required">Potrebna je poruka!</div>
                                                                        <div id="example1"></div>
									<button data-ng-click="submit(helpForm)" class="btn btn-default" style="text-transform: capitalize">Pošalji upit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- .footer end -->

			<!-- .subfooter start -->
			<!-- ================ -->
			<div class="subfooter">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="text-center">Copyright © 2014 Snjeguljice.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- .subfooter end -->

		</footer>
		<!-- footer end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
		<!-- Jquery and Bootstap core js files -->
		
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>

		<!-- Html Coder Add -->
		<script type="text/javascript" src="js/template.js"></script>
                
                <!-- UTF-8 Regexp -->
                <script src="js/xregexp.js"></script>
                
                <!-- Asynchronous recaptcha call -->
                <script src="//www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&am&amp;hl=hr" async defer></script>

    </body>
</html>
