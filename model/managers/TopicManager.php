<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
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
        public function addTopic() {
            // lie à la catégorie actuelle
            $idCategory = $_GET["id"];
            // filtres pour la sécurité du formulaire
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // renvoi à un user fixe (temporaire)
            $userId= 1;

            if($idCategory && $title && $content) {

                $newTopic=["title"=>$title,"categorie_id"=>$idCategory, "user_id"=>$userId];

                $newTopicId = $this->add($newTopic);

                // connection au manager POST
                $postManager = new PostManager;

                $newPost=["content"=>$content, "topic_id"=>$newTopicId, "user_id"=>$userId];
                //lien avec le manager POST
                $postManager->add($newPost);

                return $newTopicId;

            }
        }
    }