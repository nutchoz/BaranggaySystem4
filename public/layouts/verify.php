<div class="register">
    <div class="register-card">
        <form method="post" action="redirect.php"">
            <h1 class=" top">Verify Account</h1>
            <hr class="line">

            <input class="input-register" type="email" name="email" placeholder="Email" required>
            <input class="input-register" type="text" name="code" placeholder="Enter code" required>
            <input type="hidden" name="type" value="verify">
            <button class="button-register" type="submit">VERIFY</button>

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