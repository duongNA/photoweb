//$(function(){
//
//	var $container = $('#iso-container');
//
//	$container.isotope({
//		itemSelector: '.iso-element',
//		layoutMode: 'fitRows'
//	});
//
//
//	$container.infinitescroll({
//		navSelector  : '#page-nav',   	// selector for the paged navigation 
//		nextSelector : '#page-nav a',  	// selector for the NEXT link (to page 2)
//		itemSelector : '.iso-element',  // selector for all items you'll retrieve
//		loading: {
//			finishedMsg: 'No more pages to load.',
//			img: 'http://i.imgur.com/qkKy8.gif'
//		}
//	},
//	// call Isotope as a callback
//	function( newElements ) {
//		alert('get data success');
//	}
//	);
//
//
//});


$(function(){

	var $container = $('#iso-container');

	$container.isotope({
		itemSelector : '.iso-element',
		layoutMode: 'fitRows'
	});

	$container.infinitescroll({
		navSelector  : '#page_nav',    // selector for the paged navigation 
		nextSelector : '#page_nav a',  // selector for the NEXT link (to page 2)
		itemSelector : '.iso-element',     // selector for all items you'll retrieve
		loading: {
			finishedMsg: 'No more pages to load.',
			img: 'http://i.imgur.com/qkKy8.gif'
		}
	},
	// call Isotope as a callback
	function( newElements ) {
		$container.isotope( 'appended', $( newElements ) ); 
	}
	);


});



$(function() {
	$('#btn-add-new-post').click(function() {
		var dialog = $('<div id="dialog-add-new-post"></div>');

		// send ajax request
		$.ajax({
			type: 'GET',
			url: '/photo/posts/add',
			success: function(data) {
				dialog.html(data);
				dialog.dialog({
					width: 400,
					model: true,
					title: 'Add new post'
				});
			}

		})
	});

});


$(function(){

	var $container = $('#content.container');

	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector: '.box',
			columnWidth: 300,
			isFitWidth: true,
			isAnimated: true
		});
	});

	$container.infinitescroll({
		navSelector  : '#page_nav',    // selector for the paged navigation 
		nextSelector : '#page_nav a',  // selector for the NEXT link (to page 2)
		itemSelector : '.item',     // selector for all items you'll retrieve
		loading: {
			finishedMsg: 'No more pages to load.',
			img: 'http://i.imgur.com/6RMhx.gif'
		}
	},
	// trigger Masonry as a callback
	function( newElements ) {
		// hide new items while they are loading
		var $newElems = $( newElements ).css({ opacity: 0 });
		// ensure that images load before adding to masonry layout
		$newElems.imagesLoaded(function(){
			// show elems now they're ready
			$newElems.animate({ opacity: 1 });
			$container.masonry( 'appended', $newElems, true ); 
		});
	}
	);

});




