@extends('frontend.app')

@section('content')

<!-- AMBIENT PARTICLES -->
<div class="particles-container" id="particles"></div>

<!-- SCANLINE OVERLAY -->
<div class="scanline-overlay"></div>

<!-- SUCCESS ALERT -->
@if(session('success'))
<div class="alert-success-custom">
    {{ session('success') }}
</div>
@endif

<!-- CONFESSIONS SECTION -->
<section id="confessions" class="anonymous-section">

    <div class="section-header whisper-reveal text-center">
        <h2><i class="bi bi-incognito"></i> Anonymous Confessions</h2>
        <p>These whispers belong to no one — yet they speak for everyone</p>
    </div>

    <div class="feed-container">

        @forelse($posts as $post)
        <div class="feed-card whisper-reveal">

            <!-- HEADER -->
            <div class="feed-header">
                <div class="avatar">
                    <i class="bi bi-person-fill-slash"></i>
                </div>
                <div class="user-info">
                    <span class="name">Anonymous</span>
                    <span class="time">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- TITLE -->
            <div class="feed-title">
                {{ $post->title }}
            </div>

            <!-- CONTENT -->
            <div class="feed-content" id="content-{{ $post->id }}">
                {!! $post->details !!}
            </div>

            <!-- MEDIA -->
            @if($post->file)
                <div class="feed-media">
                    @php $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION)); @endphp

                    @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                        <img src="{{ config('app.storage_url') }}{{ $post->file }}" alt="Confession Media">
                    @elseif(in_array($ext, ['mp4','webm']))
                        <video src="{{ config('app.storage_url') }}{{ $post->file }}" controls></video>
                    @endif
                </div>
            @endif

            <!-- ACTIONS -->
            <div class="feed-actions">

                <button class="btn-like {{ $post->userReacted(auth()->id(), 'like') ? 'reacted' : '' }}"
                        onclick="react(this,'like',{{ $post->id }})">
                    <i class="bi {{ $post->userReacted(auth()->id(), 'like') ? 'bi-heart-fill' : 'bi-heart' }}"></i> Like
                </button>

                <button class="btn-like {{ $post->userReacted(auth()->id(), 'sad') ? 'reacted' : '' }}"
                        onclick="react(this,'sad',{{ $post->id }})">
                    <i class="bi {{ $post->userReacted(auth()->id(), 'sad') ? 'bi-emoji-frown-fill' : 'bi-emoji-frown' }}"></i> Sad
                </button>

                <button class="btn-like {{ $post->userReacted(auth()->id(), 'angry') ? 'reacted' : '' }}"
                        onclick="react(this,'angry',{{ $post->id }})">
                    <i class="bi {{ $post->userReacted(auth()->id(), 'angry') ? 'bi-emoji-angry-fill' : 'bi-emoji-angry' }}"></i> Angry
                </button>

                <span id="reaction-count-{{ $post->id }}">
                    {{ $post->reactions ? $post->reactions->count() : 0 }}
                </span>
            </div>

            <!-- COMMENT BOX -->
            <div class="feed-comment-box">
                <input type="text"
                       placeholder="Comment anonymously..."
                       id="comment-{{ $post->id }}">
                <button onclick="postComment({{ $post->id }})">Send</button>
            </div>

            <!-- COMMENTS -->
            <div class="feed-comments" id="comments-{{ $post->id }}">

                @foreach($post->comments ?? [] as $comment)
                    <div class="comment" id="comment-{{ $comment->id }}">
                        <i class="bi bi-person-fill-slash"></i>

                        <span id="comment-text-{{ $comment->id }}">
                            {{ $comment->comment }}
                        </span>

                        @if($comment->user_id == auth()->id())
                            <button onclick="editComment({{ $comment->id }})"
                                    class="btn-comment-action">
                                Edit
                            </button>

                            <button onclick="deleteComment({{ $comment->id }})"
                                    class="btn-comment-action">
                                Delete
                            </button>
                        @endif
                    </div>
                @endforeach

            </div>

        </div>

        @empty
        <div class="empty-state whisper-reveal text-center">
            <i class="bi bi-chat-square-dots"></i>
            <p>No confessions yet…</p>
            <small>The shadows are waiting for your whisper</small>
        </div>
        @endforelse

    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ===== IMPORTS ===== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');

        /* ===== CSS VARIABLES ===== */
        :root {
            --primary: #0D0D0D;
            --primary-light: #1A1A1A;
            --primary-lighter: #242424;
            --accent: #4B0082;
            --accent-light: #6A0DAD;
            --accent-glow: rgba(75, 0, 130, 0.4);
            --accent-subtle: rgba(75, 0, 130, 0.15);
            --text-primary: #E8E8E8;
            --text-secondary: #9A9A9A;
            --text-muted: #6A6A6A;
            --border-color: rgba(75, 0, 130, 0.2);
            --card-bg: #111111;
            --card-hover: #161616;
            --success-bg: rgba(75, 0, 130, 0.2);
            --success-border: #4B0082;
            --danger: #FF4D6A;
            --sad-color: #5B9BD5;
            --angry-color: #E84855;
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--primary);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* ===== AMBIENT BACKGROUND EFFECTS ===== */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(75, 0, 130, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(75, 0, 130, 0.05) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(75, 0, 130, 0.06) 0%, transparent 50%);
            animation: ambientDrift 20s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes ambientDrift {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(2%, -1%) rotate(1deg); }
            66% { transform: translate(-1%, 2%) rotate(-0.5deg); }
            100% { transform: translate(1%, -2%) rotate(0.5deg); }
        }

        /* ===== FLOATING PARTICLES ===== */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: var(--accent-light);
            border-radius: 50%;
            opacity: 0;
            animation: floatParticle linear infinite;
        }

        @keyframes floatParticle {
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
                transform: translateY(-10vh) scale(1);
            }
        }

        /* ===== SCANLINE OVERLAY ===== */
        .scanline-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.03) 2px,
                rgba(0, 0, 0, 0.03) 4px
            );
            pointer-events: none;
            z-index: 1;
        }

        /* ===== SUCCESS ALERT ===== */
        .alert-success-custom {
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--text-primary);
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            z-index: 9999;
            backdrop-filter: blur(20px);
            box-shadow:
                0 0 30px rgba(75, 0, 130, 0.3),
                0 8px 32px rgba(0, 0, 0, 0.4);
            animation: alertSlideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards,
                       alertPulse 2s ease-in-out infinite 0.6s,
                       alertSlideOut 0.5s cubic-bezier(0.7, 0, 0.84, 0) 4s forwards;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success-custom::before {
            content: '\F26A';
            font-family: 'bootstrap-icons';
            font-size: 1.2rem;
            color: var(--accent-light);
        }

        .alert-success-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            border-radius: 0 0 12px 12px;
            animation: alertTimer 4s linear forwards;
        }

        @keyframes alertSlideIn {
            to { transform: translateX(-50%) translateY(0); }
        }

        @keyframes alertSlideOut {
            to { transform: translateX(-50%) translateY(-100px); opacity: 0; }
        }

        @keyframes alertPulse {
            0%, 100% { box-shadow: 0 0 30px rgba(75, 0, 130, 0.3), 0 8px 32px rgba(0, 0, 0, 0.4); }
            50% { box-shadow: 0 0 40px rgba(75, 0, 130, 0.5), 0 8px 32px rgba(0, 0, 0, 0.4); }
        }

        @keyframes alertTimer {
            from { width: 100%; }
            to { width: 0%; }
        }

        /* ===== MAIN SECTION ===== */
        .anonymous-section {
            position: relative;
            z-index: 2;
            max-width: 720px;
            margin: 0 auto;
            padding: 60px 20px 100px;
        }

        /* ===== SECTION HEADER ===== */
        .section-header {
            margin-bottom: 50px;
            position: relative;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 14px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
        }

        .section-header h2 i {
            font-size: 2.2rem;
            color: var(--accent-light);
            filter: drop-shadow(0 0 12px var(--accent-glow));
            animation: iconBreath 3s ease-in-out infinite;
        }

        @keyframes iconBreath {
            0%, 100% { filter: drop-shadow(0 0 12px var(--accent-glow)); transform: scale(1); }
            50% { filter: drop-shadow(0 0 20px rgba(106, 13, 173, 0.6)); transform: scale(1.05); }
        }

        .section-header p {
            font-size: 1.05rem;
            color: var(--text-secondary);
            font-weight: 300;
            font-style: italic;
            letter-spacing: 0.5px;
        }

        .section-header::after {
            content: '';
            display: block;
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
            margin: 24px auto 0;
            animation: lineExpand 2s ease-in-out infinite alternate;
        }

        @keyframes lineExpand {
            0% { width: 80px; opacity: 0.5; }
            100% { width: 160px; opacity: 1; }
        }

        /* ===== TEXT CENTER ===== */
        .text-center {
            text-align: center;
        }

        /* ===== FEED CONTAINER ===== */
        .feed-container {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* ===== FEED CARD ===== */
        .feed-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .feed-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feed-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(75, 0, 130, 0.03), transparent);
            transition: left 0.8s ease;
            pointer-events: none;
        }

        .feed-card:hover {
            border-color: rgba(75, 0, 130, 0.4);
            background: var(--card-hover);
            transform: translateY(-2px);
            box-shadow:
                0 12px 40px rgba(0, 0, 0, 0.4),
                0 0 60px rgba(75, 0, 130, 0.08);
        }

        .feed-card:hover::before {
            opacity: 1;
        }

        .feed-card:hover::after {
            left: 100%;
        }

        /* ===== FEED HEADER ===== */
        .feed-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            box-shadow: 0 0 20px var(--accent-glow);
            position: relative;
            flex-shrink: 0;
            animation: avatarGlow 4s ease-in-out infinite;
        }

        @keyframes avatarGlow {
            0%, 100% { box-shadow: 0 0 20px var(--accent-glow); }
            50% { box-shadow: 0 0 30px rgba(75, 0, 130, 0.6), 0 0 60px rgba(75, 0, 130, 0.2); }
        }

        .avatar::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1px solid rgba(75, 0, 130, 0.3);
            animation: avatarRing 3s ease-in-out infinite;
        }

        @keyframes avatarRing {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.15); opacity: 0; }
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-info .name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-primary);
            letter-spacing: 0.5px;
        }

        .user-info .time {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .user-info .time::before {
            content: '\F293';
            font-family: 'bootstrap-icons';
            font-size: 0.7rem;
        }

        /* ===== FEED TITLE ===== */
        .feed-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 10px;
            line-height: 1.5;
        }

        /* ===== FEED CONTENT ===== */
        .feed-content {
            font-size: 0.95rem;
            line-height: 1.75;
            color: var(--text-secondary);
            margin-bottom: 18px;
            padding: 16px;
            background: rgba(75, 0, 130, 0.05);
            border-left: 3px solid var(--accent);
            border-radius: 0 10px 10px 0;
            position: relative;
        }

        .feed-content::before {
            content: '\F6B0';
            font-family: 'bootstrap-icons';
            position: absolute;
            top: -8px;
            left: -12px;
            font-size: 1.2rem;
            color: var(--accent-light);
            opacity: 0.5;
        }

        /* ===== FEED MEDIA ===== */
        .feed-media {
            margin-bottom: 18px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            position: relative;
        }

        .feed-media img,
        .feed-media video {
            width: 100%;
            display: block;
            border-radius: 12px;
            transition: transform 0.5s ease;
        }

        .feed-media:hover img,
        .feed-media:hover video {
            transform: scale(1.02);
        }

        .feed-media::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 60%, rgba(13, 13, 13, 0.4));
            pointer-events: none;
            border-radius: 12px;
        }

        /* ===== FEED ACTIONS (REACTIONS) ===== */
        .feed-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 0;
            border-top: 1px solid rgba(75, 0, 130, 0.1);
            border-bottom: 1px solid rgba(75, 0, 130, 0.1);
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .btn-like {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid rgba(75, 0, 130, 0.25);
            border-radius: 50px;
            background: transparent;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-like i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .btn-like::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--accent-subtle);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-like:hover {
            border-color: var(--accent-light);
            color: var(--text-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(75, 0, 130, 0.2);
        }

        .btn-like:hover::before {
            opacity: 1;
        }

        .btn-like:hover i {
            transform: scale(1.2);
        }

        .btn-like:active {
            transform: translateY(0) scale(0.95);
        }

        /* Like button specific */
        .btn-like.btn-reaction-like:hover,
        .btn-like.btn-reaction-like.reacted {
            border-color: var(--accent-light);
            color: var(--accent-light);
        }

        /* Sad button specific */
        .btn-like.btn-reaction-sad:hover,
        .btn-like.btn-reaction-sad.reacted {
            border-color: var(--sad-color);
            color: var(--sad-color);
        }

        /* Angry button specific */
        .btn-like.btn-reaction-angry:hover,
        .btn-like.btn-reaction-angry.reacted {
            border-color: var(--angry-color);
            color: var(--angry-color);
        }

        .btn-like.reacted {
            background: var(--accent-subtle);
            border-color: var(--accent-light);
            color: var(--accent-light);
        }

        .btn-like.reacted.btn-reaction-sad {
            background: rgba(91, 155, 213, 0.12);
        }

        .btn-like.reacted.btn-reaction-angry {
            background: rgba(232, 72, 85, 0.12);
        }

        /* Reaction count */
        .feed-actions > span {
            margin-left: auto;
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            background: var(--accent-subtle);
            border-radius: 50px;
        }

        .feed-actions > span::before {
            content: '\F497';
            font-family: 'bootstrap-icons';
            color: var(--accent-light);
        }

        /* ===== COMMENT BOX ===== */
        .feed-comment-box {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }

        .feed-comment-box input {
            flex: 1;
            background: var(--primary-light);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 12px 20px;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .feed-comment-box input::placeholder {
            color: var(--text-muted);
            font-style: italic;
        }

        .feed-comment-box input:focus {
            border-color: var(--accent-light);
            box-shadow: 0 0 20px rgba(75, 0, 130, 0.15);
            background: var(--primary-lighter);
        }

        .feed-comment-box button {
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border: none;
            border-radius: 50px;
            color: #fff;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .feed-comment-box button::before {
            content: '\F6B8';
            font-family: 'bootstrap-icons';
        }

        .feed-comment-box button::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feed-comment-box button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(75, 0, 130, 0.4);
        }

        .feed-comment-box button:hover::after {
            opacity: 1;
        }

        .feed-comment-box button:active {
            transform: translateY(0) scale(0.97);
        }

        /* ===== COMMENTS LIST ===== */
        .feed-comments {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .comment {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            background: var(--primary-light);
            border-radius: 12px;
            font-size: 0.9rem;
            color: var(--text-secondary);
            border: 1px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            animation: commentSlideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes commentSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .comment:hover {
            border-color: var(--border-color);
            background: var(--primary-lighter);
        }

        .comment > i {
            font-size: 1.1rem;
            color: var(--accent-light);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .comment span {
            flex: 1;
            line-height: 1.5;
        }

        .btn-comment-action {
            background: transparent;
            border: 1px solid rgba(75, 0, 130, 0.2);
            color: var(--text-muted);
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-comment-action:hover {
            color: var(--accent-light);
            border-color: var(--accent-light);
            background: var(--accent-subtle);
        }

        .btn-comment-action:last-child:hover {
            color: var(--danger);
            border-color: rgba(255, 77, 106, 0.3);
            background: rgba(255, 77, 106, 0.1);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            padding: 80px 20px;
            text-align: center;
            background: var(--card-bg);
            border: 1px dashed var(--border-color);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        .empty-state::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(75, 0, 130, 0.1), transparent);
            transform: translate(-50%, -50%);
            border-radius: 50%;
            animation: emptyPulse 3s ease-in-out infinite;
        }

        @keyframes emptyPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.3); opacity: 1; }
        }

        .empty-state i {
            font-size: 3.5rem;
            color: var(--accent-light);
            display: block;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 20px var(--accent-glow));
            animation: iconFloat 3s ease-in-out infinite;
            position: relative;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .empty-state p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 8px;
            position: relative;
        }

        .empty-state small {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-style: italic;
            position: relative;
        }

        /* ===== WHISPER REVEAL ANIMATION ===== */
        .whisper-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .whisper-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered delay for feed cards */
        .feed-card.whisper-reveal:nth-child(1) { transition-delay: 0.1s; }
        .feed-card.whisper-reveal:nth-child(2) { transition-delay: 0.2s; }
        .feed-card.whisper-reveal:nth-child(3) { transition-delay: 0.3s; }
        .feed-card.whisper-reveal:nth-child(4) { transition-delay: 0.4s; }
        .feed-card.whisper-reveal:nth-child(5) { transition-delay: 0.5s; }

        /* ===== GLITCH TEXT EFFECT ON HEADER ===== */
        .section-header h2 {
            position: relative;
        }

        .section-header h2::before,
        .section-header h2::after {
            content: 'Anonymous Confessions';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
        }

        .section-header h2::before {
            color: rgba(75, 0, 130, 0.5);
            animation: glitch1 5s ease-in-out infinite;
        }

        .section-header h2::after {
            color: rgba(106, 13, 173, 0.3);
            animation: glitch2 5s ease-in-out infinite;
        }

        @keyframes glitch1 {
            0%, 90%, 100% { opacity: 0; transform: translateX(-50%) translate(0, 0); }
            92% { opacity: 0.6; transform: translateX(-50%) translate(-3px, 2px); }
            94% { opacity: 0; }
            96% { opacity: 0.4; transform: translateX(-50%) translate(3px, -1px); }
            98% { opacity: 0; }
        }

        @keyframes glitch2 {
            0%, 88%, 100% { opacity: 0; transform: translateX(-50%) translate(0, 0); }
            91% { opacity: 0.4; transform: translateX(-50%) translate(2px, -2px); }
            93% { opacity: 0; }
            95% { opacity: 0.3; transform: translateX(-50%) translate(-2px, 1px); }
            97% { opacity: 0; }
        }

        /* ===== TYPING INDICATOR ANIMATION ===== */
        .typing-indicator {
            display: inline-flex;
            gap: 4px;
            padding: 4px 8px;
        }

        .typing-indicator span {
            width: 6px;
            height: 6px;
            background: var(--accent-light);
            border-radius: 50%;
            animation: typing 1.4s ease-in-out infinite;
        }

        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
            30% { transform: translateY(-6px); opacity: 1; }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--primary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-light);
        }

        /* ===== RIPPLE CLICK EFFECT ===== */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(75, 0, 130, 0.4);
            transform: scale(0);
            animation: rippleEffect 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes rippleEffect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .anonymous-section {
                padding: 40px 14px 80px;
            }

            .section-header h2 {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 8px;
            }

            .section-header h2 i {
                font-size: 1.8rem;
            }

            .section-header p {
                font-size: 0.9rem;
            }

            .feed-card {
                padding: 20px;
            }

            .feed-actions {
                gap: 8px;
            }

            .btn-like {
                padding: 7px 12px;
                font-size: 0.8rem;
            }

            .feed-comment-box {
                flex-direction: column;
            }

            .feed-comment-box button {
                justify-content: center;
            }

            .comment {
                flex-wrap: wrap;
            }

            .btn-comment-action {
                margin-left: auto;
            }
        }
    </style>

