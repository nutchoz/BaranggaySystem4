<style>
	.register-card {
		max-width: 500px;
		width: 100%;
		padding: 30px;
		border-radius: 8px;
		background-color: rgba(255, 255, 255, 0.9);
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	}

	.register-card input {
		margin-bottom: 15px;
	}

	.button-register {
		background-color: #28a745;
		border: none;
		width: 100%;
	}

	.button-register:hover {
		background-color: #218838;
	}

	.account-check a {
		color: #28a745;
	}

	.account-check a:hover {
		text-decoration: underline;
	}

	.name-container {
		display: flex;
		gap: 15px;
	}

	.name-container input {
		flex: 1;
	}

	.bg-image {
		background-image: url('assets/bg.png');
		background-size: cover;
		background-position: center;
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		filter: brightness(50%);
		z-index: -1;
	}
</style>

<div class="bg-image"></div>
<div class="d-flex justify-content-center align-items-center min-vh-100">
	<div class="register-card">
		<form method="post" action="redirect.php" onsubmit="return registerSubmit()">
			<h1 class="text-center mb-4 text-success">Register</h1>
			<hr class="line">

			<div class="name-container">
				<input class="form-control" type="text" name="first_name" placeholder="First name" required>
				<input class="form-control" type="text" name="middle_name" placeholder="Middle name" required>
				<input class="form-control" type="text" name="last_name" placeholder="Last name" required>
			</div>

			<input class="form-control" type="email" name="email" placeholder="Email" required>
			<input class="form-control" type="password" name="password" placeholder="Enter password" required>
			<input class="form-control" type="password" name="confirm_password" placeholder="Confirm password" required>

			<input type="hidden" name="type" value="register">

			<button class="btn button-register mb-3" type="submit">REGISTER</button>

			<div class="text-center">
				<strong>Or</strong>
			</div>

			<div class="text-center mt-3">
				Already have an account? <a href="registration.php" class="account-check">SIGN IN</a>
			</div>
		</form>
	</div>
</div>

<script>
	function registerSubmit() {
		const password = document.querySelector('input[name="password"]').value;
		const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

		if (password !== confirmPassword) {
			alert('Passwords do not match.');
			return false;
		}

		if (password.length < 8) {
			alert('Password must be at least 8 characters long.');
			return false;
		}

		return true;
	}
</script>