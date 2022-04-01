<?php
class Database {

    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private \PDO|false $pdo;

    public function __construct()
    {
        $this->getConfig();
        $this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    /**
     * Récupère les infos de connexion à la BDD pour charger les propriétés
     *
     * @return void
     */
    private function getConfig()
    {
        // On vérifie que le fichier de config existe
        if (file_exists("config/dbConfig.php")) {
            require "config/dbConfig.php";
            // On parcourt le tableau et pour chaque élément on associe la valeur à la propriété du même nom que la clé
            foreach ($dbConfig as $key => $value) {
                $this->$key = $value;
            }
        } else {
            throw new \Exception("Le fichier de config de Base de données n'existe pas.", 1);
        }
    }

    /**
     * Permet d'utiliser la connexion à la BDD
     *
     * @return \PDO|false
     */
    public function getPdo(): \PDO|false
    {
        return $this->pdo;
    }

    /**
     * Récupère les informations en BDD
     *
     * @param string $statement
     * @param boolean $one
     * @return void
     */
    public function getData (string $statement, bool $one = false)
    {
        $query = $this->pdo->query($statement);
        if ($one) {
            return $query->fetch(\PDO::FETCH_OBJ);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }


    /**
     * Ajoute ou met à jour des données en BDD
     *
     * @param string $statement
     * @param array $data
     */
    public function saveData (string $statement, array $data = [])
    {
        // On encode les données pour éviter d'enregistrer du code en BDD
        $verifyData = $this->verifyData($data);
        $prepare = $this->pdo->prepare($statement);
        if ($prepare->execute($verifyData)) {
            return 'success';
        } else {
            throw new \Exception("Une erreur s'est produite lors de l'insertion. Veuillez réessayer");
        }
    }

    /**
     * Suprimme des données en BDD
     *
     * @param string $statement
     * @param array $data
     */
    public function deleteData (string $statement)
    {
        $query = $this->pdo->query($statement);
        if ($query->execute()) {
            return 'success';
        } else {
            throw new \Exception("Une erreur s'est produite lors du delete. Veuillez réessayer");
        }
    }

    /**
     * Encode les données reçues pour éviter l'injection de script
     *
     * @param array $data
     * @return array
     */
    public function verifyData(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value);
        }
        return $data;
    }
}