<!DOCTYPE html>
<html lang="es" ng-app="App">
<head>
	<meta charset="UTF-8"/>
	<title>Revista</title>

	<script src="assets/javascripts/lib/angular/angular.min.js"></script>
	<script src="assets/javascripts/lib/angular/angular-sanitize.min.js"></script>
	<script src="assets/javascripts/lib/angular/angular-route.min.js"></script>
	<script src="assets/javascripts/lib/angular/select.min.js"></script>
	<script src="assets/javascripts/ui-utils/ui-utils.js"></script>
	<script src="assets/javascripts/ui-utils/ui-utils-ieshiv.min.js"></script>
	<script src="assets/javascripts/ui-bootstrap/ui-bootstrap-tpls-0.12.1.min.js"></script>
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
	<nav class="navbar navbar-default navbar-fixed-top">
		<div>
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsable" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="">Revista</a>
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
		</div>
	</nav>
</header>
<div ng-view>

</div>
</body>
</html>