<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
/* ================================================
   FLOATING PARTICLES
================================================ */
function createParticles() {
    const container = document.getElementById('particles');
    if (!container) return;

    const count = 30;
    for (let i = 0; i < count; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        particle.style.left = Math.random() * 100 + '%';
        particle.style.width = (Math.random() * 3 + 1) + 'px';
        particle.style.height = particle.style.width;
        particle.style.animationDuration = (Math.random() * 15 + 10) + 's';
        particle.style.animationDelay = (Math.random() * 10) + 's';
        particle.style.opacity = Math.random() * 0.3;
        container.appendChild(particle);
    }
}
createParticles();

/* ================================================
   INTERSECTION OBSERVER
================================================ */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

document.querySelectorAll('.whisper-reveal')
    .forEach(el => observer.observe(el));

/* ================================================
   REACTION (UI + BACKEND SYNC)
================================================ */
function react(btn, type, postId, event) {

    // UI RESET
    const siblings = btn.parentElement.querySelectorAll('.btn-like');
    siblings.forEach(s => {
        s.classList.remove('reacted');
        const icon = s.querySelector('i');
        if (icon) {
            if (s.classList.contains('btn-reaction-like')) {
                icon.className = 'bi bi-heart';
            } else if (s.classList.contains('btn-reaction-sad')) {
                icon.className = 'bi bi-emoji-frown';
            } else if (s.classList.contains('btn-reaction-angry')) {
                icon.className = 'bi bi-emoji-angry';
            }
        }
    });

    // ACTIVE UI
    btn.classList.add('reacted');
    const icon = btn.querySelector('i');
    if (icon) {
        if (type === 'like') icon.className = 'bi bi-heart-fill';
        else if (type === 'sad') icon.className = 'bi bi-emoji-frown-fill';
        else if (type === 'angry') icon.className = 'bi bi-emoji-angry-fill';
    }

    // ANIMATION
    btn.style.transform = 'scale(1.2)';
    setTimeout(() => btn.style.transform = '', 200);

    // RIPPLE FIX (event pass করা হয়েছে)
    if (event) createRipple(btn, event);

    // BACKEND CALL
    fetch("{{ route('post.react') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ post_id: postId, type: type })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('reaction-count-' + postId).innerText = data.count;
        }
    })
    .catch(err => console.error(err));
}

