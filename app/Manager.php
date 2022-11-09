<?php
    namespace App;

    abstract class Manager{

        protected function connect(){
            DAO::connect();
        }

        /**
         * get all the records of a table, sorted by optionnal field and order
         * 
         * @param array $order an array with field and order option
         * @return Collection a collection of objects hydrated by DAO, which are results of the request sent
         */

// FONCTION QUI RECHERCHE TOUTE LES LIGNES DE LA TABLE
        public function findAll($order = null) {

            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            // requête SQL
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ".$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
       
// FONCTION QUI SELECTIONNE UNE LIGNE D'UNE TABLE PAR RAPPORT A UN ID
        public function findOneById($id) {

            // requête SQL
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.id_".$this->tableName." = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        //$data = ['username' => 'Squalli', 'password' => 'dfsyfshfbzeifbqefbq', 'email' => 'sql@gmail.com'];

// FONCTION QUI AJOUTE DES DONNEES A UNE TABLE 
        public function add($data){
            // EXEMPLE: $keys = ['username' , 'password', 'email']
            $keys = array_keys($data);
            // EXEMPLE: $values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
            $values = array_values($data);
            // EXEMPLE: "username,password,email"
            $sql = "INSERT INTO ".$this->tableName."
                    (".implode(',', $keys).") 
                    VALUES
                    ('".implode("','",$values)."')";
                    //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
            /*
                INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
            */
            try {
                return DAO::insert($sql);
            }
            catch(\PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        
// FONCTION QUI SUPPRIME UN LIGNE DE DONNEES DANS UNE TABLE
        public function delete($id) {
            $sql = "DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::delete($sql, ['id' => $id]); 
        }

        private function generate($rows, $class) {
            foreach($rows as $row) {
                yield new $class($row);
            }
        }
        
// FONCTION QUI AFFICHE PLUSIEURS RESULTATS
        protected function getMultipleResults($rows, $class) {

            if(is_iterable($rows)) {
                return $this->generate($rows, $class);
            }
            else return null;
        }

        protected function getOneOrNullResult($row, $class) {

            if($row != null) {
                return new $class($row);
            }
            return false;
        }

        protected function getSingleScalarResult($row) {

            if($row != null) {
                $value = array_values($row);
                return $value[0];
            }
            return false;
        }
    
    }