$(document).ready(function() {
	var table = $("#transaction-table").DataTable({
		"order": [[ 0, "desc" ]],
		"rowGroup": {
            dataSrc: 1
        },
        "pageLength": 7,
        "info": false,
    	"bLengthChange": false,
	});

	table.column(0).visible(false);
});