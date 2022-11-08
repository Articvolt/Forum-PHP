<?php
// NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

// LA CLASSE "POSTMANAGER" VA HERITER DE TOUTE LES METHODES DE LA CLASSE "MANAGER"
    class PostManager extends Manager{

        // PROTECTED : permet d'utiliser les attributs et méthodes(fonctions) d'une classe parent.

        // relie à la classe située dans le chemin désignée.
        protected $className = "Model\Entities\Post";
        // relie au nom de la table dans la base de donnée.
        protected $tableName = "post";

        // constuct structuré par la classe parent "MANAGER" et connecté à la base de donnée.
        public function __construct(){
            parent::connect();
        }

// FONCTION QUI SELECTIONNE LES POST PAR TOPIC CIBLE
        public function getPostsByIdTopic($id) {
            parent::connect();
            $sql ="
            SELECT * 
                FROM ".$this->tableName." p
                WHERE p.topic_id = :id
                ORDER BY datePost ASC
            ";
            
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }

// FONCTION POUR AJOUTER UN POST
        public function addPost($id) {
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = 1;

            if($text && $id && $userId){
                $newPost=["text"=>$text, "topic_id"=>$id, "user_id"=>$userId];
                return $this->add($newPost);
            }
  
        }
    }
    