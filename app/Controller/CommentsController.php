<?php
class CommentsController extends AppController{

  public function isAuthorized($user) {
      // All registered users can add and report comment
      if (in_array($this->action, array('add','report'))) {
          return true;
      }

      // The owner of a post can edit and delete it
      if (in_array($this->action, array('edit', 'delete'))) {
          $postId = $this->request->params['pass'][0];
          if ($this->Comment->isOwnedBy($postId, $user['id'])) {
              return true;
          }
      }

    return parent::isAuthorized($user);
  }


  /**
   * List all comment in the site
   * @return [type] [description]
   */
  public function index(){
    $this->paginate= array(
      'conditions' => array('Comment.status' => 1),
      'limit' => 10,
      );

    $this->set('comments',$this->paginate());

  }

  /**
   * View specific comment detail
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function view($id=null){

  }

  /**
   * When comment is create it is saved into database then redirect to the post view
   * @param [type] $id [description]
   */
  public function add(){
    if($this->request->is('get')) {
      // throw new MethodNotAllowedException();
      $this->redirect(array('controller'=>'posts','action'=>'index'));
    }

    if($this->request->is('post'))
    {

      $this->request->data['Comment']['user_id']=$this->Auth->user('id');
      $this->request->data['Comment']['reported']=0;
      $this->request->data['Comment']['user_name']=$this->Auth->user('username');
      $this->request->data['Comment']['status']=1;
      $this->Comment->save($this->request->data);
      $this->redirect(array('controller'=>'posts','action'=>'view',$this->request->data['Comment']['post_id']));
    }
  }

  /**
   * Edit comment
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function edit($id=null){

  }

  /**
   * Delete comment
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function delete($id=null){
    if($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }

    $this->request->data['Comment']['id']=$id;
    $this->request->data['Comment']['status']=0;

    if($this->Comment->save($this->request->data)){
      $this->Session->setFlash(__('Comment have been deleted'));
      $this->redirect(array('controller'=>'posts','action'=>'index'));
    }
  }

  /**
   * When an authorized user report a comment as spam
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function report($id=null){
    if($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }

    $this->request->data['Comment']['id']=$id;
    $this->request->data['Comment']['reported'] = 1;

    if($this->Comment->save($this->request->data)){
      $this->Session->setFlash(__('Comment have been reported'));
      $this->redirect(array('controller'=>'posts','action'=>'index'));
    }
  }

  /**
   * Manage comments in the website
   * Status: Ongoing
   * @return [type] [description]
   */
  public function manage(){
    if($this->request->data!=null){
      $search = '%'.$this->request->data['Comment']['searchstring'].'%';
    } else {
      $search ='%%';
    }

    $this->paginate = array (
      'conditions' => array('Comment.status' => 1),
      'limit' => 10,
      'order' => array('Comment.created'=>'DESC')
      );

    $this->set('comments',$this->paginate());
  }
}
