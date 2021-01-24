<?php

abstract class AbstractModel{

    protected static $bdd;

    abstract protected function getList();
    abstract protected function getPokemon($id);
    abstract protected function setPokemon($name);

    abstract protected function getListTypes();

    /**
     * Create query object
     *
     * @param       $sql
     * @param       $classNameObject
     * @param array $params
     *
     * @return bool|PDOStatement
     */
    protected static function createQuery($sql, $classNameObject, $params = [])
    {
        $query = self::DB()->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, $classNameObject);
        $query->execute($params);

        return $query;
    }

    /**
     * Get PDO connection
     *
     * @return PDO
     */
    protected static function DB(): PDO
    {
        if (self::$bdd === null) {
            // Création de la connexion
            self::$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]);
        }

        return self::$bdd;
    }

    /**
     * Find all object element in PDO
     *
     * @return array
     */
    protected function findAll(): array
    {
        $sql = 'SELECT P.*, group_concat(DISTINCT T.label ORDER BY T.label DESC SEPARATOR \', \') as types
                FROM pokemon AS P
                INNER JOIN pokemon_has_type as PHT ON PHT.pokemon_id = P.id
                INNER JOIN type as T ON PHT.type_id = T.id
                GROUP BY P.id, P.name';

        $query = self::createQuery($sql, self::class);

        // return $query->fetch(PDO::FETCH_ASSOC); TODO: return array
        //return $query->fetchAll(PDO::FETCH_CLASS); TODO: return array of object
        return $query->fetchAll(PDO::FETCH_OBJ); // TODO: return array of object
    }

    /**
     * Find an object element by id
     *
     * @param $id
     * @return object
     */
    protected function findOneById($id): object
    {
        $sql = 'SELECT id, name FROM pokemon WHERE id = :id';

        $query = self::createQuery($sql, self::class, [
            'id' => $id
        ]);

        // return $query->fetch(PDO::FETCH_ASSOC); TODO: return array
        // return $query->fetch(PDO::FETCH_OBJ); TODO: return object
        return $query->fetchObject(); // TODO: return object
    }


    /**
     * Find an object element
     *
     * @param array $array
     * @return object
     */
    protected function findOneBy(array $array): object
    {
        foreach ($array as $key => $value){
            $sql = 'SELECT '.$key.', name FROM pokemon WHERE '.$key.' = '.$value;

            $query = self::createQuery($sql, self::class, [
                $key => $value
            ]);
        }

        return $query->fetchObject();
    }

    protected function findById($array)
    {
        $sql = 'SELECT id, name FROM pokemon WHERE id = :id';

        $query = self::createQuery($sql, self::class, $array);

        // return $query->fetch(PDO::FETCH_ASSOC); TODO: return array
        // return $query->fetch(PDO::FETCH_OBJ); TODO: return object
        return $query->fetchObject(); // TODO: return object
    }


    /**
     * @return array
     */
    protected function findAllType(): array
    {
        $sql = 'SELECT * FROM type';

        $query = self::createQuery($sql, self::class);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Save in database
     *
     * @param $request
     * @return array
     */
    protected function save($request): array
    {
        $name = ['name' => $request['name']];
        $sql = 'INSERT INTO pokemon (name) VALUE (:name);';
        $query = self::createQuery($sql, self::class, $name );


        $type_id = $request['type'];
        $lastId = self::DB()->lastInsertId(); // TODO: Récupère le dernier id insérer dans la DB ( table pokemon)
        for ($i = 0; $i < sizeof($type_id); $i++)
        {
            $sql = 'INSERT INTO pokemon_has_type (pokemon_id, type_id) VALUE (:pokemon_id, :type_id)';
            $query = self::createQuery($sql, self::class, [
                'pokemon_id' => $lastId,
                'type_id' => $type_id[$i]]);
        }

        return $query->fetchAll();
    }
}