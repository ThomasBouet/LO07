<?php
class Etudiant{
	
	public $numero;
	public $nom;
	public $prenom;
	public $admission;
	public $filiere;
	
	function __construct($numero, $nom, $prenom, $admission, $filiere) {
            $this->numero = $numero;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->admission = $admission;
            $this->filiere = $filiere;
        }
	
	function getNumero(){
		return $this->numero;
	}
	function setNumero($numero){
		$this->numero = $numero;
	}
	function getNom(){
		return $this->nom;
	}
	function setNom($nom){
		$this->nom = $nom;
	}
	function getPrenom(){
		return $this->prenom;
	}
	function setPrenom($prenom){
		$this->prenom = $prenom;
	}
	function getAdmission(){
		return $this->admission;
	}
	function setAdmission($admission){
		$this->admission = $admission;
	}
	function getFiliere(){
		return $this->filiere;
	}
	function setFiliere($filiere){
		$this->filiere = $filiere;
	}
}
?>