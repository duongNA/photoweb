<?php
class PostsController extends AppController{

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
   * View all post in the website
   * @return [type] [description]
   */
  public function index(){
    $this->paginate = array (
      'conditions' => array('Post.status' => 1),
      'limit' => 2,
      'order' => array('Post.created'=>'DESC')
      );

    $this->set('posts',$this->paginate());
  }

  /**
   * View post detail
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function view($id=null){
    if(!$id){
      throw new NotFoundException(__('Invalid post'));
    }

    $post=$this->Post->findById($id);

    //When view action is called the viewed count in post is increase
    // $post['Post']['viewed'] = $post['Post']['viewed'] + 1;
    // $this->Post->save($post);

    if(!$post){
      throw new NotFoundException(__('Invalid post'));
    }
    $this->set('post',$post);
  }

  /**
   * Add new post if $album_id is present new post will be added to the album else
   * new album will be created.
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
   * [edit description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function edit($id=null){

    if(!$id) {
      $this->Session->setFlash(__('Invalid Post'));
    }

    $post= $this->Post->findById($id);

    if(!$post) {
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
   * [delete description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function delete($id=null){
    if($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }

    $this->request->data['Post']['status']=0;
    // if($this->Post->delete($id))
    if($this->Post->save($this->request->data)){
      $this->Session->setFlash(__('The post have been deleted'));
      $this->redirect(array('controller'=>'posts','action'=>'index'));
    }
  }

  /**
   * Display all hot post in the website
   * @return [type] [description]
   */
  public function hot() {
    $this->paginate = array(
      'conditions' => array('Post.status' => 1),
      'limit' => 2,
      'order' => array (
        'Post.viewed DESC',
        'Post.liked DESC'
        )
      );

    $this->set('posts',$this->paginate());
  }
}
