<div class="login-container">

    <!-- Floating Confession Pages -->
    <div class="floating-page"></div>
    <div class="floating-page"></div>
    <div class="floating-page"></div>
    <div class="floating-page"></div>
    <div class="floating-page"></div>
    <div class="floating-page"></div>

    <!-- Floating Quills -->
    <div class="floating-quill"><i class="bi bi-pen"></i></div>
    <div class="floating-quill"><i class="bi bi-feather"></i></div>

    <!-- Ink Particles -->
    <div class="ink-particle"></div>
    <div class="ink-particle"></div>
    <div class="ink-particle"></div>

    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 d-flex justify-content-center">

                <div class="card login-card">

                    <!-- HEADER -->
                    <div class="card-header login-header text-center">

                        <div class="brand-icon">
                            <i class="bi bi-incognito"></i>
                        </div>

                        <div class="brand-name">Shadow<span>Whisper</span></div>

                        <span class="brand-subtitle">
                            Confess in Silence. Be Heard Anonymously.
                        </span>

                        <div class="date-line">
                            <i class="bi bi-calendar3"></i>
                            <span id="currentDate"></span>
                        </div>

                    </div>

                    <!-- BODY -->
                    <div class="card-body login-body">

                        <div class="section-headline">
                            <i class="bi bi-mask"></i>
                            Anonymous Entry
                        </div>

                        <!-- ✅ FIXED FORM -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- EMAIL -->
                            <div class="form-group-custom">

                                <label for="email" class="login-label pb-2">
                                    <i class="bi bi-envelope-lock"></i>
                                    Email Address
                                </label>

                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control login-input @error('email') is-invalid @enderror"
                                       placeholder="shadow@whisper.anon"
                                       required
                                       autocomplete="email"
                                       autofocus>

                                <i class="bi bi-envelope-lock input-icon"></i>

                                @error('email')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group-custom">

                                <label for="password" class="login-label">
                                    <i class="bi bi-shield-lock"></i>
                                    Secret Passphrase
                                </label>

                                <input id="password"
                                       type="password"
                                       name="password"
                                       class="form-control login-input @error('password') is-invalid @enderror"
                                       placeholder="••••••••"
                                       required
                                       autocomplete="current-password">

                                <i class="bi bi-lock input-icon"></i>

                                <button type="button"
                                        class="password-toggle"
                                        id="togglePassword">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>

                                @error('password')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <!-- REMEMBER -->
                            <div class="form-check custom-check">

                                <input type="checkbox"
                                       name="remember"
                                       id="remember"
                                       class="form-check-input"
                                       {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label login-remember" for="remember">
                                    <i class="bi bi-bookmark-check" style="font-size:0.8rem;margin-right:2px;"></i>
                                    Keep Me in the Shadows
                                </label>

                            </div>

                            <!-- LOGIN BUTTON -->
                            <button type="submit"
                                    class="login-btn mt-3"
                                    id="loginBtn">

                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Enter the Shadows</span>
                                <i class="bi bi-arrow-repeat btn-spinner"></i>

                            </button>

                            <!-- FORGOT PASSWORD -->
                            @if (Route::has('password.request'))
                            <div class="text-end mt-2">
                                <a href="{{ route('password.request') }}" class="login-link">
                                    <i class="bi bi-key"></i>
                                    Forgot Passphrase?
                                </a>
                            </div>
                            @endif

                        </form>

                        <!-- DIVIDER -->
                        <div class="divider">
                            <i class="bi bi-diamond-fill"></i>
                            <span>OR</span>
                            <i class="bi bi-diamond-fill"></i>
                        </div>

                        <!-- REGISTER -->
                        <div class="text-center">

                            <span class="signup-text">
                                No shadow identity yet?
                            </span>

                            <br>

                            <a href="{{ route('register') }}" class="signup-btn">
                                <i class="bi bi-person-add"></i>
                                Create Anonymous Identity
                            </a>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="login-footer">
                        <span>
                            <i class="bi bi-shield-shaded"></i>
                            ShadowWhisper &copy; 2025 &nbsp;&mdash;&nbsp; Your identity is safe here
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    /* ── Live Date ── */
    (function () {
        const el = document.getElementById('currentDate');
        if (!el) return;
        const now = new Date();
        el.textContent = now.toLocaleDateString('en-US', {
            weekday: 'long', year: 'numeric',
            month: 'long',   day: 'numeric'
        });
    })();

    /* ── Password Toggle ── */
    (function () {
        const btn  = document.getElementById('togglePassword');
        const inp  = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (!btn) return;
        btn.addEventListener('click', function () {
            const isPass = inp.type === 'password';
            inp.type  = isPass ? 'text' : 'password';
            icon.className = isPass ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    })();

    /* ── Login Button Spinner ── */
    (function () {
        const form = document.querySelector('form');
        const btn  = document.getElementById('loginBtn');
        if (!form || !btn) return;
        form.addEventListener('submit', function () {
            btn.classList.add('loading');
        });
    })();
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>

        /* ═══════════════════════════════════════════
           ROOT & BASE
        ═══════════════════════════════════════════ */
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Raleway:wght@300;400;500;600&display=swap');

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --black:        #0D0D0D;
            --black-soft:   #111111;
            --black-card:   #161616;
            --black-input:  #1a1a1a;
            --black-border: #2a2a2a;
            --indigo:       #4B0082;
            --indigo-light: #6A0DAD;
            --indigo-glow:  #7B2FBE;
            --indigo-dim:   rgba(75, 0, 130, 0.18);
            --indigo-mid:   rgba(75, 0, 130, 0.35);
            --white:        #ffffff;
            --white-dim:    rgba(255,255,255,0.06);
            --white-soft:   rgba(255,255,255,0.55);
            --white-muted:  rgba(255,255,255,0.30);
            --text-main:    #e8e8f0;
            --text-sub:     #9090a8;
            --danger:       #c0392b;
        }

        body {
            background-color: var(--black);
            font-family: 'Raleway', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════════
           LOGIN CONTAINER  (outermost wrapper)
        ═══════════════════════════════════════════ */
        .login-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(75,0,130,0.22) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 80% 80%, rgba(75,0,130,0.10) 0%, transparent 60%),
                var(--black);
        }

        /* subtle noise texture overlay */
        .login-container::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            background-size: 180px 180px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.6;
        }

        /* ═══════════════════════════════════════════
           FLOATING CONFESSION PAGES
        ═══════════════════════════════════════════ */
        .floating-page {
            position: fixed;
            border-radius: 4px;
            border: 1px solid rgba(75,0,130,0.25);
            background: linear-gradient(135deg, rgba(75,0,130,0.06) 0%, rgba(13,13,13,0.04) 100%);
            backdrop-filter: blur(1px);
            pointer-events: none;
            z-index: 1;
        }

        /* lines drawn on each page */
        .floating-page::before {
            content: '';
            position: absolute;
            left: 20%;
            right: 15%;
            top: 25%;
            height: 1px;
            background: rgba(75,0,130,0.30);
            box-shadow:
                0 8px 0 rgba(75,0,130,0.20),
                0 16px 0 rgba(75,0,130,0.14),
                0 24px 0 rgba(75,0,130,0.09),
                0 32px 0 rgba(75,0,130,0.06);
        }

        /* seal dot */
        .floating-page::after {
            content: '';
            position: absolute;
            bottom: 14%;
            right: 14%;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: rgba(75,0,130,0.45);
            box-shadow: 0 0 8px rgba(75,0,130,0.6);
        }

        .floating-page:nth-child(1) {
            width: 90px; height: 115px;
            top: 8%;  left: 6%;
            transform: rotate(-14deg);
            animation: floatPage1 18s ease-in-out infinite;
        }
        .floating-page:nth-child(2) {
            width: 70px; height: 90px;
            top: 18%; right: 8%;
            transform: rotate(10deg);
            animation: floatPage2 22s ease-in-out infinite;
        }
        .floating-page:nth-child(3) {
            width: 80px; height: 105px;
            bottom: 14%; left: 4%;
            transform: rotate(8deg);
            animation: floatPage3 20s ease-in-out infinite;
        }
        .floating-page:nth-child(4) {
            width: 65px; height: 82px;
            bottom: 10%; right: 6%;
            transform: rotate(-9deg);
            animation: floatPage4 25s ease-in-out infinite;
        }
        .floating-page:nth-child(5) {
            width: 55px; height: 70px;
            top: 52%; left: 2%;
            transform: rotate(16deg);
            animation: floatPage5 16s ease-in-out infinite;
        }
        .floating-page:nth-child(6) {
            width: 75px; height: 95px;
            top: 60%; right: 3%;
            transform: rotate(-6deg);
            animation: floatPage6 28s ease-in-out infinite;
        }

        @keyframes floatPage1 {
            0%,100% { transform: rotate(-14deg) translateY(0px);   opacity: 0.50; }
            30%      { transform: rotate(-11deg) translateY(-18px); opacity: 0.70; }
            60%      { transform: rotate(-16deg) translateY(-8px);  opacity: 0.55; }
        }
        @keyframes floatPage2 {
            0%,100% { transform: rotate(10deg)  translateY(0px);   opacity: 0.40; }
            40%      { transform: rotate(13deg)  translateY(-22px); opacity: 0.65; }
            70%      { transform: rotate(8deg)   translateY(-10px); opacity: 0.45; }
        }
        @keyframes floatPage3 {
            0%,100% { transform: rotate(8deg)   translateY(0px);   opacity: 0.45; }
            35%      { transform: rotate(11deg)  translateY(-15px); opacity: 0.68; }
            65%      { transform: rotate(6deg)   translateY(-7px);  opacity: 0.50; }
        }
        @keyframes floatPage4 {
            0%,100% { transform: rotate(-9deg)  translateY(0px);   opacity: 0.38; }
            45%      { transform: rotate(-12deg) translateY(-20px); opacity: 0.60; }
            75%      { transform: rotate(-7deg)  translateY(-9px);  opacity: 0.42; }
        }
        @keyframes floatPage5 {
            0%,100% { transform: rotate(16deg)  translateY(0px);   opacity: 0.35; }
            50%      { transform: rotate(19deg)  translateY(-14px); opacity: 0.55; }
        }
        @keyframes floatPage6 {
            0%,100% { transform: rotate(-6deg)  translateY(0px);   opacity: 0.42; }
            55%      { transform: rotate(-9deg)  translateY(-18px); opacity: 0.62; }
        }

        /* ═══════════════════════════════════════════
           FLOATING QUILLS
        ═══════════════════════════════════════════ */
        .floating-quill {
            position: fixed;
            color: rgba(75,0,130,0.50);
            font-size: 1.6rem;
            pointer-events: none;
            z-index: 1;
            filter: drop-shadow(0 0 8px rgba(75,0,130,0.5));
        }

        .floating-quill:nth-child(7) {
            top: 30%; left: 9%;
            animation: quillFloat1 14s ease-in-out infinite;
        }
        .floating-quill:nth-child(8) {
            bottom: 28%; right: 9%;
            animation: quillFloat2 17s ease-in-out infinite;
        }

        @keyframes quillFloat1 {
            0%,100% { transform: rotate(-30deg) translateY(0px);   opacity: 0.50; }
            50%      { transform: rotate(-24deg) translateY(-20px); opacity: 0.80; }
        }
        @keyframes quillFloat2 {
            0%,100% { transform: rotate(25deg)  translateY(0px);   opacity: 0.45; }
            50%      { transform: rotate(20deg)  translateY(-16px); opacity: 0.75; }
        }

        /* ═══════════════════════════════════════════
           INK PARTICLES
        ═══════════════════════════════════════════ */
        .ink-particle {
            position: fixed;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(107,13,185,0.70) 0%, rgba(75,0,130,0.0) 70%);
            pointer-events: none;
            z-index: 1;
        }

        .ink-particle:nth-child(9)  {
            width: 260px; height: 260px;
            top: -60px; left: -80px;
            animation: inkPulse1 12s ease-in-out infinite;
        }
        .ink-particle:nth-child(10) {
            width: 200px; height: 200px;
            bottom: -40px; right: -60px;
            animation: inkPulse2 15s ease-in-out infinite;
        }
        .ink-particle:nth-child(11) {
            width: 140px; height: 140px;
            top: 45%; left: 45%;
            animation: inkPulse3 20s ease-in-out infinite;
        }

        @keyframes inkPulse1 {
            0%,100% { transform: scale(1.0); opacity: 0.50; }
            50%      { transform: scale(1.3); opacity: 0.80; }
        }
        @keyframes inkPulse2 {
            0%,100% { transform: scale(1.0); opacity: 0.40; }
            60%      { transform: scale(1.4); opacity: 0.70; }
        }
        @keyframes inkPulse3 {
            0%,100% { transform: scale(0.9) translate(0,0);      opacity: 0.20; }
            33%      { transform: scale(1.2) translate(20px,-10px); opacity: 0.38; }
            66%      { transform: scale(1.0) translate(-10px,15px); opacity: 0.28; }
        }

        /* ═══════════════════════════════════════════
           BOOTSTRAP CONTAINER OVERRIDE
        ═══════════════════════════════════════════ */
        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 0 16px;
        }

        /* ═══════════════════════════════════════════
           LOGIN CARD
        ═══════════════════════════════════════════ */
        .login-card {
            background: linear-gradient(160deg, #161616 0%, #111111 60%, #130a1e 100%);
            border: 1px solid rgba(75,0,130,0.30);
            border-radius: 18px;
            width: 100%;
            max-width: 480px;
            box-shadow:
                0 0 0 1px rgba(75,0,130,0.08),
                0 4px 30px rgba(0,0,0,0.70),
                0 0 60px rgba(75,0,130,0.10),
                inset 0 1px 0 rgba(255,255,255,0.04);
            overflow: hidden;
            animation: cardAppear 0.8s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(28px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0)    scale(1);    }
        }

        /* ═══════════════════════════════════════════
           CARD HEADER
        ═══════════════════════════════════════════ */
        .login-header {
            background: linear-gradient(160deg, rgba(75,0,130,0.28) 0%, rgba(75,0,130,0.10) 60%, transparent 100%);
            border-bottom: 1px solid rgba(75,0,130,0.22);
            padding: 36px 32px 28px;
            position: relative;
            overflow: hidden;
        }

        /* top glow bar */
        .login-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--indigo) 40%, var(--indigo-glow) 60%, transparent 100%);
            opacity: 0.80;
        }

        /* shimmer sweep */
        .login-header::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.025) 50%, transparent 70%);
            animation: shimmer 6s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%,100% { transform: translateX(-100%); }
            50%      { transform: translateX(100%);  }
        }

        /* ── Brand Icon ── */
        .brand-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, rgba(107,13,185,0.40) 0%, rgba(75,0,130,0.20) 60%, transparent 100%);
            border: 1px solid rgba(75,0,130,0.50);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            position: relative;
            box-shadow:
                0 0 0 6px rgba(75,0,130,0.08),
                0 0 20px rgba(75,0,130,0.35),
                inset 0 1px 0 rgba(255,255,255,0.08);
            animation: iconPulse 4s ease-in-out infinite;
        }

        .brand-icon i {
            font-size: 1.9rem;
            color: var(--indigo-glow);
            filter: drop-shadow(0 0 8px rgba(123,47,190,0.9));
        }

        @keyframes iconPulse {
            0%,100% { box-shadow: 0 0 0 6px rgba(75,0,130,0.08), 0 0 20px rgba(75,0,130,0.35), inset 0 1px 0 rgba(255,255,255,0.08); }
            50%      { box-shadow: 0 0 0 10px rgba(75,0,130,0.05), 0 0 38px rgba(75,0,130,0.55), inset 0 1px 0 rgba(255,255,255,0.08); }
        }

        /* rotating ring around icon */
        .brand-icon::before {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            border: 1px dashed rgba(75,0,130,0.35);
            animation: ringRotate 12s linear infinite;
        }

        @keyframes ringRotate {
            from { transform: rotate(0deg);   }
            to   { transform: rotate(360deg); }
        }

        /* ── Brand Name ── */
        .brand-name {
            font-family: 'Cinzel', serif;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--text-main);
            margin-bottom: 6px;
            text-shadow: 0 0 20px rgba(75,0,130,0.50);
        }

        .brand-name span {
            color: var(--indigo-glow);
            filter: drop-shadow(0 0 6px rgba(123,47,190,0.70));
        }

        /* ── Brand Subtitle ── */
        .brand-subtitle {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 400;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--text-sub);
            margin-bottom: 16px;
        }

        /* ── Date Line ── */
        .date-line {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(75,0,130,0.14);
            border: 1px solid rgba(75,0,130,0.25);
            border-radius: 30px;
            padding: 4px 14px;
            font-size: 0.72rem;
            color: var(--text-sub);
            letter-spacing: 0.5px;
        }

        .date-line i {
            color: var(--indigo-glow);
            font-size: 0.75rem;
        }

        /* ═══════════════════════════════════════════
           CARD BODY
        ═══════════════════════════════════════════ */
        .login-body {
            padding: 30px 32px 26px;
        }

        /* ── Section Headline ── */
        .section-headline {
            font-family: 'Cinzel', serif;
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--indigo-glow);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-headline i {
            font-size: 1rem;
            filter: drop-shadow(0 0 5px rgba(123,47,190,0.8));
        }

        .section-headline::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(75,0,130,0.50) 0%, transparent 100%);
            margin-left: 8px;
        }

        /* ── Form Group ── */
        .form-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        /* ── Labels ── */
        .login-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text-sub);
            margin-bottom: 8px;
        }

        .login-label i {
            color: var(--indigo-glow);
            font-size: 0.82rem;
        }

        /* ── Inputs ── */
        .login-input {
            width: 100%;
            background: var(--black-input) !important;
            border: 1px solid var(--black-border) !important;
            border-radius: 10px !important;
            color: var(--text-main) !important;
            padding: 12px 42px 12px 14px !important;
            font-size: 0.88rem !important;
            font-family: 'Raleway', sans-serif !important;
            transition: border-color 0.25s, box-shadow 0.25s;
            outline: none !important;
        }

        .login-input::placeholder {
            color: rgba(144,144,168,0.45) !important;
            letter-spacing: 0.5px;
        }

        .login-input:focus {
            border-color: rgba(75,0,130,0.65) !important;
            box-shadow: 0 0 0 3px rgba(75,0,130,0.12), 0 0 14px rgba(75,0,130,0.15) !important;
            background: #1c1c1c !important;
        }

        .login-input.is-invalid {
            border-color: var(--danger) !important;
        }

        /* ── Input Icon ── */
        .input-icon {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-sub);
            font-size: 0.88rem;
            pointer-events: none;
        }

        /* push icon down when label is above */
        .form-group-custom .input-icon {
            top: calc(50% + 17px);
        }

        /* ── Password Toggle ── */
        .password-toggle {
            position: absolute;
            right: 10px;
            top: calc(50% + 17px);
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-sub);
            font-size: 0.9rem;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
            line-height: 1;
        }

        .password-toggle:hover {
            color: var(--indigo-glow);
        }

        /* ── Remember ── */
        .custom-check {
            margin: 4px 0 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 15px !important;
            height: 15px !important;
            background: var(--black-input) !important;
            border: 1px solid var(--black-border) !important;
            border-radius: 4px !important;
            cursor: pointer;
            flex-shrink: 0;
            accent-color: var(--indigo);
        }

        .form-check-input:checked {
            background-color: var(--indigo) !important;
            border-color: var(--indigo) !important;
        }

        .login-remember {
            font-size: 0.80rem;
            color: var(--text-sub);
            cursor: pointer;
            user-select: none;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        /* ── Invalid Feedback ── */
        .invalid-feedback {
            font-size: 0.75rem;
            color: #e05555;
            margin-top: 5px;
        }

        /* ── Login Button ── */
        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, #4B0082 0%, #6A0DAD 60%, #7B2FBE 100%);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-family: 'Cinzel', serif;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 13px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.3s;
            box-shadow: 0 4px 20px rgba(75,0,130,0.45), 0 1px 0 rgba(255,255,255,0.06) inset;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.10) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.5s;
        }

        .login-btn:hover::before {
            transform: translateX(100%);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(75,0,130,0.60), 0 0 0 1px rgba(123,47,190,0.40);
        }

        .login-btn:active {
            transform: translateY(0px);
        }

        .login-btn .btn-spinner {
            display: none;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg);   }
            to   { transform: rotate(360deg); }
        }

        .login-btn.loading .btn-spinner { display: inline-block; }
        .login-btn.loading span        { opacity: 0.6; }

        /* ── Forgot Password ── */
        .login-link {
            font-size: 0.78rem;
            color: var(--text-sub);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.2s;
            letter-spacing: 0.3px;
        }

        .login-link:hover {
            color: var(--indigo-glow);
            text-decoration: none;
        }

        .login-link i { font-size: 0.78rem; }

        /* ── Divider ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 22px 0;
            color: var(--black-border);
        }

        .divider span {
            font-size: 0.68rem;
            letter-spacing: 3px;
            color: var(--text-sub);
            font-weight: 500;
        }

        .divider i {
            color: rgba(75,0,130,0.40);
            font-size: 0.45rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(75,0,130,0.30), transparent);
        }

        /* ── Sign-up area ── */
        .signup-text {
            font-size: 0.80rem;
            color: var(--text-sub);
        }

        .signup-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 10px;
            padding: 10px 26px;
            border: 1px solid rgba(75,0,130,0.45);
            border-radius: 10px;
            background: rgba(75,0,130,0.08);
            color: var(--indigo-glow);
            font-family: 'Cinzel', serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.25s, border-color 0.25s, box-shadow 0.25s, transform 0.2s;
        }

        .signup-btn:hover {
            background: rgba(75,0,130,0.22);
            border-color: rgba(75,0,130,0.70);
            box-shadow: 0 0 18px rgba(75,0,130,0.28);
            transform: translateY(-1px);
            color: #bf80ff;
            text-decoration: none;
        }

        /* ═══════════════════════════════════════════
           CARD FOOTER
        ═══════════════════════════════════════════ */
        .login-footer {
            border-top: 1px solid rgba(75,0,130,0.15);
            background: rgba(0,0,0,0.25);
            text-align: center;
            padding: 13px 20px;
        }

        .login-footer span {
            font-size: 0.70rem;
            color: rgba(144,144,168,0.45);
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .login-footer i {
            color: rgba(75,0,130,0.55);
        }

        /* ═══════════════════════════════════════════
           SCROLLBAR
        ═══════════════════════════════════════════ */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--black); }
        ::-webkit-scrollbar-thumb { background: rgba(75,0,130,0.45); border-radius: 5px; }

        /* ═══════════════════════════════════════════
           RESPONSIVE TWEAKS
        ═══════════════════════════════════════════ */
        @media (max-width: 480px) {
            .login-header { padding: 28px 22px 22px; }
            .login-body   { padding: 24px 22px 20px; }
            .brand-name   { font-size: 1.45rem; }
            .brand-icon   { width: 60px; height: 60px; }
            .brand-icon i { font-size: 1.55rem; }
        }

    </style>