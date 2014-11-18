

<div class="form-group">

	<div class='col-sm-1'><strong>{{'(sur '.$question->pivot->sur_local.')'}}</strong></div>	
	<div class='col-sm-9'><strong>{{'titre', $offset_question+1 . ") ".$question->nom}}</strong></div> 	
	<div class = 'col-sm-12'>
		<div id="enonce" class="resizeDiv resizeDiv-height-2-rows" ">{{$question->enonce}}</div>
	</div>
	@if(strlen($question->reponse) > 0)
	<div class = 'col-sm-6'>
		<div id="questionReponse" class="resizeDiv resizeDiv-height-2-rows"><strong>Réponse:</strong><br>{{$question->reponse}}</div>
	</div>
	@endif
	@if(strlen($question->baliseCorrection) > 0)
	<div class = 'col-sm-6'>
		<div id="questionBaliseCorrection" class="resizeDiv resizeDiv-height-2-rows"><strong>Balises de correction:</strong><br> {{$question->baliseCorrection}}</div>
	</div>
	@endif
</div>
<div class="form-group">
	<div class="col-sm-12"><strong>Réponse de l'étudiant</strong></div>	
	<div class = 'col-sm-12'>
		<?php if(strlen($reponse->reponse) == 0) 
			     {$lareponse = "<mark>Aucune réponse donnée</mark>";
			  } else {$lareponse = $reponse->reponse;} ?>
		<div id="reponse" class="resizeDiv"> {{$lareponse}}</div>
	</div>
</div>
<div class="form-group">
	{{ Form::label('pointage', 'Points:', ['class' => "col-sm-1 "]) }} 	
	<div class = 'col-sm-1'>
		{{ Form::text('pointage', $reponse->note, ['class' => 'form-control']) }}
	</div>
		{{ Form::label('pointage', '/'.$question->pivot->sur_local, ['class' => "col-sm-1 "]) }} 	
	
</div>
<div class="form-group">
	<div class='col-sm-12'><strong>Commentaires de correction</strong></div>	
	<div class = 'col-sm-12'>
		{{ Form::textarea('commentaire', $reponse->commentaire, ['class' => 'form-control ckeditor', 'rows' => '4']) }}
	</div>
</div>