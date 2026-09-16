<?php $pageTitle = 'Add Consultant - InnerEcho'; $stylesheets = ['addUser.css']; ?>
<?php require __DIR__ . '/../partials/admin-nav.php'; ?>

<div class="container">
    <div class="form-container">
        <h2>Add New Consultant</h2>
        <div id="message"></div>
        <form id="addConsultantForm">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <label for="contact">Phone Number</label>
            <input type="text" id="contact" name="contact" placeholder="Enter phone number" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="consultancyType">Consultancy Type</label>
            <select id="consultancyType" name="consultancyType" required>
                <option value="Personal">Personal</option>
                <option value="Family">Family</option>
                <option value="Online">Online</option>
            </select>

            <button type="submit">Add Consultant</button>
        </form>
        <p><a href="/admin/consultants">Back to Consultants</a></p>
    </div>
</div>

<script>
document.getElementById('addConsultantForm').onsubmit = function(e) {
    e.preventDefault();
    fetch('/admin/add-consultant', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(this)).toString()
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/admin/consultants';
        } else {
            document.getElementById('message').innerHTML = data.message || 'Error adding consultant';
        }
    });
};
</script>
