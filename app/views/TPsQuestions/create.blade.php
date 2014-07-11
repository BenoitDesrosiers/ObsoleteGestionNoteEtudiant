@extends('layout')
@section('content')

<section class="header section-padding">
	<div class="container">
		<div class="header-text">
			<h1>Création</h1>
			<p>Page de création d'une question</p>
		</div>
	</div>
</section>

<div class="container">
	<section class="section-padding">
		<div class="jumbotron text-left">
			<h1>Création d'une question</h1>
			
			{{ Form::open(['url'=> 'tps/'.$tp->id.'/questions', 'class' => 'form']) }}
				@include('questions.createTPform')
			{{ Form::close() }}
		</div>
	</section>
</div>
@stop