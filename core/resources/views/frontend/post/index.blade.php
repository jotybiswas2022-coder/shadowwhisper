@extends('frontend.app')

@section('content')

{{-- ===== Alerts ===== --}}
@if (session('success'))
<div class="sn-alert sn-alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="sn-alert sn-alert-danger">
    {{ session('error') }}
</div>
@endif

<!-- ── NAVBAR ── -->
<nav class="sn-navbar">
    <a href="{{ url('/') }}" class="sn-brand">
        <div class="sn-brand-icon">
            <i class="bi bi-feather"></i>
        </div>
        <span class="sn-brand-name">Story<span>Nest</span></span>
    </a>

    <ul class="sn-nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Stories</a></li>
    </ul>
</nav>

<div class="storynest-wrapper">

    <!-- ── HERO CARD ── -->
    <div class="story-card">

        <div class="card-row">

            <!-- LEFT MEDIA -->
            <div class="media-col">
                <div class="media-box">

                    @if($post->file)
                        @php
                            $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                            $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                            $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                            $isImage = in_array($ext,$imageExtensions);
                            $isVideo = in_array($ext,$videoExtensions);
                        @endphp

                        @if($isImage)
                            <img src="{{ config('app.storage_url') }}{{ $post->file }}" class="story-img">
                        @elseif($isVideo)
                            <video controls class="w-100">
                                <source src="{{ config('app.storage_url') }}{{ $post->file }}">
                            </video>
                        @endif
                    @else
                        <div class="no-media">No Media</div>
                    @endif

                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="content-col">
                <div class="content-box">

                    <!-- Title -->
                    <h2 class="story-title">{{ $post->title }}</h2>

                    <!-- Meta -->
                    <div class="story-meta">
                        <span>
                            <i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                        </span>
                        <span class="meta-dot">•</span>
                        <span>
                            {{ \Carbon\Carbon::parse($post->created_at)->format('h:i A') }}
                        </span>
                    </div>

                    <!-- Short Description -->
                    <div class="story-excerpt">
                        {!! Str::limit(strip_tags($post->details), 250) !!}
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- ── FULL STORY ── -->
    <div class="story-body-wrapper">

        <div class="story-paper">

            <div class="article-text">
                {!! $post->details !!}
            </div>

        </div>

    </div>

    <!-- ── RELATED STORIES ── -->
    <div class="related-section">

        <div class="related-grid">

            @foreach($otherPosts->take(4) as $otherpost)
            <a href="{{ url('/post/'.$otherpost->id) }}" class="related-card">

                <div class="related-img-wrap">
                    @if($otherpost->file)
                        <img src="{{ config('app.storage_url') }}{{ $otherpost->file }}" class="related-img">
                    @endif
                </div>

                <div class="related-body">
                    <h6>{{ $otherpost->title }}</h6>
                    <small>
                        {{ \Carbon\Carbon::parse($otherpost->created_at)->format('d M Y') }}
                    </small>
                </div>

            </a>
            @endforeach

        </div>

    </div>

</div>

<script>

/* ── INK FLOATING PARTICLES ── */
(function() {
    const c = document.getElementById('inkParticles');
    for (let i = 0; i < 30; i++) {
        const p = document.createElement('div');
        p.className = 'ink-particle';
        const s = Math.random() * 5 + 2;
        p.style.cssText = `
            width:${s}px; height:${s}px;
            left:${Math.random()*100}%;
            animation-duration:${Math.random()*14+10}s;
            animation-delay:${Math.random()*12}s;
        `;
        c.appendChild(p);
    }
})();

/* ── QUILL CURSOR TRAIL ── */
(function() {
    document.addEventListener('mousemove', e => {
        const dot = document.createElement('div');
        dot.className = 'quill-dot';
        dot.style.left = e.clientX + 'px';
        dot.style.top  = e.clientY + 'px';
        document.body.appendChild(dot);
        setTimeout(() => dot.remove(), 620);
    });
})();

