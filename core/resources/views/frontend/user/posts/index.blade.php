@extends('frontend.app')

@section('content')

{{-- ======================== INLINE STYLES ======================== --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* ========== GOOGLE FONTS ========== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap');

/* ========== ROOT VARIABLES ========== */
:root {
    --bg-primary: #0D0D0D;
    --bg-secondary: #111111;
    --bg-card: #161616;
    --bg-elevated: #1A1A1A;
    --bg-hover: #1F1F1F;
    --accent: #4B0082;
    --accent-light: #6A0DAD;
    --accent-glow: rgba(75, 0, 130, 0.4);
    --accent-subtle: rgba(75, 0, 130, 0.15);
    --text-primary: #E8E8E8;
    --text-secondary: #8A8A8A;
    --text-muted: #555555;
    --border-color: #222222;
    --border-accent: rgba(75, 0, 130, 0.3);
    --danger: #8B0000;
    --danger-light: #B22222;
    --success: #006400;
    --success-light: #228B22;
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.3);
    --shadow-md: 0 4px 20px rgba(0,0,0,0.4);
    --shadow-lg: 0 8px 40px rgba(0,0,0,0.5);
    --shadow-glow: 0 0 30px rgba(75, 0, 130, 0.2);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ========== ANIMATIONS ========== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-40px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes glowPulse {
    0%, 100% { box-shadow: 0 0 5px var(--accent-glow), 0 0 10px rgba(75,0,130,0.1); }
    50% { box-shadow: 0 0 15px var(--accent-glow), 0 0 30px rgba(75,0,130,0.2); }
}

@keyframes shimmer {
    0% { background-position: -200% center; }
    100% { background-position: 200% center; }
}

@keyframes borderGlow {
    0%, 100% { border-color: rgba(75, 0, 130, 0.2); }
    50% { border-color: rgba(75, 0, 130, 0.5); }
}

@keyframes floatParticle {
    0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
}

@keyframes whisperFloat {
    0%, 100% { transform: translateY(0px) scale(1); }
    50% { transform: translateY(-8px) scale(1.02); }
}

@keyframes ghostReveal {
    from { opacity: 0; transform: translateY(20px) scale(0.95); filter: blur(5px); }
    to { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
}

@keyframes modalSlideIn {
    from { opacity: 0; transform: translateY(-50px) scale(0.9); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes rowReveal {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes successSlide {
    from { opacity: 0; transform: translateY(-100%); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pulseRing {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(1.5); opacity: 0; }
}

@keyframes iconBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

@keyframes textReveal {
    from { clip-path: inset(0 100% 0 0); }
    to { clip-path: inset(0 0% 0 0); }
}

/* ========== PARTICLE BACKGROUND ========== */
.sw-particles {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}

.sw-particle {
    position: absolute;
    width: 3px;
    height: 3px;
    background: var(--accent);
    border-radius: 50%;
    opacity: 0;
    animation: floatParticle linear infinite;
}

.sw-particle:nth-child(1) { left: 10%; animation-duration: 12s; animation-delay: 0s; }
.sw-particle:nth-child(2) { left: 20%; animation-duration: 15s; animation-delay: 2s; width: 2px; height: 2px; }
.sw-particle:nth-child(3) { left: 35%; animation-duration: 10s; animation-delay: 4s; }
.sw-particle:nth-child(4) { left: 50%; animation-duration: 18s; animation-delay: 1s; width: 4px; height: 4px; }
.sw-particle:nth-child(5) { left: 65%; animation-duration: 14s; animation-delay: 3s; }
.sw-particle:nth-child(6) { left: 75%; animation-duration: 11s; animation-delay: 5s; width: 2px; height: 2px; }
.sw-particle:nth-child(7) { left: 85%; animation-duration: 16s; animation-delay: 2.5s; }
.sw-particle:nth-child(8) { left: 90%; animation-duration: 13s; animation-delay: 0.5s; width: 4px; height: 4px; }
.sw-particle:nth-child(9) { left: 45%; animation-duration: 17s; animation-delay: 6s; }
.sw-particle:nth-child(10) { left: 5%; animation-duration: 19s; animation-delay: 1.5s; width: 2px; height: 2px; }
.sw-particle:nth-child(11) { left: 55%; animation-duration: 20s; animation-delay: 3.5s; }
.sw-particle:nth-child(12) { left: 95%; animation-duration: 9s; animation-delay: 7s; width: 3px; height: 3px; }

/* ========== SUCCESS ALERT ========== */
.sw-alert-success {
    animation: successSlide 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(135deg, rgba(0, 100, 0, 0.2), rgba(0, 100, 0, 0.08));
    border: 1px solid rgba(34, 139, 34, 0.3);
    color: #4ADE80;
    padding: 16px 24px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 20px auto;
    max-width: 1200px;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 500;
    backdrop-filter: blur(10px);
    position: relative;
    z-index: 10;
}

.sw-alert-success i {
    font-size: 20px;
    animation: iconBounce 0.6s ease;
}

.sw-alert-close {
    background: none;
    border: none;
    color: #4ADE80;
    cursor: pointer;
    margin-left: auto;
    padding: 4px;
    border-radius: 6px;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sw-alert-close:hover {
    background: rgba(74, 222, 128, 0.15);
    transform: rotate(90deg);
}

/* ========== MAIN WRAPPER ========== */
.sw-wrapper {
    min-height: 100vh;
    background: var(--bg-primary);
    padding: 30px 20px 60px;
    position: relative;
    z-index: 1;
}

.sw-container {
    max-width: 1200px;
    margin: 0 auto;
    animation: fadeIn 0.6s ease;
}

/* ========== HEADER ========== */
.sw-header {
    animation: fadeInDown 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 28px;
}

.sw-header-inner {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    padding: 28px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.sw-header-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
    animation: shimmer 3s linear infinite;
    background-size: 200% auto;
}

.sw-header-inner::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(75, 0, 130, 0.08) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.sw-brand-name {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    font-weight: 800;
    background: linear-gradient(135deg, var(--accent-light), #9B30FF, var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: 1px;
    animation: whisperFloat 4s ease-in-out infinite;
    display: inline-block;
}

.sw-header-inner > div {
    color: var(--text-secondary);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
}

.sw-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    padding: 5px 14px;
    background: var(--accent-subtle);
    border: 1px solid var(--border-accent);
    border-radius: 20px;
    color: #B388FF;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    animation: glowPulse 3s ease-in-out infinite;
}

.sw-count-badge::before {
    content: '\F287';
    font-family: 'bootstrap-icons';
    font-size: 11px;
}

/* ========== ADD BUTTON ========== */
.sw-btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: linear-gradient(135deg, var(--accent), var(--accent-light));
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    letter-spacing: 0.3px;
    box-shadow: 0 4px 15px rgba(75, 0, 130, 0.3);
}

.sw-btn-add::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.5s, height 0.5s;
}

.sw-btn-add:hover::before {
    width: 300px;
    height: 300px;
}

.sw-btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(75, 0, 130, 0.5);
}

.sw-btn-add:active {
    transform: translateY(0);
}

.sw-btn-add i {
    font-size: 16px;
    transition: var(--transition);
}

.sw-btn-add:hover i {
    transform: rotate(90deg);
}

/* ========== SEARCH ========== */
.sw-search {
    animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.1s both;
    width: 100%;
    padding: 15px 22px 15px 50px;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    margin-bottom: 24px;
    transition: var(--transition);
    outline: none;
    box-shadow: var(--shadow-sm);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='%23555' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: 18px center;
}

.sw-search::placeholder {
    color: var(--text-muted);
    font-weight: 400;
}

.sw-search:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px var(--accent-subtle), var(--shadow-md);
    background-color: var(--bg-elevated);
}

/* ========== TABLE ========== */
.sw-table-wrap {
    animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
}

.sw-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--bg-card);
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-md);
    animation: ghostReveal 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
}

.sw-table thead {
    background: linear-gradient(180deg, var(--bg-elevated), var(--bg-card));
}

.sw-table thead tr {
    border-bottom: 1px solid var(--border-color);
}

.sw-table th {
    padding: 16px 20px;
    text-align: left;
    font-family: 'Inter', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--text-muted);
    border-bottom: 1px solid var(--border-color);
    position: relative;
}

