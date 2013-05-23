<?php
echo $this->Form->create('Post',array('type'=>'file'));?>

<div class="select" style="display: none">
	<div id="albumList">
		<?php echo $this->Form->input('fields', array('options' => $album,'label'=>'Albums List'));?>
	</div>
	<div id="new">
		<?php echo $this->Form->button('Create new album',array('type'=>'button','class'=>'custom-button'));?>
	</div>
</div>

<div class="new">
	<?php
	echo $this->Form->input('Album.title',array('label'=>'Album title', 'class' => 'medium', 'placeholder' => 'Album title'));
	echo $this->Form->button('Add to existing',array('type'=>'button','id'=>'choose','class'=>'custom-button'));
	?>
</div>
<?php

echo $this->Form->input('Post.title', array('label'=>'Post title', 'class' => 'medium', 'placeholder' => 'Post title'));
echo $this->Form->input('Post.image',array('type'=>'file','label'=>'Choose image from your computer', 'class' => 'medium'));
?>
<div class="form-buttons">
	<?php 
	echo $this->Form->input('Category.categories', array('label' => 'Categories', 'id' => 'categories', 'class' => 'medium'));
	echo $this->Form->submit(__('Create Post'));
	echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'custom-button','id'=>'cancel'))."<br>";
	?>
</div>



<script type="text/javascript">
$('document').ready(function(){

  $('#choose').click(function(){
    $('.new').hide();
    $('#AlbumTitle').removeAttr('required');

    $('.select').show();
    $('#PostFields').attr('name','data[Post][album_id]');
  });

  $('#new').click(function(){
    $('.new').show();
    $('#AlbumTitle').attr('required','required');

    $('.select').hide();
    $('#PostFields').removeAttr('name');
  }); 

	<?php
		$js_array = json_encode($categoryList);
		echo "var jsCategoryList = ". $js_array . ";\n";
	?>

  	$( "#categories" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).data( "ui-autocomplete" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            jsCategoryList, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
	
});

	function split( val ) {
		return val.split( /,\s*/ );
	}

    function extractLast( term ) {
      return split( term ).pop();
    }

	


</script>
