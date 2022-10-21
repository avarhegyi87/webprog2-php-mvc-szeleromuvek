<?php
	require("tables.php");
	$server = new SoapServer("tables.wsdl");
	$server->setClass('Tables');
	$server->handle();
?>