.sw-table th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
}

.sw-table td {
    padding: 16px 20px;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    color: var(--text-primary);
    border-bottom: 1px solid rgba(34, 34, 34, 0.5);
    vertical-align: middle;
    transition: var(--transition);
}

.sw-table tbody tr {
    transition: var(--transition);
    animation: rowReveal 0.5s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.sw-table tbody tr:nth-child(1) { animation-delay: 0.3s; }
.sw-table tbody tr:nth-child(2) { animation-delay: 0.38s; }
.sw-table tbody tr:nth-child(3) { animation-delay: 0.46s; }
.sw-table tbody tr:nth-child(4) { animation-delay: 0.54s; }
.sw-table tbody tr:nth-child(5) { animation-delay: 0.62s; }
.sw-table tbody tr:nth-child(6) { animation-delay: 0.7s; }
.sw-table tbody tr:nth-child(7) { animation-delay: 0.78s; }
.sw-table tbody tr:nth-child(8) { animation-delay: 0.86s; }
.sw-table tbody tr:nth-child(9) { animation-delay: 0.94s; }
.sw-table tbody tr:nth-child(10) { animation-delay: 1.02s; }

.sw-table tbody tr:hover {
    background: var(--bg-hover);
    box-shadow: inset 3px 0 0 var(--accent);
}

.sw-table tbody tr:last-child td {
    border-bottom: none;
}

/* Row number styling */
.sw-table td:first-child {
    color: var(--text-muted);
    font-weight: 600;
    font-size: 12px;
    width: 50px;
}

/* Title column */
.sw-table td:nth-child(2) {
    font-weight: 500;
    max-width: 280px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* ========== THUMBNAIL ========== */
.sw-thumb {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    border: 2px solid var(--border-color);
    transition: var(--transition);
    cursor: pointer;
}

.sw-thumb:hover {
    border-color: var(--accent);
    transform: scale(1.15);
    box-shadow: 0 0 15px var(--accent-glow);
}

.sw-no-media {
    color: var(--text-muted);
    font-size: 12px;
    font-style: italic;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ========== STATUS BADGES ========== */
.sw-badge-active,
.sw-badge-inactive {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 20px;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: var(--transition);
}

.sw-badge-active {
    background: rgba(0, 100, 0, 0.15);
    color: #4ADE80;
    border: 1px solid rgba(34, 139, 34, 0.25);
}

.sw-badge-active::before {
    content: '';
    width: 7px;
    height: 7px;
    background: #4ADE80;
    border-radius: 50%;
    animation: glowPulse 2s ease-in-out infinite;
    box-shadow: 0 0 6px rgba(74, 222, 128, 0.5);
}

.sw-badge-inactive {
    background: rgba(139, 0, 0, 0.15);
    color: #F87171;
    border: 1px solid rgba(178, 34, 34, 0.25);
}

.sw-badge-inactive::before {
    content: '';
    width: 7px;
    height: 7px;
    background: #F87171;
    border-radius: 50%;
    opacity: 0.6;
}

/* ========== ACTION BUTTONS ========== */
.sw-btn-details,
.sw-btn-delete {
    padding: 7px 16px;
    border-radius: var(--radius-sm);
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    letter-spacing: 0.3px;
    position: relative;
    overflow: hidden;
}

.sw-btn-details {
    background: var(--accent-subtle);
    color: #B388FF;
    border-color: var(--border-accent);
}

.sw-btn-details::before {
    content: '\F62A';
    font-family: 'bootstrap-icons';
    font-size: 12px;
}

.sw-btn-details:hover {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 0, 130, 0.4);
}

.sw-btn-delete {
    background: rgba(139, 0, 0, 0.12);
    color: #F87171;
    border-color: rgba(178, 34, 34, 0.2);
    margin-left: 6px;
}

.sw-btn-delete::before {
    content: '\F5DE';
    font-family: 'bootstrap-icons';
    font-size: 12px;
}

.sw-btn-delete:hover {
    background: var(--danger);
    color: #fff;
    border-color: var(--danger);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 0, 0, 0.4);
}

/* ========== MODAL ========== */
.sw-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    padding: 20px;
    animation: fadeIn 0.3s ease;
}

