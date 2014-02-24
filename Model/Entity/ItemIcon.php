<?php

class ItemIcon {

    /** @var int */
    protected $itemId;

    /** @var blob */
    protected $image;

    /**
     * @param int  $itemId
     * @param blob $image
     */
    function __construct($itemId, $image) {
        $this->itemId = $itemId;
        $this->image = $image;
    }

    /**
     * @param $itemId
     */
    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    /**
     * @return int
     */
    public function getItemId() {
        return $this->itemId;
    }

    /**
     * @return blob
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image) {
        $this->image = $image;
    }

}
