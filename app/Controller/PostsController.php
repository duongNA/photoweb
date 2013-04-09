
<?php
class PostsController extends AppController{

  /**
   * Handle authorization in PostsController
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
        }
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
    $this->paginate = array (
      'conditions' => array('Post.status' => 1),
      'limit' => 10,
      'order' => array('Post.created'=>'DESC')
      );

    $this->set('posts',$this->paginate());
  }

  /**
   * View post detail
   * Status: Done
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function view($id=null){
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

    $this->set('post',$post);
  }

  /**
   * Add new post if album_id is present new post will be added to the album else
   * new album will be created.
   * Status: On going
   * @param [type] $album_id [description]
   */
  public function add($album_id=null){

    if($this->request->is('post')) {

      $this->Post->create();

      //Add post default status
      $this->request->data['Post']['status']=1;

      //Add post like count
      $this->request->data['Post']['liked']=0;

      //Add post view count
      $this->request->data['Post']['viewed']=0;

      //Add owner of this post
      $this->request->data['Post']['user_id']=$this->Auth->user('id');

      // Add owner of this album
      $this->request->data['Album']['user_id']=$this->Auth->user('id');

      //Add album status
      $this->request->data['Album']['status']=1;

      // if($this->Post->save($this->request->data)){
      if($this->Post->saveAssociated($this->request->data)) {
        $this->Session->setFlash(__('Your post have been saved'));
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash(__('Unable to save post'));
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
      throw new NotFoundEXception(__('Invalid Post'));
    }

    //Make sure that the post is still actived
    if($post['Post']['status']==0) {
     throw new NotFoundEXception(__('Invalid Post'));
    }

    if($this->request->is('post')||$this->request->is('put')) {

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

    // $this->request->data['Post']['status']=0;
    // $this->request->data['Comment']['status']=0;
    // if($this->Post->delete($id))
    // if($this->Post->save($this->request->data)){
    // if($this->Post->saveAssociated($this->request->data)){
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

  /**
   * Like action
   * Status: Ongoing
   * @return [type] [description]
   */
  public function like() {

  }

  /**
   * Unlike action
   * Status: Ongoing
   * @return [type] [description]
   */
  public function unlike() {

  }
}
