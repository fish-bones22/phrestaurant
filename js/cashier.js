// Globals
var selectedMenu;
var isQtyReset = true;

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


function buttonSelected(self) {

	disableAllMenu();
	orderButtonSelected(self);

}


function deleteItem(oid) {
	var oaction = "deleteItem";

	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			orderid:oid,
			action:oaction
		},
		datatype: "json",
		success: function(data){
			showOrderlist();
		}
	});
}


function deductQuantity(orderId, menuId) {

	var oaction = "deductQuantity";

	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			orderid:orderId,
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
	var username = document.getElementById("checkUsername").value;
	var password = document.getElementById("checkPassword").value;

	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			action:oaction,
			user:username,
			pass:password
		},
		datatype: "text",
		success: function(data){
			
			if (data.trim() != '') {
				createPdf(data);
				window.location = "cashier.php";
			} else {
				$("#verify-failed").removeAttr("hidden");
			}

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


function resetQuantity() {

	$(".qty-disp").each(function() {
		$(this).text($(this).data('original'));
	});

}

function enableAllMenu() {

	$(".item_menu").each(function() {
		if ($(this).data('quantity') > 0)
			$(this).removeAttr("disabled");
	});

}

function disableAllMenu() {

	$(".item_menu").each(function() {
		$(this).attr("disabled", "");
	});

}


function updateOrderList(array) {
	
	$("#order-list").html("");
	enableAllMenu();
	
	if (array.length <= 0) {
		var tr = document.createElement("tr");
		var td = document.createElement("td");
		td.className = "text-muted";
		td.appendChild(document.createTextNode("Select Menu from the left."));
		tr.appendChild(td);
		$("#order-list").append(tr);
		$("#check-out-btn").attr("disabled", "");
		// Set quantity to original
		resetQuantity();
		return;
	}

	selectedMenu = array;
	$("#check-out-btn").removeAttr("disabled")
	var totalPr = 0;

	for (var i = 0; i < array.length ; i++) {
		
		var tr = document.createElement("tr");
		// Set quantity display of menu
		var newQty = $("#qty-disp-"+array[i].menu_id).data("original") - array[i].order_quantity;
		$("#qty-disp-"+array[i].menu_id).text(newQty);
		if (newQty <= 0)
			$("#item-menu-"+array[i].menu_id).attr("disabled", "");

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
		// Create deduct quantity button
		var minusBtn = document.createElement("btn");
		minusBtn.type = "button";
		minusBtn.className = "btn btn-sm btn-link";
		var minusSign = document.createElement("i");
		minusSign.className = "fa fa-minus";
		minusBtn.appendChild(minusSign);
		minusBtn.setAttribute("data-id", array[i].table_order_id);
		minusBtn.setAttribute("data-menuid", array[i].menu_id);
		minusBtn.onclick = function() {
			deductQuantity($(this).data('id'), $(this).data('menuid'));
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
		};
		tdDelete.appendChild(btn);

		tr.appendChild(tdDelete);


		$("#order-list").append(tr);
	}

	$("#order-list").append("<tr><th>Total:</th><td></td><th> " + totalPr + "</this></tr>");

	if (isQtyReset) {
		isQtyReset = false;
	}
}


function createPdf(name) {

	var height = (5*selectedMenu.length) + 55;
	var width = 79.375;
	var orientation = 'p';

	if (height <= width) {
	var orientation = 'l';
	}

	var doc = new jsPDF(orientation, 'mm', [width, height]);

	doc.setFont("courier", "normal");

	var img = new Image();
	img.src = "img/logo.png";

	doc.addImage(img, 17, 12, 8, 8);
	doc.setFontSize(14);
	doc.text("PH Resto", 28, 15);
	doc.setFontSize(11);
	doc.text("Lucban, Quezon", 28, 19);

	doc.setFontStyle("bold");
	doc.text("Qty", 5, 28);
	doc.text("Menu", 14, 28);
	doc.text("Price", 61, 28);

	doc.setFontStyle("normal");
	doc.text("_____________________________", 5, 28);

	var line = 33;
	var totalPrice = 0;
	for (var i = 0; i < selectedMenu.length; i++) {

		var shortenedMenu = selectedMenu[i].menu_name.length > 21 ? selectedMenu[i].menu_name.substring(0, 18) + "..." : selectedMenu[i].menu_name;
		var price = selectedMenu[i].menu_price*selectedMenu[i].order_quantity;
		totalPrice += price;

		doc.text(selectedMenu[i].order_quantity, 5, line);
		doc.text(shortenedMenu, 14, line);
		doc.text((price)+"", 66, line);
		line += 4;
	}
	doc.text("_____________________________", 5, line-3);
	doc.setFontStyle("bold");
	doc.text("TOTAL", 5, line+2);
	doc.text(totalPrice+"", 66, line+=2);

	name = name.length > 23 ? name.substring(0, 20) + "..." : name;

	doc.setFontStyle("normal");
	doc.text("Cashier: " + name, 5, line += 5);
	doc.text(getDate(), 5, line += 4);

	var date = new Date();
	var filename1 = date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
	var filename2 = date.getMonth() + "" + date.getDay() + "" + date.getYear();

	doc.save("receipt" + filename1 + filename2 +  ".pdf");

}

function getDate() {

	var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var today = new Date();
	var dd = today.getDate();
	var MM = months[today.getMonth()];
	var yyyy = today.getFullYear();

	var hh = today.getHours();
	var mm = today.getMinutes();

	if(dd<10) {
	    dd = '0'+dd
	} 

	if(mm<10) {
	    mm = '0'+mm
	} 

	today = hh + ":" + mm + ", " + MM + " " + dd + ', ' + yyyy;
	return today;
}


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

