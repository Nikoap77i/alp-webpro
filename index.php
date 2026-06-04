<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>SuRide — Premium Car Rental Surabaya</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet" />
<style>
/* ===== RESET & ROOT ===== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --navy: #0F172A;
  --black: #070B14;
  --charcoal: #111827;
  --gold: #D4AF37;
  --gold-light: #E8C84A;
  --gold-dim: rgba(212,175,55,0.15);
  --gold-border: rgba(212,175,55,0.3);
  --white: #F8F6F0;
  --muted: rgba(248,246,240,0.5);
  --glass: rgba(15,23,42,0.6);
  --glass-light: rgba(255,255,255,0.04);
  --sidebar-w: 260px;
  --font-display: 'Cinzel', serif;
  --font-body: 'DM Sans', sans-serif;
  --font-serif: 'Cormorant Garamond', serif;
}
html { scroll-behavior: smooth; }
body { background: var(--black); color: var(--white); font-family: var(--font-body); font-weight: 300; overflow-x: hidden; }
a { text-decoration: none; color: inherit; }
button { cursor: pointer; border: none; background: none; font-family: var(--font-body); }
input, select, textarea { font-family: var(--font-body); }
img { max-width: 100%; display: block; }
::-webkit-scrollbar { width: 5px; } 
::-webkit-scrollbar-track { background: var(--black); }
::-webkit-scrollbar-thumb { background: var(--gold-border); border-radius: 10px; }

/* ===== VIEWS ===== */
.view { display: none; }
.view.active { display: block; }

/* ===== NAVBAR ===== */
#navbar {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
  padding: 0 5vw;
  display: flex; align-items: center; justify-content: space-between;
  height: 72px;
  transition: transform 0.45s cubic-bezier(.4,0,.2,1), background 0.3s, backdrop-filter 0.3s;
  background: transparent;
}
#navbar.scrolled {
  background: rgba(7,11,20,0.85);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--gold-border);
}
#navbar.hidden { transform: translateY(-100%); }
.nav-logo {
  font-family: var(--font-display);
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  color: var(--gold);
  display: flex; align-items: center; gap: 8px;
}
.nav-logo span { color: var(--white); font-weight: 400; }
.nav-links { display: flex; gap: 2.5rem; list-style: none; }
.nav-links a {
  font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase;
  color: var(--muted); transition: color 0.2s;
  font-weight: 400;
}
.nav-links a:hover { color: var(--gold); }
.nav-cta {
  background: transparent; border: 1px solid var(--gold);
  color: var(--gold); padding: 9px 22px;
  font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase;
  font-weight: 500; transition: all 0.25s;
}
.nav-cta:hover { background: var(--gold); color: var(--black); }
.nav-hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
.nav-hamburger span { width: 22px; height: 1.5px; background: var(--white); transition: all 0.3s; }
.mobile-menu {
  display: none; position: fixed; top: 72px; left: 0; right: 0; bottom: 0;
  background: rgba(7,11,20,0.97); z-index: 999;
  flex-direction: column; align-items: center; justify-content: center; gap: 2rem;
}
.mobile-menu.open { display: flex; }
.mobile-menu a { font-size: 1.8rem; font-family: var(--font-serif); font-style: italic; color: var(--white); transition: color 0.2s; }
.mobile-menu a:hover { color: var(--gold); }

/* ===== HERO ===== */
#hero {
  position: relative; height: 100vh; min-height: 700px;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; overflow: hidden;
}
.hero-bg {
  position: absolute; inset: 0; z-index: 0;
  background:
    radial-gradient(ellipse 80% 60% at 50% 60%, rgba(212,175,55,0.06) 0%, transparent 70%),
    radial-gradient(ellipse 60% 80% at 20% 50%, rgba(15,23,42,0.9) 0%, transparent 60%),
    linear-gradient(180deg, rgba(7,11,20,0.3) 0%, rgba(7,11,20,0.6) 50%, rgba(7,11,20,0.95) 100%),
    url('https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=1800&q=80') center/cover no-repeat;
}
.hero-grain {
  position: absolute; inset: 0; z-index: 1; opacity: 0.04;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
}
.hero-content { position: relative; z-index: 2; max-width: 800px; padding: 0 2rem; }
.hero-badge {
  display: inline-flex; align-items: center; gap: 8px;
  border: 1px solid var(--gold-border); padding: 6px 16px;
  font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase;
  color: var(--gold); margin-bottom: 2rem;
  background: var(--gold-dim); backdrop-filter: blur(10px);
  animation: fadeUp 1s ease both 0.2s;
}
.hero-title {
  font-family: var(--font-display);
  font-size: clamp(2.8rem, 7vw, 5.5rem);
  font-weight: 700; line-height: 1.05; letter-spacing: 0.04em;
  color: var(--white); margin-bottom: 1.25rem;
  animation: fadeUp 1s ease both 0.4s;
}
.hero-title em { color: var(--gold); font-style: normal; }
.hero-subtitle {
  font-size: clamp(0.95rem, 1.8vw, 1.15rem);
  color: var(--muted); line-height: 1.7; max-width: 560px; margin: 0 auto 2.5rem;
  font-weight: 300; animation: fadeUp 1s ease both 0.6s;
}
.hero-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; animation: fadeUp 1s ease both 0.8s; }
.btn-primary {
  background: var(--gold); color: var(--black);
  padding: 14px 36px; font-size: 0.8rem;
  letter-spacing: 0.14em; text-transform: uppercase; font-weight: 600;
  transition: all 0.25s; position: relative; overflow: hidden;
}
.btn-primary::after {
  content: ''; position: absolute; inset: 0;
  background: rgba(255,255,255,0.15); transform: translateX(-100%);
  transition: transform 0.3s;
}
.btn-primary:hover::after { transform: translateX(0); }
.btn-secondary {
  background: transparent; border: 1px solid rgba(248,246,240,0.3);
  color: var(--white); padding: 14px 36px; font-size: 0.8rem;
  letter-spacing: 0.14em; text-transform: uppercase; font-weight: 400;
  transition: all 0.25s;
}
.btn-secondary:hover { border-color: var(--gold); color: var(--gold); }
.hero-scroll {
  position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
  z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 10px;
  animation: fadeIn 1.5s ease both 1.5s; cursor: pointer;
}
.hero-scroll:hover .scroll-mouse { border-color: var(--gold); }
.scroll-label {
  font-size: 0.6rem; letter-spacing: 0.28em; text-transform: uppercase;
  color: var(--muted); animation: scrollFloat 3s ease-in-out infinite;
}
.scroll-mouse {
  width: 24px; height: 38px;
  border: 1.5px solid rgba(212,175,55,0.5);
  border-radius: 12px; position: relative;
  transition: border-color 0.3s;
  animation: scrollFloat 3s ease-in-out infinite;
  box-shadow: 0 0 12px rgba(212,175,55,0.1);
}
.scroll-mouse::before {
  content: '';
  position: absolute; top: 7px; left: 50%; transform: translateX(-50%);
  width: 3px; height: 7px;
  background: var(--gold); border-radius: 2px;
  animation: scrollWheel 2s cubic-bezier(.4,0,.2,1) infinite;
  box-shadow: 0 0 6px rgba(212,175,55,0.6);
}
.scroll-mouse::after {
  content: '';
  position: absolute; inset: -4px; border-radius: 16px;
  border: 1px solid rgba(212,175,55,0.08);
  animation: scrollPulseRing 2s ease infinite;
}
@keyframes scrollWheel {
  0% { opacity: 1; transform: translateX(-50%) translateY(0); }
  60% { opacity: 0.2; transform: translateX(-50%) translateY(14px); }
  100% { opacity: 1; transform: translateX(-50%) translateY(0); }
}
@keyframes scrollFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}
@keyframes scrollPulseRing {
  0% { opacity: 0.3; transform: scale(1); }
  50% { opacity: 0; transform: scale(1.3); }
  100% { opacity: 0.3; transform: scale(1); }
}

/* ===== SECTIONS SHARED ===== */
.section { padding: 8rem 5vw; }
.section-label {
  font-size: 0.7rem; letter-spacing: 0.25em; text-transform: uppercase;
  color: var(--gold); margin-bottom: 1rem; display: flex; align-items: center; gap: 12px;
}
.section-label::before { content: ''; width: 40px; height: 1px; background: var(--gold); }
.section-title {
  font-family: var(--font-display); font-size: clamp(2rem, 4vw, 3.2rem);
  font-weight: 600; letter-spacing: 0.04em; line-height: 1.1;
}
.section-title em { color: var(--gold); font-style: normal; }
.section-sub { color: var(--muted); max-width: 520px; line-height: 1.7; margin-top: 1rem; font-size: 0.95rem; }

/* ===== CARS SECTION ===== */
#cars { background: linear-gradient(180deg, var(--black) 0%, var(--navy) 50%, var(--black) 100%); }
.cars-header { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 4rem; }
.cars-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2px; }
.car-card {
  position: relative; background: var(--glass-light); overflow: hidden;
  border: 1px solid rgba(255,255,255,0.05); transition: all 0.4s;
  cursor: pointer; group: true;
}
.car-card::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(180deg, transparent 40%, rgba(7,11,20,0.95) 100%);
  z-index: 1;
}
.car-card:hover { border-color: var(--gold-border); transform: translateY(-4px); }
.car-card:hover .car-img { transform: scale(1.06); }
.car-img {
  width: 100%; height: 220px; object-fit: cover;
  transition: transform 0.6s cubic-bezier(.4,0,.2,1);
}
.car-info { position: absolute; bottom: 0; left: 0; right: 0; z-index: 2; padding: 1.5rem; }
.car-category {
  font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase;
  color: var(--gold); margin-bottom: 0.4rem;
}
.car-name { font-family: var(--font-serif); font-size: 1.4rem; font-style: italic; margin-bottom: 0.75rem; }
.car-specs { display: flex; gap: 1rem; margin-bottom: 1rem; }
.car-spec { font-size: 0.75rem; color: var(--muted); display: flex; align-items: center; gap: 5px; }
.car-spec svg { width: 13px; height: 13px; fill: var(--gold); opacity: 0.7; }
.car-footer { display: flex; justify-content: space-between; align-items: center; }
.car-price { font-family: var(--font-display); font-size: 1.1rem; color: var(--gold); letter-spacing: 0.05em; }
.car-price sub { font-family: var(--font-body); font-size: 0.65rem; color: var(--muted); }
.car-btn {
  font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase;
  color: var(--white); border: 1px solid rgba(255,255,255,0.2);
  padding: 7px 14px; transition: all 0.2s;
}
.car-btn:hover { border-color: var(--gold); color: var(--gold); }
.status-badge {
  position: absolute; top: 1rem; right: 1rem; z-index: 3;
  font-size: 0.6rem; letter-spacing: 0.12em; text-transform: uppercase;
  padding: 4px 10px;
}
.status-available { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(52,211,153,0.3); }
.status-rented { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(248,113,113,0.3); }
.status-maintenance { background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(251,191,36,0.3); }

