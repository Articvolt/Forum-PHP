<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";

        public function __construct()
        {
            parent::connect();
        }
        
        // public function getTopics(){
        //     $sql = "
        //         SELECT *
        //         FROM ".$this->tableName." c
        //         INNER JOIN topic t ON t.category_id = c.id_category
        //     ";
            
        // }
    }