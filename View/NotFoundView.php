<?php

include_once 'View.php';

class NotFoundView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printNavigation() {

	}

	public function printBody() {
		?>
		<img class="error404" src="./pictures/absolutely_nothing.png">
		<a class="link" href="index.php?page=home">Go to Homepage.</a>
	<?php
	}

	public function printTitle() {
		echo("404 error");
	}

	public function printPageHeader() {
		echo("404 Error");
	}

}