.sw-modal-overlay.active {
    display: flex;
}

.sw-modal {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-xl);
    width: 100%;
    max-width: 600px;
    max-height: 85vh;
    overflow: hidden;
    box-shadow: var(--shadow-lg), var(--shadow-glow);
    animation: modalSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.sw-modal::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
}

.sw-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 28px;
    border-bottom: 1px solid var(--border-color);
    background: linear-gradient(180deg, var(--bg-elevated), var(--bg-card));
}

.sw-modal-header span {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    background: linear-gradient(135deg, var(--text-primary), #B388FF);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sw-modal-header span::before {
    content: '\F4AD';
    font-family: 'bootstrap-icons';
    -webkit-text-fill-color: var(--accent-light);
    font-size: 22px;
}

.sw-modal-header button {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.sw-modal-header button:hover {
    background: var(--danger);
    color: #fff;
    border-color: var(--danger);
    transform: rotate(90deg);
}

.sw-modal-body {
    padding: 28px;
    overflow-y: auto;
    max-height: calc(85vh - 80px);
    scrollbar-width: thin;
    scrollbar-color: var(--accent) var(--bg-primary);
}

.sw-modal-body::-webkit-scrollbar {
    width: 5px;
}

.sw-modal-body::-webkit-scrollbar-track {
    background: var(--bg-primary);
}

.sw-modal-body::-webkit-scrollbar-thumb {
    background: var(--accent);
    border-radius: 10px;
}

.sw-modal-body h3 {
    font-family: 'Inter', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 16px;
    line-height: 1.4;
    animation: textReveal 0.6s ease 0.2s both;
}

.sw-modal-body #detailStatus {
    margin-bottom: 20px;
    animation: fadeInUp 0.5s ease 0.3s both;
}

.sw-modal-body #detailMedia {
    margin-bottom: 20px;
    animation: scaleIn 0.5s ease 0.4s both;
}

