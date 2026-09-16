<?php $pageTitle = 'Add User - InnerEcho'; $stylesheets = ['addUser.css']; ?>
<?php require __DIR__ . '/../partials/admin-nav.php'; ?>

<div class="container">
    <div class="form-container">
        <h2>Add New User</h2>
        <div id="message"></div>
        <form id="addUserForm">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <label for="contact">Phone Number</label>
            <input type="text" id="contact" name="contact" placeholder="Enter phone number" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <button type="submit">Add User</button>
        </form>
        <p><a href="/admin/users">Back to Users</a></p>
    </div>
</div>

<script>
document.getElementById('addUserForm').onsubmit = function(e) {
    e.preventDefault();
    fetch('/admin/add-user', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(this)).toString()
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/admin/users';
        } else {
            document.getElementById('message').innerHTML = data.message || 'Error adding user';
        }
    });
};
</script>
