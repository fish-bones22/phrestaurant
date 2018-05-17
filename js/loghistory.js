$(document).ready(function() {
	var table = $("#log-table").DataTable({
		"order": [[ 0, "desc" ]]
	});

	table.column(0).visible(false);
});