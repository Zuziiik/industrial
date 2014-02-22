<?php

class ItemIcon {

    /** @var int */
    protected $itemId;

    /** @var blob */
    protected $image;

    /**
     * 
     * @param int $itemId
     * @param blob $image
     */
    function __construct($itemId, $image) {
        $this->itemId = $itemId;
        $this->image = $image;
    }

    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

}
