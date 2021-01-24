<?php
require(__DIR__.'/../core/AbstractController.php');
require(__DIR__.'/../core/View.php');
require(__DIR__.'/../model/Pokemon.php');

class ControllerHomepage extends AbstractController {

    /**
     * Homepage action controller
     *
     * @throws Exception
     */
    public function index() {
        //$pokemons = Pokemon::getList();
        $pokemons = (new Pokemon)->getList();

        $this->createView(['pokemons' => $pokemons]);
    }
}