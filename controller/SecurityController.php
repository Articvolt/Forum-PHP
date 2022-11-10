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

    // la classe "SecurityController" va hériter à toutes les méthodes et propriétés de la classe "AbstractController"
    // l'opérateur "implement" implémente les méthodes(fonctions) de l'interface "ContollerInterface"
    class SecurityController extends AbstractController implements ControllerInterface {

        public function index() {

            // variable qui relie au manager
            $userManager = new UserManager();
        }

        public function addUser() {
            // filtres pour la sécurité du formulaire
            $pseudonyme = filter_input(INPUT_POST, "pseudonyme", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            
            if($pseudonyme && $email && $password && $password2) {
                
                $userManager = new UserManager();
                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newUser=["pseudonyme"=>$pseudonyme, "email"=>$email, "password"=>$password];
                $userManager->add($newUser);
       
               $this->redirectTo("forum","listCategories");
           }
        }

    }