<?php 


class EtudiantsGestion extends BaseFilteredGestion{

public function __construct(User $model, Classe $filteringClass){
	parent::__construct($model, $filteringClass);
}

protected function filter1($filteringItem) {
	//$filteringItems doit être une Classe
	return $filteringItem->etudiants()->where('type','=','e')->get()->sortBy('nom');
}
protected function filter2($filterValue) {
	//Pour les Etudiants, le filter 2 est la sessionScholaire
	if($filterValue == 0) {// 0 indique 'Tous' sur filter2
		$lignes = $this->model->where('type','=','e')->get()->sortBy('nom');
	} else {
		try {
			$filterByItems = $this->filteringClass->where('sessionscholaire_id', '=' , $filterValue)->get(); //va chercher les classes pour cette session
			$modelIds = [];
			foreach($filterByItems as $item) { //créé la liste des ids des TPs pour toutes ces classes.
				$modelIds=array_merge($modelIds,$this->filter1($item)->lists('id'));
			}
	
			//un Etudiant peut être avec 2 classes, il faut donc aller les chercher par leur id afin d'enlever les doublons
			if(count($modelIds)>0) {
				$lignes = $this->model->whereIn('id', $modelIds)->get()->sortBy('nom');
			} else { //aucun TP de retourné, on créé donc une liste vide.
				$lignes = new Illuminate\Database\Eloquent\Collection;
			}
		} catch (Exception $e) {
			$lignes = new Illuminate\Database\Eloquent\Collection;
		}
	}
	return $lignes;
}

public function index() {
	return $this->displayView( 'Tous');
	
}

/* on ne doit pas créer un étudiant ici, car un étudiant est avant tout un usager. 
public function create() {
	return $this->displayView('Aucune Classe');
}
*/

/**
 * Enregistrement initial dans la BD
 *
 *
 * @param[in] get int belongsToListSelect les ids des classes auxquelles ce TP sera associé.
 * 					Si vide, alors le tp ne sera associé à rien.
 * 				 	Les ids doivent être valide, sinon une page d'erreur sera affichée.
 *
 */
/*
public function obsolete_store($input) { //je ne devrais pas storer un nouvel etudiant, il doit avoir été créer en tant qu'user
	$classeId = 0;
	//verifie que les ids de classe passé en paramêtre sont bons
	if(isset($input['belongsToListSelect'])) {
			$classeIds = $input['belongsToListSelect'];
			if(!allIdsExist($classeIds, 'Classe')){
				App::abort(404); 
			}
	} else {
			$classeIds =[]; 
	}
	$etudiant = new $this->model(['nom'=>$input['nom'], 'da'=>$input['da']]);
	if($etudiant->save()) {//TODO: mettre ca dans une transaction
		foreach($classeIds as $classeId) {
			if($classeId <>0 ){
				//associe la classe au TP (many to many)
				$etudiant->classes()->attach($classeId); 
			}
		}
		return true;
	} else {
		return $etudiant->validationMessages;
	}

}
*/
public function show($id){
	return $this->displayView(null,$this->model->findOrFail($id),true);
}

public function edit($id){
	return $this->displayView('Aucune classe', $this->model->findOrFail($id));
}

/**
 * La seule chose qu'on peut updater, c'est l'association entre un etudiant et une classe. 
 * La création ou modification d'un étudiant doit se faire via User
 * @param int $id
 * @param array $input l'input provenant de la view. Seul l'association avec la classe sera modifiable. 
 * @return boolean
 */

public function update($id, $input){
		//verifie que les ids de classe passé en paramêtre sont bons
		if(isset($input['belongsToListSelect'])) {
				$classeIds = $input['belongsToListSelect'];
				if(!allIdsExist($classeIds, 'Classe')){
					App::abort(404); 
				}
		} else {
				$classeIds =[]; 
		}
					
		$etudiant = $this->model->findOrFail($id); //TODO catch l'exception
		// ne permet pas de changer les autres champs. 
		if($etudiant->save()) {
			$etudiant->classes()->sync($classeIds);
			return true;
		} else {
			return $etudiant->validationMessages;
			}

}

/* ne permet pas d'effacer un étudiant. Ca doit être fait via les Users 
public function destroy($id){
	$etudiant = $this->model->findOrFail($id);
	$etudiant->classes()->detach();
	$etudiant->delete();
	// Détruit les notes associées à cet etudiant
	$notes = Note::where('etudiant_id', '=', $id)->get();
	foreach($notes as $note) {
		$note->delete();
	}
	
	return true;
}
*/

private function displayView( $option0, $item=null, $displayOnlyLinked=null) {
	if(isset($item) and isset($displayOnlyLinked) ) {
		$lesClasses = $item->classes;//affiche seulement les classes associées à cet item. (utile pour show)
	} else {//sinon affiche toutes les classes.
		$lesClasses = Classe::all()->sortby("sessionscholaire_id"); //ce n'est pas exactement par session, mais si les id sont dans le bon ordre, ca le sera.
	}
	$belongsToList = createSelectOptions($lesClasses,[get_class(), 'createOptionsValue'], $option0);
	if(isset($item)) { //si on a un item, on sélectionne toutes les classes déjà associées
		$belongsToSelectedIds =  $item->classes->fetch('id')->toArray();
	} else { //sinon, on sélectionne la classe qui a été passée en paramêtre (si elle est bonne, sinon, la première de la liste
		$belongsToSelectedIds = checkLinkedId(array_keys($belongsToList)[0], Input::get('belongsToId'), 'Classe');
	}
	$filtre1 = createFiltreParSessionPourClasses($lesClasses, true);
	$etudiant = $item;
	return compact('etudiant', 'belongsToList', 'belongsToSelectedIds','filtre1');
}
/**
 * Helpers
 *
 */
static function createOptionsValue($item) {
	return $item->sessionscholaire->nom." ". $item->code." ".$item->nom;
}

}