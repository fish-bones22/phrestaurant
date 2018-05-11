

function checkPasswordMatched() {

	if ($("#password").val() != $("#confirm-password").val()) {

		$("#save-button").attr("disabled", "");
		$("#warning-message").text("Passwords do not match.");

	} else {

		$("#save-button").removeAttr("disabled");
		$("#warning-message").text("");
	}

}