/* ===== PREMIUM EXPERIENCE SECTION ===== */
#services { background: var(--black); }
.experience-intro { text-align: center; max-width: 640px; margin: 0 auto 5rem; }
.experience-blocks { display: flex; flex-direction: column; gap: 0; }
.experience-block {
  display: grid; grid-template-columns: 1fr 1fr; gap: 0;
  border-top: 1px solid rgba(255,255,255,0.05);
  position: relative; overflow: hidden;
}
.experience-block:last-child { border-bottom: 1px solid rgba(255,255,255,0.05); }
.experience-block.reverse { direction: rtl; }
.experience-block.reverse > * { direction: ltr; }
.experience-visual {
  position: relative; aspect-ratio: 16/10; overflow: hidden;
  background: var(--navy);
}
.experience-visual img {
  width: 100%; height: 100%; object-fit: cover;
  transition: transform 0.8s cubic-bezier(.4,0,.2,1);
  filter: brightness(0.85);
}
.experience-block:hover .experience-visual img { transform: scale(1.04); }
.experience-visual-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(7,11,20,0.3) 0%, transparent 60%);
  z-index: 1;
}
.experience-body {
  padding: 4rem 4.5rem; display: flex; flex-direction: column;
  justify-content: center; position: relative;
  background: rgba(255,255,255,0.015);
}
.experience-body::before {
  content: ''; position: absolute; top: 0; bottom: 0;
  width: 1px; background: linear-gradient(to bottom, transparent, var(--gold-border), transparent);
  left: 0;
}
.experience-block.reverse .experience-body::before { left: auto; right: 0; }
.experience-number {
  font-family: var(--font-display); font-size: 0.65rem;
  letter-spacing: 0.3em; color: var(--gold); opacity: 0.6;
  margin-bottom: 1.25rem;
}
.experience-title {
  font-family: var(--font-display);
  font-size: clamp(1.3rem, 2.2vw, 1.85rem);
  letter-spacing: 0.04em; line-height: 1.2;
  margin-bottom: 1rem; font-weight: 600;
}
.experience-title em { color: var(--gold); font-style: normal; }
.experience-desc {
  font-size: 0.88rem; color: var(--muted); line-height: 1.8;
  max-width: 400px; margin-bottom: 1.5rem;
}
.experience-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; }
.experience-tag {
  font-size: 0.65rem; letter-spacing: 0.14em; text-transform: uppercase;
  border: 1px solid var(--gold-border); color: var(--gold);
  padding: 4px 12px; background: var(--gold-dim);
}

/* ===== ABOUT SECTION ===== */
#about { background: linear-gradient(135deg, var(--navy) 0%, var(--black) 100%); }
.about-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center; }
.about-img-wrap {
  position: relative; aspect-ratio: 3/4; max-height: 580px;
}
.about-img {
  width: 100%; height: 100%; object-fit: cover;
  border: 1px solid var(--gold-border);
}
.about-img-accent {
  position: absolute; bottom: -1.5rem; right: -1.5rem;
  width: 60%; height: 60%;
  border: 1px solid var(--gold); pointer-events: none; z-index: -1;
}
.about-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem; }
.stat { border-left: 2px solid var(--gold); padding-left: 1.25rem; }
.stat-num {
  font-family: var(--font-display); font-size: 2.5rem;
  color: var(--gold); line-height: 1; letter-spacing: 0.02em;
}
.stat-label { font-size: 0.75rem; color: var(--muted); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.4rem; }

/* ===== TESTIMONIALS ===== */
#testimonials { background: var(--black); overflow: hidden; }
.testi-track-wrap { overflow: hidden; margin-top: 3rem; position: relative; }
.testi-track-wrap::before, .testi-track-wrap::after {
  content: ''; position: absolute; top: 0; bottom: 0; width: 120px; z-index: 2; pointer-events: none;
}
.testi-track-wrap::before { left: 0; background: linear-gradient(to right, var(--black), transparent); }
.testi-track-wrap::after { right: 0; background: linear-gradient(to left, var(--black), transparent); }
.testi-track {
  display: flex; gap: 1.5rem;
  animation: marquee 40s linear infinite;
  width: max-content;
}
.testi-track:hover { animation-play-state: paused; }
@keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
.testi-card {
  background: var(--glass-light); border: 1px solid rgba(255,255,255,0.06);
  padding: 2rem; width: 320px; flex-shrink: 0; backdrop-filter: blur(10px);
}
.testi-stars { color: var(--gold); font-size: 0.85rem; margin-bottom: 1rem; letter-spacing: 2px; }
.testi-text { font-family: var(--font-serif); font-style: italic; font-size: 1.05rem; line-height: 1.65; color: rgba(248,246,240,0.85); margin-bottom: 1.5rem; }
.testi-author { display: flex; align-items: center; gap: 0.75rem; }
.testi-avatar {
  width: 40px; height: 40px; border-radius: 50%;
  border: 1px solid var(--gold-border); object-fit: cover;
  background: var(--gold-dim); display: flex; align-items: center; justify-content: center;
  font-family: var(--font-display); font-size: 0.75rem; color: var(--gold); overflow: hidden;
}
.testi-name { font-size: 0.85rem; font-weight: 500; }
.testi-role { font-size: 0.7rem; color: var(--muted); }

/* ===== CONTACT ===== */
#contact { background: var(--navy); }
.contact-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; }
.contact-info h2 { font-family: var(--font-display); font-size: clamp(2rem, 3.5vw, 2.8rem); letter-spacing: 0.04em; margin-bottom: 1rem; }
.contact-info p { color: var(--muted); line-height: 1.7; margin-bottom: 2rem; }
.contact-item { display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; }
.contact-item-icon {
  width: 40px; height: 40px; flex-shrink: 0;
  border: 1px solid var(--gold-border); background: var(--gold-dim);
  display: flex; align-items: center; justify-content: center;
  color: var(--gold);
}
.contact-item-icon svg { width: 18px; height: 18px; }
.contact-item-text { font-size: 0.85rem; color: var(--muted); line-height: 1.5; }
.contact-item-text strong { color: var(--white); display: block; margin-bottom: 2px; }
.wa-btn {
  display: inline-flex; align-items: center; gap: 10px;
  background: #25D366; color: #fff;
  padding: 14px 28px; font-size: 0.82rem;
  letter-spacing: 0.1em; text-transform: uppercase; font-weight: 600;
  transition: all 0.25s; margin-top: 1.5rem;
}
.wa-btn:hover { background: #128C7E; }
.map-placeholder {
  width: 100%; height: 320px; background: rgba(255,255,255,0.03);
  border: 1px solid var(--gold-border); display: flex; align-items: center; justify-content: center;
  flex-direction: column; gap: 1rem; color: var(--muted);
  font-size: 0.82rem; position: relative; overflow: hidden;
}
.map-placeholder iframe { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; filter: grayscale(80%) brightness(0.7); }

/* ===== FOOTER ===== */
footer {
  background: var(--black); border-top: 1px solid rgba(255,255,255,0.05);
  padding: 5rem 5vw 2rem;
}
.footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 4rem; }
.footer-brand-name { font-family: var(--font-display); font-size: 1.5rem; color: var(--gold); letter-spacing: 0.12em; margin-bottom: 1rem; }
.footer-brand-desc { font-size: 0.82rem; color: var(--muted); line-height: 1.7; max-width: 260px; }
.footer-col-title { font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); margin-bottom: 1.5rem; }
.footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.75rem; }
.footer-links a { font-size: 0.82rem; color: var(--muted); transition: color 0.2s; }
.footer-links a:hover { color: var(--white); }
.footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
.footer-copy { font-size: 0.75rem; color: var(--muted); }
.social-links { display: flex; gap: 1rem; }
.social-link {
  width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
  color: var(--muted); transition: all 0.2s; font-size: 0.75rem;
}
.social-link:hover { border-color: var(--gold); color: var(--gold); }

/* ===== FLOATING BUTTONS ===== */
.float-wa {
  position: fixed; bottom: 2rem; right: 2rem; z-index: 900;
  width: 52px; height: 52px; background: #25D366;
  display: flex; align-items: center; justify-content: center;
  border-radius: 50%; box-shadow: 0 8px 25px rgba(37,211,102,0.4);
  transition: all 0.25s; cursor: pointer;
}
.float-wa:hover { transform: scale(1.1); box-shadow: 0 12px 35px rgba(37,211,102,0.5); }
.float-wa svg { width: 26px; height: 26px; fill: white; }
.float-top {
  position: fixed; bottom: 2rem; right: 5.5rem; z-index: 900;
  width: 40px; height: 40px; border: 1px solid var(--gold-border);
  background: var(--glass); backdrop-filter: blur(10px);
  display: flex; align-items: center; justify-content: center;
  color: var(--gold); cursor: pointer; transition: all 0.25s;
  opacity: 0; pointer-events: none;
}
.float-top.visible { opacity: 1; pointer-events: auto; }
.float-top:hover { background: var(--gold); color: var(--black); }
.float-top svg { width: 16px; height: 16px; }

/* ===== DIVIDER LINE ===== */
.divider { width: 100%; height: 1px; background: linear-gradient(to right, transparent, var(--gold-border), transparent); }

