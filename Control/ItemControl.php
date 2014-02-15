<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';

class ItemControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        if (isset($_GET['item'])) {
            var_dump($_GET['item']);
            $name=sanitizeString($_GET['item']);
            if(ItemDAO::exists($name)){
                $this->model->item = ItemDAO::selectByName($name);
            }else{
          //      header('Location: ./index.php?page=404');
            }
            
        }
    }

}
