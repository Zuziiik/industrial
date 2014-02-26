<?php

abstract class View {

    protected $model;

    function __construct($model) {
        $this->model = $model;
    }

    public abstract function initialize();

    public abstract function printTitle();

    public abstract function printBody();

    public abstract function printPageHeader();

    public function printFooter() {
//        echo <<<_END
//        <ul>
//            <li>
//              <address>
//                Contact:
//              </address>
//            </li>
//            <li>Last actualization: 5. 5. 2013, 21:00</li>
//        </ul>
//
//_END;
    }
}
