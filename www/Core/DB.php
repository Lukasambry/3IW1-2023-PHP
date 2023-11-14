<?php
namespace App\Core;

class DB

{
    private $table; 
    private $db;


    public function __construct()
    {
        $host = 'mariadb';
        $dbname = 'esgi';
        $username = 'esgi';
        $password = 'esgipwd';
        // var_dump($_ENV["DB_HOST"]);
        // var_dump(getenv("DB_HOST"));
        try {
            $this->db = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password); 
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
        $class = get_called_class();
        $this->table = "esgi_" . strtolower(str_replace("App\\Models\\", "", $class));

        //var_dump($this->table);
    }


    public function save()
    {   
        $attributes = get_object_vars($this);
        echo '<pre>';
        //var_dump($attributes);  
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
        //var_dump($sql);
        $stmt = $this->db->prepare($sql);
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
        $stmt = $this->db->prepare($sql);
        foreach ($attributes as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmt->execute();
    }

    // TODO: Try with FETCH_OBJ but failed
    // public function populate($id) {
    //     echo "<pre>";
    //     $stmt = $this->db->prepare("SELECT * FROM ".$this->table." WHERE id= ". $id);
    //     $stmt->execute();
    //     $stmt->fetch(\PDO::FETCH_OBJ, $id);
    //     $attributes = get_object_vars($stmt);
    // }


    public function populate($id) 
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            foreach ($data as $key => $value) {
                $setter = 'set' . ucfirst($key);
                if (method_exists($this, $setter)) {
                    $this->$setter($value);
                }
            }
        } else {
            echo "Aucun résultat";
        }
    }

}
