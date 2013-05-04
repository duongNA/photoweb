<div class="post-add-form">
<?php
echo $this->Form->create('Post',array('type'=>'file'));?>

<div class="select" style="display:none">
<div  id="albumList">
  <?php echo $this->Form->input('fields', array('options' => $album));?>
</div>
<div id="new">
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
    $('.new').hide();
    /*$('#AlbumTitle').hide();
    $('#choose').hide();*/
    $('#AlbumTitle').removeAttr('required');

    $('.select').show();
    $('#PostFields').attr('name','data[Post][album_id]');
    /*$('#new').show();
    $('#albumList').show();*/
    
  });

  $('#new').click(function(){
    $('.new').show();
    /*$('#AlbumTitle').show();
    $('#choose').show();*/
    $('#AlbumTitle').attr('required','required');

    $('.select').hide();
    $('#PostFields').removeAttr('name')
    /*$('#albumList').hide();
    $('#new').hide();*/
  });
});
</script>