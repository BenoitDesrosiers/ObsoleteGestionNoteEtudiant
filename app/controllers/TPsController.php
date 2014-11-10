<?php
use Illuminate\Support\Facades;
/**
 * Le controller pour les travaux pratiques
 *
 *
 * @version 0.2
 * @author benou
 */

class TPsController extends BaseFilteredResourcesController
{
	
	public function __construct(TPsGestion $gestion) {
		//parent::__construct();
		$this->gestion = $gestion;
		$this->base = "tps";
		$this->message_store = 'Le travail pratique a été ajouté';
		$this->message_update = 'Le travail pratique a été modifié';
		$this->message_delete = 'Le travail pratique a été effacé';
		
	}

	/**
	 * affiche les classes associées à ce TP et permet de distribuer ce TP pour les classes sélectionnées
	 */
	public function distribuer($id) {
		return View::make($this->base.'.distribuer', $this->gestion->distribuer($id));
	}
	
	public function doDistribuer($id) {
		$return = $this->gestion->doDistribuer($id, Input::all());
		if($return === true ) {
			return Redirect::route($this->base.'.index')->with('message_success', 'Les TPs ont été distribués/retirés correctement');
		} else {
			return Redirect::route($this->base.'.distribuer',$id)->withInput()->with('message_danger', "Une erreur c'est produite");
		}
 	}

 	/**
 	 * affiche la liste de questions et permet de les reordonner et de mettre des pages break
 	 */
 	
 	public function format($id) {
 		return View::make($this->base.'.format', $this->gestion->format($id));
 	}
 	
 	public function doFormat($id) {
 		$return = $this->gestion->doFormat($id, Input::all());
 		if($return === true ) {
 			return Redirect::route($this->base.'.index')->with('message_success', "Le format du TP a été mis à jour");
 		} else {
 			return Redirect::route($this->base.'.index')->with('message_danger', "Une erreur c'est produite");
  		}
 	}
 	
 	
 	/**
 	 * Correction d'un tp
 	 * 
 	 */
 	
 	public function corriger($tp_id, $classe_id) {
 		return View::make($this->base.'.corriger', $this->gestion->corriger($tp_id, $classe_id, 1, 1));
 	}
 	
 	public function doCorriger() {
 		$etudiant_id = Session::pull('etudiantId');
 		$classe_id = Session::pull('classeId');
 		$tp_id = Session::pull('tpId');
 		$question_id = Session::put('questionId');
 		$offset_etudiant = Session::pull('offsetEtudiant');
 		$offset_question = Session::pull('offsetQuestion');
 		$commentaires= Input::get('commentaires'); 		
 		$return = $this->gestion->doCorriger($etudiant_id, $classe_id, $tp_id, $question_id, $commentaires);
 		if($return){
	 		if(isset($input['terminer'])) {
	 			return Redirect::route($this->base.'.index')->with('message_success', 'Vos corrections sont enregistrées');
	 		} else {
	 			if(isset($input['sauvegarde']))	 {					
	 				// les offsets restent les mêmes
	 			} elseif(isset($input['etudiantSuivant']))	 {
	 				$offset_etudiant++;
	 			} elseif(isset($input['etudiantPrecedent']))	 {
	 				$offset_etudiant--;
	 			}
	 			return View::make($this->base.'.repondre', $this->gestion->repondre($etudiant_id, $classe_id, $tp_id, $offset_etudiant, $offset_question) );
	 		}
 		} else {
 			return Redirect::route($this->base.'.index')->with('message_danger', "Une erreur grave c'est produite, veuillez avertir le professeur");
 		}
 	}
}
