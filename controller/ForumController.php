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
use Model\Managers\UserManager;

    // la classe "ForumController" va hériter à toutes les méthodes et propriétés de la classe "AbstractController"
    // l'opérateur "implement" implémente les méthodes(fonctions) de l'interface "ContollerInterface"
    class ForumController extends AbstractController implements ControllerInterface{

        
        public function index() {

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
        public function listCategories() {
             
            // variable qui relie au manager
            $categoryManager = new CategoryManager();
           

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["label","ASC"]),
                ]
            ];  
         }


// AFFICHAGE DES TOPICS PAR CATEGORIE CIBLEE
        public function listTopicsByIdCategory($id) {

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
        public function listPostsByIdTopic($id) {

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

        
// AJOUT D'UN LABEL
        public function ajoutCategory() {
            // filtres pour la sécurité du formulaire
            $label= filter_input(INPUT_POST, "label", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            //variable qui relie au manager category
            $categoryManager = new CategoryManager();
        
             // si les valeurs existent
            if($label) {
                 $newLabel=["label"=>$label];
                $categoryManager->add($newLabel);
        
                $this->redirectTo("forum","listCategories");
            }
        }
   
        
// AJOUT D'UN TOPIC
        public function ajoutTopic($id) {
            // filtres pour la sécurité du formulaire
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // renvoi à un user
            $userId = 1;
            //variable qui relie au manager TOPIC
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            // si les valeurs existent
            if($title && $text) {
                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newTopic=["title"=>$title,"category_id"=>$id, "user_id"=>$userId];
                // prend une fonction auto-intégré "lastinsertid"
                $topicId = $topicManager->add($newTopic);

                $newPost=["text"=>$text,"topic_id"=>$topicId ,"user_id"=>$userId];
                $postManager->add($newPost);

                $this->redirectTo("forum","listTopicsByIdCategory",$id);
            }   
        }


// AJOUT D'UN POST
        public function ajoutPost($id) {
            // filtres pour la sécurité du formulaire
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // renvoi à un user
            $userId=  1;
            // variable qui relie au manager POST
            $postManager = new PostManager();

            // si les valeurs existent
            if($text) {
                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newPost=["text"=>$text,"topic_id"=>$id ,"user_id"=>$userId];
                 // prend une fonction auto-intégré "lastinsertid"
                $postManager->add($newPost);

                $this->redirectTo("forum","listPostsByIdTopic",$id);
            }
        }


// EDIT D'UNE CATEGORY
        public function editCategory($id) {
            $categoryManager = new CategoryManager();
            
            // filtres pour la sécurité du formulaire
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_SPECIAL_CHARS);

            // si le label existe
            if($label) {
            
                // Utilisation de la fonction editLabel()
                $categoryManager->editLabel($id, $label);
                $this->redirectTo("forum","listCategories");
            }

            return [
                "view" => VIEW_DIR."forum/editCategory.php",
                "data" => ["category" => $categoryManager->findOneById($id)]
            ];
        }
        

// EDIT D'UN TOPIC
        public function editTopic($id) {
           $topicManager = new TopicManager();
           $topic = $topicManager->findOneById($id);

           // filtres pour la sécurité du formulaire
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($title) {
                $topicManager->editTopic($id,$title);
                $this->redirectTo("forum","listTopicsByIdCategory",$topic->getCategory()->getId());
            }

           return [
            "view" => VIEW_DIR."forum/editTopic.php",
            "data" => ["topic" => $topicManager->findOneById($id)]
            ];
        }


// POUVOIR LOCK UN TOPIC
        public function lockTopic($id) {
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            // si la session est sous le role utilisateur
            if($_SESSION['user']) {
                // on récupère le user lié au topic
                $userId = $_SESSION['user']->getId();
                // si le user du topic est le même que celui de la session alors
                if($userId==$topic->getUser()->getId()) {
                    $topicManager->lockTopic($id);
                    $this->redirectTo("forum","listTopicsByIdCategory", $topic->getCategory()->getId());
                } else {
                    Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicsByIdCategory", $topic->getCategory()->getId());
                }

            } else {
                Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicsByIdCategory", $topic->getCategory()->getId());
            }
        }
// POUVOIR UNLOCK UN TOPIC
        public function unlockTopic($id) {
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            // si la session est sous le role utilisateur
            if($_SESSION['user']) {
                // on récupère le user lié au topic
                $userId = $_SESSION['user']->getId();
                // si le user du topic est le même que celui de la session alors
                if($userId==$topic->getUser()->getId()) {
                    $topicManager->unlockTopic($id);
                    $this->redirectTo("forum","listTopicsByIdCategory", $topic->getCategory()->getId());
                } else {
                    Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicsByIdCategory", $topic->getCategory()->getId());
                }

            } else {
                Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                $this->redirectTo("forum","listTopicsByIdCategory", $topic->getCategory()->getId());
            }
        }


// EDIT D'UN POST
        public function editPost($id) {
            $postManager = new PostManager();
            $post = $postManager->findOneById($id);

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // si la session est sous le role utilisateur
            if($_SESSION['user']) {
                // on récupère le user lié au post
                $userId = $_SESSION['user']->getId();
                // si le user du post est le même que celui de la session alors
                if($userId==$post->getUser()->getId()) {
                    if($text) {
                        $postManager->editPost($id,$text);
                        $this->redirectTo("forum","listPostsByIdTopic", $post->getTopic()->getId());
                    }
                } else {
                    Session::addFlash("error","vous n'êtes pas autorisé à modifier ce message");
                    $this->redirectTo("forum","listPostsByIdTopic", $post->getTopic()->getId());
                }

            // si pas connecté à la session    
            } else {
                Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                $this->redirectTo("forum","listPostsByIdTopic", $post->getTopic()->getId());
            }

                // retourne la vue "editPost" et utilise les données affichées par la fonction findOneById() dans le formulaire
            return [
                "view" => VIEW_DIR."forum/editPost.php",
                "data" => ["post" => $postManager->findOneById($id)]
            ];
        }


// SUPPRIMER UN TOPIC
        public function deleteCategory($id) {
            $categoryManager = new CategoryManager();

            // utilisation de la fonction delete() dans App/manager
            $categoryManager->delete($id);
            $this->redirectTo("forum","listCategories");
        }


// SUPPRIMER UN TOPIC
        public function deleteTopic($id) {
            $topicManager = new TopicManager();


            // utilisation de la fonction delete() dans App/manager
            $topicManager->delete($id);
            $this->redirectTo("forum","listTopicsByIdCategory");
        }


// SUPPRIMER UN POST
        public function deletePost($id) {
            $postManager = new PostManager();

            // utilisation de la fonction delete() dans App/manager
            $postManager->delete($id);
            $this->redirectTo("forum","listPostsByIdTopic");
        }
    }
