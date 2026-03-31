@php
use App\Models\Setting;

$settings = Setting::first();
$email = $settings?->email ?? 'hello@shadowwhisper.com';
$phone = $settings?->phone ?? '+880 0000 000000';
$location = $settings?->location ?? 'Hidden Realm';
@endphp

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ===== CSS VARIABLES ===== */
:root {
    --primary: #0D0D0D;
    --primary-light: #141414;
    --primary-lighter: #1a1a1a;
    --accent: #4B0082;
    --accent-light: #6a1ab5;
    --accent-glow: rgba(75, 0, 130, 0.4);
    --accent-soft: rgba(75, 0, 130, 0.15);
    --text-primary: #e8e6f0;
    --text-secondary: #9b97a8;
    --text-muted: #6b6778;
    --border-color: rgba(75, 0, 130, 0.2);
    --card-bg: rgba(20, 20, 20, 0.85);
    --glass-bg: rgba(75, 0, 130, 0.06);
}

/* ===== SECTION BASE ===== */
#confessionSection {
    position: relative;
    min-height: 100vh;
    background: var(--primary);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    font-family: 'Inter', sans-serif;
}

/* ===== BACKGROUND EFFECTS ===== */
.confession-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    pointer-events: none;
}

.grid-lines {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(75, 0, 130, 0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(75, 0, 130, 0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    animation: gridDrift 20s linear infinite;
}

@keyframes gridDrift {
    0% { transform: translate(0, 0); }
    100% { transform: translate(60px, 60px); }
}

.bg-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    opacity: 0.35;
    animation: orbFloat 12s ease-in-out infinite;
}

.bg-orb-1 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, var(--accent) 0%, transparent 70%);
    top: -15%;
    left: -10%;
    animation-delay: 0s;
    animation-duration: 14s;
}

.bg-orb-2 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, #2d004d 0%, transparent 70%);
    bottom: -10%;
    right: -8%;
    animation-delay: -4s;
    animation-duration: 16s;
}

.bg-orb-3 {
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(75, 0, 130, 0.5) 0%, transparent 70%);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation-delay: -7s;
    animation-duration: 18s;
    opacity: 0.2;
}

@keyframes orbFloat {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(30px, -40px) scale(1.05); }
    50% { transform: translate(-20px, 30px) scale(0.95); }
    75% { transform: translate(40px, 20px) scale(1.02); }
}

.scan-line {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--accent-glow), var(--accent-light), var(--accent-glow), transparent);
    animation: scanDown 6s linear infinite;
    opacity: 0.5;
}

@keyframes scanDown {
    0% { top: -2px; }
    100% { top: 100%; }
}

.vignette {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, transparent 40%, rgba(0, 0, 0, 0.6) 100%);
}

/* ===== FLOATING PARTICLES ===== */
.particle-field {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 3px;
    height: 3px;
    background: var(--accent-light);
    border-radius: 50%;
    opacity: 0;
    animation: particleRise linear infinite;
}

@keyframes particleRise {
    0% {
        opacity: 0;
        transform: translateY(100vh) scale(0);
    }
    10% {
        opacity: 0.6;
    }
    90% {
        opacity: 0.3;
    }
    100% {
        opacity: 0;
        transform: translateY(-20px) scale(1);
    }
}

/* ===== WRAPPER ===== */
.confession-wrapper {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    width: 100%;
    margin: 0 auto;
}

/* ===== HEADER ===== */
.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 16px;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

.section-header h2 i {
    color: var(--accent-light);
    margin-right: 12px;
    font-size: 0.85em;
    animation: iconPulse 3s ease-in-out infinite;
    display: inline-block;
}

@keyframes iconPulse {
    0%, 100% { transform: scale(1); filter: drop-shadow(0 0 0px var(--accent)); }
    50% { transform: scale(1.1); filter: drop-shadow(0 0 15px var(--accent-glow)); }
}

.section-header p {
    font-size: 1.1rem;
    color: var(--text-secondary);
    font-weight: 300;
    letter-spacing: 0.5px;
    position: relative;
    display: inline-block;
}

.section-header p::after {
    content: '';
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
    animation: lineGlow 2.5s ease-in-out infinite;
}

@keyframes lineGlow {
    0%, 100% { opacity: 0.4; width: 40px; }
    50% { opacity: 1; width: 80px; }
}

/* ===== GRID LAYOUT ===== */
.confession-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 40px;
    align-items: start;
}

