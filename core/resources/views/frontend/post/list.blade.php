@extends('frontend.app')

@section('content')

{{-- ========== STORYNEST INLINE STYLES ========== --}}
<style>
  /* ===== CSS VARIABLES ===== */
  :root {
    --sn-bg: #000000;
    --sn-primary: #facc15;
    --sn-primary-dark: #d4a90e;
    --sn-primary-glow: rgba(250, 204, 21, 0.25);
    --sn-primary-soft: rgba(250, 204, 21, 0.08);
    --sn-text: #ffffff;
    --sn-text-muted: #a1a1aa;
    --sn-card-bg: #0a0a0a;
    --sn-card-border: rgba(250, 204, 21, 0.12);
    --sn-card-hover-border: rgba(250, 204, 21, 0.4);
    --sn-surface: #111111;
    --sn-radius: 16px;
    --sn-radius-sm: 10px;
    --sn-transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }

  /* ===== ALERTS ===== */
  .sn-alert {
    border: none;
    border-radius: var(--sn-radius-sm);
    font-family: 'Georgia', serif;
    font-size: 0.95rem;
    backdrop-filter: blur(10px);
    animation: snSlideDown 0.5s ease;
  }
  .sn-alert-success {
    background: rgba(34, 197, 94, 0.15);
    color: #4ade80;
    border-left: 4px solid #22c55e;
  }
  .sn-alert-danger {
    background: rgba(239, 68, 68, 0.15);
    color: #f87171;
    border-left: 4px solid #ef4444;
  }
  .sn-alert .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.5;
  }

  /* ===== QUILL TICKER BAR ===== */
  .sn-quill-bar {
    background: linear-gradient(135deg, var(--sn-primary), var(--sn-primary-dark));
    display: flex;
    align-items: center;
    overflow: hidden;
    position: relative;
    border-bottom: 2px solid rgba(0, 0, 0, 0.2);
  }
  .sn-quill-label {
    background: #000000;
    color: var(--sn-primary);
    padding: 12px 22px;
    font-family: 'Georgia', serif;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 8px;
    position: relative;
    z-index: 2;
    clip-path: polygon(0 0, calc(100% - 15px) 0, 100% 50%, calc(100% - 15px) 100%, 0 100%);
    padding-right: 35px;
  }
  .sn-quill-label i {
    font-size: 1rem;
    animation: snQuillWrite 2s ease-in-out infinite;
  }
  .sn-ticker-wrap {
    flex: 1;
    overflow: hidden;
    padding: 12px 0;
  }
  .sn-ticker-content {
    display: flex;
    gap: 80px;
    animation: snTickerScroll 30s linear infinite;
    white-space: nowrap;
  }
  .sn-ticker-content span {
    color: #000000;
    font-family: 'Georgia', serif;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .sn-ticker-content span::before {
    content: '✦';
    font-size: 0.6rem;
    opacity: 0.6;
  }

  /* ===== MAIN SECTION ===== */
  .sn-story-section {
    background: var(--sn-bg);
    min-height: 100vh;
    padding: 0 0 80px;
    position: relative;
    overflow: hidden;
  }

  /* Floating particles */
  .sn-story-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image:
      radial-gradient(1px 1px at 10% 20%, var(--sn-primary-glow) 50%, transparent 50%),
      radial-gradient(1px 1px at 30% 60%, var(--sn-primary-glow) 50%, transparent 50%),
      radial-gradient(1px 1px at 50% 10%, var(--sn-primary-glow) 50%, transparent 50%),
      radial-gradient(1px 1px at 70% 40%, var(--sn-primary-glow) 50%, transparent 50%),
      radial-gradient(1px 1px at 90% 80%, var(--sn-primary-glow) 50%, transparent 50%),
      radial-gradient(1.5px 1.5px at 15% 85%, rgba(250,204,21,0.15) 50%, transparent 50%),
      radial-gradient(1.5px 1.5px at 55% 75%, rgba(250,204,21,0.15) 50%, transparent 50%),
      radial-gradient(1.5px 1.5px at 85% 15%, rgba(250,204,21,0.15) 50%, transparent 50%);
    animation: snStarsTwinkle 6s ease-in-out infinite alternate;
    pointer-events: none;
    z-index: 0;
  }

  .sn-section-container {
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 1;
  }

  /* ===== HERO HEADER ===== */
  .sn-hero-header {
    text-align: center;
    padding: 70px 20px 50px;
    position: relative;
  }

  .sn-quill-icon-wrap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--sn-primary-soft);
    border: 2px solid var(--sn-card-border);
    margin-bottom: 24px;
    position: relative;
    animation: snFloat 4s ease-in-out infinite;
  }
  .sn-quill-icon-wrap i {
    font-size: 2rem;
    color: var(--sn-primary);
  }
  .sn-quill-icon-wrap::after {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 1px dashed var(--sn-card-border);
    animation: snSpin 20s linear infinite;
  }

  .sn-edition-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--sn-primary-soft);
    border: 1px solid var(--sn-card-border);
    color: var(--sn-primary);
    padding: 8px 20px;
    border-radius: 50px;
    font-family: 'Georgia', serif;
    font-size: 0.8rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 20px;
  }

  .sn-brand-label {
    color: var(--sn-primary);
    font-family: 'Georgia', serif;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }
  .sn-brand-label::before,
  .sn-brand-label::after {
    content: '';
    width: 40px;
    height: 1px;
    background: var(--sn-primary);
    opacity: 0.4;
  }

  .sn-main-title {
    font-family: 'Georgia', serif;
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 700;
    color: var(--sn-text);
    margin-bottom: 16px;
    line-height: 1.15;
    position: relative;
  }
  .sn-main-title .sn-gold {
    color: var(--sn-primary);
    position: relative;
  }
  .sn-main-title .sn-gold::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--sn-primary);
    border-radius: 2px;
    animation: snUnderlineGrow 2s ease forwards;
    transform-origin: left;
  }

  .sn-sub-title {
    color: var(--sn-text-muted);
    font-family: 'Georgia', serif;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto 30px;
    line-height: 1.7;
  }

  /* Decorative divider */
  .sn-ornament-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 10px;
  }
  .sn-ornament-line {
    height: 1px;
    width: 50px;
    background: linear-gradient(90deg, transparent, var(--sn-primary));
    opacity: 0.5;
  }
  .sn-ornament-line:last-child {
    background: linear-gradient(90deg, var(--sn-primary), transparent);
  }
  .sn-ornament-line.thick {
    height: 2px;
    width: 30px;
    opacity: 0.7;
  }
  .sn-ornament-divider i {
    color: var(--sn-primary);
    font-size: 0.55rem;
    animation: snPulseGlow 2s ease-in-out infinite;
  }

  /* Typing animation header */
  .sn-typing-cursor::after {
    content: '|';
    color: var(--sn-primary);
    animation: snBlink 1s step-end infinite;
    font-weight: 300;
    margin-left: 2px;
  }

  /* Double rule */
  .sn-double-rule {
    border: none;
    border-top: 2px solid var(--sn-card-border);
    margin: 0 auto 50px;
    max-width: 1320px;
    position: relative;
  }
  .sn-double-rule::after {
    content: '';
    position: absolute;
    top: 4px;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--sn-card-border);
  }

  /* ===== STORY CARDS GRID ===== */
  .sn-story-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 30px;
  }

  /* ===== INDIVIDUAL CARD ===== */
  .sn-story-card {
    background: var(--sn-card-bg);
    border: 1px solid var(--sn-card-border);
    border-radius: var(--sn-radius);
    overflow: hidden;
    position: relative;
    transition: var(--sn-transition);
    cursor: default;
  }
  .sn-story-card:hover {
    border-color: var(--sn-card-hover-border);
    transform: translateY(-6px);
    box-shadow:
      0 20px 50px rgba(0, 0, 0, 0.5),
      0 0 30px var(--sn-primary-glow);
  }

  /* Ink drip top accent */
  .sn-story-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 20%;
    right: 20%;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--sn-primary), transparent);
    border-radius: 0 0 4px 4px;
    opacity: 0;
    transition: var(--sn-transition);
    z-index: 3;
  }
  .sn-story-card:hover::before {
    opacity: 1;
    left: 5%;
    right: 5%;
  }

  /* Card Media */
  .sn-card-media {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: var(--sn-surface);
  }
  .sn-card-media img,
  .sn-card-media video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--sn-transition);
  }
  .sn-story-card:hover .sn-card-media img,
  .sn-story-card:hover .sn-card-media video {
    transform: scale(1.08);
    filter: brightness(0.7);
  }

  .sn-media-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
    color: var(--sn-text-muted);
  }
  .sn-media-placeholder i {
    font-size: 2.5rem;
    color: var(--sn-primary);
    opacity: 0.4;
  }
  .sn-media-placeholder p {
    font-family: 'Georgia', serif;
    font-size: 0.85rem;
    margin: 0;
    opacity: 0.6;
  }

  /* Genre ribbon */
  .sn-genre-ribbon {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(10px);
    color: var(--sn-primary);
    padding: 6px 14px;
    border-radius: 6px;
    font-family: 'Georgia', serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    border: 1px solid var(--sn-card-border);
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  /* Reading time badge */
  .sn-reading-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(10px);
    color: var(--sn-text-muted);
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-family: 'Georgia', serif;
    border: 1px solid rgba(255, 255, 255, 0.06);
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* Hover overlay */
  .sn-card-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    opacity: 0;
    transition: var(--sn-transition);
    z-index: 2;
  }
  .sn-story-card:hover .sn-card-overlay {
    opacity: 1;
  }
  .sn-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--sn-primary);
    color: #000000;
    padding: 12px 28px;
    border-radius: 50px;
    font-family: 'Georgia', serif;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transform: translateY(20px);
    transition: var(--sn-transition);
    box-shadow: 0 4px 20px var(--sn-primary-glow);
  }
  .sn-story-card:hover .sn-read-btn {
    transform: translateY(0);
  }
  .sn-read-btn:hover {
    background: #fff;
    color: #000;
    box-shadow: 0 4px 30px rgba(255, 255, 255, 0.2);
  }

  /* Card body */
  .sn-card-body {
    padding: 22px 22px 20px;
    position: relative;
  }

  .sn-card-title {
    font-family: 'Georgia', serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--sn-text);
    margin-bottom: 14px;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
  }
  .sn-story-card:hover .sn-card-title {
    color: var(--sn-primary);
  }

  /* Meta info */
  .sn-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 16px;
  }
  .sn-meta-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-family: 'Georgia', serif;
    font-size: 0.75rem;
    padding: 5px 12px;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.06);
    background: var(--sn-primary-soft);
  }
  .sn-meta-chip.date {
    color: var(--sn-primary);
  }
  .sn-meta-chip.time {
    color: var(--sn-text-muted);
  }

  /* Card footer bar */
  .sn-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--sn-card-border);
  }
  .sn-author-info {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .sn-author-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--sn-primary), var(--sn-primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    color: #000;
    font-weight: 700;
  }
  .sn-author-name {
    font-family: 'Georgia', serif;
    font-size: 0.78rem;
    color: var(--sn-text-muted);
  }
  .sn-story-stats {
    display: flex;
    gap: 12px;
  }
  .sn-stat {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.72rem;
    color: var(--sn-text-muted);
  }
  .sn-stat i {
    font-size: 0.8rem;
    color: var(--sn-primary);
    opacity: 0.6;
  }

  /* Ink spread on hover */
  .sn-ink-spread {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: var(--sn-primary);
    transition: var(--sn-transition);
    transform: translateX(-50%);
    border-radius: 3px 3px 0 0;
  }
  .sn-story-card:hover .sn-ink-spread {
    width: 60%;
  }

  /* ===== EMPTY STATE ===== */
  .sn-empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
  }
  .sn-empty-icon {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: var(--sn-primary-soft);
    border: 2px dashed var(--sn-card-border);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 28px;
    animation: snFloat 4s ease-in-out infinite;
  }
  .sn-empty-icon i {
    font-size: 2.8rem;
    color: var(--sn-primary);
    opacity: 0.6;
  }
  .sn-empty-state h5 {
    font-family: 'Georgia', serif;
    font-size: 1.5rem;
    color: var(--sn-text);
    margin-bottom: 12px;
  }
  .sn-empty-state p {
    color: var(--sn-text-muted);
    font-family: 'Georgia', serif;
    font-size: 1rem;
    max-width: 420px;
    margin: 0 auto;
    line-height: 1.7;
  }

  /* ===== SCROLL ANIMATIONS ===== */
  .sn-animate {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.7s ease, transform 0.7s ease;
  }
  .sn-animate.sn-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ===== KEYFRAMES ===== */
  @keyframes snSlideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes snTickerScroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }
  @keyframes snQuillWrite {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-15deg); }
    75% { transform: rotate(10deg); }
  }
  @keyframes snFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
  }
  @keyframes snSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
  @keyframes snPulseGlow {
    0%, 100% { opacity: 1; text-shadow: 0 0 4px var(--sn-primary-glow); }
    50% { opacity: 0.5; text-shadow: 0 0 12px var(--sn-primary); }
  }
  @keyframes snBlink {
    50% { opacity: 0; }
  }
  @keyframes snUnderlineGrow {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
  }
  @keyframes snStarsTwinkle {
    0% { opacity: 0.5; }
    100% { opacity: 1; }
  }
  @keyframes snPageFlip {
    0% { transform: rotateY(0deg); }
    50% { transform: rotateY(8deg); }
    100% { transform: rotateY(0deg); }
  }
  @keyframes snInkDrip {
    0% { height: 0; opacity: 0; }
    50% { opacity: 1; }
    100% { height: 40px; opacity: 0; }
  }
  @keyframes snWriteLine {
    from { width: 0; }
    to { width: 100%; }
  }

  /* Writing lines decoration */
  .sn-writing-lines {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60px;
    pointer-events: none;
    overflow: hidden;
    opacity: 0.04;
  }
  .sn-writing-lines span {
    display: block;
    height: 1px;
    background: var(--sn-primary);
    margin-bottom: 11px;
    animation: snWriteLine 3s ease forwards;
  }
  .sn-writing-lines span:nth-child(2) { animation-delay: 0.3s; }
  .sn-writing-lines span:nth-child(3) { animation-delay: 0.6s; }
  .sn-writing-lines span:nth-child(4) { animation-delay: 0.9s; }

  /* Page flip decoration on card */
  .sn-page-corner {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 0 35px 35px;
    border-color: transparent transparent var(--sn-surface) transparent;
    z-index: 2;
    transition: var(--sn-transition);
    opacity: 0;
  }
  .sn-story-card:hover .sn-page-corner {
    opacity: 1;
    border-color: transparent transparent var(--sn-primary-soft) transparent;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 768px) {
    .sn-story-grid {
      grid-template-columns: 1fr;
      gap: 22px;
    }
    .sn-hero-header {
      padding: 50px 15px 35px;
    }
    .sn-main-title {
      font-size: 2rem;
    }
    .sn-card-media {
      height: 200px;
    }
    .sn-quill-label {
      font-size: 0.72rem;
      padding: 10px 14px;
      padding-right: 28px;
    }
  }
  @media (max-width: 480px) {
    .sn-story-grid {
      grid-template-columns: 1fr;
    }
    .sn-card-meta {
      flex-direction: column;
    }
  }