/* ===== ANIMATIONS ===== */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
  from { opacity: 0; } to { opacity: 1; }
}
.reveal {
  opacity: 0; transform: translateY(40px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-left {
  opacity: 0; transform: translateX(-40px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}
.reveal-left.visible { opacity: 1; transform: translateX(0); }
.reveal-right {
  opacity: 0; transform: translateX(40px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}
.reveal-right.visible { opacity: 1; transform: translateX(0); }

/* ======================= */
/*   DASHBOARD STYLES      */
/* ======================= */
#view-dashboard { min-height: 100vh; background: var(--black); }
.dash-layout { display: flex; min-height: 100vh; }

/* SIDEBAR */
.dash-sidebar {
  width: var(--sidebar-w); flex-shrink: 0;
  background: rgba(9,13,22,0.97); border-right: 1px solid rgba(255,255,255,0.05);
  display: flex; flex-direction: column;
  position: fixed; top: 0; bottom: 0; left: 0; z-index: 800;
  transition: transform 0.35s;
}
.dash-sidebar.closed { transform: translateX(-100%); }
.sidebar-header {
  padding: 1.75rem 1.5rem;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  display: flex; align-items: center; justify-content: space-between;
}
.sidebar-logo { font-family: var(--font-display); font-size: 1.25rem; color: var(--gold); letter-spacing: 0.1em; }
.sidebar-logo span { color: rgba(255,255,255,0.5); font-weight: 400; }
.sidebar-close { color: var(--muted); display: none; cursor: pointer; }
.sidebar-close:hover { color: var(--white); }
.sidebar-nav { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
.sidebar-section-label {
  padding: 0 1.5rem; font-size: 0.6rem; letter-spacing: 0.2em;
  text-transform: uppercase; color: rgba(255,255,255,0.25);
  margin-bottom: 0.5rem; margin-top: 1.5rem;
}
.sidebar-section-label:first-child { margin-top: 0; }
.sidebar-item {
  display: flex; align-items: center; gap: 0.85rem;
  padding: 0.75rem 1.5rem; font-size: 0.82rem; color: var(--muted);
  cursor: pointer; transition: all 0.2s; position: relative;
  border-left: 2px solid transparent;
}
.sidebar-item svg { width: 17px; height: 17px; flex-shrink: 0; }
.sidebar-item:hover { color: var(--white); background: var(--glass-light); border-left-color: rgba(212,175,55,0.3); }
.sidebar-item.active { color: var(--gold); background: var(--gold-dim); border-left-color: var(--gold); }
.sidebar-badge {
  margin-left: auto; background: var(--gold-dim); color: var(--gold);
  font-size: 0.65rem; padding: 2px 8px; border-radius: 0;
  border: 1px solid var(--gold-border);
}
.sidebar-footer {
  padding: 1.25rem 1.5rem;
  border-top: 1px solid rgba(255,255,255,0.05);
  display: flex; align-items: center; gap: 0.75rem;
  font-size: 0.78rem; color: var(--muted);
}
.sidebar-avatar {
  width: 34px; height: 34px;
  background: var(--gold-dim); border: 1px solid var(--gold-border);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-display); font-size: 0.7rem; color: var(--gold);
}
.sidebar-user-name { color: var(--white); font-size: 0.82rem; }
.sidebar-user-role { font-size: 0.65rem; color: var(--gold); letter-spacing: 0.08em; }

/* MAIN CONTENT */
.dash-main {
  flex: 1; margin-left: var(--sidebar-w);
  min-height: 100vh; display: flex; flex-direction: column;
}
.dash-topbar {
  height: 60px; background: rgba(9,13,22,0.97);
  border-bottom: 1px solid rgba(255,255,255,0.05);
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 2rem; position: sticky; top: 0; z-index: 700;
}
.topbar-left { display: flex; align-items: center; gap: 1rem; }
.topbar-menu-btn {
  display: none; color: var(--muted); cursor: pointer; padding: 6px;
  transition: color 0.2s;
}
.topbar-menu-btn:hover { color: var(--white); }
.topbar-menu-btn svg { width: 20px; height: 20px; }
.topbar-breadcrumb { font-size: 0.8rem; color: var(--muted); }
.topbar-breadcrumb strong { color: var(--white); font-weight: 500; }
.topbar-right { display: flex; align-items: center; gap: 1.5rem; }
.topbar-back {
  font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase;
  color: var(--muted); display: flex; align-items: center; gap: 6px;
  cursor: pointer; transition: color 0.2s;
}
.topbar-back:hover { color: var(--gold); }
.topbar-back svg { width: 14px; height: 14px; }
.dash-content { flex: 1; padding: 2rem; }

/* OVERVIEW PAGE */
.stat-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1px; margin-bottom: 2rem; }
.stat-card {
  background: rgba(255,255,255,0.025); border: 1px solid rgba(255,255,255,0.06);
  padding: 1.75rem 2rem; transition: border-color 0.2s, background 0.2s;
  display: flex; flex-direction: column; gap: 0; position: relative; overflow: hidden;
  min-height: 130px;
}
.stat-card:hover { border-color: var(--gold-border); background: rgba(212,175,55,0.03); }
.stat-card-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1rem; }
.stat-card-label {
  font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase;
  color: var(--muted); font-weight: 400; line-height: 1.4;
}
.stat-card-icon {
  width: 38px; height: 38px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  background: var(--gold-dim); border: 1px solid var(--gold-border);
  color: var(--gold);
}
.stat-card-icon svg { width: 18px; height: 18px; }
.stat-card-val {
  font-family: var(--font-display); font-size: 2.4rem;
  color: var(--white); line-height: 1; letter-spacing: 0.02em;
  margin-bottom: 0.4rem;
}
.stat-card-sub { font-size: 0.72rem; color: var(--gold); letter-spacing: 0.06em; }

/* TABLES */
.page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
.page-title { font-family: var(--font-display); font-size: 1.6rem; letter-spacing: 0.06em; }
.page-title span { color: var(--gold); }
.btn-add {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--gold); color: var(--black);
  padding: 10px 20px; font-size: 0.75rem;
  letter-spacing: 0.1em; text-transform: uppercase; font-weight: 600;
  transition: all 0.2s;
}
.btn-add:hover { background: var(--gold-light); }
.btn-add svg { width: 15px; height: 15px; }
.table-toolbar {
  display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
  background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
  padding: 1rem 1.25rem; margin-bottom: 2px;
}
.search-input {
  flex: 1; min-width: 200px; background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.08); color: var(--white);
  padding: 8px 14px 8px 36px; font-size: 0.82rem;
  transition: border-color 0.2s; position: relative;
}
.search-input:focus { outline: none; border-color: var(--gold-border); }
.search-wrap { position: relative; flex: 1; min-width: 200px; }
.search-wrap svg {
  position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
  width: 15px; height: 15px; color: var(--muted); pointer-events: none;
}
.filter-select {
  background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
  color: var(--white); padding: 8px 14px; font-size: 0.78rem;
  cursor: pointer; transition: border-color 0.2s;
}
.filter-select:focus { outline: none; border-color: var(--gold-border); }
.filter-select option { background: var(--navy); }
.data-table { width: 100%; border-collapse: collapse; }
.data-table th {
  text-align: left; padding: 1rem 1.25rem;
  font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase;
  color: var(--gold); background: rgba(212,175,55,0.04);
  border-bottom: 1px solid var(--gold-border); font-weight: 500;
}
.data-table td {
  padding: 1rem 1.25rem; font-size: 0.82rem; color: rgba(248,246,240,0.8);
  border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle;
  transition: background 0.15s;
}
.data-table tr:hover td { background: rgba(255,255,255,0.02); }
.table-wrap { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); overflow-x: auto; }
.car-thumb { width: 64px; height: 44px; object-fit: cover; border: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.03); }
.car-thumb-placeholder {
  width: 64px; height: 44px; background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.08); display: flex;
  align-items: center; justify-content: center; color: var(--muted); font-size: 0.65rem;
}
.action-btn {
  padding: 5px 12px; font-size: 0.7rem; letter-spacing: 0.08em; text-transform: uppercase;
  transition: all 0.2s; cursor: pointer; margin-right: 6px;
}
.btn-edit { border: 1px solid var(--gold-border); color: var(--gold); background: transparent; }
.btn-edit:hover { background: var(--gold); color: var(--black); }
.btn-delete { border: 1px solid rgba(239,68,68,0.3); color: #f87171; background: transparent; }
.btn-delete:hover { background: rgba(239,68,68,0.1); }
.placeholder-page {
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  min-height: 60vh; text-align: center; gap: 1rem;
}
.placeholder-icon { color: var(--gold-border); margin-bottom: 0.5rem; }
.placeholder-icon svg { width: 64px; height: 64px; }
.placeholder-title { font-family: var(--font-display); font-size: 1.8rem; color: var(--muted); }
.placeholder-sub { font-size: 0.85rem; color: rgba(255,255,255,0.2); max-width: 360px; line-height: 1.6; }

/* MODAL */
.modal-overlay {
  position: fixed; inset: 0; z-index: 2000;
  background: rgba(7,11,20,0.85); backdrop-filter: blur(8px);
  display: flex; align-items: center; justify-content: center;
  padding: 1.5rem; opacity: 0; pointer-events: none;
  transition: opacity 0.25s;
}
.modal-overlay.open { opacity: 1; pointer-events: auto; }
.modal {
  background: #0D1421; border: 1px solid var(--gold-border);
  width: 100%; max-width: 580px; max-height: 90vh; overflow-y: auto;
  transform: translateY(20px); transition: transform 0.3s;
}
.modal-overlay.open .modal { transform: translateY(0); }
.modal-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.07);
}
.modal-title { font-family: var(--font-display); font-size: 1.1rem; letter-spacing: 0.06em; }
.modal-title span { color: var(--gold); }
.modal-close {
  width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
  border: 1px solid rgba(255,255,255,0.1); color: var(--muted);
  cursor: pointer; transition: all 0.2s; font-size: 1.1rem;
}
.modal-close:hover { border-color: var(--gold); color: var(--gold); }
.modal-body { padding: 2rem; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
.form-group { margin-bottom: 1.25rem; }
.form-group.full { grid-column: 1 / -1; }
.form-label { font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.5rem; display: block; }
.form-input {
  width: 100%; background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08); color: var(--white);
  padding: 10px 14px; font-size: 0.85rem; transition: border-color 0.2s;
}
.form-input:focus { outline: none; border-color: var(--gold-border); }
.form-input::placeholder { color: rgba(255,255,255,0.2); }
.form-select {
  width: 100%; background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08); color: var(--white);
  padding: 10px 14px; font-size: 0.85rem; cursor: pointer;
}
.form-select:focus { outline: none; border-color: var(--gold-border); }
.form-select option { background: var(--navy); }
.form-textarea {
  width: 100%; background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08); color: var(--white);
  padding: 10px 14px; font-size: 0.85rem; resize: vertical;
  min-height: 90px; transition: border-color 0.2s;
}
.form-textarea:focus { outline: none; border-color: var(--gold-border); }
.form-textarea::placeholder { color: rgba(255,255,255,0.2); }
.modal-footer {
  padding: 1.25rem 2rem; border-top: 1px solid rgba(255,255,255,0.07);
  display: flex; justify-content: flex-end; gap: 0.75rem;
}
.btn-cancel {
  padding: 10px 22px; font-size: 0.75rem; letter-spacing: 0.1em;
  text-transform: uppercase; border: 1px solid rgba(255,255,255,0.12);
  color: var(--muted); background: transparent; transition: all 0.2s; cursor: pointer;
}
.btn-cancel:hover { border-color: var(--white); color: var(--white); }
.btn-save {
  padding: 10px 28px; font-size: 0.75rem; letter-spacing: 0.12em;
  text-transform: uppercase; background: var(--gold); color: var(--black);
  font-weight: 600; transition: all 0.2s; cursor: pointer; border: none;
}
.btn-save:hover { background: var(--gold-light); }

