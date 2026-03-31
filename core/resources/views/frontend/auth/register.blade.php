<!-- LOGIN CONTAINER -->
<div class="login-container">

    <div class="login-wrapper">

        <div class="login-card">

            <!-- Page Curl Effect -->
            <div class="page-curl"></div>

            <!-- HEADER -->
            <div class="login-header">

                <div class="edition-bar">
                    <span>
                        <i class="bi bi-globe2" style="color: var(--primary);"></i>
                        Global Writers Hub
                    </span>

                    <span id="currentDate"></span>

                    <span>
                        Est. 2025
                    </span>
                </div>

                <div class="header-icon">
                    <i class="bi bi-feather"></i>
                </div>

                <div class="masthead-title">
                    StoryNest
                </div>

                <div class="news-separator">
                    <div class="sep-line"></div>
                    <i class="bi bi-diamond-fill"></i>
                    <i class="bi bi-pen-fill" style="font-size: 8px;"></i>
                    <i class="bi bi-diamond-fill"></i>
                    <div class="sep-line"></div>
                </div>

                <span class="brand-tagline">
                    Create Your Writer's Account
                    <span class="typewriter-cursor"></span>
                </span>

            </div>

            <!-- BODY -->
            <div class="login-body">

                <div class="headline-deco">
                    <i class="bi bi-pen-fill"></i>
                    Writer Registration
                    <i class="bi bi-pen-fill"></i>
                </div>

                <!-- ✅ FORM FIX -->
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <!-- NAME -->
                    <div class="input-group-animated">
                        <label for="name" class="login-label">
                            <i class="bi bi-person"></i>
                            Pen Name
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-person-fill"></i>

                            <input
                                id="name"
                                type="text"
                                class="form-control login-input @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your pen name"
                                required
                                autofocus
                            >
                        </div>

                        @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="input-group-animated">
                        <label for="email" class="login-label">
                            <i class="bi bi-envelope"></i>
                            Email Address
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope-fill"></i>

                            <input
                                id="email"
                                type="email"
                                class="form-control login-input @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="you@storynest.com"
                                required
                            >
                        </div>

                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group-animated">
                        <label for="password" class="login-label">
                            <i class="bi bi-shield-lock"></i>
                            Password
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill"></i>

                            <input
                                id="password"
                                type="password"
                                class="form-control login-input @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="••••••••"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword('password', this)"
                            >
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="input-group-animated">
                        <label for="password-confirm" class="login-label">
                            <i class="bi bi-shield-check"></i>
                            Confirm Password
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill"></i>

                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control login-input"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword('password-confirm', this)"
                            >
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- DIVIDER -->
                    <div class="divider">
                        <span>
                            <i class="bi bi-feather" style="font-size:10px;"></i>
                            Begin Your Story
                            <i class="bi bi-feather" style="font-size:10px;"></i>
                        </span>
                    </div>

                    <!-- BUTTON -->
                    <div class="btn-wrap">
                        <button type="submit" class="login-btn">
                            <i class="bi bi-pen-fill"></i>
                            Start Writing
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="login-link">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Already have an account? Sign In
                            </a>
                        </div>
                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <div class="card-footer-stamp">
                <div class="footer-text">
                    StoryNest
                    <i class="bi bi-heart-fill"></i>
                    Crafting Stories Since 2025
                </div>
            </div>

        </div>

    </div>

</div> 

