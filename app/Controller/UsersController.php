<?php
class UsersController extends AppController{

  /**
   * [beforeFilter description]
   * @return [type] [description]
   */
  public function beforeFilter(){

    parent::beforeFilter();

    // Pass settings in using 'all'
    // Additional conditions
//     $this->Auth->authenticate = array(
//       AuthComponent::ALL => array(
//         'scope'=>array(
//           'User.status' => 1,
//           'User.banned' => 0
//           )
//         ),
//         'Form'
//     );

    //Allow anonymous can register new account
    $this->Auth->allow('add');
  }


  public function isAuthorized($user) {
    if($this->action === 'logout') {
      return true;
    }

    // The owner of account can edit and change password
    if (in_array($this->action, array('edit', 'changepass'))) {
        $userId = $this->request->params['pass'][0];
        if ($userId == $this->Auth->user('id')) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}

  /**
   * Login functin
   * @return [type] [description]
   */
   public function login() {
   	$this->layout = 'largeLayout';
   	
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
}

  /**
   * Logout
   * @return [type] [description]
   */
  public function logout() {
  	if ($this->Connect->FB->getUser() == 0){
  		$this->redirect($this->Auth->logout());
  	}else{
  		//ditch FB data for safety
  		$this->Connect->FB->destroysession();
  		//hope its all gone with this
  		session_destroy();
  		//logout and redirect to the screen that you usually do.
  		$this->redirect($this->Auth->logout());
  	}
  }

  /**
   * List all user registered in website
   * Note: Only admin can access this action
   * @return [type] [description]
   */
  public function index(){
    $this->paginate = array(
      'conditions' => array('User.status'=>1),
      'limit' => 10
        );
    $this->set('users',$this->paginate());
  }

  /**
   * View detail information of auser.
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function view($id=null){

    $this->User->id=$id;
    //If user does not exists then throw exception
    if(!$this->User->exists()){
      throw new NotFoundException(__('Invalid user'));
    }

    // If user is exists the set it to $user variable
    $this->set('user',$this->User->read(null,$id));

  }

  /**
   * Register new account to the website
   * @param [type] $id [description]
   */
  public function add($id=null){
  	$this->layout = 'largeLayout';
  	
    if($this->request->is('post')){
      $this->User->create();

      //Add missing data on the request object before save to the database
      //Set default user role when register is: author.
      $this->request->data['User']['role']= 'author';

      // Set default user status is: 1(actived) 1(deleted)
      $this->request->data['User']['status'] = 1;

      //Set default user ban status is: 0 (actived) 1(banned)
      $this->request->data['User']['banned'] = 0;

      //If user is not submit an avatar then set avatar to default
      // if(isset($this->request->data['User']['avatar'])){
      //   $this->request->data['User']['avatar']='avatar.png';
      //   $this->request->data['User']['avatar_dir']='default';
      // }

      if($this->User->save($this->request->data)){

        $this->Session->setFlash(__('User have been saved'));
        $this->redirect(array('action'=>'login'));

      } else {
        $this->Session->setFlash(__('User cannot be saved'));
      }

    }

  }

  /**
   * Edit user profile
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function edit($id=null){

    //if id is not passed then throw new error
    if(!$id){
      $this->Session->setFlash(__('Inlvalid user'));
    }

    //find user by $id, if no user specific by $id then throw new error
    $user=$this->User->findById($id);
    if(!$user) {
      throw new NotFoundException(__('Invalid user'));
    }

    if($this->request->is('post')||$this->request->is('put')){
      $this->User->id=$id;
      if($this->User->save($this->request->data)){
        $this->Session->setFlash(__('User profile have been updated!'));
        $this->redirect(array('controller'=>'users','action'=>'view',$id));
      } else{
        $this->Session->setFlash(__('Unable to update profile'));
      }

    }

    if(!$this->request->data){
      $this->request->data=$user;
    }
  }

  /**
   * Delete user
   * Note: Only admin can access this action
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function delete($id=null){
    if($this->request->is('get')){
      throw new MethodNotAllowedException();
    }

    if( $this->User->Comment->updateAll(array("Comment.status"=>0),array("Comment.user_id"=>$id)) &&
        $this->User->Post->updateAll(array("Post.status"=>0),array("Post.user_id"=>$id)) &&
        $this->User->Album->updateAll(array("Album.status"=>0),array("Album.user_id"=>$id)) &&
        $this->User->updateAll(array("User.status"=>0),array("User.id"=>$id))
      )
    {
      $this->Session->setFlash(__('User have been deleted'));
      $this->redirect(array('controller'=>'users','action'=>'index'));
    }
  }

  /**
   * Action for user change password request
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function changepass($id=null){

  }

  /**
   * Ban user who have been reported
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function ban($id=null){
    if($this->request->is('get')){
      throw new MethodNotAllowedException();
    }

    $this->request->data['User']['id']=$id;
    $this->request->data['User']['banned']=1;
    if($this->User->save($this->request->data)) {
      $this->Session->setFlash(__('User have been banned'));
      $this->redirect(array('controller'=>'users','action'=>'index'));
    }
  }

  /**
   * Unban user who have banned
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function unban($id=null){
    if($this->request->is('get')){
      throw new MethodNotAllowedException();
    }

    $this->request->data['User']['id']=$id;
    $this->request->data['User']['banned']=0;
    if($this->User->save($this->request->data)) {
      $this->Session->setFlash(__('User have been un banned'));
      $this->redirect(array('controller'=>'users','action'=>'index'));
    }
  }

  /**
   * Manage users in the websites
   * @return [type] [description]
   */
  public function manage(){
    if($this->request->data!=null){
      $search = '%'.$this->request->data['User']['searchstring'].'%';
    } else {
      $search ='%%';
    }

    $this->paginate = array (
      'conditions' => array(
        'User.status' => 1,
        'User.role' =>'author',
        'User.username LIKE' => $search
        ),
      'limit' => 10,
      'order' => array('User.created'=>'DESC')
      );

    $this->set('users',$this->paginate());
  }
  
}
