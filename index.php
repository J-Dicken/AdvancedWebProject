<?php 
	session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ohm Electrical Products</title>
	<META NAME="DESCRIPTION" CONTENT="List of all products sold by Ohm Electrical. Filter by department and brand to find and order a specific product">
	<META NAME="KEYWORDS" CONTENT="Electrical products, televisions, phone, mobiles, laptops, electronics, technology, shopping, entertainment">
	<link rel="stylesheet" href="styles.css">
	<script type="text/javascript">
		//Check if item just been ordered to display alert
		var flag = '<?php echo isset($_GET['flag']); ?>';
		if (flag == 1){
			alert("Item ordered sucessfully, all orders can be viewed on your orders page");
			flag = 0;
		}
		function checkDisplay(){
			var display = '<?php echo isset($_SESSION['user']); ?>';
			return display;
		}
		function applyFilters(choice){
			var httpxml;
			try  {
				// Firefox, Chrome, Opera 8.0+, Safari
				httpxml=new XMLHttpRequest();
			}
			catch (e)  {
				// Internet Explorer
				try    {
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)    {
						try      {
							httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)      {
							alert("Your browser does not support AJAX!");
							return false;
						}
				}
			}
			
			function stateChanged(){
				if(httpxml.readyState==4){
					//Prevents error when departmen is set to "select department" which causes the checkFilters to return a data
					try{
						var myObject = JSON.parse(httpxml.responseText);
					} catch(e){
						var myObject = null;
					}

					var brands = document.getElementById('brand');
					//Remove current brand options
					for(j=brands.options.length-1;j>=0;j--){
						brands.remove(j);
					}
					
					if (myObject != null){	
						
						//Add blank instruction option
						var optn = document.createElement("OPTION");
						optn.text = "Select Brand";
						optn.value = " ";
						brands.options.add(optn);

						//Get value of previously selected brand
						var brand1 = myObject.value.brand1;
						var dept = myObject.dept;
						//Add brands from SQL query only if department is selected
						for(j=myObject.brand.length-1;j>=0;j--){
							var optn = document.createElement("OPTION");
							optn.text = myObject.brand[j];
							optn.value = myObject.brand[j];
							
							if(optn.value==brand1){
								optn.selected = true;														
							}
							brands.options.add(optn);
						}
					} else{
						//Instruction to select department first
						var optn = document.createElement("OPTION");
						optn.text = "Please select a department first";
						optn.value = " ";
						brands.options.add(optn);
					}
					//Products update when either of the drop downs are changed
					displayProducts(dept, brand1);
				}
			}

			var url="checkFilters.php";
			var dept = document.getElementById('department').value;
			if (choice != 0){
				var brand = document.getElementById('brand').value;
			} else{
				var brand = '';
			}
			//Add the department filter to get request
			url = url+"?dept="+dept;
			//Add the brand filter to get request
			url = url+"&brand="+brand;
			httpxml.onreadystatechange=stateChanged;
			httpxml.open("GET",url,true);
			httpxml.send(null);
		}

		function displayProducts(dept, brand){
			var httpxml;
			try  {
				// Firefox, Chrome, Opera 8.0+, Safari
				httpxml=new XMLHttpRequest();
			}
			catch (e)  {
				// Internet Explorer
				try    {
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)    {
						try      {
							httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)      {
							alert("Your browser does not support AJAX!");
							return false;
						}
				}
			}

			function stateChanged(){
				if(httpxml.readyState==4){
					try{
						var myObject = JSON.parse(httpxml.responseText);
					} catch(e){
						var myObject = null;
					}
					
					//Remove current products
					var prodList = document.getElementById("products");
					while(prodList.hasChildNodes()){
						prodList.removeChild(prodList.childNodes[0]);
					}

					//Create product displays
					for (var i = 0; i < myObject.length; i++){
						var tempObj = myObject[i];
						var newChild = document.createElement("div");
						newChild.setAttribute("class", "product");
						newChild.setAttribute("data", tempObj.id);
						newChild.setAttribute("onclick", "showInfo(" + tempObj.id + ")");
						//Product image
						var prodImg = document.createElement("img");
						prodImg.setAttribute("src", "imgs/" + tempObj.imgSrc);
						prodImg.setAttribute("alt", tempObj.imgAlt);
						newChild.appendChild(prodImg);
						prodList.appendChild(newChild);
						//Product name
						var name = document.createElement("H2");
						var content = document.createTextNode(tempObj.name);
						name.appendChild(content);
						newChild.appendChild(name);						
					}
				}
			}

			var url = "displayProducts.php?dept=" + dept + "&brand=" + brand;
			httpxml.onreadystatechange=stateChanged;
			httpxml.open("GET",url,true);
			httpxml.send(null);		
		}



		//Function for displaying the product info and order option for the selected product
		function showInfo(id){
			var httpxml;
			try  {
				// Firefox, Chrome, Opera 8.0+, Safari
				httpxml=new XMLHttpRequest();
			}
			catch (e)  {
				// Internet Explorer
				try    {
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)    {
						try      {
							httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)      {
							alert("Your browser does not support AJAX!");
							return false;
						}
				}
			}
			
			function stateChanged(){
				if(httpxml.readyState==4){
					try{
						var myObj = JSON.parse(httpxml.responseText);
						var tempObj = myObj[0];
						var newChild = document.createElement("div");
						newChild.setAttribute("id", "productInfo");
						//Product image
						var prodImg = document.createElement("img");
						prodImg.setAttribute("src", "imgs/" + tempObj.imgSrc);
						prodImg.setAttribute("alt", tempObj.imgAlt);
						newChild.appendChild(prodImg);
						var textDiv = document.createElement("div");
						textDiv.setAttribute("id", "productText");
						//Product name
						var name = document.createElement("H2");
						var content = document.createTextNode(tempObj.name);
						name.appendChild(content);
						textDiv.appendChild(name);
						//Product price
						var price = document.createElement("H3");
						content = document.createTextNode("Price: " + tempObj.price);
						price.appendChild(content);
						textDiv.appendChild(price);
						//Product manufacturer
						var manu = document.createElement("p");
						content = document.createTextNode("Manufacturer: " + tempObj.brand);
						manu.appendChild(content);
						textDiv.appendChild(manu);
						//Order button	
						var check = checkDisplay();					
						if (check == 1){
							var btn = document.createElement("div");
							var btnLink = document.createElement("a");
							btn.setAttribute("id", "orderBtn");
							btnLink.setAttribute("href", "orderItem.php?id="+tempObj.id+"&price="+tempObj.price);
							content = document.createTextNode("Order now!");
							btnLink.appendChild(content);
							btn.appendChild(btnLink);
							textDiv.appendChild(btn);
						}
						newChild.appendChild(textDiv)
						//Close button
						var close = document.createElement("div");
						content = document.createTextNode("X");
						close.appendChild(content);
						close.setAttribute("id", "closeBtn");
						close.setAttribute("onclick", "closeInfo()");
						newChild.appendChild(close);						
						//Append to prodList
						document.getElementById("prodList").appendChild(newChild);
					} catch(e){
						
					}					
				}
			}

			var url = "productView.php?id=" + id;
			httpxml.onreadystatechange=stateChanged;
			httpxml.open("GET",url,true);
			httpxml.send(null);	
		}

		//Function to close info box
		function closeInfo(){
			const e = document.getElementById("productInfo");
			e.remove();
		}
	</script>
</head>
<body>
	<?php 
		require "header.php";
		$_GET['flag'] = 0;
	?>

	<div id="prodList">
		<h1>Products</h1>
		<div id="prodFilter">
			<select id="department" onchange=applyFilters(0); >
				<option value=' '>Select department</option>
				<?php
					require "config.php";
					$query = "select distinct dept from products ";
					foreach ($dbo->query($query) as $row) {
						echo "<option value=$row[dept]>$row[dept]</option>";
					}
				?>
			</select>
			<select id="brand" onchange=applyFilters(1);>
				<option value=' '>Select a department first</option>
			</select>
		</div><!--End of prodFilter-->
		<div id="products">
			<script type="text/javascript">displayProducts();</script>
		</div><!--End of products-->
	</div><!--End of prodList-->
	
</body>
</html>