/* ── READ PROGRESS BAR ── */
(function() {
    const bar   = document.getElementById('readProgressBar');
    const paper = document.getElementById('storyPaper');
    if (!bar || !paper) return;
    window.addEventListener('scroll', () => {
        const top    = paper.getBoundingClientRect().top + window.scrollY;
        const height = paper.offsetHeight;
        const pct    = Math.max(0, Math.min(100, ((window.scrollY - top) / height) * 100));
        bar.style.width = pct + '%';
    });
})();

/* ── FONT SIZE CYCLE ── */
const fsSizes = ['fs-sm','fs-md','fs-lg','fs-xl'];
let fsIdx = 1;
function cycleFontSize() {
    const p = document.getElementById('storyPaper');
    fsSizes.forEach(f => p.classList.remove(f));
    fsIdx = (fsIdx + 1) % fsSizes.length;
    p.classList.add(fsSizes[fsIdx]);
}

/* ── READ ALOUD ── */
let speaking = false;
function toggleReadAloud(btn) {
    const icon = btn.querySelector('i');
    const txt  = document.getElementById('articleText');
    if (!speaking) {
        const u = new SpeechSynthesisUtterance(txt.innerText);
        u.rate = .92;
        u.onend = () => { speaking = false; icon.className = 'bi bi-volume-up'; };
        speechSynthesis.speak(u);
        speaking = true;
        icon.className = 'bi bi-volume-mute';
    } else {
        speechSynthesis.cancel();
        speaking = false;
        icon.className = 'bi bi-volume-up';
    }
}

/* ── COPY LINK ── */
function copyLink(btn) {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const i = btn.querySelector('i');
        i.className = 'bi bi-check2';
        setTimeout(() => i.className = 'bi bi-link-45deg', 2000);
    });
}

</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>

/* ── ROOT ── */
:root {
    --bg:        #000000;
    --gold:      #facc15;
    --gold-dim:  #b8980e;
    --gold-glow: #facc1540;
    --white:     #ffffff;
    --gray:      #a1a1aa;
    --card-bg:   #0d0d0d;
    --card-border:#facc1530;
    --surface:   #111111;
    --surface2:  #1a1a1a;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    color: var(--white);
    font-family: 'Georgia', 'Times New Roman', serif;
    overflow-x: hidden;
    min-height: 100vh;
}

/* ── FLOATING INK PARTICLES ── */
#inkParticles {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}
.ink-particle {
    position: absolute;
    border-radius: 50%;
    background: var(--gold);
    opacity: 0;
    animation: floatUp linear infinite;
}
@keyframes floatUp {
    0%   { transform: translateY(100vh) scale(1); opacity: 0; }
    10%  { opacity: .15; }
    90%  { opacity: .05; }
    100% { transform: translateY(-10vh) scale(.3) rotate(180deg); opacity: 0; }
}

/* ── QUILL CURSOR TRAIL ── */
.quill-dot {
    position: fixed;
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--gold);
    pointer-events: none;
    z-index: 9999;
    opacity: 0;
    animation: fadeDot .6s ease forwards;
}
@keyframes fadeDot {
    0%   { transform: scale(1.2); opacity: .75; }
    100% { transform: scale(.1);  opacity: 0; }
}

/* ── NAVBAR ── */
.sn-navbar {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(0,0,0,.92);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--card-border);
    padding: 0 32px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.sn-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
