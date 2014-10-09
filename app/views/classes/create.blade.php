@extends('layout')
@section('content')

<section class="header section-padding">
	<div class="container">
		<div class="header-text">
			<h1>Création d'une classe</h1>
		</div>
	</div>
</section>

<div class="container">
	<section class="section-padding">
		<div class="jumbotron text-left">
			{{ Form::open(['url'=> 'classes', 'class' => 'form-horizontal', 'role'=>'form']) }}				
			@include('classes.editForm')
			<div class="form-group">
				{{ Form::submit('Créer', ['class' => 'btn btn-primary'])}}
			</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
@stop