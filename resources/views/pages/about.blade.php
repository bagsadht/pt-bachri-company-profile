@extends('layouts.app')

@section('title', 'Tentang Kami - PT Bachri Samudera Indonesia')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

<style>
/* ============================================================
   GLOBAL OVERRIDE
   ============================================================ */
body > main,
body > main > div:first-child {
    padding-top: 0 !important;
    margin-top: 0 !important;
}

/* ============================================================
   BASE
   ============================================================ */
.ab{
    font-family:'Plus Jakarta Sans',ui-sans-serif,system-ui,sans-serif;
    color:#0B1226;
    -webkit-font-smoothing:antialiased;
    text-rendering:optimizeLegibility;
    overflow-x:hidden;
}
.ab-wrap{width:calc(100% - 40px);margin-inline:auto;max-width:1180px}
@media(min-width:1024px){.ab-wrap{width:min(88vw,1180px)}}

.ab-accent{
    font-family:'Instrument Serif',Georgia,serif;
    font-style:italic;
    font-weight:400;
    color:#C9932C;
    letter-spacing:.005em;
}

.ab-js .ab-rv{
    opacity:0;
    transform:translateY(24px);
    transition:opacity .9s cubic-bezier(.2,.7,.2,1),transform .9s cubic-bezier(.2,.7,.2,1);
    transition-delay:var(--d,0s);
}
.ab-js .ab-rv.from-left{transform:translateX(-28px)}
.ab-js .ab-rv.from-right{transform:translateX(28px)}
.ab-js .ab-rv.is-in{opacity:1;transform:none}

/* ============================================================
   PROFESSIONAL ANIMATED BG — Layer 1: Mesh Gradient
   ============================================================ */
.ab-space{
    position:absolute;
    inset:0;
    pointer-events:none;
    z-index:0;
    overflow:hidden;
}
.ab-space::before{
    content:"";
    position:absolute;
    inset:-30%;
    background:
        radial-gradient(ellipse 50% 45% at 15% 25%, rgba(64,86,200,.42), transparent 65%),
        radial-gradient(ellipse 45% 40% at 85% 30%, rgba(201,147,44,.20), transparent 65%),
        radial-gradient(ellipse 60% 50% at 50% 90%, rgba(90,50,150,.28), transparent 65%);
    filter:blur(90px);
    animation:ab-mesh-drift 38s ease-in-out infinite alternate;
    will-change:transform;
}
@keyframes ab-mesh-drift{
    0%  { transform:translate3d(-3%,-2%,0) rotate(0deg) scale(1.05); }
    50% { transform:translate3d(3%,2%,0) rotate(4deg) scale(1.12); }
    100%{ transform:translate3d(-2%,3%,0) rotate(-3deg) scale(1.08); }
}

/* ============================================================
   BG — Layer 2: Light Streaks (garis cahaya melintas)
   ============================================================ */
.ab-bg{
    position:absolute;
    inset:0;
    z-index:1;
    pointer-events:none;
    overflow:hidden;
    isolation:isolate;
}
.ab-bg::before,
.ab-bg::after{
    content:"";
    position:absolute;
    width:1px;
    height:140%;
    top:-20%;
    background:linear-gradient(180deg,
        transparent 0%,
        rgba(241,196,15,.25) 30%,
        rgba(255,255,255,.55) 50%,
        rgba(241,196,15,.25) 70%,
        transparent 100%);
    filter:blur(.4px);
    transform:rotate(14deg);
    will-change:transform,opacity;
    pointer-events:none;
}
.ab-bg::before{
    left:18%;
    animation:ab-streak-a 9s ease-in-out infinite;
    animation-delay:1s;
}
.ab-bg::after{
    left:72%;
    animation:ab-streak-a 13s ease-in-out infinite;
    animation-delay:6s;
    opacity:.6;
}
@keyframes ab-streak-a{
    0%  { transform:translate3d(-30%,-15%,0) rotate(14deg); opacity:0; }
    15% { opacity:.9; }
    85% { opacity:.9; }
    100%{ transform:translate3d(30%,15%,0) rotate(14deg); opacity:0; }
}

/* ============================================================
   BG — Layer 3: Dust Particles (naik perlahan)
   ============================================================ */
