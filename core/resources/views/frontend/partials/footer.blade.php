@php
use App\Models\Setting;

$settings = Setting::first();
$email = $settings?->email ?? 'hello@shadowwhisper.com';
$phone = $settings?->phone ?? '+880 0000 000000';
$location = $settings?->location ?? 'Hidden Realm';
@endphp

<!-- ===== ANONYMOUS CONFESSION SECTION ===== -->
<section id="confessionSection">

    <!-- ===== BACKGROUND ===== -->
    <div class="confession-bg">
        <div class="grid-lines"></div>
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
        <div class="bg-orb bg-orb-3"></div>
        <div class="scan-line"></div>
        <div class="vignette"></div>
    </div>

    <div class="confession-wrapper">

        <!-- ===== HEADER ===== -->
        <div class="section-header fade-up">
            <h2><i class="bi bi-incognito"></i> Whisper to Shadow</h2>
            <p>Your identity stays hidden. Your truth remains.</p>
        </div>

        <div class="confession-grid">

            <!-- ===== FORM CARD ===== -->
            <div class="form-card fade-up">

                <!-- SUCCESS OVERLAY -->
                <div class="success-overlay" id="successOverlay">
                    <div class="success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h4>Confession Sent</h4>
                    <p>Your secret is safe.</p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                    @csrf

                    <!-- NAME -->
                    <div class="form-group" id="nameGroup">
                        <label><i class="bi bi-person"></i> Name (Optional)</label>
                        <input type="text" name="name" class="form-input" placeholder="Anonymous">
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label><i class="bi bi-envelope"></i> Email (Optional)</label>
                        <input type="email" name="email" class="form-input" placeholder="hidden@email.com">
                    </div>

                    <!-- MESSAGE -->
                    <div class="form-group">
                        <label><i class="bi bi-chat"></i> Confession</label>
                        <textarea name="message" class="form-input" required placeholder="Write your secret..."></textarea>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" id="submitBtn" class="submit-btn">
                        <i class="bi bi-send"></i> Send
                    </button>
                </form>
            </div>

            <!-- ===== INFO CARD ===== -->
            <div class="info-card fade-up">

                <div class="info-box">
                    <i class="bi bi-clock-fill"></i>
                    <div>
                        <h6>Always Open</h6>
                        <p>24/7 Confession</p>
                    </div>
                </div>

                <!-- SETTINGS INFO -->
                <div class="info-box">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h6>Location</h6>
                        <p>{{ $location }}</p>
                    </div>
                </div>

                <div class="info-box">
                    <i class="bi bi-telephone-fill"></i>
                    <div>
                        <h6>Phone</h6>
                        <p>{{ $phone }}</p>
                    </div>
                </div>

                <div class="info-box">
                    <i class="bi bi-envelope-fill"></i>
                    <div>
                        <h6>Email</h6>
                        <p>{{ $email }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
/* ===== SAFE QUERY HELPER ===== */
function qs(selector) {
    return document.querySelector(selector);
}
function qsId(id) {
    return document.getElementById(id);
}

/* ===== WHISPER WORDS FLOATING ===== */
const whisperWords = [
    'I never said...', 'forgive me', 'truth', 'secret', 'whisper',
    'hidden', 'untold', 'silence', 'confess', 'shadow', 'I wish...',
    'no one knows', 'only in the dark', 'unseen', 'anonymous',
    'my truth', 'let go', 'I lied once', 'beneath the surface',
    'unspoken', 'in the shadows', 'my deepest fear', 'only I know'
];

function createWhisperWord() {
    const bg = qs('.confession-bg');
    if (!bg) return;

    const word = document.createElement('div');
    word.className = 'whisper-word';
    word.textContent = whisperWords[Math.floor(Math.random() * whisperWords.length)];
    word.style.left = Math.random() * 90 + '%';
    word.style.bottom = '-30px';

    const duration = 12 + Math.random() * 10;
    word.style.animationDuration = duration + 's';
    word.style.fontSize = (10 + Math.random() * 10) + 'px';

    bg.appendChild(word);
    setTimeout(() => word.remove(), duration * 1000);
}

setInterval(createWhisperWord, 1800);
for (let i = 0; i < 5; i++) {
    setTimeout(createWhisperWord, i * 600);
}

/* ===== PARTICLES ===== */
function createParticle() {
    const bg = qs('.confession-bg');
    if (!bg) return;

    const p = document.createElement('div');
    p.className = 'conf-particle';
    p.style.left = Math.random() * 100 + '%';
    p.style.bottom = '-5px';

    const size = 1 + Math.random() * 3;
    p.style.width = size + 'px';
    p.style.height = size + 'px';

    const dur = 8 + Math.random() * 10;
    p.style.animationDuration = dur + 's';

    bg.appendChild(p);
    setTimeout(() => p.remove(), dur * 1000);
}
setInterval(createParticle, 800);

/* ===== INK DRIPS ===== */
function createInkDrip() {
    const bg = qs('.confession-bg');
    if (!bg) return;

    const drip = document.createElement('div');
    drip.className = 'ink-drip';
    drip.style.left = Math.random() * 100 + '%';

    const dur = 4 + Math.random() * 6;
    drip.style.animationDuration = dur + 's';
    drip.style.opacity = Math.random() * 0.4 + 0.1;

    bg.appendChild(drip);
    setTimeout(() => drip.remove(), dur * 1000 + 500);
}
setInterval(createInkDrip, 3000);
createInkDrip();

/* ===== WHISPER ORBS ===== */
const orbContainer = qsId('whisperOrbs');
if (orbContainer) {
    for (let i = 0; i < 5; i++) {
        const orb = document.createElement('div');
        orb.className = 'w-orb';

        const size = 80 + Math.random() * 150;
        orb.style.width = size + 'px';
        orb.style.height = size + 'px';

        orb.style.left = Math.random() * 90 + '%';
        orb.style.top = Math.random() * 90 + '%';
        orb.style.animationDuration = (4 + Math.random() * 5) + 's';
        orb.style.animationDelay = (Math.random() * 3) + 's';

        orbContainer.appendChild(orb);
    }
}

/* ===== LIVE CONFESSION TICKER ===== */
const confessions = [
    { text: "I never told anyone how much that moment changed me forever...", time: "just now" },
    { text: "I still think about the road not taken. Every single day.", time: "2m ago" },
    { text: "I smiled and said I was fine. I wasn't.", time: "5m ago" },
    { text: "I forgave them, but I never forgot.", time: "8m ago" }
];

let tickerIdx = 0;
function updateTicker() {
    const textEl = qsId('tickerText');
    const authorEl = qsId('tickerAuthor');
    if (!textEl || !authorEl) return;

    tickerIdx = (tickerIdx + 1) % confessions.length;

    textEl.style.opacity = '0';
    textEl.style.transform = 'translateY(8px)';

    setTimeout(() => {
        textEl.textContent = `"${confessions[tickerIdx].text}"`;
        authorEl.innerHTML = '<i class="bi bi-incognito"></i> Anonymous · ' + confessions[tickerIdx].time;
        textEl.style.opacity = '1';
        textEl.style.transform = 'translateY(0)';
    }, 400);
}
setInterval(updateTicker, 4000);

/* ===== ROTATING QUOTES ===== */
const quotes = [
    { text: "In the darkness of anonymity, truth finds its purest voice.", author: "— A Shadow Whisperer" },
    { text: "Here, your name is nothing. Your truth is everything.", author: "— ShadowWhisper" }
];

let quoteIdx = 0;
function updateQuote() {
    const qText = qsId('quoteText');
    const qAuthor = qsId('quoteAuthor');
    if (!qText || !qAuthor) return;

    quoteIdx = (quoteIdx + 1) % quotes.length;

    qText.style.opacity = '0';
    setTimeout(() => {
        qText.textContent = `"${quotes[quoteIdx].text}"`;
        qAuthor.textContent = quotes[quoteIdx].author;
        qText.style.opacity = '1';
    }, 600);
}
setInterval(updateQuote, 6000);

/* ===== COUNTER ===== */
function animateCounter(el, end, duration) {
    let start = 0;
    const step = end / (duration / 50);

    const timer = setInterval(() => {
        start += step;
        if (start >= end) {
            start = end;
            clearInterval(timer);
        }
        el.textContent = Math.floor(start).toLocaleString() + '+';
    }, 50);
}

const section = qsId('confessionSection');
if (section) {
    const observer = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting) {
            const el = qsId('statConfessions');
            if (el) animateCounter(el, 12000, 2000);
            observer.disconnect();
        }
    }, { threshold: 0.5 });

    observer.observe(section);
}

