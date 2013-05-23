<?php
App::uses('AuthComponent', 'Controller/Component','AppModel','Model');
class Album extends AppModel {

	public $validate = array (
			'title' => array(
					'required' => array(
							'rule'=>array('notEmpty'),
							'message' => 'This field is required'
					)
			)
	);

	/**
	 * Declare model assoction
	 * @var array
	 */
	public $hasMany = array (
			'IncludePost' => array (
					'className' => 'Post',
					'foreignKey' => 'album_id',
					'conditions' => array(
						'IncludePost.status' => 1		 
					)
			));
			

	public $belongsTo = array (
			'User' => array (
					'className' => 'User',
					'foreignKey' => 'user_id'
			)
	);

	public function isOwnedBy($album, $user) {
		return $this->field('id', array('id' => $album, 'user_id' => $user)) === $album;
	}
}
