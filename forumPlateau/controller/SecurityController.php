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
                    $this->redirectTo('home');
                } else Session::addFlash('erreur', 'EMAIL OU PSEUDO DEJA UTILISE');
            } else Session::addFlash('erreur', 'LES MDP NE CORRESPONDENT PAS');
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
                            $this->redirectTo('home');
                        } else Session::addFlash('erreur', 'Mot de passe incorrect');
                    } else Session::addFlash('erreur', 'Cet email ne correspond à aucun compte');
                } else Session::addFlash('erreur', 'Mot de passe incorrect');
            } else Session::addFlash('erreur', 'Email incorrect');
        }
        return [
            "view" => VIEW_DIR . "security/loginUtilisateurs.php"
        ];
    }

    public function logoutUtilisateurs()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = null;
            return [
                "view" => VIEW_DIR . "home.php"
            ];
        }
    }

    // profile of user connected
    public function viewProfile()
    {
        $postManager = new PostManager();
        return [
            "view" => VIEW_DIR . "forum/viewProfile.php",
            "data" => [
                "posts" => $postManager->findPostsByUserId($_GET['id'])
            ]
        ];
    }

    public function listUtilisateurs()
    {
        $user = new UtilisateurManager();

        return [
            "view" => VIEW_DIR . "forum/listUtilisateurs.php",
            "data" => [
                "user" => $user->findAll(["dateInscription", "DESC"])
            ]
        ];
    }

    public function banUsers()
    {
        if (Session::getUser()->getRole() == "admin") {
            $userManager = new UtilisateurManager();

            $userManager->update($_GET['id'], ['role' => 'ban']);
            $this->redirectTo('security', 'listUtilisateurs');
        }
    }

    public function debanUsers()
    {
        if (Session::getUser()->getRole() == "admin") {
            $userManager = new UtilisateurManager();

            $userManager->update($_GET['id'], ['role' => 'user']);
            $this->redirectTo('security', 'listUtilisateurs');
        }
    }
}
