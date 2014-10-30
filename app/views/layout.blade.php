<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Gestion des notes</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
{{ HTML::script('assets/js/script.js') }}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
	
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-principal">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<p class="navbar-text navbar-left">Cégep de Drummondville</p>
			<p class="navbar-text navbar-left">Bienvenue {{Confide::user()? Auth::user()->username:'visiteur' }}</p>
			
			<p> 
		</div>
		<div class="collapse navbar-collapse" id="menu-principal">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ action('HomeController@index') }}">Écran principal</a></li>
				<li>{{ link_to(URL::previous(), 'Écran précédent') }}</li>
				
				
				<li><a href="{{ action('UserController@logout') }}">logout</a></li>
				
			</ul>
		</div>
	</nav>
</header>
   	@if(Session::has('message_success')) 
	    <div class="form-group">
	    	<div class="alert alert-success">
	    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    		{{ Session::get('message_success') }}
	    	</div>
    	</div>			    	
    @endif
    @if(Session::has('message_danger')) 
	    <div class="form-group">
	    	<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    		{{ Session::get('message_danger') }}
	    	</div>
    	</div>			    	
    @endif
	


@yield('content')
</body>



</html>