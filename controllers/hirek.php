<?php

class Hirek_Controller {
	public string $baseName = 'hirek';

	public function main(array $vars) {
		$view = new View_Loader($this->baseName);
	}
}