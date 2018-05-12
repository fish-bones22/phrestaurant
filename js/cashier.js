function orderButtonSelected(self) {
	var oid = $(self).data("id");
	var oaction = "addUpdate";
	$.ajax({
		type: "post",	
		url: "php/functions/order.php",
		data: {
			id:oid, 
			action:oaction
		},
		datatype: "json",
		success: function(data){
			console.log(data);
			showOrderlist();
		}
	});
}

function deleteItem(oid) {
	var oaction = "deleteItem";
	console.log(oid);
	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			id:oid,
			action:oaction
		},
		datatype: "json",
		success: function(data){
			console.log(data);
			showOrderlist();
		}
	});
}

// function checkOutOrder() {
// 	var oaction = "checkOut";
// 	$.ajax({
// 		type: "post",
// 		url: "php/Order.php",
// 		data: {
// 			action:oaction
// 		},
// 		datatype: "json",
// 		success: function(data){
// 			console.log(data);
// 		}
// 	});
// }

function checkOutLogin() {
	var oaction = "checkOutLogin";
	var username = $("#checkUsername").val();
	var password = $("#checkPassword").val();
	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			action:oaction,
			user:username,
			pass:password
		},
		datatype: "json",
		success: function(data){
			console.log(data);
		}
	});
}

function showOrderlist() {
	var oaction = "showOrder";
    $.ajax({
		type: "post",
		url: "php/functions/order.php",
        data: {
			action:oaction
		},
		datatype: "json",
        success: function(data) {
        	updateOrderList(JSON.parse(data));
        }
    });
}

function updateOrderList(array) {
	
	$("#order-list").html("");

	if (array.length <= 0)
		return;
	

	for (var i = 0; i < array.length ; i++) {
		console.log(array[i]);
		
		var tr = document.createElement("tr");

		// Create table data for menu name
		var tdMenu = document.createElement("td");
		tdMenu.appendChild(document.createTextNode(array[i].menu_name));
		tr.appendChild(tdMenu);

		// Create table data for quantity
		var tdQuan = document.createElement("td");
		tdQuan.appendChild(document.createTextNode(array[i].order_quantity));
		tr.appendChild(tdQuan);

		// Create table data for delete button
		var tdDelete = document.createElement("td");
		  // Create button
		var btn = document.createElement("button");
		btn.appendChild(document.createTextNode("×"));
		btn.className = "close";
		btn.setAttribute('data-id', array[i].table_order_id);
		btn.onclick = function() { 
			var orderId = $(this).data('id');
			deleteItem(orderId);
		};
		tdDelete.appendChild(btn);
		tr.appendChild(tdDelete);


		$("#order-list").append(tr);
	}

}

// function loadlink(){
//     $('#orderBox').load('php/functions/order.php',function () {
//          $(this).unwrap();
//     });
// }


$(document).ready(function() {

	showOrderlist(); // This will run on page load

	//intv = setInterval(showOrderlist, 5000);

});

