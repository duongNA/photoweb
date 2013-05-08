<?php
class AlbumsController extends AppController{

  public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $albumId = $this->request->params['pass'][0];
        if ($this->Album->isOwnedBy($albumId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
  }

  /**
   * [index description]
   * @return [type] [description]
   */
  public function index(){
  	$albums = $this->Album->find('all');
	$this->set('albums', $albums);
  }

  /**
   * [view description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function view($id=null){
    if(!$id){
      throw new NotFoundException(__('Invalid album'));
    }

    $album = $this->Album->findById($id);

    if(!$album){
      throw new NotFoundException(__('Invalid album'));
    }

    $this->set('album',$album);

  }

  /**
   * [add description]
   * @param [type] $id [description]
   */
  public function add(){
    //AnhDN. 5/5/2013 cannot add album seperately
    if($this->request->is('get')) {
      throw new MethodNotAllowedEception();
    }

    if($this->request->is('post')) {
      $this->Album->create();

      $this->request->data['Album']['status']=1;

      $this->request->data['Album']['user_id']=$this->Auth->user('id');

      if($this->Album->save($this->request->data)){
        $this->Session->setFlash(__('Album is created'));

        $this->redirect(array('controller'=>'posts','action'=>'index'));
      } else {
        $this->Session->setFlash(__('Cannot create album'));
      }
    }
  }

  /**
   * [edit description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function edit($id=null){
    //if no parameter is passing throw exception
    if(!$id) {
      throw new NotFoundException(__('Invalid album'));
    }

    //if no album with $id throw exception
    $album=$this->Album->findById($id);
    if(!$album) {
      throw new NotFoundException(__('Invalid album'));
    }

    if($this->request->is('post')|| $this->request->is('put')) {
      $this->Album->id=$id;
      if($this->Album->save($this->request->data)) {
        $this->Session->setFlash(__('This album have been updated'));
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash(__('Unable to update your album'));
      }
    }

    if(!$this->request->data) {
       $this->request->data = $album;
    }
  }

  /**
   * When a delete album request is send, first delete all related photos (set photo status to 0, after that set album status to 0)
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function delete($id=null){
    if($this->request->is('get')) {
      throw new MethodNotAllowedEception();
    }

    if($this->Album->IncludePost->updateAll(array("IncludePost.status"=>0),array("IncludePost.album_id"=>$id)) &&
      $this->Album->updateAll(array("Album.status"=>0),array("Album.id"=>$id)) ) {

      $this->Session->setFlash(__('Your albums and all its related photo have been deleted'));
      $this->redirect(array('controller'=>'posts','action'=>'index'));
    }
  }

  /**
   * Manage album in the website
   * @return [type] [description]
   */
  public function manage(){
    if($this->request->data!=null){
      $search = '%'.$this->request->data['Album']['searchstring'].'%';
    } else {
      $search ='%%';
    }
    
    $this->paginate = array (
      'conditions' => array('Album.status' => 1),
      'limit' => 10,
      'order' => array('Album.created'=>'DESC')
      );

    $this->set('albums',$this->paginate());
  }
}