/* TOAST */
.toast-container { position: fixed; top: 1.5rem; right: 1.5rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.5rem; }
.toast {
  background: var(--charcoal); border-left: 3px solid var(--gold);
  padding: 0.875rem 1.25rem; font-size: 0.82rem;
  display: flex; align-items: center; gap: 0.75rem;
  box-shadow: 0 8px 24px rgba(0,0,0,0.4);
  animation: toastIn 0.3s ease both;
  min-width: 260px; max-width: 340px;
}
.toast.success { border-color: #34d399; }
.toast.error { border-color: #f87171; }
@keyframes toastIn { from { opacity:0; transform: translateX(20px); } to { opacity:1; transform: translateX(0); } }
.toast-icon { flex-shrink: 0; }
.toast-icon.success { color: #34d399; }
.toast-icon.error { color: #f87171; }
.toast-icon.info { color: var(--gold); }
.toast-icon svg { width: 16px; height: 16px; }

/* Confirm Dialog */
.confirm-dialog {
  background: #0D1421; border: 1px solid rgba(239,68,68,0.4);
  padding: 2rem; max-width: 380px; width: 100%;
  text-align: center; transform: scale(0.95);
  transition: transform 0.2s;
}
.modal-overlay.open .confirm-dialog { transform: scale(1); }
.confirm-icon { color: #f87171; margin-bottom: 1rem; }
.confirm-icon svg { width: 40px; height: 40px; }
.confirm-title { font-family: var(--font-display); font-size: 1.1rem; margin-bottom: 0.5rem; }
.confirm-msg { font-size: 0.82rem; color: var(--muted); margin-bottom: 2rem; line-height: 1.5; }
.confirm-actions { display: flex; gap: 0.75rem; justify-content: center; }
.btn-confirm-del {
  padding: 10px 24px; font-size: 0.75rem; letter-spacing: 0.1em;
  text-transform: uppercase; background: rgba(239,68,68,0.15);
  border: 1px solid rgba(239,68,68,0.4); color: #f87171;
  cursor: pointer; transition: all 0.2s;
}
.btn-confirm-del:hover { background: rgba(239,68,68,0.25); }

/* EMPTY STATE */
.empty-state {
  text-align: center; padding: 4rem 2rem;
  color: var(--muted); font-size: 0.85rem;
}
.empty-state svg { width: 48px; height: 48px; color: rgba(255,255,255,0.1); margin: 0 auto 1rem; display: block; }

/* TABLE PAGINATION */
.table-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 1.25rem; background: rgba(255,255,255,0.02);
  border-top: 1px solid rgba(255,255,255,0.04); font-size: 0.75rem; color: var(--muted);
  flex-wrap: wrap; gap: 0.75rem;
}
.pagination { display: flex; gap: 4px; }
.page-btn {
  width: 30px; height: 30px; border: 1px solid rgba(255,255,255,0.1);
  color: var(--muted); display: flex; align-items: center; justify-content: center;
  font-size: 0.75rem; cursor: pointer; transition: all 0.2s; background: transparent;
}
.page-btn.active { border-color: var(--gold); color: var(--gold); background: var(--gold-dim); }
.page-btn:hover:not(.active) { border-color: rgba(255,255,255,0.2); color: var(--white); }

/* CHART MINI */
.mini-charts { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5px; margin-bottom: 2rem; }
.chart-card {
  background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
  padding: 1.5rem;
}
.chart-card-title { font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); margin-bottom: 1rem; }
.bar-chart { display: flex; align-items: flex-end; gap: 6px; height: 80px; }
.bar { flex: 1; background: linear-gradient(to top, var(--gold), rgba(212,175,55,0.2)); border-radius: 0; min-width: 8px; position: relative; transition: opacity 0.2s; }
.bar:hover { opacity: 0.8; }
.donut-chart { width: 80px; height: 80px; margin: 0 auto; position: relative; }
.donut-chart svg { transform: rotate(-90deg); }
.donut-center { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.1rem; color: var(--gold); }

/* MOBILE RESPONSIVE */
@media (max-width: 900px) {
  .about-inner, .contact-inner { grid-template-columns: 1fr; }
  .about-img-wrap { aspect-ratio: 16/9; max-height: 320px; }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .nav-links, .nav-cta { display: none; }
  .nav-hamburger { display: flex; }
  .mini-charts { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
  .dash-sidebar { transform: translateX(-100%); }
  .dash-sidebar.open { transform: translateX(0); }
  .dash-main { margin-left: 0; }
  .topbar-menu-btn { display: flex; }
  .sidebar-close { display: flex; }
  .form-row { grid-template-columns: 1fr; }
  .about-stats { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 480px) {
  .section { padding: 5rem 1.5rem; }
  .footer-grid { grid-template-columns: 1fr; }
  .hero-actions { flex-direction: column; align-items: center; }
  .hero-actions button, .hero-actions a { width: 100%; max-width: 280px; text-align: center; }
}
</style>
</head>
<body>

<!-- TOAST CONTAINER -->
<div class="toast-container" id="toastContainer"></div>

<!-- FLOATING BUTTONS -->
<a href="https://wa.me/6281234567890" class="float-wa" target="_blank" aria-label="WhatsApp">
  <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>
<button class="float-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18,15 12,9 6,15"/></svg>
</button>

<!-- ========================== -->
<!--        LANDING VIEW        -->
<!-- ========================== -->
<div id="view-landing" class="view active">

  <!-- NAVBAR -->
  <nav id="navbar">
    <div class="nav-logo" onclick="showView('landing')" style="cursor:pointer">
      SU<span>RIDE</span>
      <svg width="8" height="8" viewBox="0 0 8 8" style="margin-left:2px"><circle cx="4" cy="4" r="4" fill="#D4AF37"/></svg>
    </div>
    <ul class="nav-links">
      <li><a href="#hero">Home</a></li>
      <li><a href="#cars">Cars</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <button class="nav-cta" onclick="showView('dashboard')">Dashboard</button>
    <div class="nav-hamburger" id="hamburger" onclick="toggleMobileMenu()">
      <span></span><span></span><span></span>
    </div>
  </nav>
  <div class="mobile-menu" id="mobileMenu">
    <a href="#hero" onclick="toggleMobileMenu()">Home</a>
    <a href="#cars" onclick="toggleMobileMenu()">Cars</a>
    <a href="#services" onclick="toggleMobileMenu()">Services</a>
    <a href="#about" onclick="toggleMobileMenu()">About</a>
    <a href="#contact" onclick="toggleMobileMenu()">Contact</a>
    <button class="btn-primary" onclick="showView('dashboard');toggleMobileMenu()" style="margin-top:1rem">Dashboard</button>
  </div>

  <!-- HERO -->
  <section id="hero">
    <div class="hero-bg"></div>
    <div class="hero-grain"></div>
    <div class="hero-content">
      <div class="hero-badge">
        <svg width="10" height="10" viewBox="0 0 10 10"><circle cx="5" cy="5" r="5" fill="currentColor"/></svg>
        Surabaya's Premier Luxury Fleet
      </div>
      <h1 class="hero-title">Premium Car Rental<br>in <em>Surabaya</em></h1>
      <p class="hero-subtitle">Luxury vehicles for business, airport transfer, weddings, and city travel. Experience the road differently.</p>
      <div class="hero-actions">
        <button class="btn-primary" onclick="document.getElementById('cars').scrollIntoView({behavior:'smooth'})">Explore Cars</button>
        <a href="https://wa.me/6281234567890" class="btn-secondary">Book via WhatsApp</a>
      </div>
    </div>
    <div class="hero-scroll" onclick="document.getElementById('cars').scrollIntoView({behavior:'smooth'})">
      <div class="scroll-mouse"></div>
      <span class="scroll-label">Scroll</span>
    </div>
  </section>

  <!-- FEATURED CARS -->
  <section class="section" id="cars">
    <div class="cars-header">
      <div>
        <div class="section-label reveal">Our Fleet</div>
        <h2 class="section-title reveal">Handpicked <em>Luxury</em><br>Vehicles</h2>
      </div>
      <p class="section-sub reveal" style="max-width:360px">Every vehicle in our collection is maintained to the highest standard for your comfort and safety.</p>
    </div>
    <div class="cars-grid" id="landingCarsGrid">
      <!-- populated by JS -->
    </div>
  </section>

  <div class="divider"></div>

  <!-- PREMIUM EXPERIENCE -->
  <section class="section" id="services">
    <div class="experience-intro">
      <div class="section-label reveal" style="justify-content:center">The SuRide Experience</div>
      <h2 class="section-title reveal">More Than a Rental.<br>A <em>Premium</em> Journey.</h2>
      <p class="section-sub reveal" style="margin:1rem auto 0">From elegant wedding convoys to executive boardroom arrivals — every SuRide rental is crafted around your comfort, flexibility, and prestige.</p>
    </div>
    <div class="experience-blocks">

      <!-- Block 1: Wedding -->
      <div class="experience-block reveal">
        <div class="experience-visual">
          <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=900&q=80" alt="Wedding Car Rental" loading="lazy" />
          <div class="experience-visual-overlay"></div>
        </div>
        <div class="experience-body">
          <div class="experience-number">01 &mdash; OCCASION</div>
          <h3 class="experience-title">Wedding Car<br><em>Rental</em></h3>
          <p class="experience-desc">Arrive at your most important day in absolute elegance. Our curated selection of luxury vehicles transforms your wedding convoy into a cinematic moment — impeccably maintained, beautifully presented, and tailored to your vision.</p>
          <div class="experience-tags">
            <span class="experience-tag">Sedan & SUV</span>
            <span class="experience-tag">Full-Day Rental</span>
            <span class="experience-tag">Ribbon & Décor</span>
          </div>
        </div>
      </div>

      <!-- Block 2: Corporate -->
      <div class="experience-block reverse reveal">
        <div class="experience-visual">
          <img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=900&q=80" alt="Corporate Transport" loading="lazy" />
          <div class="experience-visual-overlay"></div>
        </div>
        <div class="experience-body">
          <div class="experience-number">02 &mdash; BUSINESS</div>
          <h3 class="experience-title">Corporate<br><em>Transport</em></h3>
          <p class="experience-desc">Impress clients and move executives in style. Our premium fleet is the vehicle of choice for business meetings, roadshows, company events, and airport-bound executives who expect more than standard transport.</p>
          <div class="experience-tags">
            <span class="experience-tag">Executive Fleet</span>
            <span class="experience-tag">Multi-Day Plans</span>
            <span class="experience-tag">Invoice Ready</span>
          </div>
        </div>
      </div>

      <!-- Block 3: Pickup & Delivery -->
      <div class="experience-block reveal">
        <div class="experience-visual">
          <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80" alt="Car Delivery Service" loading="lazy" />
          <div class="experience-visual-overlay"></div>
        </div>
        <div class="experience-body">
          <div class="experience-number">03 &mdash; CONVENIENCE</div>
          <h3 class="experience-title">Flexible Pickup<br>&amp; <em>Delivery</em></h3>
          <p class="experience-desc">Your schedule, your location. Choose to collect your vehicle from our Surabaya showroom, or request white-glove delivery directly to your home, office, or hotel. Either way, your rental begins on your terms.</p>
          <div class="experience-tags">
            <span class="experience-tag">Self Pickup</span>
            <span class="experience-tag">Car Delivery</span>
            <span class="experience-tag">Optional Driver</span>
          </div>
        </div>
      </div>

      <!-- Block 4: Premium Fleet -->
      <div class="experience-block reverse reveal">
        <div class="experience-visual">
          <img src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=900&q=80" alt="Premium Vehicle Interior" loading="lazy" />
          <div class="experience-visual-overlay"></div>
        </div>
        <div class="experience-body">
          <div class="experience-number">04 &mdash; QUALITY</div>
          <h3 class="experience-title">Premium Vehicle<br><em>Experience</em></h3>
          <p class="experience-desc">Every vehicle in our fleet undergoes rigorous inspection before each rental. Spotless interiors, reliable performance, and that distinct luxury feel — because you deserve nothing less every single time you ride.</p>
          <div class="experience-tags">
            <span class="experience-tag">Inspected Daily</span>
            <span class="experience-tag">Premium Interiors</span>
            <span class="experience-tag">24/7 Support</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <div class="divider"></div>

  <!-- ABOUT -->
  <section class="section" id="about">
    <div class="about-inner">
      <div class="about-img-wrap reveal-left">
        <img class="about-img" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80" alt="SuRide luxury fleet" loading="lazy" />
        <div class="about-img-accent"></div>
      </div>
      <div class="reveal-right">
        <div class="section-label">Our Story</div>
        <h2 class="section-title">Redefining Luxury<br>Mobility in <em>Surabaya</em></h2>
        <p class="section-sub" style="margin-bottom:1.5rem">SuRide was founded with a singular vision: to bring world-class luxury transportation to Surabaya. We believe getting there should be as memorable as the destination itself.</p>
        <p style="color:var(--muted);font-size:0.88rem;line-height:1.75">From our meticulously curated fleet of premium vehicles to our rigorously trained chauffeurs, every detail is considered. Whether you need a quick city transfer or a full-day corporate itinerary, SuRide delivers the extraordinary.</p>
        <div class="about-stats">
          <div class="stat">
            <div class="stat-num" data-target="500">0</div>
            <div class="stat-label">Happy Customers</div>
          </div>
          <div class="stat">
            <div class="stat-num" data-target="24">0</div>
            <div class="stat-label">Vehicles Available</div>
          </div>
          <div class="stat">
            <div class="stat-num" data-target="5">0</div>
            <div class="stat-label">Years Experience</div>
          </div>
          <div class="stat">
            <div class="stat-num" data-target="1200">0</div>
            <div class="stat-label">Completed Trips</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <!-- TESTIMONIALS -->
  <section class="section" id="testimonials" style="padding-bottom:6rem">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="section-label reveal" style="justify-content:center">What Clients Say</div>
      <h2 class="section-title reveal" style="text-align:center">Trusted by <em>Surabaya's</em> Elite</h2>
    </div>
    <div class="testi-track-wrap">
      <div class="testi-track" id="testiTrack">
        <!-- testimonials duplicated by JS for infinite loop -->
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <!-- CONTACT -->
  <section class="section" id="contact">
    <div class="contact-inner">
      <div class="reveal-left">
        <div class="section-label">Get In Touch</div>
        <h2 style="font-family:var(--font-display);font-size:clamp(2rem,3.5vw,2.8rem);letter-spacing:.04em;margin-bottom:1rem">Ready to<br><em style="color:var(--gold);font-style:normal">Experience</em> SuRide?</h2>
        <p style="color:var(--muted);line-height:1.7;margin-bottom:2rem;font-size:0.88rem">Contact us via WhatsApp for instant booking or reach us through our office. Available 24/7 for your transportation needs.</p>
        <div class="contact-item">
          <div class="contact-item-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
          </div>
          <div class="contact-item-text">
            <strong>Office Address</strong>
            Jl. Raya Darmo No. 88, Wonokromo, Surabaya, Jawa Timur 60241
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-item-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          </div>
          <div class="contact-item-text">
            <strong>WhatsApp</strong>
            +62 812-3456-7890 (24/7 Support)
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-item-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div class="contact-item-text">
            <strong>Email</strong>
            hello@suride.id
          </div>
        </div>
        <a href="https://wa.me/6281234567890" class="wa-btn" target="_blank">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          Chat on WhatsApp
        </a>
      </div>
      <div class="reveal-right">
        <div class="map-placeholder">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.39878088994!2d112.60815615!3d-7.2574719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x37636f8a9a72e42e!2sSurabaya%2C%20East%20Java%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1717000000000!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div style="display:flex;gap:0.75rem;margin-top:1.5rem">
          <a href="https://instagram.com/suride.id" class="social-link" target="_blank" style="width:auto;padding:0 1rem;gap:8px;font-size:0.75rem;letter-spacing:0.1em">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            @suride.id
          </a>
          <a href="#" class="social-link" style="width:auto;padding:0 1rem;gap:8px;font-size:0.75rem;letter-spacing:0.1em">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            SuRide
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div>
        <div class="footer-brand-name">SURIDE</div>
        <p class="footer-brand-desc">Premium luxury car rental service based in Surabaya, Indonesia. Elevating your journey, one ride at a time.</p>
        <div class="social-links" style="margin-top:1.5rem">
          <a href="#" class="social-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="#" class="social-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
          </a>
          <a href="#" class="social-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.85 4.85 0 01-1.01-.06z"/></svg>
          </a>
        </div>
      </div>
      <div>
        <div class="footer-col-title">Navigation</div>
        <ul class="footer-links">
          <li><a href="#hero">Home</a></li>
          <li><a href="#cars">Our Fleet</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Services</div>
        <ul class="footer-links">
          <li><a href="#">Airport Transfer</a></li>
          <li><a href="#">Wedding Car</a></li>
          <li><a href="#">Corporate Travel</a></li>
          <li><a href="#">City Tour</a></li>
          <li><a href="#">Chauffeur Service</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Legal</div>
        <ul class="footer-links">
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Refund Policy</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="footer-copy">&copy; 2026 SuRide. All rights reserved. Surabaya, Indonesia.</p>
      <p class="footer-copy" style="color:rgba(255,255,255,0.15)">Crafted with precision for the discerning traveller.</p>
    </div>
  </footer>

</div><!-- /view-landing -->

<!-- ========================== -->
<!--       DASHBOARD VIEW       -->
<!-- ========================== -->
<div id="view-dashboard" class="view">
  <div class="dash-layout">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar" id="dashSidebar">
      <div class="sidebar-header">
        <div class="sidebar-logo">SU<span>RIDE</span></div>
        <div class="sidebar-close" onclick="closeSidebar()">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </div>
      </div>
      <nav class="sidebar-nav">
        <div class="sidebar-section-label">Main</div>
        <div class="sidebar-item active" onclick="dashNav('overview',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
          Overview
        </div>
        <div class="sidebar-section-label">Management</div>
        <div class="sidebar-item" onclick="dashNav('cars',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3"/><rect x="9" y="11" width="14" height="10" rx="1"/><circle cx="12" cy="21" r="1"/><circle cx="20" cy="21" r="1"/></svg>
          Cars
          <span class="sidebar-badge" id="badgeCars">0</span>
        </div>
        <div class="sidebar-item" onclick="dashNav('categories',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
          Categories
          <span class="sidebar-badge" id="badgeCats">0</span>
        </div>
        <div class="sidebar-item" onclick="dashNav('drivers',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          Drivers
          <span class="sidebar-badge" id="badgeDrivers">0</span>
        </div>
        <div class="sidebar-section-label">Coming Soon</div>
        <div class="sidebar-item" onclick="dashNav('rentals',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
          Rentals
        </div>
        <div class="sidebar-item" onclick="dashNav('payments',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          Payments
        </div>
        <div class="sidebar-item" onclick="dashNav('users',this)">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
          Users
        </div>
      </nav>
      <div class="sidebar-footer">
        <div class="sidebar-avatar">AD</div>
        <div>
          <div class="sidebar-user-name">Admin</div>
          <div class="sidebar-user-role">Administrator</div>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="dash-main">
      <div class="dash-topbar">
        <div class="topbar-left">
          <div class="topbar-menu-btn" onclick="openSidebar()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </div>
          <div class="topbar-breadcrumb">SuRide / <strong id="breadcrumbText">Overview</strong></div>
        </div>
        <div class="topbar-right">
          <div class="topbar-back" onclick="showView('landing')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15,18 9,12 15,6"/></svg>
            Back to Site
          </div>
        </div>
      </div>

      <div class="dash-content">

        <!-- OVERVIEW PAGE -->
        <div id="dash-overview" class="dash-page">
          <div class="page-header">
            <h1 class="page-title">Dashboard <span>Overview</span></h1>
            <span style="font-size:0.75rem;color:var(--muted)" id="dashDateTime"></span>
          </div>
          <div class="stat-cards">
            <div class="stat-card">
              <div class="stat-card-header">
                <div class="stat-card-label">Total Cars</div>
                <div class="stat-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3"/><rect x="9" y="11" width="14" height="10" rx="1"/><circle cx="12" cy="21" r="1"/><circle cx="20" cy="21" r="1"/></svg></div>
              </div>
              <div class="stat-card-val" id="ovTotalCars">0</div>
              <div class="stat-card-sub">In fleet</div>
            </div>
            <div class="stat-card">
              <div class="stat-card-header">
                <div class="stat-card-label">Available Cars</div>
                <div class="stat-card-icon" style="color:#34d399;border-color:rgba(52,211,153,0.3);background:rgba(52,211,153,0.08)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg></div>
              </div>
              <div class="stat-card-val" id="ovAvailCars">0</div>
              <div class="stat-card-sub" style="color:#34d399">Ready now</div>
            </div>
            <div class="stat-card">
              <div class="stat-card-header">
                <div class="stat-card-label">Total Drivers</div>
                <div class="stat-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
              </div>
              <div class="stat-card-val" id="ovTotalDrivers">0</div>
              <div class="stat-card-sub">On roster</div>
            </div>
            <div class="stat-card">
              <div class="stat-card-header">
                <div class="stat-card-label">Categories</div>
                <div class="stat-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6h16M4 12h16M4 18h7"/></svg></div>
              </div>
              <div class="stat-card-val" id="ovTotalCats">0</div>
              <div class="stat-card-sub">Car types</div>
            </div>
          </div>
          <div class="mini-charts">
            <div class="chart-card">
              <div class="chart-card-title">Fleet Status</div>
              <div style="display:flex;align-items:center;gap:2rem">
                <div class="donut-chart">
                  <svg width="80" height="80" viewBox="0 0 80 80">
                    <circle cx="40" cy="40" r="30" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="12"/>
                    <circle cx="40" cy="40" r="30" fill="none" stroke="#34d399" stroke-width="12" stroke-dasharray="0 188.4" id="donutAvail" stroke-linecap="butt"/>
                    <circle cx="40" cy="40" r="30" fill="none" stroke="#f87171" stroke-width="12" stroke-dasharray="0 188.4" id="donutRented" stroke-linecap="butt"/>
                    <circle cx="40" cy="40" r="30" fill="none" stroke="#fbbf24" stroke-width="12" stroke-dasharray="0 188.4" id="donutMaint" stroke-linecap="butt"/>
                  </svg>
                  <div class="donut-center" id="donutCenter">–</div>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.75rem">
                  <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;background:#34d399;display:inline-block"></span><span style="color:var(--muted)">Available</span></div>
                  <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;background:#f87171;display:inline-block"></span><span style="color:var(--muted)">Rented</span></div>
                  <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;background:#fbbf24;display:inline-block"></span><span style="color:var(--muted)">Maintenance</span></div>
                </div>
              </div>
            </div>
            <div class="chart-card">
              <div class="chart-card-title">Cars by Category</div>
              <div class="bar-chart" id="categoryBarChart"></div>
              <div style="font-size:0.65rem;color:var(--muted);margin-top:6px" id="barChartLegend"></div>
            </div>
          </div>
          <div class="table-wrap" style="margin-top:0">
            <table class="data-table">
              <thead><tr><th>Car</th><th>Brand / Model</th><th>Category</th><th>Price/Day</th><th>Status</th></tr></thead>
              <tbody id="overviewTableBody"></tbody>
            </table>
          </div>
        </div>

        <!-- CARS PAGE -->
        <div id="dash-cars" class="dash-page" style="display:none">
          <div class="page-header">
            <h1 class="page-title">Manage <span>Cars</span></h1>
            <button class="btn-add" onclick="openCarModal()">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Add Car
            </button>
          </div>
          <div class="table-toolbar">
            <div class="search-wrap">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              <input type="text" class="search-input" id="carSearch" placeholder="Search by name, brand, model..." oninput="renderCarsTable()" />
            </div>
            <select class="filter-select" id="carFilterCat" onchange="renderCarsTable()">
              <option value="">All Categories</option>
            </select>
            <select class="filter-select" id="carFilterStatus" onchange="renderCarsTable()">
              <option value="">All Status</option>
              <option value="available">Available</option>
              <option value="rented">Rented</option>
              <option value="maintenance">Maintenance</option>
            </select>
          </div>
          <div class="table-wrap">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Brand / Model</th>
                  <th>Year</th>
                  <th>Category</th>
                  <th>License Plate</th>
                  <th>Price/Day</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="carsTableBody"></tbody>
            </table>
            <div class="empty-state" id="carsEmpty" style="display:none">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3"/><rect x="9" y="11" width="14" height="10" rx="1"/></svg>
              No cars found. Add your first car!
            </div>
          </div>
          <div class="table-footer">
            <span id="carsCount">0 cars</span>
            <div class="pagination" id="carsPagination"></div>
          </div>
        </div>

        <!-- CATEGORIES PAGE -->
        <div id="dash-categories" class="dash-page" style="display:none">
          <div class="page-header">
            <h1 class="page-title">Manage <span>Categories</span></h1>
            <button class="btn-add" onclick="openCatModal()">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Add Category
            </button>
          </div>
          <div class="table-wrap">
            <table class="data-table">
              <thead><tr><th>#</th><th>Category Name</th><th>Cars Count</th><th>Actions</th></tr></thead>
              <tbody id="catsTableBody"></tbody>
            </table>
            <div class="empty-state" id="catsEmpty" style="display:none">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
              No categories yet.
            </div>
          </div>
        </div>

        <!-- DRIVERS PAGE -->
        <div id="dash-drivers" class="dash-page" style="display:none">
          <div class="page-header">
            <h1 class="page-title">Manage <span>Drivers</span></h1>
            <button class="btn-add" onclick="openDriverModal()">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Add Driver
            </button>
          </div>
          <div class="table-toolbar">
            <div class="search-wrap">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              <input type="text" class="search-input" id="driverSearch" placeholder="Search drivers..." oninput="renderDriversTable()" />
            </div>
            <select class="filter-select" id="driverFilterStatus" onchange="renderDriversTable()">
              <option value="">All Status</option>
              <option value="available">Available</option>
              <option value="on_trip">On Trip</option>
              <option value="offline">Offline</option>
            </select>
          </div>
          <div class="table-wrap">
            <table class="data-table">
              <thead><tr><th>#</th><th>Driver Name</th><th>Phone Number</th><th>Status</th><th>Actions</th></tr></thead>
              <tbody id="driversTableBody"></tbody>
            </table>
            <div class="empty-state" id="driversEmpty" style="display:none">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"/><path d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              No drivers yet.
            </div>
          </div>
          <div class="table-footer">
            <span id="driversCount">0 drivers</span>
          </div>
        </div>

        <!-- PLACEHOLDER PAGES -->
        <div id="dash-rentals" class="dash-page" style="display:none">
          <div class="placeholder-page">
            <div class="placeholder-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div>
            <h2 class="placeholder-title">Rentals Module</h2>
            <p class="placeholder-sub">Full rental management with booking, tracking, and status updates. Coming in the next release.</p>
          </div>
        </div>
        <div id="dash-payments" class="dash-page" style="display:none">
          <div class="placeholder-page">
            <div class="placeholder-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
            <h2 class="placeholder-title">Payments Module</h2>
            <p class="placeholder-sub">Integrated payment processing for cash, bank transfer, and e-wallet. Coming soon.</p>
          </div>
        </div>
        <!-- USERS PAGE (MySQL CRUD) -->
        <div id="dash-users" class="dash-page" style="display:none">
          <div class="page-header">
            <h1 class="page-title">Manage <span>Users</span></h1>
            <button class="btn-add" onclick="openUserModal()">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Add User
            </button>
          </div>
          <div class="table-toolbar">
            <div class="search-wrap">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              <input type="text" class="search-input" id="userSearch" placeholder="Search by name, email, phone..." oninput="renderUsersTable()" />
            </div>
            <select class="filter-select" id="userFilterRole" onchange="renderUsersTable()">
              <option value="">All Roles</option>
              <option value="admin">Admin</option>
              <option value="customer">Customer</option>
            </select>
          </div>
          <div class="table-wrap">
            <table class="data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Role</th>
                  <th>Joined</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="usersTableBody"></tbody>
            </table>
            <div class="empty-state" id="usersEmpty" style="display:none">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
              No users found.
            </div>
          </div>
          <div class="table-footer">
            <span id="usersCount">0 users</span>
          </div>
        </div>

      </div><!-- /dash-content -->
    </main>
  </div>
</div><!-- /view-dashboard -->

<!-- ======================== -->
<!--         MODALS           -->
<!-- ======================== -->

<!-- CAR MODAL -->
<div class="modal-overlay" id="carModal">
  <div class="modal">
    <div class="modal-header">
      <h2 class="modal-title" id="carModalTitle">Add <span>New Car</span></h2>
      <div class="modal-close" onclick="closeCarModal()">✕</div>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Brand *</label>
          <input type="text" class="form-input" id="carBrand" placeholder="e.g. Toyota" />
        </div>
        <div class="form-group">
          <label class="form-label">Model *</label>
          <input type="text" class="form-input" id="carModel" placeholder="e.g. Camry" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Year *</label>
          <input type="number" class="form-input" id="carYear" placeholder="2024" min="2000" max="2030" />
        </div>
        <div class="form-group">
          <label class="form-label">License Plate *</label>
          <input type="text" class="form-input" id="carPlate" placeholder="L 1234 AB" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Category *</label>
          <select class="form-select" id="carCategory">
            <option value="">Select category</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select class="form-select" id="carStatus">
            <option value="available">Available</option>
            <option value="rented">Rented</option>
            <option value="maintenance">Maintenance</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Price per Day (IDR) *</label>
        <input type="number" class="form-input" id="carPrice" placeholder="500000" />
      </div>
      <div class="form-group">
        <label class="form-label">Image URL</label>
        <input type="url" class="form-input" id="carImage" placeholder="https://..." />
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea class="form-textarea" id="carDesc" placeholder="Brief description of the vehicle..."></textarea>
      </div>
      <input type="hidden" id="carEditId" />
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeCarModal()">Cancel</button>
      <button class="btn-save" onclick="saveCar()">Save Car</button>
    </div>
  </div>
</div>

<!-- CATEGORY MODAL -->
<div class="modal-overlay" id="catModal">
  <div class="modal" style="max-width:420px">
    <div class="modal-header">
      <h2 class="modal-title" id="catModalTitle">Add <span>Category</span></h2>
      <div class="modal-close" onclick="closeCatModal()">✕</div>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Category Name *</label>
        <input type="text" class="form-input" id="catName" placeholder="e.g. SUV, Sedan, MPV..." />
      </div>
      <input type="hidden" id="catEditId" />
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeCatModal()">Cancel</button>
      <button class="btn-save" onclick="saveCat()">Save Category</button>
    </div>
  </div>
</div>

<!-- DRIVER MODAL -->
<div class="modal-overlay" id="driverModal">
  <div class="modal" style="max-width:480px">
    <div class="modal-header">
      <h2 class="modal-title" id="driverModalTitle">Add <span>Driver</span></h2>
      <div class="modal-close" onclick="closeDriverModal()">✕</div>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Driver Name *</label>
        <input type="text" class="form-input" id="driverName" placeholder="Full name" />
      </div>
      <div class="form-group">
        <label class="form-label">Phone Number *</label>
        <input type="text" class="form-input" id="driverPhone" placeholder="+62 812-..." />
      </div>
      <div class="form-group">
        <label class="form-label">Status *</label>
        <select class="form-select" id="driverStatus">
          <option value="available">Available</option>
          <option value="on_trip">On Trip</option>
          <option value="offline">Offline</option>
        </select>
      </div>
      <input type="hidden" id="driverEditId" />
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeDriverModal()">Cancel</button>
      <button class="btn-save" onclick="saveDriver()">Save Driver</button>
    </div>
  </div>
</div>

<!-- CONFIRM DELETE MODAL -->
<div class="modal-overlay" id="confirmModal">
  <div class="confirm-dialog">
    <div class="confirm-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg></div>
    <h3 class="confirm-title">Confirm Delete</h3>
    <p class="confirm-msg" id="confirmMsg">Are you sure you want to delete this item? This action cannot be undone.</p>
    <div class="confirm-actions">
      <button class="btn-cancel" onclick="closeConfirm()">Cancel</button>
      <button class="btn-confirm-del" id="confirmDelBtn">Delete</button>
    </div>
  </div>
</div>

<!-- =================== -->
<!--       SCRIPT        -->
<!-- =================== -->
<script>
// ========= DATA STORE =========
let db = {
  categories: [
    { id: 1, name: 'Sedan' },
    { id: 2, name: 'SUV' },
    { id: 3, name: 'MPV' },
    { id: 4, name: 'Sport' },
  ],
  cars: [
    { id: 1, category_id: 1, brand: 'Toyota', model: 'Camry', year: 2024, license_plate: 'L 1234 AB', price_per_day: 650000, status: 'available', image: 'https://images.unsplash.com/photo-1571987502951-3db0ab1cdcd8?w=600&q=80', description: 'Executive sedan with premium interior' },
    { id: 2, category_id: 2, brand: 'BMW', model: 'X5', year: 2023, license_plate: 'L 5678 CD', price_per_day: 1500000, status: 'available', image: 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&q=80', description: 'Luxury SUV perfect for family and business' },
    { id: 3, category_id: 3, brand: 'Toyota', model: 'Alphard', year: 2024, license_plate: 'L 9012 EF', price_per_day: 1800000, status: 'rented', image: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=600&q=80', description: 'Premium MPV with ultra-spacious cabin' },
    { id: 4, category_id: 4, brand: 'Porsche', model: 'Cayenne', year: 2023, license_plate: 'L 3456 GH', price_per_day: 3500000, status: 'available', image: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80', description: 'High-performance luxury sport SUV' },
    { id: 5, category_id: 1, brand: 'Mercedes-Benz', model: 'E-Class', year: 2024, license_plate: 'L 7890 IJ', price_per_day: 1200000, status: 'maintenance', image: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&q=80', description: 'Refined German engineering for executives' },
    { id: 6, category_id: 2, brand: 'Range Rover', model: 'Sport', year: 2023, license_plate: 'L 2468 KL', price_per_day: 2800000, status: 'available', image: 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=600&q=80', description: 'Iconic British luxury off-roader' },
  ],
  drivers: [
    { id: 1, name: 'Budi Santoso', phone: '+62 812-3456-7890', status: 'available' },
    { id: 2, name: 'Agus Wijaya', phone: '+62 813-9876-5432', status: 'on_trip' },
    { id: 3, name: 'Hendra Kusuma', phone: '+62 857-1234-5678', status: 'available' },
  ],
  nextId: { cars: 7, categories: 5, drivers: 4 }
};

// ========= VIEW SWITCHING =========
function showView(v) {
  document.querySelectorAll('.view').forEach(el => el.classList.remove('active'));
  document.getElementById('view-' + v).classList.add('active');
  window.scrollTo(0, 0);
  if (v === 'dashboard') { updateDashboard(); }
}

// ========= NAVBAR =========
let lastScroll = 0;
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  const cur = window.scrollY;
  navbar.classList.toggle('scrolled', cur > 50);
  if (cur > lastScroll && cur > 100) { navbar.classList.add('hidden'); }
  else { navbar.classList.remove('hidden'); }
  lastScroll = cur;
  document.getElementById('backToTop').classList.toggle('visible', cur > 500);
});

// ========= MOBILE MENU =========
function toggleMobileMenu() {
  document.getElementById('mobileMenu').classList.toggle('open');
}

// ========= SIDEBAR =========
function openSidebar() { document.getElementById('dashSidebar').classList.add('open'); }
function closeSidebar() { document.getElementById('dashSidebar').classList.remove('open'); }

// ========= REVEAL ANIMATIONS =========
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => revealObserver.observe(el));

// ========= COUNTER ANIMATION =========
function animateCounter(el, target) {
  let cur = 0;
  const step = Math.max(1, Math.ceil(target / 60));
  const timer = setInterval(() => {
    cur = Math.min(cur + step, target);
    el.textContent = cur.toLocaleString();
    if (cur >= target) clearInterval(timer);
  }, 30);
}
const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      const target = parseInt(e.target.dataset.target);
      animateCounter(e.target, target);
      counterObserver.unobserve(e.target);
    }
  });
}, { threshold: 0.5 });
document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));

