<?php 

namespace pro\repositories\CommentRepository;

use Comment;

class CommentRepositoryDb implements CommentRepositoryInterface {

	public function create($params){
		$comment = Comment::create($params);
		return $comment;  
	}
} 