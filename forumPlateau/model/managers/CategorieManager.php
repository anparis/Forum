<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\CategorieManager;

    class CategorieManager extends Manager{

        protected $className = "Model\Entities\Categorie";
        protected $tableName = "categorie";


        public function __construct(){
            parent::connect();
        }

        public function addCategories(){
            if(isset($_POST['submitCategorie'])){
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->add(["nom"=>$nom]);
                header('Location: index.php?ctrl=forum&action=listCategories');
            }
            
        }

    }