// ========= TESTIMONIALS =========
const testimonials = [
  { name: 'Rina Kusuma', role: 'Business Director', text: 'SuRide made our corporate event seamless. The Alphard was immaculate and the driver was incredibly professional.', stars: 5 },
  { name: 'Dimas Prasetyo', role: 'Wedding Client', text: 'Our wedding car was stunning. Every detail was perfect — truly made our day unforgettable.', stars: 5 },
  { name: 'Sarah Hartono', role: 'Frequent Traveller', text: 'Best airport transfer in Surabaya, hands down. Always on time, always clean, always comfortable.', stars: 5 },
  { name: 'Bintang Putra', role: 'CEO, Startup', text: 'The Range Rover Sport made quite an impression at our investor meeting. SuRide understands what premium means.', stars: 5 },
  { name: 'Maya Sari', role: 'Travel Blogger', text: 'Exceptional vehicles, exceptional service. SuRide is the only car rental I recommend to my readers in Surabaya.', stars: 5 },
  { name: 'Aryo Wibowo', role: 'Hotel Manager', text: 'We partner with SuRide for all our VIP guest transportation. Their reliability is unmatched.', stars: 5 },
];
function initTestimonials() {
  const track = document.getElementById('testiTrack');
  const doubled = [...testimonials, ...testimonials];
  track.innerHTML = doubled.map(t => `
    <div class="testi-card">
      <div class="testi-stars">${'★'.repeat(t.stars)}</div>
      <p class="testi-text">"${t.text}"</p>
      <div class="testi-author">
        <div class="testi-avatar">${t.name.charAt(0)}</div>
        <div><div class="testi-name">${t.name}</div><div class="testi-role">${t.role}</div></div>
      </div>
    </div>
  `).join('');
}
initTestimonials();

