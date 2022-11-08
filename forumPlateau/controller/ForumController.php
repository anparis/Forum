<?php

    namespace Controller;

    use App\Session;
    use App\DAO;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\AppartenirManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["datecreation", "DESC"]),
                ]
            ];
        }

        public function listCategories(){

            $categorieManager = new CategorieManager();
            
            if(isset($_GET['id'])){
                $topicManager = new TopicManager();

                return [
                    "view" => VIEW_DIR."forum/listTopicsByCategories.php",
                    "data" => [
                        "categories" => $categorieManager->findOneById($_GET['id']),
                        "topics" => $topicManager->findTopicsById($_GET['id'])
                    ]
                ];
            }
            else{
                return [
                    "view" => VIEW_DIR."forum/listCategories.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom","ASC"])
                    ]
                ];
            }
         
         }

         public function listPosts(){
            $postManager = new PostManager();
            // if the id of topic is set in url
            // -> only display posts related to the topic
            if(isset($_GET['id'])){
                $topicManager = new TopicManager();

                $post = $postManager->findPostsById($_GET['id']);
                $topic = $topicManager->findOneById($_GET['id']);

                return [
                    "view" => VIEW_DIR."forum/listPostsByTopics.php",
                    "data" => [
                        "posts" => $post,
                        "topics" => $topic
                    ]
                ];
            }
            else{

                return [
                    "view" => VIEW_DIR."forum/listPosts.php",
                    "data" => [
                        "posts" => $postManager->findAll(["datePost","ASC"]),
                    ]
                ];
            }
         }

         //debug => permet d'ajouter dans la BDD
         public function listAppartenir(){
            $appartenirManager = new AppartenirManager();
            die;
            
         }

         public function addCategories(){
            $categorieManager = new CategorieManager();
            $categorieManager->addCategories();
            return [
                "view" => VIEW_DIR."forum/addCategories.php",
            ];
         }


    }
