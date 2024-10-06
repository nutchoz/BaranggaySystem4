<div class="background-alert" id="background-alert">
	<div class="custom-alert" id="customAlert">
		<span class="close-btn" onclick="closeAlert()">&times;</span>
		<div class="alert-content">
			<h2 id="alert-title">Alert Title</h2>
			<p id="alert-message">This is a custom alert message.</p>
		</div>
	</div>
</div>

<script type="text/javascript">
function showAlert(title, message) {
	document.getElementById("alert-title").textContent = title;
	document.getElementById("alert-message").textContent = message;
	document.getElementById('background-alert').style.display = 'block';
}

function closeAlert() {
	document.getElementById('background-alert').style.display = 'none';
}
</script>