// ========= LANDING CARS GRID =========
function renderLandingCars() {
  const grid = document.getElementById('landingCarsGrid');
  const carsToShow = db.cars.slice(0, 6);
  grid.innerHTML = carsToShow.map(car => {
    const cat = db.categories.find(c => c.id === car.category_id);
    return `
      <div class="car-card reveal">
        <span class="status-badge status-${car.status}">${car.status}</span>
        ${car.image ? `<img class="car-img" src="${car.image}" alt="${car.brand} ${car.model}" loading="lazy" onerror="this.style.display='none'" />` : `<div class="car-img" style="background:var(--navy);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.8rem">No Image</div>`}
        <div class="car-info">
          <div class="car-category">${cat ? cat.name : 'Vehicle'}</div>
          <div class="car-name">${car.brand} ${car.model}</div>
          <div class="car-specs">
            <span class="car-spec"><svg viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>${car.year}</span>
          </div>
          <div class="car-footer">
            <div class="car-price">Rp ${(car.price_per_day/1000).toFixed(0)}K<sub>/day</sub></div>
            <button class="car-btn" onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">Book Now</button>
          </div>
        </div>
      </div>
    `;
  }).join('');
  document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
}
renderLandingCars();

// ========= DASHBOARD =========
function dashNav(page, el) {
  document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
  document.querySelectorAll('.dash-page').forEach(p => p.style.display = 'none');
  document.getElementById('dash-' + page).style.display = 'block';
  document.getElementById('breadcrumbText').textContent = el.textContent.trim().split('\n')[0].trim();
  closeSidebar();
  if (page === 'users') renderUsersTable();
}

