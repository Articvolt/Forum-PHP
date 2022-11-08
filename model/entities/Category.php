<?php
    // Les namespaces permettent de définir un nom de "package" que l'on pourra charger de manière automatique (autoloading)
    namespace Model\Entities;

    use App\Entity;

    //  le mot clé "final pour" les classes empêche l'heritage
    final class Category extends Entity{

        private $id;
        private $label;
        
        public function __construct($data){ 
        // hydrater un objet permet de fournir des valeurs à ses attributs. La fonction prend comme argument, un tableau associatif ($data)
                $this->hydrate($data);
        }
 
// GETTER ID
        public function getId()
        {
                return $this->id;
        }

// SETTER ID
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

// GETTER LABEL
        public function getLabel()
        {
                return $this->label;
        }

// SETTER LABEL
        public function setLabel($label)
        {
                $this->label = $label;

                return $this;
        }

        public function __toString()
        {
                return $this->label;
        }
}
    