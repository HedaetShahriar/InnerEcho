<header>
    <nav class="nav-bar display-flex">
        <div class="nav-logo display-flex">
            <a href="/"><img src="/images/logo.png" alt="InnerEcho Logo" class="logo"></a>
            <h1 class="nav-title">InnerEcho</h1>
        </div>
        <ul class="nav-links display-flex">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/therapist">Therapists</a></li>
        </ul>
        <div class="nav-buttons display-flex">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/user/dashboard"><button class="button"><i class="fa-solid fa-house"></i></button></a>
                <a href="/user/profile"><button class="button"><i class="fa-solid fa-user"></i></button></a>
                <form action="/logout" method="post" style="display:inline">
                    <button type="submit" name="logout" class="button"><i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            <?php else: ?>
                <a href="/login"><button class="button">Login</button></a>
                <a href="/signup"><button class="button btn-primary">Sign Up</button></a>
            <?php endif; ?>
        </div>
    </nav>
</header>
