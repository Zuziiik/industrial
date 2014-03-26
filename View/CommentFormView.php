<?php

include_once 'View.php';

class CommentFormView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		echo("Write comment");
	}

	public function printNavigation() {
		$path = base64_decode($this->model->path);
		echo($path . " | Write comment");
	}

	public function printBody() {
		$commentTd = $this->model->commentId;
		$title = $this->model->title;
		$commentType = $this->model->commentType;
		if($this->model->reply) {
			?>
			<form id='editForm' name='replyComment' method='post' action='./index.php?page=comment'>
				<input type='hidden' name='type' value='<?php echo $commentType; ?>'/>
				<input type='hidden' name='action' value='replyComment'/>
				<input type='hidden' name='commentId' value='<?php echo $commentTd; ?>'/>
				<input type='hidden' name='title' value='<?php echo $title; ?>'/>
				<textarea name='message' rows="6" cols="85"></textarea>
				<input class='save' type='submit' name='save' value='Reply'/>
			</form>
		<?php
		}
		if($this->model->edit) {
			$message = $this->model->message;
			?>
			<form id='editForm' name='editComment' method='post' action='./index.php?page=comment'>
				<input type='hidden' name='action' value='editComment'/>
				<input type='hidden' name='commentId' value='<?php echo $commentTd; ?>'/>
				<input id='title' type='text' placeholder="Title" name='title' autofocus value='<?php echo $title; ?>'/>
				<textarea name='message' rows="6" cols="85"><?php echo $message; ?></textarea>
				<input class='save' type='submit' name='save' value='Save'/>
			</form>
		<?php
		}
		if($this->model->add) {
			$type = $this->model->commentType;
			$targetId = $this->model->targetId;
			?>
			<form id='AddForm' name='addComment' method='post' action='./index.php?page=comment'>
				<input type='hidden' name='action' value='addComment'/>
				<input type='hidden' name='targetId' value='<?php echo $targetId; ?>'/>
				<input type='hidden' name='type' value='<?php echo $type; ?>'/>
				<input id='title' type='text' placeholder="Title" name='title' autofocus/>
				<textarea class="AddForm" name='message' rows="6" cols="85"></textarea>
				<input class='save' type='submit' name='save' value='Comment'/>
			</form>
		<?php
		}
	}

	public function printPageHeader() {
		echo("Write comment");
	}

}