.sw-modal-body #detailMedia img,
.sw-modal-body #detailMedia video {
    width: 100%;
    max-height: 350px;
    object-fit: cover;
    border-radius: var(--radius-md);
    border: 1px solid var(--border-color);
}

.sw-modal-body #detailText {
    color: var(--text-secondary);
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    line-height: 1.8;
    animation: fadeInUp 0.5s ease 0.5s both;
    padding: 20px;
    background: var(--bg-elevated);
    border-radius: var(--radius-md);
    border-left: 3px solid var(--accent);
}

/* ========== DELETE CONFIRMATION ========== */
.sw-confirm-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(8px);
    z-index: 10000;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.sw-confirm-overlay.active {
    display: flex;
}

.sw-confirm-box {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-xl);
    padding: 40px;
    text-align: center;
    max-width: 420px;
    width: 100%;
    animation: modalSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
}

.sw-confirm-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--danger-light), var(--danger), var(--danger-light), transparent);
}

.sw-confirm-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: rgba(139, 0, 0, 0.12);
    border: 2px solid rgba(178, 34, 34, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    position: relative;
}

.sw-confirm-icon i {
    font-size: 30px;
    color: #F87171;
}

.sw-confirm-icon::after {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 2px solid rgba(248, 113, 113, 0.2);
    animation: pulseRing 2s ease-out infinite;
}

.sw-confirm-box h4 {
    font-family: 'Inter', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 10px;
}

.sw-confirm-box p {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    color: var(--text-secondary);
    margin-bottom: 28px;
    line-height: 1.6;
}

.sw-confirm-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
}

.sw-confirm-cancel,
.sw-confirm-delete {
    padding: 10px 28px;
    border-radius: var(--radius-sm);
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    border: 1px solid transparent;
}