@media (max-width: 768px) {
    .confession-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

/* ===== FORM CARD ===== */
.form-card {
    position: relative;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 40px;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    overflow: hidden;
    transition: border-color 0.4s ease, box-shadow 0.4s ease;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
    opacity: 0.5;
}

.form-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 20px;
    background: radial-gradient(circle at top right, var(--accent-soft), transparent 60%);
    pointer-events: none;
}

.form-card:hover {
    border-color: rgba(75, 0, 130, 0.4);
    box-shadow: 0 0 40px rgba(75, 0, 130, 0.1), inset 0 0 40px rgba(75, 0, 130, 0.03);
}

/* ===== FORM ELEMENTS ===== */
.form-group {
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
}

.form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: 8px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    transition: color 0.3s ease;
}

.form-group label i {
    color: var(--accent-light);
    margin-right: 6px;
    font-size: 0.9rem;
}

.form-input {
    width: 100%;
    padding: 14px 18px;
    background: rgba(13, 13, 13, 0.7);
    border: 1px solid rgba(75, 0, 130, 0.15);
    border-radius: 12px;
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    outline: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-sizing: border-box;
}

.form-input::placeholder {
    color: var(--text-muted);
    font-style: italic;
}

.form-input:focus {
    border-color: var(--accent-light);
    background: rgba(13, 13, 13, 0.9);
    box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.15), 0 0 20px rgba(75, 0, 130, 0.08);
}

.form-group:focus-within label {
    color: var(--accent-light);
}

textarea.form-input {
    min-height: 140px;
    resize: vertical;
    line-height: 1.6;
}

/* ===== SUBMIT BUTTON ===== */
.submit-btn {
    position: relative;
    z-index: 1;
    width: 100%;
    padding: 16px 32px;
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.submit-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--accent-light) 0%, #7b1fa2 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(75, 0, 130, 0.4), 0 0 60px rgba(75, 0, 130, 0.15);
}

.submit-btn:hover::before {
    opacity: 1;
}

.submit-btn:active {
    transform: translateY(0);
}

.submit-btn i,
.submit-btn span {
    position: relative;
    z-index: 1;
}

.submit-btn i {
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.submit-btn:hover i {
    transform: translateX(4px) rotate(-15deg);
}

/* Ripple effect on button */
.submit-btn .ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(0);
    animation: ripple 0.6s linear;
    pointer-events: none;
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* ===== SUCCESS OVERLAY ===== */
.success-overlay {
    position: absolute;
    inset: 0;
    background: rgba(13, 13, 13, 0.97);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 10;
    border-radius: 20px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
}

.success-overlay.active {
    opacity: 1;
    visibility: visible;
}

.success-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent-light));
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    animation: successPop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
    box-shadow: 0 0 40px var(--accent-glow);
}

.success-icon i {
    font-size: 2rem;
    color: #fff;
}

@keyframes successPop {
    0% { transform: scale(0) rotate(-180deg); }
    100% { transform: scale(1) rotate(0deg); }
}

.success-overlay h4 {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.success-overlay p {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

/* ===== INFO CARD ===== */
.info-card {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.info-box {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 24px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    cursor: default;
}

.info-box::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, var(--accent), var(--accent-light));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.info-box:hover {
    border-color: rgba(75, 0, 130, 0.35);
    transform: translateX(6px);
    box-shadow: 0 4px 20px rgba(75, 0, 130, 0.1);
}

.info-box:hover::before {
    opacity: 1;
}

.info-box > i {
    font-size: 1.4rem;
    color: var(--accent-light);
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--accent-soft);
    border-radius: 12px;
    flex-shrink: 0;
    transition: all 0.4s ease;
}

.info-box:hover > i {
    background: linear-gradient(135deg, var(--accent), var(--accent-light));
    color: #fff;
    box-shadow: 0 0 20px var(--accent-glow);
    transform: scale(1.05);
}

.info-box div h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 4px 0;
    letter-spacing: 0.3px;
}

.info-box div p {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin: 0;
    font-weight: 300;
}

/* ===== WHISPER QUOTES ===== */
.whisper-quote {
    text-align: center;
    padding: 20px 24px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    backdrop-filter: blur(20px);
    margin-top: 0;
    position: relative;
    overflow: hidden;
}

.whisper-quote::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
    opacity: 0.3;
}

.whisper-quote i {
    font-size: 1.2rem;
    color: var(--accent-light);
    display: block;
    margin-bottom: 10px;
    opacity: 0.6;
}

.whisper-quote p {
    font-family: 'Playfair Display', serif;
    font-size: 0.95rem;
    color: var(--text-secondary);
    font-style: italic;
    margin: 0;
    line-height: 1.6;
}

