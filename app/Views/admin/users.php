<?php $pageTitle = 'Manage Users - InnerEcho'; $stylesheets = ['viewUser.css']; ?>
<?php require __DIR__ . '/../partials/admin-nav.php'; ?>

<div class="admin-container">
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Manage Users</h2>
            <a href="/admin/add-user" class="btn-primary">+ Add User</a>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr data-id="<?= $user['Id'] ?>">
                    <td><?= $user['Id'] ?></td>
                    <td contenteditable="true" data-field="name"><?= htmlspecialchars($user['Name']) ?></td>
                    <td contenteditable="true" data-field="email"><?= htmlspecialchars($user['Email']) ?></td>
                    <td contenteditable="true" data-field="contact"><?= htmlspecialchars($user['Contact']) ?></td>
                    <td class="action-btn">
                        <button class="save-btn" onclick="saveUser(<?= $user['Id'] ?>)"><i class="fa-solid fa-check"></i></button>
                        <button class="delete-btn" onclick="deleteUser(<?= $user['Id'] ?>)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function saveUser(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const data = {
        id: id,
        name: row.querySelector('[data-field="name"]').textContent.trim(),
        email: row.querySelector('[data-field="email"]').textContent.trim(),
        contact: row.querySelector('[data-field="contact"]').textContent.trim()
    };

    fetch('/admin/users/update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(d => { if (d.success) alert('Updated!'); });
}

function deleteUser(id) {
    if (!confirm('Delete this user?')) return;

    fetch('/admin/users/delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(r => r.json())
    .then(d => { if (d.success) document.querySelector(`tr[data-id="${id}"]`).remove(); });
}
</script>
