<style>
    .login-card {
        max-width: 500px;
        width: 100%;
        padding: 30px;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .button-login {
        background-color: #28a745;
        border: none;
        width: 100%;
    }

    .button-login:hover {
        background-color: #218838;
    }

    .account-check a {
        color: #28a745;
    }

    .account-check a:hover {
        text-decoration: underline;
    }

    .min-vh-100 {
        min-height: 100vh;
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
    <div class="login-card">
        <form method="post" action="password-reset.php">
            <h1 class="text-center mb-4 text-success">Reset Password</h1>
            <hr>

            <input type="hidden" name="reset-password" value="true">
            <input type="hidden" name="email" value="<?php echo (isset($_GET['email']) ? $_GET['email'] : ''); ?>" />

            <div class="mb-3">
                <input class="form-control" type="text" name="code" placeholder="Enter the code" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="new-password" placeholder="Enter your new password"
                    required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="confirm-password"
                    placeholder="Confirm your new password" required>
            </div>

            <button class="btn button-login mb-3" type="submit">RESET PASSWORD</button>

            <div class="text-center mt-3">
                <a href="registration.php?on=login" class="account-check">Back to Login</a>
            </div>
        </form>
    </div>
</div>