<?php

include_once 'View.php';

class LoginView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printNavigation() {
		?> <a href='.'>Home</a> | Login <?php
	}

	public function printBody() {
		global $loggedIn;
		echo($this->model->error);
		?>
		<div class='login'>
		<?php
		if(!$loggedIn) {
			?>
			<form name='login' method='post' action='./index.php?page=login'>
				<table>
					<tr>
						<td>
							<label for='username'>Username</label>
						</td>
						<td>
							<input autofocus id='username' name='user' value='<?php echo($this->model->user); ?>'
								   type='text'/>
						</td>
						<td>
							<?php echo($this->model->usernameError); ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for='pass'>Password</label>
						</td>
						<td>
							<input id='password' name='pass' type='password'/>
						</td>
						<td>
							<?php echo($this->model->passwordError); ?>
						</td>
					</tr>
					<tr>
						<td>
							<input type='hidden' name='action' value='login'/>
						</td>
						<td>
							<button class="submitButton" type='submit' name='submit'>Submit</button>
						</td>
						<td>
							<?php echo($this->model->fieldsError); ?>
						</td>
					</tr>
				</table>
			</form>
		<?php
		} else {

		}
		echo("</div>");
	}

	public function printTitle() {
		echo("Login");
	}

	public function printPageHeader() {
		echo("Login");
	}

}
