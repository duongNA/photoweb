<div class="post-add-form">
<?php
echo $this->Form->create('Post',array('type'=>'file'));?>

<div class="select">
<div style="display:none" id="albumList">
  <?php echo $this->Form->input('field', array('options' => $album));?>
</div>
<div style="display:none" id="new">
  <?php echo $this->Form->button('Create new album',array('type'=>'button'));?>
</div>
</div>

<div class="new">
  <?php
    echo $this->Form->input('Album.title',array('label'=>'Album title'));
    echo $this->Form->button('Add to existing',array('type'=>'button','id'=>'choose'));  
  ?>
</div>
<?php

  echo $this->Form->input('Post.title', array('label'=>'Post title'));
  echo $this->Form->input('Post.image',array('type'=>'file','label'=>'Choose image from your computer'));
?>

<?php 
  echo $this->Form->submit(__('Create Post'));
  echo $this->Form->button('Cancel',array('type'=>'reset'))."<br>";
?>
</div>


<script type="text/javascript">
$('document').ready(function(){
  
  $('#choose').click(function(){
    $('#AlbumTitle').hide();
    $('#new').show();
    $('#albumList').show();
    $('#choose').hide();
  });

  $('#new').click(function(){
    $('#AlbumTitle').show();
    $('#choose').show();
    $('#albumList').hide();
    $('#new').hide();
  });
});
</script>