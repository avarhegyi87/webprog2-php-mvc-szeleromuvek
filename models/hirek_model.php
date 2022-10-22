<?php

class Hirek_Model {
	public function get_data($vars): array {
		$retData['eredmeny'] = "";
		$retData['tartalom'] = "";
		try {
			$connection = Database::getConnection();
			$sqlSelect = "select h.id, h.datum, f.bejelentkezes, h.hir from hirek h
				inner join felhasznalok f on f.id = h.userid";
			$stmt = $connection->prepare($sqlSelect);
			$stmt->execute(array());
			$hirLista = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$hirTalalat = $stmt->rowCount();
			switch (true) {
				case $hirTalalat == 0:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Nincs megjelenítendő hír.";
					break;
				case $hirTalalat >= 0:
					$retData['eredmeny'] = "OK";
					foreach ($hirLista as $hir) {
						$sqlSelect = "select k.id, k.datum, f.bejelentkezes, k.komment from kommentek k 
    									left join hirek h on h.id = k.hirid 
    									left join felhasznalok f on f.id = h.userid 
										where h.id = :hirid";
						$stmt = $connection->prepare($sqlSelect);
						$stmt->execute(array(':hirid' => $hir['id']));
						$osszesKomment = $stmt->fetchAll(PDO::FETCH_ASSOC);
						foreach ($osszesKomment as $Item) {
							$kommentek[] = [
								'id'=>$Item['id'],
								'datum'=>$Item['datum'],
								'bejelentkezes'=>$Item['bejelentkezes'],
								'komment'=>$Item['komment']
							];
						}
						$tartalom[] = [
							'id' => $hir['id'],
							'datum' => $hir['datum'],
							'bejelentkezes' => $hir['bejelentkezes'],
							'hir' => $hir['hir'],
							'kommentek' => $kommentek
						];
					}
					$retData = $tartalom;
			}
		} catch (PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "<br>Hibás sor: " . $e->getLine();
		}
		return $retData;
	}
}

