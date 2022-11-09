<?php
    // NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Controller;

    //relie à APP qui automatise le forum
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;

    // relie à tout les controllers
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    // la classe "ForumController" va hériter à toutes les méthodes et propriétés de la classe "AbstractController"
    // l'opérateur "implement" implémente les méthodes(fonctions) de l'interface "ContollerInterface"
    class ForumController extends AbstractController implements ControllerInterface{

        
        public function index(){

            // variable qui relie au manager
            $topicManager = new TopicManager();

             return [
                 "view" => VIEW_DIR."forum/listTopics.php",
                 "data" => [
                     "topics" => $topicManager->findAll(["dateTopic", "DESC"]),
                 ]
             ];
        
        }

        
// AFFICHAGE DES CATEGORIES
        public function listCategories(){
             
            // variable qui relie au manager
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["label","ASC"])
                ]
            ];  
         }


// AFFICHAGE DES TOPICS PAR CATEGORIE CIBLEE
        public function listTopicsByIdCategory($id){

            // variable qui relie au manager
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsByIdCategory.php",
                "data" => [
                    "topics" => $topicManager->getTopicsByIdCategory($id),
                    "category" => $categoryManager->findOneById($id)
                ]
            ];  
        }

    
// AFFICHAGE DES POSTS PAR TOPIC CIBLEE
        public function listPostsByIdTopic($id){

            // variable qui relie au manager
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            // renvoie 
            return [
                "view" => VIEW_DIR."forum/listPostsByIdTopic.php",
                "data" => [
                    "posts" => $postManager->getPostsByIdTopic($id),
                    "topic" => $topicManager->findOneById($id)
                ]
            ];  
        }
        
// AJOUT D'UN TOPIC
        public function ajoutTopic($id) {
            // filtres pour la sécurité du formulaire
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // renvoi à un user fixe (temporaire)
            $userId= 1;
            //variable qui relie au manager TOPIC
            $topicManager = new TopicManager();
            // // connection au manager POST
            // $postManager = new PostManager();

            // si les valeurs existent 
            if($title && $text) {
                // var_dump("ok");die;
                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newTopic=["title"=>$title,"category_id"=>$id, "user_id"=>$userId];
                $topicManager->add($newTopic);

                $this->redirectTo("forum","listTopicsByIdCategory",$id);
            //    // $data déclarée pour être utilisée dans la fonction add($data) dans manager
            //     $newPost=["text"=>$text, "topic_id"=>$newTopicId, "user_id"=>$userId];       
            }   

        }
    }