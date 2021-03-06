<?php

abstract class View {

	protected $model;

	function __construct($model) {
		$this->model = $model;
	}

	public abstract function initialize();

	public abstract function printTitle();

	public abstract function printBody();

	public abstract function printNavigation();

	public abstract function printPageHeader();

	public function printFooter() {
		?>
		<ul>
			<li>
				<address>
					Contact: zuziiiik@gmail.com
				</address>
			</li>
			<li>Last update: 09. 04. 2014, 20:19</li>
		</ul>

	<?php
	}
}
