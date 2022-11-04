<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $datePost;
        private $text;
        private $user;
        private $topic;

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

        
// GETTER DATEFORMAT DATEPOST  
        public function getDatePost(){
            $formattedDate = $this->datePost->format("d/m/Y, H:i:s");
            return $formattedDate;
        }
        
// SETTER DATEFORMAT DATEPOST
        public function setDatePost($date){
            $this->datePost = new \DateTime($date);
            return $this;
        }

// GETTER TEXT
        public function getText()
        {
            return $this->text;
        }
        
 // SETTER TEXT
        public function setText($text)
        {
                $this->text = $text;
        
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

// GETTER TOPIC
        public function getTopic()
        {
                return $this->topic;
        }
        
// SETTER TOPIC
        /**
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;
        
                return $this;
        }
}
