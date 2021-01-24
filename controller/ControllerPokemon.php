
<?php

require(__DIR__.'/../core/AbstractController.php');
require(__DIR__.'/../core/View.php');
require(__DIR__.'/../model/Pokemon.php');

class ControllerPokemon extends AbstractController {

    /**
     * Homepage action controller
     *
     * @throws Exception
     */
    public function index() {
        //$pokemon = Pokemon::getPokemon($this->request['id']);
        $pokemon = (new Pokemon)->getPokemon($this->request['id']);

        $this->createView(['pokemon' => $pokemon]);
    }
}