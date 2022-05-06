<?php
include_once "Config.php";
include_once "DatabaseConnection.php";

/**
 * Classe d'aide ï¿½ l'ï¿½criture des DAOs
 * pour le projet web de la premiï¿½re annï¿½e gï¿½nie informatique
 * Cette classe est ï¿½crite dans un cadre pï¿½dagogique
 *
 * === Gï¿½nie Informatique 1 ===
 *
 * @author Tarik BOUDAA
 *        
 */
class GenericDaoImpl
{

    /**
     * Nom de la table sur la quelle seront executï¿½es les opï¿½rations
     */
    private $tableName;

    /**
     * Nom de la classe entitï¿½ sur laquelle seront executï¿½es les opï¿½rations
     */
    private $className;

    /**
     * identifiant de l'entitï¿½ ï¿½ manipuler
     */
    private $entityId;

    /**
     * encapsule en connexion ï¿½ la base de donnï¿½es
     */
    private $connection;

    /**
     * Objet de reflexion permettant d'accï¿½der dynamiquement aux propriï¿½tï¿½s et mï¿½thodes d'une classe
     */
    private $reflection;

    /**
     * Constructeur
     *
     * @param
     *            $tableName
     * @param
     *            $className
     * @param
     *            $id
     */
    public function __construct($tableName, $className = null, $id = null)
    {
        //initialiser le nom de la table
        $this->tableName = $tableName;
        
        
        if ($className == null) {
            
            $this->className = $tableName;
        } else {
            $this->className = $className;
        }

        if ($id == null) {
            $this->entityId = "id";
        } else {
            $this->entityId = $id;
        }

        // Creation d'un objet de connexion ï¿½ la base de donnï¿½es
        $dabaBase = new DatabaseConnection(Config::host, Config::port, Config::database, Config::user, Config::password);
       
        
        
        $this->connection = $dabaBase->getPdo();

        // Crï¿½ation d'un obejet de rï¿½flexion pour la classe manipulï¿½e par ce DAO
        $this->reflection = new ReflectionClass($this->className);
    }

    /**
     * Permet d'executer une insertion d'une entitï¿½ en base de donnï¿½es
     *
     * @param $entity :
     *            instance de l'entitï¿½ ï¿½ sauvegarder dans la base de donnï¿½es
     */
    public function save($entity)
    {

        // Construction de l'instruction insert into
        $query = "INSERT INTO " . strtolower($this->tableName) . " (";

        // On obtient par rï¿½flexion la liste des noms des attributs de
        // l'entitï¿½ passï¿½e en paramï¿½tre
        $fields = $this->getFields();

        // On parcourt la liste des attributs
        // Ici on suppose que les colonnes de la table et les noms des attributs sont
        // les mï¿½mes. Si on ne respecte pas cette convenion cette classe ne va pas fonctionner
        for ($i = 0; $i < count($fields); $i ++) {
            // S'il ne s'agit pas de l'attribut clï¿½ primaire
            // (car on suppose que cette clï¿½ est autoincrï¿½mentï¿½ et gï¿½nï¿½rï¿½e par le GGBD)
            if ($fields[$i] != $this->getIdField()) {
                
                $query = $query . $fields[$i];

                // S'il ne s'agit pas du dernier ï¿½lï¿½ment alors ajouter virgule
                if ($i < count($fields) - 1) {
                    $query = $query . ", ";
                }
            }
        }

        // On continue la construction de l'ordre Insert
        $query = $query . ") VALUES (";

        // On parcourt la liste des attributs
        for ($i = 0; $i < count($fields); $i ++) {
            // S'il ne s'agit pas de l'attribut clï¿½ primaire
            if ($fields[$i] != $this->getIdField()) {
                // On ajoute les noms des paramï¿½tres sous form ":nom_attribut"
                $query = $query . ":" . $fields[$i];
                // S'il ne s'agit pas du dernier ï¿½lï¿½ment alors ajouter virgule
                if ($i < sizeof($fields) - 1) {
                    $query = $query . ", ";
                }
            }
        }
        $query = $query . ");";

        $values = [];
        for ($i = 0; $i < count($fields); $i ++) {

            if ($fields[$i] != $this->getIdField()) {

                // Pour chaque attribut on dï¿½duit le nom du getter associï¿½.
                // il est de forme get+nom de l'attribut, avec le premiï¿½re caractï¿½re en majiscule
                $getterMethodName = 'get' . ucfirst($fields[$i]);
                // On appel les getters par rï¿½flexion.

                $values[$fields[$i]] = $this->callMethod($getterMethodName, $entity);
            }
        }

        // On execute la requete
        $this->connection->prepare($query)->execute($values);
        $lastId = $this->connection->lastInsertId();
        $setIdMethod = 'set' . ucfirst($this->getIdField());
        $this->callMethod($setIdMethod, $entity, $lastId);

        return $lastId;
    }
// l'objet entity qui est passée en parameter est celui qui va insert a la base de données
// donc l'id de l'entité doit etre egal l'id de la ligne qu'on va modifié
    public function update($entity)
    {

        // Construction de l'instruction insert UPDATE
        $query = "UPDATE " . strtolower($this->className) . " SET ";
        $fields = $this->getFields();
        for ($i = 0; $i < count($fields); $i ++) {
            if ($fields[$i] != $this->getIdField()) {
                $query = $query . $fields[$i] . "=:" . $fields[$i];
                if ($i < count($fields) - 1) {
                    $query = $query . ", ";
                }
            }
        }
        $query = $query . " WHERE " . $this->getIdField() . " = :" . $this->getIdField() . " ;";
        echo $query;
        $values = [];
        for ($i = 0; $i < count($fields); $i ++) {

            // Pour chaque attribut on dï¿½duit le nom du getter associï¿½.
            // il est de forme get+nom de l'attribut, avec le premiï¿½re caractï¿½re en majiscule
            $getterMethodName = 'get' . ucfirst($fields[$i]);
            // On appel les getters par rï¿½flexion.
            $values[$fields[$i]] = $this->callMethod($getterMethodName, $entity);
        }

        $this->connection->prepare($query)->execute($values);
    }

