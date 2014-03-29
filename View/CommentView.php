<?php

include_once 'View.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class CommentView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
	}

	public function printTitle() {

	}

	public function printNavigation() {
		// 	TODO: Implement printNavigation() method.
	}

	public function printBody() {
		if($this->model->comments) {
			echo("<div class='comments'>");
			$this->printComment($this->model->comments, 0);
			echo("</div>");
		}

	}

	function setPath($path) {
		$this->model->path = $path;
	}

	public function printComment($comments) {
		global $username;
		global $admin;
		global $loggedIn;
		foreach ($comments as $comment) {
			$id = $comment->getIdComment();
			$title = $comment->getTitle();
			$message = $comment->getMessage();
			$userId = (int)$comment->getUserId();
			$user = UserDAO::selectById($userId);
			$commentUsername = $user->getUsername();
			$type = $comment->getType();
			if($type == Comment::RE) {
				echo("<div class='reComment'>");
			} else {
				echo("<div class='comment'>");
			}
			echo("<h3>$title</h3>");
			echo("<span class='commentUser'> User: $commentUsername</span>");
			echo("<span class='commentMessage'> Message: $message</span>");

			if($loggedIn && ($admin || $commentUsername == $username)) {
				?>
				<form class='deleteComment' name='deleteComment' method='post' action='./index.php?page=servers'>
					<input type='hidden' name='action' value='deleteComment'/>
					<input type='hidden' name='commentId' value='<?php echo ($id); ?>'/>
					<button class='deleteButton' type='submit' name='deleteComment' >Delete Comment</button>
				</form>
			<?php
			}
			if($loggedIn && $commentUsername == $username) {
				?>
				<form class='editComment' name='editComment' method='post' action='./index.php?page=comment'>
					<input type='hidden' name='action' value='editComment'/>
					<input type='hidden' name='path' value='<?php echo ($this->model->path); ?>'/>
					<input type='hidden' name='title' value='<?php echo ($title); ?>'/>
					<input type='hidden' name='message' value='<?php echo ($message); ?>'/>
					<input type='hidden' name='commentId' value='<?php echo ($id); ?>'/>
					<button class='editButton' type='submit' name='editComment' >Edit Comment</button>
				</form>
			<?php
			}

			if($loggedIn) {
				$commentType = Comment::RE;
				?>
				<form class='replyComment' name='replyComment' method='post' action='./index.php?page=comment'>
					<input type='hidden' name='type' value='<?php echo ($commentType); ?>'/>
					<input type='hidden' name='path' value='<?php echo ($this->model->path); ?>'/>
					<input type='hidden' name='action' value='replyComment'/>
					<input type='hidden' name='title' value='<?php echo ($title); ?>'/>
					<input type='hidden' name='commentId' value='<?php echo $id; ?>'/>
					<button class='replyButton' type='submit' name='replyComment' >Reply</button>
				</form>
			<?php
			}

			$reComments = $comment->getComments();
			echo("<span class='reComment'>" . $this->printComment($reComments) . "</span>");
			echo("</div>");
		}

	}

	public function printPageHeader() {

	}

}