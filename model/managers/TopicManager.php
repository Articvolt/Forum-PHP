<?php
// NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

// LA CLASSE "TOPICMANAGER" VA HERITER DE TOUTE LES METHODES DE LA CLASSE "MANAGER"
    class TopicManager extends Manager {

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
                ORDER BY dateTopic DESC
            ";
            
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }

// FONCTION QUI MODIFIE UN TOPIC
        public function editTopic($id, $title) {
            parent::connect();

             // requête SQL
             $sql = "
             UPDATE topic
             SET title = :title
             WHERE id_topic = :id
             ";
 
             // relie a la fonction préfaite dans DAO qui update la base de données
             DAO::update($sql, ["id"=>$id,"title"=>$title]);
        }

// FONCTION QUI LOCK LES TOPICS
        public function lockTopic($id) {
            parent::connect();

            $sql = "
            UPDATE topic
            SET closed = 1
            WHERE id_topic = :id
            ";

            // relie a la fonction préfaite dans DAO qui update la base de données
            DAO::update($sql, ["id"=>$id]);
        }

// FONCTION QUI LOCK LES TOPICS
        public function unlockTopic($id) {
            parent::connect();

            $sql = "
            UPDATE topic
            SET closed = 0
            WHERE id_topic = :id
            ";

            // relie a la fonction préfaite dans DAO qui update la base de données
            DAO::update($sql, ["id"=>$id]);
        }
    }