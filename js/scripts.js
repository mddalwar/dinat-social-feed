(function($){
	var username = $('.instagram-username').text();
	var item_per_row = $('.item_per_row').text();
	var total_item = $('.total_item').text();
	$.instagramFeed({
	  'username': username,
	  'container': "#sidebar-widget__instagram",
	  'display_profile': false,
	  'display_biography': false,
	  'display_igtv': false,
	  'items_per_row' : item_per_row,
	  'items' : total_item,
	  'margin'  : 1
	});
	$('.instagram-username').hide();
	$('.item_per_row').hide();
	$('.total_item').hide();
})(jQuery)
