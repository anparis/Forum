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
            "view" => VIEW_DIR . "home.php",
            "data" => [
                "topics" => $topicManager->findLatestFive(["datecreation", "DESC"]),
            ]
        ];
    }

    public function listCategories($id)
    {
        $categorieManager = new CategorieManager();

        if ($id) {
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR . "forum/listTopicsByCategories.php",
                "data" => [
                    "categories" => $categorieManager->findOneById($id),
                    "topics" => $topicManager->findTopicsByCatId($id)
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

    public function listPosts($id)
    {
        $postManager = new PostManager();
        // if the id of topic is set in url
        // -> only display posts related to the topic
        if ($id) {
            $topicManager = new TopicManager();

            $post = $postManager->findPostsByTopicId($id);
            $topic = $topicManager->findOneById($id);

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
    public function listPostsByUsers($id)
    {
        $postManager = new PostManager();
        $userManager = new UtilisateurManager();

        $post = $postManager->findPostsByUserId($id);
        $user = $userManager->findOneById($id);
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

    public function addTopics($id)
    {
        if(isset($_POST['submitTopic'])){
            $idCategorie = filter_input(INPUT_POST, "idCategorie", FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $statut = filter_input(INPUT_POST, "statut", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idUser = $id;

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
                $this->redirectTo('forum','listCategories',$idCategorie);
            } 
        }
        return [
            "view" => VIEW_DIR . "forum/addTopics.php",
            "idCat" => $id
        ];
    }

    public function addPosts($id)
    {
        if(isset($_POST['submitPost'])){
            //need to add list of categories to choose from in addTopics
            $idTopic = $id;
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

    public function editPosts($id){
            $postManager = new PostManager();
            return [
                "view" => VIEW_DIR . "forum/editPosts.php",
                "data" => [
                    "post" => $postManager->findOneById($id)
                ]
            ];
    }

    public function editTopics($id){
            $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR . "forum/editTopics.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id)
                ]
            ];
    }

    //  Update db methods

    public function updatePost($id){
        if(isset($_POST['submitChangedPost'])){
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idTopic = $_POST['idTopic'];

            if($text && $idTopic){
                $postManager = new PostManager();
                $data = ['text' => $text];
                $postManager->update($id, $data);

                $this->redirectTo('forum','listPosts', $idTopic);
            }
        }
    }

    public function updateTopic($id){
        if(isset($_POST['submitChangedTopic'])){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($titre){
                $topicManager = new TopicManager();
                $data = ['titre' => $titre];
                $topicManager->update($id, $data);
                $idCat = $topicManager->findOneById($id)->getCategorie()->getId();

                $this->redirectTo('forum','listCategories', $idCat);
            }
        }
    }

    public function lockTopic($id){
            $topicManager = new TopicManager();
            $data = ['statut'=> 0];
            $idCat = $topicManager->findOneById($id)->getCategorie()->getId();

            $topicManager->update($id, $data);
            $this->redirectTo('forum','listCategories',$idCat);
    }

    public function unlockTopic($id){
            $topicManager = new TopicManager();
            $data = ['statut'=> 1];
            $idCat = $topicManager->findOneById($id)->getCategorie()->getId();

            $topicManager->update($id, $data);
            $this->redirectTo('forum','listCategories',$idCat);
    }

    //  DELETE METHOD 
    public function delPosts($id){
            $postManager = new PostManager();
            $post = $postManager->findOneById($id);
            // keep the topic id in idTopic to redirect to the good topic after deletion
            $idTopic = $post->getTopic()->getId();
            $postManager->delete($id);
        $this->redirectTo('forum','listPosts',$idTopic);
    }

    public function delTopics($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $idCat = $topicManager->findOneById($id)->getCategorie()->getId();

            // if delete topic then delete every posts from the topic
            $postManager->deletePostsByTopicId($id);
            $topicManager->delete($id);


            $this->redirectTo('forum','listCategories',$idCat);
    }
}
