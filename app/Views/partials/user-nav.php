<header>
    <nav class="nav-bar display-flex">
        <div class="nav-logo display-flex">
            <a href="/user/dashboard"><img src="/images/logo.png" alt="InnerEcho Logo" class="logo"></a>
            <h1 class="nav-title">InnerEcho</h1>
        </div>
        <ul class="nav-links display-flex">
            <li><a href="/user/dashboard">Home</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/therapist">Therapists</a></li>
        </ul>
        <div class="nav-buttons display-flex">
            <a href="/user/dashboard"><button class="button"><i class="fa-solid fa-bell"></i></button></a>
            <a href="/user/profile"><button class="button"><i class="fa-solid fa-user"></i></button></a>
            <form action="/logout" method="post" style="display:inline">
                <button type="submit" name="logout" class="button"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    </nav>
</header>
