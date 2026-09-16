<?php $pageTitle = 'Login - InnerEcho'; $stylesheets = ['loginStyles.css']; ?>
<div class="container">
    <div class="form-section">
        <div class="brand">
            <img src="/images/logo.png" alt="InnerEcho">
            <span>InnerEcho</span>
        </div>
        <h1>Welcome back</h1>
        <p class="subtitle">Don't have an account yet? <a href="/signup">Create one</a></p>

        <?php if (!empty($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="/login">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required autocomplete="username">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                <button type="button" class="password-toggle" onclick="togglePassword()">Show</button>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Keep me logged in
                </label>
            </div>

            <button type="submit" class="btn-login"><span>Sign In</span></button>
        </form>
    </div>

    <div class="image-section">
        <img src="/images/login.png" alt="Welcome back to InnerEcho">
        <div class="image-text">
            <h3>Your safe space awaits</h3>
            <p>Continue your journey to emotional well-being.</p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const field = document.getElementById('password');
    const btn = document.querySelector('.password-toggle');
    if (field.type === 'password') {
        field.type = 'text';
        btn.textContent = 'Hide';
    } else {
        field.type = 'password';
        btn.textContent = 'Show';
    }
}
</script>