</style>

{{-- ========== ALERTS ========== --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show m-3 sn-alert sn-alert-success">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show m-3 sn-alert sn-alert-danger">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

{{-- ========== QUILL TICKER BAR ========== --}}
<div class="sn-quill-bar">
  <div class="sn-quill-label">
    <i class="bi bi-pen-fill"></i> Trending Stories
  </div>
  <div class="sn-ticker-wrap">
    <div class="sn-ticker-content">
      <span>Discover captivating stories written by talented authors from around the globe</span>
      <span>StoryNest — Where imagination takes flight and every word matters</span>
      <span>New chapters published daily — dive into worlds beyond your own</span>
      <span>Join our community of storytellers and share your unique voice with the world</span>
      <span>Discover captivating stories written by talented authors from around the globe</span>
      <span>StoryNest — Where imagination takes flight and every word matters</span>
      <span>New chapters published daily — dive into worlds beyond your own</span>
      <span>Join our community of storytellers and share your unique voice with the world</span>
    </div>
  </div>
</div>

{{-- ========== STORY POSTS SECTION ========== --}}
<main>
  <section class="sn-story-section">
    <div class="sn-section-container">

      {{-- Hero Header --}}
      <div class="sn-hero-header sn-animate">

        <div class="sn-quill-icon-wrap">
          <i class="bi bi-feather"></i>
        </div>

        <div class="sn-edition-badge">
          <i class="bi bi-calendar3"></i> Today's Collection &bull; {{ now()->timezone('Asia/Dhaka')->format('l, d F Y') }}
        </div>

        <div class="sn-brand-label">
          <i class="bi bi-book-half"></i> StoryNest
        </div>

        <h2 class="sn-main-title">
          Explore the World of <span class="sn-gold sn-typing-cursor">Stories</span>
        </h2>

        <p class="sn-sub-title">
          Immerse yourself in handcrafted tales of adventure, mystery, romance, and wonder — penned by passionate writers
        </p>

        <div class="sn-ornament-divider">
          <span class="sn-ornament-line"></span>
          <span class="sn-ornament-line thick"></span>
          <i class="bi bi-diamond-fill"></i>
          <span class="sn-ornament-line thick"></span>
          <span class="sn-ornament-line"></span>
        </div>
      </div>

      <hr class="sn-double-rule">

      {{-- Story Grid --}}
      <div class="sn-story-grid">

        @forelse(($posts ?? collect())->sortByDesc('created_at') as $post)
          <div class="sn-story-card sn-animate">

            {{-- Media --}}
            <div class="sn-card-media">

              @php
                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                $isImage = in_array($ext, $imageExtensions);
                $isVideo = in_array($ext, $videoExtensions);
              @endphp

              @if($post->file)

                @if($isImage)
                  <img
                    src="{{ config('app.storage_url') }}{{ $post->file }}"
                    alt="{{ $post->title }}"
                    loading="lazy">
                @elseif($isVideo)
                  <video controls>
                    <source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4">
                  </video>
                @else
                  <div class="sn-media-placeholder">
                    <i class="bi bi-file-earmark-x"></i>
                    <p>Unsupported Format</p>
                  </div>
                @endif

              @else
                <div class="sn-media-placeholder">
                  <i class="bi bi-journal-richtext"></i>
                  <p>Cover Coming Soon</p>
                </div>
              @endif

              {{-- Genre ribbon --}}
              <span class="sn-genre-ribbon">
                <i class="bi bi-bookmark-star-fill"></i> Story
              </span>

              {{-- Reading time badge --}}
              <span class="sn-reading-badge">
                <i class="bi bi-hourglass-split"></i> 5 min read
              </span>

              {{-- Hover overlay --}}
              <div class="sn-card-overlay">
                <a href="{{ url('/post/'.$post->id) }}" class="sn-read-btn">
                  <i class="bi bi-book-half"></i> Read Story
                </a>
              </div>

            </div>

            {{-- Card Body --}}
            <div class="sn-card-body">
              <h3 class="sn-card-title">{{ $post->title }}</h3>

              <div class="sn-card-meta">
                <span class="sn-meta-chip date">
                  <i class="bi bi-calendar-event"></i>
                  {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                </span>
                <span class="sn-meta-chip time">
                  <i class="bi bi-clock"></i>
                  {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                </span>
              </div>

              <div class="sn-card-footer">
                <div class="sn-author-info">
                  <div class="sn-author-avatar">
                    <i class="bi bi-person-fill"></i>
                  </div>
                  <span class="sn-author-name">StoryNest Author</span>
                </div>
                <div class="sn-story-stats">
                  <span class="sn-stat"><i class="bi bi-eye"></i> —</span>
                  <span class="sn-stat"><i class="bi bi-heart"></i> —</span>
                </div>
              </div>
            </div>

            {{-- Page corner effect --}}
            <div class="sn-page-corner"></div>

            {{-- Ink spread bottom --}}
            <div class="sn-ink-spread"></div>

            {{-- Writing lines decoration --}}
            <div class="sn-writing-lines">
              <span></span><span></span><span></span><span></span>
            </div>

          </div>
        @empty
          <div class="sn-empty-state sn-animate">
            <div class="sn-empty-icon">
              <i class="bi bi-journal-x"></i>
            </div>
            <h5>No Stories Published Yet</h5>
            <p>The pages are blank and waiting to be filled. Check back soon for freshly penned tales and adventures.</p>
          </div>
        @endforelse

      </div>
    </div>
  </section>
</main>


{{-- ========== SCROLL ANIMATION SCRIPT ========== --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('sn-visible');
          }, index * 120);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.sn-animate').forEach(el => observer.observe(el));

    // Parallax effect on hero icon
    const hero = document.querySelector('.sn-hero-header');
    if (hero) {
      window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const quillWrap = hero.querySelector('.sn-quill-icon-wrap');
        if (quillWrap && scrollY < 600) {
          quillWrap.style.transform = `translateY(${-12 + scrollY * 0.05}px) rotate(${scrollY * 0.02}deg)`;
        }
      });
    }
  });
</script>

@endsection
