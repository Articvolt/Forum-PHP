<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        
        public function index(){

            return [
                "view" => VIEW_DIR."forum/listCategories.php"
            ];
        
        }

        public function listCategories(){
                
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll()
                ]
            ];  
         }

        public function listTopicsByIdCategory($id){
            $topicManager = new TopicManager();


            return [
                "view" => VIEW_DIR."forum/listTopicsByIdCategory.php",
                "data" => [
                    "topics" => $topicManager->findOneById($id)
                ]
            ];  
        }
    }
