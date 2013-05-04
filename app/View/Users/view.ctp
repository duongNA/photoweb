

<div id="user-information">
<div class="brief">
  
  <div id="avatar"><?php echo $this->Html->image("/files/user/avatar/".$user['User']['avatar_dir']."/".$user['User']['avatar']);?></div>

  <div id="user-name"><?php echo $user['User']['username']?></div>
  <br>
  <?php echo "Joined date:"; echo $user['User']['created'];

  echo "<br>Posts: ".count($user['Post'])."<br>";
  echo "Albums: ".count($user['Album'])."<br>";

  if($this->Session->read('Auth.User.id')==$user['User']['id'] || $this->Session->read('Auth.User.role')=='admin')
    echo "<br>".$this->Html->link("Edit profile",array('controller'=>'users',"action"=>'edit',$user['User']['id']))."<br>";
    if($this->Session->read('Auth.User.id')==$user['User']['id'] || $this->Session->read('Auth.User.role')=='admin')
      {
        // echo $this->Html->link("Change password",array('controller'=>'users',"action"=>'changepass',$user['User']['id']))."<br>";
        // echo $this->Html->link("Login history",array('controller'=>'users','action'=>'history',$user['User']['id']));
      }?>
  <br><br>
</div>

<div class="content" id="tabs">
<ul>
    <li><a href="#tabs-1">Albums</a></li>
    <li><a href="#tabs-2">Posts</a></li>
</ul>

<div id="tabs-1">
<?php
if($this->Session->read('Auth.User.id')===$user['User']['id'])
  echo $this->Html->link('Create new album',array('controller'=>'albums','action'=>'add'));?>
  <div class="album">
    <ul>
    <?php foreach ($user['Album'] as $album) :
      if($album['status'] == 1)
        echo "<li>".$this->Html->link($album['title'],array('controller'=>'albums','action'=>'view',$album['id']))."</li>";
     endforeach ?>
    </ul>
  </div>
</div>

<div id="tabs-2">
  <?php
  if($this->Session->read('Auth.User.id')===$user['User']['id'])
    echo $this->Html->link('Create new post',array('controller'=>'posts','action'=>'add'));?>
  <div class="post">
    <ul>
      <?php foreach ($user['Post'] as $post) :
        if($post['status'] == 1)
         echo "<li>".$this->Html->link( $post['title'], array ('controller'=>'posts','action'=>'view',$post['id']))."</li>";
      endforeach?>
    </ul>
  </div>
</div>

</div>
</div>

<script type="text/javascript">
  $('document').ready(function(){
     $( "#tabs" ).tabs();
  });
</script>