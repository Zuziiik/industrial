<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class TutorialListControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		$type = EditableArea::TUTORIAL;
		if(isset($_POST['deleteTutorial'])) {
			global $admin;
			global $loggedIn;
			if($admin && $loggedIn) {
				$id = (int)sanitizeString($_POST['id']);
				$this->delete($id);
			}
		}
		$this->model->tutorials = EditableAreaDAO::selectByEditableAreaType($type);
	}

	private function delete($id) {
		if(EditableAreaDAO::editableAreaExists($id)) {
			$tutorial = EditableAreaDAO::selectById($id);
			$comments = CommentDAO::selectByTypeAndTarget(Comment::TUTORIAL, $id);
			foreach ($comments as $comment) {
				$commentId = (int)$comment->getIdComment();
				$this->deleteComment($commentId);
			}
			EditableAreaDAO::delete($tutorial);
		}
	}

	private function deleteComment($id) {
		$comments = CommentDAO::selectByTypeAndTarget(Comment::RE, $id);
		foreach ($comments as $comment) {
			CommentDAO::delete($comment);
		}
		$tutorial = CommentDAO::selectById($id);
		CommentDAO::delete($tutorial);
	}

}