<?php
    // NAMESPACE : permet de grouper et d'identifier un ensemble d'éléments logiques par un programme.
    namespace Controller;

    //relie à APP qui automatise le forum
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use App\DAO;

    // relie à tout les controllers
    use Model\Managers\UserManager;
    use Model\Managers\PostManager;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;

    // la classe "SecurityController" va hériter à toutes les méthodes et propriétés de la classe "AbstractController"
    // l'opérateur "implement" implémente les méthodes(fonctions) de l'interface "ContollerInterface"
    class SecurityController extends AbstractController implements ControllerInterface {

        public function index() {

        }


// FONCTION QUI AJOUTE UN UTILISATEUR
        public function addUser() {

            // si des valeurs dans le formulaire 
            if (isset($_POST['register'])) {
                // filtres pour la sécurité du formulaire
                $pseudonyme = filter_input(INPUT_POST, "pseudonyme", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                // pas de filtre sur un mot de passe choisi par l'utilisateur
                $password = $_POST['password'];
                $password2 =  $_POST['password2'];

                // si les valeurs existent et que les deux mots de passes sont identiques : 
                if($pseudonyme && $email && $password && $password2 && ($password == $password2)) {
                    
                    // relie au manager User
                    $userManager = new UserManager();

                    // vérifie si un mail ou un pseudonyme est deja dans la base de données
                    $checkPseudonyme = $userManager->checkPseudonyme($pseudonyme);
                    $checkEmail = $userManager->checkEmail($email);

                    // Si il n'y a pas de pseudonyme ou d'email existant
                    if (!$checkPseudonyme && !$checkEmail) {
                        
                        // hashage du mot de passe
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        // $data déclarée pour être utilisée dans la fonction add($data) dans manager
                        $newUser=[
                            "pseudonyme"=>$pseudonyme,
                            "email"=>$email,
                            "password"=>$passwordHash
                        ];
                        
                        // execution de la fonction pré-implemté add($data)
                        $userManager->add($newUser); 
                        Session::addFlash('success', 'vous êtes bien enregistré !');
                        // redirige vers la page d'accueil
                        $this->redirectTo('home');  

                    // message d'erreur si un mail ou le pseudonyme existe déjà
                    } else Session::addFlash('error', 'utilisateur ou mail déjà enregistré');

                // message d'erreur si les mots de passe ne sont pas identiques
                } else Session::addFlash('error', 'les mots de passe ne sont pas identiques');
                
            // retourne la vue de connexion des utilisateurs
            } return ["view" => VIEW_DIR. "security/register.php"];
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
                if($email) {
                    if($password) {
                        // relie au manager User
                        $userManager = new UserManager();
                        
                        // relie le mot de passe à une adresse mail
                        $getPassword = $userManager->getPasswordUser($email);
                        // relie le mail à l'utilisateur
                        $getUser = $userManager->getUser($email);
                        
                        // si il y a un utilisateur
                        if($getUser) {
                            // comparaison (hashage) du mot de passe de la BDD et celui du formulaire
                            $checkPassword = password_verify($password, $getPassword['password']);
         
                            // si le code est bon
                            if($checkPassword){
                                // connection à la session de l'utilisateur
                                Session::setUser($getUser);
                                Session::addFlash('success', 'Bienvenue');
                                $this->redirectTo('home');

                            // message d'erreur si les mots de passe ne sont pas identiques
                            } else Session::addFlash('error', 'Mot de passe incorrect');
                        
                        // message d'erreur si il n'y a pas de compte lié
                        } else Session::addFlash('error', 'Aucun compte pour cet Email');
                    
                    // message d'erreur si le mot de passe n'est pas correct
                    } else Session::addFlash('error', 'Mot de passe incorrect');
                
                // message d'erreur si le mail n'a pas de comptes
                } else Session::addFlash('error', 'Email incorrect');
                
            }
            // renvoie à la page de connexion si le formulaire est vide
            return ["view" => VIEW_DIR . "security/login.php"];
        }

    }