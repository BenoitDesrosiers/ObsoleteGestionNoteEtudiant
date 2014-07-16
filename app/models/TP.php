<?php

class TP extends Eloquent
{
	
	protected $table = 'tps';  // pour une raison x, le nom de la table par défaut était t_ps 
 /*
  * Mass assignment protection
  */
	protected $guarded = array('id');
	
/*
 * database relationships
 */
	
	// Un TP est associé à plusieurs classes
	public function classes() {
		return $this->belongsToMany('Classe', 'classes_tps', 'tp_id', 'classe_id')->withPivot('poids_local'); //encore ici, je suis obligé de spécifier tp_id, sinon, la clé est t_p_id ????);
	}
	
	// Un TP est associé à plusieurs questions
	public function questions() {
		return $this->belongsToMany('Question', 'tps_questions', 'tp_id', 'question_id')->withPivot('ordre','sur_local');
	}
	
/*
 * Validation
 * 
 * un TP doit avoir: 
 *  nom : obligatoire
 *  sur : obligatoire
 *  poids : obligatoire
 *  
 */	
	
	public static $validationMessages;
	
	public static function validationRules($id=0) {
		return [	 
			'nom'=>'required',
			'sur'=>'required',
			'poids'=>'required'
	];	
	}

	//TODO: mettre cette fonction dans une superclasse
	public static function isValid($data, $id=0) {
		
		$validation = Validator::make($data, static::validationRules($id));
		static::$validationMessages = $validation->messages();
		
		return $validation->passes();
	}
}