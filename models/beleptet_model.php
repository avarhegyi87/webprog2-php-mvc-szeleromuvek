<?php

class Beleptet_Model {
	public function get_data($vars): array {
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sqlSelect = "select id, csaladi_nev, utonev, jogosultsag from felhasznalok where bejelentkezes=:bejelentkezes and jelszo=:jelszo";
			$stmt = $connection->prepare($sqlSelect);
			$stmt->execute(array(
				':bejelentkezes'=>$vars['login'],
				':jelszo'=>sha1($vars['password'])
						   ));
			$felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			switch (count($felhasznalo)) {
				case 0:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Helytelen felhasználói név-jelszó pár!<br>" . print_r($vars);
					break;
				case 1:
					$retData['eredmény'] = "OK";
					$retData['uzenet'] = "Kedves " . $felhasznalo[0]['csaladi_nev'] . " " . $felhasznalo[0]['utonev'] . "!<br><br>
					                      Jó munkát kívánunk rendszerünkkel.<br><br>
										  Az üzemeltetők";
					$_SESSION['userid'] = $felhasznalo[0]['id'];
					$_SESSION['userlastname'] = $felhasznalo[0]['csaladi_nev'];
					$_SESSION['userfirstname'] = $felhasznalo[0]['utonev'];
					$_SESSION['userlevel'] = $felhasznalo[0]['jogosultsag'];
					Menu::setMenu();
					break;
				default:
					$retData['eredmény'] = "ERROR";
					$retData['uzenet'] = "Több felhasználót találtunk a megadott felhasználói név -jelszó párral!";
			}
		} catch (PDOException $e) {
			$retData['eredmény'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
		}
		return $retData;
	}
}
