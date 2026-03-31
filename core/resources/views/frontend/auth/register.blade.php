 <!-- ── BACKGROUND SCENE ────────────────────────────────── -->
    <div class="bg-scene">
        <div class="bg-blob b1"></div>
        <div class="bg-blob b2"></div>
        <div class="bg-blob b3"></div>
    </div>
    <div class="grid-overlay"></div>
    <div class="scanlines"></div>
    <div class="veil-overlay"></div>

    <!-- Ghost mask icons floating -->
    <div class="ghost-masks" id="ghostMasks"></div>

    <!-- ── CONFESSION TICKER ───────────────────────────────── -->
    <div class="confession-ticker">
        <div class="ticker-label">
            <i class="bi bi-incognito"></i>
            Live Whispers
        </div>
        <div style="overflow:hidden; flex:1; display:flex; align-items:center;">
            <div class="ticker-track" id="tickerTrack">
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I've been pretending to be okay for so long, I forgot what real feels like." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "Sometimes I disappear just to see if anyone notices." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I deleted three years of my work because I was afraid it was never good enough." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "The version of me people love doesn't actually exist." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I forgave everyone except myself." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "My silence is the loudest thing I've ever said." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I keep secrets even from the darkness." <span class="ticker-dot">•</span></span>
                <!-- duplicate for seamless loop -->
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I've been pretending to be okay for so long, I forgot what real feels like." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "Sometimes I disappear just to see if anyone notices." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I deleted three years of my work because I was afraid it was never good enough." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "The version of me people love doesn't actually exist." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I forgave everyone except myself." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "My silence is the loudest thing I've ever said." <span class="ticker-dot">•</span></span>
                <span class="ticker-item"><i class="bi bi-chat-square-dots-fill"></i> "I keep secrets even from the darkness." <span class="ticker-dot">•</span></span>
            </div>
        </div>
    </div>

    <!-- ════════════════════════════════════════════════════════
         LOGIN CONTAINER
    ════════════════════════════════════════════════════════ -->
    <div class="login-container">

        <div class="login-wrapper">

            <div class="login-card">

                <!-- Top glow line -->
                <div class="card-top-glow"></div>

                <!-- Corner shadow -->
                <div class="shadow-corner"></div>

                <!-- ── HEADER ───────────────────────────────── -->
                <div class="login-header">

                    <div class="edition-bar">
                        <span>
                            <span class="live-dot"></span>
                            <i class="bi bi-shield-lock-fill"></i>
                            100% Anonymous
                        </span>
                        <span id="currentDate"></span>
                        <span>
                            <i class="bi bi-eye-slash-fill"></i>
                            Est. 2025
                        </span>
                    </div>

                    <div class="header-icon">
                        <i class="bi bi-incognito"></i>
                    </div>

                    <div class="masthead-title">
                        ShadowWhisper
                    </div>

                    <div class="news-separator">
                        <div class="sep-line"></div>
                        <i class="bi bi-diamond-fill"></i>
                        <i class="bi bi-moon-stars-fill" style="font-size:8px; color: var(--accent-light);"></i>
                        <i class="bi bi-diamond-fill"></i>
                        <div class="sep-line"></div>
                    </div>

                    <span class="brand-tagline">
                        <i class="bi bi-lock-fill" style="color:var(--accent); font-size:11px;"></i>
                        Create Your Anonymous Identity
                        <span class="typewriter-cursor"></span>
                    </span>

                </div>

                <!-- ── BODY ─────────────────────────────────── -->
                <div class="login-body">

                    <div class="headline-deco">
                        <i class="bi bi-person-dash-fill"></i>
                        Whisper Registration
                        <i class="bi bi-person-dash-fill"></i>
                    </div>

                    <form method="POST" action="{{ route('register') }}" autocomplete="off">
                        <!-- @csrf (server-side template tag) -->

                        <!-- ── ALIAS ──────────────────────────── -->
                        <div class="input-group-animated">
                            <label for="name" class="login-label">
                                <i class="bi bi-person-bounding-box"></i>
                                Shadow Alias
                            </label>

                            <div class="input-icon-wrap">
                                <i class="bi bi-incognito"></i>

                                <input
                                    id="name"
                                    type="text"
                                    class="form-control login-input"
                                    name="name"
                                    placeholder="Choose your anonymous alias"
                                    required
                                    autofocus
                                >
                            </div>
                        </div>

                        <!-- ── EMAIL ──────────────────────────── -->
                        <div class="input-group-animated">
                            <label for="email" class="login-label">
                                <i class="bi bi-envelope-slash"></i>
                                Cipher Email
                            </label>

                            <div class="input-icon-wrap">
                                <i class="bi bi-envelope-fill"></i>

                                <input
                                    id="email"
                                    type="email"
                                    class="form-control login-input"
                                    name="email"
                                    placeholder="your.shadow@whisper.dark"
                                    required
                                >
                            </div>
                        </div>

                        <!-- ── PASSWORD ───────────────────────── -->
                        <div class="input-group-animated">
                            <label for="password" class="login-label">
                                <i class="bi bi-shield-lock"></i>
                                Secret Passphrase
                            </label>

                            <div class="input-icon-wrap">
                                <i class="bi bi-lock-fill"></i>

                                <input
                                    id="password"
                                    type="password"
                                    class="form-control login-input"
                                    name="password"
                                    placeholder="••••••••••••"
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
                        </div>

                        <!-- ── CONFIRM PASSWORD ───────────────── -->
                        <div class="input-group-animated">
                            <label for="password-confirm" class="login-label">
                                <i class="bi bi-shield-check"></i>
                                Confirm Passphrase
                            </label>

                            <div class="input-icon-wrap">
                                <i class="bi bi-lock-fill"></i>

                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control login-input"
                                    name="password_confirmation"
                                    placeholder="••••••••••••"
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

                        <!-- ── DIVIDER ────────────────────────── -->
                        <div class="divider">
                            <span>
                                <i class="bi bi-moon-stars" style="font-size:10px;"></i>
                                Embrace The Shadows
                                <i class="bi bi-moon-stars" style="font-size:10px;"></i>
                            </span>
                        </div>

                        <!-- ── BUTTON ──────────────────────────── -->
                        <div class="btn-wrap">
                            <button type="submit" class="login-btn" id="submitBtn">
                                <i class="bi bi-incognito"></i>
                                Enter The Shadow
                            </button>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="login-link">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    Already a shadow? Sign In
                                </a>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- ── FOOTER ───────────────────────────────── -->
                <div class="card-footer-stamp">
                    <div class="footer-text">
                        ShadowWhisper
                        <i class="bi bi-heart-fill"></i>
                        Your Secrets Are Safe With The Dark · 2025
                    </div>
                </div>

            </div>

        </div>

    </div>

