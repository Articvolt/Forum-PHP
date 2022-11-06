<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $dateTopic;
        private $closed;
        private $category;
        private $user;

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

// GETTER TITLE
        public function getTitle()
        {
                return $this->title;
        }

// SETTER TITLE
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

// GETTER DATEFORMAT DATETOPIC   
        public function getDateTopic(){
            $formattedDate = $this->dateTopic->format("d/m/Y, H:i:s");
            return $formattedDate;
        }
  
// SETTER DATEFORMAT DATETOPIC
        public function setDateTopic($date){
            $this->dateTopic = new \DateTime($date);
            return $this;
        }

// GETTER CLOSED
        public function getClosed()
        {
                return $this->closed;
        }
        
// SETTER CLOSED 
        public function setClosed($closed)
        {
                $this->closed = $closed;
                
                return $this;
        }

// GETTER USER
        public function getUser()
        {
                return $this->user;
        }
        
// SETTER USER
        public function setUser($user)
        {
                $this->user = $user;
        
                return $this;
        } 

// GETTER CATEGORY
        public function getCategory()
        {
                return $this->category;
        }
        
// SETTER CATEGORY
        /**
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;
        
                return $this;
        }
        
        public function __toString()
        {
                return $this->title;
        }
}
