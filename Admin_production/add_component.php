<?php
include "traca.php";

 include '../config.php';

?>


<?php include '../header.php'; ?>



<?php
	if (isset($_GET['name'])) {
		$name = $_GET['name'];
	}
?>
        <div class="background-container">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="form-container" style="width: 500px; padding: 30px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: rgba(255, 255, 255, 0.7); border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); backdrop-filter: blur(8px); margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 20px;">Add Component</h2>
			<form  method="POST" action="">
                <label for="codice" style="display: block; margin-bottom: 10px;">Codice:</label>
                <input type="text" name="codice" id="codice" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;"><br>
			</form>
			<form method="POST" action="InsertComponent.php">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <label for="machine" style="display: block; margin-bottom: 10px;">Machine:</label>
                <select id="machine" name="machine" required style="width: 100%; height: 40px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;"<?php echo $isDisabled; ?>>
                    <option value="">Select a machine</option>
                    <option value="F5">F5</option>
                    <option value="H60">H60</option>
                </select>

                <label for="table_machine" style="display: block; margin-bottom: 10px;">Table Machine:</label>
                <select id="table_machine" name="table_machine" required style="width: 100%; height: 40px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;"<?php echo $isDisabled; ?>>
                    <option value="">Select a Table</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <label for="emplacement" style="display: block; margin-bottom: 10px;">Emplacement:</label>
                <select id="emplacement" name="emplacement" required style="width: 100%; height: 40px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px; overflow-y: auto; max-height: 150px;"<?php echo $isDisabled; ?>>
                    <option value="">Select a number</option>
                   <?php
					for ($i = 1; $i <= 116; $i++) {
					for ($j = 1; $j <= 3; $j++) {
					$val = $i . '-' . $j;
					echo "<option value='$val'>$val</option>";
					}
					}
					?>

                </select>
				<!-- Affichage du résultat de la vérification -->
				<span class="text-<?php echo $messageClass; ?>"><?php echo $message; ?></span>
				<br>
                <div style="text-align: center;">
					<?php if ($messageClass === "success") : ?>
						<input type="hidden" name="codice" value="<?php echo $_POST['codice']; ?>">
                    	<button type="submit" style="background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 20px; font-size: 16px; cursor: pointer;">Add Component</button>
					<?php endif; ?>
				</div>
            </form>
        </div>
    </div>
</div>

















<?php include '../footer.php'; ?>