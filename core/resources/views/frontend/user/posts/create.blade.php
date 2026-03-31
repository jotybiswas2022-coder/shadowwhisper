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

<div class="veil-overlay" id="veilOverlay">
    <i class="bi bi-incognito veil-icon"></i>
    <div class="veil-text">Sending Your Confession…</div>
    <div class="veil-sub">Erasing your identity. No traces left behind.</div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

<div class="page-wrapper" id="pageWrapper">
    <div class="page-header row align-items-center mx-0">
        <div class="col-md-8 ps-2">
            <div class="brand-badge">
                <i class="bi bi-eye-slash-fill"></i> ShadowWhisper Studio
            </div>
            <h2 class="page-title">
                Share Your <span class="accent">Dark Secret</span>
                <span class="cursor-blink"></span>
            </h2>
            <p class="page-subtitle">
                <i class="bi bi-shield-lock-fill me-1"></i>
                Your identity stays hidden — confess freely, no strings attached
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0 pe-2">
            <a href="{{ url('/') }}" class="btn-go-back">
                <i class="bi bi-arrow-left-circle"></i> Go Back
            </a>
        </div>
    </div>

    <div class="feed-ticker">
        <span class="ticker-label"><i class="bi bi-activity"></i> Live</span>
        <div class="ticker-track" id="tickerTrack"></div>
    </div>

    <div class="story-card">
        <div class="card-deco"><i class="bi bi-mask"></i></div>
        <div class="card-body-inner">

            <div class="progress-steps">
                <div class="step-row">
                    <div class="step-dot active" id="step1"><i class="bi bi-info-circle" style="font-size:.75rem"></i></div>
                    <div class="step-line" id="line12"></div>
                    <div class="step-dot" id="step2"><i class="bi bi-chat-square-text" style="font-size:.75rem"></i></div>
                    <div class="step-line" id="line23"></div>
                    <div class="step-dot" id="step3"><i class="bi bi-image" style="font-size:.75rem"></i></div>
                </div>
                <div class="step-labels">
                    <div class="step-lbl active" id="lbl1">Identity</div>
                    <div class="step-lbl" id="lbl2" style="text-align:center">Confession</div>
                    <div class="step-lbl" id="lbl3" style="text-align:right">Evidence</div>
                </div>
            </div>

            <form action="{{ url('/posts/store') }}" method="post" enctype="multipart/form-data" id="storyForm" novalidate>
                @csrf
                <input type="hidden" name="status" value="0">
                <input type="hidden" name="mood" id="moodInput" value="">

                <div class="row g-4">
                    <div class="col-lg-12">
                        <!-- SECTION 1 · Identity -->
                        <div class="section-label">
                            <i class="bi bi-person-fill-slash"></i> Anonymous Identity
                        </div>
                        <div class="form-group-wrap">
                            <label class="form-label">
                                <i class="bi bi-at"></i> Alias / Codename <span class="required-star">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-incognito"></i></span>
                                <input type="text" class="form-control" name="title" id="titleInput"
                                       placeholder="e.g. MidnightGhost_77 — your shadow name…"
                                       required autocomplete="off" maxlength="120">
                            </div>
                            <div class="char-counter" id="titleCounter">0 / 120</div>
                        </div>

                        <!-- SECTION 2 · Confession -->
                        <div class="section-label mt-4">
                            <i class="bi bi-chat-square-quote-fill"></i> Your Confession
                        </div>
                        <div class="form-group-wrap">
                            <label class="form-label">
                                <i class="bi bi-feather2"></i> Confession Details <span class="required-star">*</span>
                            </label>
                            <textarea class="form-control editor" name="details" id="detailsTextarea" rows="8"
                                      placeholder="Speak your truth into the void…"></textarea>
                            <div class="char-counter" id="detailsCounter">0 characters</div>
                        </div>

                        <!-- SECTION 3 · Evidence -->
                        <div class="section-label mt-4">
                            <i class="bi bi-paperclip"></i> Attach Evidence (Optional)
                        </div>
                        <div class="form-group-wrap">
                            <label class="form-label">
                                <i class="bi bi-cloud-arrow-up-fill"></i> Upload Image or Video
                            </label>
                            <div class="file-drop-zone" id="dropZone">
                                <input type="file" name="file" id="fileInput" accept="image/*,video/mp4">
                                <i class="bi bi-cloud-upload file-drop-icon"></i>
                                <p class="file-drop-text">
                                    <strong>Click to upload</strong> or drag & drop here<br>
                                    <span style="font-size:.72rem;color:var(--muted)">Supports: JPG, PNG, GIF, WEBP, MP4 — Your IP is never logged</span>
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
(function(){
    // ==== PARTICLES ====
    const field = document.getElementById('particleField');
    for(let i=0;i<55;i++){
        const p=document.createElement('div');
        p.className='particle';
        p.style.cssText=`left:${Math.random()*100}%;width:${1+Math.random()*2.5}px;height:${1+Math.random()*2.5}px;animation-duration:${8+Math.random()*18}s;animation-delay:${-Math.random()*20}s;opacity:${0.3+Math.random()*0.6};`;
        field.appendChild(p);
    }

    // ==== BUBBLES ====
    const BUBBLES = ['"I never told anyone…"','"It has been eating me alive."','"I am so sorry."','"No one will ever know."','"I still think about it."','"Forgive me."','"I lied to everyone."','"It was me all along."','"I carry this every day."','"The truth is darker than you think."'];
    const bubbleField = document.getElementById('bubbleField');
    BUBBLES.forEach(txt=>{
        const b=document.createElement('div');
        b.className='conf-bubble';
        b.textContent=txt;
        b.style.cssText=`left:${5+Math.random()*80}%;animation-duration:${18+Math.random()*22}s;animation-delay:${-Math.random()*30}s;font-size:${0.55+Math.random()*0.15}rem;`;
        bubbleField.appendChild(b);
    });

    // ==== TICKER ====
    const TICKERS = ['"I faked being sick for 6 months."','"I deleted the email and blamed a glitch."','"I still love them but pretend I don\'t."','"I saw what happened and said nothing."','"I changed the grades in the system."','"I have been hiding this for 3 years."','"I let someone else take the blame."','"I read every message in that account."','"I regret every single day."','"I told the secret I promised to keep."'];
    const track = document.getElementById('tickerTrack');
    [...TICKERS,...TICKERS].forEach(t=>{
        const div=document.createElement('div');
        div.className='ticker-item';
        div.innerHTML=`<i class="bi bi-eye-slash"></i>${t}<span class="ticker-dot"></span>`;
        track.appendChild(div);
    });

    // ==== QUOTES ====
    const QUOTES=[{text:'"The confession of evil works is the first beginning of good works."',author:'— Saint Augustine'},{text:'"Secrets are like wounds — they fester in the dark and heal only in light."',author:'— Unknown'},{text:'"There is no agony like bearing an untold story inside you."',author:'— Maya Angelou'},{text:'"The truth will set you free, but first it will make you miserable."',author:'— James A. Garfield'},{text:'"Confession is always weakness. The grave soul keeps its own secrets."',author:'— Ada Leverson'},{text:'"We are only as sick as our secrets."',author:'— Anonymous'}];
    let qIdx=0;
    setInterval(()=>{
        qIdx=(qIdx+1)%QUOTES.length;
        const qt=document.getElementById('quoteText');
        const qa=document.getElementById('quoteAuthor');
        qt.style.opacity='0';qa.style.opacity='0';
        setTimeout(()=>{qt.textContent=QUOTES[qIdx].text;qa.textContent=QUOTES[qIdx].author;qt.style.opacity='1';qa.style.opacity='1';},400);
    },6000);

    // ==== COUNTERS ====
    const STATS={total:14382,today:47,anon:13904,hidden:812};
    function animCount(el,target,dur=1800){let start=null;function step(ts){if(!start)start=ts;const prog=Math.min((ts-start)/dur,1);const ease=1-Math.pow(1-prog,3);el.textContent=Math.floor(ease*target).toLocaleString();if(prog<1)requestAnimationFrame(step);}requestAnimationFrame(step);}
    window.addEventListener('load',()=>{setTimeout(()=>{animCount(document.getElementById('cntTotal'),STATS.total);animCount(document.getElementById('cntToday'),STATS.today,900);animCount(document.getElementById('cntAnon'),STATS.anon,1600);animCount(document.getElementById('cntHidden'),STATS.hidden,2000);},600);});

    // ==== PROGRESS STEPS ====
    const titleInput=document.getElementById('titleInput');
    const detailsArea=document.getElementById('detailsTextarea');
    const fileInput=document.getElementById('fileInput');
    const steps=[1,2,3].map(n=>({dot:document.getElementById('step'+n),lbl:document.getElementById('lbl'+n)}));
    const line12=document.getElementById('line12');
    const line23=document.getElementById('line23');

    function updateSteps(active){steps.forEach((s,i)=>{s.dot.classList.toggle('active',i+1===active);s.dot.classList.toggle('done',i+1<active);s.lbl.classList.toggle('active',i+1===active);s.lbl.classList.toggle('done',i+1<active);});line12.classList.toggle('done',active>1);line23.classList.toggle('done',active>2);}
    function updateStepsByInput(){const hasTitle=titleInput.value.trim().length>0;const hasDetails=detailsArea.value.trim().length>0;const hasFile=fileInput.files && fileInput.files.length>0;if(hasFile)updateSteps(3);else if(hasDetails)updateSteps(2);else if(hasTitle)updateSteps(1);else updateSteps(1);if(hasTitle&&!hasDetails)updateSteps(2);if(hasDetails)updateSteps(hasFile?3:2);}
    titleInput.addEventListener('input',()=>{document.getElementById('titleCounter').textContent=titleInput.value.length+' / 120';updateStepsByInput();});
    detailsArea.addEventListener('input',()=>{const el=document.getElementById('detailsCounter');el.textContent=detailsArea.value.length+' characters';el.className='char-counter'+(detailsArea.value.length>1800?' danger':detailsArea.value.length>1200?' warn':'');updateStepsByInput();});
    fileInput.addEventListener('change',updateStepsByInput);

    // ==== FILE UPLOAD & PREVIEW ====
    const dropZone=document.getElementById('dropZone');
    const fileNameDisplay=document.getElementById('fileNameDisplay');
    const fileNameText=document.getElementById('fileNameText');
    const previewWrapper=document.getElementById('previewWrapper');
    const previewImg=document.getElementById('previewImg');

    function handleFileObj(file){fileNameDisplay.classList.remove('hidden');fileNameText.textContent=file.name;updateStepsByInput();if(file.type.startsWith('image/')){const reader=new FileReader();reader.onload=e=>{previewImg.src=e.target.result;previewWrapper.classList.add('show');};reader.readAsDataURL(file);}else{previewWrapper.classList.remove('show');}showToast('bi-paperclip',`File attached: ${file.name}`);}
    fileInput.addEventListener('change',()=>{if(fileInput.files[0])handleFileObj(fileInput.files[0]);});
    dropZone.addEventListener('dragover',e=>{e.preventDefault();dropZone.classList.add('drag-over');});
    dropZone.addEventListener('dragleave',()=>dropZone.classList.remove('drag-over'));
    dropZone.addEventListener('drop',e=>{e.preventDefault();dropZone.classList.remove('drag-over');if(e.dataTransfer.files.length){handleFileObj(e.dataTransfer.files[0]);}});

    // ==== TOAST ====
    function showToast(icon,msg,dur=3200){const wrap=document.getElementById('toastWrap');const t=document.createElement('div');t.className='toast-msg';t.innerHTML=`<i class="bi ${icon}"></i><span>${msg}</span>`;wrap.appendChild(t);setTimeout(()=>{t.style.transition='opacity .4s, transform .4s';t.style.opacity='0';t.style.transform='translateX(40px)';setTimeout(()=>t.remove(),420);},dur);}

    // ==== FORM SUBMIT ====
    document.getElementById('storyForm').addEventListener('submit',function(e){
        const title=titleInput.value.trim(),details=detailsArea.value.trim();
        if(!title){showToast('bi-exclamation-circle-fill','Please enter an alias or enable anonymous mode.');return;}
        if(!details){showToast('bi-exclamation-circle-fill','Your confession cannot be empty.');return;}
        const btn=document.getElementById('submitBtn');
        btn.classList.add('loading');btn.innerHTML='<i class="bi bi-arrow-repeat"></i> Sending…';
        document.getElementById('veilOverlay').classList.add('show');
        setTimeout(()=>{document.getElementById('veilOverlay').classList.remove('show');btn.classList.remove('loading');btn.innerHTML='<i class="bi bi-check-circle-fill"></i> Confession Sent';btn.style.background='linear-gradient(135deg,#1a3a1a,#2a5a2a)';showToast('bi-shield-check-fill','Your confession entered the shadow. Stay safe.');updateSteps(3);},3000);
    });

})();
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ===== ROOT VARIABLES ===== */
        :root {
            --black:       #0D0D0D;
            --black-soft:  #111111;
            --black-card:  #141414;
            --black-ele:   #1a1a1a;
            --black-border:#222222;
            --indigo:      #4B0082;
            --indigo-mid:  #5c0099;
            --indigo-glow: #6d00b0;
            --indigo-lite: #7b00cc;
            --indigo-dim:  rgba(75,0,130,.18);
            --indigo-fog:  rgba(75,0,130,.08);
            --white:       #f0ecf8;
            --white-dim:   rgba(240,236,248,.55);
            --muted:       #888;
            --muted-lite:  #aaa;
            --gold:        #c9a227;
            --danger:      #cc2244;
            --radius-sm:   8px;
            --radius-md:   14px;
            --radius-lg:   20px;
            --radius-xl:   28px;
            --shadow-glow: 0 0 40px rgba(75,0,130,.35);
            --shadow-card: 0 8px 40px rgba(0,0,0,.7);
            --transition:  all .3s cubic-bezier(.4,0,.2,1);
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* ===== ANIMATED BACKGROUND ===== */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        /* Floating orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0;
            animation: orbFloat linear infinite;
        }
        .orb-1 {
            width: 520px; height: 520px;
            background: radial-gradient(circle, rgba(75,0,130,.55) 0%, transparent 70%);
            top: -140px; left: -120px;
            animation-duration: 22s; animation-delay: 0s;
        }
        .orb-2 {
            width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(75,0,130,.4) 0%, transparent 70%);
            bottom: 5%; right: -100px;
            animation-duration: 28s; animation-delay: -8s;
        }
        .orb-3 {
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(109,0,176,.35) 0%, transparent 70%);
            top: 45%; left: 55%;
            animation-duration: 18s; animation-delay: -4s;
        }
        @keyframes orbFloat {
            0%   { opacity: 0;    transform: scale(.85) translateY(0px); }
            15%  { opacity: 1; }
            50%  { transform: scale(1.08) translateY(-28px); }
            85%  { opacity: 1; }
            100% { opacity: 0;    transform: scale(.85) translateY(0px); }
        }

        /* Falling whisper particles */
        .particle-field {
            position: absolute;
            inset: 0;
        }
        .particle {
            position: absolute;
            width: 2px; height: 2px;
            background: rgba(75,0,130,.7);
            border-radius: 50%;
            animation: particleFall linear infinite;
        }
        @keyframes particleFall {
            0%   { transform: translateY(-10px) translateX(0);  opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: .4; }
            100% { transform: translateY(100vh) translateX(20px); opacity: 0; }
        }

        /* Grid lines subtle overlay */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(75,0,130,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(75,0,130,.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Scan line animation */
        .scan-line {
            position: absolute;
            left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(75,0,130,.5), transparent);
            animation: scanMove 8s linear infinite;
            opacity: .6;
        }
        @keyframes scanMove {
            0%   { top: -2px; }
            100% { top: 100%; }
        }

        /* Floating confession bubbles */
        .bubble-field { position: absolute; inset: 0; }
        .conf-bubble {
            position: absolute;
            background: rgba(75,0,130,.08);
            border: 1px solid rgba(75,0,130,.18);
            border-radius: 20px;
            padding: 8px 14px;
            font-size: .62rem;
            color: rgba(240,236,248,.25);
            font-family: 'Crimson Text', serif;
            font-style: italic;
            white-space: nowrap;
            backdrop-filter: blur(4px);
            animation: bubbleDrift linear infinite;
            pointer-events: none;
        }
        @keyframes bubbleDrift {
            0%   { transform: translateY(110vh) translateX(0); opacity: 0; }
            5%   { opacity: 1; }
            90%  { opacity: .5; }
            100% { transform: translateY(-120px) translateX(30px); opacity: 0; }
        }

        /* ===== PAGE WRAPPER ===== */
        .page-wrapper {
            position: relative;
            z-index: 10;
            max-width: 1180px;
            margin: 0 auto;
            padding: 36px 20px 60px;
        }

        /* ===== HEADER ===== */
        .page-header {
            margin-bottom: 36px;
            padding: 0 4px;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--indigo-dim);
            border: 1px solid rgba(75,0,130,.35);
            border-radius: 50px;
            padding: 5px 14px 5px 10px;
            font-size: .72rem;
            font-weight: 600;
            color: var(--indigo-lite);
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 14px;
            animation: fadeSlidIn .6s ease both;
        }
        .brand-badge i { font-size: .9rem; }

        .page-title {
            font-family: 'Cinzel', serif;
            font-size: clamp(1.6rem, 4vw, 2.5rem);
            font-weight: 700;
            line-height: 1.2;
            color: var(--white);
            margin-bottom: 10px;
            animation: fadeSlidIn .7s ease .1s both;
        }
        .page-title span.accent {
            background: linear-gradient(135deg, var(--indigo-lite), #a855f7, var(--indigo-mid));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cursor-blink {
            display: inline-block;
            width: 3px; height: 1.1em;
            background: var(--indigo-lite);
            margin-left: 4px;
            border-radius: 2px;
            vertical-align: middle;
            animation: blink .9s step-end infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

        .page-subtitle {
            font-size: .85rem;
            color: var(--muted);
            animation: fadeSlidIn .7s ease .2s both;
        }
        .page-subtitle i { color: var(--indigo-lite); }

        .btn-go-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1px solid var(--black-border);
            border-radius: 50px;
            padding: 9px 20px;
            font-size: .82rem;
            color: var(--muted-lite);
            text-decoration: none;
            transition: var(--transition);
            animation: fadeSlidIn .7s ease .3s both;
        }
        .btn-go-back:hover {
            border-color: var(--indigo);
            color: var(--white);
            background: var(--indigo-fog);
            box-shadow: 0 0 18px rgba(75,0,130,.25);
        }

        @keyframes fadeSlidIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== MAIN CARD ===== */
        .story-card {
            background: var(--black-card);
            border: 1px solid var(--black-border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
            animation: fadeSlidIn .8s ease .35s both;
        }
        .story-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--indigo), var(--indigo-lite), var(--indigo), transparent);
            opacity: .8;
        }
        .story-card::after {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(75,0,130,.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .card-deco {
            position: absolute;
            top: 20px; right: 26px;
            font-size: 5rem;
            color: rgba(75,0,130,.07);
            line-height: 1;
            pointer-events: none;
            z-index: 0;
        }

        .card-body-inner {
            padding: 36px 32px;
            position: relative;
            z-index: 2;
        }

        /* ===== PROGRESS STEPS ===== */
        .progress-steps {
            margin-bottom: 36px;
        }
        .step-row {
            display: flex;
            align-items: center;
            gap: 0;
            max-width: 340px;
        }
        .step-dot {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--black-ele);
            border: 2px solid var(--black-border);
            display: flex; align-items: center; justify-content: center;
            font-size: .78rem; font-weight: 700;
            color: var(--muted);
            transition: var(--transition);
            position: relative;
            flex-shrink: 0;
            cursor: default;
        }
        .step-dot.active {
            background: var(--indigo);
            border-color: var(--indigo-lite);
            color: #fff;
            box-shadow: 0 0 18px rgba(75,0,130,.55);
        }
        .step-dot.done {
            background: var(--indigo-dim);
            border-color: var(--indigo);
            color: var(--indigo-lite);
        }
        .step-line {
            flex: 1;
            height: 2px;
            background: var(--black-border);
            position: relative;
            overflow: hidden;
        }
        .step-line.done::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, var(--indigo), var(--indigo-lite));
            animation: lineFill .5s ease forwards;
        }
        @keyframes lineFill { from{width:0} to{width:100%} }

        .step-labels {
            display: flex;
            max-width: 340px;
            margin-top: 8px;
        }
        .step-lbl {
            flex: 1;
            font-size: .68rem;
            color: var(--muted);
            font-weight: 500;
            letter-spacing: .05em;
            text-transform: uppercase;
            text-align: center;
            transition: var(--transition);
        }
        .step-lbl:first-child { text-align: left; }
        .step-lbl:last-child  { text-align: right; }
        .step-lbl.active { color: var(--indigo-lite); }
        .step-lbl.done   { color: var(--indigo); }

        /* ===== SECTION LABELS ===== */
        .section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--indigo-lite);
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--black-border);
        }
        .section-label i { font-size: 1rem; }

        /* ===== FORM GROUPS ===== */
        .form-group-wrap {
            margin-bottom: 4px;
        }
        .form-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: .78rem;
            font-weight: 600;
            color: var(--muted-lite);
            margin-bottom: 8px;
            letter-spacing: .03em;
        }
        .form-label i { color: var(--indigo-lite); }

        .required-star { color: var(--danger); margin-left: 2px; }

        /* Input group */
        .input-group {
            display: flex;
            align-items: stretch;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--black-border);
            transition: var(--transition);
            background: var(--black-ele);
        }
        .input-group:focus-within {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(75,0,130,.2);
        }
        .input-group-text {
            background: rgba(75,0,130,.12);
            border: none;
            border-right: 1px solid var(--black-border);
            padding: 10px 14px;
            color: var(--indigo-lite);
            font-size: .9rem;
        }
        .form-control {
            background: transparent;
            border: none;
            color: var(--white);
            padding: 10px 14px;
            font-size: .88rem;
            width: 100%;
            outline: none;
            font-family: 'Inter', sans-serif;
        }
        .form-control::placeholder { color: var(--muted); }
        .form-control:focus { outline: none; box-shadow: none; }

        textarea.form-control {
            resize: vertical;
            border: 1px solid var(--black-border);
            border-radius: var(--radius-sm);
            background: var(--black-ele);
            transition: var(--transition);
            min-height: 160px;
            line-height: 1.7;
        }
        textarea.form-control:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(75,0,130,.2);
        }

        .char-counter {
            font-size: .68rem;
            color: var(--muted);
            text-align: right;
            margin-top: 5px;
            transition: var(--transition);
        }
        .char-counter.warn { color: var(--gold); }
        .char-counter.danger { color: var(--danger); }

        /* Alias / Anonymous toggle */
        .anon-toggle-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--black-ele);
            border: 1px solid var(--black-border);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            user-select: none;
        }
        .anon-toggle-wrap:hover { border-color: var(--indigo); }
        .anon-toggle-wrap.active {
            border-color: var(--indigo);
            background: var(--indigo-fog);
        }
        .toggle-switch {
            width: 42px; height: 22px;
            background: var(--black-border);
            border-radius: 50px;
            position: relative;
            flex-shrink: 0;
            transition: var(--transition);
        }
        .toggle-switch::after {
            content: '';
            position: absolute;
            top: 3px; left: 3px;
            width: 16px; height: 16px;
            background: var(--muted);
            border-radius: 50%;
            transition: var(--transition);
        }
        .anon-toggle-wrap.active .toggle-switch {
            background: var(--indigo);
        }
        .anon-toggle-wrap.active .toggle-switch::after {
            left: 23px;
            background: #fff;
        }
        .anon-toggle-text { font-size: .82rem; color: var(--muted-lite); }
        .anon-toggle-text strong { color: var(--white); display: block; font-size: .85rem; }

        /* Mood selector */
        .mood-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .mood-chip {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border: 1px solid var(--black-border);
            border-radius: 50px;
            font-size: .75rem;
            color: var(--muted);
            cursor: pointer;
            transition: var(--transition);
            background: var(--black-ele);
            user-select: none;
        }
        .mood-chip i { font-size: .85rem; }
        .mood-chip:hover { border-color: var(--indigo); color: var(--white); }
        .mood-chip.selected {
            background: var(--indigo);
            border-color: var(--indigo-lite);
            color: #fff;
            box-shadow: 0 0 12px rgba(75,0,130,.4);
        }
        input[name="mood"] { display: none; }

        /* ===== FILE DROP ZONE ===== */
        .file-drop-zone {
            border: 2px dashed var(--black-border);
            border-radius: var(--radius-md);
            background: var(--black-ele);
            padding: 36px 20px;
            text-align: center;
            position: relative;
            cursor: pointer;
            transition: var(--transition);
        }
        .file-drop-zone:hover,
        .file-drop-zone.drag-over {
            border-color: var(--indigo);
            background: var(--indigo-fog);
            box-shadow: 0 0 28px rgba(75,0,130,.18);
        }
        .file-drop-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%; height: 100%;
        }
        .file-drop-icon {
            font-size: 2.4rem;
            color: var(--indigo-lite);
            display: block;
            margin-bottom: 12px;
            animation: iconPulse 2.5s ease-in-out infinite;
        }
        @keyframes iconPulse {
            0%,100% { transform: scale(1);   opacity: .7; }
            50%      { transform: scale(1.1); opacity: 1; }
        }
        .file-drop-text { font-size: .82rem; color: var(--muted); line-height: 1.6; }
        .file-drop-text strong { color: var(--white); }
        .file-name-display {
            display: none;
            margin-top: 12px;
            font-size: .8rem;
            color: var(--indigo-lite);
            background: var(--indigo-dim);
            border-radius: 50px;
            padding: 4px 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .file-name-display.hidden { display: none !important; }

        .preview-wrapper {
            display: none;
            margin-top: 16px;
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--black-border);
        }
        .preview-wrapper.show { display: block; }
        .preview-label {
            padding: 8px 14px;
            font-size: .72rem;
            font-weight: 600;
            color: var(--indigo-lite);
            background: var(--black-ele);
            letter-spacing: .05em;
            display: flex; align-items: center; gap: 6px;
        }
        .preview-wrapper img {
            width: 100%;
            max-height: 240px;
            object-fit: cover;
            display: block;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-lite));
            border: none;
            border-radius: 50px;
            padding: 13px 32px;
            font-size: .9rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            letter-spacing: .04em;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(75,0,130,.45);
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.12), transparent);
            transition: left .5s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(75,0,130,.65);
        }
        .btn-submit:hover::before { left: 100%; }
        .btn-submit:active { transform: translateY(0); }

        /* Saving state ripple */
        .btn-submit.loading {
            pointer-events: none;
            opacity: .8;
        }
        .btn-submit.loading i { animation: spin .8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===== RIGHT SIDEBAR ===== */

        /* Secret Vault / tips */
        .tips-strip {
            background: var(--black-ele);
            border: 1px solid var(--black-border);
            border-radius: var(--radius-lg);
            padding: 22px;
            position: relative;
            overflow: hidden;
        }
        .tips-strip::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px; height: 100%;
            background: linear-gradient(180deg, var(--indigo), var(--indigo-lite), var(--indigo));
        }
        .tips-title {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--indigo-lite);
            margin-bottom: 18px;
            display: flex; align-items: center; gap: 8px;
        }
        .tip-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }
        .tip-item:last-child { margin-bottom: 0; }
        .tip-icon {
            width: 30px; height: 30px;
            background: var(--indigo-dim);
            border: 1px solid rgba(75,0,130,.3);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem;
            color: var(--indigo-lite);
            flex-shrink: 0;
        }
        .tip-text {
            font-size: .76rem;
            color: var(--muted);
            line-height: 1.55;
        }
        .tip-text strong { color: var(--muted-lite); display: block; margin-bottom: 2px; }

        /* Quote block */
        .quote-block {
            margin-top: 16px;
            padding: 20px;
            background: var(--black-ele);
            border: 1px solid var(--black-border);
            border-radius: var(--radius-lg);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .quote-block::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--indigo), transparent);
            opacity: .5;
        }
        .quote-icon { font-size: 1.8rem; color: var(--indigo-lite); opacity: .5; }
        .quote-text {
            font-family: 'Crimson Text', serif;
            font-style: italic;
            font-size: .9rem;
            color: var(--muted);
            margin: 10px 0 7px;
            line-height: 1.65;
        }
        .quote-author { font-size: .72rem; color: var(--indigo-lite); font-weight: 600; }

        /* Confession counter widget */
        .counter-widget {
            margin-top: 16px;
            background: var(--black-ele);
            border: 1px solid var(--black-border);
            border-radius: var(--radius-lg);
            padding: 18px 20px;
        }
        .counter-title {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 12px;
            display: flex; align-items: center; gap: 7px;
        }
        .counter-title i { color: var(--indigo-lite); }
        .counter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .counter-item {
            background: var(--black-card);
            border: 1px solid var(--black-border);
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }
        .counter-num {
            font-family: 'Cinzel', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--indigo-lite);
            line-height: 1;
            margin-bottom: 4px;
        }
        .counter-lbl {
            font-size: .62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        /* Privacy note */
        .privacy-note {
            margin-top: 16px;
            background: rgba(75,0,130,.06);
            border: 1px solid rgba(75,0,130,.2);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            font-size: .75rem;
            color: var(--muted);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.55;
        }
        .privacy-note i {
            color: var(--indigo-lite);
            font-size: 1rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ===== LIVE FEED TICKER ===== */
        .feed-ticker {
            background: var(--black-ele);
            border-top: 1px solid var(--black-border);
            border-bottom: 1px solid var(--black-border);
            padding: 10px 0;
            overflow: hidden;
            margin-bottom: 28px;
            position: relative;
        }
        .feed-ticker::before,
        .feed-ticker::after {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            width: 60px;
            z-index: 2;
        }
        .feed-ticker::before {
            left: 0;
            background: linear-gradient(90deg, var(--black-ele), transparent);
        }
        .feed-ticker::after {
            right: 0;
            background: linear-gradient(-90deg, var(--black-ele), transparent);
        }
        .ticker-label {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--indigo-lite);
            background: var(--black-ele);
            padding-right: 10px;
            z-index: 3;
        }
        .ticker-track {
            display: flex;
            align-items: center;
            gap: 40px;
            animation: tickerScroll 40s linear infinite;
            white-space: nowrap;
            padding-left: 80px;
        }
        @keyframes tickerScroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-item {
            font-size: .73rem;
            color: var(--muted);
            font-family: 'Crimson Text', serif;
            font-style: italic;
            display: flex; align-items: center; gap: 8px;
        }
        .ticker-item i { color: var(--indigo-lite); font-size: .7rem; }
        .ticker-dot {
            width: 4px; height: 4px;
            background: var(--indigo);
            border-radius: 50%;
            display: inline-block;
        }

        /* ===== WHISPER ANIMATION (mask reveal on textarea) ===== */
        @keyframes whisperGlow {
            0%,100% { box-shadow: 0 0 0 rgba(75,0,130,0), inset 0 0 0 rgba(75,0,130,0); }
            50%      { box-shadow: 0 0 24px rgba(75,0,130,.3), inset 0 0 12px rgba(75,0,130,.06); }
        }
        textarea.form-control:focus {
            animation: whisperGlow 3s ease-in-out infinite;
        }

        /* ===== TOAST NOTIFICATION ===== */
        .toast-wrap {
            position: fixed;
            bottom: 30px; right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .toast-msg {
            background: var(--black-ele);
            border: 1px solid var(--black-border);
            border-left: 3px solid var(--indigo-lite);
            border-radius: var(--radius-md);
            padding: 13px 18px;
            font-size: .8rem;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 240px;
            box-shadow: var(--shadow-card);
            animation: toastIn .4s ease;
        }
        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .toast-msg i { color: var(--indigo-lite); font-size: 1rem; }

        /* ===== VEIL OVERLAY (submission) ===== */
        .veil-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.88);
            z-index: 9998;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }
        .veil-overlay.show { display: flex; }
        .veil-icon {
            font-size: 3.5rem;
            color: var(--indigo-lite);
            animation: veilPulse 1.4s ease-in-out infinite;
        }
        @keyframes veilPulse {
            0%,100% { transform: scale(1); opacity: .6; }
            50%      { transform: scale(1.15); opacity: 1; }
        }
        .veil-text {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            color: var(--white);
            letter-spacing: .08em;
        }
        .veil-sub {
            font-size: .78rem;
            color: var(--muted);
        }

        /* ===== UTILITY ===== */
        .row { display: flex; flex-wrap: wrap; margin: 0 -12px; }
        .col-md-4, .col-md-8, .col-md-12,
        .col-lg-4, .col-lg-8 { padding: 0 12px; width: 100%; }

        @media (min-width: 768px) {
            .col-md-4 { width: 33.333%; }
            .col-md-8 { width: 66.666%; }
            .col-md-12 { width: 100%; }
        }
        @media (min-width: 992px) {
            .col-lg-4 { width: 33.333%; }
            .col-lg-8 { width: 66.666%; }
        }

        .row.g-3 { gap: 0; }
        .row.g-3 > * { padding: 6px 12px; }
        .row.g-4 { gap: 0; }
        .row.g-4 > * { padding: 0 12px; }

        .g-3 .col-md-12 { margin-bottom: 4px; }

        .align-items-center { align-items: center; }
        .mx-0 { margin-left: 0; margin-right: 0; }
        .ps-2 { padding-left: 8px; }
        .pe-2 { padding-right: 8px; }
        .mt-3 { margin-top: 16px; }
        .mt-4 { margin-top: 24px; }
        .mt-md-0 { }
        @media (min-width: 768px) { .mt-md-0 { margin-top: 0 !important; } .text-md-end { text-align: right; } }
        .me-1 { margin-right: 4px; }
        .mb-0 { margin-bottom: 0; }
        .ms-auto { margin-left: auto; }

        /* scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--black); }
        ::-webkit-scrollbar-thumb { background: var(--indigo); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--indigo-lite); }

        /* selection */
        ::selection { background: rgba(75,0,130,.45); color: #fff; }
    </style>

@endsection