.sn-brand-icon {
    width: 36px;
    height: 36px;
    background: var(--gold);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    font-size: 1.1rem;
    box-shadow: 0 0 18px var(--gold-glow);
}
.sn-brand-name {
    font-size: 1.25rem;
    font-weight: 900;
    color: var(--white);
    letter-spacing: -.5px;
    font-family: 'Georgia', serif;
}
.sn-brand-name span { color: var(--gold); }
.sn-nav-links {
    display: flex;
    gap: 24px;
    list-style: none;
}
.sn-nav-links a {
    color: var(--gray);
    text-decoration: none;
    font-size: .85rem;
    letter-spacing: .5px;
    transition: color .2s;
    font-family: 'Courier New', monospace;
}
.sn-nav-links a:hover { color: var(--gold); }
.sn-nav-right { display: flex; gap: 10px; }
.nav-icon-btn {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background: transparent;
    border: 1px solid var(--card-border);
    color: var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .2s;
    font-size: 1rem;
    text-decoration: none;
}
.nav-icon-btn:hover { background: var(--gold); color: #000; border-color: var(--gold); }

/* ── ALERTS ── */
.sn-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    margin: 16px 24px;
    border-radius: 10px;
    font-weight: 600;
    font-size: .9rem;
    color: var(--white);
    border-left: 4px solid var(--gold);
    animation: fadeIn .5s ease;
}
.sn-alert-success { background: #0d2d1a; }
.sn-alert-danger  { background: #2d0d0d; border-left-color: #ef4444; }
.sn-alert-close {
    margin-left: auto;
    background: none;
    border: none;
    color: var(--gray);
    cursor: pointer;
    font-size: 1rem;
    line-height: 1;
}
.sn-alert-close:hover { color: var(--white); }

/* ── WRAPPER ── */
.storynest-wrapper {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ── CHAPTER HEADER ── */
.chapter-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
    padding-top: 36px;
    animation: fadeIn .8s ease;
}
.chapter-label {
    color: var(--gold);
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    white-space: nowrap;
    font-family: 'Courier New', monospace;
}
.chapter-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, var(--gold) 0%, transparent 100%);
}

/* ── HERO CARD ── */
.story-card {
    border-radius: 18px;
    border: 1px solid var(--card-border);
    background: var(--card-bg);
    overflow: hidden;
    box-shadow: 0 0 60px var(--gold-glow), 0 20px 60px rgba(0,0,0,.8);
    animation: slideUp .7s cubic-bezier(.16,1,.3,1) both;
}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Top Bar */
.story-card-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--surface2);
    border-bottom: 1px solid var(--card-border);
    padding: 10px 20px;
}
.topbar-dots { display: flex; gap: 6px; }
.topbar-dots span {
    width: 11px; height: 11px; border-radius: 50%; display: block;
}
.topbar-dots span:nth-child(1) { background: #ef4444; }
.topbar-dots span:nth-child(2) { background: #f59e0b; }
.topbar-dots span:nth-child(3) { background: #22c55e; }
.topbar-title {
    font-size: .78rem; color: var(--gold);
    letter-spacing: 1px; font-family: 'Courier New', monospace;
}
.topbar-actions i {
    color: var(--gold); font-size: 1.1rem; cursor: pointer; transition: transform .2s;
}
.topbar-actions i:hover { transform: scale(1.3); }

/* Row */
.card-row {
    display: flex;
    flex-wrap: wrap;
}

/* Media Box */
.media-col { flex: 0 0 58.333%; max-width: 58.333%; }
.content-col { flex: 0 0 41.667%; max-width: 41.667%; }

.media-box {
    position: relative;
    height: 100%;
    min-height: 400px;
    background: #050505;
    overflow: hidden;
}
.media-frame {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 400px;
    overflow: hidden;
}
.story-img {
    width: 100%;
    height: 100%;
    min-height: 400px;
    object-fit: cover;
    display: block;
    transition: transform .6s ease;
}
.story-card:hover .story-img { transform: scale(1.04); }

.media-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.7) 0%, transparent 60%);
    display: flex;
    align-items: flex-end;
    justify-content: flex-end;
    padding: 20px;
    opacity: 0;
    transition: opacity .3s;
}
.media-frame:hover .media-overlay { opacity: 1; }
.media-overlay i { font-size: 1.8rem; color: var(--gold); }

/* Corners */
.corner-decor {
    position: absolute;
    width: 22px; height: 22px;
    border-color: var(--gold); border-style: solid; z-index: 3;
}
.corner-decor.tl { top:8px; left:8px; border-width:2px 0 0 2px; }
.corner-decor.tr { top:8px; right:8px; border-width:2px 2px 0 0; }
.corner-decor.bl { bottom:8px; left:8px; border-width:0 0 2px 2px; }
.corner-decor.br { bottom:8px; right:8px; border-width:0 2px 2px 0; }

