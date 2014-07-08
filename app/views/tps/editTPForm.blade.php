
<div class="form-group">
	{{ Form::label('classe_id', 'Classe(s) associée(s):') }}
		<?php  $id_classes = ""; //TODO: gérer le cas ou il n'y a pas de classes associées, ca affiche le mot "classe id"??? ?>
		@foreach($tp->classes as $classe)
			<?php  
				if(!$id_classes == "") {
					$id_classes = $id_classes . ', ';
				}	
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