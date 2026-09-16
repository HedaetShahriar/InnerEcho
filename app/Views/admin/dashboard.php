<?php $pageTitle = 'Admin Dashboard - InnerEcho'; $stylesheets = ['AdminDashboard.css']; ?>
<?php require __DIR__ . '/../partials/admin-nav.php'; ?>

<main class="dashboard-main">
    <section class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?= htmlspecialchars($_SESSION['uname']) ?></p>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <i class="fa-solid fa-users"></i>
            <h2><?= $totalUsers ?></h2>
            <p>Total Users</p>
            <a href="/admin/users">View All</a>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-user-doctor"></i>
            <h2><?= $totalConsultants ?></h2>
            <p>Total Consultants</p>
            <a href="/admin/consultants">View All</a>
        </div>
    </section>

    <section class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="actions-grid">
            <a href="/admin/add-user" class="action-card">
                <i class="fa-solid fa-user-plus"></i>
                <h3>Add User</h3>
            </a>
            <a href="/admin/add-consultant" class="action-card">
                <i class="fa-solid fa-user-doctor"></i>
                <h3>Add Consultant</h3>
            </a>
        </div>
    </section>
</main>
