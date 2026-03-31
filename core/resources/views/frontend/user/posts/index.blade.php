@extends('frontend.app')

@section('content')

@if(session('success'))
<div class="sw-alert-success" id="successAlert">
    <i class="bi bi-check-circle-fill"></i>
    {{ session('success') }}
    <button class="sw-alert-close" onclick="this.parentElement.style.display='none'">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

<div class="sw-wrapper">
    <div class="sw-container">

        <!-- HEADER -->
        <div class="sw-header">
            <div class="sw-header-inner">
                <div>
                    <span class="sw-brand-name">ShadowWhisper</span>
                    — Confession List
                    <div class="sw-count-badge">
                        {{ $posts->count() }} Confessions
                    </div>
                </div>

                <a href="{{ url('/posts/create') }}" class="sw-btn-add">
                    <i class="bi bi-plus-circle-fill"></i> Add New
                </a>
            </div>
        </div>

        <!-- SEARCH -->
        <input type="text" id="postSearch" class="sw-search" placeholder="Search...">

        <!-- TABLE -->
        <table class="sw-table" id="storyTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Media</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>

                    <!-- MEDIA -->
                    <td>
                        @if($post->file)
                            @php
                                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                $video = ['mp4','webm','ogg','avi','mkv'];
                                $image = ['jpg','jpeg','png','gif','webp'];
                            @endphp

                            @if(in_array($ext, $image))
                                <img src="{{ config('app.storage_url') }}{{ $post->file }}" class="sw-thumb">
                            @elseif(in_array($ext, $video))
                                <video src="{{ config('app.storage_url') }}{{ $post->file }}" class="sw-thumb" muted></video>
                            @endif
                        @else
                            No Media
                        @endif
                    </td>

                    <!-- ✅ FIXED STATUS -->
                    <td>
                        @if($post->status == 1)
                            <span class="sw-badge-active">Active</span>
                        @else
                            <span class="sw-badge-inactive">Inactive</span>
                        @endif
                    </td>

                    <!-- ACTION -->
                    <td>
                        <button class="sw-btn-details details-btn"
                            data-title="{{ $post->title }}"
                            data-status="{{ $post->status }}"
                            data-file="{{ $post->file ? config('app.storage_url').$post->file : '' }}"
                            data-details="{{ htmlspecialchars($post->details, ENT_QUOTES) }}">
                            Details
                        </button>

                        <form action="{{ route('posts.delete', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="sw-btn-delete delete-btn">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<!-- ================= MODAL ================= -->
