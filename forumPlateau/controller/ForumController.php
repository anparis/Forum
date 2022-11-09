<?php

namespace Controller;

use App\Session;
use App\DAO;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategorieManager;
use Model\Managers\UtilisateurManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {

        $topicManager = new TopicManager();
        $categorieManager = new CategorieManager();
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["datecreation", "DESC"]),
            ]
        ];
    }

    public function listCategories()
    {

        $categorieManager = new CategorieManager();

        if (isset($_GET['id'])) {
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR . "forum/listTopicsByCategories.php",
                "data" => [
                    "categories" => $categorieManager->findOneById($_GET['id']),
                    "topics" => $topicManager->findTopicsById($_GET['id'])
                ]
            ];
        } else {
            return [
                "view" => VIEW_DIR . "forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nom", "ASC"])
                ]
            ];
        }
    }

    public function listPosts()
    {
        $postManager = new PostManager();
        // if the id of topic is set in url
        // -> only display posts related to the topic
        if (isset($_GET['id'])) {
            $topicManager = new TopicManager();

            $post = $postManager->findPostsByTopicId($_GET['id']);
            $topic = $topicManager->findOneById($_GET['id']);

            return [
                "view" => VIEW_DIR . "forum/listPostsByTopics.php",
                "data" => [
                    "posts" => $post,
                    "topics" => $topic
                ]
            ];
        } else {
            return [
                "view" => VIEW_DIR . "forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->findAll(["datePost", "ASC"]),
                ]
            ];
        }
    }

    // List posts by user
    public function listPostsByUsers()
    {
        $postManager = new PostManager();
        $userManager = new UtilisateurManager();

        $post = $postManager->findPostsByUserId($_GET['id']);
        $user = $userManager->findOneById($_GET['id']);
        return [
            "view" => VIEW_DIR . "forum/listPostsByUtilisateurs.php",
            "data" => [
                "posts" => $post,
                "users" => $user
            ]
        ];
    }

    /* 
             Add functions
    */

    public function addCategories()
    {
        if(isset($_POST['submitCategorie'])){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($nom){
                $categorieManager = new CategorieManager();
                $categorieManager->add(["nom"=>$nom]);
                header('Location: index.php?ctrl=forum&action=listCategories');
                die;
            }
        }
        return [
            "view" => VIEW_DIR . "forum/addCategories.php",
        ];
    }

    public function addTopics()
    {
        if(isset($_POST['submitTopic'])){
            //need to add list of categories to choose from in addTopics
            $idCategorie = 2;
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $statut = filter_input(INPUT_POST, "statut", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idUser = 1;

            if($idCategorie && $text && $titre && $statut && $idUser){
                $topicManager = new TopicManager();
                // Array preparation to inject data in DB with add function
                $topicData = [
                    "titre" => $titre,
                    "statut" => (int) $statut,
                    "categorie_id" => $idCategorie,
                    "utilisateur_id" => $idUser
                ];
                //add function return last insert id
                $lastIdTopicInsert = $topicManager->add($topicData);

                $postManager = new PostManager;
                $postData = [
                    "text" => $text,
                    "topic_id" =>  $lastIdTopicInsert,
                    "utilisateur_id" => $idUser
                ];
                $postManager->add($postData);
                header('Location: index.php?ctrl=forum&action=listTopics');
            } 
        }
        return [
            "view" => VIEW_DIR . "forum/addTopics.php",
        ];
    }

    public function addPosts()
    {
        if(isset($_POST['submitPost'])){
            //need to add list of categories to choose from in addTopics
            $idTopic = $_GET['id'];
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idUser = 1;

            if($idTopic && $text && $idUser){
                $postManager = new PostManager();
                // Array preparation to inject data in DB with add function
                $postData = [
                    "text" => $text,
                    "topic_id" => $idTopic,
                    "utilisateur_id" => $idUser
                ];
                $postManager->add($postData);
                
                header('Location: index.php?ctrl=forum&action=listPosts&id='.$idTopic);
            }
            
        }
        return [
            "view" => VIEW_DIR . "forum/listPostsByTopics.php",
        ];
    }
}
