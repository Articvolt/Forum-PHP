<?php
// NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

// LA CLASSE "TOPICMANAGER" VA HERITER DE TOUTE LES METHODES DE LA CLASSE "MANAGER"
    class TopicManager extends Manager{

        // PROTECTED : permet d'utiliser les attributs et méthodes(fonctions) d'une classe parent.

        // relie à la classe située dans le chemin désignée.
        protected $className = "Model\Entities\Topic";
        // relie au nom de la table dans la base de donnée.
        protected $tableName = "topic";

        // constuct structuré par la classe parent "MANAGER" et connecté à la base de donnée.
        public function __construct() {
            parent::connect();
        }


// FONCTION QUI SELECTIONNE LES TOPIC PAR CATEGORY CIBLE
        public function getTopicsByIdCategory($id) {
            parent::connect();
            $sql ="
            SELECT * 
                FROM ".$this->tableName." t
                WHERE t.category_id = :id
            ";
            
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }


// FONCTION POUR AJOUTER UN TOPIC
        public function addTopic($id) {
            // filtres pour la sécurité du formulaire
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // renvoi à un user fixe (temporaire)
            $userId= 1;

            // si les valeurs existent 
            if($id && $title && $text) {

                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newTopic=["title"=>$title,"categorie_id"=>$id, "user_id"=>$userId];
                // utilisation de la fonction add($data) dans manager
                $newTopicId = $this->add($newTopic);

                // connection au manager POST
                $postManager = new PostManager;

                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newPost=["text"=>$text, "topic_id"=>$newTopicId, "user_id"=>$userId];
                //lien avec le manager POST
                $postManager->add($newPost);
            }
            // $this->redirectTo("exercices/forum-PHP","listTopicsByIdCategory")
        }
    }