<!-- ── JAVASCRIPT ──────────────────────────────────────── -->
    <script>
        /* ── Date ─────────────────────────────────────────── */
        (function() {
            const el = document.getElementById('currentDate');
            if (!el) return;
            const now  = new Date();
            const opts = { month: 'short', day: 'numeric', year: 'numeric' };
            el.textContent = now.toLocaleDateString('en-US', opts);
        })();

        /* ── Password Toggle ──────────────────────────────── */
        function togglePassword(id, btn) {
            const inp  = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (!inp) return;
            if (inp.type === 'password') {
                inp.type = 'text';
                icon.className = 'bi bi-eye';
                btn.style.color = 'var(--accent-light)';
            } else {
                inp.type = 'password';
                icon.className = 'bi bi-eye-slash';
                btn.style.color = '';
            }
        }

        /* ── Ripple on Button ─────────────────────────────── */
        document.querySelectorAll('.login-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const r  = document.createElement('span');
                r.className = 'ripple';
                const rect = btn.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX - rect.left - size/2}px;top:${e.clientY - rect.top - size/2}px;`;
                btn.appendChild(r);
                setTimeout(() => r.remove(), 700);
            });
        });

        /* ── Floating Mask Icons ──────────────────────────── */
        const maskIcons   = ['bi-incognito', 'bi-eye-slash-fill', 'bi-moon-stars-fill', 'bi-shield-lock-fill', 'bi-person-dash-fill', 'bi-lock-fill', 'bi-chat-quote-fill'];
        const ghostWrap   = document.getElementById('ghostMasks');

        function spawnMask() {
            const el = document.createElement('i');
            el.className = `bi ${maskIcons[Math.floor(Math.random() * maskIcons.length)]} mask-icon`;
            el.style.left     = Math.random() * 100 + 'vw';
            el.style.bottom   = '-30px';
            el.style.fontSize = (14 + Math.random() * 22) + 'px';
            const dur = 10 + Math.random() * 14;
            el.style.animationDuration  = dur + 's';
            el.style.animationDelay     = '0s';
            ghostWrap.appendChild(el);
            setTimeout(() => el.remove(), dur * 1000);
        }

        setInterval(spawnMask, 1400);
        for (let i = 0; i < 5; i++) setTimeout(spawnMask, i * 700);

        /* ── Floating Particles ───────────────────────────── */
        const chars = ['✦','·','∙','◦','°','⊹','✧'];
        for (let i = 0; i < 18; i++) {
            const p = document.createElement('span');
            p.className = 'particle';
            p.textContent = chars[Math.floor(Math.random() * chars.length)];
            p.style.left     = Math.random() * 100 + 'vw';
            p.style.bottom   = '-20px';
            p.style.fontSize = (8 + Math.random() * 10) + 'px';
            const dur = 12 + Math.random() * 16;
            p.style.animationDuration = dur + 's';
            p.style.animationDelay    = (Math.random() * dur) + 's';
            document.querySelector('.bg-scene').appendChild(p);
        }

        /* ── Input focus glow sync ────────────────────────── */
        document.querySelectorAll('.login-input').forEach(inp => {
            inp.addEventListener('focus', () => {
                const iconEl = inp.parentElement.querySelector('i:first-child');
                if (iconEl) iconEl.style.color = 'var(--accent-light)';
            });
            inp.addEventListener('blur', () => {
                const iconEl = inp.parentElement.querySelector('i:first-child');
                if (iconEl) iconEl.style.color = '';
            });
        });
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ─── VARIABLES ─────────────────────────────────────── */
        :root {
            --bg:           #0D0D0D;
            --bg-card:      #111118;
            --bg-card2:     #15151f;
            --accent:       #4B0082;
            --accent-light: #6a00b8;
            --accent-glow:  rgba(75,0,130,.45);
            --accent-soft:  rgba(75,0,130,.15);
            --border:       rgba(75,0,130,.35);
            --border-dim:   rgba(255,255,255,.06);
            --text:         #e8e8f0;
            --text-muted:   #7a7a9a;
            --text-dim:     #4a4a6a;
            --danger:       #c0392b;
            --success:      #1a7a4a;
            --white:        #ffffff;
            --radius:       14px;
            --radius-sm:    8px;
        }

        /* ─── RESET ──────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* ─── ANIMATED BACKGROUND ────────────────────────────── */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        /* Radial glow blobs */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .18;
            animation: blobFloat 14s ease-in-out infinite alternate;
        }
        .bg-blob.b1 { width: 520px; height: 520px; background: var(--accent); top: -120px; left: -120px; animation-delay: 0s; }
        .bg-blob.b2 { width: 380px; height: 380px; background: #2d0057; bottom: -80px; right: -60px; animation-delay: -5s; }
        .bg-blob.b3 { width: 260px; height: 260px; background: #1a0040; top: 40%; left: 55%; animation-delay: -9s; }

        @keyframes blobFloat {
            0%   { transform: translate(0,0) scale(1); }
            100% { transform: translate(30px,20px) scale(1.08); }
        }

        /* Floating whisper particles */
        .particle {
            position: absolute;
            color: var(--accent-light);
            opacity: 0;
            font-size: 12px;
            animation: particleRise linear infinite;
        }

        @keyframes particleRise {
            0%   { opacity: 0;   transform: translateY(0)     rotate(0deg);   }
            15%  { opacity: .55; }
            85%  { opacity: .3;  }
            100% { opacity: 0;   transform: translateY(-90vh) rotate(360deg); }
        }

        /* Scanline overlay */
        .scanlines {
            position: fixed;
            inset: 0;
            background: repeating-linear-gradient(
                to bottom,
                transparent 0px,
                transparent 3px,
                rgba(0,0,0,.07) 3px,
                rgba(0,0,0,.07) 4px
            );
            z-index: 1;
            pointer-events: none;
        }

        /* Grid noise */
        .grid-overlay {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(75,0,130,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(75,0,130,.04) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
            pointer-events: none;
        }

        /* Floating confession words */
        .whisper-word {
            position: absolute;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(75,0,130,.4);
            white-space: nowrap;
            animation: whisperDrift linear infinite;
            pointer-events: none;
        }

        @keyframes whisperDrift {
            0%   { opacity: 0; transform: translateX(-30px); }
            20%  { opacity: 1; }
            80%  { opacity: .6; }
            100% { opacity: 0; transform: translateX(60px); }
        }

        /* ─── MAIN CONTAINER ─────────────────────────────────── */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 480px;
        }

        /* ─── CARD ───────────────────────────────────────────── */
        .login-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            box-shadow:
                0 0 0 1px rgba(75,0,130,.1),
                0 8px 40px rgba(0,0,0,.7),
                0 0 80px rgba(75,0,130,.12),
                inset 0 1px 0 rgba(255,255,255,.04);
            animation: cardReveal .7s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes cardReveal {
            from { opacity: 0; transform: translateY(28px) scale(.97); }
            to   { opacity: 1; transform: translateY(0)    scale(1);   }
        }

        /* Inner glow border animation */
        .login-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: var(--radius);
            padding: 1px;
            background: linear-gradient(135deg, rgba(75,0,130,.6), transparent 50%, rgba(75,0,130,.3));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: .7;
        }

        /* Corner shadow effect */
        .shadow-corner {
            position: absolute;
            width: 100px;
            height: 100px;
            bottom: 0;
            right: 0;
            background: linear-gradient(135deg, transparent 50%, rgba(75,0,130,.18) 100%);
            border-radius: 0 0 var(--radius) 0;
            pointer-events: none;
        }

        /* Mask animation top */
        .card-top-glow {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
            background-size: 200% 100%;
            animation: glowSlide 3s linear infinite;
        }

        @keyframes glowSlide {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ─── HEADER ─────────────────────────────────────────── */
        .login-header {
            padding: 30px 32px 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-dim);
            position: relative;
            background: linear-gradient(180deg, rgba(75,0,130,.08) 0%, transparent 100%);
        }

        /* Edition bar */
        .edition-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-dim);
            border: 1px solid var(--border-dim);
            border-radius: 30px;
            padding: 5px 14px;
            margin-bottom: 20px;
            background: rgba(75,0,130,.06);
        }

        .edition-bar span { display: flex; align-items: center; gap: 5px; }
        .edition-bar i { color: var(--accent-light); }

        /* Pulse dot */
        .live-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--accent-light);
            display: inline-block;
            margin-right: 4px;
            animation: pulseDot 1.8s ease-in-out infinite;
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(106,0,184,.5); }
            50%       { opacity: .7; transform: scale(1.3); box-shadow: 0 0 0 5px rgba(106,0,184,0); }
        }

        /* Header icon */
        .header-icon {
            width: 68px; height: 68px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: radial-gradient(circle at 40% 35%, rgba(75,0,130,.35) 0%, rgba(13,13,13,.9) 70%);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: var(--accent-light);
            position: relative;
            animation: iconPulse 4s ease-in-out infinite;
            box-shadow: 0 0 24px rgba(75,0,130,.25), inset 0 1px 0 rgba(255,255,255,.06);
        }

        @keyframes iconPulse {
            0%, 100% { box-shadow: 0 0 24px rgba(75,0,130,.25), inset 0 1px 0 rgba(255,255,255,.06); }
            50%       { box-shadow: 0 0 40px rgba(75,0,130,.5),  inset 0 1px 0 rgba(255,255,255,.06); }
        }

        /* Orbiting ring */
        .header-icon::after {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 1px dashed rgba(75,0,130,.35);
            animation: orbitSpin 10s linear infinite;
        }

        @keyframes orbitSpin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        /* Masthead title */
        .masthead-title {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            background: linear-gradient(135deg, #c084fc, #a855f7, #7c3aed, #4B0082);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 10px;
            position: relative;
        }

        .masthead-title::after {
            content: 'SHADOWWHISPER';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #c084fc, #a855f7, #7c3aed, #4B0082);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: blur(12px);
            opacity: .4;
        }

        /* Separator */
        .news-separator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 10px 0;
        }

        .sep-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
        }

        .news-separator i { color: var(--accent); font-size: 6px; }

        /* Brand tagline */
        .brand-tagline {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .typewriter-cursor {
            display: inline-block;
            width: 2px;
            height: 12px;
            background: var(--accent-light);
            animation: cursorBlink .9s step-end infinite;
            vertical-align: middle;
        }

        @keyframes cursorBlink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }

        /* ─── BODY ───────────────────────────────────────────── */
        .login-body {
            padding: 24px 32px 28px;
        }

        /* Headline deco */
        .headline-deco {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 11px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--accent-light);
            margin-bottom: 24px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border-dim);
        }

        .headline-deco i { font-size: 9px; opacity: .7; }

        /* ─── FORM INPUTS ─────────────────────────────────────── */
        .input-group-animated {
            margin-bottom: 18px;
            animation: inputSlide .5s ease both;
        }

        .input-group-animated:nth-child(1) { animation-delay: .05s; }
        .input-group-animated:nth-child(2) { animation-delay: .10s; }
        .input-group-animated:nth-child(3) { animation-delay: .15s; }
        .input-group-animated:nth-child(4) { animation-delay: .20s; }

        @keyframes inputSlide {
            from { opacity: 0; transform: translateX(-12px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .login-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .login-label i { color: var(--accent-light); font-size: 12px; }

        .input-icon-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrap > i:first-child {
            position: absolute;
            left: 13px;
            color: var(--accent);
            font-size: 15px;
            z-index: 2;
            transition: color .2s;
        }

        .login-input {
            width: 100%;
            background: rgba(255,255,255,.03);
            border: 1px solid var(--border-dim);
            border-radius: var(--radius-sm);
            color: var(--text);
            font-size: 14px;
            padding: 11px 42px 11px 40px;
            outline: none;
            transition: border-color .25s, box-shadow .25s, background .25s;
            letter-spacing: .3px;
        }

        .login-input::placeholder { color: var(--text-dim); }

        .login-input:focus {
            border-color: var(--accent);
            background: rgba(75,0,130,.07);
            box-shadow: 0 0 0 3px rgba(75,0,130,.18), 0 0 20px rgba(75,0,130,.1);
        }

        .login-input:focus + .input-icon-wrap > i,
        .input-icon-wrap:focus-within > i:first-child {
            color: var(--accent-light);
        }

        .login-input.is-invalid {
            border-color: var(--danger) !important;
            box-shadow: 0 0 0 3px rgba(192,57,43,.15) !important;
        }

        .invalid-feedback {
            display: block;
            font-size: 11px;
            color: #e74c3c;
            margin-top: 5px;
            padding-left: 4px;
            letter-spacing: .3px;
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 11px;
            background: none;
            border: none;
            color: var(--text-dim);
            cursor: pointer;
            font-size: 15px;
            padding: 4px;
            transition: color .2s;
            z-index: 2;
        }

        .password-toggle:hover { color: var(--accent-light); }

        /* ─── DIVIDER ─────────────────────────────────────────── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
        }

        .divider span {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-dim);
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .divider i { color: var(--accent); }

        /* ─── BUTTON ──────────────────────────────────────────── */
        .btn-wrap { display: flex; flex-direction: column; gap: 14px; }

        .login-btn {
            width: 100%;
            padding: 13px 24px;
            background: linear-gradient(135deg, var(--accent) 0%, #6a00b8 60%, #3d006b 100%);
            border: 1px solid rgba(106,0,184,.4);
            border-radius: var(--radius-sm);
            color: var(--white);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            position: relative;
            overflow: hidden;
            transition: transform .18s, box-shadow .25s;
            box-shadow: 0 4px 20px rgba(75,0,130,.4), 0 0 0 1px rgba(106,0,184,.2);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.12), transparent);
            transition: left .4s ease;
        }

        .login-btn:hover::before { left: 100%; }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(75,0,130,.6), 0 0 0 1px rgba(106,0,184,.4);
        }

        .login-btn:active { transform: translateY(0); }

        /* Ripple */
        .login-btn .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.2);
            transform: scale(0);
            animation: rippleAnim .6s linear;
            pointer-events: none;
        }

        @keyframes rippleAnim {
            to { transform: scale(4); opacity: 0; }
        }

        /* ─── LINKS ───────────────────────────────────────────── */
        .login-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: .5px;
            transition: color .2s;
            justify-content: center;
            width: 100%;
        }

        .login-link i { color: var(--accent); font-size: 13px; transition: color .2s; }
        .login-link:hover { color: var(--accent-light); }
        .login-link:hover i { color: var(--accent-light); }

        /* ─── FOOTER ──────────────────────────────────────────── */
        .card-footer-stamp {
            padding: 14px 32px;
            border-top: 1px solid var(--border-dim);
            background: rgba(75,0,130,.04);
            text-align: center;
        }

        .footer-text {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-dim);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-text i { color: var(--accent); animation: heartBeat 2.5s ease-in-out infinite; }

        @keyframes heartBeat {
            0%, 100% { transform: scale(1);   }
            14%       { transform: scale(1.3); }
            28%       { transform: scale(1);   }
            42%       { transform: scale(1.2); }
            56%       { transform: scale(1);   }
        }

        /* ─── CONFESSION TICKER ───────────────────────────────── */
        .confession-ticker {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 34px;
            background: rgba(13,13,13,.92);
            border-top: 1px solid var(--border-dim);
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 20;
            backdrop-filter: blur(8px);
        }

        .ticker-label {
            background: var(--accent);
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 14px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            white-space: nowrap;
            flex-shrink: 0;
            gap: 6px;
        }

        .ticker-label i { font-size: 11px; animation: pulseDot 1.8s infinite; }

        .ticker-track {
            display: flex;
            align-items: center;
            gap: 0;
            white-space: nowrap;
            animation: tickerScroll 40s linear infinite;
        }

        @keyframes tickerScroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: var(--text-muted);
            padding: 0 28px;
            letter-spacing: .4px;
        }

        .ticker-item i { color: var(--accent-light); font-size: 10px; }
        .ticker-dot { color: var(--text-dim); opacity: .4; }

        /* ─── GHOST MASK ANIMATION ────────────────────────────── */
        .ghost-masks {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 2;
        }

        .mask-icon {
            position: absolute;
            color: rgba(75,0,130,.12);
            animation: maskFloat linear infinite;
            font-size: 20px;
        }

        @keyframes maskFloat {
            0%   { opacity: 0; transform: translateY(100vh) rotate(-15deg); }
            10%  { opacity: 1; }
            90%  { opacity: .7; }
            100% { opacity: 0; transform: translateY(-20px) rotate(15deg); }
        }

        /* ─── SHADOW VEIL (top secret effect) ────────────────── */
        .veil-overlay {
            position: fixed;
            inset: 0;
            background: radial-gradient(ellipse at center, transparent 35%, rgba(0,0,0,.65) 100%);
            z-index: 1;
            pointer-events: none;
        }

        /* ─── RESPONSIVE ─────────────────────────────────────── */
        @media (max-width: 520px) {
            .login-header   { padding: 22px 20px 16px; }
            .login-body     { padding: 18px 20px 22px; }
            .card-footer-stamp { padding: 12px 20px; }
            .masthead-title { font-size: 25px; letter-spacing: 3px; }
            .edition-bar    { flex-direction: column; gap: 4px; text-align: center; }
        }

        /* ─── FORM CONTROL OVERRIDE ───────────────────────────── */
        .form-control { appearance: none; -webkit-appearance: none; }
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text);
            -webkit-box-shadow: 0 0 0 1000px rgba(75,0,130,.08) inset;
            caret-color: var(--text);
        }
    </style>