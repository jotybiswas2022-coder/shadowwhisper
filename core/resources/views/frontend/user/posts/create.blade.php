@extends('frontend.app')

@section('content')

<!-- ===== ANIMATED BACKGROUND ===== -->
<div class="bg-canvas">
    <div class="grid-overlay"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="scan-line"></div>
    <div class="particle-field" id="particleField"></div>
    <div class="bubble-field" id="bubbleField"></div>
</div>

<!-- ===== VEIL OVERLAY ===== -->
<div class="veil-overlay" id="veilOverlay">
    <i class="bi bi-incognito veil-icon"></i>
    <div class="veil-text">Sending Your Confession…</div>
    <div class="veil-sub">Erasing your identity. No traces left behind.</div>
</div>

<!-- ===== TOAST ===== -->
<div class="toast-wrap" id="toastWrap"></div>

<!-- ===== PAGE WRAPPER ===== -->
<div class="page-wrapper" id="pageWrapper">

    <!-- HEADER -->
    <div class="page-header row align-items-center mx-0">
        <div class="col-md-8 ps-2">
            <div class="brand-badge">
                <i class="bi bi-eye-slash-fill"></i> ShadowWhisper Studio
            </div>

            <!-- glitch-text রাখা হয়েছে -->
            <h2 class="page-title glitch-text" data-text="Share Your Dark Secret">
                Share Your <span class="accent">Dark Secret</span>
                <span class="cursor-blink"></span>
            </h2>

            <p class="page-subtitle">
                <i class="bi bi-shield-lock-fill me-1"></i>
                Your identity stays hidden — confess freely, no strings attached
            </p>
        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0 pe-2">
            <!-- FIX: proper Laravel route -->
            <a href="{{ url('/') }}" class="btn-go-back">
                <i class="bi bi-arrow-left-circle"></i> Go Back
            </a>
        </div>
    </div>

    <!-- LIVE TICKER -->
    <div class="feed-ticker">
        <span class="ticker-label"><i class="bi bi-activity"></i> Live</span>
        <div class="ticker-track" id="tickerTrack"></div>
    </div>

    <!-- STORY CARD -->
    <div class="story-card">
        <div class="card-deco"><i class="bi bi-mask"></i></div>
        <div class="card-body-inner">

            <!-- PROGRESS STEPS -->
            <div class="progress-steps">
                <div class="step-row">
                    <div class="step-dot active" id="step1">
                        <i class="bi bi-info-circle" style="font-size:.75rem"></i>
                    </div>
                    <div class="step-line" id="line12"></div>
                    <div class="step-dot" id="step2">
                        <i class="bi bi-chat-square-text" style="font-size:.75rem"></i>
                    </div>
                    <div class="step-line" id="line23"></div>
                    <div class="step-dot" id="step3">
                        <i class="bi bi-image" style="font-size:.75rem"></i>
                    </div>
                </div>

                <div class="step-labels">
                    <div class="step-lbl active" id="lbl1">Identity</div>
                    <div class="step-lbl" id="lbl2" style="text-align:center">Confession</div>
                    <div class="step-lbl" id="lbl3" style="text-align:right">Evidence</div>
                </div>
            </div>

            <!-- ===== FORM FIXED ===== -->
            <form action="{{ url('/posts/store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="storyForm" 
                  novalidate>

                @csrf

                <input type="hidden" name="status" value="0">
                <input type="hidden" name="mood" id="moodInput" value="">

                <div class="row g-4">
                    <div class="col-lg-12">

                        <!-- SECTION 1 -->
                        <div class="section-label">
                            <i class="bi bi-person-fill-slash"></i> Anonymous Identity
                        </div>

                        <div class="form-group-wrap">
                            <label class="form-label">
                                <i class="bi bi-at"></i> Alias / Codename 
                                <span class="required-star">*</span>
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-incognito"></i>
                                </span>

                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       id="titleInput"
                                       placeholder="e.g. MidnightGhost_77 — your shadow name…"
                                       required
                                       autocomplete="off"
                                       maxlength="120">
                            </div>

                            <div class="char-counter" id="titleCounter">0 / 120</div>
                        </div>

                        <!-- SECTION 2 -->
                        <div class="section-label mt-4">
                            <i class="bi bi-chat-square-quote-fill"></i> Your Confession
                        </div>

                        <div class="form-group-wrap">
                            <label class="form-label">
                                <i class="bi bi-feather2"></i> Confession Details 
                                <span class="required-star">*</span>
                            </label>

                            <textarea class="form-control editor"
                                      name="details"
                                      id="detailsTextarea"
                                      rows="8"
                                      placeholder="Speak your truth into the void…"></textarea>

                            <div class="char-counter" id="detailsCounter">0 characters</div>
                        </div>

                        <!-- SECTION 3 -->
                        <div class="section-label mt-4">
                            <i class="bi bi-paperclip"></i> Attach Evidence (Optional)
                        </div>

                        <div class="form-group-wrap">
                            <label class="form-label">
                                <i class="bi bi-cloud-arrow-up-fill"></i> Upload Image or Video
                            </label>

                            <div class="file-drop-zone" id="dropZone">
                                <input type="file"
                                       name="file"
                                       id="fileInput"
                                       accept="image/*,video/mp4">

                                <i class="bi bi-cloud-upload file-drop-icon"></i>

                                <p class="file-drop-text">
                                    <strong>Click to upload</strong> or drag & drop here<br>
                                    <span style="font-size:.72rem;color:var(--muted)">
                                        Supports: JPG, PNG, GIF, WEBP, MP4 — Your IP is never logged
                                    </span>
                                </p>

                                <div class="file-name-display hidden" id="fileNameDisplay">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span id="fileNameText"></span>
                                </div>
                            </div>

                            <div class="preview-wrapper" id="previewWrapper">
                                <div class="preview-label">
                                    <i class="bi bi-eye-fill"></i> Preview
                                </div>
                                <img id="previewImg" src="" alt="Preview">
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="mt-4 form-group-wrap">
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="bi bi-send-fill"></i> Send Into the Shadow
                            </button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    // ===== PARTICLES =====
    const particleField = document.getElementById('particleField');
    for (let i = 0; i < 30; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        p.style.left = Math.random() * 100 + '%';
        p.style.animationDuration = (8 + Math.random() * 15) + 's';
        p.style.animationDelay = (Math.random() * 10) + 's';
        p.style.width = (1 + Math.random() * 3) + 'px';
        p.style.height = p.style.width;
        particleField.appendChild(p);
    }

    // ===== BUBBLES =====
    const bubbleField = document.getElementById('bubbleField');
    for (let i = 0; i < 12; i++) {
        const b = document.createElement('div');
        b.className = 'bubble';
        const size = 20 + Math.random() * 60;
        b.style.width = size + 'px';
        b.style.height = size + 'px';
        b.style.left = Math.random() * 100 + '%';
        b.style.animationDuration = (12 + Math.random() * 20) + 's';
        b.style.animationDelay = (Math.random() * 15) + 's';
        bubbleField.appendChild(b);
    }

    // ===== TICKER =====
    const tickerTrack = document.getElementById('tickerTrack');
    const tickerMessages = [
        { icon: 'bi-mask', text: 'Anonymous just confessed something dark...' },
        { icon: 'bi-shield-check', text: 'All confessions are encrypted & anonymous' },
        { icon: 'bi-eye-slash', text: 'No IP logging — your secret is safe' },
        { icon: 'bi-lightning-charge', text: 'ShadowVault_42 dropped a new confession' },
        { icon: 'bi-lock-fill', text: 'End-to-end anonymity guaranteed' },
        { icon: 'bi-ghost', text: 'PhantomUser left a whisper 3 min ago' },
        { icon: 'bi-incognito', text: 'NightCrawler_99 shared their truth' },
        { icon: 'bi-chat-dots', text: '327 confessions this week — and counting' },
        { icon: 'bi-fingerprint', text: 'Zero fingerprints. Zero traces.' },
        { icon: 'bi-stars', text: 'Most whispered topic today: "Regret"' },
    ];

    let tickerHTML = '';
    for (let r = 0; r < 3; r++) {
        tickerMessages.forEach(m => {
            tickerHTML += `<span class="ticker-item"><i class="bi ${m.icon}"></i> ${m.text}</span>`;
        });
    }
    tickerTrack.innerHTML = tickerHTML;

    // ===== CHARACTER COUNTERS =====
    const titleInput = document.getElementById('titleInput');
    const titleCounter = document.getElementById('titleCounter');
    const detailsTextarea = document.getElementById('detailsTextarea');
    const detailsCounter = document.getElementById('detailsCounter');

    titleInput.addEventListener('input', function() {
        const len = this.value.length;
        titleCounter.textContent = len + ' / 120';
        titleCounter.className = 'char-counter' + (len > 100 ? ' danger' : len > 80 ? ' warning' : '');
        updateSteps();
    });

    detailsTextarea.addEventListener('input', function() {
        const len = this.value.length;
        detailsCounter.textContent = len + ' characters';
        updateSteps();
    });

    // ===== PROGRESS STEPS =====
    function updateSteps() {
        const hasTitle = titleInput.value.trim().length > 0;
        const hasDetails = detailsTextarea.value.trim().length > 0;
        const hasFile = fileInput.files && fileInput.files.length > 0;

        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const line12 = document.getElementById('line12');
        const line23 = document.getElementById('line23');
        const lbl1 = document.getElementById('lbl1');
        const lbl2 = document.getElementById('lbl2');
        const lbl3 = document.getElementById('lbl3');

        // Reset
        [step1, step2, step3].forEach(s => s.classList.remove('active', 'completed'));
        [line12, line23].forEach(l => l.classList.remove('active'));
        [lbl1, lbl2, lbl3].forEach(l => l.classList.remove('active'));

        if (hasTitle) {
            step1.classList.add('completed');
            lbl1.classList.add('active');
            line12.classList.add('active');
            step2.classList.add('active');
            lbl2.classList.add('active');
        } else {
            step1.classList.add('active');
            lbl1.classList.add('active');
        }

        if (hasTitle && hasDetails) {
            step2.classList.remove('active');
            step2.classList.add('completed');
            line23.classList.add('active');
            step3.classList.add('active');
            lbl3.classList.add('active');
        }

        if (hasTitle && hasDetails && hasFile) {
            step3.classList.remove('active');
            step3.classList.add('completed');
        }
    }

    // ===== FILE UPLOAD =====
    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileNameText = document.getElementById('fileNameText');
    const previewWrapper = document.getElementById('previewWrapper');
    const previewImg = document.getElementById('previewImg');

    fileInput.addEventListener('change', handleFile);

    dropZone.addEventListener('dragover', function(e) {
        this.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', function() {
        this.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', function(e) {
        this.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            handleFile();
        }
    });

    function handleFile() {
        const file = fileInput.files[0];
        if (!file) return;

        fileNameDisplay.classList.remove('hidden');
        fileNameText.textContent = file.name;

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewWrapper.classList.add('show');
            };
            reader.readAsDataURL(file);
        } else {
            previewWrapper.classList.remove('show');
        }

        updateSteps();
        showToast('bi-check-circle-fill', 'File attached successfully — your evidence is ready');
    }

    // ===== TOAST =====
    function showToast(icon, message) {
        const toastWrap = document.getElementById('toastWrap');
        const toast = document.createElement('div');
        toast.className = 'toast-msg';
        toast.innerHTML = `<i class="bi ${icon}"></i> ${message}`;
        toastWrap.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('fade-out');
            setTimeout(() => toast.remove(), 400);
        }, 3500);
    }

    // ===== CONFETTI =====
    function burstConfetti() {
        const colors = ['#4B0082', '#6a1ab5', '#8a2be2', '#9b59b6', '#3d0066', '#7c3aed'];
        for (let i = 0; i < 50; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.left = (40 + Math.random() * 20) + '%';
            piece.style.top = '40%';
            piece.style.background = colors[Math.floor(Math.random() * colors.length)];
            piece.style.borderRadius = Math.random() > 0.5 ? '50%' : '2px';
            piece.style.width = (4 + Math.random() * 6) + 'px';
            piece.style.height = piece.style.width;
            piece.style.animationDuration = (2 + Math.random() * 2) + 's';
            piece.style.animationDelay = (Math.random() * 0.5) + 's';
            piece.style.transform = `translateX(${(Math.random() - 0.5) * 400}px)`;
            document.body.appendChild(piece);
            setTimeout(() => piece.remove(), 4000);
        }
    }

    // ===== FORM SUBMIT =====
    const form = document.getElementById('storyForm');
    const veilOverlay = document.getElementById('veilOverlay');

    form.addEventListener('submit', function(e) {

        const title = titleInput.value.trim();
        const details = detailsTextarea.value.trim();

        if (!title) {
            showToast('bi-exclamation-triangle-fill', 'Please enter your anonymous alias');
            titleInput.focus();
            titleInput.style.borderColor = 'var(--danger)';
            setTimeout(() => titleInput.style.borderColor = '', 2000);
            return;
        }

        if (!details) {
            showToast('bi-exclamation-triangle-fill', 'Your confession cannot be empty');
            detailsTextarea.focus();
            detailsTextarea.style.borderColor = 'var(--danger)';
            setTimeout(() => detailsTextarea.style.borderColor = '', 2000);
            return;
        }

        // Show veil
        veilOverlay.classList.add('active');

        // Simulate submission
        setTimeout(() => {
            veilOverlay.classList.remove('active');
            burstConfetti();
            showToast('bi-shield-fill-check', 'Confession sent into the shadows — identity erased');

            // Reset form
            form.reset();
            titleCounter.textContent = '0 / 120';
            detailsCounter.textContent = '0 characters';
            fileNameDisplay.classList.add('hidden');
            previewWrapper.classList.remove('show');
            updateSteps();
        }, 3000);
    });

    // ===== FLOATING WHISPER WORDS =====
    const whisperWords = ['anonymous', 'secret', 'shadow', 'hidden', 'whisper', 'truth', 'confess', 'mask', 'veil', 'ghost', 'phantom', 'void', 'silence'];

    function spawnWhisper() {
        const word = whisperWords[Math.floor(Math.random() * whisperWords.length)];
        const el = document.createElement('div');
        el.className = 'whisper-particle';
        el.textContent = word;
        el.style.left = (5 + Math.random() * 90) + '%';
        el.style.top = (70 + Math.random() * 30) + '%';
        el.style.animationDuration = (6 + Math.random() * 8) + 's';
        el.style.fontSize = (0.55 + Math.random() * 0.4) + 'rem';
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 14000);
    }

    setInterval(spawnWhisper, 3000);

    // ===== INPUT FOCUS EFFECTS =====
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.form-group-wrap')?.style.setProperty('--glow', '1');
        });
        input.addEventListener('blur', function() {
            this.closest('.form-group-wrap')?.style.setProperty('--glow', '0');
        });
    });

    // Initial step state
    updateSteps();

})();
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --bg: #0D0D0D;
            --bg-card: #111114;
            --bg-card-inner: #151519;
            --bg-input: #1a1a20;
            --accent: #4B0082;
            --accent-light: #6a1ab5;
            --accent-glow: rgba(75, 0, 130, 0.45);
            --accent-soft: rgba(75, 0, 130, 0.15);
            --accent-border: rgba(75, 0, 130, 0.3);
            --text: #e8e6f0;
            --text-secondary: #9590a8;
            --muted: #5a5670;
            --border: rgba(255,255,255,0.06);
            --danger: #ff3b5c;
            --success: #00e676;
            --font: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        ::selection {
            background: var(--accent);
            color: #fff;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 3px; }

        /* ===== ANIMATED BACKGROUND ===== */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(75, 0, 130, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(75, 0, 130, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridPulse 8s ease-in-out infinite;
        }

        @keyframes gridPulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.8; }
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
        }

        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #4B0082 0%, transparent 70%);
            top: -150px; right: -100px;
            animation: orbFloat1 20s ease-in-out infinite;
        }

        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #2d004d 0%, transparent 70%);
            bottom: -100px; left: -80px;
            animation: orbFloat2 25s ease-in-out infinite;
        }

        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, #1a0033 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: orbFloat3 18s ease-in-out infinite;
        }

        @keyframes orbFloat1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(-60px, 80px) scale(1.1); }
            50% { transform: translate(40px, 120px) scale(0.9); }
            75% { transform: translate(-30px, 40px) scale(1.05); }
        }

        @keyframes orbFloat2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(80px, -60px) scale(1.15); }
            66% { transform: translate(-40px, -100px) scale(0.95); }
        }

        @keyframes orbFloat3 {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.2; }
            50% { transform: translate(-50%, -50%) scale(1.3); opacity: 0.4; }
        }

        .scan-line {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent-glow), rgba(75,0,130,0.6), var(--accent-glow), transparent);
            animation: scanMove 6s linear infinite;
            opacity: 0.5;
        }

        @keyframes scanMove {
            0% { top: -2px; }
            100% { top: 100%; }
        }

        /* Particle Field */
        .particle-field {
            position: absolute;
            inset: 0;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(75, 0, 130, 0.6);
            border-radius: 50%;
            animation: particleDrift linear infinite;
            box-shadow: 0 0 6px rgba(75, 0, 130, 0.4);
        }

        @keyframes particleDrift {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-20px) scale(1); opacity: 0; }
        }

        /* Bubble Field */
        .bubble-field {
            position: absolute;
            inset: 0;
        }

        .bubble {
            position: absolute;
            border: 1px solid rgba(75, 0, 130, 0.15);
            border-radius: 50%;
            animation: bubbleRise linear infinite;
        }

        @keyframes bubbleRise {
            0% { transform: translateY(100vh) scale(0.5) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.1; }
            100% { transform: translateY(-100px) scale(1.2) rotate(360deg); opacity: 0; }
        }

        /* ===== VEIL OVERLAY ===== */
        .veil-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(5, 5, 8, 0.96);
            backdrop-filter: blur(30px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .veil-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .veil-icon {
            font-size: 4rem;
            color: var(--accent-light);
            animation: veilPulse 1.5s ease-in-out infinite, veilSpin 3s linear infinite;
            text-shadow: 0 0 40px var(--accent-glow), 0 0 80px rgba(75,0,130,0.3);
        }

        @keyframes veilPulse {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.15); opacity: 1; }
        }

        @keyframes veilSpin {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }

        .veil-text {
            margin-top: 1.5rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 1px;
            animation: veilTextGlow 2s ease-in-out infinite;
        }

        @keyframes veilTextGlow {
            0%, 100% { text-shadow: 0 0 20px transparent; }
            50% { text-shadow: 0 0 30px var(--accent-glow); }
        }

        .veil-sub {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: var(--muted);
            font-family: var(--mono);
            letter-spacing: 0.5px;
        }

        /* ===== TOAST ===== */
        .toast-wrap {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-msg {
            background: var(--bg-card);
            border: 1px solid var(--accent-border);
            border-left: 3px solid var(--accent-light);
            padding: 14px 22px;
            border-radius: 10px;
            font-size: 0.85rem;
            color: var(--text);
            box-shadow: 0 8px 32px rgba(0,0,0,0.5), 0 0 20px var(--accent-glow);
            animation: toastSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 10px;
            backdrop-filter: blur(10px);
        }

        .toast-msg i { color: var(--accent-light); font-size: 1.1rem; }

        @keyframes toastSlide {
            from { transform: translateX(120%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .toast-msg.fade-out {
            animation: toastFade 0.4s ease forwards;
        }

        @keyframes toastFade {
            to { transform: translateX(120%); opacity: 0; }
        }

        /* ===== PAGE WRAPPER ===== */
        .page-wrapper {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 30px 20px 60px;
            animation: pageReveal 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes pageReveal {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            margin-bottom: 24px;
            padding: 28px 28px;
            background: linear-gradient(135deg, var(--bg-card) 0%, rgba(75,0,130,0.08) 100%);
            border: 1px solid var(--border);
            border-radius: 18px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
            animation: headerLine 4s ease-in-out infinite;
        }

        @keyframes headerLine {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(75,0,130,0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--accent-soft);
            border: 1px solid var(--accent-border);
            color: var(--accent-light);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 30px;
            margin-bottom: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-family: var(--mono);
            animation: badgePulse 3s ease-in-out infinite;
        }

        @keyframes badgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(75,0,130,0.3); }
            50% { box-shadow: 0 0 20px 4px rgba(75,0,130,0.15); }
        }

        .brand-badge i { font-size: 0.9rem; }

        .page-title {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.3;
            margin-bottom: 8px;
        }

        .accent {
            background: linear-gradient(135deg, var(--accent-light), #8a2be2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .cursor-blink {
            display: inline-block;
            width: 3px;
            height: 1.5rem;
            background: var(--accent-light);
            margin-left: 4px;
            vertical-align: middle;
            animation: cursorBlink 1s step-end infinite;
            border-radius: 2px;
            box-shadow: 0 0 8px var(--accent-glow);
        }

        @keyframes cursorBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .page-subtitle {
            font-size: 0.85rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
        }

        .page-subtitle i { color: var(--accent-light); }

        .btn-go-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: transparent;
            border: 1px solid var(--accent-border);
            color: var(--text-secondary);
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: var(--font);
        }

        .btn-go-back:hover {
            background: var(--accent-soft);
            color: var(--accent-light);
            border-color: var(--accent-light);
            box-shadow: 0 0 20px rgba(75,0,130,0.2);
            transform: translateX(-4px);
        }

        .btn-go-back i { font-size: 1.1rem; transition: transform 0.3s; }
        .btn-go-back:hover i { transform: translateX(-3px); }

        /* ===== FEED TICKER ===== */
        .feed-ticker {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 10px 18px;
            margin-bottom: 24px;
            overflow: hidden;
            position: relative;
        }

        .feed-ticker::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 80px;
            background: linear-gradient(90deg, var(--bg-card), transparent);
            z-index: 2;
            pointer-events: none;
        }

        .feed-ticker::after {
            content: '';
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 80px;
            background: linear-gradient(-90deg, var(--bg-card), transparent);
            z-index: 2;
            pointer-events: none;
        }

        .ticker-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--success);
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            z-index: 3;
            font-family: var(--mono);
            position: relative;
        }

        .ticker-label::after {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--success);
            border-radius: 50%;
            animation: liveDot 1.5s ease-in-out infinite;
            box-shadow: 0 0 8px rgba(0,230,118,0.5);
        }

        @keyframes liveDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.7); }
        }

        .ticker-track {
            display: flex;
            gap: 30px;
            animation: tickerScroll 35s linear infinite;
            white-space: nowrap;
        }

        .ticker-item {
            font-size: 0.75rem;
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            font-family: var(--mono);
        }

        .ticker-item i { color: var(--accent-light); font-size: 0.8rem; }

        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ===== STORY CARD ===== */
        .story-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            animation: cardFloat 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardFloat {
            from { opacity: 0; transform: translateY(30px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .story-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-border), transparent);
        }

        .story-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 1px;
            background: linear-gradient(180deg, rgba(75,0,130,0.1), transparent 50%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .card-deco {
            position: absolute;
            top: 20px;
            right: 24px;
            font-size: 5rem;
            color: rgba(75, 0, 130, 0.06);
            pointer-events: none;
            animation: decoFloat 6s ease-in-out infinite;
        }

        @keyframes decoFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }

        .card-body-inner {
            padding: 36px 32px;
            position: relative;
        }

        /* ===== PROGRESS STEPS ===== */
        .progress-steps {
            margin-bottom: 32px;
        }

        .step-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
        }

        .step-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--bg-input);
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            flex-shrink: 0;
        }

        .step-dot.active {
            background: var(--accent);
            border-color: var(--accent-light);
            color: #fff;
            box-shadow: 0 0 20px var(--accent-glow), 0 0 40px rgba(75,0,130,0.2);
            animation: stepGlow 2s ease-in-out infinite;
        }

        @keyframes stepGlow {
            0%, 100% { box-shadow: 0 0 20px var(--accent-glow); }
            50% { box-shadow: 0 0 30px var(--accent-glow), 0 0 60px rgba(75,0,130,0.15); }
        }

        .step-dot.completed {
            background: var(--accent-light);
            border-color: var(--accent-light);
            color: #fff;
        }

        .step-line {
            flex: 1;
            height: 2px;
            background: var(--border);
            max-width: 140px;
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        .step-line.active {
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent-glow);
        }

        .step-line.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
            animation: lineShimmer 2s ease-in-out infinite;
        }

        @keyframes lineShimmer {
            0% { left: -50%; }
            100% { left: 150%; }
        }

        .step-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            padding: 0 4px;
        }

        .step-lbl {
            font-size: 0.7rem;
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: var(--mono);
            transition: color 0.3s;
            flex: 1;
        }

        .step-lbl.active { color: var(--accent-light); }

        /* ===== SECTION LABELS ===== */
        .section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--accent-light);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            font-family: var(--mono);
            position: relative;
        }

        .section-label::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 1px;
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent-glow);
        }

        .section-label i { font-size: 1rem; }

        /* ===== FORM ELEMENTS ===== */
        .form-group-wrap {
            margin-bottom: 8px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-label i { color: var(--accent-light); font-size: 0.85rem; }

        .required-star { color: var(--danger); font-size: 0.9rem; }

        .input-group {
            display: flex;
            align-items: stretch;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 14px;
            background: rgba(75, 0, 130, 0.1);
            border: 1px solid var(--accent-border);
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--accent-light);
            font-size: 1rem;
        }

        .form-control {
            flex: 1;
            background: var(--bg-input);
            border: 1px solid var(--border);
            color: var(--text);
            padding: 12px 16px;
            font-size: 0.88rem;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
            font-family: var(--font);
            width: 100%;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .form-control::placeholder {
            color: var(--muted);
            font-style: italic;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: rgba(75, 0, 130, 0.08);
            box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.15), 0 0 20px rgba(75, 0, 130, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 180px;
            line-height: 1.7;
            border-radius: 10px;
        }

        .char-counter {
            text-align: right;
            font-size: 0.7rem;
            color: var(--muted);
            margin-top: 6px;
            font-family: var(--mono);
            transition: color 0.3s;
        }

        .char-counter.warning { color: #ffa726; }
        .char-counter.danger { color: var(--danger); }

        /* ===== FILE DROP ZONE ===== */
        .file-drop-zone {
            border: 2px dashed var(--accent-border);
            border-radius: 14px;
            padding: 36px 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(75,0,130,0.03) 0%, transparent 100%);
        }

        .file-drop-zone::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(75,0,130,0.05) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .file-drop-zone:hover::before,
        .file-drop-zone.dragover::before {
            opacity: 1;
        }

        .file-drop-zone:hover {
            border-color: var(--accent-light);
            box-shadow: 0 0 30px rgba(75, 0, 130, 0.1);
            transform: translateY(-2px);
        }

        .file-drop-zone.dragover {
            border-color: var(--accent-light);
            background: rgba(75, 0, 130, 0.08);
            box-shadow: 0 0 40px var(--accent-glow);
        }

        .file-drop-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-drop-icon {
            font-size: 2.5rem;
            color: var(--accent-light);
            margin-bottom: 10px;
            display: block;
            animation: uploadBounce 3s ease-in-out infinite;
        }

        @keyframes uploadBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .file-drop-text {
            font-size: 0.82rem;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .file-drop-text strong { color: var(--accent-light); }

        .file-name-display {
            margin-top: 12px;
            padding: 8px 16px;
            background: rgba(0, 230, 118, 0.08);
            border: 1px solid rgba(0, 230, 118, 0.2);
            border-radius: 8px;
            font-size: 0.78rem;
            color: var(--success);
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            font-family: var(--mono);
        }

        .file-name-display.hidden { display: none; }

        /* ===== PREVIEW ===== */
        .preview-wrapper {
            margin-top: 16px;
            display: none;
            animation: previewFade 0.5s ease;
        }

        .preview-wrapper.show { display: block; }

        @keyframes previewFade {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .preview-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            color: var(--muted);
            margin-bottom: 8px;
            font-family: var(--mono);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .preview-label i { color: var(--accent-light); }

        .preview-wrapper img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 12px;
            border: 1px solid var(--accent-border);
            box-shadow: 0 8px 32px rgba(0,0,0,0.4), 0 0 20px rgba(75,0,130,0.1);
            object-fit: cover;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 50%, #6a1ab5 100%);
            background-size: 200% 200%;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-family: var(--font);
            animation: btnGradient 4s ease-in-out infinite;
        }

        @keyframes btnGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.6s ease;
        }

        .btn-submit:hover::before { left: 100%; }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px var(--accent-glow), 0 0 60px rgba(75,0,130,0.3);
        }

        .btn-submit:active {
            transform: translateY(0) scale(0.98);
        }

        .btn-submit i { font-size: 1.1rem; }

        /* ===== FLOATING WHISPER PARTICLES ===== */
        .whisper-particle {
            position: fixed;
            font-size: 0.65rem;
            color: rgba(75, 0, 130, 0.3);
            font-family: var(--mono);
            pointer-events: none;
            z-index: 0;
            animation: whisperFloat 8s ease-in-out infinite;
        }

        @keyframes whisperFloat {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            20% { opacity: 0.4; }
            80% { opacity: 0.2; }
            100% { transform: translateY(-200px) rotate(10deg); opacity: 0; }
        }

        /* ===== GLITCH TEXT EFFECT (subtle) ===== */
        .glitch-text {
            position: relative;
        }

        .glitch-text::before,
        .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
        }

        .glitch-text::before {
            color: #ff3b5c;
            animation: glitch1 3s infinite;
            clip-path: polygon(0 0, 100% 0, 100% 35%, 0 35%);
            opacity: 0.05;
        }

        .glitch-text::after {
            color: #4B0082;
            animation: glitch2 3s infinite;
            clip-path: polygon(0 65%, 100% 65%, 100% 100%, 0 100%);
            opacity: 0.05;
        }

        @keyframes glitch1 {
            0%, 90%, 100% { transform: translate(0); }
            92% { transform: translate(-2px, 1px); }
            94% { transform: translate(2px, -1px); }
            96% { transform: translate(-1px, 2px); }
        }

        @keyframes glitch2 {
            0%, 90%, 100% { transform: translate(0); }
            91% { transform: translate(2px, -1px); }
            93% { transform: translate(-2px, 1px); }
            95% { transform: translate(1px, -2px); }
        }

        /* ===== CONFETTI BURST (on submit) ===== */
        .confetti-piece {
            position: fixed;
            width: 6px;
            height: 6px;
            z-index: 9998;
            pointer-events: none;
            animation: confettiFall 3s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes confettiFall {
            0% { transform: translateY(0) rotate(0deg) scale(1); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg) scale(0); opacity: 0; }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .page-wrapper { padding: 16px 12px 40px; }
            .page-header { padding: 20px 18px; flex-direction: column; align-items: flex-start; }
            .page-title { font-size: 1.35rem; }
            .card-body-inner { padding: 24px 18px; }
            .step-dot { width: 30px; height: 30px; }
            .btn-submit { padding: 14px 24px; font-size: 0.9rem; }
            .card-deco { font-size: 3rem; top: 12px; right: 14px; }
            .header-right { margin-top: 16px; width: 100%; }
        }

        @media (max-width: 480px) {
            .page-title { font-size: 1.15rem; }
            .step-line { max-width: 60px; }
            .file-drop-zone { padding: 24px 16px; }
            .feed-ticker { padding: 8px 12px; }
        }

        /* ===== ACCESSIBILITY ===== */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ===== EXTRA FLAIR ===== */
        .mt-4 { margin-top: 1.5rem; }
        .me-1 { margin-right: 0.25rem; }
        .hidden { display: none !important; }

        .row { display: flex; flex-wrap: wrap; }
        .g-4 { gap: 1.5rem; }
        .col-lg-12 { flex: 0 0 100%; max-width: 100%; }

        /* Focus ring for accessibility */
        *:focus-visible {
            outline: 2px solid var(--accent-light);
            outline-offset: 2px;
        }

        /* Typing animation for placeholder */
        @keyframes typingDots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }

        /* ===== SECRET SHADOW ANIMATION ON CARD ===== */
        .story-card:hover {
            box-shadow: 0 0 60px rgba(75,0,130,0.08);
        }

        /* Link-like text resets */
        a { text-decoration: none; color: inherit; }

        /* Header layout helpers */
        .header-left { flex: 1; }
        .header-right { text-align: right; }

        @media (max-width: 768px) {
            .header-right { text-align: left; }
        }
    </style>

@endsection