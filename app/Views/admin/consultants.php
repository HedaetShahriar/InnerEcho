<?php $pageTitle = 'Manage Consultants - InnerEcho'; $stylesheets = ['viewConsultant.css']; ?>
<?php require __DIR__ . '/../partials/admin-nav.php'; ?>

<div class="admin-container">
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Manage Consultants</h2>
            <a href="/admin/add-consultant" class="btn-primary">+ Add Consultant</a>
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
                <?php foreach ($consultants as $consultant): ?>
                <tr data-id="<?= $consultant['Id'] ?>">
                    <td><?= $consultant['Id'] ?></td>
                    <td contenteditable="true" data-field="name"><?= htmlspecialchars($consultant['Name']) ?></td>
                    <td contenteditable="true" data-field="email"><?= htmlspecialchars($consultant['Email']) ?></td>
                    <td contenteditable="true" data-field="contact"><?= htmlspecialchars($consultant['Contact']) ?></td>
                    <td class="action-btn">
                        <button class="save-btn" onclick="saveConsultant(<?= $consultant['Id'] ?>)"><i class="fa-solid fa-check"></i></button>
                        <button class="delete-btn" onclick="deleteConsultant(<?= $consultant['Id'] ?>)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function saveConsultant(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const data = {
        id: id,
        name: row.querySelector('[data-field="name"]').textContent.trim(),
        email: row.querySelector('[data-field="email"]').textContent.trim(),
        contact: row.querySelector('[data-field="contact"]').textContent.trim()
    };

    fetch('/admin/consultants/update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(d => { if (d.success) alert('Updated!'); });
}

function deleteConsultant(id) {
    if (!confirm('Delete this consultant?')) return;

    fetch('/admin/consultants/delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(r => r.json())
    .then(d => { if (d.success) document.querySelector(`tr[data-id="${id}"]`).remove(); });
}
</script>