/* ===== ANON TOGGLE ===== */
function toggleAnon() {
    const toggle = qsId('anonToggle');
    const nameGroup = qsId('nameGroup');
    if (!toggle || !nameGroup) return;

    toggle.classList.toggle('active');
    const isOn = toggle.classList.contains('active');

    nameGroup.style.opacity = isOn ? '0.5' : '1';
    const input = nameGroup.querySelector('input');
    if (input) {
        input.placeholder = isOn ? 'Anonymous Whisperer' : 'Your real name...';
    }
}

/* ===== RIPPLE ===== */
function handleRipple(e, btn) {
    const ripple = document.createElement('span');
    ripple.className = 'btn-ripple';

    const size = Math.max(btn.offsetWidth, btn.offsetHeight);
    const rect = btn.getBoundingClientRect();

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';

    btn.appendChild(ripple);
    setTimeout(() => ripple.remove(), 700);
}

/* ===== BUTTON CLICK HARD LOCK (REAL FIX) ===== */
let isLocked = false;

const btn = document.getElementById('submitBtn');
const form = document.getElementById('contactForm');

if (btn && form) {

    form.addEventListener('submit', function(e) {

        if (isLocked) {
            e.preventDefault();
            return false;
        }

        isLocked = true;

        btn.disabled = true;
        btn.style.pointerEvents = 'none';
        btn.style.opacity = '0.6';
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';

        form.querySelectorAll('input, textarea, button').forEach(el => {
            el.disabled = true;
        });

        localStorage.setItem('form_locked', 'true');
    });
}

