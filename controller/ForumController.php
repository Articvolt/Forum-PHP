<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    // la classe "ForumController" va hériter à toutes les méthodes et proprriétés de la classe "AbstractController"
    // l'opérateur "implement" implémente les méthodes(fonctions) de l'interface "ContollerInterface"
    class ForumController extends AbstractController implements ControllerInterface{

        
        public function index(){

            return [
                "view" => VIEW_DIR."forum/listCategories.php"
            ];
        
        }

// AFFICHAGE DES CATEGORIES
        public function listCategories(){
                
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll()
                ]
            ];  
         }

// AFFICHAGE DES TOPICS PAR CATEGORIE CIBLEE
        public function listTopicsByIdCategory($id){
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

    

// AFFICHAGE DES TOPICS PAR CATEGORIE CIBLEE
        public function listPostsByIdTopic($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listPostsByIdTopic.php",
                "data" => [
                    "posts" => $postManager->getPostsByIdTopic($id),
                    "topic" => $topicManager->findOneById($id)
                ]
            ];  
        }
}


