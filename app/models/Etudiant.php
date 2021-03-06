<?php

class obsoleteEtudiant extends EloquentValidating
{
	
 /*
  * Mass assignment protection
  */
	protected $guarded = array('id');
	
/*
 * database relationships
 */
	
	// Un étudiant est associée à plusieurs Classe
	public function classes() {
		return $this->belongsToMany('Classe', 'etudiants_classes', 'etudiant_id', 'classe_id');
	}
	
	
	
/*
 * Validation
 * 
 * un étudiant doit avoir: 
 *  nom : obligatoire
 *  da : obligatoire (numéro d'identification (Date d'Admission)
 *  
 */	
	
	
	public function validationRules() {
		return [	 
			'nom'=>'required',
			'da'=>'required',
	];	
	}
}