/* No Media */
.no-media-box {
    height: 400px;
    display: flex; align-items: center; justify-content: center;
    background: radial-gradient(ellipse at center, #1a1a0a, #000);
}
.no-media-inner { text-align: center; color: var(--gold); opacity: .35; }
.no-media-icon { font-size: 4rem; }
.no-media-inner p { margin-top: 10px; font-size: .9rem; letter-spacing: 2px; }

/* Ink Drip */
.ink-drip-row {
    position: absolute; bottom: 0; left: 0; right: 0;
    display: flex; justify-content: space-around; pointer-events: none;
}
.ink-drip {
    display: block; width: 4px;
    background: var(--gold); border-radius: 0 0 6px 6px;
    opacity: .7; height: var(--h);
    animation: drip 2.5s ease-in-out var(--d) infinite;
}
@keyframes drip {
    0%,100% { transform: scaleY(1); opacity: .4; }
    50%      { transform: scaleY(1.8); opacity: .95; }
}

/* Content Box */
.content-box {
    padding: 36px 30px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-left: 1px solid var(--card-border);
}

/* Genre Badges */
.genre-badge-row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px; }
.genre-badge {
    background: var(--gold); color: #000;
    font-size: .72rem; font-weight: 800; letter-spacing: 1.5px;
    padding: 4px 13px; border-radius: 20px;
    text-transform: uppercase; font-family: 'Courier New', monospace;
}
.genre-badge-outline {
    border: 1px solid var(--gold); color: var(--gold);
    font-size: .72rem; font-weight: 700; letter-spacing: 1px;
    padding: 4px 13px; border-radius: 20px;
    text-transform: uppercase; font-family: 'Courier New', monospace;
}

/* Title */
.story-title {
    font-size: 1.7rem; font-weight: 800; color: var(--white);
    line-height: 1.3; margin-bottom: 8px;
    text-shadow: 0 2px 20px rgba(250,204,21,.12);
}
.title-underline {
    height: 3px; background: var(--surface2);
    border-radius: 2px; overflow: hidden; margin-bottom: 14px;
}
.title-underline-inner {
    height: 100%; width: 0%;
    background: linear-gradient(90deg, var(--gold), var(--gold-dim));
    border-radius: 2px;
    animation: growLine 1.2s ease .5s forwards;
}
@keyframes growLine { to { width: 100%; } }

/* Meta */
.story-meta {
    display: flex; align-items: center;
    gap: 8px; flex-wrap: wrap; margin-bottom: 10px;
}
.meta-item {
    font-size: .82rem; color: var(--gray);
    display: flex; align-items: center; gap: 5px;
}
.meta-item i { color: var(--gold); }
.meta-dot { color: var(--gold); font-size: 1.1rem; }

/* Ornament Rule */
.ornament-rule {
    display: flex; align-items: center; gap: 10px; margin: 14px 0;
}
.ornament-line {
    flex: 1; height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold-dim), transparent);
}
.ornament-icon { color: var(--gold); font-size: .95rem; }
.ornament-icon.flip { transform: scaleX(-1); display: inline-block; }

/* Excerpt */
.story-excerpt {
    color: #d1d5db; font-size: .95rem;
    line-height: 1.85; flex: 1; margin-bottom: 16px;
}

