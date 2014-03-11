<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';

class HomeControl extends Control {
    
    function __construct($model) {
        parent::__construct($model);
    }

    
    public function initialize() {
        $type = EditableArea::NEWS;
        if(isset($_POST['deleteNews'])){
            $id = (int)sanitizeString($_POST['id']);
            $this->delete($id);
        }
        $this->model->news = EditableAreaDAO::selectByEditableAreaType($type);
    }

    private function delete($id){
        if(EditableAreaDAO::editableAreaExists($id)){
            $news = EditableAreaDAO::selectById($id);
            $comments = CommentDAO::selectByTypeAndTarget(Comment::NEWS, $id);
            foreach($comments as $comment){
                $commentId = (int)$comment->getIdComment();
                $this->deleteComment($commentId);
            }
            EditableAreaDAO::delete($news);
        }
    }

    private function deleteComment($id) {
        $comments = CommentDAO::selectByTypeAndTarget(Comment::RE, $id);
        foreach ($comments as $comment) {
            CommentDAO::delete($comment);
        }
        $news = CommentDAO::selectById($id);
        CommentDAO::delete($news);
    }

}
