@extends('layouts.app')

@section('title', 'Beranda - PT Bachri Samudera Indonesia')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&family=Cormorant+Garamond:ital,wght@1,500;1,600&display=swap" rel="stylesheet">

<style>
/* ============================================================
   BASE
   ============================================================ */
html{scroll-behavior:smooth}
::selection{background:#f1c40f;color:#12173F}

body{scrollbar-width:thin;scrollbar-color:#C9932C #0C1130}
body::-webkit-scrollbar{width:10px}
body::-webkit-scrollbar-track{background:#0C1130}
body::-webkit-scrollbar-thumb{background:linear-gradient(#f1c40f,#A67C10);border-radius:10px;border:2px solid #0C1130}

.hp{
    font-family:'Inter',ui-sans-serif,system-ui,sans-serif;
    color:#0B1226;
    -webkit-font-smoothing:antialiased;
    text-rendering:optimizeLegibility;
}
.hp-wrap{width:calc(100% - 40px);margin-inline:auto}
@media(min-width:1024px){.hp-wrap{width:min(76.8vw,1180px)}}

.hp-accent{
    font-family:'Cormorant Garamond',Georgia,serif;
    font-style:italic;
    font-weight:600;
    letter-spacing:0;
    font-size:1.05em;
    color:#C9932C;
}

/* ============================================================
   REVEAL
   ============================================================ */
.hp-js .hp-rv{
    opacity:0;
    transform:translateY(26px);
    transition:opacity .8s cubic-bezier(.2,.7,.2,1),transform .8s cubic-bezier(.2,.7,.2,1);
    transition-delay:var(--d,0s);
}
.hp-js .hp-rv.from-left{transform:translateX(-32px)}
.hp-js .hp-rv.from-right{transform:translateX(32px)}
.hp-js .hp-rv.is-in{opacity:1;transform:none}

/* ============================================================
   PROGRESS + TOP
   ============================================================ */
#hp-progress{
    position:fixed;top:0;left:0;height:3px;width:100%;z-index:120;
    transform-origin:0 50%;transform:scaleX(0);
    background:linear-gradient(90deg,#A67C10,#f1c40f,#F0C060);
    box-shadow:0 0 12px rgba(241,196,15,.6);
    pointer-events:none;
}
#hp-top{
    position:fixed;right:22px;bottom:26px;z-index:105;
    width:46px;height:46px;border-radius:9999px;
    display:flex;align-items:center;justify-content:center;
    background:#f1c40f;color:#12173F;border:0;cursor:pointer;
    box-shadow:0 14px 30px -10px rgba(0,0,0,.5);
    opacity:0;transform:translateY(16px) scale(.9);pointer-events:none;
    transition:opacity .3s,transform .3s,background-color .3s;
}
#hp-top.is-on{opacity:1;transform:none;pointer-events:auto}
#hp-top:hover{background:#fff;transform:translateY(-4px)}

/* ============================================================
   HERO
   ============================================================ */
#hp-hero{
    position:relative;
    width:100%;
    min-height:100vh;
    display:flex;
    align-items:center;
    overflow:hidden;
}
.hp-hero-photo{
    position:absolute;inset:0;z-index:1;
    background-size:cover;
    background-position:center top;
    background-repeat:no-repeat;
    image-rendering:-webkit-optimize-contrast;
    backface-visibility:hidden;
    transform:translateZ(0);
    will-change:transform;
    width:100%;height:100%;
}
@media(min-width:1920px){.hp-hero-photo{background-size:auto 100%}}

.hp-hero-shade{
    position:absolute;inset:0;z-index:2;
    background:
        radial-gradient(ellipse 90% 60% at 50% 55%,rgba(3,6,18,.6) 0%,rgba(3,6,18,.35) 45%,transparent 75%),
        linear-gradient(180deg,rgba(5,8,22,.7) 0%,rgba(5,8,22,.35) 40%,rgba(5,8,22,.8) 100%);
}

#hp-hero .hp-wrap{position:relative;z-index:3;width:100%}

#hp-hero h1{
    perspective:700px;
    font-family:'Outfit','Inter',sans-serif;
    font-size:clamp(48px,7.5vw,108px);
    line-height:1;
    letter-spacing:-.035em;
    font-weight:800;
    color:#FFFFFF;
    text-shadow:
        0 1px 0 rgba(0,0,0,.85),
        0 2px 4px rgba(0,0,0,.8),
        0 6px 18px rgba(0,0,0,.55),
        0 16px 48px rgba(0,0,0,.35);
    -webkit-text-stroke:0.4px rgba(0,0,0,.25);
}
#hp-hero .hp-hero-eyebrow{
    font-family:'Inter',sans-serif;
    font-weight:700;font-size:12px;line-height:1;letter-spacing:.4em;
    text-transform:uppercase;color:#FFD11A;
    text-shadow:0 1px 0 rgba(0,0,0,.85),0 2px 6px rgba(0,0,0,.75),0 4px 14px rgba(241,196,15,.35);
}
#hp-hero .hp-hero-sub{
    font-family:'Inter',sans-serif;color:#FFFFFF;font-weight:600;letter-spacing:-.008em;
    text-shadow:0 2px 10px rgba(0,0,0,1),0 1px 3px rgba(0,0,0,.9);
}
#hp-hero .hp-hero-desc{
    font-family:'Inter',sans-serif;color:#E2E8F0;font-weight:400;
    text-shadow:0 2px 10px rgba(0,0,0,1),0 1px 3px rgba(0,0,0,.9);
}
#hp-hero .hp-gold-word{
    color:#FFD11A;
    text-shadow:0 1px 0 rgba(0,0,0,.85),0 2px 4px rgba(0,0,0,.75),0 6px 18px rgba(0,0,0,.5),0 16px 48px rgba(0,0,0,.3);
    -webkit-text-stroke:0.4px rgba(0,0,0,.25);
}

.hp-w{
    display:inline-block;opacity:0;
    transform:translateY(46px) rotateX(-55deg);
    transform-origin:50% 100%;
    animation:hp-w .95s cubic-bezier(.2,.75,.2,1) forwards;
    animation-delay:calc(.25s + var(--i)*.11s);
}
@keyframes hp-w{to{opacity:1;transform:none}}

#hp-hero h1 .hp-w.is-done{
    animation:none;opacity:1;transform:none;
    cursor:default;position:relative;
    transition:transform .55s cubic-bezier(.19,1,.22,1),color .35s ease,text-shadow .55s ease;
}
#hp-hero h1 .hp-w.is-done::after{
    content:"";position:absolute;left:8%;right:8%;bottom:.06em;height:2px;border-radius:2px;
    background:linear-gradient(90deg,transparent,#f1c40f,transparent);
    transform:scaleX(0);transform-origin:50% 50%;
    transition:transform .55s cubic-bezier(.19,1,.22,1);
    pointer-events:none;
}
#hp-hero h1 .hp-w.is-done:hover{
    transform:translateY(-8px);
    color:#f1c40f;
    text-shadow:0 8px 44px rgba(241,196,15,.4),0 3px 10px rgba(0,0,0,.55),0 1px 2px rgba(0,0,0,.45);
}
#hp-hero h1 .hp-w.is-done:hover::after{transform:scaleX(1)}
#hp-hero h1 .hp-w.is-done.hp-gold-word:hover{
    color:#FFD11A;
    text-shadow:0 8px 44px rgba(255,209,26,.5),0 3px 10px rgba(0,0,0,.5);
}

.hp-cue{
    position:absolute;left:50%;bottom:26px;z-index:3;
    width:26px;height:42px;margin-left:-13px;
    border:2px solid rgba(255,255,255,.55);border-radius:14px;
    display:none;
}
@media(min-width:768px){.hp-cue{display:block}}
.hp-cue::after{
    content:"";position:absolute;left:50%;top:8px;
    width:4px;height:8px;margin-left:-2px;border-radius:4px;
    background:#f1c40f;
    animation:hp-cue 1.8s ease-in-out infinite;
}
@keyframes hp-cue{0%{opacity:0;transform:translateY(0)}30%{opacity:1}100%{opacity:0;transform:translateY(14px)}}

/* ============================================================
   BUTTONS
   ============================================================ */
