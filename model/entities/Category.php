<?php
    namespace Model\Entities;

    use App\Entity;

    final class Category extends Entity{

        private $id;
        private $label;
        
        public function __construct($data){         
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
    }