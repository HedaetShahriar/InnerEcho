<?php $pageTitle = 'Consultant Dashboard - InnerEcho'; $stylesheets = ['consultantDashboard.css']; ?>
<?php require __DIR__ . '/../partials/consultant-nav.php'; ?>

<div class="consultant-container">
    <h1 class="section-title">Consultant Dashboard</h1>
    <p style="text-align: center; color: #666;">Welcome, <?= htmlspecialchars($user['Name']) ?></p>

    <div class="requests-section">
        <h2 class="section-title">Appointment Requests</h2>

        <?php if (empty($appointments)): ?>
            <div class="no-request">No appointment requests yet.</div>
        <?php else: ?>
            <?php foreach ($appointments as $apt): ?>
            <div class="request-card" data-id="<?= $apt['id'] ?>">
                <div class="request-info">
                    <h3><?= htmlspecialchars($apt['user_name']) ?></h3>
                    <p>Email: <?= htmlspecialchars($apt['user_email']) ?></p>
                    <p>Day: <?= htmlspecialchars($apt['preferred_day']) ?></p>
                    <p>Time: <?= htmlspecialchars($apt['preferred_time']) ?></p>
                    <p>Status: <span class="status-<?= $apt['status'] ?>"><?= ucfirst($apt['status']) ?></span></p>
                </div>
                <div class="request-actions">
                    <?php if ($apt['status'] === 'pending'): ?>
                        <button class="accept-btn" onclick="acceptAppointment(<?= $apt['id'] ?>)">Accept</button>
                        <button class="reject-btn" onclick="rejectAppointment(<?= $apt['id'] ?>)">Reject</button>
                    <?php else: ?>
                        <span>—</span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function acceptAppointment(id) {
    const date = prompt('Enter appointment date (YYYY-MM-DD):', new Date().toISOString().split('T')[0]);
    if (!date) return;

    fetch('/consultant/appointment/accept', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, date: date })
    })
    .then(r => r.json())
    .then(data => { if (data.success) location.reload(); });
}

function rejectAppointment(id) {
    if (!confirm('Reject this appointment?')) return;
    fetch('/consultant/appointment/reject', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(r => r.json())
    .then(data => { if (data.success) location.reload(); });
}
</script>
