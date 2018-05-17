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
	table.column(1).visible(false);

	getTotalSales();
});

function getTotalSales() {

	var dateFrom = $("[name='date_from']").val();
	var dateTo = $("[name='date_to']").val();

	if (dateFrom != '')
		dateFrom = dateFrom;

	if (dateTo != '')
		dateTo = dateTo.addDays(1);

	$.ajax({
		type:'post',
		url:'php/functions/get_sales.php',
		data:{
			datefrom: dateFrom,
			dateto: dateTo
		},
		datatype:'json',
		success: function(data) {
			$("#total-sales").text(data);
		}
	})

}

String.prototype.addDays = function(days) {
	var str = this.valueOf();
	var dateArr = str.split("/"),
        m = dateArr[0],
        d = dateArr[1],
        y = dateArr[2],
        temp = [];
    temp.push(y,m,d);

    var date = (new Date(temp.join("-"))).addDays(days);

    return date.mmddyyyy();
}

// Create addDays function
Date.prototype.addDays = function(days) {

  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;

}

Date.prototype.mmddyyyy = function() {
  var mm = this.getMonth() + 1; // getMonth() is zero-based
  var dd = this.getDate();

  return [this.getFullYear(),
          (mm>9 ? '' : '0') + mm,
          (dd>9 ? '' : '0') + dd
         ].join('-');
}