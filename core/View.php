<?php
require(__DIR__.'/../vendor/autoload.php');

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View {

    private $file;

    /**
     * View constructor.
     *
     * @param string $controller
     */
    public function __construct($controller = '')
    {
        //$file = 'view/';
        $file = '';

        if ($controller !== '') {
            $file .= $controller . '/';
        }

        $this->file = $file . 'index.html.twig';
    }

    /**
     * Create view
     *
     * @param array $data
     *
     * @throws Exception
     */
    public function createView($data = [])
    {
        $loader = new FilesystemLoader(__DIR__."/../view"); // Path to load twig
        $twig = new Environment($loader); // Environment to load twig

        //$view = $this->generateFile($this->file, $data);
        $view = $twig->render($this->file, $data);

        echo $view;
    }

    /**
     * Generate view with data
     *
     * @param $file
     * @param $data
     *
     * @return false|string
     * @throws Exception
     */
    private function generateFile($file, $data)
    {
        if (file_exists($file)) {

            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        }
        else {
            throw new Exception('Fichier ' . $file . ' introuvable');
        }
    }
}