<div class="sw-modal-overlay" id="detailsModal">
    <div class="sw-modal">

        <div class="sw-modal-header">
            <span>Confession Details</span>
            <button onclick="closeModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="sw-modal-body">
            <h3 id="detailTitle"></h3>
            <div id="detailStatus"></div>
            <div id="detailMedia"></div>
            <div id="detailText" style="white-space: pre-line;"></div>
        </div>

    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ================= SEARCH =================
    const search = document.getElementById('postSearch');
    if(search){
        search.addEventListener('keyup', function () {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#storyTable tbody tr');

            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(value)
                    ? ''
                    : 'none';
            });
        });
    }

    // ================= MODAL =================
    const modal = document.getElementById('detailsModal');

    document.querySelectorAll('.details-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('detailTitle').innerText = this.dataset.title;

            document.getElementById('detailStatus').innerHTML =
                this.dataset.status == 1
                ? '<span class="sw-badge-active">Active</span>'
                : '<span class="sw-badge-inactive">Inactive</span>';

            let media = this.dataset.file;
            let mediaBox = document.getElementById('detailMedia');

            if(media){
                if(media.match(/\.(mp4|webm|ogg|avi|mkv)$/)){
                    mediaBox.innerHTML = `<video src="${media}" controls style="width:100%"></video>`;
                }else{
                    mediaBox.innerHTML = `<img src="${media}" style="width:100%">`;
                }
            } else {
                mediaBox.innerHTML = 'No Media';
            }

            document.getElementById('detailText').innerText = this.dataset.details;

            modal.style.display = 'flex';
        });
    });

    window.closeModal = function(){
        modal.style.display = 'none';
    }

    // ================= DELETE =================
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if(confirm("Are you sure to delete?")){
                this.closest('form').submit();
            }
        });
    });

});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ============================================================
           ROOT VARIABLES & RESET
        ============================================================ */
        :root {
            --bg-primary:       #0D0D0D;
            --bg-secondary:     #111111;
            --bg-card:          #141414;
            --bg-card-hover:    #181818;
            --accent:           #4B0082;
            --accent-light:     #6A0DAD;
            --accent-glow:      rgba(75, 0, 130, 0.45);
            --accent-subtle:    rgba(75, 0, 130, 0.12);
            --text-primary:     #E8E8E8;
            --text-secondary:   #9A9A9A;
            --text-muted:       #555555;
            --border:           rgba(75, 0, 130, 0.25);
            --border-hover:     rgba(75, 0, 130, 0.6);
            --success:          #1a6b3c;
            --success-text:     #4ade80;
            --danger:           #6b1a1a;
            --danger-text:      #f87171;
            --radius-sm:        6px;
            --radius-md:        12px;
            --radius-lg:        18px;
            --shadow-card:      0 4px 32px rgba(0,0,0,0.6), 0 0 0 1px var(--border);
            --shadow-glow:      0 0 40px var(--accent-glow);
            --font-main:        'Segoe UI', system-ui, -apple-system, sans-serif;
            --transition:       all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: var(--font-main);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* ============================================================
           ANIMATED BACKGROUND — FLOATING WHISPER PARTICLES
        ============================================================ */
        .sw-bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        /* Radial aurora pulse behind content */
        .sw-aurora {
            position: fixed;
            top: -30%;
            left: 50%;
            transform: translateX(-50%);
            width: 80vw;
            height: 80vw;
            background: radial-gradient(ellipse at center,
                rgba(75,0,130,0.18) 0%,
                rgba(75,0,130,0.06) 40%,
                transparent 70%);
            animation: auroraPulse 8s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes auroraPulse {
            0%   { opacity: 0.5; transform: translateX(-50%) scale(1);   }
            100% { opacity: 1;   transform: translateX(-50%) scale(1.15); }
        }

        /* Floating mask particles */
        .particle {
            position: absolute;
            opacity: 0;
            animation: floatUp linear infinite;
            pointer-events: none;
            color: var(--accent-light);
            font-size: 14px;
        }
        @keyframes floatUp {
            0%   { opacity: 0;    transform: translateY(100vh) rotate(0deg) scale(0.5); }
            10%  { opacity: 0.35; }
            90%  { opacity: 0.15; }
            100% { opacity: 0;    transform: translateY(-10vh)  rotate(720deg) scale(1.2); }
        }

        /* Horizontal scanlines overlay */
        .sw-scanlines {
            position: fixed;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.03) 2px,
                rgba(0,0,0,0.03) 4px
            );
            pointer-events: none;
            z-index: 1;
        }

        /* ============================================================
           LAYOUT WRAPPER
        ============================================================ */
        .sw-wrapper {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            padding: 40px 20px 60px;
        }

        .sw-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ============================================================
           SUCCESS ALERT
        ============================================================ */
        .sw-alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(26, 107, 60, 0.18);
            border: 1px solid rgba(74, 222, 128, 0.3);
            color: var(--success-text);
            border-radius: var(--radius-md);
            padding: 14px 20px;
            margin-bottom: 28px;
            font-size: 0.9rem;
            animation: slideDown 0.5s ease forwards;
            position: relative;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .sw-alert-success .sw-alert-close {
            position: absolute;
            right: 16px;
            background: none;
            border: none;
            color: var(--success-text);
            cursor: pointer;
            font-size: 1rem;
            opacity: 0.7;
            transition: var(--transition);
        }
        .sw-alert-success .sw-alert-close:hover { opacity: 1; }

        /* ============================================================
           HEADER SECTION
        ============================================================ */
        .sw-header {
            margin-bottom: 36px;
            animation: fadeUp 0.7s ease forwards;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .sw-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .sw-brand-block {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sw-brand-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.65rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            line-height: 1;
        }

        .sw-brand-icon-wrap {
            width: 46px;
            height: 46px;
            background: var(--accent-subtle);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: iconPulse 3s ease-in-out infinite;
        }
        @keyframes iconPulse {
            0%, 100% { box-shadow: 0 0 0 0 var(--accent-glow); }
            50%       { box-shadow: 0 0 0 8px transparent; }
        }
        .sw-brand-icon-wrap i {
            font-size: 1.3rem;
            color: var(--accent-light);
        }

        .sw-brand-name {
            background: linear-gradient(135deg, #c084fc 0%, #a855f7 40%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sw-brand-sub {
            font-size: 0.82rem;
            color: var(--text-muted);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding-left: 58px;
        }

        .sw-count-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--accent-subtle);
            border: 1px solid var(--border);
            color: #a78bfa;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 5px 14px;
            border-radius: 100px;
            margin-top: 4px;
            margin-left: 58px;
        }
        .sw-count-badge i { font-size: 0.75rem; }

        /* Add New Button */
        .sw-btn-add {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: linear-gradient(135deg, #4B0082, #6A0DAD);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            padding: 11px 24px;
            border-radius: var(--radius-md);
            border: 1px solid rgba(167, 139, 250, 0.2);
            text-decoration: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 4px 20px rgba(75, 0, 130, 0.4);
        }
        .sw-btn-add::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
            opacity: 0;
            transition: var(--transition);
        }
        .sw-btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(75, 0, 130, 0.6);
            border-color: rgba(167, 139, 250, 0.4);
            color: #fff;
            text-decoration: none;
        }
        .sw-btn-add:hover::before { opacity: 1; }
        .sw-btn-add i { font-size: 1rem; }

        /* Ripple effect on add button */
        .sw-btn-add::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0; left: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .sw-btn-add:active::after { opacity: 1; }

        /* ============================================================
           DIVIDER LINE WITH ICON
        ============================================================ */
        .sw-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
            animation: fadeUp 0.8s ease 0.1s both;
        }
        .sw-divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
        }
        .sw-divider-icon {
            color: var(--accent-light);
            font-size: 0.95rem;
            opacity: 0.7;
        }

        /* ============================================================
           MAIN CARD
        ============================================================ */
        .sw-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            animation: fadeUp 0.9s ease 0.15s both;
            position: relative;
        }
        .sw-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), transparent);
            opacity: 0.8;
        }

        .sw-card-header {
            padding: 22px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(75, 0, 130, 0.06);
        }
        .sw-card-header i {
            color: var(--accent-light);
            font-size: 1rem;
        }
        .sw-card-header span {
            font-size: 0.82rem;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 600;
        }

        .sw-card-body {
            padding: 28px;
        }

        /* ============================================================
           SEARCH INPUT
        ============================================================ */
        .sw-search-wrap {
            position: relative;
            margin-bottom: 28px;
        }
        .sw-search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            transition: var(--transition);
        }
        .sw-search {
            width: 100%;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-size: 0.9rem;
            padding: 12px 16px 12px 44px;
            outline: none;
            transition: var(--transition);
        }
        .sw-search::placeholder { color: var(--text-muted); }
        .sw-search:focus {
            border-color: var(--accent-light);
            box-shadow: 0 0 0 3px var(--accent-glow);
            background: #161616;
        }
        .sw-search:focus + .sw-search-glow,
        .sw-search-wrap:focus-within .sw-search-icon { color: var(--accent-light); }

        /* ============================================================
           TABLE
        ============================================================ */
        .sw-table-wrap {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
        }

        .sw-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        .sw-table thead tr {
            background: rgba(75, 0, 130, 0.15);
            border-bottom: 1px solid var(--border);
        }
        .sw-table thead th {
            padding: 14px 18px;
            color: #a78bfa;
            font-weight: 600;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .sw-table thead th:first-child { padding-left: 22px; }
        .sw-table thead th:last-child  { padding-right: 22px; }

        .sw-table tbody tr {
            border-bottom: 1px solid rgba(75, 0, 130, 0.1);
            transition: var(--transition);
            animation: rowFadeIn 0.5s ease forwards;
            opacity: 0;
        }
        .sw-table tbody tr:last-child { border-bottom: none; }
        .sw-table tbody tr:hover {
            background: rgba(75, 0, 130, 0.08);
        }
        .sw-table tbody td {
            padding: 14px 18px;
            color: var(--text-secondary);
            vertical-align: middle;
        }
        .sw-table tbody td:first-child {
            padding-left: 22px;
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        .sw-table tbody td:last-child { padding-right: 22px; }

        /* Row stagger animation */
        @keyframes rowFadeIn {
            from { opacity: 0; transform: translateX(-10px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .sw-table tbody tr:nth-child(1)  { animation-delay: 0.05s; }
        .sw-table tbody tr:nth-child(2)  { animation-delay: 0.10s; }
        .sw-table tbody tr:nth-child(3)  { animation-delay: 0.15s; }
        .sw-table tbody tr:nth-child(4)  { animation-delay: 0.20s; }
        .sw-table tbody tr:nth-child(5)  { animation-delay: 0.25s; }
        .sw-table tbody tr:nth-child(6)  { animation-delay: 0.30s; }
        .sw-table tbody tr:nth-child(7)  { animation-delay: 0.35s; }
        .sw-table tbody tr:nth-child(8)  { animation-delay: 0.40s; }
        .sw-table tbody tr:nth-child(9)  { animation-delay: 0.45s; }
        .sw-table tbody tr:nth-child(10) { animation-delay: 0.50s; }

        /* No-data row */
        .sw-table tbody tr.sw-no-data td {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }
        .sw-no-data-icon {
            display: block;
            font-size: 2.5rem;
            color: var(--accent);
            opacity: 0.4;
            margin-bottom: 12px;
        }

        /* Thumbnail */
        .sw-thumb {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: var(--transition);
        }
        .sw-thumb:hover {
            border-color: var(--accent-light);
            box-shadow: 0 0 12px var(--accent-glow);
            transform: scale(1.08);
        }
        .sw-no-media {
            color: var(--text-muted);
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .sw-no-media i { font-size: 1rem; opacity: 0.5; }

        /* Status badges */
        .sw-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 4px 12px;
            border-radius: 100px;
        }
        .sw-badge-active {
            background: rgba(74, 222, 128, 0.12);
            border: 1px solid rgba(74, 222, 128, 0.3);
            color: #4ade80;
        }
        .sw-badge-active::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #4ade80;
            animation: dotPulse 1.5s ease-in-out infinite;
        }
        .sw-badge-inactive {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.25);
            color: #f87171;
        }
        .sw-badge-inactive::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #f87171;
        }
        @keyframes dotPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(0.7); }
        }

        /* Action buttons */
        .sw-action-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sw-btn-details {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-subtle);
            border: 1px solid var(--border);
            color: #a78bfa;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            letter-spacing: 0.03em;
        }
        .sw-btn-details:hover {
            background: rgba(75, 0, 130, 0.3);
            border-color: var(--accent-light);
            color: #c084fc;
            box-shadow: 0 0 12px var(--accent-glow);
            transform: translateY(-1px);
        }
        .sw-btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(127, 29, 29, 0.2);
            border: 1px solid rgba(248, 113, 113, 0.2);
            color: #f87171;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            letter-spacing: 0.03em;
        }
        .sw-btn-delete:hover {
            background: rgba(127, 29, 29, 0.4);
            border-color: rgba(248, 113, 113, 0.5);
            box-shadow: 0 0 12px rgba(248, 113, 113, 0.25);
            transform: translateY(-1px);
        }

        /* ============================================================
           MODAL OVERLAY
        ============================================================ */
        .sw-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: overlayIn 0.3s ease;
        }
        .sw-modal-overlay.active { display: flex; }
        @keyframes overlayIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        .sw-modal {
            background: var(--bg-card);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 680px;
            max-height: 88vh;
            overflow-y: auto;
            box-shadow: 0 24px 80px rgba(0,0,0,0.8), 0 0 60px var(--accent-glow);
            animation: modalIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: var(--accent) transparent;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.88) translateY(20px); }
            to   { opacity: 1; transform: scale(1)    translateY(0); }
        }
        .sw-modal::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), #c084fc, transparent);
        }

        .sw-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 28px;
            border-bottom: 1px solid var(--border);
            background: rgba(75, 0, 130, 0.08);
            position: sticky;
            top: 0;
            z-index: 1;
            backdrop-filter: blur(10px);
        }
        .sw-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sw-modal-title-icon {
            width: 36px; height: 36px;
            background: var(--accent-subtle);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-light);
            font-size: 1rem;
        }
        .sw-modal-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }
        .sw-modal-close {
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: var(--transition);
        }
        .sw-modal-close:hover {
            background: rgba(248, 113, 113, 0.15);
            border-color: rgba(248, 113, 113, 0.4);
            color: #f87171;
        }

        .sw-modal-body {
            padding: 28px;
        }

        .sw-detail-field {
            margin-bottom: 22px;
        }
        .sw-detail-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .sw-detail-label i { color: var(--accent-light); font-size: 0.85rem; }

        .sw-detail-title-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .sw-detail-text-box {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px 20px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .sw-detail-media-box {
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border);
            background: #0a0a0a;
        }
        .sw-detail-media-box img,
        .sw-detail-media-box video {
            width: 100%;
            max-height: 360px;
            object-fit: contain;
            display: block;
        }

        .sw-modal-footer {
            padding: 20px 28px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
        }
        .sw-btn-close-modal {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--accent-subtle);
            border: 1px solid var(--border-hover);
            color: #a78bfa;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition);
        }
        .sw-btn-close-modal:hover {
            background: rgba(75, 0, 130, 0.3);
            box-shadow: 0 0 16px var(--accent-glow);
        }

        /* ============================================================
           CONFESSION ANIMATION — Typing whisper at bottom
        ============================================================ */
        .sw-whisper-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 44px;
            background: rgba(13,13,13,0.92);
            border-top: 1px solid var(--border);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 10;
            padding: 0 28px;
            gap: 12px;
        }
        .sw-whisper-bar-icon {
            color: var(--accent-light);
            font-size: 0.9rem;
            flex-shrink: 0;
            animation: iconBlink 2s ease-in-out infinite;
        }
        @keyframes iconBlink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.4; }
        }
        .sw-whisper-ticker {
            flex: 1;
            overflow: hidden;
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }
        .sw-whisper-text {
            font-size: 0.78rem;
            color: var(--text-muted);
            letter-spacing: 0.03em;
            white-space: nowrap;
            position: absolute;
            animation: ticker 18s linear infinite;
        }
        @keyframes ticker {
            0%   { transform: translateX(100vw); }
            100% { transform: translateX(-100%); }
        }
        .sw-whisper-dot {
            width: 6px; height: 6px;
            background: var(--accent-light);
            border-radius: 50%;
            flex-shrink: 0;
            animation: dotPulse 1.5s ease-in-out infinite;
        }

        /* ============================================================
           SCROLLBAR CUSTOM
        ============================================================ */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-primary); }
        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent-light); }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 768px) {
            .sw-wrapper { padding: 24px 14px 60px; }
            .sw-header-inner { flex-direction: column; align-items: flex-start; }
            .sw-card-body { padding: 18px; }
            .sw-modal-body { padding: 20px; }
            .sw-modal-header { padding: 16px 20px; }
            .sw-brand-title { font-size: 1.3rem; }
        }
    </style>

@endsection




