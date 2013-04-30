<?php
App::uses('AuthComponent', 'Controller/Component','AppModel','Model');
class Post extends AppModel{
	
	/**
	 * How deep the data being traced
	 * @var integer
	 */
	// public $recursive=2;

	/**
	 * Validate post when create new Post
	 * @var array
	 */
	public $validate = array (
			'title' => array(
					'required' => array(
							'rule'=>array('notEmpty'),
							'message' => 'This field is required'
					)
			),

// 			'Album.title' => array(
// 					'required' => array(
// 							'rule'=> array('notEmpty'),
// 							'message' => 'This field is required'
// 					)
// 			)
	);

	/**
	 * Create upload behaviour for Post model
	 * @var array
	 */
	public $actsAs =array (
			'Upload.Upload'=> array (
					'image'=> array(
							'fields'=> array (
									'dir' => 'image_dir',
							)
					)
			),
			'Containable'
	);

	/**
	 * Declare model association
	 * @var array
	 */
	public $hasMany = array (

			'Comment' => array (
					'className' => 'Comment',
					'foreignKey' => 'post_id'
			)
	);

	public $belongsTo = array (
			'PostOwner' => array (
					'className' => 'User',
					'foreignKey' => 'user_id'
			),
			'Album' => array (
					'className' => 'Album',
					'foreignKey' => 'album_id'
			)
	);
	
	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'categories_posts',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'category_id'	
		), 
	);

	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
	}
}
