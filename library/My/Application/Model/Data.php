<?php

class My_Application_Model_Data {
	
	/**
     * Fonction qui retourne un ombre aleatoire
     * 
     * @param  int $min 
     * @param  int $max
     * @return string $result
     */
	public function random($min = null, $max = null)
	{
		if($min < $max) return Zend_Json::encode(array("result"=> rand($min, $max)));
		else return Zend_Json::encode(array("result"=> rand()));
	}
	
	/**
     * Fonction qui retourne la somme de deux nombres
     * 
     * @param  int $nb1 
     * @param  int $nb2 
     * @return string $result
     */
	public function add($nb1, $nb2){
		return Zend_Json::encode(array("result"=> $nb1+$nb2));
	}
	
	/**
     * Fonction qui retourne la concaténation de deux chaines
     * 
     * @param  string $s1
     * @param  string $s2
     * @return string $result
     */
	public function concat($s1, $s2){
		return Zend_Json::encode(array("result"=> $s1." ".$s2));
	}
}