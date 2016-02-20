<!DOCTYPE html>
<html lang="es" ng-app="App">
<head>
	<meta charset="UTF-8"/>
	<title>Know</title>

	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<script src="assets/javascripts/angular.min.js"></script>
	<script src="assets/javascripts/angular-route.min.js"></script>
	<script src="assets/javascripts/angular-animate.min.js"></script>
	<script src="assets/javascripts/angular-touch.min.js"></script>
	<script src="assets/javascripts/ui-utils/ui-utils.js"></script>
	<script src="assets/javascripts/ui-utils/ui-utils-ieshiv.min.js"></script>
	<script src="assets/javascripts/ui-bootstrap-1.1.2.min.js"></script>
	<script src="assets/javascripts/jquery.js"></script>
	<script src="assets/javascripts/bootstrap.js"></script>

	<script src="assets/javascripts/app.js"></script>
	<script src="assets/javascripts/controllers.js"></script>

	<link rel="stylesheet" href="assets/stylesheets/waterProof.css">
	<link rel="stylesheet" href="assets/stylesheets/style.css">
	<link rel="stylesheet" href="assets/stylesheets/select.min.css">
	<link rel="stylesheet" href="assets/stylesheets/select2.css">
</head>
<body>
<header>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsable" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">Know</a>
			</div>
			<div class="collapse navbar-collapse" id="collapsable">
				<ul class="nav navbar-nav">
					<li><a href="">Home</a></li>
					<li><a href="">Arquitectura</a></li>
					<li><a href="">Música</a></li>
					<li><a href="">Moda</a></li>
					<li><a href="">Salud</a></li>
					<li><a href="">Comida</a></li>
					<li><a href="">Eventos</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<div ng-view>

</div>
</body>
</html>