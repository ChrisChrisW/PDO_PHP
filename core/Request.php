<?php
// Request (facile)
// Communique avec Router.php
class Request {
    private $httpRequest;

    public function __construct() {
        //$this->httpRequest;
        $this->setTypeRequest();
    }

    public function getTypeRequest()
    {
        return $this->httpRequest;
    }

    protected function setTypeRequest() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->httpRequest = $_GET;
                break;
            case 'POST':
                $this->httpRequest = $_POST;
                break;
            default:
                $this->httpRequest = "";
                throw new Exception('La requête doit être absolument un GET ou un POST');
        }
    }
}