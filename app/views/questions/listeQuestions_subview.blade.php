@if ($questions->isEmpty())
	<p>Aucune question de disponible!</p>
@else
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th class="text-right">Nom</th>
				<th class="text-right">Enoncé</th>
				<th class="text-right">Sur</th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
		@foreach($questions as $question)
			<tr>
				<td><a href="{{ action('QuestionsController@show', [$question->id]) }}">{{ $question->nom }}</a></td>
				<td>{{ $question->enonce }} </td>
				<td>{{ $question->sur }} </td>
				<td><a href="{{ action('QuestionsController@edit', [$question->id]) }}" class="btn btn-info">Éditer</a></td>
				<td>
				{{ Form::open(array('action' => array('QuestionsController@destroy', $question->id), 'method' => 'delete', 'data-confirm' => 'Êtes-vous certain?')) }}
					<button type="submit" href="{{ URL::route('questions.destroy', $question->id) }}" class="btn btn-danger btn-mini">Effacer</button>
				{{ Form::close() }}   
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endif