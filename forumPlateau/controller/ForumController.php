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
        $categorieManager = new CategorieManager();
        $categorieManager->addCategories();
        return [
            "view" => VIEW_DIR . "forum/addCategories.php",
        ];
    }

    public function addTopics()
    {
        $topicManager = new TopicManager();
        $topicManager->addTopics();
        return [
            "view" => VIEW_DIR . "forum/addTopics.php",
        ];
    }

    // public function addPosts()
    // {
    //     $postManager = new PostManager();
    //     $postManager->addPosts();
    //     return [
    //         "view" => VIEW_DIR . "forum/listPostsByTopics.php",
    //     ];
    // }
}
