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

        public function getTopicsByIdCategory($id){
            parent::connect();

            $sql ="
            SELECT t.title, t.category_id 
            FROM topic t
            INNER JOIN category c ON c.id_category = t.category_id
            WHERE t.category_id = :id;
            ";
            
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }
    }