
<!DOCTYPE html>
<html>
<head>
	<title>Adder List</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f8f8f8;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
		}

		h1 {
			text-align: center;
			margin-bottom: 30px;
		}

		form {
			display: flex;
			flex-wrap: wrap;
		}

		form label {
			display: block;
			width: 100%;
			margin-bottom: 10px;
		}

		form select,
		form input[type="text"],
		form input[type="number"] {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			background-color: #fff;
			font-size: 16px;
			margin-bottom: 20px;
			box-sizing: border-box;
		}

		form select {
			appearance: none;
			-webkit-appearance: none;
			-moz-appearance: none;
			background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8 11.5L3.5 7h9L8 11.5z"/></svg>');
			background-repeat: no-repeat;
			background-position: right 10px center;
			background-size: 12px;
			padding-right: 40px;
		}

		form #shiplap_fields,
		form #fascia_fields,
		form #extra_layer_fields {
			display: none;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		th, td {
			text-align: left;
			padding: 10px;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
			font-weight: normal;
		}

		tbody tr:last-of-type td {
			border-bottom: none;
		}

		button {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			margin-bottom: 15px;
		}

		button:hover {
			background-color: #3e8e41;
		}
		
		.buttonSubmit {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			margin-bottom: 15px;
			margin-top: 15px;
			
		}

		.buttonSubmit:hover {
			background-color: #3e8e41;
		}
		

	</style>
</head>
<body>
	<div class="container">
		<h1>Adder List</h1>
		<form action="generate.php" method="POST">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>

			<label for="job_address">Job Address:</label>
			<input type="text" id="job_address" name="job_address" required>

			<label for="adder_list">Adder List:</label>
			<select id="adder_list" name="adder_list" required>
				<option value="">-- Please Select --</option>
				<option value="Fascia">Fascia</option>
				<option value="Shiplap">Shiplap</option>
				<option value="Extra Layer">Extra Layer</option>
		</select>

		<div id="shiplap_fields">
			<label for="price_per_square">Price per Square:</label>
			<input type="number" id="price_per_square" name="price_per_square" step="0.01">

			<label for="amount_of_square">Amount of Square:</label>
			<input type="number" id="amount_of_square" name="amount_of_square" step="0.01">
		</div>

		<div id="fascia_fields">
			<label for="price_per_foot">Price per Foot:</label>
			<input type="number" id="price_per_foot" name="price_per_foot" step="0.01">

			<label for="amount_of_foot">Amount of Foot:</label>
			<input type="number" id="amount_of_foot" name="amount_of_foot" step="0.01">
		</div>

		<div id="extra_layer_fields">
			<label for="price_per_foot2">Price per Foot:</label>
			<input type="number" id="price_per_foot2" name="price_per_foot2" step="0.01">

			<label for="amount_of_foot2">Amount of Foot:</label>
			<input type="number" id="amount_of_foot2" name="amount_of_foot2" step="0.01">
		</div>
		<button type="button" id="add_to_list">Add to List</button>
		</br>
			<label for="completion">Completion:</label>
			<select id="completion" name="completion" required>
				<option value="">-- Please Select --</option>
				<option value="50% Job Start">50% Job Start</option>
				<option value="50% Final">50% Final</option>
				<option value="100% Final">100% Final</option>
		</select>
		
		
			
		
	

	<table>
		<thead>
			<tr>
				<th>Adder</th>
				<th>Price per</th>
				<th>Amount</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="addition_list"></tbody>
	</table>

<button  type="submit" class="buttonSubmit" id="submitInvoice" name="generatepdf">Submit Invoice</button>
</div>
</form>

<script>
	// Get references to form elements
	const adderList = document.getElementById('adder_list');
	const shiplapFields = document.getElementById('shiplap_fields');
	const fasciaFields = document.getElementById('fascia_fields');
	const extraLayerFields = document.getElementById('extra_layer_fields');
	const addToButton = document.getElementById('add_to_list');
	const tableBody = document.querySelector('table tbody');
	const grandTotalCell = document.getElementById('grand_total');

	let grandTotal = 0;
	
	// Add event listener to adderList dropdown
	adderList.addEventListener('change', () => {
		// Show/hide additional fields based on selected adder
		if (adderList.value === 'Shiplap') {
			shiplapFields.style.display = 'contents';
			fasciaFields.style.display = 'none';
			extraLayerFields.style.display = 'none';
		} else if (adderList.value === 'Fascia') {
			shiplapFields.style.display = 'none';
			fasciaFields.style.display = 'contents';
			extraLayerFields.style.display = 'none';
		} else if (adderList.value === 'Extra Layer') {
			shiplapFields.style.display = 'none';
			fasciaFields.style.display = 'none';
			extraLayerFields.style.display = 'contents';
		} else {
			shiplapFields.style.display = 'none';
			fasciaFields.style.display = 'none';
			extraLayerFields.style.display = 'none';
		}
	});

	// Add event listener to add to list button
	addToButton.addEventListener('click', () => {
		const additionList = document.getElementById('addition_list');
		const row = document.createElement('tr');

		// Add adder to row
		const adderCell = document.createElement('td');
		adderCell.textContent = adderList.value;
		row.appendChild(adderCell);

		// Add price per and amount of to row
		const pricePerCell = document.createElement('td');
		const amountOfCell = document.createElement('td');
		let pricePer, amountOf;

		if (adderList.value === 'Shiplap') {
			pricePer = document.getElementById('price_per_square').value;
			amountOf = document.getElementById('amount_of_square').value;
		} else if (adderList.value === 'Fascia') {
			pricePer = document.getElementById('price_per_foot').value;
			amountOf = document.getElementById('amount_of_foot').value;
		} else if (adderList.value === 'Extra Layer') {
			pricePer = document.getElementById('price_per_foot2').value;
			amountOf = document.getElementById('amount_of_foot2').value;
		}

		pricePerCell.textContent = `$${pricePer}`;
		amountOfCell.textContent = `$${amountOf} `;

		row.appendChild(pricePerCell);
		row.appendChild(amountOfCell);

		// Calculate and add total to row
		//const totalCell = document.createElement('td');
		//const total = (pricePer * amountOf).toFixed(2);
		//totalCell.textContent = `$${total}`;
		//row.appendChild(totalCell);
		
		
		

		// Add remove button to row
		const removeButton = document.createElement('button');
		removeButton.textContent = 'Remove';
		removeButton.addEventListener('click', () => {
			additionList.removeChild(row);
		});

		const removeCell = document.createElement('td');
		removeCell.appendChild(removeButton);
		row.appendChild(removeCell);

		additionList.appendChild(row);
	});
</script>
</body>
</html>