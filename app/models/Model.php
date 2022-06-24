<?php

    abstract class Model
	{
        static function init() {
            try {
                return new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME, DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                print "Ошибка!: " . $e->getMessage();
                die();
            }
        }
	}
