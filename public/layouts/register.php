<div class="register">
	<div class="register-card">
		<form method="post" action="redirect.php" onsubmit="return registerSubmit()">
			<h1 class="top">Register</h1>
			<hr class="line">

			<div class="name-container">
				<input class="input-register" type="text" name="first_name" placeholder="First name" required>
				<input class="input-register" type="text" name="middle_name" placeholder="Middle name" required>
				<input class="input-register" type="text" name="last_name" placeholder="Last name" required>
			</div>
			<input class="input-register" type="email" name="email" placeholder="Email" required>
			<input class="input-register" type="password" name="password" placeholder="Enter password" required>
			<input class="input-register" type="password" name="confirm_password" placeholder="Confirm password"
				required>

			<input type="hidden" name="type" value="register">
			<button class="button-register" type="submit">REGISTER</button>

			<span>
				<strong>
					<center>Or</center>
				</strong>
			</span>

			<span>
				<center class="account-check">Already have account? <a href="registration.php">SIGN IN</a></center>
			</span>
		</form>
	</div>
</div>

<script>
	function registerSubmit() {
		const password = document.querySelector('input[name="password"]').value;
		const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

		if (password !== confirmPassword) {
			showErrorModal('Passwords do not match.');
			return false;
		}

		if (password.length < 8) {
			showErrorModal('Password must be at least 8 characters long.');
			return false;
		}

		return true;
	}
</script>