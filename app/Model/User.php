<?php
App::uses('AuthComponent', 'Controller/Component','AppModel','Model');
class User extends AppModel{
	// status: 0(deleted),1(active)
	// role: admin, author


	/**
	 * Create upload behaviour for Post model
	 * @var array
	 */
	public $actsAs =array (
			'Upload.Upload'=> array (
					'avatar'=> array(
							'fields'=> array (
									'dir' => 'avatar_dir',
							),
							'thumbnailSizes' => array(
									'xvga' => '1024x768',
									'vga' => '640x480',
									'thumb' => '80x80'
							)
					)
						


			)
	);

	/**
	 * Validate data before saved
	 * @var array
	 */
	public $validate = array (

			'username' => array (
					'required' => array (
							'rule' => array ('notEmpty'),
							'message' => 'An username is required'
					)
			),

			'password' => array (
					'required' => array (
							'rule' => array ('notEmpty'),
							'message' => 'A password is required'
					)
			),

			'email' =>array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'An email is required'
					),
					'email'
			),
				
			'gender' => array(
					'valid' => array(
							'rule' => array('inList', array('male', 'female')),
							'message' => 'Please choose a valid gender',
							'allowEmpty' => false
					)
			)
	);

	/**
	 * Hashing password before save to the database
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function beforeSave($options=array()) {

		if(isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		return true;
	}

	/**
	 * Declare model association
	 * @var array
	 */
	public $hasMany = array (

			'Album' => array (
					'className' => 'Album',
					'foreignKey' => 'user_id'
			),

			'Comment' => array (
					'className' => 'Comment',
					'foreignKey' => 'user_id'
			),

			'Post' => array (
					'className' => 'Post',
					'foreignKey' => 'user_id'
			)
	);
}
