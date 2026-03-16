<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

<!-- ══ PRIMARY SEO ══ -->
<title>CTG Fuel Tracker — চট্টগ্রাম জ্বালানি পাম্প তেল আছে কি না | Chittagong Fuel Update</title>
<meta name="description" content="চট্টগ্রামের সকল ফুয়েল পাম্পে তেল আছে কিনা রিয়েলটাইমে দেখুন। অকটেন, পেট্রোল, ডিজেলের দাম ও লাইনের অবস্থা জানুন। Tel Koi Chittagong — CTG Fuel Update.">
<meta name="keywords" content="tel koi, তেল কই, CTG fuel tracker, ctg fuel update, Chittagong fuel pump, চট্টগ্রাম তেল পাম্প, fuel pump near me Chittagong, octane price Chittagong, petrol price CTG, diesel Chittagong, জ্বালানি আপডেট, fuel update Bangladesh, petrol pump Chittagong, CNG filling station Chittagong, teler dam chittagong, tel ace ki na, fuel station chittagong bd">
<meta name="author" content="Avrojit Chowdhury Ovi">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="https://fuelupdate.kritantatech.com/">

<!-- ══ OPEN GRAPH (Facebook/WhatsApp) ══ -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://fuelupdate.kritantatech.com/">
<meta property="og:title" content="CTG Fuel Tracker — চট্টগ্রাম জ্বালানি পাম্প রিয়েলটাইম আপডেট">
<meta property="og:description" content="চট্টগ্রামে তেল আছে? অকটেন, পেট্রোল, ডিজেলের দাম ও লাইনের অবস্থা রিয়েলটাইমে দেখুন। Tel Koi CTG — Chittagong Fuel Update.">
<meta property="og:image" content="https://fuelupdate.kritantatech.com/assets/og-image.jpg">
<meta property="og:locale" content="bn_BD">
<meta property="og:site_name" content="CTG Fuel Tracker">

<!-- ══ TWITTER CARD ══ -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="CTG Fuel Tracker — Chittagong Fuel Pump Live Update">
<meta name="twitter:description" content="Real-time fuel pump availability in Chittagong, Bangladesh. Check octane, petrol & diesel prices now.">
<meta name="twitter:image" content="https://fuelupdate.kritantatech.com/assets/og-image.jpg">

<!-- ══ GEO SEO ══ -->
<meta name="geo.region" content="BD-B">
<meta name="geo.placename" content="Chittagong, Bangladesh">
<meta name="geo.position" content="22.3569;91.7832">
<meta name="ICBM" content="22.3569, 91.7832">
<meta name="language" content="Bengali, English">
<meta name="revisit-after" content="1 days">

<!-- ══ SCHEMA.ORG ══ -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "CTG Fuel Tracker",
  "alternateName": ["Tel Koi CTG", "Chittagong Fuel Update", "CTG Fuel Update"],
  "description": "Real-time fuel pump tracker for Chittagong, Bangladesh. Find octane, petrol and diesel availability and prices near you.",
  "url": "https://fuelupdate.kritantatech.com/",
  "applicationCategory": "UtilityApplication",
  "operatingSystem": "Web Browser",
  "inLanguage": ["bn", "en"],
  "author": {
    "@type": "Person",
    "name": "Avrojit Chowdhury Ovi",
    "url": "https://www.facebook.com/avrojit.ovi/"
  },
  "areaServed": {
    "@type": "City",
    "name": "Chittagong",
    "containedInPlace": {
      "@type": "Country",
      "name": "Bangladesh"
    }
  },
  "keywords": "tel koi, CTG fuel tracker, Chittagong fuel pump, fuel update Bangladesh"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "চট্টগ্রামে এখন তেল আছে কি না?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "CTG Fuel Tracker-এ চট্টগ্রামের সব ফুয়েল পাম্পের রিয়েলটাইম তথ্য পাবেন। প্রতিটি পাম্পে তেল আছে কিনা, সিরিয়াল কেমন, এবং দাম কত তা সরাসরি দেখা যায়।"
      }
    },
    {
      "@type": "Question",
      "name": "Chittagong fuel pump near me",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Use CTG Fuel Tracker to find fuel pumps near you in Chittagong. The map shows all filling stations with real-time availability of octane, petrol and diesel."
      }
    },
    {
      "@type": "Question",
      "name": "চট্টগ্রামে অকটেনের দাম কত?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "CTG Fuel Tracker-এ চট্টগ্রামের সব পাম্পে অকটেন, পেট্রোল ও ডিজেলের আপডেট দাম দেখা যায়। ব্যবহারকারীরা রিয়েলটাইমে দাম আপডেট করেন।"
      }
    }
  ]
}
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;-webkit-tap-highlight-color:transparent}
:root{
  --or:#f97316;--or2:#ea580c;--gr:#16a34a;
  --rd:#dc2626;--am:#d97706;--gy:#6b7280;
  --hdr1:#0f172a;--hdr2:#1e293b;
  --bs1:#1a2235;--bs2:#0f172a;
  --card:#ffffff;--card2:#f8fafc;--card3:#f1f5f9;
  --txt:#0f172a;--txt2:#475569;--txt3:#94a3b8;
  --bd:#e2e8f0;
}
@keyframes gradAnim{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.82)}}
@keyframes bounce{0%,100%{transform:translateY(0)}40%{transform:translateY(-8px)}70%{transform:translateY(-3px)}}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-4px)}}
@keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}

html,body{height:100%;overflow:hidden;font-family:'Segoe UI',system-ui,-apple-system,sans-serif}
#app{position:fixed;inset:0;display:flex;flex-direction:column}

