<?php
//Konstans változók létrehozása.
const HOST = 'localhost';
const DATABASE = 'szeleromuvek';
const USER = 'root';
const PASSWORD = '';

//Osztály, amiben található függvény segítségével csatlakozhatunk az adatbátzishoz.
class Database {
	private static PDO|bool $connection = FALSE;

	public static function getConnection(): PDO|bool {
		if (!self::$connection) {
			self::$connection = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD,
										array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			self::$connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
		}
		return self::$connection;
	}
}
