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

function checkQuantity(self) {
	//var quantity = $(self).data('quantity');
	var oid = $(self).data("id");
	//alert(oid);
	var quantity = $(self).siblings('input').val();
	var newQuantity;
	quantityCheck(oid, function(data){
		//alert(data);
		newQuantity = data;
		alert(newQuantity);
	});

	if (quantity == newQuantity) {
		$(self).attr('disabled');
	}
}

function quantityCheck(id, callback) {
	var oid = id;
	var oaction = "quantityCheck";
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
			//alert(data);
			callback(data);
			showOrderlist();
		}
	});
}

function containerMethod(self) {
	orderButtonSelected(self);
	checkQuantity(self);
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

	if (array.length <= 0) {
		var tr = document.createElement("tr");
		var td = document.createElement("td");
		td.className = "text-muted";
		td.appendChild(document.createTextNode("Select Menu from the left."));
		tr.appendChild(td);
		$("#order-list").append(tr);
		return;
	}
	
	var totalPr = 0;

	for (var i = 0; i < array.length ; i++) {
		console.log(array[i]);
		
		var tr = document.createElement("tr");

		// Create table data for menu name
		var menuName = array[i].menu_name.length > 25 ? array[i].menu_name.substring(0, 22) + "..." : array[i].menu_name;
		var tdMenu = document.createElement("td");
		tdMenu.appendChild(document.createTextNode(menuName));
		tr.appendChild(tdMenu);

		// Create table data for quantity
		var tdQuan = document.createElement("td");
		tdQuan.appendChild(document.createTextNode(array[i].order_quantity));
		tr.appendChild(tdQuan);

		// Create table data for quantity
		var tdPrice = document.createElement("td");
		var price = array[i].order_quantity * array[i].menu_price;
		totalPr += price;
		tdPrice.appendChild(document.createTextNode(price));
		tr.appendChild(tdPrice);

		// Create table data for delete button
		var tdDelete = document.createElement("td");
		  // Create button
		var btn = document.createElement("button");
		  // Add text on button
		btn.appendChild(document.createTextNode("×"));
		btn.className = "close";
		  // Add data attr on button
		btn.setAttribute('data-id', array[i].table_order_id);
		btn.onclick = function() { 
		  // Add onclick on button
			var orderId = $(this).data('id');
			deleteItem(orderId);
		};
		tdDelete.appendChild(btn);
		tr.appendChild(tdDelete);


		$("#order-list").append(tr);
	}

	$("#order-list").append("<tr><th>Total:</th><td></td><th> " + totalPr + "</this></tr>");
}

// function loadlink(){
//     $('#orderBox').load('php/functions/order.php',function () {
//          $(this).unwrap();
//     });
// }


$(document).ready(function() {

	showOrderlist(); // This will run on page load
	$("#menu-box").DataTable();

	//intv = setInterval(showOrderlist, 5000);

});

