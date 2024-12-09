<style>
	.login-card {
		max-width: 500px;
		width: 100%;
		padding: 30px;
		border-radius: 8px;
		background-color: rgba(255, 255, 255, 0.9);
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

	.card-custom {
		border-radius: 10px;
		backdrop-filter: blur(8px);
		background-color: rgba(255, 255, 255, 0.8);
	}

	.btn-custom {
		background-color: #28a745;
		border-color: #28a745;
	}

	.btn-custom:hover {
		background-color: #218838;
		border-color: #1e7e34;
	}

	.link-green {
		color: #28a745;
	}

	.link-green:hover {
		color: #218838;
		text-decoration: underline;
	}

	.min-vh-100 {
		min-height: 100vh;
	}
</style>

<div class="bg-image"></div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh; overflow: hidden;">
	<div class="card p-4 shadow-sm card-custom" style="max-width: 400px; width: 100%;">
		<form method="post" action="redirect.php">
			<h1 class="text-center mb-4 text-success">Login</h1>
			<hr>

			<div class="mb-3">
				<input class="form-control" type="text" name="email" placeholder="Enter email" required>
			</div>
			<div class="mb-3">
				<input class="form-control" type="password" name="password" placeholder="Enter password" required>
			</div>
			<input type="hidden" name="type" value="login">

			<div class="text-center mb-3">
				<a href="registration.php?on=forgot" class="link-green">Forgot Password?</a>
			</div>

			<button class="btn btn-custom w-100 mb-3" type="submit">LOG IN</button>

			<div class="text-center">
				<strong>Or</strong>
			</div>
			<div class="text-center mt-3">
				Don't have an account? <a href="registration.php?on=reg" class="link-green">SIGN UP</a>
			</div>
		</form>
	</div>
</div>