

<div id="user-information">
<div class="brief">
  
  <div id="avatar"><?php echo $this->Html->image("/files/user/avatar/".$userTmp['User']['avatar_dir']."/".$userTmp['User']['avatar']);?></div>

  <div id="user-name"><?php echo $userTmp['User']['username']?></div>
  
  <div class="info">
    <?php  echo "Joined date: "; echo $userTmp['User']['created'];?>
  </div>
  <div class="info">
    <?php  echo "Posts: ".count($userTmp['Post'])."<br>";?>
  </div>
  <div class="info">
    <?php  echo "Albums: ".count($userTmp['Album'])."<br>";?>
  </div>
  <?php
  if($this->Session->read('Auth.User.id')==$userTmp['User']['id'] || $this->Session->read('Auth.User.role')=='admin')
    echo "<br>".$this->Html->link("Edit profile",array('controller'=>'users',"action"=>'edit',$userTmp['User']['id']))."<br>";
    if($this->Session->read('Auth.User.id')==$userTmp['User']['id'] || $this->Session->read('Auth.User.role')=='admin')
      {
        // echo $this->Html->link("Change password",array('controller'=>'users',"action"=>'changepass',$userTmp['User']['id']))."<br>";
        // echo $this->Html->link("Login history",array('controller'=>'users','action'=>'history',$userTmp['User']['id']));
      }?>
  <br><br>
</div>

<div class="content" id="tabs">
<ul>
    <li><a href="#tabs-1">Albums</a></li>
    <li><a href="#tabs-2">Posts</a></li>
</ul>

<div id="tabs-1">
  <div class="album">
    <ul>
    <?php foreach ($userTmp['Album'] as $album) :
      if($album['status'] == 1)
        echo "<li>".$this->Html->link($album['title'],array('controller'=>'albums','action'=>'view',$album['id']))."</li>";
     endforeach ?>
    </ul>
  </div>
</div>

<div id="tabs-2">
  <?php
  if($this->Session->read('Auth.User.id')===$userTmp['User']['id'])
    echo $this->Html->link('Create new post',array('controller'=>'posts','action'=>'add'));?>
  <div class="post">
    <ul>
      <?php foreach ($userTmp['Post'] as $post) :?>
        <?php if($post['status'] == 1): ?>
        	 <li>
        	 	<?php echo $this->Html->link( $post['title'], array ('controller'=>'posts','action'=>'view',$post['id'])) ?>
       	 	</li>
      	<?php endif;?>
      <?php endforeach;?>
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