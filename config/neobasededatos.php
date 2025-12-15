<?php

class baseDedatos {
    private static $pdo = null;

    private function __construct() {}

    public static function conectar() {
        if (self::$pdo === null) {
            $config = require __DIR__ . "/configuracion.php";

            $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";

            try{
                self::$pdo = new PDO($dsn, $config['user'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => FALSE,
                ]);
            } catch (PDOException $e) {
                die("Error DB: ". $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

function seleccionar($sql, $params =[]){
    $pdo = baseDedatos::conectar();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function ejecutar($sql, $params = []) {
    $pdo = baseDedatos::conectar();
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}
