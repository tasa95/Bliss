$(function() {
	
	/* Verifs Nom */
	$('#nom').keyup(function() {
		if (!$('#nom').val().match(/^[_-\s\wàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$/i)) {
			$('#ControlNom').removeClass('success');
			$('#ControlNom').addClass('error');

		} else {
			$('#ControlNom').removeClass('error');
			$('#ControlNom').addClass('success');
		}
	});

	/* Verifs Prenom */
	$('#prenom').keyup(function() {
		if (!$('#prenom').val().match(/^[_-\s\wàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$/i)) {
			$('#ControlPrenom').removeClass('success');
			$('#ControlPrenom').addClass('error');
		} else {
			$('#ControlPrenom').removeClass('error');
			$('#ControlPrenom').addClass('success');
		}
	});
	
	/* Verifs Prenom */
	$('#login').keyup(function() {
		if (!$('#login').val().match(/^[-_\w]+$/i)) {
			$('#ControlLogin').removeClass('success');
			$('#ControlLogin').addClass('error');
		} else {
			$('#ControlLogin').removeClass('error');
			$('#ControlLogin').addClass('success');
		}
	});
	
});