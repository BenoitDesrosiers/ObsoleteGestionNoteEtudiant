 
<div class="form-group">
	{{ Form::label('surlocal','(sur '.$question->pivot->sur_local.')', ['class' => "col-sm-1 "]) }} 	
	{{ Form::label('titre', $question->nom, ['class' => "col-sm-9 "]) }} 	
	<div class = 'col-sm-12'>
		<?php $rows = round(strlen($question->enonce)/130)+1?>
		{{ Form::textarea('enonce', $question->enonce, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => $rows]) }}
	</div>
	<div class = 'col-sm-6'>
		<?php $rows = round(strlen($question->reponse)/65)+1?>
		{{ Form::textarea('questionReponse', $question->reponse, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => $rows]) }}
	</div>
	<div class = 'col-sm-6'>
		<?php $rows = round(strlen($question->baliseCorrection)/65)+1?>
		{{ Form::textarea('questionBaliseCorrection', $question->baliseCorrection, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => $rows]) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('reponse', 'Réponse', ['class' => "col-sm-12 "]) }} 	
	<div class = 'col-sm-12'>
		<?php $rows = round(strlen($reponse->reponse)/130)+1?>
		{{ Form::textarea('reponse', $reponse->reponse, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => $rows]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('commentaire', 'Commentaires de correction', ['class' => "col-sm-12 "]) }} 	
	<div class = 'col-sm-12'>
		{{ Form::textarea('commentaire', $reponse->commentaire, ['class' => 'form-control', 'rows' => '4']) }}
	</div>
</div>
