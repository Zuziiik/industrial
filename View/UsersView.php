<?php

include_once 'View.php';

class UsersView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		echo("List Of Users");
	}

	public function printNavigation() {
		?> <a href='.'>Home</a> | List Of Users <?php
	}

	public function printBody() {
		global $loggedIn;
		global $admin;
		if($loggedIn && $admin) {
			foreach ($this->model->users as $user) {
				$username = $user->getUsername();
				$email = $user->getEmail();
				$create = $user->getCreateTime();
				$login = $user->getlastLogin();
				$id = $user->getIdUser();
				?>
				<div class="user">
					<div class='userInfo'>Username: <?php echo($username); ?> </br>
						Email: <?php echo($email); ?>  </br>
						Create Time:  <?php echo($create); ?> </br>
						Last Login:  <?php echo($login); ?> </br></div>
					<form class='changeAdmin' name='changeAdmin' method='post' action='./index.php?page=users'>
						<input type='hidden' name='action' value='changeAdmin'/>
						<input type='hidden' name='id' value='<?php echo($id); ?>'/>
						<?php
						if($user->getAdmin()) {
							?>
							<span class='adminStatus'>admin</span>
							<button class='submitButton' type='submit' name='submit'>Make User</button>
						<?php
						} else {
							?>
							<span class='userStatus'>user</span>

							<button class='submitButton' type='submit' name='submit'>Make Admin</button>
						<?php
						}
						?>
					</form>
					</br>
					<?php
					if(!$user->getAdmin()) {
						?>
						<form class='banUser' name='banUser' method='post' action='./index.php?page=users'>
							<input type='hidden' name='action' value='banUser'/>
							<input type='hidden' name='id' value='<?php echo($id); ?>'/>
							<label for='days'>Days:</label>
							<input type='text' id='days' name='days' value='3'/>
							<button class='submitButton' type='submit' name='submit'>Ban User</button>
						</form>
						<?php
						?>
						<form class='unbanUser' name='unbanUser' method='post' action='./index.php?page=users'>
							<input type='hidden' name='action' value='unbanUser'/>
							<input type='hidden' name='id' value='<?php echo($id); ?>'/>
							<button class='submitButton' type='submit' name='submit'>Unban User</button>
						</form>
					<?php
					}
					if($user->getConfirmed()) {
						?>
						<span class='confirmed'>confirmed</span>
					<?php
					} else {
						?>
						<span class='unconfirmed'>confirmed</span>
						<?php
						$id = $user->getIdUser();
						?>
						<form class='confirm' name='confirm' method='post' action='./index.php?page=users'>
							<input type='hidden' name='action' value='confirm'/>
							<input type='hidden' name='id' value='<?php echo $id; ?>'/>
							<button class="submitButton" type='submit' name='confirm'>Confirm</button>
						</form>
					<?php

					}
					?>
				</div>
			<?php
			}
			?>
			<span id='bans'>Bans:</span>
			<div class='bans'>
				<?php
				$this->printBans();
				?>
			</div>
			<?php
			echo($this->model->error);
			echo($this->model->msg);
		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		echo("List Of Users");
	}

	private function printBans() {
		foreach ($this->model->users as $user) {
			foreach ($this->model->bans as $ban) {
				$userId = $user->getIdUser();
				$banUserId = $ban->getUserId();
				if($userId === $banUserId) {
					$name = $user->getUsername();
					$start = $ban->getBanStart();
					$end = $ban->getBanEnd();
					?>
					<div class='ban'>Username:  <?php echo($name); ?>
						</br>Ban Start:  <?php echo($start); ?>
						</br>Ban End:  <?php echo($end); ?>
					</div>");
				<?php
				}
			}
		}
	}

}