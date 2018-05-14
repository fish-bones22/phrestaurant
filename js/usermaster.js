var hasSameUsername = false;

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
				hasSameUsername = true;
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
		if (!hasSameUsername)
			enableSaveButton();
	}

}

function enableSaveButton() {

	$("#save-button").removeAttr("disabled");
	$("#warning-message").text("");

}

function disableSaveButton(errorMessage) {

	$("#save-button").attr("disabled", "");
	$("#warning-message").text(errorMessage);
		
}