/* Reading Stats */
.reading-stats { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
.stat-pill {
    display: flex; align-items: center; gap: 5px;
    background: var(--surface2);
    border: 1px solid var(--card-border);
    border-radius: 20px; padding: 4px 12px;
    font-size: .78rem; color: var(--gold);
}

/* Share */
.share-row {
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
}
.share-label { font-size: .8rem; color: var(--gray); font-weight: 600; }
.share-btn {
    width: 36px; height: 36px; border-radius: 50%;
    border: none; display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 1rem;
    transition: transform .2s, box-shadow .2s;
    text-decoration: none;
}
.share-btn:hover { transform: scale(1.18); box-shadow: 0 0 14px var(--gold-glow); }
.share-btn.facebook  { background: #1877f2; color: #fff; }
.share-btn.whatsapp  { background: #25d366; color: #fff; }
.share-btn.twitter   { background: #000; color: #fff; border: 1px solid #333; }
.share-btn.copy      { background: var(--gold); color: #000; }

/* ── STORY BODY ── */
.story-body-wrapper {
    border-radius: 16px;
    border: 1px solid var(--card-border);
    background: var(--card-bg);
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,.6);
    margin-top: 32px;
    animation: fadeIn .8s ease .3s both;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

.story-body-header {
    display: flex; align-items: center;
    justify-content: space-between;
    padding: 14px 24px;
    background: var(--surface2);
    border-bottom: 1px solid var(--card-border);
}
.header-left {
    color: var(--gold); font-weight: 700; font-size: .9rem;
    letter-spacing: 1px; text-transform: uppercase;
    font-family: 'Courier New', monospace;
    display: flex; align-items: center;
}
.header-right { display: flex; gap: 8px; }
.tool-btn {
    background: transparent;
    border: 1px solid var(--card-border);
    color: var(--gold); border-radius: 8px;
    width: 34px; height: 34px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: .95rem; transition: all .2s;
}
.tool-btn:hover { background: var(--gold); color: #000; border-color: var(--gold); }

/* Writing Cursor Anim */
.writing-line-anim {
    height: 3px; background: var(--surface2);
    position: relative; overflow: visible;
}
.writing-cursor {
    position: absolute; left: 0; top: -6px;
    width: 3px; height: 15px; background: var(--gold);
    border-radius: 2px; box-shadow: 0 0 10px var(--gold);
    animation: writingCursor 4s ease-in-out infinite;
}
@keyframes writingCursor {
    0%   { left: 0%; }
    50%  { left: 98%; }
    100% { left: 0%; }
}

/* Typewriter Paragraph Animation */
@keyframes typeReveal {
    from { clip-path: inset(0 100% 0 0); opacity: 0; }
    to   { clip-path: inset(0 0% 0 0); opacity: 1; }
}

/* Story Paper */
.story-paper {
    position: relative;
    padding: 52px 64px;
    background: var(--card-bg);
    min-height: 400px;
}
/* Decorative page-line lines */
.paper-lines {
    position: absolute; inset: 0;
    pointer-events: none; overflow: hidden; opacity: .025;
}
.paper-lines span {
    display: block; height: 1px;
    background: var(--gold); margin: 42px 0;
}
/* Left margin bar */
.story-paper::before {
    content: '';
    position: absolute;
    left: 48px; top: 0; bottom: 0;
    width: 1px;
    background: rgba(250,204,21,.08);
}

/* Article Text */
.article-text {
    position: relative; z-index: 2;
    color: #e5e7eb;
    font-size: 1.06rem;
    line-height: 2;
    font-family: 'Georgia', serif;
}
.article-text p { margin-bottom: 1.5rem; }
.article-text h1,
.article-text h2,
.article-text h3 {
    color: var(--gold); margin: 2rem 0 .8rem; font-weight: 800;
}
/* Drop Cap */
.article-text > p:first-of-type::first-letter {
    float: left;
    font-size: 5rem; line-height: .72;
    margin: 4px 14px 0 0;
    color: var(--gold);
    font-weight: 900; font-family: 'Georgia', serif;
    text-shadow: 0 0 40px var(--gold-glow);
    border-right: 3px solid var(--gold);
    padding-right: 12px;
}

/* End Ornament */
.end-ornament {
    display: flex; align-items: center; gap: 12px;
    margin-top: 44px; color: var(--gold);
    font-size: .82rem; letter-spacing: 2px;
    font-family: 'Courier New', monospace; opacity: .65;
}
.end-ornament .ornament-line { flex: 1; height: 1px; background: var(--gold-dim); opacity: .4; }

/* Progress Bar */
.read-progress-wrap { height: 4px; background: var(--surface2); }
.read-progress-bar {
    height: 100%; width: 0%;
    background: linear-gradient(90deg, var(--gold), var(--gold-dim));
    transition: width .1s linear;
    box-shadow: 0 0 10px var(--gold);
}

/* ── RELATED ── */
.related-section { margin-top: 48px; margin-bottom: 60px; }
.related-header {
    display: flex; align-items: center; gap: 20px; margin-bottom: 24px;
    animation: fadeIn .8s ease;
}
.related-title-head {
    color: var(--gold); font-weight: 800; font-size: 1.05rem;
    letter-spacing: 1.5px; text-transform: uppercase;
    font-family: 'Courier New', monospace; white-space: nowrap;
    display: flex; align-items: center; gap: 8px;
}
.related-line {
    flex: 1; display: flex; align-items: center; gap: 8px;
    color: var(--gold-dim); opacity: .5;
}
.rel-line-inner { flex: 1; height: 1px; background: var(--gold-dim); }

.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.related-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 14px; overflow: hidden;
    transition: transform .3s, box-shadow .3s, border-color .3s;
    position: relative; cursor: pointer;
    animation: cardRise .5s ease calc(var(--i) * .12s) both;
    text-decoration: none; color: inherit; display: block;
}
@keyframes cardRise {
    from { transform: translateY(28px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}
.related-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 16px 44px var(--gold-glow), 0 6px 24px rgba(0,0,0,.7);
    border-color: var(--gold);
}
.related-img-wrap {
    position: relative; height: 180px;
    overflow: hidden; background: #0a0a0a;
}
.related-img {
    width: 100%; height: 100%;
    object-fit: cover; display: block; transition: transform .4s;
}
.related-card:hover .related-img { transform: scale(1.08); }
.related-img-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.55);
    display: flex; align-items: center; justify-content: center;
    gap: 6px; color: var(--gold); font-weight: 700; font-size: .85rem;
    opacity: 0; transition: opacity .3s;
}
.related-card:hover .related-img-overlay { opacity: 1; }
.related-no-img {
    height: 180px; display: flex; align-items: center; justify-content: center;
    background: radial-gradient(ellipse, #1a1a0a, #000);
    color: var(--gold); font-size: 2.5rem; opacity: .3;
}
.related-body { padding: 14px 16px 16px; }
.related-genre {
    font-size: .72rem; color: var(--gold); letter-spacing: 1px;
    text-transform: uppercase; font-weight: 700;
    margin-bottom: 6px; font-family: 'Courier New', monospace;
}
.related-title-text {
    font-size: .9rem; color: var(--white); font-weight: 700;
    line-height: 1.35; margin-bottom: 6px;
    display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.related-meta { font-size: .77rem; color: var(--gray); margin-bottom: 10px; }
.read-btn {
    font-size: .78rem; color: var(--gold); font-weight: 700;
    display: flex; align-items: center; gap: 4px;
    transition: gap .2s;
}
.related-card:hover .read-btn { gap: 9px; }
.card-pen-corner {
    position: absolute; top: 10px; right: 10px;
    color: var(--gold); font-size: .9rem;
    opacity: 0; transform: rotate(-30deg);
    transition: opacity .3s, transform .3s;
}
.related-card:hover .card-pen-corner { opacity: .8; transform: rotate(0deg); }

/* Font Size States */
.fs-sm .article-text { font-size: .9rem; }
.fs-md .article-text { font-size: 1.06rem; }
.fs-lg .article-text { font-size: 1.22rem; }
.fs-xl .article-text { font-size: 1.42rem; }

/* Scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #000; }
::-webkit-scrollbar-thumb { background: var(--gold-dim); border-radius: 3px; }
::-webkit-scrollbar-thumb:hover { background: var(--gold); }

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
    .media-col, .content-col { flex: 0 0 100%; max-width: 100%; }
    .content-box { border-left: none; border-top: 1px solid var(--card-border); }
    .media-box, .media-frame, .story-img, .no-media-box { min-height: 260px; }
    .story-img { min-height: 260px; }
    .story-paper { padding: 32px 24px; }
    .story-paper::before { left: 20px; }
    .related-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 580px) {
    .sn-nav-links { display: none; }
    .story-paper { padding: 24px 16px; }
    .story-paper::before { display: none; }
    .related-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
    .story-title { font-size: 1.3rem; }
}
@media (max-width: 420px) {
    .related-grid { grid-template-columns: 1fr; }
}

@media print {
    .sn-navbar, #inkParticles, .story-card-topbar,
    .share-row, .reading-stats, .related-section,
    .header-right, .read-progress-wrap, .ink-drip-row { display: none !important; }
    body { background: #fff !important; color: #000 !important; }
    .article-text { color: #000 !important; }
    .story-paper { padding: 20px 10px; }
}

    </style>

@endsection