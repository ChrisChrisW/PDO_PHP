<?php
require(__DIR__.'/../core/AbstractController.php');
require(__DIR__.'/../core/View.php');
require(__DIR__.'/../model/Pokemon.php');

require(__DIR__.'/../core/Form.php');

class ControllerForm extends AbstractController {

    /**
     * Form action controller
     *
     * @throws Exception
     */
    public function index() {
        $name = '';
        $page = 'form';
        $types = (new Pokemon)->getListTypes();
        $msg = '';

        $form = new Form();
        $input = $form->input('name', 'text', true);
        $input .= $form->input('type', 'select');
        $input .= $form->checkbox('form');
        $form = $form->createForm($input);

        $request = (new Request())->getTypeRequest();

        if ($request === $_POST && $request['submit']) {
            if ($request['name'] && $request['type'])
            {
                if (count($request['type']) < 3){
                    $msg = "C'est bon !";
                    header('Location: ./homepage');
                    (new Pokemon)->setPokemon($request);
                } else {
                    $msg = "Il faut au max 2 types !";
                }
            } else {
                $msg = "Le champs est vide !";
            }
        }

        $this->createView([
            'form' => $form,
            'page' => $page,
            'name' => $name,
            'types' => $types,
            'msg' => $msg]);
    }

}