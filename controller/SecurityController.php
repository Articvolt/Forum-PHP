<?php
    // NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Controller;

    //relie à APP qui automatise le forum
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;

    // relie à tout les controllers
    use Model\Managers\UserManager;

    // la classe "SecurityController" va hériter à toutes les méthodes et propriétés de la classe "AbstractController"
    // l'opérateur "implement" implémente les méthodes(fonctions) de l'interface "ContollerInterface"
    class SecurityController extends AbstractController implements ControllerInterface {

        public function index() {

        }

// FONCTION QUI AJOUTE UN UTILISATEUR
        public function addUser() {
            // filtres pour la sécurité du formulaire
            $pseudonyme = filter_input(INPUT_POST, "pseudonyme", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // si les valeurs existent : 
            if($pseudonyme && $email && $password && $password2) {
                
                // relie au manager User
                $userManager = new UserManager();
                // hashage du mot de passe
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                $newUser=["pseudonyme"=>$pseudonyme, "email"=>$email, "password"=>$passwordHash];
                // on vérifie si le premier mot de passe et le second mot de passe sont identiques
                if($password == $password2) {
                    // execution de la fonction pré-implemté add($data)
                    $userManager->add($newUser);                  
                }
           }
           // retourne la vue de connexion des utilisateurs
           return ["view" => VIEW_DIR."./security/login.php"];
        }


// FONCTION QUI CONNECTE A L'UTILISATEUR
        public function login() {
            // si il y a des valeurs non nulles
            if(isset($_POST['submit'])) {
                // filtres pour la sécurité du formulaire
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                // filtrer un mot de passe peux donner à certains mot de passe une modification lors du filtre et donc le rendre erroné
                $password = $_POST["password"];
                // si les valeurs existent : 
                if($email && $password) {
                    // relie au manager User
                    $userManager = new UserManager();
                    
                    // relie le mot de passe à une adresse mail
                    $getPassword = $userManager->getPasswordUser($email);
                    // relie le mail à l'utilisateur
                    $getUser = $userManager->getUser($email);
                    
                    // comparaison (hashage) du mot de passe de la BDD et celui du formulaire
                    $checkPassword = password_verify($password, $getPassword['password']);
 
                    // si le code est bon
                    if($checkPassword){
                        // connection à la sesion de l'utilisateur
                        Session::setUser($getUser);
                        // redirige à la page d'accueil
                        // $this->redirectTo('home');
                    }
                }
            }
            // renvoie à la page de connexion si le formulaire est vide
            return [
                "view" => VIEW_DIR . "security/login.php"
            ];
        }

    }