/* ===== PAGE LOAD LOCK ===== */
window.addEventListener('load', function() {
    if (localStorage.getItem('form_locked') === 'true') {
        if (btn) {
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.6';
            btn.innerHTML = '<i class="bi bi-check-circle"></i> Already Sent';
        }
    }
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600&family=Crimson+Text:ital,wght@0,400;0,600;1,400&display=swap');

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #0D0D0D;
            --bg-secondary: #111111;
            --bg-card: #141414;
            --bg-card-hover: #181818;
            --accent: #4B0082;
            --accent-light: #6A0DAD;
            --accent-glow: #7B2FBE;
            --accent-soft: rgba(75, 0, 130, 0.15);
            --accent-border: rgba(75, 0, 130, 0.4);
            --text-primary: #F0EAF8;
            --text-secondary: #A89BC2;
            --text-muted: #6B5F7A;
            --border-subtle: rgba(255, 255, 255, 0.05);
            --shadow-glow: 0 0 30px rgba(75, 0, 130, 0.3);
            --shadow-deep: 0 20px 60px rgba(0, 0, 0, 0.8);
        }

        body {
            background: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
        }

        /* ===== CONFESSION SECTION ===== */
        #confessionSection {
            position: relative;
            min-height: 100vh;
            background: var(--bg-primary);
            overflow: hidden;
            padding: 100px 0;
        }

        /* ===== ANIMATED BACKGROUND ===== */
        .confession-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        /* Radial gradient orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            animation: orbFloat 10s ease-in-out infinite alternate;
        }

        .bg-orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #4B0082, transparent);
            top: -100px;
            left: -100px;
            animation-duration: 12s;
        }

        .bg-orb-2 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #6A0DAD, transparent);
            bottom: -80px;
            right: -60px;
            animation-duration: 9s;
            animation-delay: -3s;
        }

        .bg-orb-3 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, #3A0060, transparent);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-duration: 15s;
            opacity: 0.1;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 20px) scale(1.1); }
        }

        /* Floating whisper words */
        .whisper-word {
            position: absolute;
            font-family: 'Crimson Text', serif;
            font-style: italic;
            color: rgba(75, 0, 130, 0.15);
            font-size: clamp(10px, 1.5vw, 16px);
            white-space: nowrap;
            pointer-events: none;
            animation: whisperFloat linear infinite;
            user-select: none;
        }

        @keyframes whisperFloat {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% { opacity: 1; }
            90% { opacity: 0.6; }
            100% {
                transform: translateY(-100vh) translateX(30px);
                opacity: 0;
            }
        }

        /* Shadow figure silhouette */
        .shadow-figure {
            position: absolute;
            bottom: 0;
            right: 8%;
            width: 200px;
            height: 400px;
            background: linear-gradient(to top, rgba(75,0,130,0.06), transparent);
            clip-path: polygon(35% 0%, 65% 0%, 80% 30%, 90% 60%, 100% 100%, 0% 100%, 10% 60%, 20% 30%);
            animation: shadowBreath 6s ease-in-out infinite alternate;
            pointer-events: none;
            filter: blur(2px);
        }

        @keyframes shadowBreath {
            0% { opacity: 0.3; transform: scaleX(1) scaleY(1); }
            100% { opacity: 0.7; transform: scaleX(1.05) scaleY(1.02); }
        }

        /* Grid lines (subtle) */
        .grid-lines {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(75,0,130,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(75,0,130,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Floating confession particles */
        .conf-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(107, 45, 190, 0.5);
            border-radius: 50%;
            animation: particleDrift linear infinite;
        }

        @keyframes particleDrift {
            0% { transform: translateY(100vh) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 0.5; }
            100% { transform: translateY(-10vh) translateX(40px); opacity: 0; }
        }

        /* Ink drip effect */
        .ink-drip {
            position: absolute;
            top: 0;
            width: 2px;
            background: linear-gradient(to bottom, transparent, rgba(75,0,130,0.4), transparent);
            animation: inkDrip linear infinite;
            pointer-events: none;
        }

        @keyframes inkDrip {
            0% { height: 0; top: -10%; opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 0.6; }
            100% { height: 100%; top: 110%; opacity: 0; }
        }

        /* Scanning line */
        .scan-line {
            position: absolute;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(75,0,130,0.3), transparent);
            animation: scanMove 8s linear infinite;
            pointer-events: none;
        }

        @keyframes scanMove {
            0% { top: -2%; }
            100% { top: 102%; }
        }

        /* Vignette overlay */
        .vignette {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, transparent 40%, rgba(0,0,0,0.7) 100%);
            pointer-events: none;
        }

        /* ===== WRAPPER ===== */
        .confession-wrapper {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ===== SECTION HEADER ===== */
        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(75, 0, 130, 0.12);
            border: 1px solid rgba(75, 0, 130, 0.3);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent-glow);
            margin-bottom: 24px;
            animation: badgePulse 3s ease-in-out infinite;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background: var(--accent-glow);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--accent-glow);
            animation: dotBlink 2s ease-in-out infinite;
        }

        @keyframes badgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(75,0,130,0.2); }
            50% { box-shadow: 0 0 0 6px rgba(75,0,130,0); }
        }

        @keyframes dotBlink {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.7); }
        }

        .section-header h2 {
            font-family: 'Cinzel', serif;
            font-size: clamp(32px, 5vw, 52px);
            font-weight: 700;
            background: linear-gradient(135deg, #F0EAF8 0%, #C084FC 50%, #7B2FBE 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 16px;
            animation: titleGlow 4s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            0% { filter: drop-shadow(0 0 10px rgba(75,0,130,0.3)); }
            100% { filter: drop-shadow(0 0 25px rgba(107,45,190,0.6)); }
        }

        .section-header .title-icon {
            font-size: clamp(24px, 3.5vw, 38px);
            color: var(--accent-glow);
            margin-right: 10px;
            display: inline-block;
            animation: iconSpin 8s linear infinite;
        }

        @keyframes iconSpin {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
        }

        .section-header p {
            font-family: 'Crimson Text', serif;
            font-style: italic;
            font-size: clamp(15px, 2vw, 19px);
            color: var(--text-secondary);
            letter-spacing: 0.3px;
        }

        /* Decorative divider */
        .header-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin: 20px auto 0;
            width: fit-content;
        }

        .divider-line {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(75,0,130,0.5));
        }

        .divider-line.right {
            background: linear-gradient(90deg, rgba(75,0,130,0.5), transparent);
        }

        .divider-icon {
            color: var(--accent-glow);
            font-size: 14px;
            opacity: 0.8;
        }

        /* ===== GRID LAYOUT ===== */
        .confession-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 28px;
            align-items: start;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: linear-gradient(145deg, #141414, #0F0F0F);
            border: 1px solid rgba(75, 0, 130, 0.25);
            border-radius: 20px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.4s ease, box-shadow 0.4s ease;
            animation: cardSlideIn 0.8s ease forwards;
        }

        @keyframes cardSlideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-card:hover {
            border-color: rgba(75, 0, 130, 0.5);
            box-shadow: 0 0 40px rgba(75, 0, 130, 0.15), var(--shadow-deep);
        }

        /* Corner accent */
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at top left, rgba(75,0,130,0.2), transparent 70%);
            pointer-events: none;
        }

        .form-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at bottom right, rgba(75,0,130,0.15), transparent 70%);
            pointer-events: none;
        }

        /* Card title */
        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(75,0,130,0.2);
        }

        .card-title i {
            color: var(--accent-glow);
            font-size: 20px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .form-label i {
            font-size: 13px;
            color: var(--accent-glow);
            opacity: 0.7;
        }

        .form-group:focus-within .form-label {
            color: var(--accent-glow);
        }

        .form-group:focus-within .form-label i {
            opacity: 1;
        }

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(75, 0, 130, 0.2);
            border-radius: 10px;
            padding: 13px 16px;
            font-size: 14px;
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
            position: relative;
        }

        .form-input::placeholder {
            color: rgba(168, 155, 194, 0.35);
            font-style: italic;
        }

        .form-input:focus {
            background: rgba(75, 0, 130, 0.06);
            border-color: rgba(107, 45, 190, 0.6);
            box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1), 0 0 20px rgba(75, 0, 130, 0.08);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 130px;
            font-family: 'Crimson Text', serif;
            font-size: 15px;
            line-height: 1.6;
        }

        /* Anonymity toggle */
        .anon-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: rgba(75,0,130,0.07);
            border: 1px solid rgba(75,0,130,0.15);
            border-radius: 10px;
            margin-bottom: 22px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .anon-toggle:hover {
            background: rgba(75,0,130,0.12);
            border-color: rgba(75,0,130,0.3);
        }

        .toggle-switch {
            width: 38px;
            height: 20px;
            background: rgba(75,0,130,0.3);
            border-radius: 10px;
            position: relative;
            transition: background 0.3s;
            flex-shrink: 0;
        }

        .toggle-switch.active {
            background: var(--accent);
            box-shadow: 0 0 10px rgba(75,0,130,0.5);
        }

        .toggle-knob {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 14px;
            height: 14px;
            background: #fff;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        .toggle-switch.active .toggle-knob {
            transform: translateX(18px);
        }

        .anon-text {
            flex: 1;
        }

        .anon-text strong {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .anon-text span {
            font-size: 11px;
            color: var(--text-muted);
        }

        .anon-icon {
            font-size: 20px;
            color: var(--accent-glow);
            animation: maskFloat 3s ease-in-out infinite alternate;
        }

        @keyframes maskFloat {
            0% { transform: translateY(0); opacity: 0.7; }
            100% { transform: translateY(-4px); opacity: 1; }
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 15px 28px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 60%, #8B0EB8 100%);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(75, 0, 130, 0.5), 0 0 0 1px rgba(107,45,190,0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn i {
            font-size: 16px;
            animation: sendPulse 2s ease-in-out infinite;
        }

        @keyframes sendPulse {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(3px); }
        }

        /* Ripple on submit */
        .btn-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            transform: scale(0);
            animation: rippleAnim 0.6s linear;
            pointer-events: none;
        }

        @keyframes rippleAnim {
            to { transform: scale(4); opacity: 0; }
        }

        /* ===== SUCCESS OVERLAY ===== */
        .success-overlay {
            position: absolute;
            inset: 0;
            background: rgba(13, 13, 13, 0.96);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
            gap: 16px;
            text-align: center;
            padding: 40px;
        }

        .success-overlay.show {
            opacity: 1;
            pointer-events: all;
        }

        .success-icon-wrap {
            width: 72px;
            height: 72px;
            background: rgba(75,0,130,0.2);
            border: 1px solid rgba(75,0,130,0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #C084FC;
            animation: successPop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            box-shadow: 0 0 30px rgba(75,0,130,0.3);
        }

        @keyframes successPop {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }

        .success-overlay h4 {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            color: var(--text-primary);
        }

        .success-overlay p {
            font-family: 'Crimson Text', serif;
            font-style: italic;
            font-size: 16px;
            color: var(--text-secondary);
        }

        /* ===== INFO CARD ===== */
        .info-card {
            display: flex;
            flex-direction: column;
            gap: 16px;
            animation: cardSlideIn 0.8s ease 0.2s both;
        }

        /* Anonymous quote box */
        .quote-box {
            background: linear-gradient(145deg, rgba(75,0,130,0.12), rgba(75,0,130,0.05));
            border: 1px solid rgba(75,0,130,0.3);
            border-radius: 16px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .quote-box::before {
            content: '\201C';
            position: absolute;
            top: -10px;
            left: 16px;
            font-family: 'Crimson Text', serif;
            font-size: 100px;
            color: rgba(75,0,130,0.2);
            line-height: 1;
        }

        .quote-text {
            font-family: 'Crimson Text', serif;
            font-style: italic;
            font-size: 17px;
            color: var(--text-secondary);
            line-height: 1.7;
            position: relative;
            z-index: 1;
            margin-bottom: 14px;
        }

        .quote-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .quote-meta i {
            color: var(--accent-glow);
        }

        /* Floating confessions ticker */
        .confession-ticker {
            background: rgba(13,13,13,0.8);
            border: 1px solid rgba(75,0,130,0.2);
            border-radius: 12px;
            padding: 16px 20px;
            overflow: hidden;
        }

        .ticker-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .ticker-header i {
            color: var(--accent-glow);
        }

        .ticker-live-dot {
            width: 6px;
            height: 6px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 6px #22c55e;
            animation: liveBlink 1.5s ease-in-out infinite;
            margin-left: auto;
        }

        @keyframes liveBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.2; }
        }

        .ticker-text {
            font-family: 'Crimson Text', serif;
            font-style: italic;
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.5;
            animation: tickerFade 0.5s ease;
        }

        @keyframes tickerFade {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .ticker-author {
            margin-top: 8px;
            font-size: 11px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ticker-author i {
            color: var(--accent-glow);
            font-size: 12px;
        }

        /* Info boxes */
        .info-box {
            display: flex;
            align-items: center;
            gap: 16px;
            background: linear-gradient(145deg, #141414, #111111);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            padding: 18px 20px;
            transition: all 0.35s ease;
            cursor: default;
            position: relative;
            overflow: hidden;
        }

        .info-box::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, var(--accent), var(--accent-light));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .info-box:hover {
            border-color: rgba(75, 0, 130, 0.35);
            background: linear-gradient(145deg, rgba(75,0,130,0.06), #111111);
            transform: translateX(4px);
            box-shadow: 0 4px 20px rgba(75,0,130,0.1);
        }

        .info-box:hover::before {
            opacity: 1;
        }

        .info-icon-wrap {
            width: 42px;
            height: 42px;
            background: rgba(75, 0, 130, 0.12);
            border: 1px solid rgba(75, 0, 130, 0.25);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: var(--accent-glow);
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .info-box:hover .info-icon-wrap {
            background: rgba(75,0,130,0.2);
            box-shadow: 0 0 15px rgba(75,0,130,0.3);
        }

        .info-text h6 {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 3px;
        }

        .info-text p {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Stats row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .stat-box {
            background: linear-gradient(145deg, rgba(75,0,130,0.08), rgba(75,0,130,0.03));
            border: 1px solid rgba(75,0,130,0.2);
            border-radius: 12px;
            padding: 16px 12px;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-box:hover {
            border-color: rgba(75,0,130,0.4);
            box-shadow: 0 0 20px rgba(75,0,130,0.12);
        }

        .stat-number {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            font-weight: 700;
            background: linear-gradient(135deg, #C084FC, #7B2FBE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        .stat-label {
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 3px;
            display: block;
        }

        /* ===== FLOATING WHISPER ICON ANIMATION ===== */
        .whisper-orbs {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 1;
        }

        .w-orb {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(75,0,130,0.25), transparent 70%);
            animation: wOrbPulse ease-in-out infinite alternate;
        }

        @keyframes wOrbPulse {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.3); opacity: 0.7; }
        }

        /* ===== FADE IN ANIMATIONS ===== */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUpAnim 0.8s ease forwards;
        }

        .fade-up:nth-child(1) { animation-delay: 0.1s; }
        .fade-up:nth-child(2) { animation-delay: 0.2s; }
        .fade-up:nth-child(3) { animation-delay: 0.3s; }

        @keyframes fadeUpAnim {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .confession-grid {
                grid-template-columns: 1fr;
            }

            #confessionSection {
                padding: 80px 0;
            }

            .stats-row {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 500px) {
            .form-card {
                padding: 28px 20px;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>