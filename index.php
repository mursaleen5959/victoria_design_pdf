<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<title>Document</title>
	<style>
		.form-control[readonly]
		{
			cursor: crosshair;
			background-color: #8080801f;
		}
	</style>
</head>

<body>
	<div class="container" style="border:1px solid black">
		<div class="text-center mt-4 mb-4">
			<h2>Adder List</h2>
		</div>
		<form action="generate.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-3">
					<label for=""><strong>Name:</strong></label>
					<input type="text" name="name" class="form-control" id="">
				</div>
				<div class="col-sm-3">
					<label for=""><strong>Job Address:</strong></label>
					<input type="text" name="jobAddress" class="form-control" id="">
				</div>
				<div class="col-sm-3">
					<label for="completion"><strong>Project Type:</strong></label>
					<select id="completion" name="projectType" class="form-select" required>
						<option value="" disabled selected>-- Please Select --</option>
						<option value="Shingles">Shingles</option>
						<option value="Presidential">Presidential</option>
						<option value="Tile Tear Off to Shingles">Tile Tear Off to Shingles</option>
						<option value="Tear Off Only">Tear Off Only</option>
						<option value="New Tile">New Tile</option>
						<option value="Tile Reset">Tile Reset</option>
						<option value="Repairs">Repairs</option>
						<option value="Gutters Only">Gutters Only</option>
						<option value="Backfill">Backfill</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label for="completion"><strong>Completion:</strong></label>
					<select id="completion" name="completion" class="form-select" required>
						<option value="" disabled selected>-- Please Select --</option>
						<option value="50% Job Start">50% Job Start</option>
						<option value="50% Final">50% Final</option>
						<option value="100% Final">100% Final</option>
					</select>
				</div>
			</div>
			<h3 class="mt-4 mb-3">List:</h3>
			<div id="productRow">
				<hr>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-3">
					<div id="otherField">
						
					</div>
				</div>
				<div class="col-sm-3">
					<select id="adder_list" name="adder_list" class="form-select" required>
						<option value="" disabled selected>-- Adder List Select --</option>
						<option value="Fascia">Fascia</option>
						<option value="Shiplap">Shiplap</option>
						<option value="Extra Layer">Extra Layer</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="col-sm-3">
					<div class="d-grid">
						<button type="button" id="addAdder" class="btn btn-success"><i class="fa-solid fa-plus"></i>Add</button>
					</div>
				</div>
			</div>
			<div class="row mt-5 mb-5">
				<div class="col"></div>
				<div class="col-sm-3">
					<div class="d-grid">
						<button class="btn btn-primary btn-block" name="generatepdf"><i class="fa-solid fa-file-pdf"></i> &nbsp;&nbsp; Generate PDF</button>
					</div>
				</div>
				<div class="col"></div>
			</div>
		</form>
	</div>
</body>

</html>
<script>
	$(document).ready(function()
	{
		$("#adder_list").change(function(){
			var adder_list = $("#adder_list").val();
			var otherField = $("#otherField");
			if(adder_list == 'Other')
			{

				otherField.html(`<input type="text" class="form-control" id="otherAdderField" placeholder="Other adder here">`);
			}
			else{
				otherField.html(``);
			}
		});
		$("#addAdder").click(function()
		{
			var adder = $('#adder_list').val();
			if(adder != '')
			{
				if(adder == 'Fascia' || adder == 'Extra Layer')
				{
					var html = `<div class="row">
									<div class="col-sm-4">
										<label for=""><strong>Adder:</strong></label><br>
										<input type="text" name="adder[]" class="form-control" id="" value="`+adder+`" readonly>
									</div>
									<div class="col-sm-4">
										<label for=""><strong>Price per Foot:</strong></label><br>
										<input type="text" name="price[]" class="form-control" id="">
									</div>
									<div class="col-sm-3">
										<label for=""><strong>Amount of Foot:</strong></label><br>
										<input type="text" name="amount[]" class="form-control" id="">
									</div>
									<div class="col-sm-1 text-center">
										<button type="button" class="deleteProduct btn btn-danger mt-4 mb-3"><i class="fa-solid fa-trash"></i></button>
									</div>
									<hr>
								</div>`;
					$('#productRow').append(html);
				}
				else if(adder == 'Shiplap')
				{
					var html = `<div class="row">
									<div class="col-sm-4">
										<label for=""><strong>Adder:</strong></label><br>
										<input type="text" name="adder[]" class="form-control" id="" value="`+adder+`" readonly>
									</div>
									<div class="col-sm-4">
										<label for=""><strong>Price per Square:</strong></label><br>
										<input type="text" name="price[]" class="form-control" id="">
									</div>
									<div class="col-sm-3">
										<label for=""><strong>Amount of Square:</strong></label><br>
										<input type="text" name="amount[]" class="form-control" id="">
									</div>
									<div class="col-sm-1 text-center">
										<button type="button" class="deleteProduct btn btn-danger mt-4 mb-3"><i class="fa-solid fa-trash"></i></button>
									</div>
									<hr>
								</div>`;
					$('#productRow').append(html);
				}
				else if(adder == 'Other')
				{
					var otherField = $("#otherAdderField").val();
					var html = `<div class="row">
									<div class="col-sm-4">
										<label for=""><strong>Adder:</strong></label><br>
										<input type="text" name="adder[]" class="form-control" id="" value="`+otherField+`" readonly>
									</div>
									<div class="col-sm-4">
										<label for=""><strong>Price per Square:</strong></label><br>
										<input type="text" name="price[]" class="form-control" id="">
									</div>
									<div class="col-sm-3">
										<label for=""><strong>Amount of Square:</strong></label><br>
										<input type="text" name="amount[]" class="form-control" id="">
									</div>
									<div class="col-sm-1 text-center">
										<button type="button" class="deleteProduct btn btn-danger mt-4 mb-3"><i class="fa-solid fa-trash"></i></button>
									</div>
									<hr>
								</div>`;
					$('#productRow').append(html);
				}
			}
		});
		$(document).on('click', '.deleteProduct', function()
		{
			$(this).parent().parent().remove();
		});
	});
</script>