/* ══ DARK HEADER ══ */
#hdr{background:linear-gradient(135deg,#0c1220 0%,#1a2744 60%,#0f1a30 100%);flex-shrink:0;z-index:1000;box-shadow:0 4px 24px rgba(0,0,0,.4)}
#hdr-top{display:flex;align-items:center;justify-content:space-between;padding:10px 14px;gap:8px}
.logo{display:flex;align-items:center;gap:10px;min-width:0}
.logo-ic{width:36px;height:36px;border-radius:10px;background:linear-gradient(-45deg,#f97316,#ea580c,#dc2626,#f97316);background-size:300% 300%;animation:gradAnim 4s ease infinite;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 12px rgba(249,115,22,.55)}
.logo-tx{min-width:0}
.logo-tx h1{font-size:17px;font-weight:800;background:linear-gradient(135deg,#f97316,#fb923c,#fbbf24);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1.15;white-space:nowrap}
.logo-tx p{font-size:10px;color:rgba(255,255,255,.45);margin-top:1px;white-space:nowrap}
.hdr-r{display:flex;align-items:center;gap:6px;flex-shrink:0}
.live-b{display:flex;align-items:center;gap:5px;background:rgba(22,163,74,.18);border:1px solid rgba(22,163,74,.35);border-radius:20px;padding:5px 11px;font-size:12px;color:#4ade80;font-weight:700;white-space:nowrap}
.live-dot{width:7px;height:7px;background:#4ade80;border-radius:50%;animation:pulse 2s infinite;flex-shrink:0}

/* Gradient buttons */
.gbtn{display:inline-flex;align-items:center;justify-content:center;gap:5px;border:none;border-radius:20px;padding:8px 13px;font-size:12px;font-weight:700;color:#fff;cursor:pointer;white-space:nowrap;touch-action:manipulation;background:linear-gradient(-45deg,#f97316,#ea580c,#dc2626,#f97316);background-size:300% 300%;animation:gradAnim 4s ease infinite;box-shadow:0 2px 10px rgba(249,115,22,.4);transition:transform .15s,opacity .15s}
.gbtn:active{transform:scale(.93);opacity:.88}
.gbtn-gr{background:linear-gradient(-45deg,#16a34a,#0f766e,#065f46,#16a34a);background-size:300% 300%;animation:gradAnim 5s ease infinite;box-shadow:0 2px 10px rgba(22,163,74,.4)}
.gbtn-bl{background:linear-gradient(-45deg,#1e3a8a,#1d4ed8,#2563eb,#1e3a8a);background-size:300% 300%;animation:gradAnim 5s ease infinite;box-shadow:0 2px 10px rgba(37,99,235,.4)}

/* ══ STATS BAR — BIGGER ══ */
#stats{display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid rgba(255,255,255,.08);background:linear-gradient(180deg,#1a2235 0%,#0f172a 100%)}
.si{padding:10px 10px;display:flex;align-items:center;gap:9px;border-right:1px solid rgba(255,255,255,.07)}
.si:last-child{border-right:none}
.si-v{font-size:22px;font-weight:900;background:linear-gradient(135deg,#fb923c,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1}
.si-l{font-size:11px;color:rgba(255,255,255,.45);margin-top:3px;font-weight:500}
.si-ico{font-size:18px;flex-shrink:0;animation:float 3s ease-in-out infinite}
.si:nth-child(2) .si-ico{animation-delay:.5s}
.si:nth-child(3) .si-ico{animation-delay:1s}
.si:nth-child(4) .si-ico{animation-delay:1.5s}

/* ══ MAP ══ */
#mapw{flex:1;position:relative;min-height:0}
#map{width:100%;height:100%}
.map-leg{position:absolute;top:10px;right:10px;z-index:900;background:rgba(255,255,255,.93);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1px solid var(--bd);border-radius:12px;padding:10px 14px;box-shadow:0 2px 14px rgba(0,0,0,.1)}
.ml{display:flex;align-items:center;gap:7px;font-size:12px;color:var(--txt2);margin-bottom:6px;font-weight:500}
.ml:last-child{margin-bottom:0}
.mldot{width:10px;height:10px;border-radius:50%;flex-shrink:0}

/* ══ DARK BOTTOM SHEET — BIGGER TEXT ══ */
#bs{background:linear-gradient(180deg,#1a2235 0%,#0f172a 100%);border-top:2px solid rgba(249,115,22,.25);flex-shrink:0;display:flex;flex-direction:column;transition:height .32s cubic-bezier(.4,0,.2,1);overflow:hidden;box-shadow:0 -4px 28px rgba(0,0,0,.35)}
#bs.col{height:64px}
#bs.exp{height:56vh}
@media(min-width:700px){#bs.exp{height:44vh}}
.bs-hr{padding:0 16px;height:64px;display:flex;align-items:center;justify-content:space-between;cursor:pointer;flex-shrink:0;user-select:none}
.bs-left{flex:1;min-width:0}
.bs-ttl{display:flex;align-items:center;gap:9px;margin-bottom:3px}
.bs-ttl h3{font-size:15px;font-weight:800;color:#fff;letter-spacing:.01em}
.bs-rdot{width:9px;height:9px;background:var(--rd);border-radius:50%;animation:pulse 1.5s infinite;flex-shrink:0}
.bs-sub{font-size:11px;color:rgba(255,255,255,.4);font-weight:400}
.bs-arr{color:rgba(255,255,255,.35);font-size:20px;transition:transform .32s;flex-shrink:0}
#bs.exp .bs-arr{transform:rotate(180deg)}
.bs-ctrl{padding:0 13px 11px;flex-shrink:0}
.srch-w{position:relative;margin-bottom:10px}
.srch-i{width:100%;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.13);border-radius:12px;padding:10px 13px 10px 38px;color:#fff;font-size:14px;outline:none;-webkit-appearance:none;font-family:inherit;transition:border-color .2s}
.srch-i:focus{border-color:rgba(249,115,22,.6)}
.srch-i::placeholder{color:rgba(255,255,255,.3)}
.srch-ic{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.35);font-size:15px}
.ftabs{display:flex;gap:7px;overflow-x:auto;padding-bottom:2px;scrollbar-width:none}
.ftabs::-webkit-scrollbar{display:none}
.ftab{padding:7px 14px;border-radius:20px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.07);color:rgba(255,255,255,.6);font-size:12px;font-weight:600;white-space:nowrap;cursor:pointer;flex-shrink:0;touch-action:manipulation;transition:all .2s}
.ftab.on{background:linear-gradient(-45deg,#f97316,#ea580c,#dc2626,#f97316);background-size:300% 300%;animation:gradAnim 4s ease infinite;border-color:transparent;color:#fff;box-shadow:0 2px 10px rgba(249,115,22,.35)}
.ftab:active{transform:scale(.94)}

/* ══ DARK FEED CARDS ══ */
#feed{overflow-y:auto;-webkit-overflow-scrolling:touch;flex:1}
.rc{padding:13px 15px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;gap:12px;align-items:flex-start;animation:fadeUp .22s ease;transition:background .15s}
.rc:active{background:rgba(255,255,255,.04)}
.rc-ic{width:46px;height:46px;border-radius:12px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px;background:rgba(249,115,22,.15);border:1px solid rgba(249,115,22,.25);animation:float 4s ease-in-out infinite}
.rc-bd{flex:1;min-width:0}
.rc-nm{font-size:14px;font-weight:700;color:#f1f5f9;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:3px}
.rc-mt{font-size:11px;color:rgba(255,255,255,.4)}
.rc-mt span{color:#fb923c;font-weight:600}
.rc-nt{font-size:12px;color:rgba(255,255,255,.5);margin-top:5px;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.rc-ac{display:flex;gap:6px;margin-top:8px;flex-wrap:wrap}
.rbtn{display:inline-flex;align-items:center;gap:4px;padding:5px 11px;border-radius:16px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.07);color:rgba(255,255,255,.6);font-size:12px;font-weight:500;cursor:pointer;white-space:nowrap;touch-action:manipulation;transition:all .18s}
.rbtn:active{opacity:.7;transform:scale(.93)}
.rbtn.map{border-color:rgba(249,115,22,.4);color:#fb923c;background:rgba(249,115,22,.1)}
.rc-rt{display:flex;flex-direction:column;align-items:flex-end;gap:5px;flex-shrink:0}
.chip{padding:4px 10px;border-radius:7px;font-size:11px;font-weight:700;white-space:nowrap}
.cg{background:rgba(22,163,74,.18);color:#4ade80;border:1px solid rgba(22,163,74,.3)}
.ca{background:rgba(217,119,6,.18);color:#fbbf24;border:1px solid rgba(217,119,6,.3)}
.cr{background:rgba(220,38,38,.18);color:#f87171;border:1px solid rgba(220,38,38,.3)}
.ck{background:rgba(107,114,128,.15);color:#9ca3af;border:1px solid rgba(107,114,128,.25)}
.priceb{font-size:16px;font-weight:800;background:linear-gradient(135deg,#f97316,#fb923c);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.pricel{font-size:10px;color:rgba(255,255,255,.35)}
.empty{text-align:center;padding:40px;color:rgba(255,255,255,.3);font-size:14px}
.skel{background:linear-gradient(90deg,rgba(255,255,255,.06) 25%,rgba(255,255,255,.1) 50%,rgba(255,255,255,.06) 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;border-radius:8px}

/* ══ DETAIL PANEL ══ */
#dp{position:fixed;inset:0;z-index:2000;background:var(--card2);transform:translateY(100%);transition:transform .32s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column}
#dp.open{transform:translateY(0)}
.dp-hdr{background:linear-gradient(135deg,#0c1220,#1a2744);padding:13px 15px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:11px;flex-shrink:0;box-shadow:0 2px 12px rgba(0,0,0,.25)}
.dp-bk{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:9px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:rgba(255,255,255,.75);font-size:18px;flex-shrink:0;touch-action:manipulation;transition:all .18s}
.dp-bk:active{background:rgba(255,255,255,.2);transform:scale(.9)}
.dp-ttl{font-size:15px;font-weight:700;color:#fff;flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.dp-body{overflow-y:auto;-webkit-overflow-scrolling:touch;flex:1;padding:16px}
.dp-stl{font-size:10px;font-weight:700;color:var(--txt3);text-transform:uppercase;letter-spacing:.08em;margin:16px 0 10px}
.dp-row{display:flex;justify-content:space-between;align-items:flex-start;font-size:13px;padding:8px 0;border-bottom:1px solid var(--bd)}
.dp-row:last-child{border-bottom:none}
.dp-l{color:var(--txt3);font-weight:500}
.dp-v{color:var(--txt);font-weight:600;text-align:right;max-width:65%}
.fg{display:grid;grid-template-columns:repeat(3,1fr);gap:9px;margin-bottom:12px}
.fc{background:var(--card);border:1.5px solid var(--bd);border-radius:12px;padding:13px 8px;text-align:center;box-shadow:0 1px 4px rgba(0,0,0,.06);transition:transform .18s}
.fc:active{transform:translateY(-2px)}
.fc-n{font-size:10px;font-weight:700;color:var(--txt3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px}
.fc-s{font-size:13px;font-weight:700;margin-bottom:5px}
.fc-p{font-size:15px;font-weight:800;background:linear-gradient(135deg,#f97316,#ea580c);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.sg-box{background:var(--card);border:1.5px solid var(--bd);border-radius:11px;padding:13px;margin-bottom:9px;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.sg-ttl{font-size:13px;font-weight:700;color:var(--txt);margin-bottom:9px;display:flex;align-items:center;gap:6px}
.sg-row{display:grid;grid-template-columns:1fr auto;gap:8px;align-items:end}
.dp-inp{width:100%;background:var(--card3);border:1.5px solid var(--bd);border-radius:9px;padding:10px 12px;color:var(--txt);font-size:13px;outline:none;-webkit-appearance:none;font-family:inherit;transition:border-color .2s}
.dp-inp:focus{border-color:#f97316;box-shadow:0 0 0 3px rgba(249,115,22,.1)}
.dp-inp::placeholder{color:var(--txt3)}
select.dp-inp option{background:#fff}
.dp-btn{padding:10px 15px;border-radius:9px;border:none;font-size:12px;font-weight:700;cursor:pointer;color:#fff;touch-action:manipulation;min-height:42px;display:inline-flex;align-items:center;justify-content:center;gap:5px;background:linear-gradient(-45deg,#f97316,#ea580c,#dc2626,#f97316);background-size:300% 300%;animation:gradAnim 4s ease infinite;box-shadow:0 2px 8px rgba(249,115,22,.3);transition:transform .15s}
.dp-btn:active{transform:scale(.93)}
.dp-btn-w{width:100%;margin-bottom:8px;min-height:48px;font-size:14px;border-radius:12px}
.dp-btn-gr{background:linear-gradient(-45deg,#16a34a,#0f766e,#065f46,#16a34a);background-size:300% 300%;animation:gradAnim 5s ease infinite;box-shadow:0 2px 8px rgba(22,163,74,.3)}
.ptag{font-size:10px;font-weight:600;background:#fef9c3;color:#a16207;border:1px solid #fde047;padding:2px 7px;border-radius:5px}
.rmin{background:var(--card);border:1.5px solid var(--bd);border-radius:10px;padding:11px 13px;margin-bottom:9px;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.rmin p{font-size:13px;color:var(--txt);margin-bottom:4px;line-height:1.5}
.rmin time{font-size:11px;color:var(--txt3)}
.info-box{background:linear-gradient(135deg,#fef9c3,#fef3c7);border:1.5px solid #fde047;border-radius:10px;padding:11px 13px;font-size:12px;color:#92400e;font-weight:500;margin-bottom:11px}

/* ══ MODALS ══ */
.modal-bg{position:fixed;inset:0;z-index:3000;background:rgba(12,18,32,.6);backdrop-filter:blur(7px);-webkit-backdrop-filter:blur(7px);display:flex;align-items:flex-end;opacity:0;pointer-events:none;transition:opacity .25s}
.modal-bg.open{opacity:1;pointer-events:all}
.modal-sh{background:var(--card);border-radius:22px 22px 0 0;border-top:2px solid var(--bd);width:100%;padding:20px 16px calc(20px + env(safe-area-inset-bottom,0px));transform:translateY(44px);transition:transform .3s cubic-bezier(.4,0,.2,1);max-height:92vh;overflow-y:auto;box-shadow:0 -10px 50px rgba(0,0,0,.2)}
.modal-bg.open .modal-sh{transform:translateY(0)}
.modal-hd{font-size:16px;font-weight:800;color:var(--txt);margin-bottom:17px;display:flex;align-items:center;justify-content:space-between}
.modal-cl{background:var(--card3);border:none;border-radius:8px;width:30px;height:30px;color:var(--txt3);font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .15s}
.modal-cl:active{background:var(--bd)}
.m-lbl{font-size:11px;color:var(--txt3);display:block;margin-bottom:5px;font-weight:700;text-transform:uppercase;letter-spacing:.04em}
.m-inp{width:100%;background:var(--card3);border:1.5px solid var(--bd);border-radius:10px;padding:11px 13px;color:var(--txt);font-size:14px;outline:none;margin-bottom:12px;-webkit-appearance:none;font-family:inherit;transition:border-color .2s,box-shadow .2s}
.m-inp:focus{border-color:#f97316;box-shadow:0 0 0 3px rgba(249,115,22,.1)}
.m-inp::placeholder{color:var(--txt3)}
select.m-inp option{background:#fff}
textarea.m-inp{resize:vertical;min-height:72px}
.og{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px}
.oo{padding:11px 8px;border-radius:11px;border:1.5px solid var(--bd);background:var(--card3);color:var(--txt2);font-size:13px;font-weight:600;cursor:pointer;text-align:center;touch-action:manipulation;transition:all .2s}
.oo.on{border-color:transparent;color:#fff;background:linear-gradient(-45deg,#f97316,#ea580c,#dc2626,#f97316);background-size:300% 300%;animation:gradAnim 4s ease infinite;box-shadow:0 2px 8px rgba(249,115,22,.3)}
.oo:active{transform:scale(.93)}
.m-sub{width:100%;padding:15px;border:none;border-radius:13px;color:#fff;font-size:15px;font-weight:700;cursor:pointer;touch-action:manipulation;min-height:52px;transition:transform .15s;background:linear-gradient(-45deg,#f97316,#ea580c,#dc2626,#f97316);background-size:300% 300%;animation:gradAnim 4s ease infinite;box-shadow:0 4px 18px rgba(249,115,22,.4)}
.m-sub:active{transform:scale(.97)}
.m-sub-gr{background:linear-gradient(-45deg,#16a34a,#0f766e,#065f46,#16a34a);background-size:300% 300%;animation:gradAnim 5s ease infinite;box-shadow:0 4px 14px rgba(22,163,74,.35)}
.sres{background:var(--card);border:1.5px solid var(--bd);border-radius:10px;margin-bottom:11px;max-height:160px;overflow-y:auto;box-shadow:0 2px 8px rgba(0,0,0,.08)}
.sres-it{padding:10px 14px;border-bottom:1px solid var(--bd);cursor:pointer;transition:background .15s}
.sres-it:last-child{border-bottom:none}
.sres-it:active{background:var(--card3)}
.sres-it h4{font-size:13px;font-weight:600;color:var(--txt)}
.sres-it p{font-size:11px;color:var(--txt3);margin-top:2px}
.sel-st{background:linear-gradient(135deg,#fff7ed,#ffedd5);border:1.5px solid #fed7aa;border-radius:10px;padding:10px 13px;font-size:13px;color:#c2410c;font-weight:600;margin-bottom:12px}
.as-fg{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:13px}
.as-fc{background:var(--card3);border:1.5px solid var(--bd);border-radius:11px;padding:11px 8px;text-align:center}
.as-fc-n{font-size:9px;font-weight:700;color:var(--txt3);margin-bottom:7px;text-transform:uppercase}
.as-fc select,.as-fc input{width:100%;border:1px solid var(--bd);border-radius:7px;padding:7px 8px;font-size:12px;background:#fff;color:var(--txt);outline:none;font-family:inherit;margin-bottom:4px}

/* Toast */
#toast{position:fixed;bottom:calc(75px + env(safe-area-inset-bottom,0px));left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#0c1220,#1a2744);color:#fff;padding:11px 22px;border-radius:50px;font-size:13px;z-index:5000;opacity:0;pointer-events:none;transition:opacity .3s;max-width:calc(100vw - 28px);text-align:center;white-space:nowrap;font-weight:600;box-shadow:0 4px 24px rgba(0,0,0,.45);border:1px solid rgba(249,115,22,.3)}
#toast.show{opacity:1}
.leaflet-top,.leaflet-bottom{z-index:800!important}
.leaflet-control-attribution{font-size:9px!important}

@media(max-width:480px){
  .logo-tx h1{font-size:14px}
  .gbtn{padding:7px 10px;font-size:11px}
  .si-v{font-size:18px}
  .si-l{font-size:10px}
  .bs-ttl h3{font-size:14px}
}
</style>
</head>
<body>
<div id="app">
  <div id="hdr">
    <div id="hdr-top">
      <div class="logo">
        <div class="logo-ic">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M3 22V9l9-7 9 7v13"/><path d="M14 22v-7H10v7"/><path d="M9 9h6v5H9z"/></svg>
        </div>
        <div class="logo-tx">
          <h1>CTG Fuel Tracker</h1>
          <p>by Avrojit Chowdhury Ovi</p>
        </div>
      </div>
      <div class="hdr-r">
        <div class="live-b"><div class="live-dot"></div><span id="lc">0</span></div>
        <button class="gbtn gbtn-gr" onclick="openAS()" style="padding:8px 12px;font-size:11px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>পাম্প
        </button>
        <button class="gbtn" onclick="openRM()" style="padding:8px 12px;font-size:11px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>রিপোর্ট
        </button>
        <button class="gbtn gbtn-bl" onclick="window.location='/admin/'" style="padding:8px 11px;font-size:13px" title="Admin Dashboard">⚙</button>
      </div>
    </div>
    <div id="stats">
      <div class="si"><span class="si-ico">⛽</span><div><div class="si-v" id="ss">—</div><div class="si-l">স্টেশন</div></div></div>
      <div class="si"><span class="si-ico">📋</span><div><div class="si-v" id="sr">—</div><div class="si-l">রিপোর্ট</div></div></div>
      <div class="si"><span class="si-ico">👥</span><div><div class="si-v" id="su">—</div><div class="si-l">ব্যবহারকারী</div></div></div>
      <div class="si"><span class="si-ico">📈</span><div><div class="si-v" id="sp">—</div><div class="si-l">গড় অকটেন</div></div></div>
    </div>
  </div>

  <div id="mapw">
    <div id="map"></div>
    <div class="map-leg">
      <div class="ml"><div class="mldot" style="background:#16a34a"></div>লাইন নেই</div>
      <div class="ml"><div class="mldot" style="background:#d97706"></div>অল্প লাইন</div>
      <div class="ml"><div class="mldot" style="background:#dc2626"></div>অনেক লাইন</div>
      <div class="ml"><div class="mldot" style="background:#9ca3af"></div>দিচ্ছে না</div>
    </div>
  </div>

  <div id="bs" class="col">
    <div class="bs-hr" onclick="toggleBS()">
      <div class="bs-left">
        <div class="bs-ttl"><div class="bs-rdot"></div><h3>সাম্প্রতিক রিপোর্টসমূহ</h3></div>
        <div class="bs-sub">পাম্পে ট্যাপ করে বিস্তারিত দেখুন</div>
      </div>
      <div class="bs-arr">⌃</div>
    </div>
    <div class="bs-ctrl">
      <div class="srch-w">
        <span class="srch-ic">🔍</span>
        <input type="text" class="srch-i" id="si" placeholder="স্টেশনের নাম দিয়ে খুঁজুন..." oninput="renderFeed()"/>
      </div>
      <div class="ftabs">
        <div class="ftab on" onclick="setF('all',this)">সব</div>
        <div class="ftab" onclick="setF('none',this)">লাইন নেই</div>
        <div class="ftab" onclick="setF('mid',this)">লাইন অল্প</div>
        <div class="ftab" onclick="setF('many',this)">লাইন অনেক</div>
        <div class="ftab" onclick="setF('unavailable',this)">দিচ্ছে না</div>
      </div>
    </div>
    <div id="feed"></div>
  </div>
</div>

<!-- Detail Panel -->
<div id="dp">
  <div class="dp-hdr">
    <button class="dp-bk" onclick="closeDP()">←</button>
    <div class="dp-ttl" id="dp-ttl">স্টেশন</div>
    <button class="gbtn" style="font-size:11px;padding:7px 12px" onclick="openRM(curSid)">রিপোর্ট</button>
  </div>
  <div class="dp-body" id="dp-body"></div>
</div>

<!-- Report Modal -->
<div id="rm" class="modal-bg" onclick="if(event.target===this)closeRM()">
  <div class="modal-sh" onclick="event.stopPropagation()">
    <div class="modal-hd">📋 রিপোর্ট দিন <button class="modal-cl" onclick="closeRM()">✕</button></div>
    <span class="m-lbl">স্টেশন বেছে নিন *</span>
    <input type="text" class="m-inp" id="rms" placeholder="স্টেশনের নাম লিখুন..." oninput="rmSearch()"/>
    <div id="rm-res" class="sres" style="display:none"></div>
    <div id="rm-sel" class="sel-st" style="display:none"></div>
    <span class="m-lbl">তেলের অবস্থা</span>
    <div class="og" id="og-st">
      <div class="oo on" data-v="available" onclick="selO(this,'og-st')">✅ তেল আছে</div>
      <div class="oo" data-v="limited" onclick="selO(this,'og-st')">🟡 সীমিত</div>
      <div class="oo" data-v="unavailable" onclick="selO(this,'og-st')">❌ নেই</div>
      <div class="oo" data-v="unknown" onclick="selO(this,'og-st')">❓ অজানা</div>
    </div>
    <span class="m-lbl">লাইনের অবস্থা</span>
    <div class="og" id="og-ser">
      <div class="oo on" data-v="none" onclick="selO(this,'og-ser')">😊 লাইন নেই</div>
      <div class="oo" data-v="mid" onclick="selO(this,'og-ser')">🟡 অল্প লাইন</div>
      <div class="oo" data-v="many" onclick="selO(this,'og-ser')">😰 অনেক লাইন</div>
      <div class="oo" data-v="unknown" onclick="selO(this,'og-ser')">❓ জানি না</div>
    </div>
    <span class="m-lbl">মন্তব্য (ঐচ্ছিক)</span>
    <textarea class="m-inp" id="rm-nt" placeholder="আপনার অভিজ্ঞতা লিখুন..."></textarea>
    <button class="m-sub" onclick="submitRep()">রিপোর্ট জমা দিন →</button>
  </div>
</div>

<!-- Add Station Modal -->
<div id="as" class="modal-bg" onclick="if(event.target===this)closeAS()">
  <div class="modal-sh" onclick="event.stopPropagation()">
    <div class="modal-hd">📍 পাম্প যোগ করুন <button class="modal-cl" onclick="closeAS()">✕</button></div>
    <div id="as-loc" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1.5px solid #bfdbfe;border-radius:11px;padding:11px 13px;font-size:13px;color:#1e40af;margin-bottom:13px;font-weight:500">📍 অবস্থান নির্ধারণ করা হচ্ছে...</div>
    <input type="number" class="m-inp" id="as-lat" placeholder="Latitude (22.3569)" step="0.00001" inputmode="decimal" style="display:none"/>
    <input type="number" class="m-inp" id="as-lng" placeholder="Longitude (91.7832)" step="0.00001" inputmode="decimal" style="display:none"/>
    <span class="m-lbl">পাম্পের নাম *</span>
    <input type="text" class="m-inp" id="as-nm" placeholder="যেমন: রহিম ফিলিং স্টেশন"/>
    <span class="m-lbl">ঠিকানা</span>
    <input type="text" class="m-inp" id="as-addr" placeholder="যেমন: কদমতলী, চট্টগ্রাম"/>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
      <div><span class="m-lbl">তেলের অবস্থা</span>
        <select class="m-inp" id="as-st"><option value="available">✅ তেল আছে</option><option value="limited">🟡 সীমিত</option><option value="unavailable">❌ দিচ্ছে না</option><option value="unknown">❓ অজানা</option></select>
      </div>
      <div><span class="m-lbl">লাইনের অবস্থা</span>
        <select class="m-inp" id="as-ser"><option value="none">😊 লাইন নেই</option><option value="mid">🟡 অল্প</option><option value="many">😰 অনেক</option><option value="unknown">❓</option></select>
      </div>
    </div>
    <span class="m-lbl" style="margin-top:2px">জ্বালানির অবস্থা ও দাম</span>
    <div class="as-fg">
      <div class="as-fc"><div class="as-fc-n">⛽ অকটেন</div>
        <select id="as-st-ok"><option value="আছে">আছে</option><option value="সীমিত">সীমিত</option><option value="নেই">নেই</option></select>
        <input type="number" id="as-pr-ok" placeholder="৳ দাম" min="0" step="0.5" inputmode="decimal"/>
      </div>
      <div class="as-fc"><div class="as-fc-n">🛢 পেট্রোল</div>
        <select id="as-st-pe"><option value="আছে">আছে</option><option value="সীমিত">সীমিত</option><option value="নেই">নেই</option></select>
        <input type="number" id="as-pr-pe" placeholder="৳ দাম" min="0" step="0.5" inputmode="decimal"/>
      </div>
      <div class="as-fc"><div class="as-fc-n">🚛 ডিজেল</div>
        <select id="as-st-di"><option value="আছে">আছে</option><option value="সীমিত">সীমিত</option><option value="নেই">নেই</option></select>
        <input type="number" id="as-pr-di" placeholder="৳ দাম" min="0" step="0.5" inputmode="decimal"/>
      </div>
    </div>
    <button class="m-sub m-sub-gr" onclick="submitStation()">✓ পাম্প যোগ করুন</button>
  </div>
</div>

<div id="toast"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
let map,markers={},allSt=[],allRep=[],curF='all',curSid=null,rmSid=null,asLat=null,asLng=null,toastT;
const SC={available:'তেল আছে',limited:'সীমিত',unavailable:'দিচ্ছে না',unknown:'অজানা'};
const SER={none:'😊 লাইন নেই',mid:'🟡 অল্প',many:'😰 অনেক',unknown:'❓'};
const CC={available:'cg',limited:'ca',unavailable:'cr',unknown:'ck'};
const CS={none:'cg',mid:'ca',many:'cr',unknown:'ck'};
const FC={available:'#16a34a',limited:'#d97706',unavailable:'#dc2626',unknown:'#9ca3af'};
const FCA={available:'rgba(22,163,74,.2)',limited:'rgba(217,119,6,.2)',unavailable:'rgba(220,38,38,.2)',unknown:'rgba(107,114,128,.15)'};

function initMap(){
  map=L.map('map',{zoomControl:false}).setView([22.3569,91.7832],13);
  L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',{
    attribution:'© <a href="https://openstreetmap.org">OpenStreetMap</a> © <a href="https://carto.com">CARTO</a>',
    subdomains:'abcd',maxZoom:19
  }).addTo(map);
  L.control.zoom({position:'topright'}).addTo(map);
}

function mkIcon(status){
  const c=FC[status]||'#9ca3af';
  const svg=`<svg xmlns="http://www.w3.org/2000/svg" width="38" height="50" viewBox="0 0 38 50">
    <defs>
      <filter id="dr${status}"><feDropShadow dx="0" dy="3" stdDeviation="3" flood-color="${c}" flood-opacity="0.55"/></filter>
      <radialGradient id="gl${status}" cx="35%" cy="28%" r="70%">
        <stop offset="0%" stop-color="white" stop-opacity="0.45"/>
        <stop offset="100%" stop-color="${c}" stop-opacity="0"/>
      </radialGradient>
    </defs>
    <path d="M19 2C10.7 2 4 8.7 4 17c0 11.5 15 31 15 31S34 28.5 34 17C34 8.7 27.3 2 19 2z" fill="${c}" filter="url(#dr${status})"/>
    <path d="M19 2C10.7 2 4 8.7 4 17c0 11.5 15 31 15 31S34 28.5 34 17C34 8.7 27.3 2 19 2z" fill="url(#gl${status})"/>
    <circle cx="19" cy="17" r="10.5" fill="white" fill-opacity="0.95"/>
    <text x="19" y="21.5" text-anchor="middle" font-size="12" font-family="system-ui,sans-serif">⛽</text>
  </svg>`;
  return L.divIcon({className:'',html:`<div style="animation:bounce 2.5s ease-in-out infinite;animation-delay:${(Math.random()*2).toFixed(1)}s;transform-origin:bottom center">${svg}</div>`,iconSize:[38,50],iconAnchor:[19,50]});
}

function fc(av){return av==='আছে'?'#16a34a':av==='সীমিত'?'#d97706':av==='নেই'?'#dc2626':'#9ca3af';}
function esc(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}

async function loadSt(){
  try{const r=await fetch('/api/stations.php');const d=await r.json();
  if(!d.success)return;allSt=d.stations;
  document.getElementById('ss').textContent=d.stations.length;
  document.getElementById('lc').textContent=d.stations.length;
  Object.values(markers).forEach(m=>map.removeLayer(m));markers={};
  d.stations.forEach((s,i)=>setTimeout(()=>{
    const m=L.marker([s.lat,s.lng],{icon:mkIcon(s.status)}).addTo(map).on('click',()=>openDP(s.id));
    markers[s.id]=m;
  },i*25));}catch(e){}
}

async function loadRep(){
  try{const r=await fetch('/api/reports.php');const d=await r.json();
  if(!d.success)return;allRep=d.reports;
  document.getElementById('sr').textContent=d.total||d.reports.length;
  document.getElementById('su').textContent=d.unique_users||'—';
  document.getElementById('sp').textContent=d.avg_price?'৳'+d.avg_price:'—';
  renderFeed();}catch(e){}
}

function renderFeed(){
  const q=document.getElementById('si').value.toLowerCase();
  let list=allRep.filter(r=>{
    if(curF==='unavailable'&&r.status!=='unavailable')return false;
    if(curF!=='all'&&curF!=='unavailable'&&r.serial_status!==curF)return false;
    if(q&&!r.station_name.toLowerCase().includes(q))return false;
    return true;
  });
  const feed=document.getElementById('feed');
  if(!list.length){feed.innerHTML=`<div class="empty">কোনো রিপোর্ট পাওয়া যায়নি।</div>`;return;}
  feed.innerHTML=list.slice(0,60).map(r=>`
    <div class="rc">
      <div class="rc-ic" style="background:${FCA[r.status]||FCA.unknown};border-color:${FC[r.status]||FC.unknown}55">⛽</div>
      <div class="rc-bd">
        <div class="rc-nm">${esc(r.station_name)}</div>
        <div class="rc-mt">${esc(r.time_ago||r.created_at)} · <span>${esc(r.reporter||'user')}</span></div>
        ${r.note?`<div class="rc-nt">${esc(r.note)}</div>`:''}
        <div class="rc-ac">
          <div class="rbtn">👍 (${r.upvotes||0})</div>
          <div class="rbtn">👎 (${r.downvotes||0})</div>
          <div class="rbtn map" onclick="goSt(${r.station_id})">📍 ম্যাপ</div>
        </div>
      </div>
      <div class="rc-rt">
        <div class="chip ${CC[r.status]||'ck'}">${SC[r.status]||'অজানা'}</div>
        <div class="chip ${CS[r.serial_status]||'ck'}" style="font-size:10px">${SER[r.serial_status]||'অজানা'}</div>
        ${r.price?`<div class="priceb">৳${r.price}</div><div class="pricel">অকটেন</div>`:''}
      </div>
    </div>`).join('');
}

function setF(f,el){curF=f;document.querySelectorAll('.ftab').forEach(t=>t.classList.remove('on'));el.classList.add('on');renderFeed();}
function goSt(sid){const s=allSt.find(x=>x.id==sid);if(s){map.flyTo([s.lat,s.lng],16,{duration:1});document.getElementById('bs').classList.replace('exp','col');}}

async function openDP(id){
  curSid=id;
  document.getElementById('dp-ttl').textContent='লোড হচ্ছে...';
  document.getElementById('dp-body').innerHTML=`<div style="padding:24px 0"><div class="skel" style="height:65px;margin-bottom:11px"></div><div class="skel" style="height:42px;margin-bottom:9px"></div><div class="skel" style="height:42px"></div></div>`;
  document.getElementById('dp').classList.add('open');
  const r=await fetch('/api/stations.php?id='+id);const d=await r.json();
  if(!d.success){toast('লোড ব্যর্থ।');return;}
  const s=d.station;
  document.getElementById('dp-ttl').textContent=s.name;
  const S2={available:'✅ তেল আছে',limited:'🟡 সীমিত',unavailable:'❌ দিচ্ছে না',unknown:'❓ অজানা'};
  const SE2={none:'😊 লাইন নেই',mid:'🟡 অল্প লাইন',many:'😰 অনেক লাইন',unknown:'❓ অজানা'};
  const fcds=(s.fuels||[]).map(f=>`<div class="fc"><div class="fc-n">${f.fuel_type}</div><div class="fc-s" style="color:${fc(f.availability||'')}">${f.availability||'—'}</div><div class="fc-p">${f.price?'৳'+parseFloat(f.price).toFixed(0):'—'}</div></div>`).join('');
  const sugg=(['অকটেন','পেট্রোল','ডিজেল']).map(f=>{const k='ps_'+f.replace(/[^\w]/g,'_');const ex=s.pending_suggests&&s.pending_suggests.includes(f);return`<div class="sg-box"><div class="sg-ttl">⛽ ${f}${ex?` <span class="ptag">⏳ অনুমোদন বাকি</span>`:''}</div>${ex?`<p style="font-size:12px;color:var(--txt3)">সাজেশন অনুমোদন বাকি।</p>`:`<div class="sg-row"><div><div style="font-size:10px;color:var(--txt3);margin-bottom:4px;font-weight:600">নতুন দাম (৳/লি.)</div><input type="number" class="dp-inp" id="${k}" placeholder="132" min="0" step="0.5" inputmode="decimal"/></div><button class="dp-btn" onclick="subPS(${id},'${f}','${k}')" style="min-height:40px;padding:0 14px;font-size:12px">জমা</button></div>`}</div>`;}).join('');
  const reps=s.reports&&s.reports.length?s.reports.map(r=>`<div class="rmin"><p>${esc(r.note||'কোনো মন্তব্য নেই')} <span style="float:right;font-size:11px;font-weight:700;color:${r.status==='available'?'#16a34a':r.status==='unavailable'?'#dc2626':'#d97706'}">${SC[r.status]||''}</span></p><time>${r.created_at}</time></div>`).join(''):`<p style="font-size:13px;color:var(--txt3);text-align:center;padding:16px">রিপোর্ট নেই।</p>`;
  document.getElementById('dp-body').innerHTML=`
    <div style="display:flex;gap:7px;flex-wrap:wrap;margin-bottom:14px"><span class="chip ${CC[s.status]||'ck'}">${S2[s.status]||'অজানা'}</span><span class="chip ${CS[s.serial_status]||'ck'}">${SE2[s.serial_status]||'অজানা'}</span></div>
    <div class="dp-row"><span class="dp-l">ঠিকানা</span><span class="dp-v">${esc(s.address||'—')}</span></div>
    <div class="dp-row"><span class="dp-l">শেষ আপডেট</span><span class="dp-v">${s.last_updated||'—'}</span></div>
    <div class="dp-stl">জ্বালানির অবস্থা</div>
    <div class="fg">${fcds||'<p style="color:var(--txt3);font-size:13px">তথ্য নেই।</p>'}</div>
    <div class="dp-stl">দামের সাজেশন দিন</div>
    <div class="info-box">💡 Admin অনুমোদনের পর সবার জন্য দেখা যাবে।</div>
    ${sugg}
    <div class="dp-stl">সাম্প্রতিক রিপোর্ট</div>${reps}
    <button class="dp-btn dp-btn-w" style="margin-top:10px" onclick="openRM(${id});closeDP()">এই পাম্পে রিপোর্ট দিন</button>
    ${s.is_user_submitted?'<div style="text-align:center;font-size:11px;color:var(--txt3);margin-top:9px">📍 ব্যবহারকারী কর্তৃক যোগকৃত</div>':''}`;
}
function closeDP(){document.getElementById('dp').classList.remove('open');curSid=null;}

async function subPS(sid,fuel,key){
  const inp=document.getElementById(key);if(!inp||!inp.value.trim()){toast('সঠিক দাম লিখুন!');return;}
  const r=await fetch('/api/suggest_price.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({station_id:sid,fuel_type:fuel,price:inp.value.trim()})});
  const d=await r.json();
  if(d.success){toast('✅ '+fuel+' সাজেশন জমা হয়েছে!');openDP(sid);}else toast(d.error||'সমস্যা।');
}

function openRM(sid){
  rmSid=sid||null;
  document.getElementById('rms').value='';document.getElementById('rm-res').style.display='none';
  document.getElementById('rm-sel').style.display='none';document.getElementById('rm-nt').value='';
  if(sid){const s=allSt.find(x=>x.id==sid);if(s){document.getElementById('rm-sel').textContent='📍 '+s.name;document.getElementById('rm-sel').style.display='block';}}
  document.getElementById('rm').classList.add('open');
}
function closeRM(){document.getElementById('rm').classList.remove('open');}
function selO(el,gid){document.querySelectorAll('#'+gid+' .oo').forEach(o=>o.classList.remove('on'));el.classList.add('on');}
function getO(gid){return document.querySelector('#'+gid+' .oo.on')?.dataset.v||'';}
function rmSearch(){
  const q=document.getElementById('rms').value.toLowerCase();const res=document.getElementById('rm-res');
  if(!q){res.style.display='none';return;}
  const m=allSt.filter(s=>s.name.toLowerCase().includes(q)).slice(0,8);
  if(!m.length){res.style.display='none';return;}
  res.style.display='block';
  res.innerHTML=m.map(s=>`<div class="sres-it" onclick="selSt(${s.id},'${esc(s.name)}')" ><h4>${esc(s.name)}</h4><p>${esc(s.address||'')}</p></div>`).join('');
}
function selSt(id,name){rmSid=id;document.getElementById('rm-res').style.display='none';document.getElementById('rm-sel').textContent='📍 '+name;document.getElementById('rm-sel').style.display='block';document.getElementById('rms').value='';}
async function submitRep(){
  if(!rmSid){toast('স্টেশন বেছে নিন!');return;}
  const b={station_id:rmSid,status:getO('og-st'),serial_status:getO('og-ser'),note:document.getElementById('rm-nt').value.trim()};
  const r=await fetch('/api/report.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(b)});
  const d=await r.json();
  if(d.success){toast('✅ রিপোর্ট জমা হয়েছে!');closeRM();if(markers[rmSid]){markers[rmSid].setIcon(mkIcon(b.status));}loadRep();}
  else toast(d.error||'সমস্যা।');
}

function openAS(){
  document.getElementById('as').classList.add('open');
  document.getElementById('as-loc').textContent='📍 অবস্থান নির্ধারণ করা হচ্ছে...';
  document.getElementById('as-lat').style.display='none';document.getElementById('as-lng').style.display='none';
  document.getElementById('as-nm').value='';document.getElementById('as-addr').value='';
  asLat=null;asLng=null;
  if(!navigator.geolocation){showManualF();return;}
  navigator.geolocation.getCurrentPosition(pos=>{
    asLat=pos.coords.latitude;asLng=pos.coords.longitude;
    map.flyTo([asLat,asLng],16,{duration:1});
    document.getElementById('as-loc').innerHTML=`<span style="color:#16a34a;font-weight:700">✅ অবস্থান পাওয়া গেছে!</span><br><small style="color:#475569;font-size:11px">${asLat.toFixed(5)}, ${asLng.toFixed(5)}</small>`;
  },()=>showManualF(),{timeout:8000,enableHighAccuracy:true});
}
function showManualF(){document.getElementById('as-loc').innerHTML='⚠️ GPS পাওয়া যায়নি। ম্যানুয়ালি দিন।';document.getElementById('as-lat').style.display='block';document.getElementById('as-lng').style.display='block';}
function closeAS(){document.getElementById('as').classList.remove('open');}
async function submitStation(){
  const name=document.getElementById('as-nm').value.trim();if(!name){toast('পাম্পের নাম দিন!');return;}
  let la=asLat,ln=asLng;
  if(!la){la=parseFloat(document.getElementById('as-lat').value);ln=parseFloat(document.getElementById('as-lng').value);if(isNaN(la)||isNaN(ln)){toast('সঠিক অবস্থান দিন!');return;}}
  const fuels=[{fuel_type:'অকটেন',availability:document.getElementById('as-st-ok').value,price:document.getElementById('as-pr-ok').value||null},{fuel_type:'পেট্রোল',availability:document.getElementById('as-st-pe').value,price:document.getElementById('as-pr-pe').value||null},{fuel_type:'ডিজেল',availability:document.getElementById('as-st-di').value,price:document.getElementById('as-pr-di').value||null}];
  const r=await fetch('/api/add_station.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({name,address:document.getElementById('as-addr').value.trim(),lat:la,lng:ln,status:document.getElementById('as-st').value,serial_status:document.getElementById('as-ser').value,fuels,is_user_submitted:1})});
  const d=await r.json();
  if(d.success){toast('✅ "'+name+'" যোগ করা হয়েছে!');closeAS();loadSt();}else toast(d.error||'সমস্যা।');
}

function toggleBS(){const bs=document.getElementById('bs');bs.classList.contains('col')?bs.classList.replace('col','exp'):bs.classList.replace('exp','col');}
const bsel=document.getElementById('bs');let bsY=0;
bsel.addEventListener('touchstart',e=>{bsY=e.touches[0].clientY;},{passive:true});
bsel.addEventListener('touchend',e=>{const dy=e.changedTouches[0].clientY-bsY;if(dy>65)bsel.classList.replace('exp','col');else if(dy<-65)bsel.classList.replace('col','exp');},{passive:true});

function toast(msg){clearTimeout(toastT);const t=document.getElementById('toast');t.textContent=msg;t.classList.add('show');toastT=setTimeout(()=>t.classList.remove('show'),3500);}
window.addEventListener('resize',()=>map&&map.invalidateSize());
(async()=>{initMap();await loadSt();await loadRep();setInterval(loadRep,60000);})();
</script>
</body>
</html>
