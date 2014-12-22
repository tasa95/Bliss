$(function() {

	/* Verifs Nom */
	$('#nom').keyup(function() {
		if (!$('#nom').val().match(/^[-_\s\wàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$/i)) {
			$('#ControlNom').removeClass('success');
			$('#ControlNom').addClass('error');

		} else {
			$('#ControlNom').removeClass('error');
			$('#ControlNom').addClass('success');
		}
	});
	
});