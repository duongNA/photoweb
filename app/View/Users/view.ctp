<div>
  <h1> User information: </h1>
  <?php echo $user['User']['username']?>
  <br>
  <?php echo "Joined date:"; echo $user['User']['created'];?>
  <?php
  if($this->Session->read('Auth.User.id')==$user['User']['id'] || $this->Session->read('Auth.User.role')=='admin')
    echo "<br>".$this->Html->link("Edit profile",array('controller'=>'users',"action"=>'edit',$user['User']['id']))."<br>";?>
  <?php
    if($this->Session->read('Auth.User.id')==$user['User']['id'] || $this->Session->read('Auth.User.role')=='admin')
      echo $this->Html->link("Change password",array('controller'=>'users',"action"=>'changepass',$user['User']['id']))."<br>";?>
  <br><br>
</div>

<div>

<h1>Albums</h1>
<?php
if($this->Session->read('Auth.User.id')===$user['User']['id'])
  echo $this->Html->link('Create new album',array('controller'=>'albums','action'=>'add'));?>
<ul>
<?php foreach ($user['Album'] as $album) :
  if($album['status'] == 1)
    echo "<li>".$this->Html->link($album['title'],array('controller'=>'albums','action'=>'view',$album['id']))."</li>";
 endforeach ?>
</ul>

<h1>All Posts</h1>
<?php
if($this->Session->read('Auth.User.id')===$user['User']['id'])
  echo $this->Html->link('Create new post',array('controller'=>'posts','action'=>'add'));?>
<ul>
  <?php foreach ($user['Post'] as $post) :
    if($post['status'] == 1)
     echo "<li>".$this->Html->link( $post['title'], array ('controller'=>'posts','action'=>'view',$post['id']))."</li>";
  endforeach?>
</ul>

<h1>Comments</h1>
<br>
<ul>
  <?php foreach ($user['Comment'] as $comment) :
    if($comment['status'] == 1)
      echo "<li>".$this->Html->link($comment['comment'],array('controller'=>'posts','action'=>'view',$comment['post_id']))."</li>";
   endforeach ?>
</ul>

</div>
