<h1>ADD HOTEL</h1>
<form action="../redirect.php" method="POST">
	<input class="input-form" type="text" id="img_url" name="img_url" placeholder="Image URL" required>
	<input class="input-form" type="text" id="name" name="name" placeholder="Name" required>
	<input class="input-form" type="text" id="location" name="location" placeholder="Location" required>
	<textarea class="input-form" id="description" name="description" placeholder="Description..." ></textarea>
	<input type="hidden" name="type" value="add-hotel">
	<button type="submit" value="submit">SUBMIT</button>
</form>
