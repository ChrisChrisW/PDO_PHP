<?php
// Le fichier Pokemon.php, quant à lui, va étendre de AbstractModel et regrouper les propriétés de nos pokémons (ID, name, types)
require(__DIR__.'/../core/AbstractModel.php');

class Pokemon extends AbstractModel {
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $types;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }

    /**
     * Get All pokemon list with types
     *
     * @return array
     */
    public function getList(): array
    {
        return $this->findAll();
    }

    /**
     * Get a pokemon with is id
     *
     * @param $id
     * @return object
     */
    public function getPokemon($id): object
    {
        return $this->findOneById($id);
    }


    /**
     * Get All types on pokemon
     *
     * @return array
     */
    public function getListTypes(): array
    {
        return $this->findAllType();
    }

    /**
     * Set a pokemon on DB
     *
     * @param $request
     * @return array
     */
    public function setPokemon($request): array
    {
        return $this->save($request);
    }

}