.sw-confirm-cancel {
    background: var(--bg-elevated);
    color: var(--text-secondary);
    border-color: var(--border-color);
}

.sw-confirm-cancel:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
}

.sw-confirm-delete {
    background: var(--danger);
    color: #fff;
    border-color: var(--danger);
}

.sw-confirm-delete:hover {
    background: var(--danger-light);
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(139, 0, 0, 0.4);
}

/* ========== EMPTY STATE ========== */
.sw-table tbody tr td[colspan] {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-muted);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-style: italic;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .sw-header-inner {
        flex-direction: column;
        gap: 18px;
        text-align: center;
        padding: 24px 20px;
    }

    .sw-brand-name {
        font-size: 22px;
    }

    .sw-table {
        display: block;
        overflow-x: auto;
    }

    .sw-table th,
    .sw-table td {
        padding: 12px 14px;
        font-size: 13px;
    }

    .sw-modal {
        max-width: 95%;
        margin: 10px;
    }

    .sw-modal-body {
        padding: 20px;
    }

    .sw-confirm-box {
        padding: 30px 24px;
    }

    .sw-btn-details,
    .sw-btn-delete {
        padding: 5px 10px;
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    .sw-wrapper {
        padding: 15px 10px 40px;
    }

    .sw-header-inner {
        padding: 20px 16px;
    }

    .sw-brand-name {
        font-size: 20px;
    }

    .sw-search {
        padding: 12px 18px 12px 44px;
        font-size: 13px;
    }

    .sw-btn-add {
        padding: 10px 20px;
        font-size: 13px;
    }
}
</style>

{{-- ======================== PARTICLES ======================== --}}
<div class="sw-particles">
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
    <div class="sw-particle"></div>
</div>

{{-- ======================== SUCCESS ALERT ======================== --}}
@if(session('success'))
<div class="sw-alert-success" id="successAlert">
    <i class="bi bi-check-circle-fill"></i>
    {{ session('success') }}
    <button class="sw-alert-close" onclick="this.parentElement.style.display='none'">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

{{-- ======================== MAIN CONTENT ======================== --}}
<div class="sw-wrapper">
    <div class="sw-container">

        {{-- HEADER --}}
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

        {{-- SEARCH --}}
        <input type="text" id="postSearch" class="sw-search" placeholder="Search confessions by title...">

        {{-- TABLE --}}
        <table class="sw-table" id="storyTable">
            <thead>
                <tr>
                    <th><i class="bi bi-hash"></i></th>
                    <th><i class="bi bi-chat-square-text" style="margin-right:6px;"></i>Title</th>
                    <th><i class="bi bi-image" style="margin-right:6px;"></i>Media</th>
                    <th><i class="bi bi-toggle-on" style="margin-right:6px;"></i>Status</th>
                    <th><i class="bi bi-gear" style="margin-right:6px;"></i>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>

                    {{-- MEDIA --}}
                    <td>
                        @if($post->file)
                            @php
                                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                $video = ['mp4','webm','ogg','avi','mkv'];
                                $image = ['jpg','jpeg','png','gif','webp'];
                            @endphp

                            @if(in_array($ext, $image))
                                <img src="{{ config('app.storage_url') }}{{ $post->file }}" class="sw-thumb" alt="media">
                            @elseif(in_array($ext, $video))
                                <video src="{{ config('app.storage_url') }}{{ $post->file }}" class="sw-thumb" muted></video>
                            @endif
                        @else
                            <span class="sw-no-media"><i class="bi bi-slash-circle"></i> No Media</span>
                        @endif
                    </td>

                    {{-- STATUS --}}
                    <td>
                        @if($post->status == 1)
                            <span class="sw-badge-active">Active</span>
                        @else
                            <span class="sw-badge-inactive">Inactive</span>
                        @endif
                    </td>

                    {{-- ACTION --}}
                    <td>
                        <button class="sw-btn-details details-btn"
                            data-title="{{ $post->title }}"
                            data-status="{{ $post->status }}"
                            data-file="{{ $post->file ? config('app.storage_url').$post->file : '' }}"
                            data-details="{!! $post->details !!}">
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
                    <td colspan="5">
                        <i class="bi bi-inbox" style="font-size:36px;display:block;margin-bottom:12px;color:#333;"></i>
                        No confessions found. The shadows are silent.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