.hp-btn-gold,.hp-btn-ghost{
    position:relative;overflow:hidden;
    display:inline-flex;align-items:center;justify-content:center;gap:10px;
    height:44px;min-width:178px;padding:0 26px;border-radius:9999px;
    font-size:14px;font-weight:700;text-decoration:none;will-change:transform;
    transition:transform .35s cubic-bezier(.2,.7,.2,1),box-shadow .35s,background-color .35s,color .35s,border-color .35s;
}
.hp-btn-gold{background:#f1c40f;color:#12173F;box-shadow:0 10px 24px -10px rgba(241,196,15,.7)}
.hp-btn-gold::before{
    content:"";position:absolute;top:0;left:-120%;
    width:60%;height:100%;
    background:linear-gradient(110deg,transparent,rgba(255,255,255,.5),transparent);
    transform:skewX(-20deg);
}
.hp-btn-gold:hover{transform:translateY(-3px);box-shadow:0 18px 32px -12px rgba(241,196,15,.85)}
.hp-btn-gold:hover::before{animation:hp-shine .9s ease}
.hp-btn-gold svg{transition:transform .3s cubic-bezier(.2,.7,.2,1)}
.hp-btn-gold:hover svg{transform:translateX(5px)}
.hp-btn-ghost{border:1px solid rgba(255,255,255,.8);color:#fff;font-weight:600}
.hp-btn-ghost:hover{transform:translateY(-3px);background:rgba(255,255,255,.1);border-color:#f1c40f;color:#f1c40f}
.hp-btn-gold:active,.hp-btn-ghost:active,.hp-cta:active{transform:translateY(0) scale(.97) !important}
@keyframes hp-shine{to{left:160%}}

/* ============================================================
   SPACE BG — Ken Burns super halus
   ============================================================ */
.hp-space-bg{
    position:absolute;inset:0;z-index:0;overflow:hidden;
    pointer-events:none;background-color:#0B1226;
}
.hp-space-bg::before{
    content:"";
    position:absolute;inset:-20%;
    background-image:var(--hp-header-url);
    background-size:cover;background-position:center;background-repeat:no-repeat;
    filter:blur(85px) saturate(0.55) brightness(0.35);
    opacity:.62;
    transform:translate3d(0,0,0) scale(1.06);
    animation:hp-space-kenburns 70s cubic-bezier(.4,0,.6,1) infinite alternate;
    will-change:transform;
    backface-visibility:hidden;
}
.hp-space-bg::after{
    content:"";position:absolute;inset:0;
    background:
        radial-gradient(ellipse 80% 60% at 50% 50%,transparent 25%,rgba(11,18,38,.75) 85%),
        linear-gradient(180deg,rgba(11,18,38,.55) 0%,rgba(11,18,38,.15) 35%,rgba(11,18,38,.65) 100%);
    pointer-events:none;
}
@keyframes hp-space-kenburns{
    0%   { transform:translate3d(0,0,0) scale(1.06); }
    100% { transform:translate3d(-1%,-1.2%,0) scale(1.14); }
}

/* ============================================================
   🏙️ SKYLINE — seamless loop, dua layer paralaks
   ============================================================ */
.hp-city{
    position:absolute;
    left:0;right:0;bottom:0;
    height:220px;
    z-index:0;
    pointer-events:none;
    overflow:hidden;
    opacity:.42;
    -webkit-mask-image:linear-gradient(180deg,transparent 0%,#000 40%,#000 100%);
    mask-image:linear-gradient(180deg,transparent 0%,#000 40%,#000 100%);
}

/* Container yg berisi 2 copy SVG identik untuk seamless loop */
.hp-city-track{
    position:absolute;
    bottom:0;left:0;
    display:flex;
    width:max-content;
    will-change:transform;
    backface-visibility:hidden;
    transform:translate3d(0,0,0);
}
.hp-city-track svg{
    display:block;
    flex:0 0 auto;
    width:2400px;
    height:220px;
}
.hp-city-track-back{
    animation:hp-city-scroll 180s linear infinite;
    opacity:.55;
}
.hp-city-track-front{
    animation:hp-city-scroll 130s linear infinite;
}

@keyframes hp-city-scroll{
    0%   { transform:translate3d(0,0,0); }
    100% { transform:translate3d(-2400px,0,0); }
}

/* Jendela berkedip — smooth, bukan snap */
.hp-city .win{
    animation:hp-win-flicker 8s cubic-bezier(.4,0,.6,1) infinite;
    will-change:opacity;
}
.hp-city .win:nth-child(3n){animation-duration:11s;animation-delay:-2s}
.hp-city .win:nth-child(5n){animation-duration:13s;animation-delay:-5s}
.hp-city .win:nth-child(7n){animation-duration:9s;animation-delay:-7s}
@keyframes hp-win-flicker{
    0%, 80%, 100% { opacity:1; }
    84%           { opacity:.25; }
    88%           { opacity:1; }
    92%           { opacity:.6; }
    96%           { opacity:1; }
}

/* Lampu antenna — pulse lembut */
.hp-city .antenna-light{
    animation:hp-antenna-pulse 3.6s ease-in-out infinite;
    will-change:opacity;
}
.hp-city .antenna-light:nth-of-type(2){animation-delay:-1.2s}
.hp-city .antenna-light:nth-of-type(3){animation-delay:-2.4s}
@keyframes hp-antenna-pulse{
    0%,100% { opacity:1;   }
    50%     { opacity:.15; }
}

/* ============================================================
   🏗️ CRANE — pendulum halus
   ============================================================ */
.hp-crane{
    position:absolute;
    bottom:0;
    z-index:0;
    pointer-events:none;
    opacity:.32;
    width:180px;height:200px;
}
.hp-crane.right{ right:5%; }
.hp-crane.left{ left:5%; }

.hp-crane .arm{
    transform-origin:50px 40px;
    transform:rotate(0deg);
    animation:hp-crane-swing 18s cubic-bezier(.45,0,.55,1) infinite;
    will-change:transform;
    backface-visibility:hidden;
}
@keyframes hp-crane-swing{
    0%, 100% { transform:rotate(-4deg); }
    50%      { transform:rotate(4deg);  }
}

/* Kabel hook naik-turun halus */
.hp-crane .hook{
    animation:hp-hook-bob 7s cubic-bezier(.45,0,.55,1) infinite;
    will-change:transform;
}
@keyframes hp-hook-bob{
    0%,100% { transform:translateY(0); }
    50%     { transform:translateY(8px); }
}

/* ============================================================
   STARS
   ============================================================ */
.hp-stars{
    position:absolute;inset:0;pointer-events:none;z-index:1;overflow:hidden;
}
.hp-stars::before,
.hp-stars::after{
    content:"";position:absolute;inset:-50%;
    background-repeat:repeat;
    will-change:opacity,transform;
    backface-visibility:hidden;
}
.hp-stars::before{
    background-image:
        radial-gradient(1.6px 1.6px at 40px 60px, #FFFFFF, transparent),
        radial-gradient(1.2px 1.2px at 120px 200px, rgba(255,255,255,.9), transparent),
        radial-gradient(2.2px 2.2px at 210px 90px, #FFFFFF, transparent),
        radial-gradient(1.4px 1.4px at 300px 260px, rgba(255,255,255,.85), transparent),
        radial-gradient(2px 2px at 90px 320px, #FFD11A, transparent),
        radial-gradient(1.6px 1.6px at 260px 160px, #FFFFFF, transparent),
        radial-gradient(1.2px 1.2px at 180px 380px, rgba(255,255,255,.8), transparent),
        radial-gradient(2.4px 2.4px at 340px 40px, #FFFFFF, transparent),
        radial-gradient(1.4px 1.4px at 60px 440px, rgba(255,255,255,.9), transparent),
        radial-gradient(1.8px 1.8px at 220px 480px, #FFD11A, transparent);
    background-size:360px 360px;
    animation:hp-twinkle 5.5s ease-in-out infinite, hp-drift-a 120s linear infinite;
}
.hp-stars::after{
    background-image:
        radial-gradient(1.2px 1.2px at 80px 110px, rgba(255,255,255,.9), transparent),
        radial-gradient(2.6px 2.6px at 200px 220px, #FFFFFF, transparent),
        radial-gradient(1.4px 1.4px at 340px 60px, rgba(255,255,255,.75), transparent),
        radial-gradient(2.2px 2.2px at 420px 320px, #FFD11A, transparent),
        radial-gradient(1.6px 1.6px at 60px 400px, #FFFFFF, transparent),
        radial-gradient(1.8px 1.8px at 280px 140px, rgba(255,255,255,.9), transparent),
        radial-gradient(1.2px 1.2px at 160px 480px, #FFFFFF, transparent),
        radial-gradient(2px 2px at 400px 420px, #FFFFFF, transparent);
    background-size:440px 440px;
    animation:hp-twinkle 8s ease-in-out infinite, hp-drift-b 180s linear infinite;
    animation-delay:-2s, 0s;
}
@keyframes hp-twinkle{
    0%, 100% { opacity: .35; }
    50%      { opacity: 1;   }
}
@keyframes hp-drift-a{
    0%   { transform: translate3d(0,0,0); }
    100% { transform: translate3d(-360px,-360px,0); }
}
@keyframes hp-drift-b{
    0%   { transform: translate3d(0,0,0); }
    100% { transform: translate3d(-440px,220px,0); }
}

.hp-nebula{
    position:absolute;inset:-10%;z-index:1;pointer-events:none;
    background:
        radial-gradient(ellipse 40% 30% at 15% 30%, rgba(49,63,126,.26), transparent 70%),
        radial-gradient(ellipse 30% 25% at 85% 70%, rgba(237,194,115,.09), transparent 70%),
        radial-gradient(ellipse 45% 35% at 70% 15%, rgba(80,50,140,.14), transparent 70%);
    filter: blur(22px);
    animation: hp-nebula-shift 60s cubic-bezier(.4,0,.6,1) infinite alternate;
    will-change:transform;
}
@keyframes hp-nebula-shift{
    0%   { transform: translate3d(0,0,0) scale(1); }
    100% { transform: translate3d(2%,-1.5%,0) scale(1.05); }
}

.hp-grid-bg{
    position:absolute;inset:0;z-index:1;pointer-events:none;
    background-image:
        linear-gradient(rgba(237,194,115,.055) 1px, transparent 1px),
        linear-gradient(90deg, rgba(237,194,115,.055) 1px, transparent 1px);
    background-size:72px 72px;
    -webkit-mask-image:radial-gradient(ellipse 80% 70% at 50% 50%, #000 15%, transparent 78%);
    mask-image:radial-gradient(ellipse 80% 70% at 50% 50%, #000 15%, transparent 78%);
    animation:hp-grid-drift 90s linear infinite;
    will-change:background-position;
}
@keyframes hp-grid-drift{
    0%   { background-position:0 0, 0 0; }
    100% { background-position:72px 72px, 72px 72px; }
}

.hp-dust{
    position:absolute;inset:0;z-index:1;pointer-events:none;overflow:hidden;
}
.hp-dust span{
    position:absolute;bottom:-10px;
    width:3px;height:3px;border-radius:50%;
    background:#EDC273;
    box-shadow:0 0 6px rgba(237,194,115,.75),0 0 12px rgba(237,194,115,.35);
    opacity:0;
    animation-name:hp-dust-rise;
    animation-timing-function:cubic-bezier(.45,0,.55,1);
    animation-iteration-count:infinite;
    will-change:transform,opacity;
}
.hp-dust span:nth-child(3n){
    width:2px;height:2px;background:#FFF;
    box-shadow:0 0 4px rgba(255,255,255,.7);
}
.hp-dust span:nth-child(5n){
    width:4px;height:4px;background:#F1C40F;
    box-shadow:0 0 8px rgba(241,196,15,.85);
}
@keyframes hp-dust-rise{
    0%   { transform:translate3d(0,0,0) scale(.6);          opacity:0; }
    15%  { opacity:.7; }
    85%  { opacity:.7; }
    100% { transform:translate3d(20px,-110vh,0) scale(.85); opacity:0; }
}

.hp-shoot{
    position:absolute;
    width:180px;height:2px;border-radius:2px;
    background:linear-gradient(90deg,transparent 0%,rgba(255,255,255,.12) 25%,rgba(255,255,255,.75) 70%,#FFFFFF 100%);
    filter:drop-shadow(0 0 6px rgba(255,255,255,.8)) drop-shadow(0 0 14px rgba(237,194,115,.5));
    opacity:0;z-index:2;pointer-events:none;
    will-change:transform,opacity;
    backface-visibility:hidden;
}
.hp-shoot::after{
    content:"";position:absolute;right:-3px;top:50%;
    width:6px;height:6px;margin-top:-3px;border-radius:50%;
    background:#FFFFFF;
    box-shadow:0 0 10px rgba(255,255,255,.9),0 0 22px rgba(237,194,115,.7);
}
.hp-shoot-1{top:12%; left:-220px;              animation:hp-shoot-fly 14s cubic-bezier(.4,0,.6,1) infinite 2s;}
.hp-shoot-2{top:40%; left:-220px; width:130px;  animation:hp-shoot-fly 18s cubic-bezier(.4,0,.6,1) infinite 10s;}
.hp-shoot-3{top:70%; left:-220px; width:210px;  animation:hp-shoot-fly 21s cubic-bezier(.4,0,.6,1) infinite 17s;}
.hp-shoot-4{top:25%; left:-220px; width:150px;  animation:hp-shoot-fly 16s cubic-bezier(.4,0,.6,1) infinite 26s;}
@keyframes hp-shoot-fly{
    0%   { transform:translate3d(0,0,0) rotate(-18deg);                        opacity:0; }
    4%   { opacity:1; }
    20%  { opacity:0; }
    100% { transform:translate3d(calc(100vw + 420px),-180px,0) rotate(-18deg); opacity:0; }
}

/* ============================================================
   DARK SECTIONS
   ============================================================ */
.hp-about-section,
.hp-gal,
.hp-clients-section,
#contact{
    background-color:#0B1226;
    position:relative;
    overflow:hidden;
}
.hp-about-section .hp-wrap,
.hp-gal .hp-wrap,
.hp-clients-section .hp-wrap,
#contact .hp-wrap{
    position:relative;z-index:3;
}

/* ============================================================
   TENTANG KAMI
   ============================================================ */
.hp-about-section{padding:100px 0 75px;color:#FFFFFF}
@media(min-width:1024px){.hp-about-section{padding:120px 0 85px}}
.hp-about-section .hp-wrap{max-width:1200px;margin:0 auto;padding:0 20px}
.hp-about-grid{display:grid;grid-template-columns:1fr 1.2fr;gap:50px;align-items:center}
@media(max-width:968px){.hp-about-grid{grid-template-columns:1fr;gap:40px}}

.hp-about-image-card{
    position:relative;
    background:rgba(13,19,56,.6);
    border-radius:20px;padding:30px;
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 20px 40px rgba(0,0,0,.4);
    overflow:hidden;
    transition:transform .5s cubic-bezier(.19,1,.22,1);
}
.hp-about-image-card::before{
    content:'';position:absolute;inset:-2px;
    background:conic-gradient(from 0deg at 50% 50%,rgba(241,196,15,0) 60%,rgba(241,196,15,.9) 80%,#FFFFFF 100%);
    border-radius:22px;z-index:0;
    animation:rotateGoldBorder 6s linear infinite;
}
.hp-about-image-card::after{
    content:'';position:absolute;inset:1px;
    background:rgba(13,19,56,.95);
    border-radius:19px;z-index:1;
}
@keyframes rotateGoldBorder{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
.hp-about-image-card:hover{transform:translateY(-8px)}

.hp-about-logo-container{
    position:relative;z-index:2;
    width:100%;min-height:300px;
    background:rgba(8,13,44,.9);
    border:1px solid rgba(241,196,15,.2);
    border-radius:14px;
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;padding:30px;
}
.hp-about-img{
    max-width:100%;max-height:100%;
    object-fit:contain;
    filter:drop-shadow(0 4px 16px rgba(0,0,0,.4));
    transition:transform .5s cubic-bezier(.19,1,.22,1);
}
.hp-about-image-card:hover .hp-about-img{transform:scale(1.05)}
.hp-about-content{padding-top:10px}
.hp-about-head{position:relative;margin-bottom:20px}

.hp-section-eyebrow{
    font-family:'Inter',sans-serif;
    font-weight:600;font-size:12px;letter-spacing:.3em;text-transform:uppercase;
    color:#F1C40F;margin-bottom:12px;
}
.hp-section-title{
    font-family:'Outfit','Inter',sans-serif;
    font-size:clamp(32px,4vw,44px);
    font-weight:700;line-height:1.2;
    color:#FFFFFF;margin-bottom:0;letter-spacing:-.02em;
}
.hp-about-desc{
    font-family:'Inter',sans-serif;
    color:#CBD5E1;font-size:16px;line-height:1.7;margin-bottom:30px;
}

.hp-about-features{display:flex;flex-direction:column;gap:20px}
.hp-feature-item{
    display:flex;gap:16px;align-items:flex-start;
    padding:12px 16px;border-radius:12px;
    transition:background .3s ease,transform .35s cubic-bezier(.19,1,.22,1);
}
.hp-feature-item:hover{background:rgba(255,255,255,.03);transform:translateX(6px)}
.hp-feature-icon{
    background:rgba(241,196,15,.15);
    color:#F1C40F;
    width:28px;height:28px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-weight:bold;flex-shrink:0;margin-top:2px;
    border:1px solid rgba(241,196,15,.4);
    transition:all .3s ease;
}
.hp-feature-item:hover .hp-feature-icon{
    background:#F1C40F;color:#080d2c;
    box-shadow:0 0 12px rgba(241,196,15,.5);
}
.hp-feature-item h4{font-family:'Outfit',sans-serif;font-size:17px;font-weight:600;color:#FFFFFF;margin-bottom:4px}
.hp-feature-item p{font-family:'Inter',sans-serif;font-size:14px;color:#94A3B8;line-height:1.5;margin:0}

/* ============================================================
   GALERI
   ============================================================ */
.hp-gal{color:#fff;padding:45px 0 100px}
@media(min-width:1024px){.hp-gal{padding:55px 0 120px}}

.hp-gal-top{max-width:640px;margin:0 auto 48px;text-align:center;position:relative}
.hp-gal-head{position:relative;display:block}
.hp-gal-eyebrow{
    display:inline-flex;align-items:center;gap:12px;
    font-family:'Inter',sans-serif;
    font-size:11px;font-weight:700;letter-spacing:.32em;text-transform:uppercase;
    color:#EDC273;margin-bottom:20px;
}
.hp-gal-eyebrow::before,.hp-gal-eyebrow::after{
    content:"";width:28px;height:1px;background:rgba(237,194,115,.5);
}
.hp-gal-title{
    font-family:'Outfit','Inter',sans-serif;
    font-size:clamp(32px,3.8vw,50px);
    font-weight:700;line-height:1.1;letter-spacing:-.028em;
    color:#fff;margin:0 0 16px;
}
.hp-gal-title em{
    font-family:'Cormorant Garamond',serif;font-style:italic;font-weight:600;
    color:#C9932C;letter-spacing:0;
}
.hp-gal-sub{
    font-family:'Inter',sans-serif;
    font-size:15px;line-height:1.7;
    color:rgba(255,255,255,.55);margin:0;
}

.hp-gal-grid{display:grid;grid-template-columns:repeat(12,1fr);gap:20px}
@media(max-width:768px){.hp-gal-grid{gap:14px}}
.hp-gal-item:nth-child(1),.hp-gal-item:nth-child(2){grid-column:span 6;aspect-ratio:4/3}
.hp-gal-item:nth-child(3),.hp-gal-item:nth-child(4),.hp-gal-item:nth-child(5){grid-column:span 4;aspect-ratio:1/1}
@media(max-width:768px){
    .hp-gal-item:nth-child(1),.hp-gal-item:nth-child(2),
    .hp-gal-item:nth-child(3),.hp-gal-item:nth-child(4),
    .hp-gal-item:nth-child(5){grid-column:span 12;aspect-ratio:4/3}
}

.hp-gal-item{
    position:relative;display:block;padding:0;border:0;
    overflow:hidden;border-radius:14px;
    background:#0E1530;cursor:zoom-in;isolation:isolate;
    box-shadow:0 24px 50px -30px rgba(0,0,0,.9);
}
.hp-gal-item img{
    position:absolute;inset:0;width:100%;height:100%;
    object-fit:cover;display:block;
    transform:scale(1.01);
    transition:transform 1.4s cubic-bezier(.19,1,.22,1);
    will-change:transform;
    -webkit-user-drag:none;user-select:none;
}
.hp-gal-item:hover img{transform:scale(1.06)}
.hp-gal-item::before{
    content:"";position:absolute;inset:0;z-index:1;
    background:linear-gradient(to top,rgba(6,10,30,.78) 0%,rgba(6,10,30,.28) 35%,transparent 65%);
    opacity:.6;transition:opacity .5s cubic-bezier(.4,0,.6,1);pointer-events:none;
}
.hp-gal-item:hover::before{opacity:1}
.hp-gal-item::after{
    content:"";position:absolute;inset:0;z-index:2;
    border-radius:inherit;
    box-shadow:inset 0 0 0 1px rgba(237,194,115,0);
    transition:box-shadow .5s cubic-bezier(.4,0,.6,1);pointer-events:none;
}
.hp-gal-item:hover::after{box-shadow:inset 0 0 0 1px rgba(237,194,115,.5)}

.hp-gal-meta{
    position:absolute;left:24px;right:24px;bottom:22px;
    z-index:3;color:#fff;
    display:flex;flex-direction:column;gap:6px;
    pointer-events:none;
    transition:transform .5s cubic-bezier(.19,1,.22,1);
}
.hp-gal-item:hover .hp-gal-meta{transform:translateY(-3px)}
@media(max-width:640px){.hp-gal-meta{left:18px;right:18px;bottom:16px}}

.hp-gal-num{
    font-family:'Outfit',sans-serif;
    font-size:11px;font-weight:600;letter-spacing:.2em;color:#EDC273;
}
.hp-gal-label{
    font-family:'Outfit','Inter',sans-serif;
    font-size:clamp(14px,1.3vw,17px);
    font-weight:600;line-height:1.3;letter-spacing:-.005em;
    text-shadow:0 2px 12px rgba(0,0,0,.6);
}
.hp-gal-icon{
    position:absolute;top:18px;right:18px;z-index:3;
    width:38px;height:38px;border-radius:9999px;
    display:flex;align-items:center;justify-content:center;
    background:rgba(255,255,255,.1);
    border:1px solid rgba(255,255,255,.2);
    -webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);
    color:#fff;opacity:0;transform:translateY(-6px);
    transition:opacity .4s cubic-bezier(.19,1,.22,1),transform .4s cubic-bezier(.19,1,.22,1),background-color .3s,color .3s,border-color .3s;
    pointer-events:none;
}
.hp-gal-item:hover .hp-gal-icon{
    opacity:1;transform:none;
    background:#EDC273;color:#12173F;border-color:#EDC273;
}
@media(max-width:640px){.hp-gal-icon{width:34px;height:34px;top:14px;right:14px}}

/* ============================================================
   LIGHTBOX
   ============================================================ */
#hp-lightbox{
    position:fixed;inset:0;z-index:100;
    display:none;align-items:center;justify-content:center;
    padding:24px;
    background:rgba(4,7,22,.96);
    -webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);
}
#hp-lightbox.is-open{display:flex;animation:hp-lb .4s cubic-bezier(.2,.7,.2,1)}
#hp-lightbox figure{max-width:min(1200px,100%);margin:0;text-align:center}
#hp-lightbox img{
    max-width:100%;max-height:78vh;
    border-radius:12px;box-shadow:0 50px 120px rgba(0,0,0,.85);
}
#hp-lightbox figcaption{
    margin-top:20px;color:#fff;
    font-family:'Outfit','Inter',sans-serif;
    font-size:16px;font-weight:500;letter-spacing:-.005em;opacity:.9;
}
.hp-lb-btn{
    position:absolute;width:48px;height:48px;border-radius:9999px;
    display:flex;align-items:center;justify-content:center;
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.12);
    color:#fff;
    -webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);
    cursor:pointer;
    transition:background-color .3s,color .3s,transform .3s,border-color .3s;
}
.hp-lb-btn:hover{background:#EDC273;color:#12173F;border-color:#EDC273;transform:scale(1.06)}
@keyframes hp-lb{from{opacity:0}to{opacity:1}}

/* ============================================================
   KLIEN
   ============================================================ */
.hp-clients-section{color:#fff;padding:70px 0}
@media(min-width:1024px){.hp-clients-section{padding:90px 0}}
.hp-clients-section::before{
    content:"";position:absolute;top:0;left:10%;right:10%;height:1px;
    background:linear-gradient(90deg,transparent,rgba(241,196,15,.35),transparent);
    z-index:4;
}

.hp-marquee{
    position:relative;overflow-x:auto;overflow-y:hidden;
    padding:18px 0 26px;cursor:grab;
    scrollbar-width:none;-ms-overflow-style:none;
    scroll-behavior:auto;user-select:none;-webkit-user-select:none;
    -webkit-mask-image:linear-gradient(to right,transparent,#000 6%,#000 94%,transparent);
    mask-image:linear-gradient(to right,transparent,#000 6%,#000 94%,transparent);
}
.hp-marquee::-webkit-scrollbar{display:none}
.hp-marquee.is-dragging{cursor:grabbing}
.hp-marquee.is-dragging .hp-client{pointer-events:none}
.hp-marquee-track{display:flex;align-items:center;width:max-content}

.hp-client{
    position:relative;flex:none;
    width:170px;height:82px;margin-right:16px;
    display:flex;align-items:center;justify-content:center;
    padding:0 20px;
    background:rgba(255,255,255,.96);
    border:1px solid rgba(255,255,255,.9);
    border-radius:14px;
    cursor:inherit;overflow:hidden;
    transition:transform .4s cubic-bezier(.19,1,.22,1),border-color .4s,box-shadow .4s,background-color .4s;
}
.hp-client:hover{
    transform:translateY(-4px);
    border-color:#EDC273;
    background:#fff;
    box-shadow:0 18px 34px -22px rgba(0,0,0,.75),0 0 22px -4px rgba(241,196,15,.35);
}
.hp-client-logo,
.hp-client-logo.logo-hp,
.hp-client-logo.logo-indihome{
    width:auto;height:auto;max-height:44px;max-width:132px;
    object-fit:contain;display:block;pointer-events:none;
    filter:none;opacity:1;
    transition:transform .4s cubic-bezier(.19,1,.22,1);
}
.hp-client:hover .hp-client-logo{transform:scale(1.05)}
.hp-client span{font-family:'Outfit',sans-serif;line-height:1.1;text-align:center;white-space:nowrap}
.hp-brand-telkom{font-weight:700;font-size:1.15rem;color:#dc2626;letter-spacing:-.01em;transition:color .3s}
.hp-client:hover .hp-brand-telkom{color:#b91c1c}
@media(max-width:768px){
    .hp-client{width:142px;height:72px;padding:0 14px;margin-right:12px}
    .hp-client-logo,.hp-client-logo.logo-hp,.hp-client-logo.logo-indihome{max-height:36px;max-width:110px}
}

/* ============================================================
   KONTAK
   ============================================================ */
#contact{color:#fff;padding:70px 0 80px}
@media(min-width:1024px){#contact{padding:90px 0 100px}}

.hp-card{
    position:relative;overflow:hidden;display:block;
    padding:20px;border-radius:20px;
    background:linear-gradient(145deg,rgba(255,255,255,.08),rgba(255,255,255,.02));
    border:1px solid rgba(255,255,255,.08);
    -webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);
    transition:transform .4s cubic-bezier(.19,1,.22,1),background-color .4s,border-color .4s,box-shadow .4s;
}
.hp-card:hover{
    transform:translateY(-5px);
    background:rgba(237,194,115,.07);
    border-color:rgba(237,194,115,.4);
    box-shadow:0 22px 40px -24px rgba(0,0,0,.8);
}
.hp-card::after{
    content:"";position:absolute;inset:0;pointer-events:none;opacity:0;
    transition:opacity .4s;
    background:radial-gradient(260px circle at var(--cx,50%) var(--cy,50%),rgba(237,194,115,.16),transparent 65%);
}
.hp-card:hover::after{opacity:1}
.hp-card:not(.hp-card-logo)::before{
    content:"";position:absolute;left:0;top:0;width:100%;height:2px;z-index:1;
    background:linear-gradient(90deg,transparent,#f1c40f,transparent);
    transform:scaleX(0);transition:transform .55s cubic-bezier(.19,1,.22,1);
}
.hp-card:not(.hp-card-logo):hover::before{transform:scaleX(1)}
.hp-card-logo{display:flex;align-items:center;justify-content:center;padding:18px}
.hp-card-logo:hover{transform:none;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.08);box-shadow:none}
.hp-card-logo::after{display:none}
.hp-card-logo img{display:block;width:100%;max-width:260px;max-height:150px;height:auto;object-fit:contain}
.hp-card-head{display:flex;align-items:center;gap:14px;margin-bottom:14px}
.hp-card-icon{
    flex:none;width:46px;height:46px;
    display:flex;align-items:center;justify-content:center;
    border-radius:12px;
    background:rgba(237,194,115,.14);color:#EDC273;
    transition:background-color .4s,color .4s,transform .4s,box-shadow .4s;
}
.hp-card:hover .hp-card-icon{
    background:#EDC273;color:#12173F;transform:translateY(-2px);
    box-shadow:0 0 24px rgba(237,194,115,.55);
}
.hp-card-label{margin:0;font-size:12px;line-height:16px;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.55)}
.hp-row{display:flex;align-items:center;gap:8px}
.hp-row+.hp-row{margin-top:2px}
.hp-val{
    font-size:15.5px;line-height:24px;font-weight:500;color:#fff;
    text-decoration:none;overflow-wrap:anywhere;
    background-image:linear-gradient(#EDC273,#EDC273);
    background-size:0 1.5px;background-position:0 100%;background-repeat:no-repeat;
    transition:background-size .35s ease,color .3s;
}
.hp-val:hover{color:#EDC273;background-size:100% 1.5px}
.hp-copy{
    flex:none;width:30px;height:30px;
    display:inline-flex;align-items:center;justify-content:center;
    border-radius:8px;color:rgba(255,255,255,.55);
    opacity:0;position:relative;z-index:2;
    transition:opacity .3s,background-color .3s,color .3s;
}
.hp-card:hover .hp-copy,.hp-copy:focus-visible{opacity:1}
.hp-copy:hover{background:rgba(255,255,255,.12);color:#fff}
@media(hover:none){.hp-copy{opacity:1}}
@media(max-width:420px){.hp-val{font-size:14px}.hp-card{padding:18px}}
#contact iframe{filter:grayscale(1) contrast(1.05) brightness(.9);transition:filter .8s cubic-bezier(.4,0,.6,1)}
#contact .relative:hover>iframe{filter:none}

#hp-toast{
    position:fixed;left:50%;bottom:28px;z-index:110;
    transform:translate(-50%,16px);opacity:0;pointer-events:none;
    border-radius:9999px;background:#fff;color:#12173F;
    padding:10px 18px;font-size:13.5px;font-weight:600;
    box-shadow:0 16px 40px rgba(0,0,0,.3);
    transition:opacity .3s,transform .3s;
}
#hp-toast.is-on{opacity:1;transform:translate(-50%,0)}

.hp :focus-visible{outline:2px solid #EDC273;outline-offset:3px}
.hp-light :focus-visible{outline-color:#313F7E}

/* ============================================================
   FOOTER
   ============================================================ */
.site-footer{
    position:relative;z-index:2;
    background:#080C1F;color:#94a3b8;
    padding:0 0 2rem;
    overflow:hidden;isolation:isolate;
}
.site-footer::before{
    content:"";
    position:absolute;inset:0;
    background-image:var(--hp-header-url);
    background-size:cover;background-position:center 40%;
    filter:blur(75px) saturate(0.4) brightness(0.22);
    opacity:.55;z-index:-1;
    transform:translate3d(0,0,0) scale(1.08);
    animation:hp-footer-drift 80s cubic-bezier(.4,0,.6,1) infinite alternate;
    will-change:transform;
}
@keyframes hp-footer-drift{
    0%   { transform:translate3d(0,0,0) scale(1.08); }
    100% { transform:translate3d(-1.5%,1%,0) scale(1.14); }
}
.site-footer::after{
    content:"";
    position:absolute;inset:0;
    background:
        linear-gradient(180deg,rgba(6,10,26,.65) 0%,rgba(6,10,26,.85) 40%,rgba(4,7,16,.95) 100%),
        radial-gradient(ellipse 60% 40% at 50% 0%,rgba(241,196,15,.05),transparent 70%);
    z-index:-1;pointer-events:none;
}

.hp-footer-city{
    position:absolute;
    left:0;right:0;bottom:0;
    height:130px;
    z-index:-1;
    opacity:.32;
    pointer-events:none;
    overflow:hidden;
    -webkit-mask-image:linear-gradient(180deg,transparent 0%,#000 55%,#000 100%);
    mask-image:linear-gradient(180deg,transparent 0%,#000 55%,#000 100%);
}
.hp-footer-city .hp-city-track svg{height:220px}
.hp-footer-city .hp-city-track{bottom:0}

.hp-footer-bar{
    position:relative;height:1px;width:100%;
    background:linear-gradient(90deg,transparent 5%,rgba(241,196,15,.5) 50%,transparent 95%);
}
.hp-footer-bar::after{
    content:"";position:absolute;top:-8px;left:50%;
    width:56px;height:16px;margin-left:-28px;
    background:radial-gradient(ellipse at center,rgba(241,196,15,.35),transparent 70%);
    pointer-events:none;
}

.footer-grid{
    position:relative;
    display:grid;grid-template-columns:2fr 1fr 1.2fr;
    gap:3rem;max-width:1100px;
    margin:0 auto 3rem;padding:3.5rem 1rem 0;
}
.footer-col h4{
    position:relative;padding-bottom:.75rem;
    font-family:'Outfit',sans-serif;color:#fff;
    font-size:1.08rem;font-weight:700;
    margin-bottom:1.35rem;letter-spacing:.02em;
}
.footer-col h4::after{
    content:"";position:absolute;left:0;bottom:0;
    width:32px;height:2px;
    background:linear-gradient(90deg,#f1c40f,rgba(241,196,15,.2));
    border-radius:2px;
}
.footer-col p{font-size:.9rem;line-height:1.7;color:#94a3b8;margin-bottom:1rem;max-width:44ch}
.footer-contact-item{
    display:flex;align-items:flex-start;gap:10px;
    margin-bottom:.85rem;font-size:.9rem;color:#94a3b8;line-height:1.6;
}
.footer-contact-item svg{
    width:16px;height:16px;color:#f1c40f;flex-shrink:0;margin-top:3px;
    filter:drop-shadow(0 0 4px rgba(241,196,15,.35));
}
.footer-col a.footer-contact-link{color:#94a3b8;text-decoration:none;transition:color .3s ease}
.footer-col a.footer-contact-link:hover{color:#f1c40f;text-decoration:underline}
.footer-links{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.75rem}
.footer-links a{
    position:relative;display:inline-block;
    color:#94a3b8;text-decoration:none;font-size:.9rem;padding-left:0;
    transition:color .3s,transform .3s cubic-bezier(.19,1,.22,1),padding-left .3s;
}
.footer-links a::before{
    content:"";position:absolute;left:0;top:50%;
    width:0;height:1px;background:#f1c40f;
    transition:width .3s cubic-bezier(.19,1,.22,1);transform:translateY(-50%);
}
.footer-links a:hover{color:#f1c40f;padding-left:14px}
.footer-links a:hover::before{width:8px}
.footer-bottom{
    position:relative;max-width:1100px;margin:0 auto;
    padding:1.5rem 1rem 0;
    border-top:1px solid rgba(255,255,255,.06);
    display:flex;justify-content:space-between;align-items:center;
    font-size:.85rem;color:#64748b;
}
.footer-bottom p:first-child{letter-spacing:.02em}
.footer-bottom p:last-child{
    color:#94a3b8;display:inline-flex;align-items:center;gap:8px;
}
.footer-bottom p:last-child::before{
    content:"";width:6px;height:6px;border-radius:50%;
    background:#f1c40f;box-shadow:0 0 8px rgba(241,196,15,.7);
}
@media(max-width:991.98px){
    .footer-grid{grid-template-columns:1fr;gap:2rem;padding-top:2.5rem}
    .footer-bottom{flex-direction:column;text-align:center;gap:.5rem}
}

/* ============================================================
   REDUCED MOTION
   ============================================================ */
@media(prefers-reduced-motion:reduce){
    .hp-js .hp-rv{opacity:1 !important;transform:none !important}
    .hp *,.hp *::before,.hp *::after{transition:none !important;animation:none !important}
    .hp-w{opacity:1;transform:none}
    .hp-marquee{-webkit-mask-image:none;mask-image:none}
    .hp-client[aria-hidden="true"]{display:none}
    html{scroll-behavior:auto}
    .hp-stars::before,.hp-stars::after{animation:none;opacity:.6}
    .hp-shoot,.hp-dust{display:none}
    .hp-grid-bg,.hp-nebula,.hp-space-bg::before,.site-footer::before{animation:none}
    .hp-city-track,.hp-city .win,.hp-city .antenna-light,.hp-crane .arm,.hp-crane .hook{animation:none}
}

/* ============================================================
   MISC
   ============================================================ */
.hp h1,.hp h2,.hp h3{font-family:'Outfit','Inter',sans-serif}

.hp-rip{
    position:absolute;width:120px;height:120px;
    margin:-60px 0 0 -60px;border-radius:50%;
    background:rgba(255,255,255,.4);
    transform:scale(0);
    animation:hp-rip .6s ease-out forwards;
    pointer-events:none;
}
@keyframes hp-rip{to{transform:scale(2.4);opacity:0}}

#hp-side{
    position:fixed;right:22px;top:50%;transform:translateY(-50%);
    z-index:104;display:none;flex-direction:column;gap:16px;
}
@media(min-width:1280px){#hp-side{display:flex}}
#hp-side a{
    position:relative;width:11px;height:11px;border-radius:50%;
    background:rgba(160,170,200,.6);
    border:1px solid rgba(255,255,255,.7);
    box-shadow:0 2px 8px rgba(0,0,0,.25);
    transition:transform .3s,background-color .3s;
}
#hp-side a.is-on{background:#f1c40f;transform:scale(1.5)}
#hp-side a span{
    position:absolute;right:24px;top:50%;
    transform:translate(8px,-50%);opacity:0;pointer-events:none;
    white-space:nowrap;padding:5px 11px;border-radius:8px;
    background:#12173F;color:#fff;font-size:12px;font-weight:600;
    transition:opacity .3s,transform .3s;
}
#hp-side a:hover span,#hp-side a:focus-visible span{opacity:1;transform:translate(0,-50%)}
</style>

<style>:root{--hp-header-url:url('{{ asset("images/header.png") }}');}</style>

{{-- ============================================================
     SVG TEMPLATE GLOBAL — Skyline & Crane (didefinisikan sekali)
     ============================================================ --}}
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
    <defs>
        <!-- Pattern jendela gedung — jauh lebih efisien dari ratusan rect -->
        <pattern id="hp-win-gold" x="0" y="0" width="18" height="18" patternUnits="userSpaceOnUse">
            <rect x="5" y="5" width="5" height="5" fill="#F1C40F" opacity=".85"/>
        </pattern>
        <pattern id="hp-win-slate" x="0" y="0" width="18" height="18" patternUnits="userSpaceOnUse">
            <rect x="5" y="5" width="5" height="5" fill="#94A3B8" opacity=".6"/>
        </pattern>
        <pattern id="hp-win-mixed" x="0" y="0" width="24" height="24" patternUnits="userSpaceOnUse">
            <rect x="4" y="4" width="5" height="5" fill="#F1C40F" opacity=".9"/>
            <rect x="15" y="15" width="4" height="4" fill="#94A3B8" opacity=".55"/>
        </pattern>

        <!-- SKYLINE BELAKANG — silhouette sederhana -->
        <g id="hp-skyline-back">
            <path fill="#1E2A55" d="
                M0 220 L0 150 L40 150 L40 130 L80 130 L80 150 L120 150 L120 110 L160 110 L160 150 L200 150 L200 90 L240 90 L240 150 L290 150 L290 120 L340 120 L340 150 L380 150 L380 100 L420 100 L420 150 L470 150 L470 130 L510 130 L510 150 L560 150 L560 80 L600 80 L600 150 L640 150 L640 120 L690 120 L690 150 L730 150 L730 90 L780 90 L780 150 L820 150 L820 110 L870 110 L870 150 L910 150 L910 130 L960 130 L960 150 L1000 150 L1000 100 L1040 100 L1040 150 L1090 150 L1090 130 L1140 130 L1140 150 L1180 150 L1180 80 L1230 80 L1230 150 L1280 150 L1280 110 L1330 110 L1330 150 L1380 150 L1380 130 L1420 130 L1420 150 L1460 150 L1460 90 L1500 90 L1500 150 L1540 150 L1540 120 L1580 120 L1580 150 L1630 150 L1630 100 L1680 100 L1680 150 L1720 150 L1720 130 L1760 130 L1760 150 L1810 150 L1810 90 L1860 90 L1860 150 L1900 150 L1900 110 L1950 110 L1950 150 L1990 150 L1990 130 L2040 130 L2040 150 L2080 150 L2080 100 L2130 100 L2130 150 L2170 150 L2170 120 L2220 120 L2220 150 L2260 150 L2260 90 L2300 90 L2300 150 L2350 150 L2350 130 L2400 130 L2400 150 L2400 220 Z
            "/>
        </g>

        <!-- SKYLINE DEPAN — detail dengan pattern jendela -->
        <g id="hp-skyline-front">
            <!-- Gedung 1 -->
            <rect x="0" y="120" width="60" height="100" fill="#243268"/>
            <rect x="0" y="120" width="60" height="100" fill="url(#hp-win-slate)"/>

            <!-- Gedung 2 (tinggi) -->
            <rect x="80" y="60" width="70" height="160" fill="#2A386E"/>
            <rect x="80" y="60" width="70" height="160" fill="url(#hp-win-gold)"/>

            <!-- Gedung 3 -->
            <rect x="170" y="100" width="50" height="120" fill="#243268"/>
            <rect x="170" y="100" width="50" height="120" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 4 (menara dengan antenna) -->
            <rect x="240" y="40" width="80" height="180" fill="#2A386E"/>
            <polygon points="240,40 280,10 320,40" fill="#2A386E"/>
            <line x1="280" y1="10" x2="280" y2="0" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="280" cy="4" r="3" fill="#F1C40F"/>
            <rect x="240" y="40" width="80" height="180" fill="url(#hp-win-gold)"/>

            <!-- Gedung 5 -->
            <rect x="340" y="90" width="70" height="130" fill="#243268"/>
            <rect x="340" y="90" width="70" height="130" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 6 -->
            <rect x="430" y="130" width="60" height="90" fill="#2A386E"/>
            <rect x="430" y="130" width="60" height="90" fill="url(#hp-win-slate)"/>

            <!-- Gedung 7 (menara 2) -->
            <rect x="510" y="50" width="90" height="170" fill="#2A386E"/>
            <polygon points="510,50 555,20 600,50" fill="#2A386E"/>
            <line x1="555" y1="20" x2="555" y2="10" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="555" cy="14" r="3" fill="#F1C40F"/>
            <rect x="510" y="50" width="90" height="170" fill="url(#hp-win-gold)"/>

            <!-- Gedung 8 -->
            <rect x="620" y="110" width="70" height="110" fill="#243268"/>
            <rect x="620" y="110" width="70" height="110" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 9 (menara 3) -->
            <rect x="710" y="70" width="80" height="150" fill="#2A386E"/>
            <rect x="740" y="40" width="20" height="30" fill="#243268"/>
            <line x1="750" y1="40" x2="750" y2="25" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="750" cy="28" r="3" fill="#F1C40F"/>
            <rect x="710" y="70" width="80" height="150" fill="url(#hp-win-gold)"/>

            <!-- Gedung 10 -->
            <rect x="800" y="100" width="60" height="120" fill="#243268"/>
            <rect x="800" y="100" width="60" height="120" fill="url(#hp-win-slate)"/>

            <!-- Gedung 11 (menara 4) -->
            <rect x="870" y="30" width="100" height="190" fill="#2A386E"/>
            <polygon points="870,30 920,0 970,30" fill="#2A386E"/>
            <line x1="920" y1="0" x2="920" y2="-10" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="920" cy="-6" r="3" fill="#F1C40F"/>
            <rect x="870" y="30" width="100" height="190" fill="url(#hp-win-gold)"/>

            <!-- Gedung 12 -->
            <rect x="990" y="130" width="60" height="90" fill="#243268"/>
            <rect x="990" y="130" width="60" height="90" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 13 (menara 5) -->
            <rect x="1070" y="60" width="80" height="160" fill="#2A386E"/>
            <rect x="1100" y="30" width="20" height="30" fill="#243268"/>
            <line x1="1110" y1="30" x2="1110" y2="15" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="1110" cy="18" r="3" fill="#F1C40F"/>
            <rect x="1070" y="60" width="80" height="160" fill="url(#hp-win-gold)"/>

            <!-- Gedung 14 -->
            <rect x="1170" y="110" width="60" height="110" fill="#243268"/>
            <rect x="1170" y="110" width="60" height="110" fill="url(#hp-win-slate)"/>

            <!-- Gedung 15 (menara 6) -->
            <rect x="1250" y="40" width="90" height="180" fill="#2A386E"/>
            <polygon points="1250,40 1295,10 1340,40" fill="#2A386E"/>
            <line x1="1295" y1="10" x2="1295" y2="0" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="1295" cy="4" r="3" fill="#F1C40F"/>
            <rect x="1250" y="40" width="90" height="180" fill="url(#hp-win-gold)"/>

            <!-- Gedung 16 -->
            <rect x="1360" y="120" width="70" height="100" fill="#243268"/>
            <rect x="1360" y="120" width="70" height="100" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 17 (menara 7) -->
            <rect x="1450" y="70" width="80" height="150" fill="#2A386E"/>
            <polygon points="1450,70 1490,45 1530,70" fill="#2A386E"/>
            <line x1="1490" y1="45" x2="1490" y2="35" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="1490" cy="38" r="3" fill="#F1C40F"/>
            <rect x="1450" y="70" width="80" height="150" fill="url(#hp-win-gold)"/>

            <!-- Gedung 18 -->
            <rect x="1550" y="100" width="60" height="120" fill="#243268"/>
            <rect x="1550" y="100" width="60" height="120" fill="url(#hp-win-slate)"/>

            <!-- Gedung 19 -->
            <rect x="1630" y="90" width="70" height="130" fill="#2A386E"/>
            <rect x="1630" y="90" width="70" height="130" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 20 -->
            <rect x="1720" y="130" width="60" height="90" fill="#243268"/>
            <rect x="1720" y="130" width="60" height="90" fill="url(#hp-win-slate)"/>

            <!-- Gedung 21 (menara 8) -->
            <rect x="1800" y="50" width="90" height="170" fill="#2A386E"/>
            <polygon points="1800,50 1845,20 1890,50" fill="#2A386E"/>
            <line x1="1845" y1="20" x2="1845" y2="10" stroke="#F1C40F" stroke-width="2"/>
            <circle class="antenna-light" cx="1845" cy="14" r="3" fill="#F1C40F"/>
            <rect x="1800" y="50" width="90" height="170" fill="url(#hp-win-gold)"/>

            <!-- Gedung 22 -->
            <rect x="1910" y="110" width="60" height="110" fill="#243268"/>
            <rect x="1910" y="110" width="60" height="110" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 23 -->
            <rect x="1990" y="90" width="80" height="130" fill="#2A386E"/>
            <rect x="1990" y="90" width="80" height="130" fill="url(#hp-win-gold)"/>

            <!-- Gedung 24 -->
            <rect x="2090" y="120" width="70" height="100" fill="#243268"/>
            <rect x="2090" y="120" width="70" height="100" fill="url(#hp-win-slate)"/>

            <!-- Gedung 25 -->
            <rect x="2180" y="70" width="80" height="150" fill="#2A386E"/>
            <rect x="2180" y="70" width="80" height="150" fill="url(#hp-win-gold)"/>

            <!-- Gedung 26 -->
            <rect x="2280" y="110" width="60" height="110" fill="#243268"/>
            <rect x="2280" y="110" width="60" height="110" fill="url(#hp-win-mixed)"/>

            <!-- Gedung 27 -->
            <rect x="2360" y="130" width="40" height="90" fill="#243268"/>
            <rect x="2360" y="130" width="40" height="90" fill="url(#hp-win-slate)"/>
        </g>

        <!-- CRANE (tower crane) -->
        <g id="hp-crane">
            <!-- Base -->
            <rect x="30" y="160" width="40" height="40" fill="#243268"/>
            <rect x="40" y="160" width="20" height="40" fill="#2A386E"/>
            <!-- Tower vertical -->
            <line x1="50" y1="160" x2="50" y2="40" stroke="#F1C40F" stroke-width="2" opacity="0.7"/>
            <line x1="45" y1="160" x2="45" y2="40" stroke="#F1C40F" stroke-width="1" opacity="0.5"/>
            <line x1="55" y1="160" x2="55" y2="40" stroke="#F1C40F" stroke-width="1" opacity="0.5"/>
            <!-- X-braces -->
            <g stroke="#F1C40F" stroke-width="0.8" opacity="0.55" fill="none">
                <path d="M45 140 L55 120 M55 140 L45 120"/>
                <path d="M45 120 L55 100 M55 120 L45 100"/>
                <path d="M45 100 L55 80 M55 100 L45 80"/>
                <path d="M45 80 L55 60 M55 80 L45 60"/>
                <path d="M45 60 L55 40 M55 60 L45 40"/>
            </g>
            <!-- Arm horizontal (bergoyang) -->
            <g class="arm">
                <line x1="50" y1="40" x2="150" y2="40" stroke="#F1C40F" stroke-width="2.5"/>
                <line x1="50" y1="40" x2="10" y2="40" stroke="#F1C40F" stroke-width="1.5" opacity="0.6"/>
                <!-- Hook cable + kait -->
                <g class="hook">
                    <line x1="130" y1="40" x2="130" y2="90" stroke="#94A3B8" stroke-width="1"/>
                    <rect x="126" y="90" width="8" height="8" fill="#94A3B8"/>
                </g>
                <!-- Counterweight -->
                <rect x="15" y="36" width="20" height="8" fill="#243268" stroke="#F1C40F" stroke-width="0.5"/>
                <!-- Cabin -->
                <rect x="44" y="34" width="14" height="10" fill="#243268" stroke="#F1C40F" stroke-width="0.8"/>
            </g>
        </g>
    </defs>
</svg>

<div class="hp" id="hp">
<script>document.getElementById('hp').classList.add('hp-js');</script>

{{-- ============================================================
     HERO
     ============================================================ --}}
<section id="hp-hero" class="relative overflow-hidden text-white w-full min-h-[100svh] flex items-center" style="margin-top:-110px;">
    <div id="hp-hero-photo" class="hp-hero-photo" style="background-image: url('{{ asset('images/header.png') }}');"></div>
    <div class="hp-hero-shade"></div>

    <div class="hp-wrap relative w-full pt-[170px] pb-[120px] lg:pt-[200px] lg:pb-[160px]">
        <div class="max-w-[920px] mx-auto text-center">
            <p class="hp-rv hp-hero-eyebrow flex items-center justify-center gap-5" style="--d:.05s">
                <span class="h-px w-10 sm:w-14 bg-[#FFD11A]/50" aria-hidden="true"></span>
                <span>PT Bachri Samudera Indonesia</span>
                <span class="h-px w-10 sm:w-14 bg-[#FFD11A]/50" aria-hidden="true"></span>
            </p>

            <h1 class="hp-rv mt-7" style="--d:.15s">
                CREATE. BUILD.<br>
                <span class="hp-gold-word">GROW.</span>
            </h1>

            <p class="hp-rv hp-hero-sub mt-7 text-[20px] sm:text-[24px] leading-[1.4]" style="--d:.32s">
                Solusi Kreatif untuk Membangun Brand, Ruang, dan Pengalaman
            </p>

            <p class="hp-rv hp-hero-desc mt-5 mx-auto max-w-[600px] text-[15px] sm:text-[16px] leading-[1.7]" style="--d:.45s">
                Perusahaan multibisnis yang menghadirkan solusi kreatif melalui konstruksi, exterior &amp; interior, event management, desain, dan periklanan.
            </p>

            <div class="hp-rv mt-10 flex flex-wrap justify-center gap-3" style="--d:.58s">
                <a href="{{ url('/about') }}" class="hp-btn-gold">
                    Lihat Profile
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a href="{{ route('contact') }}" class="hp-btn-ghost">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     TENTANG KAMI
     ============================================================ --}}
<section id="hp-about" class="hp-about-section">
    <div class="hp-space-bg" aria-hidden="true"></div>
    <div class="hp-nebula" aria-hidden="true"></div>
    <div class="hp-stars" aria-hidden="true"></div>
    <div class="hp-grid-bg" aria-hidden="true"></div>

    {{-- Skyline seamless --}}
    <div class="hp-city" aria-hidden="true">
        <div class="hp-city-track hp-city-track-back">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-back"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-back"/></svg>
        </div>
        <div class="hp-city-track hp-city-track-front">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
        </div>
    </div>
    <svg class="hp-crane left" viewBox="0 0 180 200" xmlns="http://www.w3.org/2000/svg">
        <use href="#hp-crane"/>
    </svg>

    <div class="hp-dust" aria-hidden="true">
        @for($i = 0; $i < 18; $i++)
            <span style="left:{{ rand(2, 98) }}%; animation-delay:{{ rand(0, 180) / 10 }}s; animation-duration:{{ rand(140, 240) / 10 }}s;"></span>
        @endfor
    </div>

    <div class="hp-wrap">
        <div class="hp-about-grid">
            <div class="hp-about-image-card">
                <div class="hp-about-logo-container">
                    <img src="{{ asset('images/logo2.png') }}" alt="Logo PT Bachri" class="hp-about-img">
                </div>
            </div>

            <div class="hp-about-content">
                <div class="hp-about-head">
                    <div class="hp-section-eyebrow">Tentang Kami</div>
                    <h2 class="hp-section-title">
                        Membangun Masa Depan dengan <span class="hp-gold-word">Inovasi &amp; Kualitas</span>
                    </h2>
                </div>

                <p class="hp-about-desc">
                    Kami adalah perusahaan multibisnis yang berdedikasi untuk memberikan solusi terbaik di berbagai sektor industri. Dengan komitmen tinggi terhadap profesionalisme dan ketepatan waktu, kami terus bertransformasi menghadirkan layanan yang terpercaya bagi setiap klien.
                </p>

                <div class="hp-about-features">
                    <div class="hp-feature-item">
                        <div class="hp-feature-icon">✓</div>
                        <div>
                            <h4>Standar Kualitas Tinggi</h4>
                            <p>Mengutamakan ketelitian dan hasil kerja terbaik di setiap proyek.</p>
                        </div>
                    </div>
                    <div class="hp-feature-item">
                        <div class="hp-feature-icon">✓</div>
                        <div>
                            <h4>Tim Profesional &amp; Berpengalaman</h4>
                            <p>Didukung oleh tenaga ahli yang kompeten di bidangnya masing-masing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     GALERI
     ============================================================ --}}
@php
    $gallery = [
        ['file' => 'fttvs.png',      'alt' => 'Ruang Instalasi Interaktif',  'pos' => 'object-center'],
        ['file' => 'ftinterior.png', 'alt' => 'Desain Interior Resepsionis', 'pos' => 'object-center'],
        ['file' => 'fttelkom.png',   'alt' => 'Kiosk Digital Telkomsel',     'pos' => 'object-center'],
        ['file' => 'ftindihome.png', 'alt' => 'Area Lounge IndiHome',        'pos' => 'object-center'],
        ['file' => 'fthp.png',       'alt' => 'Booth Pameran HP & Intel',    'pos' => 'object-center'],
    ];
    $total = count($gallery);
@endphp

<section id="galeri" class="hp-gal">
    <div class="hp-space-bg" aria-hidden="true"></div>
    <div class="hp-nebula" aria-hidden="true"></div>
    <div class="hp-stars" aria-hidden="true"></div>
    <div class="hp-grid-bg" aria-hidden="true"></div>

    <div class="hp-city" aria-hidden="true">
        <div class="hp-city-track hp-city-track-back">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-back"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-back"/></svg>
        </div>
        <div class="hp-city-track hp-city-track-front">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
        </div>
    </div>
    <svg class="hp-crane right" viewBox="0 0 180 200" xmlns="http://www.w3.org/2000/svg">
        <use href="#hp-crane"/>
    </svg>

    <div class="hp-shoot hp-shoot-1" aria-hidden="true"></div>
    <div class="hp-shoot hp-shoot-2" aria-hidden="true"></div>
    <div class="hp-shoot hp-shoot-3" aria-hidden="true"></div>
    <div class="hp-shoot hp-shoot-4" aria-hidden="true"></div>

    <div class="hp-wrap relative">
        <div class="hp-gal-top hp-rv">
            <div class="hp-gal-head">
                <span class="hp-gal-eyebrow">Portofolio</span>
                <h2 class="hp-gal-title">
                    Galeri <em>Karya</em> Kami
                </h2>
            </div>

            <p class="hp-gal-sub">
                Setiap proyek adalah cerita. Inilah sebagian kecil dari karya yang kami banggakan.
            </p>
        </div>

        <div class="hp-gal-grid">
            @foreach ($gallery as $i => $item)
                <button type="button"
                        class="hp-gal-item hp-rv"
                        style="--d:{{ 0.05 + ($i * 0.07) }}s"
                        data-hp-lightbox
                        data-src="{{ asset('images/' . $item['file']) }}"
                        data-alt="{{ $item['alt'] }}"
                        data-index="{{ $i }}"
                        aria-label="Perbesar foto: {{ $item['alt'] }}">

                    <img src="{{ asset('images/' . $item['file']) }}"
                         alt="{{ $item['alt'] }}"
                         loading="lazy"
                         draggable="false"
                         class="{{ $item['pos'] }}">

                    <span class="hp-gal-meta">
                        <span class="hp-gal-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($total, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="hp-gal-label">{{ $item['alt'] }}</span>
                    </span>

                    <span class="hp-gal-icon" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h6v6M10 14 21 3M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                        </svg>
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     KLIEN KAMI
     ============================================================ --}}
@php
    $clients = [
        ['img' => null,               'text' => 'Telkom Indonesia', 'cls' => 'hp-brand-telkom'],
        ['img' => 'myindihome.png',   'text' => 'my IndiHome',      'logoCls' => 'logo-indihome'],
        ['img' => 'wifiid.png',       'text' => 'wifi.id'],
        ['img' => 'waskita.png',      'text' => 'Waskita Modern Realti'],
        ['img' => 'tvs.png',          'text' => 'TVS'],
        ['img' => 'jayaproperty.png', 'text' => 'JAYA PROPERTY'],
        ['img' => 'hp.png',           'text' => 'HP',               'logoCls' => 'logo-hp'],
        ['img' => 'pegadaian.png',    'text' => 'Pegadaian'],
    ];
@endphp

<section class="hp-clients-section" aria-label="Klien kami">
    <div class="hp-space-bg" aria-hidden="true"></div>
    <div class="hp-nebula" aria-hidden="true"></div>
    <div class="hp-stars" aria-hidden="true"></div>

    <div class="relative max-w-[720px] mx-auto px-4 sm:px-6 text-center mb-[36px] lg:mb-[44px]" style="position:relative;z-index:3">
        <div class="hp-rv">
            <div class="mb-3 flex items-center justify-center gap-3">
                <span class="h-[1px] w-8 bg-gradient-to-r from-transparent to-[#F1C40F]"></span>
                <span class="whitespace-nowrap text-[11px] font-bold uppercase tracking-[0.28em] text-[#F1C40F]">
                    Klien &amp; Mitra Kami
                </span>
                <span class="h-[1px] w-8 bg-gradient-to-l from-transparent to-[#F1C40F]"></span>
            </div>

            <h2 class="text-[clamp(24px,3vw,36px)] leading-[1.2] font-bold tracking-tight text-white">
                Brand-Brand <span class="text-[#F1C40F]">Terbaik</span> Indonesia
            </h2>

            <p class="mt-3 text-[12.5px] text-slate-400">
                ← Geser untuk melihat lebih banyak →
            </p>
        </div>
    </div>

    <div class="relative w-full overflow-hidden" style="position:relative;z-index:3">
        <div class="hp-marquee hp-rv" id="hp-marquee" style="--d:.1s">
            <div class="hp-marquee-track" id="hp-marquee-track">
                @foreach ([0, 1] as $set)
                    @foreach ($clients as $client)
                        <div class="hp-client" @if ($set === 1) aria-hidden="true" @endif>
                            @if (!empty($client['img']))
                                <img src="{{ asset('images/' . $client['img']) }}"
                                     alt="{{ $client['text'] }}"
                                     class="hp-client-logo {{ $client['logoCls'] ?? '' }}"
                                     loading="lazy"
                                     draggable="false">
                            @else
                                <span class="{{ $client['cls'] ?? '' }}">{!! $client['text'] !!}</span>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     KONTAK
     ============================================================ --}}
@php
    $phones   = ['0817 1414 1802', '0821 2451 2741'];
    $email    = 'bachrisamuderaindonesia@gmail.com';
    $address  = 'RensJaya Office, Jl. Kenari XIV, 12, Panulisan Barat, Pamulang, Tangerang Selatan';
    $mapsUrl  = 'https://www.google.com/maps?q=-6.3488,106.7385';
    $copyIcon = '<rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>';
@endphp

<section id="contact">
    <div class="hp-space-bg" aria-hidden="true"></div>
    <div class="hp-nebula" aria-hidden="true"></div>
    <div class="hp-stars" aria-hidden="true"></div>

    <div class="hp-city" aria-hidden="true">
        <div class="hp-city-track hp-city-track-back">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-back"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-back"/></svg>
        </div>
        <div class="hp-city-track hp-city-track-front">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
        </div>
    </div>
    <svg class="hp-crane left" viewBox="0 0 180 200" xmlns="http://www.w3.org/2000/svg">
        <use href="#hp-crane"/>
    </svg>

    <div class="hp-shoot hp-shoot-2" aria-hidden="true"></div>
    <div class="hp-shoot hp-shoot-3" aria-hidden="true"></div>

    <div class="hp-wrap relative">
        <div class="grid gap-[18px] sm:grid-cols-2 xl:grid-cols-[minmax(0,.95fr)_minmax(0,.9fr)_minmax(0,1.45fr)_minmax(0,1.05fr)]">

            <div class="hp-card hp-card-logo hp-rv sm:col-span-2 xl:col-span-1" style="--d:0s">
                <img src="{{ asset('images/logo2.png') }}" alt="PT Bachri Samudera Indonesia">
            </div>

            <div class="hp-card hp-rv" style="--d:.1s">
                <div class="hp-card-head">
                    <span class="hp-card-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    <p class="hp-card-label">Telepon</p>
                </div>
                <div class="min-w-0">
                    @foreach ($phones as $phone)
                        <div class="hp-row">
                            <a href="tel:+62{{ ltrim(preg_replace('/\D/', '', $phone), '0') }}" class="hp-val">{{ $phone }}</a>
                            <button type="button" class="hp-copy" data-hp-copy="{{ $phone }}" aria-label="Salin {{ $phone }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $copyIcon !!}</svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="hp-card hp-rv" style="--d:.2s">
                <div class="hp-card-head">
                    <span class="hp-card-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </span>
                    <p class="hp-card-label">Email</p>
                </div>
                <div class="min-w-0">
                    <div class="hp-row">
                        <a href="mailto:{{ $email }}" class="hp-val">{!! str_replace('@', '<wbr>@', e($email)) !!}</a>
                        <button type="button" class="hp-copy" data-hp-copy="{{ $email }}" aria-label="Salin email">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $copyIcon !!}</svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="hp-card hp-rv sm:col-span-2 xl:col-span-1" style="--d:.3s">
                <div class="hp-card-head">
                    <span class="hp-card-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <p class="hp-card-label">Alamat</p>
                </div>
                <div class="min-w-0">
                    <div class="hp-row items-start">
                        <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="hp-val">{{ $address }}</a>
                        <button type="button" class="hp-copy mt-[2px]" data-hp-copy="{{ $address }}" aria-label="Salin alamat">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $copyIcon !!}</svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="hp-rv mt-[44px]" style="--d:.1s">
            <div class="flex items-center gap-4 mb-[20px]">
                <span class="h-px flex-1 bg-gradient-to-r from-transparent via-[#EDC273]/50 to-[#EDC273]"></span>
                <h3 class="text-[13px] leading-[16px] font-semibold uppercase tracking-[0.25em] text-[#EDC273]">Lokasi Kami</h3>
                <span class="h-px flex-1 bg-gradient-to-l from-transparent via-[#EDC273]/50 to-[#EDC273]"></span>
            </div>

            <div class="relative h-[320px] sm:h-[400px] rounded-[24px] overflow-hidden border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] bg-[#0B1226] group">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8999!2d106.7385!3d-6.3488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPamulang%2C+Tangerang+Selatan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        class="block w-full h-full border-0 filter contrast-[1.1] saturate-[0.8] group-hover:saturate-100"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi PT Bachri Samudera Indonesia"></iframe>

                <div class="absolute bottom-4 left-4 z-10">
                    <a href="{{ $mapsUrl }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2.5 h-[42px] px-[18px] rounded-xl bg-[#0F172A]/90 backdrop-blur-md text-white text-[13px] font-medium border border-white/15 shadow-xl transition-all duration-500 hover:bg-[#EDC273] hover:text-[#0B1226] hover:border-[#EDC273] hover:-translate-y-0.5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h6v6M10 14 21 3M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     FOOTER
     ============================================================ --}}
<footer class="site-footer">
    <div class="hp-footer-city" aria-hidden="true">
        <div class="hp-city-track hp-city-track-front">
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
            <svg viewBox="0 0 2400 220" preserveAspectRatio="none"><use href="#hp-skyline-front"/></svg>
        </div>
    </div>

    <div class="hp-footer-bar" aria-hidden="true"></div>

    <div class="footer-grid">
        <div class="footer-col">
            <h4>PT Bachri Samudera Indonesia</h4>
            <p>Perusahaan profesional yang bergerak di bidang layanan dan solusi terpercaya, berkomitmen memberikan pelayanan terbaik bagi setiap klien dengan standar kualitas tinggi.</p>
        </div>
        <div class="footer-col">
            <h4>Menu Utama</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
                <li><a href="{{ url('/services') }}">Layanan</a></li>
                <li><a href="{{ url('/contact') }}">Hubungi Kami</a></li>
                <li><a href="{{ route('careers.index') }}">Karir</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <div class="footer-contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>
                    <a href="https://maps.google.com/?q=ReniJaya+Office+Jl+Kenari+XV+Pamulang+Barat+Tangerang+Selatan" target="_blank" class="footer-contact-link">
                        ReniJaya Office, Jl. Kenari XV No. 12, Pamulang Barat, Pamulang - Tangerang Selatan
                    </a>
                </span>
            </div>
            <div class="footer-contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Email: <a href="mailto:bachrisamuderaindonesia@gmail.com" class="footer-contact-link">bachrisamuderaindonesia@gmail.com</a></span>
            </div>
            <div class="footer-contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Telepon: <a href="tel:085714141802" class="footer-contact-link">0857 1414 1802</a></span>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} PT Bachri Samudera Indonesia. All rights reserved.</p>
        <p>Professional &amp; Reliable Service</p>
    </div>
</footer>

{{-- ============================================================
     LIGHTBOX GALERI
     ============================================================ --}}
<div id="hp-lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto galeri">
    <button type="button" id="hp-lb-close" class="hp-lb-btn" style="top:20px;right:20px" aria-label="Tutup">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
    <button type="button" id="hp-lb-prev" class="hp-lb-btn" style="left:20px;top:50%;margin-top:-23px" aria-label="Foto sebelumnya">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
    </button>
    <button type="button" id="hp-lb-next" class="hp-lb-btn" style="right:20px;top:50%;margin-top:-23px" aria-label="Foto berikutnya">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
    </button>
    <figure>
        <img id="hp-lb-img" src="" alt="">
        <figcaption id="hp-lb-cap"></figcaption>
    </figure>
</div>

<div id="hp-toast" role="status" aria-live="polite">Tersalin ke papan klip</div>

</div>{{-- /.hp --}}

<script>
(function () {
    'use strict';

    var reduce   = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var canHover = window.matchMedia('(hover: hover)').matches;

    function mk(tag, attrs, html) {
        var el = document.createElement(tag);
        for (var k in attrs) el.setAttribute(k, attrs[k]);
        if (html) el.innerHTML = html;
        return el;
    }

    var rv = document.querySelectorAll('#hp .hp-rv');
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
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        rv.forEach(function (el) { io.observe(el); });
    }

    var bar    = mk('div', { id: 'hp-progress', 'aria-hidden': 'true' });
    var topBtn = mk('button', {
        id: 'hp-top', type: 'button', 'aria-label': 'Kembali ke atas'
    }, '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m18 15-6-6-6 6"/></svg>');
    document.body.appendChild(bar);
    document.body.appendChild(topBtn);

    topBtn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });

    var photo   = document.getElementById('hp-hero-photo');
    var ticking = false;

    function onScroll() {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(function () {
            var h = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.transform = 'scaleX(' + (h > 0 ? Math.min(window.scrollY / h, 1) : 0).toFixed(4) + ')';
            topBtn.classList.toggle('is-on', window.scrollY > 700);
            if (photo && !reduce) {
                photo.style.transform = 'translate3d(0,' + Math.min(window.scrollY * 0.1, 36).toFixed(1) + 'px,0)';
            }
            ticking = false;
        });
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    var h1 = document.querySelector('#hp-hero h1');
    if (h1 && !reduce) {
        var idx = 0;
        Array.prototype.slice.call(h1.childNodes).forEach(function (node) {
            if (node.nodeType === 3) {
                var frag = document.createDocumentFragment();
                node.textContent.split(/(\s+)/).forEach(function (part) {
                    if (!part.trim()) { frag.appendChild(document.createTextNode(part)); return; }
                    var s = document.createElement('span');
                    s.className = 'hp-w';
                    s.style.setProperty('--i', idx++);
                    s.textContent = part;
                    frag.appendChild(s);
                });
                node.parentNode.replaceChild(frag, node);
            } else if (node.nodeType === 1 && node.tagName === 'SPAN') {
                var cls = node.className || '';
                node.className = ('hp-w ' + cls).trim();
                node.style.setProperty('--i', idx++);
            }
        });
    }

    var hero = document.getElementById('hp-hero');
    if (hero && !reduce) {
        hero.appendChild(mk('span', { 'class': 'hp-cue', 'aria-hidden': 'true' }));
    }

    if (canHover && !reduce) {
        document.querySelectorAll('.hp-btn-gold, .hp-btn-ghost, .hp-cta').forEach(function (b) {
            b.addEventListener('pointermove', function (e) {
                var r = b.getBoundingClientRect();
                var x = ((e.clientX - r.left - r.width / 2) * 0.12).toFixed(1);
                var y = ((e.clientY - r.top - r.height / 2) * 0.18 - 3).toFixed(1);
                b.style.transform = 'translate(' + x + 'px,' + y + 'px)';
            });
            b.addEventListener('pointerleave', function () { b.style.transform = ''; });
        });
    }

    if (canHover) {
        document.querySelectorAll('.hp-card').forEach(function (c) {
            c.addEventListener('pointermove', function (e) {
                var r = c.getBoundingClientRect();
                c.style.setProperty('--cx', (e.clientX - r.left) + 'px');
                c.style.setProperty('--cy', (e.clientY - r.top) + 'px');
            });
        });
    }

    var marquee = document.getElementById('hp-marquee');
    var track   = document.getElementById('hp-marquee-track');

    if (marquee && track) {
        var autoSpeed = reduce ? 0 : 0.6;
        var isDown = false, startX = 0, startScrollLeft = 0;
        var autoScrollEnabled = !reduce, resumeTimer = null;

        function loopScroll() {
            var setW = track.scrollWidth / 2;
            if (setW <= 0) return;
            if (marquee.scrollLeft >= setW) marquee.scrollLeft -= setW;
            if (marquee.scrollLeft < 0)       marquee.scrollLeft += setW;
        }

        function autoScrollLoop() {
            if (autoScrollEnabled && !isDown && autoSpeed > 0) {
                marquee.scrollLeft += autoSpeed;
                loopScroll();
            }
            requestAnimationFrame(autoScrollLoop);
        }
        if (!reduce) requestAnimationFrame(autoScrollLoop);

        function pauseAndResume() {
            autoScrollEnabled = false;
            clearTimeout(resumeTimer);
            resumeTimer = setTimeout(function () { autoScrollEnabled = !reduce; }, 1500);
        }

        marquee.addEventListener('mousedown', function (e) {
            isDown = true;
            marquee.classList.add('is-dragging');
            startX = e.pageX - marquee.offsetLeft;
            startScrollLeft = marquee.scrollLeft;
            e.preventDefault();
        });
        document.addEventListener('mousemove', function (e) {
            if (!isDown) return;
            e.preventDefault();
            marquee.scrollLeft = startScrollLeft - ((e.pageX - marquee.offsetLeft) - startX) * 1.5;
            loopScroll();
        });
        document.addEventListener('mouseup', function () {
            if (!isDown) return;
            isDown = false;
            marquee.classList.remove('is-dragging');
        });
        marquee.addEventListener('touchstart', function (e) {
            isDown = true;
            startX = e.touches[0].pageX - marquee.offsetLeft;
            startScrollLeft = marquee.scrollLeft;
        }, { passive: true });
        marquee.addEventListener('touchmove', function (e) {
            if (!isDown) return;
            marquee.scrollLeft = startScrollLeft - ((e.touches[0].pageX - marquee.offsetLeft) - startX) * 1.5;
            loopScroll();
        }, { passive: true });
        marquee.addEventListener('touchend', function () { isDown = false; });
        marquee.addEventListener('mousedown', pauseAndResume);
        marquee.addEventListener('touchstart', pauseAndResume, { passive: true });
    }

    var items = Array.prototype.slice.call(document.querySelectorAll('[data-hp-lightbox]'));
    var n     = items.length;

    var box       = document.getElementById('hp-lightbox');
    var imgEl     = document.getElementById('hp-lb-img');
    var capEl     = document.getElementById('hp-lb-cap');
    var closeBtn  = document.getElementById('hp-lb-close');
    var current   = 0;
    var lastFocus = null;
    var startXLB  = null;

    function render(i) {
        current = (i + n) % n;
        var el = items[current];
        imgEl.src = el.getAttribute('data-src');
        imgEl.alt = el.getAttribute('data-alt');
        capEl.textContent = el.getAttribute('data-alt');
    }
    function openBox(i) {
        lastFocus = document.activeElement;
        render(i);
        box.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        closeBtn.focus();
    }
    function closeBox() {
        box.classList.remove('is-open');
        document.body.style.overflow = '';
        if (lastFocus) lastFocus.focus();
    }

    items.forEach(function (el, i) {
        el.addEventListener('click', function () { openBox(i); });
    });

    closeBtn.addEventListener('click', closeBox);
    document.getElementById('hp-lb-prev').addEventListener('click', function () { render(current - 1); });
    document.getElementById('hp-lb-next').addEventListener('click', function () { render(current + 1); });

    box.addEventListener('click', function (e) { if (e.target === box) closeBox(); });

    document.addEventListener('keydown', function (e) {
        if (!box.classList.contains('is-open')) return;
        if (e.key === 'Escape')     closeBox();
        if (e.key === 'ArrowLeft')  render(current - 1);
        if (e.key === 'ArrowRight') render(current + 1);
    });

    box.addEventListener('touchstart', function (e) { startXLB = e.changedTouches[0].clientX; }, { passive: true });
    box.addEventListener('touchend', function (e) {
        if (startXLB === null) return;
        var dx = e.changedTouches[0].clientX - startXLB;
        if (Math.abs(dx) > 50) render(current + (dx < 0 ? 1 : -1));
        startXLB = null;
    });

    var toast = document.getElementById('hp-toast'), timer;

    function showToast(msg) {
        toast.textContent = msg;
        toast.classList.add('is-on');
        clearTimeout(timer);
        timer = setTimeout(function () { toast.classList.remove('is-on'); }, 1800);
    }
    function fallbackCopy(text) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.position = 'fixed';
        ta.style.opacity  = '0';
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); } catch (e) {}
        document.body.removeChild(ta);
    }

    document.querySelectorAll('[data-hp-copy]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var text = btn.getAttribute('data-hp-copy');
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(
                    function () { showToast('Tersalin ke papan klip'); },
                    function () { fallbackCopy(text); showToast('Tersalin ke papan klip'); }
                );
            } else {
                fallbackCopy(text);
                showToast('Tersalin ke papan klip');
            }
        });
    });

    var kl = document.querySelector('[aria-label="Klien kami"]');
    if (kl) kl.id = 'klien';

    var secs = [
        ['hp-hero',  'Beranda'],
        ['hp-about', 'Tentang Kami'],
        ['galeri',   'Galeri'],
        ['klien',    'Klien'],
        ['contact',  'Kontak']
    ];
    var side = mk('nav', { id: 'hp-side', 'aria-label': 'Navigasi bagian' });
    secs.forEach(function (x) {
        side.appendChild(mk('a', { href: '#' + x[0], 'aria-label': x[1] }, '<span>' + x[1] + '</span>'));
    });
    document.body.appendChild(side);

    if ('IntersectionObserver' in window) {
        var so = new IntersectionObserver(function (es) {
            es.forEach(function (e) {
                if (e.isIntersecting) {
                    side.querySelectorAll('a').forEach(function (a) {
                        a.classList.toggle('is-on', a.getAttribute('href') === '#' + e.target.id);
                    });
                }
            });
        }, { rootMargin: '-45% 0px -45% 0px' });
        secs.forEach(function (x) {
            var el = document.getElementById(x[0]);
            if (el) so.observe(el);
        });
    }

    document.querySelectorAll('.hp-btn-gold, .hp-btn-ghost, .hp-cta').forEach(function (b) {
        b.addEventListener('pointerdown', function (e) {
            var r = b.getBoundingClientRect();
            var d = mk('span', { 'class': 'hp-rip', 'aria-hidden': 'true' });
            d.style.left = (e.clientX - r.left) + 'px';
            d.style.top  = (e.clientY - r.top)  + 'px';
            b.appendChild(d);
            setTimeout(function () { d.remove(); }, 650);
        });
    });

    var h1w = document.querySelector('#hp-hero h1');
    if (h1w) {
        h1w.addEventListener('animationend', function (e) {
            if (e.animationName === 'hp-w') e.target.classList.add('is-done');
        });
    }
})();
</script>

@endsection