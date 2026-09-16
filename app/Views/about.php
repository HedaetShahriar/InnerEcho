<?php $pageTitle = 'About Us - InnerEcho'; $stylesheets = ['about.css']; ?>
<header>
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
    <section class="banner">
        <div class="container banner-container display-flex">
            <div class="banner-text">
                <h1 class="banner-title">About <span style="color:#EC744A;">InnerEcho</span></h1>
                <p class="banner-description">Dedicated to helping individuals achieve mental wellness through expert counseling and compassionate care.</p>
            </div>
            <div class="banner-image">
                <img src="/images/3.png" alt="About InnerEcho" class="about-img">
            </div>
        </div>
    </section>
</header>
<main>
    <section class="mission-vision text-center">
        <div class="container mission-container display-flex">
            <div class="mission">
                <h2>Our Mission</h2>
                <p>Our mission is to provide accessible, high-quality mental health support to individuals and families, empowering them to lead happier, healthier lives.</p>
            </div>
            <div class="vision">
                <h2>Our Vision</h2>
                <p>We envision a world where mental wellness is prioritized, and everyone has access to the resources they need to thrive emotionally and psychologically.</p>
            </div>
        </div>
    </section>

    <section class="our-values">
        <div class="container">
            <h2 class="title text-center">Our Core Values</h2>
            <div class="values display-flex">
                <div class="value-box">
                    <img src="/images/Emp.jpg" alt="Empathy">
                    <h3>Empathy</h3>
                    <p>We listen with compassion and provide a safe space for every individual.</p>
                </div>
                <div class="value-box">
                    <img src="/images/professionalism.png" alt="Professionalism">
                    <h3>Professionalism</h3>
                    <p>Our expert consultants ensure the highest quality care and confidentiality.</p>
                </div>
                <div class="value-box">
                    <img src="/images/growth.jpg" alt="Growth">
                    <h3>Personal Growth</h3>
                    <p>We help individuals overcome challenges and achieve self-improvement.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="Consultant">
        <h1 class="consultants-title text-center">Meet Our Experts</h1>
        <div class="Consultant-content display-flex text-center">
            <div class="Consultant1">
                <img src="/images/team-1.jpg" alt="Consultant Image" class="Consultant-img">
                <h2>Dr. John Doe</h2>
                <h3>Therapy Expert</h3>
            </div>
            <div class="Consultant2">
                <img src="/images/team-2.jpg" alt="Consultant Image" class="Consultant-img">
                <h2>Dr. Jane Doe</h2>
                <h3>Therapy Expert</h3>
            </div>
            <div class="Consultant3">
                <img src="/images/team-3.png" alt="Consultant Image" class="Consultant-img">
                <h2>Dr. John Doe</h2>
                <h3>Therapy Expert</h3>
            </div>
            <div class="Consultant4">
                <img src="/images/team-4.jpg" alt="Consultant Image" class="Consultant-img">
                <h2>Dr. Jane Doe</h2>
                <h3>Therapy Expert</h3>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