{{-- ======================== DETAILS MODAL ======================== --}}
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

{{-- ======================== DELETE CONFIRM MODAL ======================== --}}
<div class="sw-confirm-overlay" id="deleteConfirm">
    <div class="sw-confirm-box">
        <div class="sw-confirm-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h4>Delete Confession?</h4>
        <p>This whisper will vanish into the void forever. This action cannot be undone.</p>
        <div class="sw-confirm-actions">
            <button class="sw-confirm-cancel" onclick="cancelDelete()">
                <i class="bi bi-x-circle" style="margin-right:5px;"></i>Cancel
            </button>
            <button class="sw-confirm-delete" id="confirmDeleteBtn">
                <i class="bi bi-trash3" style="margin-right:5px;"></i>Delete
            </button>
        </div>
    </div>
</div>

{{-- ======================== SCRIPTS ======================== --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== SEARCH FUNCTIONALITY =====
    const searchInput = document.getElementById('postSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#storyTable tbody tr');
            rows.forEach(row => {
                const title = row.cells[1] ? row.cells[1].textContent.toLowerCase() : '';
                if (title.includes(filter) || filter === '') {
                    row.style.display = '';
                    row.style.animation = 'rowReveal 0.3s ease forwards';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // ===== DETAILS MODAL =====
    document.querySelectorAll('.details-btn').forEach(btn => {
        btn.addEventListener('click', function() {

            const title = this.dataset.title;
            const status = this.dataset.status;
            const file = this.dataset.file;

            // 👉 FIX: JSON parse (safe HTML handling)
            let details = this.dataset.details;
            try {
                details = JSON.parse(details);
            } catch (e) {
                // fallback (if not JSON)
            }

            document.getElementById('detailTitle').textContent = title;

            // ===== STATUS =====
            const statusEl = document.getElementById('detailStatus');
            if (status == 1) {
                statusEl.innerHTML = '<span class="sw-badge-active">Active</span>';
            } else {
                statusEl.innerHTML = '<span class="sw-badge-inactive">Inactive</span>';
            }

            // ===== MEDIA =====
            const mediaEl = document.getElementById('detailMedia');
            if (file) {
                const ext = file.split('.').pop().toLowerCase();
                const videoExts = ['mp4','webm','ogg','avi','mkv'];
                const imageExts = ['jpg','jpeg','png','gif','webp'];

                if (imageExts.includes(ext)) {
                    mediaEl.innerHTML = `<img src="${file}" alt="media">`;
                } else if (videoExts.includes(ext)) {
                    mediaEl.innerHTML = `<video src="${file}" controls></video>`;
                } else {
                    mediaEl.innerHTML = '';
                }
            } else {
                mediaEl.innerHTML = '';
            }

            // ===== DETAILS TEXT (🔥 MAIN FIX HERE) =====
            document.getElementById('detailText').innerHTML = details;

            // ===== SHOW MODAL =====
            document.getElementById('detailsModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // ===== DELETE CONFIRMATION =====
    let deleteForm = null;

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteForm = this.closest('form');
            document.getElementById('deleteConfirm').classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteForm) {
            deleteForm.submit();
        }
    });

    // ===== CLOSE MODALS ON OVERLAY CLICK =====
    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    document.getElementById('deleteConfirm').addEventListener('click', function(e) {
        if (e.target === this) {
            cancelDelete();
        }
    });

    // ===== ESC KEY =====
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            cancelDelete();
        }
    });

    // ===== AUTO-HIDE SUCCESS ALERT =====
    const alert = document.getElementById('successAlert');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    }
});

// ===== GLOBAL FUNCTIONS =====
function closeModal() {
    const modal = document.getElementById('detailsModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function cancelDelete() {
    const confirm = document.getElementById('deleteConfirm');
    confirm.classList.remove('active');
    document.body.style.overflow = '';
}
</script>

@endsection
