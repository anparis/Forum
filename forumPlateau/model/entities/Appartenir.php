<?php

namespace Model\Entities;

use App\Entity;

final class Appartenir extends Entity
{
    private $topic;
    private $categorie;

    public function getTopicId()
        {
                return $this->topic;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setTopicId($id)
        {
                $this->topic = $id;

                return $this;
        }

        public function getCategorieId()
        {
                return $this->categorie;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setCategorieId($id)
        {
                $this->categorie = $id;

                return $this;
        }
    }