function updateDashboard() {
  const total = db.cars.length;
  const avail = db.cars.filter(c => c.status === 'available').length;
  const rented = db.cars.filter(c => c.status === 'rented').length;
  const maint = db.cars.filter(c => c.status === 'maintenance').length;

  document.getElementById('ovTotalCars').textContent = total;
  document.getElementById('ovAvailCars').textContent = avail;
  document.getElementById('ovTotalDrivers').textContent = db.drivers.length;
  document.getElementById('ovTotalCats').textContent = db.categories.length;
  document.getElementById('badgeCars').textContent = total;
  document.getElementById('badgeCats').textContent = db.categories.length;
  document.getElementById('badgeDrivers').textContent = db.drivers.length;

  // Donut chart
  const circ = 188.4;
  const aP = total ? (avail / total) * circ : 0;
  const rP = total ? (rented / total) * circ : 0;
  const mP = total ? (maint / total) * circ : 0;
  document.getElementById('donutAvail').style.strokeDasharray = `${aP} ${circ - aP}`;
  document.getElementById('donutAvail').style.strokeDashoffset = '0';
  document.getElementById('donutRented').style.strokeDasharray = `${rP} ${circ - rP}`;
  document.getElementById('donutRented').style.strokeDashoffset = `-${aP}`;
  document.getElementById('donutMaint').style.strokeDasharray = `${mP} ${circ - mP}`;
  document.getElementById('donutMaint').style.strokeDashoffset = `-${aP + rP}`;
  document.getElementById('donutCenter').textContent = total;

  // Bar chart
  const barChart = document.getElementById('categoryBarChart');
  const legend = document.getElementById('barChartLegend');
  const maxCount = Math.max(...db.categories.map(cat => db.cars.filter(c => c.category_id === cat.id).length), 1);
  barChart.innerHTML = db.categories.map(cat => {
    const count = db.cars.filter(c => c.category_id === cat.id).length;
    const h = Math.max(6, (count / maxCount) * 72);
    return `<div class="bar" style="height:${h}px" title="${cat.name}: ${count} cars"></div>`;
  }).join('');
  legend.innerHTML = db.categories.map(cat => `${cat.name}`).join(' · ');

  // Overview table
  const tbody = document.getElementById('overviewTableBody');
  tbody.innerHTML = db.cars.slice(0, 8).map(car => {
    const cat = db.categories.find(c => c.id === car.category_id);
    return `<tr>
      <td>${car.image ? `<img class="car-thumb" src="${car.image}" loading="lazy" onerror="this.style.display='none'" />` : '<div class="car-thumb-placeholder">—</div>'}</td>
      <td><strong>${car.brand}</strong> ${car.model}</td>
      <td><span class="status-badge status-${car.status}" style="position:static;display:inline-block">${cat ? cat.name : '—'}</span></td>
      <td style="color:var(--gold)">Rp ${car.price_per_day.toLocaleString('id-ID')}</td>
      <td><span class="status-badge status-${car.status}" style="position:static;display:inline-block">${car.status}</span></td>
    </tr>`;
  }).join('');

  // Datetime
  const now = new Date();
  document.getElementById('dashDateTime').textContent = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

  renderCarsTable();
  renderCatsTable();
  renderDriversTable();
  populateCategorySelects();
}

// ========= CARS CRUD =========
function renderCarsTable() {
  const search = (document.getElementById('carSearch')?.value || '').toLowerCase();
  const catF = document.getElementById('carFilterCat')?.value;
  const statF = document.getElementById('carFilterStatus')?.value;
  let cars = db.cars.filter(c => {
    const matchS = !search || `${c.brand} ${c.model} ${c.license_plate}`.toLowerCase().includes(search);
    const matchC = !catF || String(c.category_id) === String(catF);
    const matchSt = !statF || c.status === statF;
    return matchS && matchC && matchSt;
  });
  const tbody = document.getElementById('carsTableBody');
  const empty = document.getElementById('carsEmpty');
  document.getElementById('carsCount').textContent = `${cars.length} car${cars.length !== 1 ? 's' : ''}`;
  if (!cars.length) { tbody.innerHTML = ''; empty.style.display = 'block'; return; }
  empty.style.display = 'none';
  tbody.innerHTML = cars.map(car => {
    const cat = db.categories.find(c => c.id === car.category_id);
    return `<tr>
      <td>${car.image ? `<img class="car-thumb" src="${car.image}" loading="lazy" onerror="this.style.display='none'" />` : '<div class="car-thumb-placeholder">No img</div>'}</td>
      <td><strong>${car.brand}</strong> ${car.model}</td>
      <td>${car.year}</td>
      <td>${cat ? cat.name : '—'}</td>
      <td style="font-family:var(--font-display);font-size:0.85rem;color:var(--muted)">${car.license_plate}</td>
      <td style="color:var(--gold);font-weight:500">Rp ${car.price_per_day.toLocaleString('id-ID')}</td>
      <td><span class="status-badge status-${car.status}" style="position:static;display:inline-block">${car.status}</span></td>
      <td>
        <button class="action-btn btn-edit" onclick="openCarModal(${car.id})">Edit</button>
        <button class="action-btn btn-delete" onclick="confirmDelete('car',${car.id},'${car.brand} ${car.model}')">Delete</button>
      </td>
    </tr>`;
  }).join('');
}

function populateCategorySelects() {
  const selects = ['carFilterCat', 'carCategory'];
  selects.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    const val = el.value;
    const placeholder = id === 'carFilterCat' ? '<option value="">All Categories</option>' : '<option value="">Select category</option>';
    el.innerHTML = placeholder + db.categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
    if (val) el.value = val;
  });
}

