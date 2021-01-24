<?php
require_once(__DIR__."/Request.php");

class Router {

    /**
     * @var array
     */
    private $request;

    /**
     * Récupère les paramètres en GET et POST puis génère le controller associé
     *
     * @throws Exception
     */
    public function createRequest(): void
    {
        try {
            //$this->request = array_merge($_GET, $_POST);

            $controller = $this->createController();

            $controller->index();
        } catch (Exception $e) {
            // 404
            throw new Exception('404 - Page introuvable');
        }
    }

    /**
     * Charge le fichier et la classe du controller
     *
     * @return AbstractController
     * @throws Exception
     */
    private function createController(): AbstractController
    {
        $controller = 'Homepage';

        /*if (isset($this->request['page']) && $this->request['page'] !== '') {
            $controller = $this->request['page'];
        }*/

        // Request (facile)
        $request = (new Request())->getTypeRequest();

        if ($request){
            $controller = $request['page'];
        }

        $controller = ucfirst(strtolower($controller));
        $controllerClass = 'Controller' . $controller;
        $controllerFile = 'Controller/' . $controllerClass . '.php';

        if (file_exists($controllerFile)) {
            // Instanciation du contrôleur adapté à la requête
            require($controllerFile);

            $controller = new $controllerClass();

            $controller->setRequest($request);

            return $controller;
        } else {
            throw new Exception('Fichier ' . $controllerFile . ' introuvable');
        }
    }
}