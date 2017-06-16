<?php
class Element{
	
	public $sem_seq;
	public $sem_label;
	public $sigle;
	public $categorie;
	public $affectation;
	public $utt;
	public $profil;
	public $credit;
	public $resultat;
	
	function __construct($sem_seq, $sem_label, $sigle, $categorie, $affectation, $utt, $profil, $credit, $resultat) {
            $this->sem_seq = $sem_seq;
            $this->sem_label = $sem_label;
            $this->sigle = $sigle;
            $this->categorie = $categorie;
            $this->affectation = $affectation;
            $this->utt = $utt;
            $this->profil = $profil;
            $this->credit = $credit;
            $this->resultat = $resultat;
    }
	
    function getSem_seq() {
        return $this->sem_seq;
    }
    function getSem_label() {
        return $this->sem_label;
    }
    function getSigle() {
        return $this->sigle;
    }
    function getCategorie() {
        return $this->categorie;
    }
    function getAffectation() {
        return $this->affectation;
    }
    function getUtt() {
        return $this->utt;
    }
    function getProfil() {
        return $this->profil;
    }
    function getCredit() {
        return $this->credit;
    }
    function getResultat() {
        return $this->resultat;
    }
    function setSem_seq($sem_seq) {
        $this->sem_seq = $sem_seq;
    }
    function setSem_label($sem_label) {
        $this->sem_label = $sem_label;
    }
    function setSigle($sigle) {
        $this->sigle = $sigle;
    }
    function setCategorie($categorie) {
        $this->categorie = $categorie;
    }
    function setAffectation($affectation) {
        $this->affectation = $affectation;
    }
    function setUtt($utt) {
        $this->utt = $utt;
    }
    function setProfil($profil) {
        $this->profil = $profil;
    }
    function setCredit($credit) {
        $this->credit = $credit;
    }
    function setResultat($resultat) {
        $this->resultat = $resultat;
    }
}
?>