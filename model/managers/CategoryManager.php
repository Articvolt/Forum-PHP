<?php
// NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

// LA CLASSE "CATEGORYMANAGER" VA HERITER DE TOUTE LES METHODES DE LA CLASSE "MANAGER"
    class CategoryManager extends Manager{

        // PROTECTED : permet d'utiliser les attributs et méthodes(fonctions) d'une classe parent.

        // relie à la classe située dans le chemin désignée.
        protected $className = "Model\Entities\Category";
        // relie au nom de la table dans la base de donnée.
        protected $tableName = "category";

        // constuct structuré par la classe parent "MANAGER" et connecté à la base de donnée.
        public function __construct() {
            parent::connect();
        }   
        
        public function editLabel($label, $id) {
            parent::connect();
            $sql= ["
            UPDATE ".$this->tableName."
            SET label = :label
            WHERE category_id = :id
            "];

            return($this->getSingleScalarResult(DAO::select($sql,['label' => $label],['id' => $id])));
        }
    }