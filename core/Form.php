<?php

class Form
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getValue($index)
    {
        return $this->data[$index] ?? null;
    }

    public function input(string $name, $typeInput, $required = false): string
    {
        $br = "</br>";
        $nom = ucfirst($name);
        $label = "<label for=".$name.">".$nom." :</label>".$br;

        if($typeInput === 'select'){
            $types = (new Pokemon)->getListTypes();

            $input = $label."<select name='type[]' multiple>";
            foreach ($types as $type)
            {
                $input .= "<option value=".$type->id.">".$type->label."</option>";
            }
            $input .= "</select>";
        } elseif (!empty($typeInput)){
            $input = $label."<input type=".$typeInput." name=".$name." value='".$this->getValue($name)."'";
            if ($required){
                $input .= " required>";
            } else {
                $input .= ">";
            }
        }

        return $input.$br.$br;
    }

    public function checkbox($page)
    {
        return "<input type='checkbox' name='page' value=".$page." required>";
    }

    protected function submit()
    {
        return "<input type='submit' name='submit'>";
    }

    public function createForm($input = '', $action = ''){
        $form = "<h3>Formulaire avec PHP</h3>";
        $form .= "<form method='post' action=".$action.">";
        $form .= $input;
        $form .= $this->submit();
        $form .= "</form>";

        return $form;
    }
}