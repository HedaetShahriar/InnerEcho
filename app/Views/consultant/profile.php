<?php $pageTitle = 'Consultant Profile - InnerEcho'; $stylesheets = ['consultantProfile.css']; ?>
<?php require __DIR__ . '/../partials/consultant-nav.php'; ?>

<main>
    <div class="profile-container">
        <h2>Edit Profile</h2>
        <div id="message"></div>
        <form id="profileForm">
            <div class="profile-info">
                <div class="profile-details">
                    <span>Full Name</span>
                    <input type="text" class="editable-input" id="name" name="name" value="<?= htmlspecialchars($user['Name']) ?>" required>
                </div>
                <div class="profile-details">
                    <span>Email</span>
                    <input type="email" class="editable-input" id="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>" required>
                </div>
                <div class="profile-details">
                    <span>Phone</span>
                    <input type="text" class="editable-input" id="contact" name="contact" value="<?= htmlspecialchars($user['Contact']) ?>" required>
                </div>
                <div class="profile-details">
                    <span>Consultancy Type</span>
                    <select class="editable-input" id="consultancyType" name="consultancyType">
                        <option value="Personal" <?= ($user['consultancyType'] ?? '') === 'Personal' ? 'selected' : '' ?>>Personal</option>
                        <option value="Family" <?= ($user['consultancyType'] ?? '') === 'Family' ? 'selected' : '' ?>>Family</option>
                        <option value="Online" <?= ($user['consultancyType'] ?? '') === 'Online' ? 'selected' : '' ?>>Online</option>
                    </select>
                </div>
                <div class="profile-details">
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
    fetch('/consultant/profile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            contact: document.getElementById('contact').value,
            consultancyType: document.getElementById('consultancyType').value,
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
