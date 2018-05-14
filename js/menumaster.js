function checkUsername() {

	name = $("#menu-name").val();

	$.ajax({
		type:'GET',
		url: 'php/functions/get_menu_names.php',
		data: { name: name },
		datatype: 'json',
		success: function(data) {
			console.log(data);
			if (data === 'false') {
				enableSaveButton();
			} else {
				disableSaveButton("Name is already used.");
				$("#menu-name").focus();
				$("#menu-name").select();
			}
		}
	});

}

function enableSaveButton() {

	$("#save-button").removeAttr("disabled");
	$("#warning-message").text("");

}

function disableSaveButton(errorMessage) {

	$("#save-button").attr("disabled", "");
	$("#warning-message").text(errorMessage);
		
}