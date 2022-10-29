<?php
	//error_reporting(0);
	require 'tables.php';
	require 'WSDLDocument/WSDLDocument.php';
	$wsdl = new WSDLDocument('Tables', "http://localhost/feladat/server/server.php", "http://localhost/feladat/server/");
	$wsdl->formatOutput = true;
	$wsdlfile = $wsdl->saveXML();
	echo $wsdlfile;
	file_put_contents ("tables.wsdl" , $wsdlfile);
?>
