<?php

include_once 'View.php';

class ProfileView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		global $loggedIn;
		global $username;
		if($loggedIn && $username == $this->model->username) {
			echo("Your Profile");
		} else {
			echo($this->model->username . " Profile");
		}
	}

	public function printNavigation() {
		global $loggedIn;
		global $username;
		if($loggedIn && $username == $this->model->username) {
			?> <a href='.'>Home</a> | Your Profile <?php
		} else {
			?> <a href='.'>Home</a> | <a href='index.php?page=users'>List Of
				Users</a> | <?php echo($this->model->username . " Profile");
		}
	}

	public function printBody() {
		global $loggedIn;
		global $username;
		if($loggedIn) {
			$id = $this->model->user->getIdUser();
			$about = $this->model->user->getAbout();
			$email = $this->model->user->getEmail();
			?>
			<div class='picture'><img src='image.php?type=user&id=<?php echo($id); ?>'></div>
			<h2>About</h2>
			<div class='frame'><?php echo($about); ?></div>
			<span class="email"><?php echo($email); ?></span>
			<?php
			if($username == $this->model->username) {
				$this->printMyProfile();
			}
		} else {
			echo($this->model->error);

		}
	}

	public function printPageHeader() {
		global $loggedIn;
		global $username;
		if($loggedIn && $username == $this->model->username) {
			echo("Your Profile");
		} else {
			echo($this->model->username . " Profile");
		}

	}

	private function printMyProfile() {
		global $username;
		if(!$this->model->edit) {
			?>
			<form name='editProfile' method='post' action='./index.php?page=profile&name=<?php echo($username); ?>'>
				<input type='hidden' name='action' value='editProfile'/>
				<button class="submitButton" type='submit' name='edit'>Edit Profile</button>
			</form>
		<?php
		} else {
			$about = $this->model->user->getAbout();
			?>
			<form name='editProfile' method='post' action='./index.php?page=profile&name=<?php echo($username); ?>'
				  enctype='multipart/form-data'>
				<input type='hidden' name='action' value='editProfile'/>
				<label>Image<input class="custom-file-input" type='file' name='image' size='14' maxlength='32'/></label>
				<textarea class="editForm" name='about' rows="4" cols="50" wrap="soft" placeholder="about"><?php echo($about); ?></textarea>
				<button class="submitButton" type='submit' name='save'>Save</button>
			</form>
		<?php
		}
		if($username == $this->model->username) {
			?>
			<h2>Change Password</h2>
			<form id="changePassword" name='changePassword' method='post'
				  action='./index.php?page=profile&name=<?php echo $username; ?>'>
				<table>
					<tr>
						<td><label for='oldPassword'>Old Password</label></td>
						<td><input  type='password' id='oldPassword' name='oldPassword'/></td>
						<td><?php echo($this->model->OldPasswordError); ?></td>
					</tr>
					<tr>
						<td><label for='password'>New Password</label></td>
						<td><input type='password' id='password' name='newPassword'/></td>
						<td><?php echo($this->model->PasswordsMatchError); ?></td>
					</tr>
					<tr>
						<td><label for='repeatPassword'>Repeat Password</label></td>
						<td><input type='password' id='repeatPassword' name='repeatPassword'/></td>
						<td></td>
					</tr>
					<tr>
						<td><button class="submitButton" type='submit' name='changePassword'>Save</button></td>
						<td></td>
						<td><?php echo($this->model->EmptyFieldsError); ?></td>
					</tr>
				</table>

			</form>
		<?php
		}
	}

}