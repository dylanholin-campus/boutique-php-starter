<?php

class Category
{
    public $id;
    public $nom;
    public $description;

    public function __construct($id, $nom, $description)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
    }

    public function getSlug()
    {
        return strtolower(str_replace(' ', '-', $this->nom));
    }
}
