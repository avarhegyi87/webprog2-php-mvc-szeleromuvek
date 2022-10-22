<?php

class Hirek_Model {
	public function get_data($vars): array {
		$retData['eredmey'] = "";
		$retData['tartalom'] = "";
		try {
			$connection = Database::getConnection();
			$sqlSelect = "select h.datum, f.bejelentkezes, h.hir from hirek as h
				inner join felhasznalok as f on f.id = h.userid";
			$stmt = $connection->prepare($sqlSelect);
			$stmt->execute(array());
			$hirLista = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$hirTalalat = $stmt->rowCount();
			switch (true) {
				case $hirTalalat = 0:
					$retData['eredmey'] = "ERROR";
					$retData['uzenet'] = "Nincs megjelenítendő hír.";
					break;
				case $hirTalalat >= 0:
					$retData['eredmey'] = "OK";
					foreach ($hirLista as $hir) {
						$sqlSelect = "select k.datum, f.bejelentkezes, k.komment from kommentek as k
							left join felhasznalok as f on f.id = h.userid
							left join hirek as h on h.id = k.hirid
							where h.id = :hirid";
						$stmt = $connection->prepare($sqlSelect);
						$stmt->execute(array(
							':hirid'=>$hir['id']
									   ));
						$kommentek = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
			}
		} catch (PDOException $e) {
			$retData['eredmey'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage();
		}
		return $retData;
	}
}