function openCarModal(id = null) {
  document.getElementById('carEditId').value = id || '';
  document.getElementById('carModalTitle').innerHTML = id ? 'Edit <span>Car</span>' : 'Add <span>New Car</span>';
  if (id) {
    const car = db.cars.find(c => c.id === id);
    if (!car) return;
    document.getElementById('carBrand').value = car.brand;
    document.getElementById('carModel').value = car.model;
    document.getElementById('carYear').value = car.year;
    document.getElementById('carPlate').value = car.license_plate;
    document.getElementById('carCategory').value = car.category_id;
    document.getElementById('carStatus').value = car.status;
    document.getElementById('carPrice').value = car.price_per_day;
    document.getElementById('carImage').value = car.image || '';
    document.getElementById('carDesc').value = car.description || '';
  } else {
    ['carBrand','carModel','carYear','carPlate','carPrice','carImage','carDesc'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('carCategory').value = '';
    document.getElementById('carStatus').value = 'available';
  }
  document.getElementById('carModal').classList.add('open');
}
function closeCarModal() { document.getElementById('carModal').classList.remove('open'); }

function saveCar() {
  const brand = document.getElementById('carBrand').value.trim();
  const model = document.getElementById('carModel').value.trim();
  const year = parseInt(document.getElementById('carYear').value);
  const plate = document.getElementById('carPlate').value.trim();
  const catId = parseInt(document.getElementById('carCategory').value);
  const status = document.getElementById('carStatus').value;
  const price = parseFloat(document.getElementById('carPrice').value);
  const image = document.getElementById('carImage').value.trim();
  const desc = document.getElementById('carDesc').value.trim();
  const editId = document.getElementById('carEditId').value;

  if (!brand || !model || !year || !plate || !catId || !price) { showToast('Please fill all required fields.', 'error'); return; }

  if (editId) {
    const idx = db.cars.findIndex(c => c.id === parseInt(editId));
    db.cars[idx] = { ...db.cars[idx], brand, model, year, license_plate: plate, category_id: catId, status, price_per_day: price, image, description: desc };
    showToast(`${brand} ${model} updated successfully.`, 'success');
  } else {
    db.cars.push({ id: db.nextId.cars++, category_id: catId, brand, model, year, license_plate: plate, price_per_day: price, status, image, description: desc });
    showToast(`${brand} ${model} added to fleet.`, 'success');
  }
  closeCarModal();
  updateDashboard();
  renderLandingCars();
}

// ========= CATEGORIES CRUD =========
function renderCatsTable() {
  const tbody = document.getElementById('catsTableBody');
  const empty = document.getElementById('catsEmpty');
  if (!db.categories.length) { tbody.innerHTML = ''; empty.style.display = 'block'; return; }
  empty.style.display = 'none';
  tbody.innerHTML = db.categories.map((cat, i) => {
    const count = db.cars.filter(c => c.category_id === cat.id).length;
    return `<tr>
      <td style="color:var(--muted)">${i + 1}</td>
      <td><strong>${cat.name}</strong></td>
      <td><span style="color:var(--gold)">${count} car${count !== 1 ? 's' : ''}</span></td>
      <td>
        <button class="action-btn btn-edit" onclick="openCatModal(${cat.id})">Edit</button>
        <button class="action-btn btn-delete" onclick="confirmDelete('cat',${cat.id},'${cat.name}')">Delete</button>
      </td>
    </tr>`;
  }).join('');
}
function openCatModal(id = null) {
  document.getElementById('catEditId').value = id || '';
  document.getElementById('catModalTitle').innerHTML = id ? 'Edit <span>Category</span>' : 'Add <span>Category</span>';
  document.getElementById('catName').value = id ? (db.categories.find(c => c.id === id)?.name || '') : '';
  document.getElementById('catModal').classList.add('open');
}
function closeCatModal() { document.getElementById('catModal').classList.remove('open'); }
function saveCat() {
  const name = document.getElementById('catName').value.trim();
  const editId = document.getElementById('catEditId').value;
  if (!name) { showToast('Category name is required.', 'error'); return; }
  if (editId) {
    const idx = db.categories.findIndex(c => c.id === parseInt(editId));
    db.categories[idx].name = name;
    showToast(`Category updated to "${name}".`, 'success');
  } else {
    db.categories.push({ id: db.nextId.categories++, name });
    showToast(`Category "${name}" added.`, 'success');
  }
  closeCatModal();
  updateDashboard();
}

// ========= DRIVERS CRUD =========
function renderDriversTable() {
  const search = (document.getElementById('driverSearch')?.value || '').toLowerCase();
  const statF = document.getElementById('driverFilterStatus')?.value;
  let drivers = db.drivers.filter(d => {
    const matchS = !search || d.name.toLowerCase().includes(search) || d.phone.includes(search);
    const matchSt = !statF || d.status === statF;
    return matchS && matchSt;
  });
  const tbody = document.getElementById('driversTableBody');
  const empty = document.getElementById('driversEmpty');
  document.getElementById('driversCount').textContent = `${drivers.length} driver${drivers.length !== 1 ? 's' : ''}`;
  if (!drivers.length) { tbody.innerHTML = ''; empty.style.display = 'block'; return; }
  empty.style.display = 'none';
  const statusColors = { available: 'status-available', on_trip: 'status-rented', offline: 'status-maintenance' };
  tbody.innerHTML = drivers.map((d, i) => `<tr>
    <td style="color:var(--muted)">${i + 1}</td>
    <td><strong>${d.name}</strong></td>
    <td style="color:var(--muted)">${d.phone}</td>
    <td><span class="status-badge ${statusColors[d.status] || ''}" style="position:static;display:inline-block">${d.status.replace('_', ' ')}</span></td>
    <td>
      <button class="action-btn btn-edit" onclick="openDriverModal(${d.id})">Edit</button>
      <button class="action-btn btn-delete" onclick="confirmDelete('driver',${d.id},'${d.name}')">Delete</button>
    </td>
  </tr>`).join('');
}
function openDriverModal(id = null) {
  document.getElementById('driverEditId').value = id || '';
  document.getElementById('driverModalTitle').innerHTML = id ? 'Edit <span>Driver</span>' : 'Add <span>Driver</span>';
  if (id) {
    const d = db.drivers.find(d => d.id === id);
    document.getElementById('driverName').value = d.name;
    document.getElementById('driverPhone').value = d.phone;
    document.getElementById('driverStatus').value = d.status;
  } else {
    document.getElementById('driverName').value = '';
    document.getElementById('driverPhone').value = '';
    document.getElementById('driverStatus').value = 'available';
  }
  document.getElementById('driverModal').classList.add('open');
}
function closeDriverModal() { document.getElementById('driverModal').classList.remove('open'); }
function saveDriver() {
  const name = document.getElementById('driverName').value.trim();
  const phone = document.getElementById('driverPhone').value.trim();
  const status = document.getElementById('driverStatus').value;
  const editId = document.getElementById('driverEditId').value;
  if (!name || !phone) { showToast('Name and phone are required.', 'error'); return; }
  if (editId) {
    const idx = db.drivers.findIndex(d => d.id === parseInt(editId));
    db.drivers[idx] = { ...db.drivers[idx], name, phone, status };
    showToast(`Driver ${name} updated.`, 'success');
  } else {
    db.drivers.push({ id: db.nextId.drivers++, name, phone, status });
    showToast(`Driver ${name} added.`, 'success');
  }
  closeDriverModal();
  updateDashboard();
}

// ========= DELETE =========
let pendingDelete = null;
function confirmDelete(type, id, label) {
  pendingDelete = { type, id };
  document.getElementById('confirmMsg').textContent = `Delete "${label}"? This action cannot be undone.`;
  document.getElementById('confirmDelBtn').onclick = executeDelete;
  document.getElementById('confirmModal').classList.add('open');
}
function closeConfirm() { document.getElementById('confirmModal').classList.remove('open'); pendingDelete = null; }
function executeDelete() {
  if (!pendingDelete) return;
  const { type, id } = pendingDelete;
  if (type === 'car') {
    db.cars = db.cars.filter(c => c.id !== id);
    showToast('Car removed from fleet.', 'success');
    renderLandingCars();
  } else if (type === 'cat') {
    const inUse = db.cars.some(c => c.category_id === id);
    if (inUse) { showToast('Cannot delete — category has cars assigned.', 'error'); closeConfirm(); return; }
    db.categories = db.categories.filter(c => c.id !== id);
    showToast('Category deleted.', 'success');
  } else if (type === 'driver') {
    db.drivers = db.drivers.filter(d => d.id !== id);
    showToast('Driver removed.', 'success');
  }
  closeConfirm();
  updateDashboard();
}

// ========= CLOSE MODALS ON OVERLAY CLICK =========
['carModal','catModal','driverModal','confirmModal'].forEach(id => {
  document.getElementById(id).addEventListener('click', function(e) {
    if (e.target === this) { this.classList.remove('open'); }
  });
});

// ========= TOAST =========
function showToast(msg, type = 'info') {
  const icons = {
    success: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>',
    error: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
    info: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
  };
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `<span class="toast-icon ${type}">${icons[type]}</span><span>${msg}</span>`;
  container.appendChild(toast);
  setTimeout(() => { toast.style.transition = 'all 0.3s'; toast.style.opacity = '0'; toast.style.transform = 'translateX(20px)'; setTimeout(() => toast.remove(), 300); }, 3500);
}
</script>

<!-- USER MODAL -->
<div class="modal-overlay" id="userModal">
  <div class="modal" style="max-width:560px">
    <div class="modal-header">
      <h2 class="modal-title" id="userModalTitle">Add <span>User</span></h2>
      <div class="modal-close" onclick="closeUserModal()">✕</div>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input type="text" class="form-input" id="uName" placeholder="e.g. Budi Santoso" />
        </div>
        <div class="form-group">
          <label class="form-label">Role *</label>
          <select class="form-select" id="uRole">
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Email *</label>
        <input type="email" class="form-input" id="uEmail" placeholder="user@example.com" />
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Phone Number</label>
          <input type="text" class="form-input" id="uPhone" placeholder="+62 812-..." />
        </div>
        <div class="form-group">
          <label class="form-label">Password <span id="uPasswordHint" style="color:var(--muted);font-size:0.65rem">(min 6 chars)</span></label>
          <input type="password" class="form-input" id="uPassword" placeholder="••••••••" />
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Address</label>
        <textarea class="form-textarea" id="uAddress" placeholder="Jl. Contoh No. 1, Surabaya" rows="2"></textarea>
      </div>
      <input type="hidden" id="uEditId" />
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeUserModal()">Cancel</button>
      <button class="btn-save" onclick="saveUser()">Save User</button>
    </div>
  </div>
</div>

<script>
// ========= USERS CRUD (MySQL via PHP API) =========
const API = 'users_api.php';

async function apiFetch(url, opts = {}) {
  try {
    const res = await fetch(url, { headers: { 'Content-Type': 'application/json' }, ...opts });
    return await res.json();
  } catch (e) {
    return { success: false, message: 'Network error: ' + e.message };
  }
}

async function renderUsersTable() {
  const search = document.getElementById('userSearch')?.value || '';
  const role   = document.getElementById('userFilterRole')?.value || '';
  const tbody  = document.getElementById('usersTableBody');
  const empty  = document.getElementById('usersEmpty');
  const countEl= document.getElementById('usersCount');

  tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--muted);padding:2rem">Loading...</td></tr>';

  const params = new URLSearchParams({ action: 'list' });
  if (search) params.set('search', search);
  if (role)   params.set('role', role);

  const res = await apiFetch(`${API}?${params}`);
  if (!res.success) { showToast(res.message, 'error'); tbody.innerHTML = ''; return; }

  const users = res.data || [];
  countEl.textContent = `${users.length} user${users.length !== 1 ? 's' : ''}`;
  document.getElementById('ovTotalUsers') && (document.getElementById('ovTotalUsers').textContent = users.length);

  if (!users.length) {
    tbody.innerHTML = '';
    empty.style.display = 'block';
    return;
  }
  empty.style.display = 'none';

  const roleColors = {
    admin:    'style="background:rgba(212,175,55,0.12);color:var(--gold);border:1px solid var(--gold-border);font-size:0.6rem;letter-spacing:0.12em;text-transform:uppercase;padding:3px 10px;display:inline-block"',
    customer: 'style="background:rgba(59,130,246,0.12);color:#60a5fa;border:1px solid rgba(96,165,250,0.3);font-size:0.6rem;letter-spacing:0.12em;text-transform:uppercase;padding:3px 10px;display:inline-block"',
  };

  tbody.innerHTML = users.map((u, i) => {
    const joined = u.created_at ? new Date(u.created_at).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' }) : '-';
    return `<tr>
      <td style="color:var(--muted)">${i + 1}</td>
      <td><strong>${escHtml(u.full_name)}</strong></td>
      <td style="color:var(--muted)">${escHtml(u.email)}</td>
      <td style="color:var(--muted)">${escHtml(u.phone_number || '-')}</td>
      <td><span ${roleColors[u.role] || ''}>${u.role}</span></td>
      <td style="color:var(--muted);font-size:0.75rem">${joined}</td>
      <td>
        <button class="action-btn btn-edit"   onclick="openUserModal(${u.user_id})">Edit</button>
        <button class="action-btn btn-delete" onclick="confirmDeleteUser(${u.user_id},'${escHtml(u.full_name)}')">Delete</button>
      </td>
    </tr>`;
  }).join('');
}

function escHtml(str) {
  return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

async function openUserModal(id = null) {
  document.getElementById('uEditId').value = id || '';
  document.getElementById('userModalTitle').innerHTML = id ? 'Edit <span>User</span>' : 'Add <span>User</span>';
  document.getElementById('uPasswordHint').textContent = id ? '(leave blank to keep current)' : '(min 6 chars)';

  // Clear form
  ['uName','uEmail','uPhone','uPassword','uAddress'].forEach(f => document.getElementById(f).value = '');
  document.getElementById('uRole').value = 'customer';

  if (id) {
    const res = await apiFetch(`${API}?action=get&id=${id}`);
    if (!res.success) { showToast(res.message, 'error'); return; }
    const u = res.data;
    document.getElementById('uName').value    = u.full_name    || '';
    document.getElementById('uEmail').value   = u.email        || '';
    document.getElementById('uPhone').value   = u.phone_number || '';
    document.getElementById('uAddress').value = u.address      || '';
    document.getElementById('uRole').value    = u.role         || 'customer';
  }
  document.getElementById('userModal').classList.add('open');
}

function closeUserModal() {
  document.getElementById('userModal').classList.remove('open');
}

async function saveUser() {
  const id       = document.getElementById('uEditId').value;
  const fullName = document.getElementById('uName').value.trim();
  const email    = document.getElementById('uEmail').value.trim();
  const phone    = document.getElementById('uPhone').value.trim();
  const address  = document.getElementById('uAddress').value.trim();
  const role     = document.getElementById('uRole').value;
  const password = document.getElementById('uPassword').value;

  if (!fullName) { showToast('Full name is required.', 'error'); return; }
  if (!email)    { showToast('Email is required.', 'error'); return; }
  if (!id && password.length < 6) { showToast('Password must be at least 6 characters.', 'error'); return; }

  const payload = { full_name: fullName, email, phone_number: phone, address, role, password };

  let res;
  if (id) {
    res = await apiFetch(`${API}?action=update&id=${id}`, { method: 'PUT', body: JSON.stringify(payload) });
  } else {
    res = await apiFetch(`${API}?action=create`, { method: 'POST', body: JSON.stringify(payload) });
  }

  if (!res.success) { showToast(res.message, 'error'); return; }
  showToast(res.message, 'success');
  closeUserModal();
  renderUsersTable();
}

// Delete user with confirmation reusing existing confirmModal
function confirmDeleteUser(id, name) {
  pendingDelete = { type: 'user', id };
  document.getElementById('confirmMsg').textContent = `Delete user "${name}"? This action cannot be undone.`;
  document.getElementById('confirmDelBtn').onclick = executeDeleteUser;
  document.getElementById('confirmModal').classList.add('open');
}

async function executeDeleteUser() {
  if (!pendingDelete || pendingDelete.type !== 'user') return;
  const { id } = pendingDelete;
  const res = await apiFetch(`${API}?action=delete&id=${id}`, { method: 'DELETE' });
  if (!res.success) { showToast(res.message, 'error'); closeConfirm(); return; }
  showToast(res.message, 'success');
  closeConfirm();
  renderUsersTable();
}

// Close userModal on overlay click
document.getElementById('userModal').addEventListener('click', function(e) {
  if (e.target === this) closeUserModal();
});

// Init dashboard data
updateDashboard();
</script>
</body>
</html>