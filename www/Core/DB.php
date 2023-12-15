<?php
namespace App\Core;

class DB

{
    // private $table; 
    // private $db;


    // public function __construct()
    // {
    //     $host = 'mariadb';
    //     $dbname = 'esgi';
    //     $username = 'esgi';
    //     $password = 'esgipwd';
    //     // var_dump($_ENV["DB_HOST"]);
    //     // var_dump(getenv("DB_HOST"));
    //     try {
    //         $this->db = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password); 
    //         $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    //     } catch (\PDOException $e) {
    //         die($e->getMessage());
    //     }
    //     $class = get_called_class();
    //     $this->table = "esgi_" . strtolower(str_replace("App\\Models\\", "", $class));

    //     //var_dump($this->table);
    private ?object $pdo = null;
    private string $table;

    public function __construct()
    {
        //connexion à la bdd via pdo
        try{
            $this->pdo = new \PDO("mysql:host=mariadb;dbname=esgi;charset=utf8", "esgi", "esgipwd");
        }catch (\PDOException $e) {
            echo "Erreur SQL : ".$e->getMessage();
        }

        $table = get_called_class();
        $table = explode("\\", $table);
        $table = array_pop($table);
        $this->table = "esgi_".strtolower($table);
    }

    public function getDataObject(): array
    {
        return array_diff_key(get_object_vars($this), get_class_vars(get_class()));
    }

    public function save()
    {   
        $attributes = get_object_vars($this);
        echo '<pre>';

        unset($attributes['db']);
        unset ($attributes['table']);

        if (isset($attributes['id'])) {
            $this->update($attributes);
        } else {
            $this->insert($attributes);
        }
    }

    public function insert($attributes)
    {
        $sql = "INSERT INTO ".$this->table." (";
        foreach ($attributes as $key => $value) {
            $sql .= $key.", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ") VALUES (";
        foreach ($attributes as $key => $value) {
            $sql .= ":".$key.", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ")";

        $stmt = $this->pdo->prepare($sql);
        foreach ($attributes as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmt->execute();
    }

    public function update($attributes)
    {
        $sql = "UPDATE ".$this->table." SET ";
        foreach ($attributes as $key => $value) {
            $sql .= $key."=:".$key.", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        foreach ($attributes as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmt->execute();
    }

    public static function populate(int $id): object
    {
        $class = get_called_class();
        $object = new $class();
        return $object->getOneBy(["id"=>$id], "object");
    }

    //$data = ["id"=>1] ou ["email"=>"y.skrzypczyk@gmail.com"]
    public function getOneBy(array $data, string $return = "array")
    {
        $sql = "SELECT * FROM \"" . $this->table . "\" WHERE ";
        foreach ($data as $column => $value) {
            $sql .= "\"" . $column . "\" = :" . $column . " AND ";
        }
        $sql = rtrim($sql, ' AND ');
        $queryPrepared = $this->pdo->prepare($sql);
        foreach ($data as $key => &$value) {
            $queryPrepared->bindParam(":".$key, $value);
        }
        $queryPrepared->execute();
        if ($return == "object") {
            $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        }
    
        return $queryPrepared->fetch();
    }  

}
