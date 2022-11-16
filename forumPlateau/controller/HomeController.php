<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UtilisateurManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
            $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR . "home.php",
                "data" => [
                    "topics" => $topicManager->findLatestFive(["datecreation", "DESC"]),
                ]
            ];
        }
            
   
        public function users(){
            $this->restrictTo("user");

            $manager = new UtilisateurManager();
            $users = $manager->findAll(['dateInscription', 'DESC']);

            return [
                "view" => VIEW_DIR."security/utilisateur.php",
                "data" => [
                    "utilisateur" => $users
                ]
            ];
        }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
