<?php 
include '../config.php';
include "traca.php";

?>

<?php include '../header.php'; 
$componentCodice = $_GET['codice'];
$id_component = $_GET['id'];
?>



<br<br><br><br>
	<br<br><br><br>
		<br<br><br><br><br>
<div class="background-container">
	<div style=" display: flex;justify-content: center;align-items: center; height: 100vh;">
		<div style="width: 650px;padding: 30px;background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: rgba(255, 255, 255, 0.7); border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);backdrop-filter: blur(8px); ">
			<center>
				<h1 style="margin-bottom: 20px;text-transform: uppercase;">Verify Component</h1>
			</center>
			<form method="POST" action="">
				<div style=" margin-bottom: 20px;">
					<label for="ni" style=" display: block; align-items: center; font-weight: bold; margin-bottom: 5px;">Ni:</label>
					<input type="text" id="ni" name="ni" required style=" width: 100%;padding: 10px;border: 1px solid #ccc;border-radius: 4px;"><br>
				</div>
				<input type="hidden" name="codice" value="<?php echo $componentCodice; ?>">
			</form>
			<form method="POST" action="Insert.php?codice=<?php echo $componentCodice; ?>&id=<?php echo $id_component; ?>">		
				<div style=" margin-bottom: 20px;">
					<label for="machine" style=" display: block; align-items: center;font-weight: bold;margin-bottom: 5px;">Machine:</label>
						<select id="machine" name="machine" required
							style="width: 100%; height:40px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;"  <?php echo $isDisabled; ?>>
							<option value="">Select a machine</option>
							<option value="F5">F5</option>
							<option value="H60">H60</option>
						</select><br>
					</div>
					<div style=" margin-bottom: 20px;">
						<label for="table" style=" display: block;font-weight: bold;margin-bottom: 5px;">Table:</label>
						<select id="table" name="table" required
							style="width: 100%; height:40px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;"  <?php echo $isDisabled; ?>>
							<option value="">Select a Table</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select><br>
					</div>
					<div style=" margin-bottom: 20px;">
						<label for="emplacement" style=" display: block;font-weight: bold; margin-bottom: 5px;">Emplacement:</label>
							<select id="emplacement" name="emplacement" required style="width: 100%; height:40px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px; overflow-y: auto;max-height: 150px;"  <?php echo $isDisabled; ?>>
								<option value="">Select a number</option>

								<?php
								for ($i = 1; $i <= 116; $i++) {
								for ($j = 1; $j <= 3; $j++) {
								$val = $i . '-' . $j;
								echo "<option value='$val'>$val</option>";
								}
								}
								?>

							</select><br>
					</div>
					<div style=" margin-bottom: 20px;">
						<label for="feder" style=" display: block;font-weight: bold;margin-bottom: 5px;">Feder:</label>
						<input type="text" id="feder" name="feder" required style=" width: 100%;padding: 10px;border: 1px solid #ccc;border-radius: 4px;"  <?php echo $isDisabled; ?>><br>
					</div>
					<div style=" margin-bottom: 20px;">
						<label for="changed_feder" style=" display: block;font-weight: bold;margin-bottom: 5px;">Changed Feder:</label>
						<input type="text" id="changed_feder" name="changed_feder" style=" width: 100%;padding: 10px;border: 1px solid #ccc;border-radius: 4px;"  <?php echo $isDisabled; ?>><br>
					</div>
					<div style=" margin-bottom: 20px;">
						<label for="new_ni" style=" display: block;font-weight: bold;margin-bottom: 5px;">New Ni:</label>
						<input type="text" id="new_ni" name="new_ni" style=" width: 100%;padding: 10px;border: 1px solid #ccc;border-radius: 4px;"  <?php echo $isDisabled; ?>><br>
					</div>
					<input type="hidden" name="product_name" value="<?php echo $productName; ?>">
					<span class="text-<?php echo $messageClass; ?>"><?php echo $message; ?></span>
					<br>
					<div style="text-align: center;">
						<?php if ($messageClass === "success") : ?>
							<input type="hidden" name="codice" value="<?php echo $_POST['codice']; ?>">							
							<input type="hidden" name="ni" value="<?php echo $_POST['ni']; ?>">
							<button type="submit" style="background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 20px; font-size: 16px; cursor: pointer;">Add Component</button>
						<?php endif; ?>
					</div>
			</form>
		</div>
	</div>
</div>
<br<br><br><br>
<br<br><br><br><br><br>
<?php include '../footer.php'; ?>