.ab-bg-grid{
    position:absolute;
    inset:0;
    display:block;
    background-image:
        radial-gradient(1.2px 1.2px at 12% 88%, rgba(255,255,255,.55), transparent),
        radial-gradient(1.6px 1.6px at 28% 72%, rgba(241,196,15,.60), transparent),
        radial-gradient(1.1px 1.1px at 44% 92%, rgba(255,255,255,.45), transparent),
        radial-gradient(1.4px 1.4px at 62% 78%, rgba(255,255,255,.55), transparent),
        radial-gradient(1.3px 1.3px at 78% 86%, rgba(241,196,15,.55), transparent),
        radial-gradient(1.2px 1.2px at 90% 70%, rgba(255,255,255,.45), transparent),
        radial-gradient(1.5px 1.5px at 8% 45%, rgba(255,255,255,.35), transparent),
        radial-gradient(1.2px 1.2px at 34% 25%, rgba(255,255,255,.30), transparent),
        radial-gradient(1.4px 1.4px at 68% 40%, rgba(241,196,15,.40), transparent),
        radial-gradient(1.1px 1.1px at 92% 22%, rgba(255,255,255,.35), transparent);
    background-size:100% 100%;
    animation:ab-dust 26s linear infinite;
    will-change:transform,opacity;
    mask-image:radial-gradient(ellipse 90% 80% at 50% 55%, #000 30%, transparent 90%);
    -webkit-mask-image:radial-gradient(ellipse 90% 80% at 50% 55%, #000 30%, transparent 90%);
}
@keyframes ab-dust{
    0%  { transform:translate3d(0, 20%, 0); opacity:.3; }
    20% { opacity:.85; }
    80% { opacity:.85; }
    100%{ transform:translate3d(0, -40%, 0); opacity:.3; }
}

/* ============================================================
   BG — Layer 4: Vignette
   ============================================================ */
.ab-bg-grid::after{
    content:"";
    position:absolute;
    inset:0;
    background:radial-gradient(ellipse 100% 85% at 50% 45%,
        transparent 42%,
        rgba(0,0,0,.30) 78%,
        rgba(0,0,0,.55) 100%);
    pointer-events:none;
}

/* ============================================================
   HERO
   ============================================================ */
.ab-hero{
    position:relative;
    width:100%;
    min-height:100vh;
    min-height:100svh;
    display:flex;
    align-items:center;
    overflow:hidden;
    background:#05070a;
    box-sizing:border-box;
    margin-bottom:-2px;
}
.ab-hero-img{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center 30%;
    z-index:1;
    opacity:.35;
    backface-visibility:hidden;
    transform:translateZ(0);
    will-change:transform;
    filter:saturate(.6) contrast(1.1);
}
.ab-hero-shade{
    position:absolute;inset:0;z-index:2;
    background:
        linear-gradient(90deg,rgba(5,8,22,.96) 0%,rgba(5,8,22,.82) 42%,rgba(5,8,22,.35) 75%,rgba(5,8,22,.75) 100%),
        linear-gradient(180deg,rgba(5,8,22,.55) 0%,transparent 30%,transparent 55%,rgba(5,8,22,.95) 100%);
}
.ab-hero-wrap{position:relative;z-index:4;width:100%}
.ab-hero-inner{max-width:820px;padding:60px 0 100px}
@media(min-width:1024px){.ab-hero-inner{padding:80px 0 130px}}

.ab-hero-eyebrow{
    display:inline-flex;align-items:center;gap:14px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:600;font-size:14px;letter-spacing:.28em;
    text-transform:uppercase;color:#FFD11A;
    margin-bottom:26px;
    text-shadow:0 2px 10px rgba(0,0,0,.7);
}
.ab-hero-eyebrow::before{
    content:"";width:36px;height:1px;
    background:linear-gradient(90deg,transparent,#FFD11A);
}
.ab-hero h1{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;
    font-size:clamp(52px,7vw,104px);
    line-height:1;
    letter-spacing:-.045em;
    color:#FFFFFF;
    margin:0 0 24px;
    text-shadow:0 1px 0 rgba(0,0,0,.85),0 3px 6px rgba(0,0,0,.75),0 8px 24px rgba(0,0,0,.6);
}
.ab-hero h1 .word{
    display:inline-block;
    opacity:0;
    transform:translateY(46px) rotateX(-55deg);
    transform-origin:50% 100%;
    animation:ab-word .95s cubic-bezier(.2,.75,.2,1) forwards;
}
.ab-hero h1 .word:nth-child(1){animation-delay:.25s}
.ab-hero h1 .word:nth-child(2){animation-delay:.42s}
.ab-hero h1 .word.gold{
    font-family:'Instrument Serif',Georgia,serif;
    font-style:italic;font-weight:400;
    color:#FFD11A;letter-spacing:-.02em;
}
@keyframes ab-word{to{opacity:1;transform:none}}
.ab-hero h1 .word.is-done{
    animation:none;opacity:1;transform:none;
    cursor:default;
    transition:transform .55s cubic-bezier(.19,1,.22,1);
}
.ab-hero h1 .word.is-done:hover{transform:translateY(-6px)}

.ab-hero-sub{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:500;
    font-size:clamp(18px,1.6vw,22px);
    line-height:1.6;
    color:rgba(255,255,255,.9);
    max-width:600px;margin:0;
    text-shadow:0 2px 14px rgba(0,0,0,.85);
}



/* ============================================================
   HERO SCROLL HINT
   ============================================================ */
.ab-hero-scroll{
    position:absolute;bottom:28px;left:50%;
    transform:translateX(-50%);
    z-index:4;
    display:flex;flex-direction:column;align-items:center;gap:10px;
    color:rgba(255,255,255,.55);
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:12.5px;font-weight:500;
    letter-spacing:.28em;text-transform:uppercase;
}
.ab-hero-scroll .line{
    width:1px;height:42px;
    background:linear-gradient(180deg,rgba(241,196,15,.8),transparent);
    position:relative;overflow:hidden;
}
.ab-hero-scroll .line::before{
    content:"";position:absolute;top:0;left:0;
    width:100%;height:14px;background:#f1c40f;
    animation:ab-scroll 2.2s cubic-bezier(.45,0,.55,1) infinite;
}
@keyframes ab-scroll{
    0%{top:-14px;opacity:0}
    20%{opacity:1}
    80%{opacity:1}
    100%{top:42px;opacity:0}
}

/* ============================================================
   STORY
   ============================================================ */
.ab-story{
    position:relative;
    padding:120px 0;
    background:#FFFFFF;
    overflow:hidden;
}
.ab-story::before{
    content:"";position:absolute;inset:0;pointer-events:none;
    background:
        radial-gradient(700px 500px at 10% 20%,rgba(201,147,44,.07),transparent 65%),
        radial-gradient(700px 500px at 90% 80%,rgba(49,63,126,.06),transparent 65%);
}
.ab-story::after{
    content:"";position:absolute;inset:0;pointer-events:none;
    background-image:radial-gradient(circle,rgba(19,26,70,.07) 1px,transparent 1.3px);
    background-size:30px 30px;
    -webkit-mask-image:radial-gradient(ellipse 70% 60% at 50% 50%,#000 20%,transparent 78%);
    mask-image:radial-gradient(ellipse 70% 60% at 50% 50%,#000 20%,transparent 78%);
}
.ab-story-grid{
    position:relative;
    z-index:2;
    display:grid;
    grid-template-columns:5fr 7fr;
    gap:64px;
    align-items:center;
}
@media(max-width:900px){
    .ab-story-grid{grid-template-columns:1fr;gap:48px}
}
.ab-story-logo-wrap{display:flex;justify-content:center;}
.ab-story-logo-card{
    display:inline-flex;align-items:center;justify-content:center;
    padding:48px 40px;
    background:linear-gradient(160deg,#FFFFFF,#FBF7EC);
    border:1px solid #EDE6D3;
    border-radius:24px;
    box-shadow:
        0 30px 60px -40px rgba(11,18,38,.35),
        0 0 0 1px rgba(201,147,44,.08),
        inset 0 1px 0 rgba(255,255,255,.8);
    transition:transform .6s cubic-bezier(.19,1,.22,1),box-shadow .5s;
    max-width:380px;width:100%;
}
.ab-story-logo-card:hover{
    transform:translateY(-4px);
    box-shadow:
        0 40px 70px -40px rgba(11,18,38,.4),
        0 0 0 1px rgba(201,147,44,.18),
        inset 0 1px 0 rgba(255,255,255,.8);
}
.ab-story-logo-card img{max-width:240px;height:auto;display:block;}
.ab-story-content{text-align:left;}
.ab-story-label{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:13px;font-weight:700;
    letter-spacing:.28em;text-transform:uppercase;
    color:#B07D1E;
    margin-bottom:20px;padding:8px 16px;
    background:rgba(201,147,44,.08);
    border-radius:9999px;
    border:1px solid rgba(201,147,44,.2);
}
.ab-story-label::before{
    content:"";width:6px;height:6px;border-radius:50%;
    background:#C9932C;
}
.ab-story-headline{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;
    font-size:clamp(28px,3.2vw,42px);
    line-height:1.18;
    letter-spacing:-.03em;
    color:#0B1226;
    margin:0 0 20px;
}
.ab-story-headline .ab-accent{font-size:1.05em;color:#C9932C}
.ab-story-lead{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:18px;line-height:1.7;color:#334155;
    font-weight:500;letter-spacing:-.005em;
    margin:0 0 24px;
}
.ab-story-body{
    padding-left:20px;
    border-left:3px solid #C9932C;
    margin-bottom:28px;
}
.ab-story-body p{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:17px;line-height:1.85;color:#475569;
    font-weight:400;margin:0 0 14px;
}
.ab-story-body p:last-child{margin-bottom:0}
.ab-story-body strong{
    color:#0B1226;font-weight:700;
    background:linear-gradient(transparent 62%,rgba(241,196,15,.35) 0);
    padding:0 2px;
}
.ab-story-chips{display:flex;flex-wrap:wrap;gap:8px;}
.ab-chip{
    display:inline-flex;align-items:center;gap:8px;
    padding:9px 18px;border-radius:9999px;
    background:#FFFFFF;border:1px solid #E5E9F0;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:14px;font-weight:600;color:#334155;
    transition:all .35s cubic-bezier(.19,1,.22,1);
}
.ab-chip::before{content:"";width:5px;height:5px;border-radius:50%;background:#C9932C}
.ab-chip:hover{
    border-color:rgba(201,147,44,.5);
    background:#FBF9F4;color:#0B1226;
    transform:translateY(-2px);
}

/* ============================================================
   VISI & MISI
   ============================================================ */
.ab-vm{
    position:relative;
    padding:120px 0;
    background:#05070a;
    color:#FFFFFF;
    overflow:hidden;
}
.ab-vm-inner{
    position:relative;z-index:3;
    max-width:1000px;margin:0 auto;
}
.ab-vm-head{text-align:center;margin-bottom:80px;}
.ab-vm-eyebrow{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:13px;font-weight:700;
    letter-spacing:.28em;text-transform:uppercase;
    color:#FFD11A;margin-bottom:20px;
}
.ab-vm-eyebrow::before,
.ab-vm-eyebrow::after{
    content:"";width:32px;height:1px;background:rgba(255,209,26,.5);
}
.ab-vm-title{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;
    font-size:clamp(32px,4vw,52px);
    line-height:1.1;letter-spacing:-.03em;
    color:#FFFFFF;margin:0;
}
.ab-vm-title .ab-accent{color:#C9932C}
.ab-vm-visi{
    position:relative;
    max-width:820px;margin:0 auto 100px;
    padding:60px 40px;
    background:linear-gradient(160deg,rgba(255,255,255,.045),rgba(255,255,255,.012));
    border:1px solid rgba(255,255,255,.09);
    border-radius:24px;text-align:center;
    backdrop-filter:blur(6px);
    -webkit-backdrop-filter:blur(6px);
}
.ab-vm-visi::before{
    content:"";position:absolute;top:0;left:20%;right:20%;height:2px;
    background:linear-gradient(90deg,transparent,#f1c40f,transparent);
    border-radius:2px;
}
.ab-vm-visi-label{
    display:inline-block;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:13px;font-weight:700;
    letter-spacing:.3em;text-transform:uppercase;
    color:#FFD11A;
    padding-bottom:12px;margin-bottom:24px;position:relative;
}
.ab-vm-visi-label::after{
    content:"";position:absolute;bottom:0;left:50%;
    transform:translateX(-50%);
    width:40px;height:2px;
    background:linear-gradient(90deg,#f1c40f,transparent);
    border-radius:2px;
}
.ab-vm-visi-quote{
    font-family:'Instrument Serif',Georgia,serif;
    font-style:italic;font-weight:400;
    font-size:clamp(24px,2.5vw,32px);
    line-height:1.5;letter-spacing:-.005em;
    color:rgba(255,255,255,.92);margin:0;
}
.ab-vm-misi-head{text-align:center;margin-bottom:48px;}
.ab-vm-misi-label{
    display:inline-block;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:13px;font-weight:700;
    letter-spacing:.3em;text-transform:uppercase;
    color:#FFD11A;
    padding-bottom:12px;position:relative;
}
.ab-vm-misi-label::after{
    content:"";position:absolute;bottom:0;left:50%;
    transform:translateX(-50%);
    width:40px;height:2px;
    background:linear-gradient(90deg,#f1c40f,transparent);
    border-radius:2px;
}
.ab-vm-misi-sub{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:16px;color:rgba(255,255,255,.55);
    margin:16px 0 0;
}
.ab-vm-list{
    list-style:none;padding:0;margin:0;
    display:grid;grid-template-columns:repeat(2,1fr);gap:20px;
}
@media(max-width:768px){
    .ab-vm-list{grid-template-columns:1fr;gap:16px}
}
.ab-vm-item{
    position:relative;
    padding:32px 28px 28px 68px;
    background:linear-gradient(155deg,rgba(255,255,255,.045),rgba(255,255,255,.012));
    border:1px solid rgba(255,255,255,.09);
    border-radius:18px;
    transition:transform .5s cubic-bezier(.19,1,.22,1),border-color .4s,box-shadow .5s;
    overflow:hidden;
    backdrop-filter:blur(6px);
    -webkit-backdrop-filter:blur(6px);
}
.ab-vm-item::before{
    content:"";position:absolute;top:0;left:0;right:0;height:2px;
    background:linear-gradient(90deg,transparent,#f1c40f,transparent);
    transform:scaleX(0);transform-origin:center;
    transition:transform .7s cubic-bezier(.19,1,.22,1);
}
.ab-vm-item:hover::before{transform:scaleX(1)}
.ab-vm-item:hover{
    transform:translateY(-4px);
    border-color:rgba(241,196,15,.3);
    box-shadow:0 20px 40px -24px rgba(0,0,0,.8);
}
.ab-vm-num{
    position:absolute;top:28px;left:24px;
    width:36px;height:36px;
    display:flex;align-items:center;justify-content:center;
    font-family:'Instrument Serif',serif;
    font-style:italic;font-weight:400;
    font-size:20px;color:#0B1226;
    background:linear-gradient(135deg,#f1c40f,#C9932C);
    border-radius:10px;
    box-shadow:0 8px 20px -8px rgba(241,196,15,.6);
    transition:transform .5s cubic-bezier(.19,1,.22,1);
}
.ab-vm-item:hover .ab-vm-num{transform:rotate(-8deg) scale(1.08);}
.ab-vm-text{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:16.5px;line-height:1.8;
    color:#CBD5E1;margin:0;
}
.ab-vm-text strong{color:#FFFFFF;font-weight:600}

/* ============================================================
   VALUES
   ============================================================ */
.ab-values{
    position:relative;padding:120px 0;
    background:#FAFBFD;overflow:hidden;
}
.ab-values::before{
    content:"";position:absolute;inset:0;pointer-events:none;
    background:
        radial-gradient(800px 500px at 90% 10%,rgba(237,194,115,.12),transparent 70%),
        radial-gradient(700px 500px at 10% 90%,rgba(49,63,126,.06),transparent 70%);
}
.ab-values-head{
    position:relative;z-index:2;
    max-width:640px;margin:0 auto 60px;text-align:center;
}
.ab-values-eyebrow{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:13px;letter-spacing:.28em;
    text-transform:uppercase;color:#B07D1E;margin-bottom:20px;
}
.ab-values-eyebrow::before,
.ab-values-eyebrow::after{
    content:"";width:32px;height:1px;background:rgba(176,125,30,.55);
}
.ab-values-title{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;font-size:clamp(30px,3.6vw,46px);
    line-height:1.15;letter-spacing:-.03em;color:#0B1226;margin:0 0 18px;
}
.ab-values-sub{font-size:17px;line-height:1.7;color:#64748B;margin:0;}
.ab-values-grid{
    position:relative;z-index:2;
    display:grid;grid-template-columns:repeat(3,1fr);gap:20px;
}
@media(max-width:900px){.ab-values-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:560px){.ab-values-grid{grid-template-columns:1fr}}
.ab-value-card{
    position:relative;padding:36px 30px;
    border-radius:20px;background:#FFFFFF;
    border:1px solid #EAEEF5;
    transition:transform .5s cubic-bezier(.19,1,.22,1),box-shadow .45s,border-color .3s;
    overflow:hidden;
}
.ab-value-card::before{
    content:"";position:absolute;left:0;top:0;right:0;height:3px;
    background:linear-gradient(90deg,transparent,#f1c40f,transparent);
    transform:scaleX(0);transition:transform .5s cubic-bezier(.19,1,.22,1);
}
.ab-value-card:hover::before{transform:scaleX(1)}
.ab-value-card:hover{
    transform:translateY(-6px);
    border-color:rgba(241,196,15,.35);
    box-shadow:0 26px 50px -25px rgba(11,18,38,.25);
}
.ab-value-icon{
    width:60px;height:60px;border-radius:16px;
    display:flex;align-items:center;justify-content:center;
    margin-bottom:22px;
    background:linear-gradient(135deg,rgba(241,196,15,.18),rgba(201,147,44,.06));
    border:1px solid rgba(201,147,44,.25);
    transition:transform .5s cubic-bezier(.19,1,.22,1),background-color .35s,border-color .35s;
}
.ab-value-card:hover .ab-value-icon{
    transform:rotate(-6deg) scale(1.08);
    background:linear-gradient(135deg,#f1c40f,#C9932C);
    border-color:transparent;
}
.ab-value-icon svg{
    width:26px;height:26px;color:#B07D1E;
    transition:color .35s;
}
.ab-value-card:hover .ab-value-icon svg{color:#0B1226}
.ab-value-title{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:20px;letter-spacing:-.015em;
    color:#0B1226;margin:0 0 10px;
}
.ab-value-desc{font-size:15.5px;line-height:1.75;color:#64748B;margin:0;}

/* ============================================================
   LEADERS
   ============================================================ */
.ab-leaders{
    position:relative;padding:120px 0;
    background:#05070a;color:#FFFFFF;overflow:hidden;
}
.ab-leaders-head{
    position:relative;z-index:3;
    max-width:640px;margin:0 auto 72px;text-align:center;
}
.ab-leaders-eyebrow{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:13px;letter-spacing:.28em;
    text-transform:uppercase;color:#FFD11A;margin-bottom:20px;
}
.ab-leaders-eyebrow::before,
.ab-leaders-eyebrow::after{
    content:"";width:32px;height:1px;background:rgba(255,209,26,.5);
}
.ab-leaders-title{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;font-size:clamp(30px,3.6vw,46px);
    line-height:1.15;letter-spacing:-.03em;color:#FFFFFF;margin:0;
}
.ab-leaders-title .ab-accent{color:#C9932C}
.ab-leader{
    position:relative;z-index:3;
    display:grid;
    grid-template-columns:minmax(0,360px) minmax(0,1fr);
    gap:72px;align-items:center;
    max-width:1080px;margin:0 auto;
    padding:64px 0;
    border-top:1px solid rgba(255,255,255,.08);
}
.ab-leader:first-of-type{border-top:0;padding-top:0}
.ab-leader:last-of-type{padding-bottom:0}
.ab-leader.reverse{grid-template-columns:minmax(0,1fr) minmax(0,360px);}
.ab-leader.reverse .ab-leader-photo-wrap{order:2}
.ab-leader.reverse .ab-leader-content{order:1}
@media(max-width:900px){
    .ab-leader,
    .ab-leader.reverse{
        grid-template-columns:1fr;gap:56px;padding:56px 0;
    }
    .ab-leader.reverse .ab-leader-photo-wrap{order:1}
    .ab-leader.reverse .ab-leader-content{order:2}
}
.ab-leader-photo-wrap{
    position:relative;padding:0 18px 0 0;
    max-width:360px;margin:0 auto;
}
.ab-leader-photo-frame{
    position:relative;border-radius:6px;overflow:hidden;
    background:#1E2A55;aspect-ratio:4/5;
    box-shadow:0 30px 60px -30px rgba(0,0,0,.85);
}
.ab-leader-photo-frame img{
    width:100%;height:100%;
    object-fit:cover;object-position:center top;display:block;
    transition:transform 1s cubic-bezier(.19,1,.22,1);
}
.ab-leader-photo-frame:hover img{transform:scale(1.04)}
.ab-leader-photo-frame::after{
    content:"";position:absolute;
    right:-14px;top:14px;bottom:14px;width:8px;
    background:linear-gradient(180deg,#f1c40f,#C9932C);
    border-radius:4px;
    box-shadow:0 0 20px rgba(241,196,15,.35);
    z-index:-1;
}
.ab-leader-card{
    position:absolute;left:50%;bottom:-28px;
    transform:translateX(-50%);
    background:#FFFFFF;color:#0B1226;
    padding:18px 26px 16px;border-radius:8px;
    text-align:center;min-width:82%;
    box-shadow:0 20px 40px -20px rgba(0,0,0,.6);
}
.ab-leader-card h3{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:18px;letter-spacing:-.01em;
    color:#0B1226;margin:0 0 4px;line-height:1.3;
}
.ab-leader-card span{
    display:inline-block;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:14px;font-weight:600;letter-spacing:.04em;
    color:#C9932C;
}
@media(max-width:900px){
    .ab-leader-photo-wrap{max-width:320px;padding:0 14px 0 0}
    .ab-leader-photo-frame::after{right:-10px;width:6px}
    .ab-leader-card{padding:14px 22px 12px;bottom:-24px}
    .ab-leader-card h3{font-size:17px}
    .ab-leader-card span{font-size:13px}
}
.ab-leader-content{padding-top:8px;max-width:560px}
.ab-leader-label{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:13px;letter-spacing:.26em;
    text-transform:uppercase;color:#FFD11A;
    padding:9px 16px 9px 14px;
    border-left:3px solid #f1c40f;
    background:rgba(241,196,15,.06);
    border-radius:2px;margin-bottom:28px;line-height:1;
}
.ab-leader-label .num{
    display:inline-block;
    color:rgba(255,209,26,.55);
    margin-right:4px;font-weight:600;
}
.ab-leader-headline{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;font-size:clamp(28px,3.2vw,40px);
    line-height:1.15;letter-spacing:-.028em;
    color:#FFFFFF;margin:0 0 20px;
}
.ab-leader-headline .gold{color:#C9932C}
.ab-leader-divider{
    width:60px;height:3px;border-radius:3px;
    background:linear-gradient(90deg,#f1c40f,#C9932C);
    margin:0 0 28px;
}
.ab-leader-text{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:17px;line-height:1.85;color:#CBD5E1;
    margin:0 0 18px;font-weight:400;
}
.ab-leader-text:last-child{margin-bottom:0}
.ab-leader-text strong{color:#FFFFFF;font-weight:600}
@media(max-width:640px){
    .ab-leaders{padding:80px 0}
    .ab-leaders-head{margin-bottom:48px}
    .ab-leader-content{max-width:100%}
    .ab-leader-text{font-size:16px}
}

/* ============================================================
   TEAM
   ============================================================ */
.ab-team-block{
    position:relative;z-index:3;
    max-width:1080px;margin:80px auto 0;
    padding-top:64px;padding-bottom:20px;
    border-top:1px solid rgba(255,255,255,.08);
}
.ab-team-block-head{
    max-width:640px;margin:0 auto 40px;text-align:center;
}
.ab-team-block-eyebrow{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:13px;letter-spacing:.28em;
    text-transform:uppercase;color:#FFD11A;margin-bottom:16px;
}
.ab-team-block-eyebrow::before,
.ab-team-block-eyebrow::after{
    content:"";width:28px;height:1px;background:rgba(255,209,26,.5);
}
.ab-team-block-title{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;font-size:clamp(26px,3vw,38px);
    line-height:1.15;letter-spacing:-.028em;
    color:#FFFFFF;margin:0;
}
.ab-team-block-title .ab-accent{color:#C9932C}
.ab-team-photo{
    position:relative;width:100%;border-radius:20px;
    overflow:hidden;background:#0E1530;
    border:1px solid rgba(255,255,255,.1);
    box-shadow:0 30px 70px -30px rgba(0,0,0,.9);
    isolation:isolate;
}
.ab-team-photo img{
    display:block;width:100%;height:auto;
    aspect-ratio:16/9;
    object-fit:cover;object-position:center top;
}
@media(max-width:640px){.ab-team-photo img{aspect-ratio:4/3}}
.ab-team-photo::after{
    content:"";position:absolute;
    left:0;right:0;bottom:0;height:80%;
    background:linear-gradient(180deg,
        transparent 0%,
        rgba(5,7,10,.15) 30%,
        rgba(5,7,10,.65) 60%,
        rgba(5,7,10,.95) 100%);
    pointer-events:none;z-index:1;
}
.ab-team-caption{
    position:absolute;left:0;right:0;bottom:0;z-index:2;
    padding:56px 56px 44px;text-align:left;
    max-width:960px;margin:0 auto;
}
@media(max-width:900px){.ab-team-caption{padding:40px 32px 32px}}
@media(max-width:640px){.ab-team-caption{padding:28px 22px 24px}}
.ab-team-caption-label{
    display:inline-flex;align-items:center;gap:10px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:700;font-size:12.5px;letter-spacing:.26em;
    text-transform:uppercase;color:#FFD11A;
    margin-bottom:14px;
    text-shadow:0 2px 10px rgba(0,0,0,.9);
}
.ab-team-caption-label::before{
    content:"";width:28px;height:1.5px;background:#f1c40f;
}
.ab-team-caption p{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:17px;line-height:1.8;
    color:rgba(255,255,255,.88);margin:0;font-weight:400;
    max-width:880px;
    text-shadow:0 2px 12px rgba(0,0,0,.85);
}
.ab-team-caption p + p{margin-top:12px}
.ab-team-caption strong{
    color:#FFFFFF;font-weight:600;
    text-shadow:0 2px 12px rgba(0,0,0,.9);
}
@media(max-width:640px){
    .ab-team-caption p{font-size:15.5px;line-height:1.75}
    .ab-team-caption-label{font-size:12px;margin-bottom:10px}
}

/* ============================================================
   CTA
   ============================================================ */
.ab-cta{
    position:relative;padding:120px 0;
    background:#05070a;color:#FFFFFF;overflow:hidden;
}
.ab-cta-inner{
    position:relative;z-index:3;
    max-width:720px;margin:0 auto;text-align:center;
}
.ab-cta-title{
    font-family:'Plus Jakarta Sans',sans-serif;
    font-weight:800;font-size:clamp(30px,3.8vw,48px);
    line-height:1.15;letter-spacing:-.03em;color:#FFFFFF;
    margin:0 0 20px;
}
.ab-cta-desc{
    font-size:17.5px;line-height:1.75;
    color:rgba(255,255,255,.68);margin:0 0 36px;
}
.ab-cta-btn{
    position:relative;display:inline-flex;align-items:center;gap:12px;
    height:58px;padding:0 38px;border-radius:9999px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:16px;font-weight:700;color:#12173F;
    background:#f1c40f;text-decoration:none;overflow:hidden;
    transition:transform .35s cubic-bezier(.19,1,.22,1),box-shadow .35s;
    box-shadow:0 16px 36px -12px rgba(241,196,15,.8);
}
.ab-cta-btn::before{
    content:"";position:absolute;top:0;left:-120%;
    width:60%;height:100%;
    background:linear-gradient(110deg,transparent,rgba(255,255,255,.55),transparent);
    transform:skewX(-20deg);
    transition:left .8s cubic-bezier(.19,1,.22,1);
}
.ab-cta-btn:hover{transform:translateY(-3px);box-shadow:0 24px 50px -12px rgba(241,196,15,.95)}
.ab-cta-btn:hover::before{left:160%}
.ab-cta-btn:hover svg{transform:translateX(5px)}
.ab-cta-btn svg{transition:transform .35s cubic-bezier(.19,1,.22,1)}

/* ============================================================
   MISC
   ============================================================ */
#ab-progress{
    position:fixed;top:0;left:0;height:3px;width:100%;z-index:120;
    transform-origin:0 50%;transform:scaleX(0);
    background:linear-gradient(90deg,#A67C10,#f1c40f,#F0C060);
    box-shadow:0 0 12px rgba(241,196,15,.6);pointer-events:none;
}
#ab-top{
    position:fixed;right:22px;bottom:26px;z-index:105;
    width:46px;height:46px;border-radius:9999px;
    display:flex;align-items:center;justify-content:center;
    background:#f1c40f;color:#12173F;border:0;cursor:pointer;
    box-shadow:0 14px 30px -10px rgba(0,0,0,.5);
    opacity:0;transform:translateY(16px) scale(.9);pointer-events:none;
    transition:opacity .3s,transform .3s,background-color .3s;
}
#ab-top.is-on{opacity:1;transform:none;pointer-events:auto}
#ab-top:hover{background:#fff;transform:translateY(-4px)}
.ab-rip{
    position:absolute;width:120px;height:120px;
    margin:-60px 0 0 -60px;border-radius:50%;
    background:rgba(255,255,255,.4);transform:scale(0);
    animation:ab-rip .6s ease-out forwards;pointer-events:none;
}
@keyframes ab-rip{to{transform:scale(2.4);opacity:0}}
.ab :focus-visible{outline:2px solid #EDC273;outline-offset:3px}

@media(prefers-reduced-motion:reduce){
    .ab-js .ab-rv{opacity:1 !important;transform:none !important}
    .ab *,.ab *::before,.ab *::after{transition:none !important;animation:none !important}
    .ab-hero h1 .word{opacity:1;transform:none}
    html{scroll-behavior:auto}
    .ab-space::before,.ab-bg::before,.ab-bg::after,.ab-bg-grid{animation:none}
    .ab-speaker,.sp-person,.sp-head,.sp-mouth,.sp-arm-left,.sp-arm-right,.sp-wave,.sp-spot{animation:none}
}

@media(max-width:991.98px){
    .ab-story{padding:80px 0 90px}
    .ab-vm{padding:90px 0}
    .ab-values{padding:90px 0}
    .ab-leaders{padding:90px 0}
    .ab-cta{padding:80px 0}
}
@media(max-width:640px){
    .ab-hero-inner{padding:40px 0 90px}
    .ab-hero-scroll{display:none}
    .ab-story{padding:64px 0 72px}
    .ab-vm,.ab-values,.ab-leaders,.ab-cta{padding:72px 0}
    .ab-story-headline{font-size:clamp(26px,5.5vw,34px)}
    .ab-vm-visi{padding:40px 24px}
    .ab-vm-item{padding:26px 22px 22px 60px}
    .ab-vm-num{width:30px;height:30px;font-size:16px;left:20px;top:24px}
    .ab-cta-btn{width:100%;justify-content:center}
}
</style>

<div class="ab" id="ab">
<script>document.getElementById('ab').classList.add('ab-js');</script>

{{-- ============================================================
     HERO
     ============================================================ --}}
<section id="ab-hero" class="ab-hero">
    <img id="ab-hero-photo"
         class="ab-hero-img"
         src="{{ asset('images/tentangkami11.jpg') }}"
         alt="Tentang PT Bachri Samudera Indonesia">
    <div class="ab-hero-shade"></div>

    {{-- BG layers --}}
    <div class="ab-space" aria-hidden="true"></div>
    <div class="ab-bg" aria-hidden="true">
        <span class="ab-bg-grid"></span>
    </div>

    <div class="ab-hero-wrap ab-wrap">
        <div class="ab-hero-inner">
            <div class="ab-hero-eyebrow">PT Bachri Samudera Indonesia</div>
            <h1 id="ab-title">
                <span class="word">Tentang</span>
                <span class="word gold">Kami</span>
            </h1>
            <p class="ab-hero-sub">
                Kreativitas, Kualitas, dan Kolaborasi<br>
                untuk Masa Depan yang Lebih Baik
            </p>
        </div>
    </div>

    {{-- ==========================================================
         PUBLIC SPEAKER ANIMASI
         ========================================================== --}}
    <div class="ab-speaker" id="ab-speaker" role="img" aria-label="Ilustrasi pembicara publik">
        <svg viewBox="0 0 400 500" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="spGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#FFD11A" stop-opacity=".95"/>
                    <stop offset="60%" stop-color="#C9932C" stop-opacity=".85"/>
                    <stop offset="100%" stop-color="#7A5810" stop-opacity=".75"/>
                </linearGradient>
                <linearGradient id="spBody" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#2B3468"/>
                    <stop offset="100%" stop-color="#0F1730"/>
                </linearGradient>
                <radialGradient id="spSpot" cx="50%" cy="0%" r="80%">
                    <stop offset="0%" stop-color="#FFD11A" stop-opacity=".30"/>
                    <stop offset="60%" stop-color="#C9932C" stop-opacity=".08"/>
                    <stop offset="100%" stop-color="#C9932C" stop-opacity="0"/>
                </radialGradient>
                <radialGradient id="spHalo" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#FFD11A" stop-opacity=".35"/>
                    <stop offset="100%" stop-color="#FFD11A" stop-opacity="0"/>
                </radialGradient>
                <filter id="spGlow" x="-50%" y="-50%" width="200%" height="200%">
                    <feGaussianBlur stdDeviation="2.2"/>
                </filter>
            </defs>

            {{-- Spotlight cone --}}
            <path class="sp-spot"
                  d="M200 0 L 60 420 L 340 420 Z"
                  fill="url(#spSpot)"/>

            {{-- Halo belakang kepala --}}
            <circle cx="200" cy="176" r="70" fill="url(#spHalo)" filter="url(#spGlow)"/>

            {{-- Speech waves (keluar dari mulut ke kanan atas) --}}
            <g class="sp-waves" stroke="#FFD11A" stroke-width="2" fill="none" opacity=".9">
                <path class="sp-wave" d="M228 168 Q 258 150 288 168"/>
                <path class="sp-wave" d="M228 168 Q 268 138 308 168"/>
                <path class="sp-wave" d="M228 168 Q 278 126 328 168"/>
            </g>

            {{-- Podium --}}
            <path d="M110 500 L 118 400 L 282 400 L 290 500 Z"
                  fill="url(#spBody)" stroke="rgba(255,209,26,.35)" stroke-width="1.4"/>
            <rect x="100" y="395" width="200" height="10" rx="3"
                  fill="#1A2350" stroke="rgba(255,209,26,.45)" stroke-width="1"/>
            {{-- Logo/emblem di podium --}}
            <circle cx="200" cy="450" r="14" fill="none"
                    stroke="#FFD11A" stroke-width="1.6" opacity=".75"/>
            <circle cx="200" cy="450" r="5" fill="#FFD11A" opacity=".9"/>

            {{-- Person group --}}
            <g class="sp-person">
                {{-- Body / torso --}}
                <path d="M158 400 L 242 400 L 236 280 Q 232 245 200 240 Q 168 245 164 280 Z"
                      fill="url(#spBody)" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
                {{-- Shirt collar line --}}
                <path d="M185 250 L 200 268 L 215 250" stroke="rgba(255,209,26,.55)"
                      stroke-width="1.6" fill="none" stroke-linecap="round"/>
                {{-- Left arm --}}
                <g class="sp-arm-left">
                    <path d="M166 268 Q 148 300 152 348"
                          stroke="url(#spGrad)" stroke-width="14"
                          stroke-linecap="round" fill="none"/>
                    <circle cx="152" cy="352" r="8" fill="#FFD11A"/>
                </g>
                {{-- Right arm gesturing --}}
                <g class="sp-arm-right">
                    <path d="M234 268 Q 262 280 272 250"
                          stroke="url(#spGrad)" stroke-width="14"
                          stroke-linecap="round" fill="none"/>
                    <circle cx="274" cy="246" r="9" fill="#FFD11A"/>
                </g>
                {{-- Neck --}}
                <rect x="192" y="222" width="16" height="26" rx="6" fill="#1A2350"/>
                {{-- Head --}}
                <g class="sp-head">
                    <circle cx="200" cy="176" r="34" fill="#243063"
                            stroke="rgba(255,209,26,.35)" stroke-width="1.4"/>
                    {{-- Hair/hat silhouette highlight --}}
                    <path d="M170 168 Q 178 142 200 140 Q 222 142 230 168 Q 218 156 200 156 Q 182 156 170 168 Z"
                          fill="#0B1226" opacity=".85"/>
                    {{-- Mouth --}}
                    <rect class="sp-mouth" x="193" y="188" width="14" height="3" rx="1.5"
                          fill="#FFD11A" opacity=".95"/>
                </g>
            </g>
        </svg>
    </div>

    <div class="ab-speaker-tip">Live Speaker</div>

    <div class="ab-hero-scroll" aria-hidden="true">
        <span>Scroll</span>
        <div class="line"></div>
    </div>
</section>

{{-- ============================================================
     STORY
     ============================================================ --}}
<section id="ab-story" class="ab-story">
    <div class="ab-wrap">
        <div class="ab-story-grid">

            <div class="ab-story-logo-wrap ab-rv from-left">
                <div class="ab-story-logo-card">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo PT Bachri Samudera Indonesia">
                </div>
            </div>

            <div class="ab-story-content">
                <span class="ab-story-label ab-rv from-right" style="--d:.05s">Our Story</span>

                <h2 class="ab-story-headline ab-rv from-right" style="--d:.1s">
                    Berdiri sejak <span class="ab-accent">2020</span>,<br>
                    berkembang untuk masa depan
                </h2>

                <p class="ab-story-lead ab-rv from-right" style="--d:.15s">
                    Perusahaan multibisnis yang menghadirkan solusi kreatif dari konsep hingga eksekusi.
                </p>

                <div class="ab-story-body ab-rv from-right" style="--d:.2s">
                    <p>
                        PT BACHRI SAMUDERA INDONESIA (BAHRI) bergerak di bidang <strong>Konstruksi, Exterior &amp; Interior, Event Management, Desain serta Periklanan</strong>. Dengan kemampuan desain kreatif dan produksi mandiri, kami memastikan setiap solusi visual dan branding memiliki kualitas terbaik.
                    </p>
                    <p>
                        Sebagai profesional yang berpengalaman di industri Event Organizer, kami senantiasa berinovasi, cepat tanggap terhadap kebutuhan klien, dan mampu mengelola berbagai situasi, termasuk kondisi darurat.
                    </p>
                    <p>
                        Melalui kombinasi profesionalisme, kreativitas, dan eksekusi yang tepat waktu, kami berkomitmen memberikan nilai tambah yang signifikan bagi klien, mitra, dan masyarakat.
                    </p>
                </div>

                <div class="ab-story-chips ab-rv from-right" style="--d:.25s">
                    <span class="ab-chip">Konstruksi</span>
                    <span class="ab-chip">Exterior &amp; Interior</span>
                    <span class="ab-chip">Event Management</span>
                    <span class="ab-chip">Desain</span>
                    <span class="ab-chip">Periklanan</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     VISI & MISI
     ============================================================ --}}
<section id="ab-vm" class="ab-vm">
    <div class="ab-space" aria-hidden="true"></div>
    <div class="ab-bg" aria-hidden="true">
        <span class="ab-bg-grid"></span>
    </div>

    <div class="ab-wrap">
        <div class="ab-vm-inner">

            <div class="ab-vm-head ab-rv">
                <span class="ab-vm-eyebrow">Filosofi &amp; Tujuan</span>
                <h2 class="ab-vm-title">Visi &amp; <span class="ab-accent">Misi</span></h2>
            </div>

            <div class="ab-vm-visi ab-rv" style="--d:.1s">
                <span class="ab-vm-visi-label">Visi</span>
                <p class="ab-vm-visi-quote">
                    "Menjadi perusahaan multibisnis yang inovatif, terpercaya, dan berdampak positif dalam membangun solusi kreatif dan berkelanjutan."
                </p>
            </div>

            <div class="ab-vm-misi-head ab-rv" style="--d:.15s">
                <span class="ab-vm-misi-label">Misi</span>
                <p class="ab-vm-misi-sub">Langkah nyata yang menjadi fondasi setiap karya kami.</p>
            </div>

            <ul class="ab-vm-list">
                <li class="ab-vm-item ab-rv" style="--d:.2s">
                    <span class="ab-vm-num">01</span>
                    <p class="ab-vm-text">
                        Memberikan layanan berkualitas tinggi di bidang <strong>Konstruksi, Exterior &amp; Interior, Event Management, Desain, serta Periklanan</strong>.
                    </p>
                </li>
                <li class="ab-vm-item ab-rv" style="--d:.25s">
                    <span class="ab-vm-num">02</span>
                    <p class="ab-vm-text">
                        Menghadirkan desain kreatif dan produksi mandiri yang efisien dan berstandar tinggi.
                    </p>
                </li>
                <li class="ab-vm-item ab-rv" style="--d:.3s">
                    <span class="ab-vm-num">03</span>
                    <p class="ab-vm-text">
                        Membangun kolaborasi yang kuat dengan klien, mitra, dan komunitas untuk menciptakan pertumbuhan bersama.
                    </p>
                </li>
                <li class="ab-vm-item ab-rv" style="--d:.35s">
                    <span class="ab-vm-num">04</span>
                    <p class="ab-vm-text">
                        Mendorong inovasi dan kreativitas sebagai fondasi utama dalam menghadapi setiap tantangan bisnis.
                    </p>
                </li>
            </ul>

        </div>
    </div>
</section>

{{-- ============================================================
     VALUES
     ============================================================ --}}
<section id="ab-values" class="ab-values">
    <div class="ab-wrap">
        <div class="ab-values-head ab-rv">
            <span class="ab-values-eyebrow">Why Choose Us</span>
            <h2 class="ab-values-title">Mengapa <span class="ab-accent">BACHRI</span>?</h2>
            <p class="ab-values-sub">Kami percaya bahwa setiap proyek adalah kesempatan untuk menciptakan dampak yang nyata.</p>
        </div>

        <div class="ab-values-grid">
            <div class="ab-value-card ab-rv" style="--d:.05s">
                <div class="ab-value-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg></div>
                <h3 class="ab-value-title">Creative</h3>
                <p class="ab-value-desc">Mengutamakan kreativitas dalam setiap konsep dan solusi yang kami hadirkan.</p>
            </div>
            <div class="ab-value-card ab-rv" style="--d:.1s">
                <div class="ab-value-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                <h3 class="ab-value-title">Professional</h3>
                <p class="ab-value-desc">Didukung pengalaman mendalam dalam mengelola proyek dan event berskala besar.</p>
            </div>
            <div class="ab-value-card ab-rv" style="--d:.15s">
                <div class="ab-value-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg></div>
                <h3 class="ab-value-title">End-to-end Solution</h3>
                <p class="ab-value-desc">Dari konsep, desain, produksi, hingga instalasi di lapangan.</p>
            </div>
            <div class="ab-value-card ab-rv" style="--d:.2s">
                <div class="ab-value-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
                <h3 class="ab-value-title">Responsive</h3>
                <p class="ab-value-desc">Cepat tanggap terhadap kebutuhan klien dan setiap situasi di lapangan.</p>
            </div>
            <div class="ab-value-card ab-rv" style="--d:.25s">
                <div class="ab-value-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg></div>
                <h3 class="ab-value-title">Quality</h3>
                <p class="ab-value-desc">Mengutamakan kualitas hasil dan standar produksi di setiap detail.</p>
            </div>
            <div class="ab-value-card ab-rv" style="--d:.3s">
                <div class="ab-value-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg></div>
                <h3 class="ab-value-title">Collaboration</h3>
                <p class="ab-value-desc">Membangun hubungan dan kolaborasi yang kuat dengan klien dan mitra.</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     LEADERS
     ============================================================ --}}
<section id="ab-leaders" class="ab-leaders">
    <div class="ab-space" aria-hidden="true"></div>
    <div class="ab-bg" aria-hidden="true">
        <span class="ab-bg-grid"></span>
    </div>

    <div class="ab-wrap">
        <div class="ab-leaders-head ab-rv">
            <span class="ab-leaders-eyebrow">Leadership</span>
            <h2 class="ab-leaders-title">Sambutan <span class="ab-accent">Pimpinan</span></h2>
        </div>

        <div class="ab-leader ab-rv">
            <div class="ab-leader-photo-wrap">
                <div class="ab-leader-photo-frame">
                    <img src="{{ asset('images/rieco.jpeg') }}" alt="Rieco Advina Fazihulisan, SE">
                </div>
                <div class="ab-leader-card">
                    <h3>Rieco Advina Fazihulisan, SE</h3>
                    <span>Komisaris</span>
                </div>
            </div>

            <div class="ab-leader-content">
                <span class="ab-leader-label"><span class="num">01</span>Sambutan Komisaris</span>
                <h3 class="ab-leader-headline">
                    Membangun <span class="gold">Fondasi</span> yang Kuat untuk Pertumbuhan
                </h3>
                <div class="ab-leader-divider"></div>

                <p class="ab-leader-text">
                    Assalamu'alaikum warahmatullahi wabarakatuh. Puji syukur kita panjatkan kepada Tuhan Yang Maha Esa atas segala rahmat dan karunia-Nya. Selamat datang di portal resmi <strong>PT Bachri Samudera Indonesia</strong>.
                </p>
                <p class="ab-leader-text">
                    Sejak berdiri pada tahun 2020, kami berkomitmen untuk terus tumbuh dan berinovasi di berbagai sektor industri. Fondasi yang kuat dibangun melalui profesionalisme, kepercayaan, dan dedikasi seluruh tim kami dalam menghadirkan solusi terbaik bagi setiap klien dan mitra.
                </p>
            </div>
        </div>

        <div class="ab-leader reverse ab-rv">
            <div class="ab-leader-photo-wrap">
                <div class="ab-leader-photo-frame">
                    <img src="{{ asset('images/ilham.jpeg') }}" alt="Ilham Adi Syaputra">
                </div>
                <div class="ab-leader-card">
                    <h3>Ilham Adi Syaputra</h3>
                    <span>Direktur Utama</span>
                </div>
            </div>

            <div class="ab-leader-content">
                <span class="ab-leader-label"><span class="num">02</span>Sambutan Direktur Utama</span>
                <h3 class="ab-leader-headline">
                    Menghadirkan <span class="gold">Solusi Kreatif</span> Tanpa Kompromi
                </h3>
                <div class="ab-leader-divider"></div>

                <p class="ab-leader-text">
                    Kami percaya bahwa setiap proyek adalah kesempatan untuk menciptakan dampak nyata. Melalui tim profesional yang berpengalaman di industri Event Organizer, kami memastikan setiap solusi visual dan branding memiliki kualitas terbaik — dari konsep hingga eksekusi.
                </p>
                <p class="ab-leader-text">
                    Dengan semangat kolaborasi dan inovasi, kami terus berupaya memberikan nilai tambah yang signifikan bagi klien, mitra, dan masyarakat. Terima kasih atas kepercayaan yang telah diberikan kepada kami.
                </p>
            </div>
        </div>

        <div class="ab-leader ab-rv">
            <div class="ab-leader-photo-wrap">
                <div class="ab-leader-photo-frame">
                    <img src="{{ asset('images/ferdinal.jpeg') }}" alt="Ferdinal Ruderi">
                </div>
                <div class="ab-leader-card">
                    <h3>Ferdinal Ruderi</h3>
                    <span>Direktur</span>
                </div>
            </div>

            <div class="ab-leader-content">
                <span class="ab-leader-label"><span class="num">03</span>Sambutan Direktur</span>
                <h3 class="ab-leader-headline">
                    Eksekusi <span class="gold">Tepat Waktu</span> dengan Standar Tinggi
                </h3>
                <div class="ab-leader-divider"></div>

                <p class="ab-leader-text">
                    Komitmen kami sederhana: memberikan hasil terbaik, tepat waktu, dan sesuai standar kualitas yang tinggi. Kami mengelola setiap proyek dengan teliti — mulai dari perencanaan, produksi, hingga instalasi di lapangan.
                </p>
                <p class="ab-leader-text">
                    Bersama tim yang solid dan mitra yang terpercaya, kami siap menghadapi setiap tantangan bisnis dan terus berkontribusi untuk pertumbuhan bersama. Mari berkolaborasi untuk mewujudkan ide dan visi Anda menjadi kenyataan.
                </p>
            </div>
        </div>

        <div class="ab-team-block ab-rv" style="--d:.1s">
            <div class="ab-team-block-head">
                <span class="ab-team-block-eyebrow">Meet The Team</span>
                <h3 class="ab-team-block-title">Tim <span class="ab-accent">Kami</span></h3>
            </div>

            <div class="ab-team-photo">
                <img src="{{ asset('images/fotobertiga.jpeg') }}" alt="Jajaran Pimpinan Perusahaan">
                <div class="ab-team-caption">
                    <span class="ab-team-caption-label">Tim Kami</span>
                    <p>
                        Di balik pertumbuhan dan reputasi perusahaan kami, terdapat kepemimpinan visioner dari Dewan Komisaris serta eksekusi strategis yang solid dari Direktur Utama dan Direktur kami.
                    </p>
                    <p>
                        Bersama-sama, kami menghadirkan solusi <strong>andal</strong>, <strong>amanah</strong>, dan <strong>berorientasi pada hasil jangka panjang</strong> bagi setiap mitra dan klien kami.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     CTA
     ============================================================ --}}
<section id="ab-cta" class="ab-cta">
    <div class="ab-space" aria-hidden="true"></div>
    <div class="ab-bg" aria-hidden="true">
        <span class="ab-bg-grid"></span>
    </div>

    <div class="ab-wrap">
        <div class="ab-cta-inner ab-rv">
            <h2 class="ab-cta-title">
                Siap membangun sesuatu yang <span class="ab-accent">berkesan</span> bersama kami?
            </h2>
            <p class="ab-cta-desc">
                Mari berkolaborasi untuk mewujudkan ide dan visi Anda menjadi kenyataan. Kami siap membantu dari konsep hingga eksekusi.
            </p>
            <a href="{{ route('contact') }}" class="ab-cta-btn">
                <span>Hubungi Kami</span>
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

</div>{{-- /.ab --}}

<script>
(function () {
    'use strict';

    /* ============================================================
       AUTO-ADJUST HERO
       ============================================================ */
    function adjustHeroTop(){
        var hero = document.getElementById('ab-hero');
        if (!hero) return;
        hero.style.marginTop = '0px';
        hero.style.paddingTop = '0px';
        void hero.offsetHeight;
        var rect = hero.getBoundingClientRect();
        var scrollY = window.scrollY || window.pageYOffset || 0;
        var realTop = rect.top + scrollY;
        var nav = document.querySelector(
            'nav.navbar, nav[class*="navbar"], header.fixed, header[class*="fixed"], header, nav'
        );
        var navH = realTop || 80;
        if (nav) {
            var cs = window.getComputedStyle(nav);
            if (cs.position === 'fixed' || cs.position === 'sticky') {
                var h = nav.offsetHeight || nav.getBoundingClientRect().height;
                if (h > 0) navH = h;
            }
        }
        if (realTop > 0) {
            hero.style.marginTop = '-' + realTop + 'px';
            hero.style.paddingTop = Math.max(realTop, navH) + 'px';
        }
        var parent = hero.parentElement;
        if (parent && parent !== document.body) {
            parent.style.paddingTop = '0';
            parent.style.marginTop = '0';
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', adjustHeroTop);
    } else {
        adjustHeroTop();
    }
    window.addEventListener('load', adjustHeroTop);
    var rtime = null;
    window.addEventListener('resize', function(){
        clearTimeout(rtime);
        rtime = setTimeout(adjustHeroTop, 150);
    });
    setTimeout(adjustHeroTop, 100);
    setTimeout(adjustHeroTop, 500);
    setTimeout(adjustHeroTop, 1500);

    /* ============================================================
       REVEAL
       ============================================================ */
    var reduce   = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var canHover = window.matchMedia('(hover: hover)').matches;

    function mk(tag, attrs, html) {
        var el = document.createElement(tag);
        for (var k in attrs) el.setAttribute(k, attrs[k]);
        if (html) el.innerHTML = html;
        return el;
    }

    var rv = document.querySelectorAll('#ab .ab-rv');
    if (!('IntersectionObserver' in window)) {
        rv.forEach(function (el) { el.classList.add('is-in'); });
    } else {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('is-in');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -50px 0px' });
        rv.forEach(function (el) { io.observe(el); });
    }

    /* Progress + Top */
    var bar    = mk('div', { id: 'ab-progress', 'aria-hidden': 'true' });
    var topBtn = mk('button', {
        id: 'ab-top', type: 'button', 'aria-label': 'Kembali ke atas'
    }, '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m18 15-6-6-6 6"/></svg>');
    document.body.appendChild(bar);
    document.body.appendChild(topBtn);

    topBtn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });

    /* ============================================================
       HERO PARALLAX + SPEAKER INTERAKTIF
       ============================================================ */
    var heroImg   = document.getElementById('ab-hero-photo');
    var speaker   = document.getElementById('ab-speaker');
    var hero      = document.getElementById('ab-hero');
    var ticking   = false;
    var spBaseX   = 0, spBaseY = 0;

    /* Speaker parallax ke mouse */
    if (speaker && hero && canHover && !reduce) {
        hero.addEventListener('pointermove', function (e) {
            var r = hero.getBoundingClientRect();
            var nx = (e.clientX - r.left) / r.width  - 0.5; /* -0.5 .. 0.5 */
            var ny = (e.clientY - r.top)  / r.height - 0.5;
            spBaseX = (nx * 18).toFixed(1);
            spBaseY = (ny * 12).toFixed(1);
            speaker.style.transform = 'translate3d(' + spBaseX + 'px,' + spBaseY + 'px,0)';
        });
        hero.addEventListener('pointerleave', function () {
            speaker.style.transform = 'translate3d(0,0,0)';
        });
    }

    /* Speaker burst saat diklik */
    if (speaker) {
        speaker.addEventListener('click', function (e) {
            var svg = speaker.querySelector('svg');
            if (!svg) return;
            var svgNS = 'http://www.w3.org/2000/svg';

            /* Ambil 3 lingkaran burst dari titik mulut */
            for (var i = 0; i < 3; i++) {
                var c = document.createElementNS(svgNS, 'circle');
                c.setAttribute('cx', 200);
                c.setAttribute('cy', 176);
                c.setAttribute('r', 24);
                c.setAttribute('fill', 'none');
                c.setAttribute('stroke', '#FFD11A');
                c.setAttribute('stroke-width', '2');
                c.setAttribute('class', 'sp-burst');
                c.style.transformOrigin = '200px 176px';
                c.style.animationDelay = (i * 0.12) + 's';
                svg.appendChild(c);
                (function (node) {
                    setTimeout(function () { node.remove(); }, 1100);
                })(c);
            }
        });
    }

    function onScroll() {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(function () {
            var h = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.transform = 'scaleX(' + (h > 0 ? Math.min(window.scrollY / h, 1) : 0).toFixed(4) + ')';
            topBtn.classList.toggle('is-on', window.scrollY > 700);

            if (heroImg && !reduce && window.scrollY < window.innerHeight * 1.5) {
                heroImg.style.transform = 'translate3d(0,' + Math.min(window.scrollY * 0.12, 70).toFixed(1) + 'px,0)';
            }
            ticking = false;
        });
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* Word reveal */
    var heroTitle = document.getElementById('ab-title');
    if (heroTitle) {
        heroTitle.querySelectorAll('.word').forEach(function (w) {
            w.addEventListener('animationend', function () {
                w.classList.add('is-done');
            });
        });
    }

    /* Magnetic CTA */
    if (canHover && !reduce) {
        document.querySelectorAll('.ab-cta-btn').forEach(function (b) {
            b.addEventListener('pointermove', function (e) {
                var r = b.getBoundingClientRect();
                var x = ((e.clientX - r.left - r.width / 2) * 0.1).toFixed(1);
                var y = ((e.clientY - r.top - r.height / 2) * 0.15 - 2).toFixed(1);
                b.style.transform = 'translate(' + x + 'px,' + y + 'px)';
            });
            b.addEventListener('pointerleave', function () { b.style.transform = ''; });
        });
    }

    /* Ripple */
    document.querySelectorAll('.ab-cta-btn').forEach(function (b) {
        b.addEventListener('pointerdown', function (e) {
            var r = b.getBoundingClientRect();
            var d = mk('span', { 'class': 'ab-rip', 'aria-hidden': 'true' });
            d.style.left = (e.clientX - r.left) + 'px';
            d.style.top  = (e.clientY - r.top)  + 'px';
            b.appendChild(d);
            setTimeout(function () { d.remove(); }, 650);
        });
    });
})();
</script>

@endsection