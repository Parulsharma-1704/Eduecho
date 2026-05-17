<style>
    @font-face {
        font-family: 'OpenDyslexic';
        src: url('https://antijingoist.github.io/opendyslexic/opendyslexic/OpenDyslexic-Regular.otf');
    }
    .font-dyslexia {
        font-family: 'OpenDyslexic', sans-serif !important;
    }
    .large-text {
        font-size: {{ $accessibilityProfile->font_size ?? 16 }}px !important;
    }
    .focus-mode .sidebar { opacity: 0.1; transition: opacity 0.3s; }
    .focus-mode .sidebar:hover { opacity: 1; }
    .focus-mode .topbar { background: transparent; box-shadow: none; }
    
    body.font-dyslexia {
        line-height: {{ $accessibilityProfile->line_spacing ?? 1.5 }} !important;
        letter-spacing: {{ ($accessibilityProfile->letter_spacing ?? 0) * 0.05 }}em !important;
    }

    :root {
        --teal: #0D9488;
        --teal-b: #10B981;
        --teal-l: #CCFBF1;
        --teal-ll: #F0FDFA;
        --teal-d: #0F766E;
        --teal-dd: #134E4A;
        --violet: #6D28D9;
        --violet-b: #7C3AED;
        --violet-l: #EDE9FE;
        --violet-ll: #F5F3FF;
        --violet-d: #4C1D95;
        --violet-m: #C4B5FD;
        --navy: #1E1B4B;
        --white: #ffffff;
        --gray: #6B7280;
        --gray-l: #F9FAFB;
        --gray-b: #E5E7EB;
        --page: #F0FDFA;
        --amber: #D97706;
        --al: #FEF3C7;
        --ad: #92400E;
        --rose: #BE185D;
        --rl: #FCE7F3;
        --rd: #9D174D;
        --green: #16A34A;
        --gl: #DCFCE7;
        --gd: #166534;
        --blue: #2563EB;
        --bl: #EFF6FF;
        --bd: #1E40AF;
        --font-head: 'Plus Jakarta Sans', sans-serif;
        --font-body: 'DM Sans', sans-serif;
        --r-sm: 8px;
        --r-md: 12px;
        --r-lg: 16px;
        --r-xl: 20px;
        --r-2xl: 24px;
        --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0 }

    html, body { height: 100%; overflow: hidden }
    body { font-family: var(--font-body); background: var(--page); color: var(--navy); font-size: 14px; transition: background 0.3s, color 0.3s; }
    
    .app { display: flex; height: 100vh; overflow: hidden }
    
    /* SIDEBAR */
    .sidebar { width: var(--sidebar-w); background: var(--navy); display: flex; flex-direction: column; flex-shrink: 0; }
    .sb-logo { padding: 24px; display: flex; align-items: center; gap: 12px; }
    .sb-logo-icon { width: 40px; height: 40px; background: var(--teal); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; }
    .sb-logo-name { color: white; font-family: var(--font-head); font-weight: 800; font-size: 20px; }
    .sb-logo-name em { font-style: normal; color: var(--teal-b); }
    .sb-nav { flex: 1; padding: 12px; overflow-y: auto; }
    .sb-group { font-size: 10px; font-weight: 800; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1.5px; padding: 20px 12px 8px; }
    .sb-item { width: 100%; padding: 12px; display: flex; align-items: center; gap: 12px; color: rgba(255,255,255,0.6); border: none; background: transparent; border-radius: 12px; font-weight: 600; font-size: 14px; transition: 0.2s; text-align: left; cursor: pointer; }
    .sb-item:hover { background: rgba(255,255,255,0.05); color: white; }
    .sb-item.active { background: var(--teal); color: white; box-shadow: 0 4px 12px rgba(13,148,136,0.2); }
    .sb-user { padding: 16px; border-top: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; gap: 12px; cursor: pointer; }
    .sb-user-av { width: 36px; height: 36px; background: var(--teal); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; }
    .sb-user-name { color: white; font-size: 13px; font-weight: 700; display: block; }
    .sb-user-role { color: rgba(255,255,255,0.4); font-size: 11px; }

    /* MAIN */
    .main { flex: 1; display: flex; flex-direction: column; min-width: 0; background: var(--page); }
    .topbar { height: 72px; padding: 0 32px; background: white; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--teal-ll); }
    .tb-title { font-family: var(--font-head); font-weight: 800; font-size: 20px; color: var(--navy); }
    .tb-search { background: var(--gray-l); border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 10px; width: 300px; }
    .tb-search input { border: none; background: transparent; outline: none; font-family: var(--font-body); font-size: 13px; width: 100%; }
    .tb-right { display: flex; align-items: center; gap: 16px; }
    .tb-icon-btn { width: 40px; height: 40px; border-radius: 12px; border: 1px solid var(--teal-ll); background: white; color: var(--teal); display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative; }
    .tb-icon-btn:hover { background: var(--teal-ll); }
    .notif-dot { position: absolute; top: 10px; right: 10px; width: 8px; height: 8px; background: var(--rose); border-radius: 50%; border: 2px solid white; }
    .tb-user { display: flex; align-items: center; gap: 10px; padding: 8px 16px; background: var(--teal-ll); color: var(--teal); border-radius: 12px; font-weight: 700; font-size: 13px; cursor: pointer; }
    .tb-user-av { width: 24px; height: 24px; background: var(--teal); color: white; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; }

    /* CONTENT */
    .content { flex: 1; padding: 32px; overflow-y: auto; }
    .panel { display: none; animation: fadeIn 0.4s ease; }
    .panel.show { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* WELCOME CARD */
    .welcome { background: var(--navy); border-radius: 24px; padding: 40px; color: white; display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; position: relative; overflow: hidden; }
    .welcome h1 { font-family: var(--font-head); font-size: 32px; font-weight: 900; margin-bottom: 8px; }
    .welcome p { color: rgba(255,255,255,0.6); font-size: 15px; }
    .wb-status { background: rgba(255,255,255,0.1); padding: 16px 24px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; gap: 16px; }
    .wb-stat-icon { width: 48px; height: 48px; background: var(--teal); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
    .wb-stat-label { font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.4); text-transform: uppercase; margin-bottom: 4px; }
    .wb-stat-val { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 16px; }
    .wb-green { width: 8px; height: 8px; background: var(--teal-b); border-radius: 50%; }

    /* STATS GRID */
    .stat-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px; }
    .sc { background: white; padding: 24px; border-radius: 20px; border: 1px solid var(--teal-ll); transition: 0.3s; }
    .sc:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.04); border-color: var(--teal-m); }
    .sc-ico { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 16px; }
    .sc-label { font-size: 12px; font-weight: 700; color: var(--gray); margin-bottom: 4px; }
    .sc-val { font-family: var(--font-head); font-size: 32px; font-weight: 900; color: var(--navy); }

    /* CARDS */
    .card { background: white; border-radius: 20px; border: 1px solid var(--teal-ll); padding: 24px; }
    .eyebrow { font-size: 11px; font-weight: 800; color: var(--teal); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px; }
    .pill { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }

    /* QUICK ACTIONS */
    .qa-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 32px; }
    .qa { background: var(--white); padding: 20px; border-radius: 16px; border: 1px solid var(--teal-ll); transition: 0.3s; cursor: pointer; }
    .qa:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.04); border-color: var(--teal); }
    .qa-ico { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; }


    /* BUTTONS */
    .btn-teal { background: var(--teal); color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 8px; transition: 0.2s; cursor: pointer; }
    .btn-teal:hover { background: var(--teal-d); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(13,148,136,0.2); }

    /* TABLES */
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 16px; color: var(--gray); font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid var(--gray-l); }
    td { padding: 16px; border-bottom: 1px solid var(--gray-l); vertical-align: middle; }

    /* DARK MODE */
    body.dark-mode { --page: #0f172a; --white: #1e293b; --navy: #f8fafc; --gray-l: #334155; --teal-ll: #134e4a; --teal-l: #115e59; }
    body.dark-mode .topbar { background: #1e293b; border-color: #334155; }
    body.dark-mode .sc, body.dark-mode .card, body.dark-mode .qa { background: #1e293b; border-color: #334155; }
    body.dark-mode td, body.dark-mode th { border-color: #334155; }
</style>
