<script type="text/javascript">
    $('input[type=file]').change(function(e) {
        if(typeof FileReader == "undefined") return true;

        var elem = $(this);
        var files = e.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (f.type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        var image = e.target.result;
                        previewDiv = $('.file-preview');
                        bg_width = previewDiv.width() * 2;
                        previewDiv.css({
                            "background-size":bg_width + "px, auto",
                            "background-position":"50%, 50%",
                            "background-image":"url("+image+")",
                        });
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }


    });

    $(function() {
		switchToCreateAlbum();

		
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

    function switchToSelectAlbum() {
        $('#album-new :input').attr('disabled', 'disabled');
        $('#album-new').hide();
        $('#album-chooser :input').removeAttr('disabled');
        $('#album-chooser').show();
    }

    function switchToCreateAlbum() {
        $('#album-chooser :input').attr('disabled', 'disabled');
        $('#album-chooser').hide();
        $('#album-new :input').removeAttr('disabled');
        $('#album-new').show();
    }
</script>

<?php
echo $this->Form->create('Post',array('type'=>'file'));

echo $this->Form->input('Post.title', array('label'=>'Post title'));
echo $this->Form->input('Post.image',array('type'=>'file','label'=>'Upload'));
echo '<div class="file-preview"></div>';

// If album_id is not present -> will create new album
// if(!$this->request->pass){
//   echo $this->Form->input('Album.title',array('label'=>'Album title'));
// } else{
// echo 'Album title : ';
// echo $this->request->pass[1];
// echo "<br>";
// echo $this->Form->input('Album.id',array('type'=>'hidden','value'=>$this->request->pass[0]));
// }

?>

<div id="album-new">
	<?php echo $this->Form->input('Album.title', array('label' => 'Album title')); ?>
	<a href="#" onclick="switchToSelectAlbum(); return false;">Add to an
		existing album</a>
</div>


<div id="album-chooser" style="display: none;">
	<?php echo $this->Form->input('Album.id', array(
			'type' => 'select',
			'options' => $albumList,
			'label' => 'Album title'
			)); ?>
	<a href="#" onclick="switchToCreateAlbum(); return false;">Create new
		album</a>
</div>

<?php
	echo $this->Form->input('Category.categories', array('label' => 'Categories', 'id' => 'categories')); 
	echo $this->Form->submit(__('Create Post')); 
?>
