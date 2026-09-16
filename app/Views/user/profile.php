<?php $pageTitle = 'Profile - InnerEcho'; $stylesheets = ['userProfile.css']; ?>
<?php require __DIR__ . '/../partials/user-nav.php'; ?>

<main>
    <div class="profile-container">
        <h2>Edit Profile</h2>
        <div id="message"></div>
        <form id="profileForm">
            <div class="profile-info">
                <div>
                    <span>Full Name</span>
                    <input type="text" class="editable-input" id="name" name="name" value="<?= htmlspecialchars($user['Name']) ?>" required>
                </div>
                <div>
                    <span>Email</span>
                    <input type="email" class="editable-input" id="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>" required>
                </div>
                <div>
                    <span>Phone</span>
                    <input type="text" class="editable-input" id="contact" name="contact" value="<?= htmlspecialchars($user['Contact']) ?>" required>
                </div>
                <div>
                    <span>New Password</span>
                    <input type="password" class="editable-input" id="password" name="password" placeholder="Leave blank to keep current">
                </div>
            </div>
            <button type="submit" class="submit-button">Save Changes</button>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>

<script>
document.getElementById('profileForm').onsubmit = function(e) {
    e.preventDefault();
    fetch('/user/profile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            contact: document.getElementById('contact').value,
            password: document.getElementById('password').value
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) alert('Profile updated!');
        else document.getElementById('message').innerHTML = data.message || 'Error';
    });
};
</script>