    /**
     * Permet de retrouver toutes les entitï¿½s de la base de donnï¿½es
     *
     * @return array : un tableau des entitï¿½s
     */
    public function getAll()
    {
        // Construit la requete SELECT
        $query = "SELECT * FROM " . strtolower($this->tableName) . ";";

        // Il s'agit d'une requï¿½te paramï¿½trï¿½e
        $stmt = $this->connection->prepare($query);

        // On execute la requï¿½te
        if ($stmt->execute()) {
            $result = [];

            // rï¿½cupï¿½re les enregistrement retrouvï¿½s de la base de donnï¿½es
            // puis on copie les donnï¿½es aux objets
            while ($row = $stmt->fetch()) {
                $result[] = $this->mapToEntity($row);
            }
            return $result;
        }
        return [];
    }

    /**
     * Permet de retrouver une entitï¿½ par sa clï¿½ primaire
     *
     * @param
     *            $id
     * @return object|NULL
     */
    public function getById($id)
    {

        // On construit la requï¿½te
        $query = "SELECT * FROM " . strtolower($this->tableName) . " WHERE " . $this->getIdField() . " = :id;";
        $stmt = $this->connection->prepare($query);
        // On indique la valeur du paramï¿½tre :id
        $stmt->bindParam(':id', $id);

        // On execute la requete et on copie le rï¿½sultat vers un objet entitï¿½
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                return $this->mapToEntity($row);
            }
        }
        return null;
    }

    /**
     * Permet de retrouver une entitï¿½ par la valeur d'une colonne
     *
     * @param
     *            $id
     * @return object|NULL
     */
    public function getByColumnValue($col, $val)
    {

        // On construit la requï¿½te
        $query = "SELECT * FROM " . strtolower($this->tableName) . " WHERE $col = :val";
        $stmt = $this->connection->prepare($query);
        // On indique la valeur du paramï¿½tre :id
        $stmt->bindParam(':val', $val);

        // On execute la requete et on copie le rï¿½sultat vers un objet entitï¿½
        $data = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $data[] = $this->mapToEntity($row);
            }
        }
        // on retourne un tableau d'objets
        return $data;
    }

    /**
     * Permet de retrouver des entitï¿½s en utilisant plusieurs critï¿½res
     *
     * @param
     *            $criterias
     * @return object[]
     */
    public function findByEqualCreterias($criterias, $operator = null)
    {
        if ($operator == null) {
            $operator = 'AND';
        }

        // On construit la requï¿½te
        $query = "SELECT * FROM " . strtolower($this->tableName) . " WHERE ";
        $values = [];

        $i = 0;
        foreach ($criterias as $key => $val) {
            $query .= "$key=:$key";

            $values[$key] = $val;

            if ($i < count($criterias) - 1) {
                $query = $query . "  " . $operator . " ";
            }

            $i ++;
        }
        echo $query;
        $stmt = $this->connection->prepare($query);

        $results = [];

        // On execute la requete et on copie le rï¿½sultat vers un objet entitï¿½
        if ($stmt->execute($values)) {
            while ($row = $stmt->fetch()) {
                $results[] = $this->mapToEntity($row);
            }
        }
        return $results;
    }

    /**
     * Permet de retrouver des entitï¿½s en utilisant plusieurs critï¿½res
     *
     * @param
     *            $criterias
     * @return object[]
     */
    public function findByCreteria($criterias, $operators = [])
    {

        // On construit la requï¿½te
        $query = "SELECT * FROM " . strtolower($this->tableName) . " WHERE ";
        $values = [];

        $i = 0;
        foreach ($criterias as $crt) {

            $query .= $crt->getKey() . $crt->getSymbol() . ":" . $crt->getKey();
            if ($i < count($operators)) {
                $query = $query . " " . $operators[$i] . " ";
            }

            $values[$crt->getKey()] = $crt->getValue();

            $i ++;
        }
        $stmt = $this->connection->prepare($query);

        $results = [];

        // On execute la requete et on copie le rï¿½sultat vers un objet entitï¿½
        if ($stmt->execute($values)) {
            while ($row = $stmt->fetch()) {
                $results[] = $this->mapToEntity($row);
            }
        }
        return $results;
    }

    /**
     * Permet de supprimer une ligne dans la base de donnï¿½es dont l'id est passï¿½ en pramï¿½tre
     *
     * @param
     *            $id
     */
    public function remove($id)
    {
        $query = "DELETE FROM " . strtolower($this->className) . " WHERE " . $this->getIdField() . " = ?;";
        $values = [
            $id
        ];

        $this->connection->prepare($query)->execute($values);
    }

    /**
     * Retourne la liste des attributs d'une classe
     *
     * @return array
     */
    private function getFields()
    {
        $properties = $this->reflection->getProperties(ReflectionProperty::IS_PRIVATE);
        
        $fields = [];
        
        foreach ($properties as $prop) {

            array_push($fields, $prop->getName());
        }
        return $fields;
    }

    /**
     * Permet d'appeler d'une faï¿½on dynamique une mï¿½thode
     */
    private function callMethod($methodName, $class, $arg = null)
    {
        if ($arg == null) {
            return call_user_func_array(array(
                $class,
                $methodName
            ), array());
        } else {
     
            return call_user_func_array(array(
                $class,
                $methodName
            ), array(
                $arg
            ));
        }
    }

    /**
     * Copie les donnï¿½es d'une ligne de rï¿½sultat vers un objet
     * (Elle effectue le mapping entre les lignes d'un rï¿½sultat d'execution d'une
     * requï¿½te SQL et les objets)
     *
     * @param
     *            $row
     * @return
     */
    private function mapToEntity($row)
    {
        $fields = $this->getFields();

        // On construit dynamiquement une instance
        $entity = $this->reflection->newInstanceArgs();
        for ($i = 0; $i < count($fields); $i ++) {
            // On appel les setters pour copier les donnï¿½es vers les objets
            $setterMethodName = 'set' . ucfirst($fields[$i]);
            $this->callMethod($setterMethodName, $entity, $row[$fields[$i]]);
        }

        return $entity;
    }

    private function getIdField()
    {
        return $this->entityId;
    }
    
    public function getConnection(){
        return $this->connection;
    }
}


