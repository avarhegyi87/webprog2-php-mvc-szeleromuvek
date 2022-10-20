<?php

class Regisztral_Controller {
	public $baseName = 'regisztral';

	public function main(array $vars) {
		$regisztralModel = new Regisztral_Model;
		$retData = $regisztralModel->get_data($vars);
		if($retData['eredmeny'] == "ERROR")
			$this->baseName = "regisztral";
		//betöltjük a nézetet
		$view = new View_Loader($this->baseName.'_main');
		//Átadjuk a lekérdezett adatokat a nézetnek
		foreach($retData as $name => $value)
			$view->assign($name, $value);
	}
}