<?php
class Comment extends AppModel {

  // public $validates = array (
  //   'comment' => array (
  //     'required' => array(
  //       'rule'=>array('notEmpty'),
  //       'message' => 'This field is required'
  //       )
  //     )
  //   );

  /**
   * Declare model association
   * @var array
   */
  public $belongsTo = array (

    'CommentOwner' => array (
      'className' => 'User',
      'foreignKey' => 'user_id'
      ),

    'CommentOn' => array (
      'className' => 'Post',
      'foreignKey' => 'post_id'
      )
    );

  public function isOwnedBy($comment, $user) {
    return $this->field('id', array('id' => $comment, 'user_id' => $user)) === $comment;
  }
}