/* ================================================
   POST COMMENT (BACKEND CONNECTED)
================================================ */
function postComment(postId) {
    let input = document.getElementById('comment-' + postId);
    let comment = input.value.trim();
    if (!comment) return;

    fetch("{{ route('post.comment') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ post_id: postId, comment: comment })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            let commentsDiv = document.getElementById('comments-' + postId);

            commentsDiv.innerHTML += `
            <div class="comment" id="comment-${data.comment_id}">
                <i class="bi bi-person-fill-slash"></i>
                <span id="comment-text-${data.comment_id}">${data.comment}</span>
                <button onclick="editComment(${data.comment_id})" class="btn-comment-action">Edit</button>
                <button onclick="deleteComment(${data.comment_id})" class="btn-comment-action">Delete</button>
            </div>`;

            input.value = '';
        }
    })
    .catch(err => console.error(err));
}

/* ================================================
   EDIT COMMENT (SWEETALERT MODAL)
================================================ */
function editComment(commentId) {
    let textEl = document.getElementById('comment-text-' + commentId);
    let oldText = textEl.innerText;

    Swal.fire({
        title: 'Edit your whisper',
        input: 'textarea',
        inputValue: oldText,
        showCancelButton: true,
        confirmButtonText: 'Update',
        cancelButtonText: 'Cancel',
        inputValidator: (value) => {
            if (!value.trim()) return 'Comment cannot be empty!';
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/comment/edit/${commentId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ comment: result.value })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    textEl.innerText = data.comment;
                    Swal.fire('Updated!', 'Your comment has been updated.', 'success');
                } else {
                    Swal.fire('Error', data.message || 'Failed to update.', 'error');
                }
            })
            .catch(err => console.error(err));
        }
    });
}

/* ================================================
   DELETE COMMENT (SWEETALERT)
================================================ */
function deleteComment(commentId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This whisper will vanish forever...",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4B0082',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/comment/delete/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('comment-' + commentId).remove();
                    Swal.fire('Deleted!', 'Comment removed.', 'success');
                } else {
                    Swal.fire('Error', data.message || 'Failed to delete.', 'error');
                }
            })
            .catch(err => console.error(err));
        }
    });
}

/* ================================================
   RIPPLE EFFECT
================================================ */
function createRipple(element, e) {
    const ripple = document.createElement('span');
    ripple.classList.add('ripple');

    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';

    element.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
}

/* ================================================
   ENTER KEY SUPPORT
================================================ */
document.querySelectorAll('.feed-comment-box input').forEach(input => {
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const postId = this.id.split('-')[1];
            postComment(postId);
        }
    });
});
</script>

@endsection