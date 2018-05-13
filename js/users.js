function deleteUser(id) {

	$("#user-id-for-deletion").val(id);

}

$(document).ready(function() {

	var table = $("#users-table").DataTable({
    	"bLengthChange": false,
        "info":     false,
        "paging": false,
        "columnDefs": [
			{ "orderable": false, "targets": 1 }
		]
	});

});