@extends('layout')
@section('content')

	<div class="container">
		<section class="section-padding">
			<div class="jumbotron text-left">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1> Liste des travaux pratiques pour la classe {{ $classe->code . ' ' . $classe->session }}</h1>
						<a href="{{ action('ClassesTPsController@create', $classe->id) }}" class="btn btn-info">Créer un TP</a>	
						<a href="{{ action('ClassesTPsController@connect', $classe->id) }}" class="btn btn-info">Associer un TP</a>						
											
						<?php //TODO: ajouter un bouton pour copier les TPs d'une autres classes?> 
					</div>
					
					@if ($tps->isEmpty())
						<p>Aucun travail pratique disponible!</p>
					@else
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom</th>
									<th>Sur</th>
									<th>Poids</th>
									<th>Poids local</th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0; $total_local = 0; ?> 
								@foreach($tps as $tp)
									<?php $total += $tp->poids;
										  $total_local += $tp->pivot->poids_local?> 
									<tr>
										<td><a href="{{ action('ClassesTPsController@show', [$classe->id, $tp->id]) }}">{{ $tp->id }}</a> </td>
										<td>{{ $tp->nom }} </td>
										<td>{{ $tp->sur }} </td>										
										<td>{{ $tp->poids}} </td>
										<td>{{ $tp->pivot->poids_local }} </td>
										<td><a href="{{ action('ClassesTPsController@edit', [$classe->id, $tp->id]) }}" class="btn btn-info">Éditer</a></td>
	                                    <td><a href="{{ action('ClassesTPsController@disconnect', [$classe->id, $tp->id]) }}" class="btn btn-info">Déconnecter</a></td>
										<td><a href="{{ action('TPsQuestionsController@index',$tp->id) }}" class="btn btn-info">Questions</a></td>
										<td>
											{{ Form::open(array('action' => array('ClassesTPsController@destroy',$classe->id, $tp->id), 'method' => 'delete', 'data-confirm' => 'Êtes-vous certain? Il sera détaché de toutes les classes auquel il est associée')) }}
	                                        	<button type="submit" href="{{ URL::route('classes.tps.destroy', $classe->id, $tp->id) }}" class="btn btn-danger btn-mini">Effacer</button>
	                                        {{ Form::close() }}   
	                                    </td>
									</tr>
								@endforeach
								<tr>
									<td> </td>
									<td> </td>
									<td>total:</td>
									<td> {{ $total }} </td>
									<td> {{ $total_local }} </td>
									
								</tr>	
							</tbody>
								
						</table>
					@endif
				</div>
			</div>
		</section>
	</div>

@stop