<script>
        // ===== DATE =====
        const dateEl = document.getElementById('currentDate');
        const now = new Date();
        const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
        dateEl.textContent = now.toLocaleDateString('en-US', options);

        // ===== PASSWORD TOGGLE =====
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye-slash';
            }
        }

        // ===== INK PARTICLE CANVAS =====
        const canvas = document.getElementById('inkCanvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        class InkParticle {
            constructor() {
                this.reset();
            }

            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 0.5;
                this.speedX = (Math.random() - 0.5) * 0.3;
                this.speedY = (Math.random() - 0.5) * 0.3;
                this.opacity = Math.random() * 0.15 + 0.02;
                this.maxOpacity = this.opacity;
                this.life = Math.random() * 300 + 100;
                this.maxLife = this.life;
                this.hue = 45 + Math.random() * 10;
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                this.life--;

                const lifeRatio = this.life / this.maxLife;
                this.opacity = this.maxOpacity * Math.sin(lifeRatio * Math.PI);

                if (this.life <= 0 || this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) {
                    this.reset();
                }
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = `hsla(${this.hue}, 90%, 55%, ${this.opacity})`;
                ctx.fill();
            }
        }

        const particles = [];
        for (let i = 0; i < 60; i++) {
            particles.push(new InkParticle());
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animateParticles);
        }
        animateParticles();

        // ===== INK DROP ON MOUSE MOVE =====
        let lastInkTime = 0;
        document.addEventListener('mousemove', (e) => {
            const now = Date.now();
            if (now - lastInkTime < 80) return;
            lastInkTime = now;

            const drop = document.createElement('div');
            drop.className = 'ink-drop';
            drop.style.left = e.clientX + 'px';
            drop.style.top = e.clientY + 'px';
            document.body.appendChild(drop);

            setTimeout(() => drop.remove(), 1000);
        });

        // ===== STARDUST AROUND CARD =====
        const card = document.querySelector('.login-card');
        function createStardust() {
            const rect = card.getBoundingClientRect();
            const dust = document.createElement('div');
            dust.className = 'stardust';

            const side = Math.floor(Math.random() * 4);
            let x, y;
            switch(side) {
                case 0: x = rect.left + Math.random() * rect.width; y = rect.top - 10; break;
                case 1: x = rect.right + 10; y = rect.top + Math.random() * rect.height; break;
                case 2: x = rect.left + Math.random() * rect.width; y = rect.bottom + 10; break;
                case 3: x = rect.left - 10; y = rect.top + Math.random() * rect.height; break;
            }

            dust.style.left = x + 'px';
            dust.style.top = y + 'px';
            dust.style.animationDuration = (2 + Math.random() * 3) + 's';
            document.body.appendChild(dust);

            setTimeout(() => dust.remove(), 5000);
        }

        setInterval(createStardust, 300);

        // ===== TYPEWRITER EFFECT =====
        const tagline = document.querySelector('.brand-tagline');
        const cursor = document.querySelector('.typewriter-cursor');
        const text = 'Create Your Writer\'s Account';
        tagline.textContent = '';
        tagline.appendChild(cursor);

        let charIndex = 0;
        function typeWriter() {
            if (charIndex < text.length) {
                tagline.insertBefore(document.createTextNode(text[charIndex]), cursor);
                charIndex++;
                setTimeout(typeWriter, 60 + Math.random() * 40);
            }
        }
        setTimeout(typeWriter, 1200);
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Lora:ital,wght@0,400;0,600;1,400&family=Special+Elite&display=swap" rel="stylesheet">
    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #000000;
            --primary: #facc15;
            --primary-dim: rgba(250, 204, 21, 0.15);
            --primary-glow: rgba(250, 204, 21, 0.4);
            --text: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.6);
            --card-bg: rgba(10, 10, 10, 0.85);
            --card-border: rgba(250, 204, 21, 0.25);
            --input-bg: rgba(255, 255, 255, 0.05);
            --input-border: rgba(250, 204, 21, 0.2);
        }

        body {
            font-family: 'Lora', serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
        }

        /* ===== BACKGROUND CANVAS ===== */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(250,204,21,0.03) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(250,204,21,0.04) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(250,204,21,0.02) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* ===== INK PARTICLE CANVAS ===== */
        #inkCanvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        /* ===== FLOATING STORY SNIPPETS ===== */
        .floating-snippet {
            position: fixed;
            font-family: 'Special Elite', cursive;
            font-size: 13px;
            color: rgba(250, 204, 21, 0.12);
            white-space: nowrap;
            pointer-events: none;
            z-index: 1;
            text-shadow: 0 0 20px rgba(250, 204, 21, 0.05);
            animation: floatSnippet 25s linear infinite;
            padding: 8px 16px;
            border-left: 2px solid rgba(250, 204, 21, 0.08);
        }

        .floating-snippet:nth-child(1) {
            top: 8%;
            animation-duration: 28s;
            animation-delay: 0s;
            font-size: 12px;
        }
        .floating-snippet:nth-child(2) {
            top: 22%;
            animation-duration: 32s;
            animation-delay: -5s;
            font-size: 14px;
        }
        .floating-snippet:nth-child(3) {
            top: 38%;
            animation-duration: 26s;
            animation-delay: -10s;
            font-size: 11px;
        }
        .floating-snippet:nth-child(4) {
            top: 55%;
            animation-duration: 30s;
            animation-delay: -15s;
            font-size: 13px;
        }
        .floating-snippet:nth-child(5) {
            top: 70%;
            animation-duration: 34s;
            animation-delay: -8s;
            font-size: 12px;
        }
        .floating-snippet:nth-child(6) {
            top: 85%;
            animation-duration: 27s;
            animation-delay: -20s;
            font-size: 14px;
        }

        @keyframes floatSnippet {
            0% {
                transform: translateX(110vw) rotate(0deg);
                opacity: 0;
            }
            5% { opacity: 1; }
            90% { opacity: 1; }
            100% {
                transform: translateX(-110vw) rotate(-2deg);
                opacity: 0;
            }
        }

        /* ===== FLOATING QUILL FEATHERS ===== */
        .floating-quill {
            position: fixed;
            pointer-events: none;
            z-index: 1;
            font-size: 20px;
            color: rgba(250, 204, 21, 0.08);
            animation: quillFloat 20s ease-in-out infinite;
        }

        .floating-quill:nth-child(7)  { top: 10%; left: 5%;  animation-duration: 18s; animation-delay: 0s; }
        .floating-quill:nth-child(8)  { top: 30%; left: 90%; animation-duration: 22s; animation-delay: -4s; }
        .floating-quill:nth-child(9)  { top: 60%; left: 15%; animation-duration: 20s; animation-delay: -8s; }
        .floating-quill:nth-child(10) { top: 80%; left: 85%; animation-duration: 24s; animation-delay: -12s; }
        .floating-quill:nth-child(11) { top: 45%; left: 95%; animation-duration: 19s; animation-delay: -6s; }

        @keyframes quillFloat {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.06;
            }
            25% {
                transform: translateY(-30px) rotate(15deg) scale(1.1);
                opacity: 0.12;
            }
            50% {
                transform: translateY(-10px) rotate(-10deg) scale(0.95);
                opacity: 0.08;
            }
            75% {
                transform: translateY(-40px) rotate(8deg) scale(1.05);
                opacity: 0.1;
            }
        }

        /* ===== WRITING LINE ANIMATION (Background) ===== */
        .writing-lines {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .writing-line {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(250,204,21,0.06), transparent);
            animation: writeLine 8s ease-in-out infinite;
        }

        .writing-line:nth-child(1) { top: 15%; width: 60%; left: 20%; animation-delay: 0s; }
        .writing-line:nth-child(2) { top: 25%; width: 50%; left: 25%; animation-delay: 1s; }
        .writing-line:nth-child(3) { top: 35%; width: 70%; left: 15%; animation-delay: 2s; }
        .writing-line:nth-child(4) { top: 50%; width: 45%; left: 30%; animation-delay: 3s; }
        .writing-line:nth-child(5) { top: 65%; width: 55%; left: 22%; animation-delay: 4s; }
        .writing-line:nth-child(6) { top: 75%; width: 40%; left: 35%; animation-delay: 5s; }
        .writing-line:nth-child(7) { top: 88%; width: 65%; left: 18%; animation-delay: 6s; }

        @keyframes writeLine {
            0% { transform: scaleX(0); transform-origin: left; opacity: 0; }
            30% { transform: scaleX(1); transform-origin: left; opacity: 1; }
            50% { transform: scaleX(1); transform-origin: left; opacity: 0.5; }
            70% { transform: scaleX(0); transform-origin: right; opacity: 0; }
            100% { transform: scaleX(0); transform-origin: right; opacity: 0; }
        }

        /* ===== LOGIN CONTAINER ===== */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            perspective: 1200px;
        }

        .login-wrapper {
            animation: cardReveal 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            opacity: 0;
        }

        @keyframes cardReveal {
            0% {
                opacity: 0;
                transform: translateY(40px) rotateX(8deg) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) rotateX(0) scale(1);
            }
        }

        /* ===== CARD ===== */
        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(20px);
            box-shadow:
                0 0 60px rgba(250, 204, 21, 0.05),
                0 25px 60px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(250, 204, 21, 0.1);
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -1px; left: -1px;
            right: -1px; bottom: -1px;
            border-radius: 17px;
            background: linear-gradient(135deg, rgba(250,204,21,0.3), transparent 40%, transparent 60%, rgba(250,204,21,0.15));
            z-index: -1;
            opacity: 0;
            animation: borderGlow 4s ease-in-out infinite;
        }

        @keyframes borderGlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.7; }
        }

        /* ===== HEADER ===== */
        .login-header {
            padding: 32px 32px 20px;
            text-align: center;
            position: relative;
            background: linear-gradient(180deg, rgba(250,204,21,0.06) 0%, transparent 100%);
            border-bottom: 1px solid rgba(250,204,21,0.1);
        }

        .edition-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(250,204,21,0.08);
            font-family: 'Lora', serif;
        }

        .edition-bar span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .edition-bar i {
            color: var(--primary);
            font-size: 11px;
        }

        .header-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #d4a90a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #000;
            box-shadow:
                0 0 30px rgba(250, 204, 21, 0.3),
                0 0 60px rgba(250, 204, 21, 0.1);
            animation: iconPulse 3s ease-in-out infinite;
            position: relative;
        }

        .header-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid rgba(250,204,21,0.2);
            animation: iconRing 3s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); box-shadow: 0 0 30px rgba(250,204,21,0.3); }
            50% { transform: scale(1.05); box-shadow: 0 0 45px rgba(250,204,21,0.5); }
        }

        @keyframes iconRing {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.3); opacity: 0; }
        }

        .masthead-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            color: var(--primary);
            letter-spacing: 3px;
            text-transform: uppercase;
            text-shadow: 0 0 30px rgba(250,204,21,0.2);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .news-separator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 12px 0;
        }

        .sep-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            opacity: 0.3;
        }

        .news-separator i {
            color: var(--primary);
            font-size: 6px;
            opacity: 0.5;
            animation: sepSpin 6s linear infinite;
        }

        .news-separator i:nth-child(3) {
            animation-delay: -2s;
        }
        .news-separator i:nth-child(5) {
            animation-delay: -4s;
        }

        @keyframes sepSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .brand-tagline {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            font-style: italic;
            color: var(--text-muted);
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }

        /* ===== TYPEWRITER CURSOR ===== */
        .typewriter-cursor {
            display: inline-block;
            width: 2px;
            height: 16px;
            background: var(--primary);
            margin-left: 3px;
            animation: cursorBlink 0.8s step-end infinite;
            vertical-align: middle;
        }

        @keyframes cursorBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* ===== BODY ===== */
        .login-body {
            padding: 28px 32px 24px;
        }

        .headline-deco {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .headline-deco i {
            font-size: 12px;
            animation: penWrite 2s ease-in-out infinite;
        }

        @keyframes penWrite {
            0%, 100% { transform: rotate(0deg) translateY(0); }
            25% { transform: rotate(-15deg) translateY(-2px); }
            75% { transform: rotate(10deg) translateY(1px); }
        }

        /* ===== FORM GROUPS ===== */
        .input-group-animated {
            margin-bottom: 20px;
            animation: inputSlideIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .input-group-animated:nth-child(1) { animation-delay: 0.3s; }
        .input-group-animated:nth-child(2) { animation-delay: 0.45s; }
        .input-group-animated:nth-child(3) { animation-delay: 0.6s; }
        .input-group-animated:nth-child(4) { animation-delay: 0.75s; }

        @keyframes inputSlideIn {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
            font-family: 'Lora', serif;
        }

        .login-label i {
            font-size: 13px;
        }

        .input-icon-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrap > i:first-child {
            position: absolute;
            left: 14px;
            font-size: 16px;
            color: rgba(250,204,21,0.4);
            transition: color 0.3s, transform 0.3s;
            z-index: 2;
        }

        .input-icon-wrap:focus-within > i:first-child {
            color: var(--primary);
            transform: scale(1.15);
        }

        .login-input {
            width: 100%;
            padding: 14px 48px 14px 44px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            color: var(--text);
            font-size: 14px;
            font-family: 'Lora', serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .login-input::placeholder {
            color: rgba(255,255,255,0.25);
            font-style: italic;
        }

        .login-input:focus {
            border-color: var(--primary);
            background: rgba(250,204,21,0.05);
            box-shadow:
                0 0 0 3px rgba(250,204,21,0.1),
                0 0 20px rgba(250,204,21,0.05);
        }

        /* ===== INK WRITING ANIMATION ON FOCUS ===== */
        .login-input:focus {
            animation: inkFocus 0.4s ease-out;
        }

        @keyframes inkFocus {
            0% { box-shadow: 0 0 0 0 rgba(250,204,21,0.4); }
            50% { box-shadow: 0 0 0 6px rgba(250,204,21,0.15); }
            100% { box-shadow: 0 0 0 3px rgba(250,204,21,0.1); }
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: rgba(250,204,21,0.4);
            cursor: pointer;
            font-size: 16px;
            transition: color 0.3s, transform 0.3s;
            z-index: 2;
            padding: 4px;
        }

        .password-toggle:hover {
            color: var(--primary);
            transform: scale(1.15);
        }

        .invalid-feedback {
            display: block;
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 6px;
            padding-left: 4px;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0 4px;
            gap: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(250,204,21,0.2), transparent);
        }

        .divider span {
            font-size: 10px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-family: 'Playfair Display', serif;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .divider span i {
            color: var(--primary);
        }

        /* ===== BUTTON ===== */
        .btn-wrap {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .login-btn {
            width: 100%;
            padding: 15px 24px;
            background: linear-gradient(135deg, var(--primary), #d4a90a);
            color: #000;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.6s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 30px rgba(250,204,21,0.35),
                0 0 60px rgba(250,204,21,0.15);
        }

        .login-btn:active {
            transform: translateY(0) scale(0.98);
        }

        /* ===== QUILL TRAIL on button hover ===== */
        .login-btn::after {
            content: '\F4C9';
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 20px;
            font-size: 16px;
            opacity: 0;
            transform: translateX(-10px) rotate(-30deg);
            transition: all 0.4s ease;
        }

        .login-btn:hover::after {
            opacity: 0.5;
            transform: translateX(0) rotate(0deg);
        }

        .login-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
            font-family: 'Lora', serif;
        }

        .login-link:hover {
            color: var(--primary);
            text-shadow: 0 0 15px rgba(250,204,21,0.3);
        }

        .login-link i {
            transition: transform 0.3s;
        }

        .login-link:hover i {
            transform: translateX(3px);
        }

        /* ===== FOOTER ===== */
        .card-footer-stamp {
            padding: 16px 32px;
            text-align: center;
            border-top: 1px solid rgba(250,204,21,0.08);
            background: rgba(250,204,21,0.02);
        }

        .footer-text {
            font-size: 11px;
            color: var(--text-muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-text i {
            color: var(--primary);
            font-size: 10px;
            animation: heartBeat 2s ease-in-out infinite;
        }

        @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            15% { transform: scale(1.25); }
            30% { transform: scale(1); }
            45% { transform: scale(1.15); }
            60% { transform: scale(1); }
        }

        /* ===== STORY PAGE TURN EFFECT ===== */
        .login-card {
            position: relative;
        }

        .page-curl {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, transparent 50%, rgba(250,204,21,0.08) 50%);
            border-radius: 0 0 16px 0;
            pointer-events: none;
            transition: all 0.4s ease;
        }

        .login-card:hover .page-curl {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, transparent 50%, rgba(250,204,21,0.12) 50%);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 520px) {
            body { padding: 20px 12px; }

            .login-header { padding: 24px 20px 16px; }
            .login-body { padding: 20px 20px 16px; }
            .card-footer-stamp { padding: 12px 20px; }

            .masthead-title { font-size: 26px; letter-spacing: 2px; }

            .edition-bar { font-size: 8px; }

            .header-icon {
                width: 56px;
                height: 56px;
                font-size: 24px;
            }

            .floating-snippet { font-size: 10px; }
        }

        /* ===== SCROLL INK TRAIL ===== */
        .ink-drop {
            position: fixed;
            width: 4px;
            height: 4px;
            background: var(--primary);
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            z-index: 999;
            animation: inkDrop 1s ease-out forwards;
        }

        @keyframes inkDrop {
            0% {
                transform: scale(0);
                opacity: 0.6;
            }
            50% {
                transform: scale(2);
                opacity: 0.3;
            }
            100% {
                transform: scale(3);
                opacity: 0;
            }
        }

        /* ===== FORM HELPERS ===== */
        .d-flex { display: flex; }
        .flex-column { flex-direction: column; }
        .gap-3 { gap: 16px; }
        .mt-3 { margin-top: 16px; }
        .text-center { text-align: center; }
        .is-invalid { border-color: #ff6b6b !important; }

        /* ===== BOOK OPEN ANIMATION ===== */
        @keyframes bookOpen {
            0% {
                clip-path: inset(0 50% 0 50%);
                opacity: 0;
            }
            60% {
                clip-path: inset(0 5% 0 5%);
                opacity: 0.8;
            }
            100% {
                clip-path: inset(0 0 0 0);
                opacity: 1;
            }
        }

        .login-body form {
            animation: bookOpen 1s ease-out 0.5s forwards;
            opacity: 0;
        }

        /* ===== STARDUST around card ===== */
        .stardust {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--primary);
            border-radius: 50%;
            pointer-events: none;
            animation: starFloat 4s ease-in-out infinite;
        }

        @keyframes starFloat {
            0%, 100% { opacity: 0; transform: translateY(0) scale(0.5); }
            50% { opacity: 0.6; transform: translateY(-20px) scale(1); }
        }
    </style>