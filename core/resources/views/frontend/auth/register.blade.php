<!-- FLOATING WHISPER BUBBLES -->
<div class="whisper-bubble"><i class="bi bi-chat-quote"></i> secrets fade...</div>
<div class="whisper-bubble"><i class="bi bi-incognito"></i> unheard voices</div>
<div class="whisper-bubble"><i class="bi bi-mask"></i> speak freely</div>
<div class="whisper-bubble"><i class="bi bi-eye-slash"></i> hidden truths</div>
<div class="whisper-bubble"><i class="bi bi-shadow"></i> in the shadows</div>

<!-- LOGIN CONTAINER -->
<div class="login-container">
    <div class="login-wrapper">
        <div class="login-card">

            <!-- Page Curl Effect -->
            <div class="page-curl"></div>

            <!-- Ghost Mask Decoration -->
            <div class="ghost-mask">
                <i class="bi bi-mask"></i>
            </div>

            <!-- HEADER -->
            <div class="login-header">

                <div class="edition-bar">
                    <span>
                        <i class="bi bi-incognito"></i>
                        Anonymous Network
                    </span>

                    <span id="currentDate"></span>

                    <span>
                        <i class="bi bi-shield-lock"></i>
                        Encrypted
                    </span>
                </div>

                <div class="header-icon">
                    <i class="bi bi-mask"></i>
                </div>

                <div class="masthead-title">
                    ShadowWhisper
                </div>

                <div class="news-separator">
                    <div class="sep-line"></div>
                    <i class="bi bi-diamond-fill"></i>
                    <i class="bi bi-eye-slash-fill" style="font-size: 8px;"></i>
                    <i class="bi bi-diamond-fill"></i>
                    <div class="sep-line"></div>
                </div>

                <span class="brand-tagline">
                    Your Identity Stays in the Shadows
                    <span class="typewriter-cursor"></span>
                </span>

            </div>

            <!-- BODY -->
            <div class="login-body">

                <div class="headline-deco">
                    <i class="bi bi-eye-slash"></i>
                    Create Anonymous Account
                    <i class="bi bi-eye-slash"></i>
                </div>

                <!-- ✅ FIXED FORM -->
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <!-- NAME -->
                    <div class="input-group-animated">
                        <label for="name" class="login-label">
                            <i class="bi bi-person-fill-x"></i>
                            Shadow Alias
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-incognito"></i>

                            <input
                                id="name"
                                type="text"
                                class="form-control login-input @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Choose your hidden identity"
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
                            <i class="bi bi-envelope-slash"></i>
                            Secret Email
                        </label>

                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope-fill"></i>

                            <input
                                id="email"
                                type="email"
                                class="form-control login-input @error('email') is-invalid @enderror"
                                name="email"
                                value=""
                                placeholder="shadow@whisper.io"
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
                            Vault Password
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
                            Confirm Vault Password
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

                    <!-- ANONYMOUS NOTICE -->
                    <div class="anon-identity-section">
                        <p>
                            <i class="bi bi-shield-fill-check"></i>
                            Your real identity is never revealed. All confessions are posted under your Shadow Alias.
                        </p>
                    </div>

                    <!-- TERMS (FIXED: added name attribute for backend) -->
                    <div class="terms-check">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Shadow Code of Conduct</a>
                        </label>
                    </div>

                    <!-- DIVIDER -->
                    <div class="divider">
                        <span>
                            <i class="bi bi-mask" style="font-size:10px;"></i>
                            Enter the Shadows
                            <i class="bi bi-mask" style="font-size:10px;"></i>
                        </span>
                    </div>

                    <!-- BUTTON -->
                    <div class="btn-wrap">
                        <button type="submit" class="login-btn">
                            <i class="bi bi-shield-lock-fill"></i>
                            Create Shadow Identity
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="login-link">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Already a Shadow? Sign In
                            </a>
                        </div>
                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <div class="card-footer-stamp">
                <div class="footer-text">
                    ShadowWhisper
                    <i class="bi bi-heart-fill"></i>
                    Anonymous Since 2025
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Raleway:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        /* ══════════════════════════════════════════
           CSS VARIABLES
        ══════════════════════════════════════════ */
        :root {
            --primary: #0D0D0D;
            --primary-light: #1a1a1a;
            --primary-mid: #141414;
            --accent: #4B0082;
            --accent-light: #6a1ab0;
            --accent-glow: rgba(75, 0, 130, 0.4);
            --accent-subtle: rgba(75, 0, 130, 0.15);
            --text-primary: #e8e6e3;
            --text-secondary: #9a95a0;
            --text-muted: #5a5660;
            --border-color: rgba(75, 0, 130, 0.2);
            --glass-bg: rgba(13, 13, 13, 0.85);
            --card-bg: rgba(18, 15, 22, 0.95);
        }

        /* ══════════════════════════════════════════
           RESET & BASE
        ══════════════════════════════════════════ */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: var(--primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ══════════════════════════════════════════
           ANIMATED BACKGROUND
        ══════════════════════════════════════════ */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 40px 20px;
            background: 
                radial-gradient(ellipse at 20% 50%, rgba(75, 0, 130, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(75, 0, 130, 0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(75, 0, 130, 0.04) 0%, transparent 50%),
                var(--primary);
        }

        /* Floating Particles */
        .login-container::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: 
                radial-gradient(1px 1px at 10% 20%, rgba(75, 0, 130, 0.5), transparent),
                radial-gradient(1px 1px at 30% 60%, rgba(106, 26, 176, 0.3), transparent),
                radial-gradient(1.5px 1.5px at 50% 10%, rgba(75, 0, 130, 0.4), transparent),
                radial-gradient(1px 1px at 70% 80%, rgba(106, 26, 176, 0.3), transparent),
                radial-gradient(1px 1px at 90% 40%, rgba(75, 0, 130, 0.5), transparent),
                radial-gradient(1.5px 1.5px at 15% 85%, rgba(75, 0, 130, 0.35), transparent),
                radial-gradient(1px 1px at 85% 15%, rgba(106, 26, 176, 0.4), transparent),
                radial-gradient(1px 1px at 45% 45%, rgba(75, 0, 130, 0.3), transparent),
                radial-gradient(1.5px 1.5px at 60% 70%, rgba(106, 26, 176, 0.35), transparent),
                radial-gradient(1px 1px at 25% 35%, rgba(75, 0, 130, 0.4), transparent);
            animation: driftParticles 25s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes driftParticles {
            0% { transform: translateY(0) translateX(0); opacity: 0.6; }
            25% { opacity: 1; }
            50% { transform: translateY(-30px) translateX(15px); opacity: 0.7; }
            75% { opacity: 1; }
            100% { transform: translateY(0) translateX(0); opacity: 0.6; }
        }

        /* Fog / Mist overlay */
        .login-container::after {
            content: '';
            position: fixed;
            bottom: -50%;
            left: -10%;
            width: 120%;
            height: 80%;
            background: radial-gradient(ellipse at center, rgba(75, 0, 130, 0.03) 0%, transparent 70%);
            animation: fogDrift 15s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes fogDrift {
            0%, 100% { transform: translateX(0) scale(1); opacity: 0.5; }
            50% { transform: translateX(5%) scale(1.1); opacity: 0.8; }
        }

        /* ══════════════════════════════════════════
           LOGIN WRAPPER
        ══════════════════════════════════════════ */
        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 480px;
            animation: cardReveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes cardReveal {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.96);
                filter: blur(8px);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        /* ══════════════════════════════════════════
           LOGIN CARD
        ══════════════════════════════════════════ */
        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(20px);
            box-shadow:
                0 0 60px rgba(75, 0, 130, 0.08),
                0 25px 50px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(75, 0, 130, 0.1);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
            animation: topGlow 4s ease-in-out infinite;
        }

        @keyframes topGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        /* Page Curl */
        .page-curl {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, transparent 50%, rgba(75, 0, 130, 0.15) 50%);
            border-radius: 0 0 20px 0;
            z-index: 10;
            transition: all 0.4s ease;
        }

        .login-card:hover .page-curl {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, transparent 50%, rgba(75, 0, 130, 0.25) 50%);
        }

        /* ══════════════════════════════════════════
           HEADER SECTION
        ══════════════════════════════════════════ */
        .login-header {
            padding: 30px 30px 20px;
            text-align: center;
            position: relative;
        }

        /* Edition Bar */
        .edition-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-muted);
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 25px;
            font-weight: 500;
        }

        .edition-bar span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .edition-bar i {
            color: var(--accent-light);
            font-size: 10px;
        }

        /* Header Icon */
        .header-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle, var(--accent-subtle), transparent);
            border: 1px solid var(--border-color);
            position: relative;
            animation: iconPulse 3s ease-in-out infinite;
        }

        .header-icon::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 1px solid transparent;
            border-top-color: var(--accent);
            animation: iconSpin 6s linear infinite;
        }

        .header-icon::after {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            border: 1px solid transparent;
            border-bottom-color: rgba(75, 0, 130, 0.3);
            animation: iconSpin 8s linear infinite reverse;
        }

        @keyframes iconPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(75, 0, 130, 0.15); }
            50% { box-shadow: 0 0 40px rgba(75, 0, 130, 0.3); }
        }

        @keyframes iconSpin {
            to { transform: rotate(360deg); }
        }

        .header-icon i {
            font-size: 28px;
            color: var(--accent-light);
            filter: drop-shadow(0 0 8px rgba(75, 0, 130, 0.5));
        }

        /* Masthead Title */
        .masthead-title {
            font-family: 'Cinzel Decorative', serif;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 4px;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-light) 50%, var(--text-primary) 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmerText 5s linear infinite;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        @keyframes shimmerText {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        /* Separator */
        .news-separator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .sep-line {
            flex: 1;
            max-width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        .news-separator i {
            color: var(--accent-light);
            font-size: 6px;
            animation: separatorGlow 2s ease-in-out infinite;
        }

        .news-separator i:nth-child(3) {
            animation-delay: 0.5s;
        }

        @keyframes separatorGlow {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; text-shadow: 0 0 8px var(--accent-glow); }
        }

        /* Brand Tagline */
        .brand-tagline {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 13px;
            color: var(--text-secondary);
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }

        .typewriter-cursor {
            display: inline-block;
            width: 2px;
            height: 14px;
            background: var(--accent-light);
            animation: cursorBlink 1s step-end infinite;
            margin-left: 2px;
        }

        @keyframes cursorBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* ══════════════════════════════════════════
           BODY SECTION
        ══════════════════════════════════════════ */
        .login-body {
            padding: 5px 30px 25px;
        }

        /* Headline Deco */
        .headline-deco {
            text-align: center;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--text-muted);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
        }

        .headline-deco i {
            font-size: 9px;
            color: var(--accent-light);
            animation: decoSpin 4s ease-in-out infinite;
        }

        .headline-deco i:last-child {
            animation-direction: reverse;
        }

        @keyframes decoSpin {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(15deg); }
        }

        /* ══════════════════════════════════════════
           INPUT GROUPS
        ══════════════════════════════════════════ */
        .input-group-animated {
            margin-bottom: 20px;
            animation: inputSlideIn 0.6s ease forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .input-group-animated:nth-child(1) { animation-delay: 0.2s; }
        .input-group-animated:nth-child(2) { animation-delay: 0.35s; }
        .input-group-animated:nth-child(3) { animation-delay: 0.5s; }
        .input-group-animated:nth-child(4) { animation-delay: 0.65s; }

        @keyframes inputSlideIn {
            to { opacity: 1; transform: translateX(0); }
        }

        .login-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .login-label i {
            font-size: 12px;
            color: var(--accent-light);
        }

        .input-icon-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrap > i:first-child {
            position: absolute;
            left: 15px;
            font-size: 14px;
            color: var(--text-muted);
            transition: all 0.3s ease;
            z-index: 2;
        }

        .login-input {
            width: 100%;
            padding: 14px 45px 14px 42px;
            background: rgba(75, 0, 130, 0.06);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
            letter-spacing: 0.5px;
        }

        .login-input::placeholder {
            color: var(--text-muted);
            font-size: 13px;
        }

        .login-input:focus {
            border-color: var(--accent);
            background: rgba(75, 0, 130, 0.1);
            box-shadow: 
                0 0 0 3px rgba(75, 0, 130, 0.15),
                0 0 20px rgba(75, 0, 130, 0.1);
        }

        .login-input:focus ~ .input-icon-wrap > i:first-child,
        .input-icon-wrap:focus-within > i:first-child {
            color: var(--accent-light);
            transform: scale(1.1);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: var(--accent-light);
            transform: scale(1.1);
        }

        /* Validation */
        .invalid-feedback {
            display: block;
            font-size: 11px;
            color: #ff4d6d;
            margin-top: 6px;
            padding-left: 5px;
            animation: shakeError 0.4s ease;
        }

        @keyframes shakeError {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .is-invalid {
            border-color: #ff4d6d !important;
            box-shadow: 0 0 0 3px rgba(255, 77, 109, 0.15) !important;
        }

        /* ══════════════════════════════════════════
           ANONYMOUS IDENTITY SECTION
        ══════════════════════════════════════════ */
        .anon-identity-section {
            background: rgba(75, 0, 130, 0.05);
            border: 1px dashed var(--border-color);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            animation: inputSlideIn 0.6s ease 0.8s forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .anon-identity-section p {
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.6;
            letter-spacing: 0.5px;
        }

        .anon-identity-section i {
            color: var(--accent-light);
        }

        /* ══════════════════════════════════════════
           DIVIDER
        ══════════════════════════════════════════ */
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        }

        .divider span {
            padding: 0 15px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-muted);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .divider span i {
            color: var(--accent-light);
            animation: dividerPulse 2s ease-in-out infinite;
        }

        @keyframes dividerPulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        /* ══════════════════════════════════════════
           TERMS CHECKBOX
        ══════════════════════════════════════════ */
        .terms-check {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
            animation: inputSlideIn 0.6s ease 0.9s forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .terms-check input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            background: rgba(75, 0, 130, 0.06);
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
            margin-top: 1px;
            transition: all 0.3s ease;
        }

        .terms-check input[type="checkbox"]:checked {
            background: var(--accent);
            border-color: var(--accent-light);
        }

        .terms-check input[type="checkbox"]:checked::after {
            content: '\2713';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 11px;
            font-weight: 700;
        }

        .terms-check label {
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.5;
            cursor: pointer;
        }

        .terms-check label a {
            color: var(--accent-light);
            text-decoration: none;
            border-bottom: 1px dotted var(--accent-light);
            transition: all 0.3s ease;
        }

        .terms-check label a:hover {
            color: var(--text-primary);
        }

        /* ══════════════════════════════════════════
           BUTTONS
        ══════════════════════════════════════════ */
        .btn-wrap {
            animation: inputSlideIn 0.6s ease 1s forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border: none;
            border-radius: 12px;
            color: white;
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 8px 25px rgba(75, 0, 130, 0.4),
                0 0 40px rgba(75, 0, 130, 0.15);
        }

        .login-btn:active {
            transform: translateY(0) scale(0.98);
        }

        .login-btn i {
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .login-btn:hover i {
            transform: scale(1.2);
        }

        /* Login Link */
        .text-center {
            text-align: center;
            margin-top: 18px;
        }

        .login-link {
            color: var(--text-muted);
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            letter-spacing: 0.5px;
        }

        .login-link i {
            font-size: 13px;
            transition: transform 0.3s ease;
        }

        .login-link:hover {
            color: var(--accent-light);
        }

        .login-link:hover i {
            transform: translateX(-3px);
        }

        /* ══════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════ */
        .card-footer-stamp {
            padding: 18px 30px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            background: rgba(75, 0, 130, 0.03);
        }

        .footer-text {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-text i {
            color: var(--accent-light);
            font-size: 9px;
            animation: heartBeat 2s ease-in-out infinite;
        }

        @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            15% { transform: scale(1.25); }
            30% { transform: scale(1); }
            45% { transform: scale(1.15); }
        }

        /* ══════════════════════════════════════════
           FLOATING WHISPER BUBBLES
        ══════════════════════════════════════════ */
        .whisper-bubble {
            position: fixed;
            border: 1px solid rgba(75, 0, 130, 0.15);
            background: rgba(75, 0, 130, 0.05);
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 10px;
            color: rgba(75, 0, 130, 0.35);
            letter-spacing: 1px;
            pointer-events: none;
            z-index: 1;
            animation: floatWhisper 20s linear infinite;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            backdrop-filter: blur(5px);
        }

        .whisper-bubble:nth-child(1) {
            top: 15%; left: 5%;
            animation-duration: 22s;
            animation-delay: 0s;
        }

        .whisper-bubble:nth-child(2) {
            top: 40%; right: 3%;
            animation-duration: 18s;
            animation-delay: -5s;
        }

        .whisper-bubble:nth-child(3) {
            bottom: 25%; left: 8%;
            animation-duration: 25s;
            animation-delay: -10s;
        }

        .whisper-bubble:nth-child(4) {
            top: 70%; right: 8%;
            animation-duration: 20s;
            animation-delay: -15s;
        }

        .whisper-bubble:nth-child(5) {
            top: 8%; right: 12%;
            animation-duration: 28s;
            animation-delay: -3s;
        }

        @keyframes floatWhisper {
            0% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.6; }
            50% { transform: translateY(-40px) translateX(20px) rotate(3deg); opacity: 0.3; }
            90% { opacity: 0.5; }
            100% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0; }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════ */
        @media (max-width: 520px) {
            .login-header { padding: 25px 20px 18px; }
            .login-body { padding: 5px 20px 20px; }
            .masthead-title { font-size: 24px; letter-spacing: 2px; }
            .edition-bar { font-size: 8px; letter-spacing: 1px; }
            .login-input { padding: 12px 40px 12px 38px; font-size: 13px; }
            .header-icon { width: 58px; height: 58px; }
            .header-icon i { font-size: 22px; }
            .card-footer-stamp { padding: 14px 20px; }
            .whisper-bubble { display: none; }
        }

        /* ══════════════════════════════════════════
           SCROLLBAR
        ══════════════════════════════════════════ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--primary); }
        ::-webkit-scrollbar-thumb { 
            background: var(--accent); 
            border-radius: 3px; 
        }
        ::-webkit-scrollbar-thumb:hover { 
            background: var(--accent-light); 
        }

        /* ══════════════════════════════════════════
           GHOST MASK ANIMATION (CORNER)
        ══════════════════════════════════════════ */
        .ghost-mask {
            position: absolute;
            top: -1px;
            right: 40px;
            font-size: 20px;
            color: rgba(75, 0, 130, 0.08);
            animation: ghostFloat 6s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes ghostFloat {
            0%, 100% { transform: translateY(0) rotate(-5deg); opacity: 0.3; }
            50% { transform: translateY(-8px) rotate(5deg); opacity: 0.8; }
        }

        /* ══════════════════════════════════════════
           FORM AUTOCOMPLETE FIX DARK
        ══════════════════════════════════════════ */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text-primary);
            -webkit-box-shadow: 0 0 0 1000px rgba(18, 15, 22, 0.98) inset;
            transition: background-color 5000s ease-in-out 0s;
            border-color: var(--border-color);
        }
    </style>

    <!-- JAVASCRIPT -->
    <script>
        // Set current date
        const dateEl = document.getElementById('currentDate');
        const now = new Date();
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        dateEl.textContent = now.toLocaleDateString('en-US', options);

        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }

        // Add subtle parallax to whisper bubbles on mouse move
        document.addEventListener('mousemove', (e) => {
            const bubbles = document.querySelectorAll('.whisper-bubble');
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;

            bubbles.forEach((bubble, i) => {
                const speed = (i + 1) * 3;
                bubble.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });

        // Add glow effect on input focus
        document.querySelectorAll('.login-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.input-group-animated').style.transform = 'scale(1.01)';
                this.closest('.input-group-animated').style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.closest('.input-group-animated').style.transform = 'scale(1)';
            });
        });
    </script>