
<?php
class PostsController extends AppController{

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('browse', 'popular');

		$album = $this->Post->Album->find('list', array(
				'conditions' => array(
						'Album.status' => 1,
						'Album.user_id' => $this->Auth->user('id'))
		));

		$this->set('album', $album);
	}

	/**
	 * Handle authorization in PostsController
	 *
	 * Status: Done
	 * @param  [type]  $user [description]
	 * @return boolean       [description]
	 */
	public function isAuthorized($user) {
		// All registered users can add posts
		if ($this->action === 'add') {
			return true;
		}

		// The owner of a post can edit and delete it
		if (in_array($this->action, array('edit', 'delete'))) {
			$postId = $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			} else {
			}
			return true;
		}
		return parent::isAuthorized($user);
	}

	/**
	 * This is default action be executed when user visit website
	 * View top 10 newest post on the website
	 * Status: Done
	 * @return [type] [description]
	 */
	public function index(){
		$this->layout = "largeLayout";
		$this->paginate = array (
				'conditions' => array('Post.status' => 1),
				'limit' => 20,
				'order' => array('Post.created'=>'DESC'),
				'user_id' => $this->Auth->user('id')
		);

		$this->set('posts',$this->paginate());
	}

	/**
	 * View post detail
	 * Status: Done
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function view($id = null){
		//When no post_id is specificed then throw exception
		if(!$id){
			throw new NotFoundException(__('Invalid post'));
		}

		// Search post which is specificed with post_id
		$post=$this->Post->findById($id);

		// If no post is exists with the post_id then throw exception
		if(!$post){
			throw new NotFoundException(__('Invalid post'));
		}

		// Check post's status to make sure the post is still actived
		if($post['Post']['status']==0){
			throw new NotFoundException(__('Invalid post'));
		}

		$post['Post']['viewed']++;

		$this->Post->save($post);

		// Find all post in the same album.
		$this->set('related',$this->Post->find('all',array(
				'conditions'=>array(
						'Post.album_id'=>$post['Album']['id'],
						'Post.status'=>1),
				'limit'=>9
		))
		);


		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		//Current viewing post.
		$this->set('post',$post);

		//Posts in the same album.
		// $this->set('albumPost',);
	}

	/**
	 * Add new post if album_id is present new post will be added to the album else
	 	* new album will be created.
	 * Status: Done
	 * @param [type] $album_id [description]
	 */
	public function add($album_id=null){
		$this->loadModel('Album');
		$this->loadModel('Category');

		$this->Category->recursive = -1;
		$categoryList = $this->Category->find('list', array('fields' => array('id', 'name')));
		$this->set('categoryList', array_values($categoryList));

		if($this->request->is('post')) {

			$this->Post->create();
				
			if ($this->data['Category']['categories']) {

				$tags = explode(',',$this->data['Category']['categories']);
				debug($tags);
				foreach($tags as $_tag) {
					$_tag = strtolower(trim($_tag));
					if ($_tag) {
						// check if the tag exists
						$this->Post->Category->recursive = -1;
						$tag = $this->Post->Category->findByName($_tag);

						debug($tag);

						if ($tag) {
							// use current tag
							$this->request->data['Category']['Category'][$tag['Category']['id']] = $tag['Category']['id'];

						}
					}
				}
			}

				
			//Add post default status
			$this->request->data['Post']['status']=1;

			//Add post view count
			$this->request->data['Post']['viewed']=0;

			//Add owner of this post
			$this->request->data['Post']['user_id']=$this->Auth->user('id');

			// Add owner of this album if when user choose schema create new album
			if ($this->request->data['Post']['album_id'] == null) {

				//This one is unnecessary because Album Title is a required field.
				/*if (!$this->request->data['Album']['title']) {
					$this->request->data['Album']['title'] = 'untitle';
				}*/

				$this->request->data['Album']['user_id']=$this->Auth->user('id');

				//Add album status
				$this->request->data['Album']['status']=1;

				if($this->Post->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('Your post have been saved'));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('Unable to save post'));
				}
			} else {
				if($this->Post->save($this->request->data)){
					$this->Session->setFlash(__('Your post have been saved'));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('Unable to save post'));
				}
			}
		}
	}

	/**
	 * Edit a post in the website
	 * Status: On going
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function edit($id=null){
		//Check post_id is passed
		if(!$id) {
			$this->Session->setFlash(__('Invalid Post'));
		}

		//Find post with the passing post_id
		$post= $this->Post->findById($id);

		//Check post is exists in the database
		if(!$post) {
			throw new NotFoundException(__('Invalid Post'));
		}

		//Make sure that the post is still actived
		if($post['Post']['status'] == 0) {
			throw new NotFoundException(__('Invalid Post'));
		}

		if($this->request->is('post') || $this->request->is('put')) {

			$this->Post->id=$id;

			if($this->Post->save($this->request->data)) {

				$this->Session->setFlash(__('You post have been saved'));
				$this->redirect(array('action'=>'index'));

			} else {
				$this->Session->setFlash(__('Unable to update your post'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}

	/**
	 * When delete a post all comments related to this post are also be deleted
	 * Status: Ongoing
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete($id=null){

		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if($this->Post->Comment->updateAll(array("Comment.status"=>0),array("Comment.post_id"=> $id)) &&
				$this->Post->updateAll(array("Post.status"=>0),array("Post.id"=> $id)))
		{
			$this->Session->setFlash(__('The post have been deleted'));
			$this->redirect(array('controller'=>'posts','action'=>'index'));
		}
	}

	/**
	 * Display currently hot post in the website
	 * The rank is compared by viewed and liked
	 * Status: Done
	 * @return [type] [description]
	 */
	public function hot() {
		$this->paginate = array(
				'conditions' => array('Post.status' => 1),
				'limit' => 10,
				'order' => array (
						'Post.viewed DESC',
						'Post.liked DESC'
				)
		);

		$this->set('posts',$this->paginate());
	}

	/**
	 * Post management's page for admin
	 * @return [type] [description]
	 */
	public function manage() {
		if($this->request->data!=null){
			$search = '%'.$this->request->data['Post']['searchstring'].'%';
		} else {
			$search ='%%';
		}

		$this->paginate = array (
				'conditions' => array('Post.status' => 1),
				'limit' => 10,
				'order' => array('Post.created'=>'DESC')
		);

		$this->set('posts',$this->paginate());
	}


	public function browse($categoryId = null) {
		$this->layout = "largeLayout";
		$pagination = array(
				'conditions' => array('Post.status' => 1),
				'limit' => 20,
				'order' => array('Post.created' => 'DESC')
		);

		if ($categoryId != null) {
			$pagination['conditions'][] = array('CategoriesPosts.category_id' => $categoryId);
			$this->Post->bindModel(array('hasOne' => array('CategoriesPosts')), false);
		}

		$this->paginate = $pagination;

		$this->set('posts', $this->paginate('Post'));
	}

	public function popular() {
		$this->layout = "largeLayout";
		$pagination = array(
				'conditions' => array('Post.status' => 1),
				'limit' => 20,
				'order' => array('Post.viewed' => 'DESC')
		);

		$this->paginate = $pagination;
		$this->set('posts', $this->paginate('Post'));
	}
}
