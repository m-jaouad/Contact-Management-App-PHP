<?php
include_once "Config.php";

/**
 * Classe qui g�re la connexion avec la base de donn�es
 *
 * @author Tarik BOUDAA
 *        
 */
class DatabaseConnection
{

    private $pdo;

    private $host;

    private $port;

    private $database;

    private $user;

    private $password;

    /**
     *
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     *
     * @param mixed $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    function __construct($host, $port, $database, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;

        $this->connect();
    }

    function connect()
    {
        $connectionString = "mysql:host=" . $this->host . ";port=" . $this->port . ";charset=utf8;dbname=" . $this->database;
        $this->pdo = new PDO($connectionString, $this->user, $this->password);
    }
}
