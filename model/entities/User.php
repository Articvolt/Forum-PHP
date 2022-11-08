<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudonyme;
        private $email;
        private $password;
        private $dateCreate;
        private $role;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
// GETTER ID
        public function getId()
        {
                return $this->id;
        }

// SETTER ID
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

// GETTER PSEUDONYME
        public function getPseudonyme()
        {
                return $this->pseudonyme;
        }

// SETTER PSEUDONYME
        public function setPseudonyme($pseudonyme)
        {
                $this->pseudonyme = $pseudonyme;

                return $this;
        }
        
// GETTER EMAIL
        public function getEmail()
        {
                return $this->email;
        }
    
// SETTER EMAIL
        public function setEmail($email)
        {
                $this->email = $email;
                
                return $this;
        }

// GETTER PASSWORD
public function getPassword()
        {
            return $this->password;
        }
        
// SETTER PASSWORD
        public function setPassword($password)
        {
            $this->password = $password;
            
            return $this;
        } 
        
// GETTER DATEFORMAT DATECREATE   
        public function getDateCreate(){
            $formattedDate = $this->dateCreate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }
          
// SETTER DATEFORMAT DATECREATE
        public function setDateTopic($date){
            $this->dateCreate = new \DateTime($date);
            return $this;
        }

// GETTER ROLE
        public function getRole()
        {
            return $this->role;
        }
        
// SETTER ROLE
/**
 * @return  self
 */ 
        public function setRole($role)
        {
            $this->role = $role;
            
            return $this;
        }
    }
