<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CI BOT</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="style.css" rel="stylesheet">
</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#"><img src="img/chatbot_logos.jpg"> CI-BOT</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class=" collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#chat">Skip to Chat</a>
					</li>
					<!--
					<li class="nav-item">
						<a class="nav-link" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Connect</a>
					</li>
					-->
				</ul>
			</div>
		</div>
	</nav>

	

	<!--- Welcome Section -->
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-4">Poznaj CI Chat Bota</h1>
			</div>
			<hr>
			<div class="col-12">
				<p class="lead">Chat Bot odpowiada na pytania odnośnie statusu integracji.</p>
			</div>
		</div>
	</div>

	<!--- Chat Bot Card -->
	<div class="container-fluid padding">
		<div class="row justify-content-center padding">
			<div class="col-sm-10 col-md-8 col-lg-6 col-xl-6">
				<div class="card">
					<img class="card-img-top" src="img/chatbot_baner.jpg">
					<div class="card-body">
						<h4 class="card-title">Rozmowa:</h4>
						<p class="card-text">
							<p>CI-BOT: Witaj, odpowiadam na pytania z CI. Zadaj mi pytanie.</p>

							<!--- Chat Bot Logic -->
							<?php include('test_program_z_tak_nie_all_opcje.php'); ?>
							<!--- Chat Bot Logic - END -->

							<span id="chat"></span>
						</p>
						
						<!--<a href="#" class="btn btn-outline-secondary">See Profile</a>-->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--- Connect -->
	<!--
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-12">
			<h2>Connect</h2>
		</div>
		<div class="col-12 social padding">
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#">GitHub</a>
		</div>
	</div>
</div>
-->

	<!--- Footer -->
<footer>
<div class="container-fluid text-center padding">
		<div class="col-12">
			<a href="https://github.com/SztifModeL/git_ChatBot_CI_beta_v2.0">GitHub</a>
			<hr class="light-100">			
			<h5>&copy; <a href="mailto:mk.codetech@gmail.com">mk.codetech@gmail.com</a></h5>
		</div>
	</div>
</div>
</footer>
</body>

</html>