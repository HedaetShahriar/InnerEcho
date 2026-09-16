<?php $pageTitle = 'Sign Up - InnerEcho'; $stylesheets = ['signupStyles.css']; ?>
<div class="container">
    <div class="illustration">
        <div class="brand">
            <img src="/images/logo.png" alt="InnerEcho">
            <span>InnerEcho</span>
        </div>
        <img class="form-pic" src="/images/sign-up.png" alt="Start your journey">
        <div class="ill-text">
            <h3>Start your journey</h3>
            <p>Join thousands building better mental wellness habits.</p>
        </div>
    </div>

    <div class="form-container">
        <h2>Create an account</h2>
        <p>Begin your path to emotional well-being today.</p>
        <div id="message"></div>

        <form id="userForm" method="post" action="/signup">
            <div class="input-group">
                <label for="fullname">Full Name <span id="ename" class="field-error"></span></label>
                <input type="text" id="fullname" name="fullname" placeholder="e.g. Jane Smith" required>
            </div>

            <div class="input-group">
                <label for="email">Email Address <span id="mail" class="field-error"></span></label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="input-group">
                <label for="contact">Phone Number <span id="phone" class="field-error"></span></label>
                <input type="text" id="contact" name="contact" placeholder="0123456789" required>
            </div>

            <div class="input-group">
                <label for="password">Password <span id="pass" class="field-error"></span></label>
                <input type="password" id="password" name="password" placeholder="At least 4 characters" required>
            </div>

            <div class="show-password">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Show password</label>
            </div>

            <button type="submit" class="btn-signup"><span>Create Account</span></button>
        </form>

        <p class="form-footer">Already have an account? <a href="/login">Sign in</a></p>
    </div>
</div>

<script>
function togglePassword() {
    const field = document.getElementById('password');
    field.type = document.getElementById('showPassword').checked ? 'text' : 'password';
}

document.getElementById('userForm').onsubmit = function(e) {
    e.preventDefault();
    const message = document.getElementById('message');
    const fullname = document.getElementById('fullname').value.trim();
    const email = document.getElementById('email').value.trim();
    const contact = document.getElementById('contact').value.trim();
    const password = document.getElementById('password').value.trim();

    // Reset errors
    document.querySelectorAll('.field-error').forEach(el => { el.textContent = ''; });

    const namePattern = /^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/;
    if (!namePattern.test(fullname)) {
        document.getElementById('ename').textContent = 'Enter a valid name';
        return;
    }

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        document.getElementById('mail').textContent = 'Enter a valid email';
        return;
    }

    const phonePattern = /^[0-9]{8,12}$/;
    if (!phonePattern.test(contact)) {
        document.getElementById('phone').textContent = 'Enter a valid phone number';
        return;
    }

    if (password.length < 4) {
        document.getElementById('pass').textContent = 'At least 4 characters';
        return;
    }

    fetch('/signup', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(this)).toString()
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/login';
        } else {
            message.textContent = data.message || 'Failed to create account';
            message.className = 'error';
        }
    })
    .catch(() => {
        message.textContent = 'Request failed. Please try again.';
        message.className = 'error';
    });
};
</script>
