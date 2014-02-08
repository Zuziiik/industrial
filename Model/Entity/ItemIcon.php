<?php

class ItemIcon {

    /** @var int */
    protected $itemId;

    /** @var blog */
    protected $image;

    function __construct($itemId, blog $image) {
        $this->itemId = $itemId;
        $this->image = $image;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage(blog $image) {
        $this->image = $image;
    }

}
