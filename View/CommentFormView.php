<?php

include_once 'View.php';

class CommentFormView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		echo("Industrial Craft Experimental - Wiki - Write comment");
	}

	public function printNavigation() {
		$path = base64_decode($this->model->path);
        echo($path);
        ?><li class="active">Write comment</li><?php
	}

	public function printBody() {
		global $loggedIn;
		$commentId = $this->model->commentId;
		$title = $this->model->title;
		$commentType = $this->model->commentType;
		if($loggedIn && !$this->model->banned) {
			if($this->model->reply && $this->model->confirmed) {
				?>
				<form name='replyComment' method='post' action='./index.php?page=comment'>
					<input type='hidden' name='type' value='<?php echo($commentType); ?>'/>
					<input type='hidden' name='action' value='replyComment'/>
					<input type='hidden' name='commentId' value='<?php echo($commentId); ?>'/>
					<input type='hidden' name='title' value='<?php echo($title); ?>'/>
					<textarea class="editForm" name='message' rows="6" cols="85"></textarea>
					<button class='btn btn-default' type='submit' name='save'>Reply</button>
				</form>
			<?php
			}
			if($this->model->edit) {
				$message = $this->model->message;
				?>
				<form name='editComment' method='post' action='./index.php?page=comment'>
					<input type='hidden' name='action' value='editComment'/>
					<input type='hidden' name='commentId' value='<?php echo($commentId); ?>'/>
                    <label>Title<input class="form-control" type='text' name='title' autofocus
						   value='<?php echo($title); ?>'/></label>
					<textarea class="editForm" name='message' rows="6" cols="85"><?php echo($message); ?></textarea>
					<button class='btn btn-default' type='submit' name='save'>Save</button>
				</form>
			<?php
			}
			if($this->model->add && $this->model->confirmed) {
				$type = $this->model->commentType;
				$targetId = $this->model->targetId;
				?>
				<form name='addComment' method='post' action='./index.php?page=comment'>
					<input type='hidden' name='action' value='addComment'/>
					<input type='hidden' name='targetId' value='<?php echo($targetId); ?>'/>
					<input type='hidden' name='type' value='<?php echo($type); ?>'/>
					<label>Title<input class="form-control" type='text' name='title' autofocus/></label>
					<textarea class="editForm" name='message' rows="6" cols="85"></textarea>
					<button class='btn btn-default' type='submit' name='save'>Comment</button>
				</form>
			<?php
			}
		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		echo("Write comment");
	}

}