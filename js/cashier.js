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


function checkQuantity(id) {

	var availQty = $("#avail-qty-menu-" + id).val();
	var qty = $("#qty-menu-" + id).val();
	
	if (qty === undefined) {
		return;
	}

	if (availQty - qty <= 1) {
		$("#btn-menu-"+id).attr('disabled', '');
	} else {
		$("#btn-menu-"+id).removeAttr('disabled');
	}

	$("#avail-qty-disp-"+id).text(availQty-qty);

}


function buttonSelected(self) {
	orderButtonSelected(self);
	 checkQuantity($(self).data('id'));
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
			showOrderlist();
		}
	});
}


function deductQuantity(oid) {
	var oaction = "deductQuantity";
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
			showOrderlist();
		}
	});
}


function checkOutLog() {
	var oaction = "checkOutLogin";
	//document.getElementById("uniqueID").value;
	var username = document.getElementById("checkUsername").value;
	//alert(username);//$("#checkUsername").val();
	var password = document.getElementById("checkPassword").value;//$("#checkPassword").val();
	//alert(password);
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


var isQtyReset = true;
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
		
		var tr = document.createElement("tr");

		// Create table data for menu name
		var menuName = array[i].menu_name.length > 25 ? array[i].menu_name.substring(0, 22) + "..." : array[i].menu_name;
		var tdMenu = document.createElement("td");
		tdMenu.appendChild(document.createTextNode(menuName));
		tr.appendChild(tdMenu);

		// Create table data for quantity
		var tdQuan = document.createElement("td");
		tdQuan.appendChild(document.createTextNode(array[i].order_quantity));
		// Create hidden input for quantity
		var input = document.createElement("input");
		input.type = "hidden";
		input.id = "qty-menu-" + array[i].menu_id;
		input.value = array[i].order_quantity;
		tdQuan.appendChild(input);
		// Set text of available quantity display to correct amount
		$("#avail-qty-disp-"+array[i].menu_id).text($("#avail-qty-menu-"+array[i].menu_id).val() - array[i].order_quantity);
		// Create deduct quantity button
		var minusBtn = document.createElement("btn");
		minusBtn.type = "button";
		minusBtn.className = "btn btn-sm btn-link";
		var minusSign = document.createElement("i");
		minusSign.className = "fa fa-minus";
		minusBtn.appendChild(minusSign);
		minusBtn.setAttribute("data-id", array[i].table_order_id);
		minusBtn.onclick = function() {
			deductQuantity($(this).data('id'));
		};
		tdQuan.appendChild(minusBtn);

		tr.appendChild(tdQuan);

		// Create table data for price
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
		btn.setAttribute('data-menuid', array[i].menu_id);

		    // Add onclick on button
		btn.onclick = function() { 
			var orderId = $(this).data('id');
			var menuId = $(this).data('menuid');
			deleteItem(orderId);

			$("#btn-menu-"+menuId).removeAttr("disabled");
			$("#avail-qty-disp-"+menuId).text($("#avail-qty-menu-"+menuId).val());

		};
		tdDelete.appendChild(btn);

		tr.appendChild(tdDelete);


		$("#order-list").append(tr);
	}

	$("#order-list").append("<tr><th>Total:</th><td></td><th> " + totalPr + "</this></tr>");

	if (isQtyReset) {
		isQtyReset = false;
		disableMenuByQty();
	}
}

function disableMenuByQty() {

	$(".item_menu").each(function() {
		checkQuantity($(this).data('id'));
	});

}

// function loadlink(){
//     $('#orderBox').load('php/functions/order.php',function () {
//          $(this).unwrap();
//     });
// }


$(document).ready(function() {

	showOrderlist(); // This will run on page load
	$("#menu-box").DataTable({
    	"bLengthChange": false,
        "info":     	false,
        "pageLength": 7
	});
	$('.dataTables_filter').parent().siblings().remove();
	$('.dataTables_filter').parent().removeClass("col-sm-12 col-md-6");
	$('.dataTables_filter').parent().addClass("col-3");

});

