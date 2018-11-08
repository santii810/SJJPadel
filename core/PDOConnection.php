<?php
// file: /core/PDOConnection.php

class PDOConnection {
	private static $dbhost = "localhost";
	private static $dbname = "sjjpadel";
	private static $dbuser = "abp";
	private static $dbpass = "abp";
	private static $db_singleton = null;

	public static function getInstance() {
		if (self::$db_singleton == null) {
			self::$db_singleton = new PDO(
			"mysql:host=".self::$dbhost.";dbname=".self::$dbname.";charset=utf8", // connection string
			self::$dbuser,
			self::$dbpass,
			array( // options
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			)
		);
	}
	return self::$db_singleton;
}
}
?>
