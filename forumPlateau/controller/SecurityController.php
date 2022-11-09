<?php

    namespace Controller;

    use App\Session;
    use App\DAO;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\AppartenirManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UtilisateurManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        public function addUtilisateurs(){
            if(isset($_POST['submitUser'])){
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
                $mdp = $_POST['mdp'];
                $mdp2 = $_POST['mdp2'];
                // need to manage USER_ADMIN
                $role = "user";
                
                if($pseudo && $email && $mdp && $mdp2 && ($mdp == $mdp2) && (strlen($mdp)>8)){
                    //sql query to check if email or password already exists in my DB
                    $userManager = new UtilisateurManager();
                    
                    // return null if dont find
                    $checkPseudo = $userManager->checkPseudo($pseudo);
                    $checkEmail = $userManager->checkEmail($email);
                    if($checkPseudo==NULL && $checkEmail==NULL){
                        // hash of password
                        $mdpHash = password_hash($mdp,PASSWORD_DEFAULT);
                        // Array preparation to inject data in DB with add function
                        $userData = [
                            "email" => $email,
                            "pseudo" => $pseudo,
                            "mdp" => $mdpHash,
                            "role" => $role
                        ];

                        $userManager->add($userData);
                        $this->redirectTo('home');
                    }
                    else
                        echo "email ou pseudo déjà utilisé";
                }
                else
                    echo "Une erreur est survenu";
            }
            return [
                "view" => VIEW_DIR . "security/addUtilisateurs.php"
            ];
        }

        public function loginUtilisateurs(){
            if(isset($_POST['submitLogin'])){
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
                $mdp = $_POST['mdp'];

                if($email && $mdp)
                {
                    $userManager = new UtilisateurManager();

                    $getMdp = $userManager->getMdpByEmail($email);
                    $getUser = $userManager->getUserByEmail($email);
                    // password_verify return true if corresponding
                    $isMdp = password_verify($mdp, $getMdp['mdp']);

                    if($isMdp){
                        Session::setUser($getUser);
                        $this->redirectTo('home');
                    }
                }
            }
            return [
                "view" => VIEW_DIR . "security/loginUtilisateurs.php"
            ];
        }

        public function logoutUtilisateurs(){
            $_SESSION['user']=null;
            return[
                "view" => VIEW_DIR . "home.php"
            ];
        }
    }