.whisper-quote .quote-author {
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-top: 8px;
    font-style: normal;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* ===== ANONYMOUS BADGE ===== */
.anon-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: var(--accent-soft);
    border: 1px solid var(--border-color);
    border-radius: 100px;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
}

.anon-badge i {
    color: var(--accent-light);
    font-size: 0.85rem;
    animation: shieldPulse 2s ease-in-out infinite;
}

@keyframes shieldPulse {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 1; text-shadow: 0 0 8px var(--accent-glow); }
}

.anon-badge span {
    font-size: 0.75rem;
    color: var(--text-secondary);
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* ===== TYPING INDICATOR ===== */
.typing-indicator {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 12px 20px;
    background: rgba(75, 0, 130, 0.08);
    border-radius: 20px 20px 20px 4px;
    width: fit-content;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
}

.typing-dot {
    width: 6px;
    height: 6px;
    background: var(--accent-light);
    border-radius: 50%;
    animation: typingBounce 1.4s ease-in-out infinite;
}

.typing-dot:nth-child(2) { animation-delay: 0.2s; }
.typing-dot:nth-child(3) { animation-delay: 0.4s; }

@keyframes typingBounce {
    0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
    30% { transform: translateY(-8px); opacity: 1; }
}

.typing-text {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-left: 6px;
    font-style: italic;
}

/* ===== ENCRYPTION BAR ===== */
.encrypt-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    background: rgba(75, 0, 130, 0.06);
    border: 1px solid rgba(75, 0, 130, 0.1);
    border-radius: 10px;
    margin-top: 16px;
    position: relative;
    z-index: 1;
}

.encrypt-bar i {
    color: var(--accent-light);
    font-size: 0.9rem;
    animation: lockPulse 3s ease-in-out infinite;
}

@keyframes lockPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); filter: drop-shadow(0 0 6px var(--accent-glow)); }
}

.encrypt-bar span {
    font-size: 0.75rem;
    color: var(--text-muted);
    letter-spacing: 0.5px;
}

.encrypt-chars {
    margin-left: auto;
    font-family: 'Courier New', monospace;
    font-size: 0.7rem;
    color: var(--accent-light);
    opacity: 0.5;
    letter-spacing: 2px;
    overflow: hidden;
    width: 80px;
    text-align: right;
}

