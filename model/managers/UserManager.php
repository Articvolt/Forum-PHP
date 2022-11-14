<?php
// NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

// LA CLASSE "USERMANAGER" VA HERITER DE TOUTE LES METHODES DE LA CLASSE "MANAGER"
    class UserManager extends Manager{

        // PROTECTED : permet d'utiliser les attributs et méthodes(fonctions) d'une classe parent.

        // relie à la classe située dans le chemin désignée.
        protected $className = "Model\Entities\User";
        // relie au nom de la table dans la base de donnée.
        protected $tableName = "user";

        // constuct structuré par la classe parent "MANAGER" et connecté à la base de donnée.
        public function __construct() {
            parent::connect();
        }

// FONCTION QUI VERIFIE SI LE PSEUDONYME ECRIT EST DEJA DANS LA BASE DE DONNEES
        public function checkPseudonyme($pseudonyme){
            $sql = "
                SELECT pseudonyme 
                FROM user
                WHERE pseudonyme = :pseudonyme
                ";
            return(DAO::select($sql,['pseudonyme' => $pseudonyme]));
        }
  

// FONCTION QUI VERIFIE SI L'EMAIL ECRIT EST DEJA DANS LA BASE DE DONNEES
        public function checkEmail($email){
            $sql = "
                SELECT email 
                FROM user 
                WHERE email = :email
            ";
            return(DAO::select($sql,['email' => $email]));
        }


// FONCTION SELECTIONNE LE PASSWORD EN FONCTION DU MAIL DONNE
        public function getPasswordUser($email){
            $sql = "
                SELECT password 
                FROM ".$this->tableName." 
                WHERE email = :email
            ";
            return($this->getSingleScalarResult(DAO::select($sql,['email' => $email])));
        }

  
// FONCTION SELECTIONNE L'UTILISATEUR EN FONCTION DU MAIL DONNE
        public function getUser($email){
            $sql = "
                SELECT * 
                FROM ".$this->tableName." 
                WHERE email = :email
            ";
            return($this->getOneOrNullResult(DAO::select($sql,['email' => $email],false),$this->className));
            
        }
    }