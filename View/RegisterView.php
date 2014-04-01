<?php

include_once 'View.php';

class RegisterView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printNavigation() {
		?> <a href='.'>Home</a> | Register <?php
	}

	public function printBody() {
		global $loggedIn;
		if(!$loggedIn) {
			echo($this->model->error);
			?>
			<form name='login' method='post' action='./index.php?page=register'>
				<table>
					<tr>
						<td>
							<label for='name'>Username:</label>
						</td>
						<td>
							<input id='username' name='user' value='
<?php
							echo($this->model->user);
							?>
' type='text' autofocus/>
						</td>
						<td>
							<?php
							echo($this->model->errorUser);
							?>
						</td>
					</tr>
					<tr>
						<td>
							<label for='mail'>Email:</label>
						</td>
						<td>
							<input id='mail' name='mail' value='
<?php
							echo($this->model->email);
							?>
' type='text'/>
						</td>
						<td>
							<?php
							echo($this->model->errorEmail . "  " . $this->model->errorEmailFormat);
							?>
						</td>
					</tr>
					<tr>
						<td>
							<label for='password'>Password:</label>
						</td>
						<td>
							<input id='password' name='password' type='password'/>
						</td>
						<td>
							<?php
							echo($this->model->errorPass);
							?>
						</td>
					</tr>
					<tr>
						<td>
							<label for='repeatPassword'>Repeat Password:</label>
						</td>
						<td>
							<input id='repeatPassword' name='repeatPassword' type='password'/>
						</td>
					</tr>
					<tr>
						<td>

						</td>
						<td>
							<button class="submitButton" type='submit' name='submit'>Submit</button>
						</td>
					</tr>
				</table>
			</form>
			<?php
			echo($this->model->msg);
		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		echo("Register");
	}

	public function printTitle() {
		echo("Register");
	}

}