/* ===== FADE UP ANIMATION ===== */
.fade-up {
    opacity: 0;
    transform: translateY(40px);
    animation: fadeUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.fade-up:nth-child(1) { animation-delay: 0.1s; }
.fade-up:nth-child(2) { animation-delay: 0.3s; }

.confession-grid .fade-up:nth-child(1) { animation-delay: 0.3s; }
.confession-grid .fade-up:nth-child(2) { animation-delay: 0.5s; }

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== INFO BOX STAGGER ===== */
.info-box {
    opacity: 0;
    transform: translateX(30px);
    animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.info-box:nth-child(1) { animation-delay: 0.6s; }
.info-box:nth-child(2) { animation-delay: 0.75s; }
.info-box:nth-child(3) { animation-delay: 0.9s; }
.info-box:nth-child(4) { animation-delay: 1.05s; }
.info-box:nth-child(5) { animation-delay: 1.2s; }

@keyframes slideIn {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* ===== WHISPER QUOTE STAGGER ===== */
.whisper-quote {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    animation-delay: 1.35s;
}

/* ===== CONFESSION COUNTER ===== */
.confession-counter {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 20px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    backdrop-filter: blur(20px);
}

.confession-counter i {
    color: var(--accent-light);
    font-size: 1rem;
}

.confession-counter .count-num {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-primary);
    min-width: 60px;
    text-align: center;
}

.confession-counter .count-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ===== GLITCH TEXT EFFECT ===== */
.glitch-wrap {
    position: relative;
    display: inline-block;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    #confessionSection {
        padding: 60px 16px;
    }

    .form-card {
        padding: 28px 22px;
    }

    .section-header {
        margin-bottom: 40px;
    }

    .info-box {
        padding: 18px;
    }
}

@media (max-width: 480px) {
    .section-header h2 {
        font-size: 1.8rem;
    }

    .form-card {
        padding: 24px 18px;
        border-radius: 16px;
    }

    .submit-btn {
        padding: 14px 24px;
        font-size: 0.9rem;
    }
}
</style>

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

    <!-- ===== FLOATING PARTICLES ===== -->
    <div class="particle-field" id="particleField"></div>

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
                    <p>Your secret is safe in the shadows.</p>
                </div>

                <!-- ANON BADGE -->
                <div class="anon-badge">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>End-to-End Anonymous</span>
                </div>

                <!-- TYPING INDICATOR -->
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <span class="typing-text">Someone is confessing...</span>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                    @csrf

                    <!-- NAME -->
                    <div class="form-group" id="nameGroup">
                        <label><i class="bi bi-person-fill-lock"></i> Name </label>
                        <input type="text" name="name" class="form-input" placeholder="Anonymous" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label><i class="bi bi-envelope-at-fill"></i> Email </label>
                        <input type="email" name="email" class="form-input" placeholder="hidden@email.com" required>
                    </div>

                    <!-- MESSAGE -->
                    <div class="form-group">
                        <label><i class="bi bi-chat-square-text-fill"></i> Confession</label>
                        <textarea name="message" class="form-input" required placeholder="Write your deepest secret..."></textarea>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" id="submitBtn" class="submit-btn">
                        <i class="bi bi-send-fill"></i> <span>Send Confession</span>
                    </button>
                </form>

                <!-- ENCRYPTION BAR -->
                <div class="encrypt-bar">
                    <i class="bi bi-lock-fill"></i>
                    <span>256-bit Shadow Encryption</span>
                    <div class="encrypt-chars" id="encryptChars"></div>
                </div>
            </div>

            <!-- ===== INFO CARD ===== -->
            <div class="info-card fade-up">

                <!-- CONFESSION COUNTER -->
                <div class="confession-counter info-box">
                    <i class="bi bi-eye-slash-fill"></i>
                    <div>
                        <div class="count-num" id="confessionCount">0</div>
                        <div class="count-label">Secrets Whispered</div>
                    </div>
                </div>

                <div class="info-box">
                    <i class="bi bi-clock-fill"></i>
                    <div>
                        <h6>Always Open</h6>
                        <p>24/7 — Shadows Never Sleep</p>
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

                <!-- WHISPER QUOTE -->
                <div class="whisper-quote">
                    <i class="bi bi-quote"></i>
                    <p id="rotatingQuote">"The shadows hold what the light cannot bear."</p>
                    <div class="quote-author">— ShadowWhisper</div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== FLOATING PARTICLES =====
    const particleField = document.getElementById('particleField');
    if (particleField) {
        for (let i = 0; i < 30; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (6 + Math.random() * 10) + 's';
            particle.style.animationDelay = Math.random() * 8 + 's';
            particle.style.width = (2 + Math.random() * 3) + 'px';
            particle.style.height = particle.style.width;
            particle.style.opacity = 0;
            particleField.appendChild(particle);
        }
    }

    // ===== ENCRYPTION CHARACTERS ANIMATION =====
    const encryptEl = document.getElementById('encryptChars');
    if (encryptEl) {
        const chars = '0123456789abcdef';
        setInterval(() => {
            let str = '';
            for (let i = 0; i < 12; i++) {
                str += chars[Math.floor(Math.random() * chars.length)];
            }
            encryptEl.textContent = str;
        }, 100);
    }

    // ===== CONFESSION COUNTER ANIMATION =====
    const countEl = document.getElementById('confessionCount');
    if (countEl) {
        const target = 12847;
        const duration = 2500;
        const startTime = performance.now();

        function animateCount(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(eased * target);
            countEl.textContent = current.toLocaleString();
            if (progress < 1) {
                requestAnimationFrame(animateCount);
            }
        }

        // Trigger when element is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    requestAnimationFrame(animateCount);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(countEl);
    }

    // ===== ROTATING QUOTES =====
    const quotes = [
        '"The shadows hold what the light cannot bear."',
        '"In darkness, truth finds its voice."',
        '"Every secret deserves a silent witness."',
        '"Whisper your truth — the void listens."',
        '"Anonymity is the mask that reveals the soul."',
        '"Some words can only be spoken to shadows."'
    ];
    const quoteEl = document.getElementById('rotatingQuote');
    if (quoteEl) {
        let quoteIndex = 0;
        setInterval(() => {
            quoteEl.style.opacity = '0';
            quoteEl.style.transform = 'translateY(8px)';
            quoteEl.style.transition = 'all 0.4s ease';
            setTimeout(() => {
                quoteIndex = (quoteIndex + 1) % quotes.length;
                quoteEl.textContent = quotes[quoteIndex];
                quoteEl.style.opacity = '1';
                quoteEl.style.transform = 'translateY(0)';
            }, 400);
        }, 5000);
    }

    // ===== BUTTON RIPPLE EFFECT =====
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', function (e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    }

    // ===== INPUT FOCUS GLOW EFFECT =====
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function () {
            this.parentElement.style.transform = 'translateY(-2px)';
            this.parentElement.style.transition = 'transform 0.3s ease';
        });
        input.addEventListener('blur', function () {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
});
</script>
