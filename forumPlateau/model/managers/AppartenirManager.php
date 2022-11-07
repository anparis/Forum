<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\CategorieManager;

    class AppartenirManager extends Manager{

        protected $className = "Model\Entities\Appartenir";
        protected $tableName = "appartenir";


        public function __construct(){
            parent::connect();
        }
    }