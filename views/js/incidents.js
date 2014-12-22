$(function() {

	$('.visuModal').click(function(e) {
		e.preventDefault();
		var id = $(this).attr('id');
		$('#modal'+id).modal('toggle');
	});
});