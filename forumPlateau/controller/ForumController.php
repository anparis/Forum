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
use PDO;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $topicManager = new TopicManager();
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
                $this->redirectTo('forum','listCategories');
            }
        }
        return [
            "view" => VIEW_DIR . "forum/addCategories.php",
        ];
    }

    public function addTopics()
    {
        $categorieManager = new CategorieManager();
        
        if(isset($_POST['submitTopic'])){
            $idCategorie = filter_input(INPUT_POST, "idCategorie", FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $statut = filter_input(INPUT_POST, "statut", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idUser = $_GET['id'];

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
                $this->redirectTo('forum','listTopics');
            } 
        }
        return [
            "view" => VIEW_DIR . "forum/addTopics.php",
            "data" => [
                "categories" => $categorieManager->findAll(["nom", "ASC"])
            ]
        ];
    }

    public function addPosts()
    {
        if(isset($_POST['submitPost'])){
            //need to add list of categories to choose from in addTopics
            $idTopic = $_GET['id'];
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idUser = Session::getUser()->getId();

            if($idTopic && $text && $idUser){
                $postManager = new PostManager();
                // Array preparation to inject data in DB with add function
                $postData = [
                    "text" => $text,
                    "topic_id" => $idTopic,
                    "utilisateur_id" => $idUser
                ];
                $postManager->add($postData);
                $this->redirectTo('forum','listPosts',$idTopic);
            }
            
        }
        return [
            "view" => VIEW_DIR . "forum/listPostsByTopics.php",
        ];
    }

    //  Edition methods

    public function editPosts(){
        if(isset($_GET['id'])){
            $postManager = new PostManager();
            return [
                "view" => VIEW_DIR . "forum/editPosts.php",
                "data" => [
                    "post" => $postManager->findOneById($_GET['id'])
                ]
            ];
        }
        else
            return [
                "view" => VIEW_DIR . "forum/editPosts.php",
            ];
    }

    public function editTopics(){
        if(isset($_GET['id'])){
            $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR . "forum/editTopics.php",
                "data" => [
                    "topic" => $topicManager->findOneById($_GET['id'])
                ]
            ];
        }
        else
            return [
                "view" => VIEW_DIR . "forum/editTopics.php",
            ];
    }

    //  Update db methods

    public function updatePost(){
        if(isset($_GET['id']) && isset($_POST['submitChangedPost'])){
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idTopic = $_POST['idTopic'];

            if($text && $idTopic){
                $postManager = new PostManager();
                $data = ['text' => $text];
                $postManager->update($_GET['id'], $data);
                $this->redirectTo('forum','listPosts', $idTopic);
            }
        }
    }

    public function updateTopic(){
        if(isset($_GET['id']) && isset($_POST['submitChangedTopic'])){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($titre){
                $topicManager = new TopicManager();
                $data = ['titre' => $titre];
                $topicManager->update($_GET['id'], $data);
                $this->redirectTo('forum','listPosts', $_GET['id']);
            }
        }
    }

    public function lockTopic(){
        if(isset($_GET['id'])){
            $topicManager = new TopicManager();
            $data = ['statut'=> 0];
            $topicManager->update($_GET['id'], $data);
        }
        $this->redirectTo('forum','listTopics');
    }

    public function unlockTopic(){
        if(isset($_GET['id'])){
            $topicManager = new TopicManager();
            $data = ['statut'=> 1];
            $topicManager->update($_GET['id'], $data);
        }
        $this->redirectTo('forum','listTopics');
    }

    //  DELETE METHOD 
    public function delPosts(){
        if(isset($_GET['id'])){
            $postManager = new PostManager();
            $post = $postManager->findOneById($_GET['id']);
            // keep the topic id in idTopic to redirect to the good topic after deletion
            $idTopic = $post->getTopic()->getId();
            $postManager->delete($_GET['id']);
        }
        $this->redirectTo('forum','listPosts',$idTopic);
    }

    public function delTopics(){
        if(isset($_GET['id'])){
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            // if delete topic then delete every posts from the topic
            $postManager->deletePostsByTopicId($_GET['id']);
            $topicManager->delete($_GET['id']);

        }
        $this->redirectTo('forum','listTopics');
    }
}
