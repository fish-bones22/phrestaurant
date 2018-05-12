function checkUsername() {

	username = $("#username").val();

	$.ajax({
		type:'GET',
		url: 'php/functions/get_username.php',
		data: { uname: username },
		datatype: 'json',
		success: function(data) {
			if (data == 'null') {
				enableSaveButton();
			} else {
				disableSaveButton("Username is already used.");
				$("#username").focus();
				$("#username").select();
			}
		}
	});

}

function checkPasswordMatched() {

	if ($("#password").val() != $("#confirm-password").val()) {
		if ($("#confirm-password").val() != "")
			disableSaveButton("Passwords do not match.");
	} else {
		enableSaveButton();
	}

}

function enableSaveButton() {

	$("#save-button").removeAttr("disabled");
	$("#warning-message").text("");

}

function disableSaveButton(errorMessage) {

	$("#save-button").removeAttr("disabled");
	$("#warning-message").text(errorMessage);
		
}