@extends('layout')
@section('content')

<section class="header section-padding">
	<div class="container">
		<div class="header-text">
			<h1>Édition</h1>
			<p>Page d'édition d'un travail pratique</p>
		</div>
	</div>
</section>

<div class="container">
	<section class="section-padding">
		<div class="jumbotron text-left">
			<h1>Édition d'un TP</h1>
			{{ Form::open(['action'=> array('ClassesTPsController@update', $classe->id, $tp->id), 'method' => 'PUT', 'class' => 'form']) }}
			
			<div class="form-group">
				{{ Form::label('numero', 'Numero:') }} 
				{{ Form::text('numero',$tp->numero, ['class' => 'form-control']) }}
				{{ $errors->first('numero') }}
			</div>
			<div class="form-group">
				{{ Form::label('classe_id', 'Classe(s) associée(s):') }} 
				<?php  $id_classes = ""; //TODO: gérer le cas ou il n'y a pas de classes associées, ca affiche le mot "classe id"??? ?>
				@foreach($tp->classes as $classe)
					<?php  
						
						$id_classes = $id_classes . $classe->id ; ?>
				@endforeach
				{{ Form::label('classe_id',$id_classes) }}
			</div>
			<div class="form-group">
				{{ Form::label('nom', 'Nom:') }} 
				{{ Form::text('nom', $tp->nom, ['class' => 'form-control']) }}
				{{ $errors->first('nom') }}
			</div>
			<div class="form-group">
				{{ Form::label('sur', 'Sur:') }} 
				{{ Form::text('sur', $tp->sur, ['class' => 'form-control']) }}
				{{ $errors->first('sur') }}
			</div>
			<div class="form-group">
				{{ Form::label('poids', 'Poids:') }} 
				{{ Form::text('poids',$tp->poids, ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) }}
			</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
@stop