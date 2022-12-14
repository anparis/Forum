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

class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()
    {
    }

    public function addUtilisateurs()
    {
        if (isset($_POST['submitUser'])) {
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
            $mdp = $_POST['mdp'];
            $mdp2 = $_POST['mdp2'];
            // need to manage USER_ADMIN
            $role = "user";

            if ($pseudo && $email && $mdp && $mdp2 && ($mdp == $mdp2) && (strlen($mdp) > 8)) {
                //sql query to check if email or password already exists in my DB
                $userManager = new UtilisateurManager();

                // return null if dont find
                $checkPseudo = $userManager->checkPseudo($pseudo);
                $checkEmail = $userManager->checkEmail($email);
                if ($checkPseudo == NULL && $checkEmail == NULL) {
                    // hash of password
                    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
                    // Array preparation to inject data in DB with add function
                    $userData = [
                        "email" => $email,
                        "pseudo" => $pseudo,
                        "mdp" => $mdpHash,
                        "role" => $role
                    ];

                    $userManager->add($userData);
                    Session::addFlash('success', 'Votre compte a été crée');
                    $this->redirectTo('home');
                } else Session::addFlash('error', 'EMAIL OU PSEUDO DEJA UTILISE');
            } else Session::addFlash('error', 'LES MDP NE CORRESPONDENT PAS');
        }
        return [
            "view" => VIEW_DIR . "security/addUtilisateurs.php"
        ];
    }

    public function loginUtilisateurs()
    {
        if (isset($_POST['submitLogin'])) {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
            $mdp = $_POST['mdp'];
            if ($email) {
                if ($mdp) {
                    $userManager = new UtilisateurManager();

                    $getMdp = $userManager->getMdpByEmail($email);
                    $getUser = $userManager->getUserByEmail($email);

                    if ($getUser) {
                        // password_verify return true if corresponding
                        if (password_verify($mdp, $getMdp['mdp'])) {
                            Session::setUser($getUser);
                            Session::addFlash('success', 'Bienvenue');
                            $this->redirectTo('forum','listTopics');
                        } else 
                            Session::addFlash('error', 'Mot de passe incorrect');
                    } else 
                        Session::addFlash('error', 'Cet email ne correspond à aucun compte');
                } else 
                    Session::addFlash('error', 'Mot de passe incorrect');
            } else 
                Session::addFlash('error', 'Email incorrect');
        }
        return [
            "view" => VIEW_DIR . "security/loginUtilisateurs.php"
        ];
    }

    public function logoutUtilisateurs()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = null;
            Session::addFlash('success', 'Vous avez été déconnecté');
            return [
                "view" => VIEW_DIR . "forum/listCategories.php"
            ];
        }
    }

    // profile of user connected
    public function viewProfile($id)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $userManager = new UtilisateurManager();
        return [
            "view" => VIEW_DIR . "security/viewProfile.php",
            "data" => [
                "posts" => $postManager->findPostsByUserId($id),
                "topics" => $topicManager->findTopicsByUserId($id),
                "user" => $userManager->findOneById($id)
            ]
        ];
    }

    public function listUtilisateurs()
    {
        $user = new UtilisateurManager();

        return [
            "view" => VIEW_DIR . "security/listUtilisateurs.php",
            "data" => [
                "user" => $user->findAll(["dateInscription", "DESC"])
            ]
        ];
    }

    public function banUsers($id)
    {
        if (Session::getUser()->getRole() == "admin") {
            $userManager = new UtilisateurManager();

            $userManager->update($id, ['ban' => 1]);
            $this->redirectTo('security', 'listUtilisateurs');
        }
    }

    public function debanUsers()
    {
        if (Session::getUser()->getRole() == "admin") {
            $userManager = new UtilisateurManager();

            $userManager->update($_GET['id'], ['ban' => 0]);
            $this->redirectTo('security', 'listUtilisateurs');
        }
    }

    public function fileUpload($id){
        if(is_uploaded_file($_FILES['img']['tmp_name'])){
            $idUser = (int) filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
            
            $tmpName = $_FILES['img']['tmp_name'];
            $img_name = $_FILES['img']['name'];
            $img_size = $_FILES['img']['size'];
            // si error = 0 alors il n'y a aucune erreur
            $error = $_FILES['img']['error'];
            // gestion extensions
            $tabExtension = explode('.', $img_name);
            $extension = strtolower(end($tabExtension));
            // extension que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            // gestion taille
            $tailleMax = 400000;

            //si mon extension est accepte alors je place l'img dans le dossier upload
            if (in_array($extension, $extensions) && $img_size <= $tailleMax && $error == 0 && $idUser) {
                // gestion noms de fichier unique
                $uniqueName = uniqid('',true);
                $file = $uniqueName.".".$extension;
                move_uploaded_file($tmpName, 'public/img/' . $file);
                $path = 'public/img/' . $file;
                $userManager = new UtilisateurManager();
                $data = ["avatar"=>$path];
                $userManager->update($idUser,$data);
                Session::addFlash('success', 'Votre avatar a été changé');
                $postManager = new PostManager();
                $topicManager = new TopicManager();
                return [
                    "view" => VIEW_DIR . "security/viewProfile.php",
                    "data" => [
                        "posts" => $postManager->findPostsByUserId($id),
                        "topics" => $topicManager->findTopicsByUserId($id),
                        "user" => $userManager->findOneById($id)
                    ]
                ];
            } else {
                Session::addFlash('error', 'Votre image est trop grande ou ne possède pas la bonne extension');
            }
        }
    }

    public function deleteAvatar($id){
        $userManager = new UtilisateurManager();
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $avatarPath = $userManager->findOneById($id)->getAvatar();
        unlink($avatarPath);

        
        $data = ["avatar"=>'./public/img/default-avatar.png'];
        $userManager->update($id,$data);
        return [
            "view" => VIEW_DIR . "security/viewProfile.php",
            "data" => [
                "posts" => $postManager->findPostsByUserId($id),
                "topics" => $topicManager->findTopicsByUserId($id),
                "user" => $userManager->findOneById($id)
            ]
        ];
    }
    
}
