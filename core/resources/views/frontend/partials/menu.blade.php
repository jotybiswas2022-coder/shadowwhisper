<!-- Story Progress Bar -->
<div class="story-progress" id="storyProgress" style="width: 0%;"></div>

<!-- ================= TOP NAVBAR ================= -->
<nav class="navbar navbar-expand-lg shadow-sm py-2 dark-navbar page-unfold">
    <div class="container-fluid px-3 px-lg-4">

        <!-- Decorative story elements -->
        <span class="story-decor quill">
            <i class="bi bi-incognito" style="font-size:2.5rem;"></i>
        </span>
        <span class="story-decor star-1">✦</span>
        <span class="story-decor star-2">✦</span>
        <span class="story-decor star-3">✦</span>

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center stamp-animate gap-2" href="{{ url('/') }}">
            <div class="brand-icon-wrap">
                <i class="bi bi-incognito text-white"></i>
            </div>
            <div class="d-flex flex-column">
                <span class="brand-text">ShadowWhisper</span>
                <span class="brand-tagline">Anonymous Confessions</span>
            </div>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTopNav"
                aria-controls="navbarTopNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Top Nav Links -->
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('/') ? 'active-link' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>

                <!-- Confess -->
                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('posts/create') ? 'active-link' : '' }}" href="{{ url('/posts/create') }}">
                        <i class="bi bi-mask me-1"></i> Confess
                    </a>
                </li>

                <!-- Explore -->
                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('mystories') ? 'active-link' : '' }}" href="{{ url('/mystories') }}">
                        <i class="bi bi-eye-slash me-1"></i> My Confessions
                    </a>
                </li>

                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('contact') ? 'active-link' : '' }}" href="{{ url('/contact') }}">
                        <i class="bi bi-envelope-paper me-1"></i> Contact
                    </a>
                </li>

                <!-- Divider -->
                <li class="nav-item d-none d-lg-flex align-items-center">
                    <div class="nav-divider"></div>
                </li>

                <!-- ================= AUTH ================= -->

                @auth

                    <!-- Admin Panel -->
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link top-nav-link admin-nav-link {{ request()->is('admin') ? 'active-link' : '' }}" href="{{ url('/admin') }}">
                                <i class="bi bi-shield-lock me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <!-- Logout -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn-logout w-100 text-start">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>

                @else

                    <!-- Login -->
                    <li class="nav-item">
                        <a class="nav-link top-nav-link {{ request()->is('login') ? 'active-link' : '' }}" href="{{ url('/login') }}">
                            <i class="bi bi-person-bounding-box me-1"></i> Login
                        </a>
                    </li>

                    <!-- Register -->
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link signup-btn text-center" href="{{ url('/register') }}">
                            <i class="bi bi-mask me-1"></i> Confess Anonymously
                        </a>
                    </li>

                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- ===== SCRIPTS ===== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ─── SCROLL PROGRESS BAR ─── */
    const progressBar = document.getElementById('storyProgress');
    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = pct + '%';
    });

    /* ─── PARTICLE SYSTEM ─── */
    (function () {
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        let W, H, particles = [];

        function resize() {
            W = canvas.width = window.innerWidth;
            H = canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * W;
                this.y = Math.random() * H;
                this.r = Math.random() * 1.4 + 0.3;
                this.alpha = Math.random() * 0.55 + 0.08;
                this.vx = (Math.random() - 0.5) * 0.22;
                this.vy = -(Math.random() * 0.35 + 0.08);
                this.life = 0;
                this.maxLife = Math.random() * 280 + 120;
                this.color = Math.random() > 0.55
                    ? `rgba(155, 48, 255, ${this.alpha})`
                    : `rgba(200, 170, 255, ${this.alpha * 0.6})`;
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;
                this.life++;
                if (this.life > this.maxLife || this.y < -10) this.reset();
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.fill();
            }
        }

        for (let i = 0; i < 90; i++) particles.push(new Particle());

        function loop() {
            ctx.clearRect(0, 0, W, H);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(loop);
        }
        loop();
    })();

    /* ─── NAVBAR SCROLL SHADOW ─── */
    const navbar = document.querySelector('.dark-navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            navbar.style.boxShadow = '0 4px 40px rgba(75,0,130,0.25), 0 1px 0 rgba(75,0,130,0.3)';
        } else {
            navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.6), 0 1px 0 rgba(75,0,130,0.3)';
        }
    });

    /* ─── RANDOM FLOATING CARD RE-ANIMATION ─── */
    const floatCards = document.querySelectorAll('.float-card');
    const confessions = [
        { icon: 'bi-lock-fill', text: '"I smile every day but nobody knows what\'s behind it..."' },
        { icon: 'bi-incognito', text: '"Sometimes I feel invisible even in a crowded room."' },
        { icon: 'bi-chat-quote', text: '"I never told anyone the real reason I left."' },
        { icon: 'bi-heart-half', text: '"I still love them and I hate myself for it."' },
        { icon: 'bi-eye-slash', text: '"I watch from afar, wishing I had the courage."' },
        { icon: 'bi-moon-stars', text: '"My best nights are the ones I spend alone."' },
    ];

    floatCards.forEach((card, i) => {
        setInterval(() => {
            const c = confessions[Math.floor(Math.random() * confessions.length)];
            card.querySelector('.float-card-icon').className = `bi ${c.icon} float-card-icon`;
            card.querySelector('.float-card-text').textContent = c.text;
        }, (8000 + i * 2500));
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ===== ROOT VARIABLES ===== */
        :root {
            --primary-bg: #0D0D0D;
            --accent: #4B0082;
            --accent-light: #6A0DAD;
            --accent-glow: rgba(75, 0, 130, 0.45);
            --accent-soft: rgba(75, 0, 130, 0.15);
            --text-primary: #E8E0F0;
            --text-muted: #9D8FB5;
            --border-subtle: rgba(75, 0, 130, 0.3);
            --surface: rgba(20, 10, 35, 0.85);
            --surface-hover: rgba(75, 0, 130, 0.12);
        }

        /* ===== GLOBAL RESET ===== */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--primary-bg);
            color: var(--text-primary);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }

        /* ===== STORY PROGRESS BAR ===== */
        .story-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), #9B30FF, var(--accent-light));
            z-index: 9999;
            width: 0%;
            transition: width 0.2s ease;
            box-shadow: 0 0 10px var(--accent-glow), 0 0 20px rgba(155, 48, 255, 0.3);
        }

        /* ===== PARTICLE CANVAS ===== */
        #particles-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        /* ===== DARK NAVBAR ===== */
        .dark-navbar {
            background: rgba(10, 5, 20, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-subtle);
            position: sticky;
            top: 3px;
            z-index: 1000;
            box-shadow:
                0 4px 30px rgba(0, 0, 0, 0.6),
                0 1px 0 var(--border-subtle),
                inset 0 1px 0 rgba(255,255,255,0.03);
        }

        /* ===== PAGE UNFOLD ANIMATION ===== */
        .page-unfold {
            animation: pageUnfold 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes pageUnfold {
            0% {
                opacity: 0;
                transform: translateY(-18px) scaleY(0.92);
                filter: blur(4px);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scaleY(1);
                filter: blur(0);
            }
        }

        /* ===== STORY DECOR ELEMENTS ===== */
        .story-decor {
            position: absolute;
            pointer-events: none;
            opacity: 0.18;
            color: var(--accent-light);
            user-select: none;
        }

        .story-decor.quill {
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.1rem;
            opacity: 0.07;
            animation: floatDecor 5s ease-in-out infinite;
        }

        .story-decor.star-1 {
            right: 18%;
            top: 22%;
            font-size: 0.55rem;
            animation: twinkleStar 3.2s ease-in-out infinite;
        }

        .story-decor.star-2 {
            right: 28%;
            bottom: 20%;
            font-size: 0.45rem;
            animation: twinkleStar 4.1s ease-in-out infinite 1s;
        }

        .story-decor.star-3 {
            left: 12%;
            top: 30%;
            font-size: 0.4rem;
            animation: twinkleStar 2.8s ease-in-out infinite 0.5s;
        }

        @keyframes floatDecor {
            0%, 100% { transform: translate(-50%, -50%) rotate(0deg); opacity: 0.07; }
            50% { transform: translate(-50%, -56%) rotate(8deg); opacity: 0.13; }
        }

        @keyframes twinkleStar {
            0%, 100% { opacity: 0.12; transform: scale(1); }
            50% { opacity: 0.45; transform: scale(1.5); }
        }

        /* ===== BRAND / LOGO ===== */
        .navbar-brand {
            color: var(--text-primary) !important;
            text-decoration: none;
            gap: 0.55rem;
            letter-spacing: 0.01em;
            position: relative;
        }

        .brand-icon-wrap {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            box-shadow: 0 0 14px var(--accent-glow), inset 0 1px 0 rgba(255,255,255,0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .navbar-brand:hover .brand-icon-wrap {
            box-shadow: 0 0 22px var(--accent-glow), 0 0 40px rgba(106, 13, 173, 0.3), inset 0 1px 0 rgba(255,255,255,0.15);
            transform: scale(1.06) rotate(-4deg);
        }

        .brand-text {
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: 0.04em;
            background: linear-gradient(135deg, #E8E0F0 30%, #B08AE0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-tagline {
            font-size: 0.58rem;
            color: var(--text-muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            line-height: 1;
            margin-top: 2px;
            -webkit-text-fill-color: var(--text-muted);
        }

        /* Stamp animation */
        .stamp-animate {
            animation: stampIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s both;
        }

        @keyframes stampIn {
            0% { opacity: 0; transform: scale(0.7) rotate(-6deg); }
            100% { opacity: 1; transform: scale(1) rotate(0deg); }
        }

        /* ===== NAV LINKS ===== */
        .top-nav-link {
            color: var(--text-muted) !important;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.48rem 0.85rem !important;
            border-radius: 8px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            letter-spacing: 0.01em;
            position: relative;
            white-space: nowrap;
        }

        .top-nav-link::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 60%;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
            border-radius: 2px;
            transition: transform 0.3s ease;
        }

        .top-nav-link:hover {
            color: var(--text-primary) !important;
            background: var(--surface-hover);
        }

        .top-nav-link:hover::after {
            transform: translateX(-50%) scaleX(1);
        }

        /* Active link */
        .active-link {
            color: #C084FC !important;
            background: var(--accent-soft) !important;
        }

        .active-link::after {
            transform: translateX(-50%) scaleX(1) !important;
        }

        /* ===== NAVBAR TOGGLER ===== */
        .navbar-toggler {
            color: var(--text-muted);
            border: 1px solid var(--border-subtle) !important;
            border-radius: 8px !important;
            padding: 0.35rem 0.6rem;
            transition: all 0.25s ease;
        }

        .navbar-toggler:hover {
            background: var(--surface-hover);
            border-color: var(--accent-light) !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(176,138,224,0.85)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ===== ADMIN BADGE LINK ===== */
        .admin-nav-link {
            color: #FFD700 !important;
            background: rgba(255, 215, 0, 0.07) !important;
        }

        .admin-nav-link:hover {
            background: rgba(255, 215, 0, 0.13) !important;
        }

        /* ===== LOGOUT BUTTON ===== */
        .btn-logout {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.48rem 0.85rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            letter-spacing: 0.01em;
        }

        .btn-logout:hover {
            color: #FF8A8A;
            background: rgba(255, 100, 100, 0.09);
        }

        /* ===== SIGNUP / CTA BUTTON ===== */
        .signup-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff !important;
            font-size: 0.845rem;
            font-weight: 600;
            padding: 0.45rem 1.1rem !important;
            border-radius: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            letter-spacing: 0.02em;
            box-shadow: 0 0 16px var(--accent-glow), inset 0 1px 0 rgba(255,255,255,0.12);
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .signup-btn:hover {
            box-shadow: 0 0 28px var(--accent-glow), 0 0 50px rgba(106, 13, 173, 0.25);
            transform: translateY(-1px);
            background: linear-gradient(135deg, var(--accent-light), #9B30FF);
        }

        .signup-btn:active {
            transform: translateY(0);
        }

        /* ===== DIVIDER IN NAV ===== */
        .nav-divider {
            width: 1px;
            height: 22px;
            background: var(--border-subtle);
            margin: 0 0.25rem;
        }

        /* ===== MOBILE COLLAPSE STYLES ===== */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(10, 5, 20, 0.97);
                border: 1px solid var(--border-subtle);
                border-radius: 12px;
                margin-top: 0.6rem;
                padding: 0.75rem;
                backdrop-filter: blur(20px);
                animation: dropDown 0.25s ease both;
            }

            @keyframes dropDown {
                from { opacity: 0; transform: translateY(-8px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .navbar-nav {
                gap: 0.2rem;
            }

            .top-nav-link, .btn-logout {
                padding: 0.6rem 1rem !important;
                border-radius: 8px;
            }

            .signup-btn {
                margin-top: 0.4rem;
                justify-content: center;
                border-radius: 10px;
            }

            .nav-divider {
                display: none;
            }

            .story-decor.star-1,
            .story-decor.star-2,
            .story-decor.star-3 {
                display: none;
            }
        }

        /* ===== DEMO CONTENT BELOW NAVBAR ===== */
        .demo-hero {
            position: relative;
            z-index: 1;
            min-height: calc(100vh - 65px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 3rem 1.5rem;
            overflow: hidden;
        }

        .hero-glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        .orb-1 {
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(75,0,130,0.35) 0%, transparent 70%);
            top: -80px;
            left: 50%;
            transform: translateX(-50%);
            animation: orbPulse 6s ease-in-out infinite;
        }

        .orb-2 {
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(106,13,173,0.2) 0%, transparent 70%);
            bottom: 10%;
            right: 10%;
            animation: orbPulse 8s ease-in-out infinite 2s;
        }

        @keyframes orbPulse {
            0%, 100% { opacity: 0.7; transform: scale(1) translateX(-50%); }
            50% { opacity: 1; transform: scale(1.08) translateX(-50%); }
        }

        .orb-2 { animation: orbPulse2 8s ease-in-out infinite 2s; }
        @keyframes orbPulse2 {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.1); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--accent-soft);
            border: 1px solid var(--border-subtle);
            color: #C084FC;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            margin-bottom: 1.5rem;
            animation: fadeSlideUp 0.6s ease 0.4s both;
        }

        .hero-title {
            font-size: clamp(2.2rem, 6vw, 4rem);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #ffffff 0%, #C084FC 50%, #9B30FF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            animation: fadeSlideUp 0.6s ease 0.55s both;
        }

        .hero-sub {
            font-size: 1.05rem;
            color: var(--text-muted);
            max-width: 500px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            animation: fadeSlideUp 0.6s ease 0.7s both;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeSlideUp 0.6s ease 0.85s both;
        }

        .btn-confess {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            cursor: pointer;
            box-shadow: 0 0 24px var(--accent-glow);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-confess:hover {
            box-shadow: 0 0 40px var(--accent-glow), 0 0 70px rgba(106,13,173,0.2);
            transform: translateY(-2px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-subtle);
            padding: 0.75rem 1.8rem;
            border-radius: 25px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-ghost:hover {
            border-color: var(--accent-light);
            color: var(--text-primary);
            background: var(--surface-hover);
        }

        /* floating confession cards */
        .float-card {
            position: absolute;
            background: rgba(15, 8, 30, 0.75);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            padding: 0.85rem 1.1rem;
            backdrop-filter: blur(12px);
            max-width: 200px;
            pointer-events: none;
            opacity: 0;
        }

        .float-card-text {
            font-size: 0.72rem;
            color: var(--text-muted);
            line-height: 1.5;
            font-style: italic;
        }

        .float-card-icon {
            font-size: 0.9rem;
            color: var(--accent-light);
            margin-bottom: 0.4rem;
            display: block;
        }

        .float-card-1 {
            left: 5%;
            top: 22%;
            animation: floatCard 8s ease-in-out 1.2s infinite;
        }

        .float-card-2 {
            right: 4%;
            top: 30%;
            animation: floatCard 9s ease-in-out 2s infinite;
        }

        .float-card-3 {
            left: 8%;
            bottom: 18%;
            animation: floatCard 7.5s ease-in-out 0.8s infinite;
        }

        @keyframes floatCard {
            0% { opacity: 0; transform: translateY(12px); }
            15% { opacity: 1; }
            80% { opacity: 0.85; }
            100% { opacity: 0; transform: translateY(-12px); }
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrolling ticker */
        .confession-ticker {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(10, 5, 20, 0.9);
            border-top: 1px solid var(--border-subtle);
            padding: 0.5rem 0;
            overflow: hidden;
            z-index: 900;
        }

        .ticker-label {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            z-index: 2;
            white-space: nowrap;
        }

        .ticker-track {
            display: flex;
            gap: 3rem;
            animation: tickerMove 28s linear infinite;
            padding-left: 160px;
            white-space: nowrap;
        }

        .ticker-item {
            font-size: 0.78rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ticker-item i {
            color: var(--accent-light);
            font-size: 0.7rem;
        }

        @keyframes tickerMove {
            0% { transform: translateX(100vw); }
            100% { transform: translateX(-100%); }
        }

        /* Mask icon pulse */
        .mask-pulse {
            display: inline-block;
            animation: maskPulse 3s ease-in-out infinite;
        }

        @keyframes maskPulse {
            0%, 100% { filter: drop-shadow(0 0 4px var(--accent-glow)); }
            50% { filter: drop-shadow(0 0 14px rgba(155, 48, 255, 0.7)); }
        }

        /* === CUSTOM SCROLLBAR === */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0514; }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent-light); }
    </style>