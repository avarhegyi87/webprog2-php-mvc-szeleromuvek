<?php

class Menu {
	public static array $menu = array();

	public static function setMenu() {
		self::$menu = array();
		$connection = Database::getConnection();
		$sqlSelect = "select url, nev, jogosultsag from menu where jogosultsag like :jogosultsag order by sorrend";
		$stmt = $connection->prepare($sqlSelect);
		$stmt->execute(array(':jogosultsag' => $_SESSION['userlevel']));
		while ($menuitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
			self::$menu[$menuitem['url']] = array($menuitem['nev'], $menuitem['jogosultsag']);
		}
	}

	public static function getMenu($sItems): string {

		$menu = "<ul>";
		foreach (self::$menu as $menuindex => $menuitem) {
			$menu .= "<li><a href='" . SITE_ROOT . $menuindex . "' " .
				($menuindex == $sItems[0] ? "class='selected'" : "") . ">" . $menuitem[0] . "</a></li>";
		}
		$menu .= "</ul>";

		return $menu;
	}
}

Menu::setMenu();
