<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


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
    