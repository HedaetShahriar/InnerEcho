<?php $pageTitle = 'Find a Therapist - InnerEcho'; $stylesheets = ['therapist.css']; ?>
<header class="header">
    <nav class="nav-bar display-flex">
        <div class="nav-logo display-flex">
            <a href="/"><img src="/images/logo.png" alt="InnerEcho Logo" class="logo"></a>
            <h1 class="nav-title">InnerEcho</h1>
        </div>
        <ul class="nav-links display-flex">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/therapist">Services</a></li>
        </ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/user/dashboard"><button class="btn-primary">Dashboard</button></a>
        <?php else: ?>
            <a href="/login"><button class="btn-primary">Login</button></a>
        <?php endif; ?>
    </nav>
    <h1>Find a Therapist</h1>
    <p>Search and connect with the best therapists for your needs.</p>
</header>

<section class="search-filter">
    <input type="text" placeholder="Search by name or type..." class="search-bar" id="searchInput">
    <select class="filter" id="filterType">
        <option value="">Session Type</option>
        <option value="Online">Online</option>
        <option value="Family">Family</option>
        <option value="Personal">Personal</option>
    </select>
    <button class="btn-search" id="search-btn">Search</button>
</section>

<section class="therapist-list" id="therapistList">
    <?php foreach ($therapists as $t): ?>
    <div class="therapist-card" data-name="<?= strtolower(htmlspecialchars($t['Name'])) ?>" data-type="<?= htmlspecialchars($t['consultancyType'] ?? '') ?>">
        <img src="/<?= htmlspecialchars($t['image'] ?? 'images/profile.jpg') ?>" alt="Therapist" class="therapist-img">
        <h2><?= htmlspecialchars($t['Name']) ?></h2>
        <p><?= htmlspecialchars($t['consultancyType'] ?? 'Personal') ?></p>
        <a href="/login"><button class="btn-book">Book Appointment</button></a>
    </div>
    <?php endforeach; ?>
</section>

<script>
document.getElementById('search-btn').addEventListener('click', function() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const type = document.getElementById('filterType').value;

    document.querySelectorAll('.therapist-card').forEach(card => {
        const name = card.dataset.name;
        const cardType = card.dataset.type;
        const matchName = !query || name.includes(query);
        const matchType = !type || cardType === type;
        card.style.display = (matchName && matchType) ? '' : 'none';
    });
});
</script>

<?php require __DIR__ . '/partials/footer.php'; ?>
