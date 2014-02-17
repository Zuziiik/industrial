<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemIconDAO.php';

class EditableAreaControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        if (isset($_GET['item'])) {
            $itemId = (int) sanitizeString($_GET['item']);
            $this->model->item = ItemDAO::selectById($itemId);
            if (isset($_POST['areaId'])) {
                $areaId = (int) sanitizeString($_POST['areaId']);
                $this->model->area = EditableAreaDAO::selectById($areaId);
                $this->editArea($areaId);
            }
            if (isset($_POST['action']) && $_POST['action'] == 'editItem') {
                $this->edit();
            }
        }
    }

    private function editArea($areaId) {
        if (isset($_POST['save'])) {
            $title = sanitizeString($_POST['title']);
            $text = sanitizeString($_POST['text']);
            $area = EditableAreaDAO::selectById($areaId);
            $area->setTitle($title);
            $area->setText($text);
            $this->model->msg = "Title updated to " . $title . "</br>Text updated to " . $text;
            EditableAreaDAO::update($area);
        }
    }

    private function edit() {
        if (isset($_POST['save'])) {
            $name = sanitizeString($_POST['name']);
            $details = sanitizeString($_POST['details']);
            $itemId = (int) sanitizeString($_GET['item']);

            if (isset($_FILES['image']['name'])) {

                $saveto = "$itemId.png";
                move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
                $this->updateImage($saveto, $itemId);
            }
            $item = ItemDAO::selectById($itemId);
            $item->setName($name);
            $item->setDetails($details);
            ItemDAO::update($item);
            $this->model->msg = "Item " . $name . " saved.";
        }
    }

    private function updateImage($saveto, $itemId) {
        $typeok = TRUE;

        switch ($_FILES['image']['type']) {
            case "image/gif": $src = imagecreatefromgif($saveto);
                break;
            case "image/jpeg":  // Both regular and progressive jpegs
            case "image/pjpeg": $src = imagecreatefromjpeg($saveto);
                break;
            case "image/png": $src = imagecreatefrompng($saveto);
                break;
            default: $typeok = FALSE;
                break;
        }
        
        if ($typeok) {

            $saveto = $this->resizeImage($saveto, $src);

            $content = addslashes(file_get_contents($saveto));

            ItemIconDAO::set(new ItemIcon($itemId, $content));

            unlink($saveto);
        }
    }

    private function resizeImage($saveto, $src) {
        list($w, $h) = getimagesize($saveto);

        $max = 100;
        $tw = $w;
        $th = $h;

        if ($w > $h && $max < $w) {
            $th = $max / $w * $h;
            $tw = $max;
        } elseif ($h > $w && $max < $h) {
            $tw = $max / $h * $w;
            $th = $max;
        } elseif ($max < $w) {
            $tw = $th = $max;
        }

        $tmp = imagecreatetruecolor($tw, $th);
        imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));
        imagealphablending($tmp, false);
        imagesavealpha($tmp, true);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagepng($tmp, $saveto, 9);
        imagedestroy($tmp);
        imagedestroy($src);
        return $saveto;
    }

}
