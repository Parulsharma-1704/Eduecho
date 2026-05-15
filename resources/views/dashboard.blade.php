<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduEcho</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234338ca' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z'/%3E%3Cpath d='m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65'/%3E%3Cpath d='m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65'/%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    @php
        $bodyClasses = '';
        if (Auth::user()->hasRole('student') && isset($accessibilityProfile)) {
            if ($accessibilityProfile->high_contrast) $bodyClasses .= ' high-contrast';
            if ($accessibilityProfile->font_size > 14) $bodyClasses .= ' large-text';
            if ($accessibilityProfile->font_family === 'Dyslexia') $bodyClasses .= ' font-dyslexia';
            if ($accessibilityProfile->focus_mode) $bodyClasses .= ' focus-mode';
        }
    @endphp
    <style>
        @font-face {
            font-family: 'OpenDyslexic';
            src: url('https://antijingoist.github.io/opendyslexic/opendyslexic/OpenDyslexic-Regular.otf');
        }
        .font-dyslexia {
            font-family: 'OpenDyslexic', sans-serif !important;
        }
        .large-text {
            font-size: {{ $accessibilityProfile->font_size ?? 14 }}px !important;
        }
        .focus-mode .sidebar { opacity: 0.1; transition: opacity 0.3s; }
        .focus-mode .sidebar:hover { opacity: 1; }
        .focus-mode .topbar { background: transparent; box-shadow: none; }
        
        /* Personalized Spacing */
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
            --sidebar-w: 224px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        /* Accessibility Overrides */
        body.high-contrast {
            --teal: #055f56;
            --teal-l: #e6fffa;
            --teal-ll: #f0fdfa;
            --violet: #4a1d96;
            --violet-l: #f5f3ff;
            --navy: #000000;
            --gray: #333333;
            --page: #ffffff;
            --amber: #92400e;
            --rose: #9d174d;
        }

        body.large-text {
            font-size: 16px;
        }
        body.large-text .eyebrow { font-size: 12px; }
        body.large-text .card-title { font-size: 16px; }
        body.large-text .stat-val { font-size: 32px; }

        body.reduce-motion * {
            animation: none !important;
            transition: none !important;
        }

        html,
        body {
            height: 100%;
            overflow: hidden
        }

        body {
            font-family: var(--font-body);
            background: var(--page);
            color: var(--navy);
            font-size: 14px
        }

        button {
            cursor: pointer;
            font-family: var(--font-body)
        }

        a {
            text-decoration: none;
            color: inherit
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-7px)
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes countIn {
            from {
                opacity: 0;
                transform: scale(.85)
            }

            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        @keyframes progFill {
            from {
                width: 0
            }

            to {
                width: var(--w)
            }
        }

        @keyframes pulseDot {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(190, 24, 93, .4)
            }

            70% {
                box-shadow: 0 0 0 6px rgba(190, 24, 93, 0)
            }
        }

        @keyframes panelIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .app {
            display: flex;
            height: 100vh;
            overflow: hidden
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden
        }

        .sidebar::-webkit-scrollbar {
            width: 3px
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .1);
            border-radius: 3px
        }

        .sb-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px 16px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, .06)
        }

        .sb-logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            animation: floatY 3s ease-in-out infinite
        }

        .sb-logo-icon i {
            font-size: 18px;
            color: #fff
        }

        .sb-logo-name {
            font-family: var(--font-head);
            font-size: 16px;
            font-weight: 800;
            color: #fff
        }

        .sb-logo-name em {
            color: var(--teal-b);
            font-style: normal
        }

        .sb-nav {
            padding: 8px 8px;
            flex: 1
        }

        .sb-group {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .25);
            padding: 12px 10px 5px
        }

        .sb-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            margin: 1px 0;
            border-radius: var(--r-md);
            color: rgba(255, 255, 255, .5);
            font-size: 13px;
            font-weight: 600;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            transition: all .18s
        }

        .sb-item i {
            font-size: 17px;
            flex-shrink: 0
        }

        .sb-item:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff
        }

        .sb-item.active {
            background: var(--teal);
            color: #fff
        }

        .sb-badge {
            margin-left: auto;
            background: var(--rose);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 10px
        }

        .sb-user {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, .06);
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 9px;
            cursor: pointer
        }

        .sb-user-av {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--teal);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .sb-user-name {
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            display: block
        }

        .sb-user-role {
            font-size: 10px;
            color: rgba(255, 255, 255, .35)
        }

        /* MAIN */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0
        }

        /* TOPBAR */
        .topbar {
            background: var(--white);
            border-bottom: 1.5px solid var(--teal-l);
            padding: 0 22px;
            height: 56px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            z-index: 10
        }

        .tb-title {
            font-family: var(--font-head);
            font-size: 15px;
            font-weight: 800;
            color: var(--navy)
        }

        .tb-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--teal-ll);
            border: 1.5px solid var(--teal-l);
            border-radius: var(--r-md);
            padding: 7px 13px;
            flex: 1;
            max-width: 280px
        }

        .tb-search i {
            font-size: 15px;
            color: var(--teal)
        }

        .tb-search input {
            border: none;
            background: none;
            outline: none;
            font-size: 12px;
            color: var(--navy);
            width: 100%;
            font-family: var(--font-body)
        }

        .tb-search input::placeholder {
            color: var(--teal-d);
            opacity: .6
        }

        .tb-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .tb-icon-btn {
            width: 36px;
            height: 36px;
            border-radius: var(--r-md);
            background: var(--teal-ll);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .18s;
            position: relative
        }

        .tb-icon-btn:hover {
            background: var(--teal-l)
        }

        .tb-icon-btn i {
            font-size: 18px;
            color: var(--teal)
        }

        .notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--rose);
            animation: pulseDot 2s ease-in-out infinite
        }

        .tb-user {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: var(--r-md);
            background: var(--teal-ll);
            border: 1.5px solid var(--teal-l);
            transition: background .18s;
            cursor: pointer
        }

        .tb-user:hover {
            background: var(--teal-l)
        }

        .tb-user-av {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--teal);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .tb-user span {
            font-size: 12px;
            font-weight: 700;
            color: var(--teal-d)
        }

        /* CONTENT */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px
        }

        .content::-webkit-scrollbar {
            width: 5px
        }

        .content::-webkit-scrollbar-thumb {
            background: var(--teal-l);
            border-radius: 5px
        }

        .panel {
            display: none;
            animation: panelIn .3s ease both
        }

        .panel.show {
            display: block
        }

        /* ANNOUNCE */
        .announce {
            background: var(--teal-ll);
            border: 1.5px solid var(--teal-l);
            border-radius: var(--r-lg);
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
            animation: fadeUp .4s ease both
        }

        .announce>i {
            font-size: 19px;
            color: var(--teal);
            flex-shrink: 0;
            margin-top: 1px
        }

        .ann-body strong {
            font-size: 12px;
            font-weight: 800;
            color: var(--teal-dd);
            display: block;
            margin-bottom: 2px
        }

        .ann-body span {
            font-size: 11px;
            color: var(--teal-d)
        }

        .ann-close {
            margin-left: auto;
            flex-shrink: 0;
            background: none;
            border: none;
            font-size: 15px;
            color: var(--teal);
            padding: 2px;
            line-height: 1;
            cursor: pointer
        }

        /* WELCOME */
        .welcome {
            background: var(--navy);
            border-radius: var(--r-xl);
            padding: 26px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            position: relative;
            overflow: hidden;
            animation: fadeUp .5s ease .05s both
        }

        .welcome::before {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(13, 148, 136, .18);
            top: -100px;
            right: 60px
        }

        .wb-left {
            position: relative;
            z-index: 2
        }

        .wb-eyebrow {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--teal-b);
            margin-bottom: 6px
        }

        .wb-left h1 {
            font-family: var(--font-head);
            font-size: 26px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 6px
        }

        .wb-left p {
            font-size: 13px;
            color: rgba(255, 255, 255, .55)
        }

        .wb-status {
            position: relative;
            background: rgba(255, 255, 255, .09);
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: var(--r-lg);
            padding: 13px 18px;
            display: flex;
            align-items: center;
            gap: 13px;
            z-index: 2
        }

        .wb-stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floatY 3s ease-in-out infinite;
            flex-shrink: 0
        }

        .wb-stat-icon i {
            font-size: 20px;
            color: #fff
        }

        .wb-stat-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .38);
            margin-bottom: 4px
        }

        .wb-stat-val {
            display: flex;
            align-items: center;
            gap: 7px
        }

        .wb-green {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e
        }

        .wb-stat-val span {
            font-size: 13px;
            font-weight: 800;
            color: #fff
        }

        /* STAT CARDS */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 16px
        }

        .sc {
            background: var(--white);
            border-radius: var(--r-lg);
            padding: 16px;
            border: 1.5px solid var(--teal-l);
            text-align: center;
            transition: all .22s;
            cursor: pointer;
            animation: countIn .45s ease both
        }

        .sc:hover {
            transform: translateY(-4px);
            border-color: var(--teal);
            box-shadow: 0 8px 24px rgba(13, 148, 136, .1)
        }

        .sc-ico {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px
        }

        .sc-ico i {
            font-size: 20px
        }

        .sc-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 4px
        }

        .sc-val {
            font-family: var(--font-head);
            font-size: 28px;
            font-weight: 900
        }

        .sc-trend {
            font-size: 11px;
            font-weight: 600;
            margin-top: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px
        }

        /* GRID */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 14px
        }

        .flex-col {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        /* CARD */
        .card {
            background: var(--white);
            border-radius: var(--r-lg);
            border: 1.5px solid var(--teal-l);
            padding: 18px
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px
        }

        .card-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .card-ico {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .card-ico i {
            font-size: 17px
        }

        .card-title {
            font-family: var(--font-head);
            font-size: 13px;
            font-weight: 800;
            color: var(--navy)
        }

        .card-sub {
            font-size: 11px;
            color: var(--gray);
            margin-top: 1px
        }

        .card-action {
            font-size: 11px;
            font-weight: 700;
            color: var(--teal);
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 3px;
            transition: color .18s;
            cursor: pointer
        }

        .card-action:hover {
            color: var(--teal-d)
        }

        /* STUDENT ROW */
        .stu {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 6px;
            border-radius: var(--r-md);
            cursor: pointer;
            transition: background .16s;
            border-bottom: 1px solid var(--teal-l)
        }

        .stu:last-child {
            border: none;
            padding-bottom: 0
        }

        .stu:hover {
            background: var(--teal-ll)
        }

        .stu-av {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
            flex-shrink: 0
        }

        .stu-name {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy)
        }

        .stu-meta {
            font-size: 10px;
            color: var(--gray);
            margin-top: 1px
        }

        /* PILL */
        .pill {
            padding: 3px 9px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
            border: none;
            cursor: pointer
        }

        /* PROGRESS */
        .prog {
            margin-bottom: 12px
        }

        .prog:last-child {
            margin-bottom: 0
        }

        .prog-top {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 5px
        }

        .prog-track {
            height: 8px;
            background: var(--teal-l);
            border-radius: 8px;
            overflow: hidden
        }

        .prog-bar {
            height: 100%;
            border-radius: 8px;
            animation: progFill .9s ease both
        }

        /* SESSION */
        .sess {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 6px;
            border-radius: var(--r-md);
            cursor: pointer;
            transition: background .16s;
            border-bottom: 1px solid var(--teal-l)
        }

        .sess:last-child {
            border: none;
            padding-bottom: 0
        }

        .sess:hover {
            background: var(--teal-ll)
        }

        .sess-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            flex-shrink: 0
        }

        .sess-ico {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .sess-ico i {
            font-size: 13px
        }

        .sess-name {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
            display: block
        }

        .sess-who {
            font-size: 10px;
            color: var(--gray)
        }

        .sess-time {
            font-size: 10px;
            font-weight: 700;
            margin-left: auto;
            text-align: right
        }

        /* COMPLIANCE */
        .comp {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 6px;
            border-bottom: 1px solid var(--teal-l);
            font-size: 12px
        }

        .comp:last-child {
            border: none;
            padding-bottom: 0
        }

        .comp-s {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700
        }

        .cdot {
            width: 7px;
            height: 7px;
            border-radius: 50%
        }

        /* SCHEDULE */
        .sched {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 6px;
            border-bottom: 1px solid var(--teal-l)
        }

        .sched:last-child {
            border: none;
            padding-bottom: 0
        }

        .sched-t {
            font-size: 10px;
            font-weight: 700;
            color: var(--gray);
            min-width: 36px;
            padding-top: 2px
        }

        .sched-line {
            width: 2px;
            border-radius: 2px;
            min-height: 34px;
            flex-shrink: 0;
            margin-top: 3px
        }

        .sched-name {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
            display: block
        }

        .sched-loc {
            font-size: 10px;
            color: var(--gray)
        }

        /* BUTTONS */
        .btn-teal {
            padding: 10px 22px;
            border-radius: 24px;
            background: var(--teal);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all .18s;
            cursor: pointer
        }

        .btn-teal:hover {
            background: var(--teal-d);
            transform: translateY(-1px)
        }

        .eyebrow {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 8px
        }

        /* USER DROPDOWN */
        .user-dropdown {
            position: relative;
        }

        .user-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border: 1.5px solid var(--teal-l);
            border-radius: var(--r-md);
            width: 150px;
            z-index: 1000;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .1)
        }

        .user-menu.show {
            display: block
        }

        .user-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border: none;
            background: none;
            color: var(--navy);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border-bottom: 1px solid var(--teal-l);
            width: 100%;
            text-align: left;
            transition: background .2s
        }

        .user-menu a:last-child {
            border-bottom: none
        }

        .user-menu a:hover {
            background: var(--teal-ll)
        }

        .user-menu a i {
            font-size: 15px;
            color: var(--teal)
        }

        .user-menu a.logout {
            color: var(--rose)
        }

        .user-menu a.logout i {
            color: var(--rose)
        }

        /* QA GRID */
        .qa-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 14px
        }

        .qa {
            background: var(--white);
            border: 1.5px solid var(--teal-l);
            border-radius: var(--r-lg);
            padding: 14px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .2s;
            text-align: center
        }

        .qa:hover {
            border-color: var(--teal);
            background: var(--teal-ll);
            transform: translateY(-3px)
        }

        .qa-ico {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .qa-ico i {
            font-size: 19px
        }

        .qa strong {
            font-size: 11px;
            font-weight: 800;
            color: var(--navy)
        }

        .qa span {
            font-size: 10px;
            color: var(--gray)
        }

        @media(max-width:768px) {
            .stat-row {
                grid-template-columns: repeat(2, 1fr)
            }

            .grid-2 {
                grid-template-columns: 1fr
            }

            .grid-3 {
                grid-template-columns: repeat(2, 1fr)
            }

            .qa-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .sidebar {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                z-index: 100;
                transform: translateX(-100%);
                transition: transform .3s
            }

            .sidebar.open {
                transform: translateX(0)
            }
        }
    </style>
</head>

<body class="{{ $bodyClasses ?? '' }}">

    <div class="app">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sb-logo">
                <div class="sb-logo-icon"><i class="ti ti-book-2"></i></div>
                <span class="sb-logo-name">Edu<em>Echo</em></span>
            </div>

            <div class="sb-nav">
                @if(Auth::user()->hasRole('admin'))
                    <div class="sb-group">Main</div>
                    <button class="sb-item active" onclick="showPanel('overview',this)">
                        <i class="ti ti-layout-dashboard"></i> Dashboard
                    </button>
                    <button class="sb-item" onclick="showPanel('students',this)">
                        <i class="ti ti-users"></i> Students
                    </button>
                    <button class="sb-item" onclick="showPanel('educators',this)">
                        <i class="ti ti-school"></i> Educators
                    </button>
                    <button class="sb-item" onclick="showPanel('therapy',this)">
                        <i class="ti ti-heart-handshake"></i> Therapists
                    </button>

                    <div class="sb-group">Management</div>
                    <button class="sb-item" onclick="showPanel('courses',this)">
                        <i class="ti ti-books"></i> Courses
                    </button>
                    <button class="sb-item" onclick="showPanel('therapy-sessions',this)">
                        <i class="ti ti-calendar-event"></i> Therapy Sessions
                    </button>
                    <button class="sb-item" onclick="showPanel('reports',this)">
                        <i class="ti ti-chart-bar"></i> Reports
                    </button>
                    <button class="sb-item" onclick="showPanel('notifications',this)">
                        <i class="ti ti-bell"></i> Notifications
                    </button>

                    <div class="sb-group">System</div>
                    <button class="sb-item" onclick="showPanel('settings',this)">
                        <i class="ti ti-settings"></i> Settings
                    </button>
                @elseif(Auth::user()->hasRole('student'))
                    <div class="sb-group">Main</div>
                    <button class="sb-item active" onclick="showPanel('overview',this)">
                        <i class="ti ti-layout-dashboard"></i> Dashboard
                    </button>
                    <button class="sb-item" onclick="showPanel('courses',this)">
                        <i class="ti ti-books"></i> My Courses
                    </button>
                    <button class="sb-item" onclick="showPanel('therapy-sessions',this)">
                        <i class="ti ti-calendar-event"></i> Therapy Sessions
                    </button>

                    <div class="sb-group">Information</div>
                    <button class="sb-item" onclick="showPanel('notifications',this)">
                        <i class="ti ti-bell"></i> Notifications
                    </button>
                    <button class="sb-item" onclick="showPanel('accessibility',this)">
                        <i class="ti ti-accessible"></i> Accessibility
                    </button>

                    <div class="sb-group">Account</div>
                    <button class="sb-item" onclick="showPanel('support',this)">
                        <i class="ti ti-headset"></i> Support
                    </button>
                    <button class="sb-item" onclick="showPanel('profile',this)">
                        <i class="ti ti-user"></i> Profile
                    </button>
                @else
                    {{-- Generic Navigation for other roles --}}
                    <div class="sb-group">Main</div>
                    <button class="sb-item active" onclick="showPanel('overview',this)">
                        <i class="ti ti-layout-dashboard"></i> Dashboard
                    </button>
                @endif
            </div>

            <div class="sb-user" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="sb-user-av" style="background:var(--rose)"><i class="ti ti-logout" style="color:#fff; font-size:14px;"></i></div>
                <div>
                    <span class="sb-user-name">Logout</span>
                    <span class="sb-user-role">Securely exit</span>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main">

            <!-- TOPBAR -->
            <div class="topbar">
                <span class="tb-title" id="pageTitle">Dashboard</span>
                <div class="tb-search">
                    <i class="ti ti-search"></i>
                    <input type="text" placeholder="Search students, courses, IEPs...">
                </div>
                <div class="tb-right">
                    <button class="tb-icon-btn" title="Search">
                        <i class="ti ti-search"></i>
                    </button>
                    <button class="tb-icon-btn" title="Accessibility Settings" onclick="showPanel('accessibility', document.querySelector('.sb-item[onclick*=\'accessibility\']'))">
                        <i class="ti ti-accessible"></i>
                    </button>
                    <button class="tb-icon-btn" title="Toggle Theme" onclick="document.body.classList.toggle('dark-mode')">
                        <i class="ti ti-moon"></i>
                    </button>
                    @if(Auth::user()->hasRole('student') && ($accessibilityProfile->text_to_speech ?? false))
                        <button class="tb-icon-btn" title="Listen to Page" onclick="toggleTTS()" id="tts-btn">
                            <i class="ti ti-volume"></i>
                        </button>
                    @endif
                    <button class="tb-icon-btn" title="Notifications" onclick="showPanel('notifications', document.querySelector('.sb-item[onclick*=\'notifications\']'))">
                        <i class="ti ti-bell"></i>
                        <div class="notif-dot"></div>
                    </button>
                    <div class="user-dropdown">
                        <div class="tb-user" onclick="toggleUserMenu()">
                            <div class="tb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
                        </div>
                        <div class="user-menu" id="userMenu">
                            <a href="{{ route('profile.edit') }}">
                                <i class="ti ti-user"></i> Profile
                            </a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="logout">
                                <i class="ti ti-logout"></i> Logout
                            </a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">

                <!-- OVERVIEW PANEL -->
                <div class="panel show" id="panel-overview">
                    <div class="welcome">
                        <div class="wb-left">
                            @if(Auth::user()->hasRole('admin'))
                                <div class="wb-eyebrow">Administrator Portal</div>
                                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                                <p>System operational and running smoothly.</p>
                            @elseif(Auth::user()->hasRole('student'))
                                <div class="wb-eyebrow">Student Dashboard</div>
                                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                                <p>Your learning journey continues here.</p>
                            @elseif(Auth::user()->hasRole('special_educator'))
                                <div class="wb-eyebrow">Educator Portal</div>
                                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                                <p>Supporting student success through specialized education.</p>
                            @else
                                <div class="wb-eyebrow">Dashboard</div>
                                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                                <p>Access your educational tools and resources.</p>
                            @endif
                        </div>
                        @if(Auth::user()->hasRole('student') && isset($disabilityProfile))
                            <div class="wb-status">
                                <div class="wb-stat-icon"><i class="ti ti-accessible"></i></div>
                                <div class="wb-stat-label">Disability Profile</div>
                                <div class="wb-stat-val">
                                    <div class="wb-green"></div>
                                    <span>{{ ucfirst(str_replace('_', ' ', $disabilityProfile->disability_type ?? 'Not specified')) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if(Auth::user()->hasRole('student'))
                        @php 
                            $dType = trim(strtolower($disabilityProfile->disability_type ?? '')); 
                            $isVisual = (strpos($dType, 'visual') !== false || strpos($dType, 'blind') !== false || strpos($dType, 'vision') !== false);
                            $isHearing = (strpos($dType, 'hearing') !== false || strpos($dType, 'deaf') !== false || strpos($dType, 'audio') !== false);
                            $isDyslexia = (strpos($dType, 'dyslexia') !== false || strpos($dType, 'reading') !== false || strpos($dType, 'font') !== false);
                        @endphp
                        <!-- Disability Debug: Raw="{{ $disabilityProfile->disability_type ?? 'NONE' }}", Clean="{{ $dType }}", V:{{ $isVisual?'Y':'N' }}, H:{{ $isHearing?'Y':'N' }}, D:{{ $isDyslexia?'Y':'N' }} -->
                        <div class="eyebrow" style="margin-top:24px">Personalized Learning Resources</div>
                        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:16px; margin-top:12px;">
                        @forelse($disabilityResources ?? [] as $res)
                            <div class="card" onclick="showPanel('courses', null)" style="padding:16px; border-left:4px solid {{ $isVisual ? 'var(--amber)' : ($isHearing ? 'var(--blue)' : 'var(--teal)') }}; cursor:pointer;">
                                <div style="display:flex; gap:12px; align-items:center;">
                                    <div style="width:36px; height:36px; border-radius:8px; background:{{ $isVisual ? 'var(--al)' : ($isHearing ? 'var(--bl)' : 'var(--teal-ll)') }}; display:flex; align-items:center; justify-content:center;">
                                        <i class="ti ti-{{ $isVisual ? 'headphones' : ($isHearing ? 'captions' : 'typography') }}" style="color:{{ $isVisual ? 'var(--amber)' : ($isHearing ? 'var(--blue)' : 'var(--teal)') }}"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight:700; font-size:13px; color:var(--navy)">{{ $res->title }}</div>
                                        <div style="font-size:11px; color:var(--gray)">{{ Str::limit($res->description, 40) }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card" style="padding:16px; border-left:4px solid var(--violet);">
                                <div style="display:flex; gap:12px; align-items:center;">
                                    <div style="width:36px; height:36px; border-radius:8px; background:var(--violet-l); display:flex; align-items:center; justify-content:center;">
                                        <i class="ti ti-star" style="color:var(--violet)"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight:700; font-size:13px; color:var(--navy)">General Resources</div>
                                        <div style="font-size:11px; color:var(--gray)">Recommended based on your profile</div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        </div>
                    @endif

                    @if(Auth::user()->hasRole('admin'))
                        <div class="stat-row" style="grid-template-columns: repeat(3, 1fr);">
                            <div class="sc" onclick="showPanel('students',null)">
                                <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-users"
                                        style="color:var(--teal)"></i></div>
                                <div class="sc-label">Total Students</div>
                                <div class="sc-val" style="color:var(--teal)">{{ $stats['total_students'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="showPanel('educators',null)">
                                <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-school"
                                        style="color:var(--violet)"></i></div>
                                <div class="sc-label">Total Educators</div>
                                <div class="sc-val" style="color:var(--violet)">{{ $stats['total_educators'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="showPanel('therapy',null)">
                                <div class="sc-ico" style="background:var(--rl)"><i class="ti ti-heart-handshake"
                                        style="color:var(--rd)"></i></div>
                                <div class="sc-label">Total Therapists</div>
                                <div class="sc-val" style="color:var(--rd)">{{ $stats['total_therapists'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="showPanel('courses',null)">
                                <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-books"
                                        style="color:var(--teal)"></i></div>
                                <div class="sc-label">Total Courses</div>
                                <div class="sc-val" style="color:var(--teal)">{{ $stats['total_courses'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="window.location.href='{{ route('educator-request.index') }}'">
                                <div class="sc-ico" style="background:var(--al)"><i class="ti ti-clock"
                                        style="color:var(--ad)"></i></div>
                                <div class="sc-label">Pending Requests</div>
                                <div class="sc-val" style="color:var(--ad)">{{ $stats['pending_requests'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="showPanel('therapy-sessions',null)">
                                <div class="sc-ico" style="background:var(--bl)"><i class="ti ti-calendar-event"
                                        style="color:var(--blue)"></i></div>
                                <div class="sc-label">Upcoming Therapy Sessions</div>
                                <div class="sc-val" style="color:var(--blue)">{{ $stats['upcoming_sessions'] ?? 0 }}</div>
                            </div>
                        </div>
                    @elseif(Auth::user()->hasRole('student'))
                        <div class="stat-row" style="grid-template-columns: repeat(2, 1fr);">
                            <div class="sc" onclick="showPanel('courses',null)">
                                <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-books"
                                        style="color:var(--teal)"></i></div>
                                <div class="sc-label">Enrolled Courses</div>
                                <div class="sc-val" style="color:var(--teal)">{{ $stats['enrolled_courses'] ?? 0 }}</div>
                            </div>
                            <div class="sc">
                                <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-checklist"
                                        style="color:var(--violet)"></i></div>
                                <div class="sc-label">Completed Lessons</div>
                                <div class="sc-val" style="color:var(--violet)">{{ $stats['completed_lessons'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="showPanel('therapy-sessions',null)">
                                <div class="sc-ico" style="background:var(--rl)"><i class="ti ti-heart-handshake"
                                        style="color:var(--rd)"></i></div>
                                <div class="sc-label">Upcoming Therapy Sessions</div>
                                <div class="sc-val" style="color:var(--rd)">{{ $stats['therapy_sessions'] ?? 0 }}</div>
                            </div>
                            <div class="sc" onclick="showPanel('notifications',null)">
                                <div class="sc-ico" style="background:var(--bl)"><i class="ti ti-bell"
                                        style="color:var(--blue)"></i></div>
                                <div class="sc-label">Notifications</div>
                                <div class="sc-val" style="color:var(--blue)">{{ $stats['notifications'] ?? 0 }}</div>
                            </div>
                        </div>
                    @elseif(Auth::user()->hasRole('special_educator'))
                        <div class="stat-row">
                            <div class="sc">
                                <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-users"
                                        style="color:var(--teal)"></i></div>
                                <div class="sc-label">My Students</div>
                                <div class="sc-val" style="color:var(--teal)">{{ $stats['total_students'] ?? 0 }}</div>
                            </div>
                            <div class="sc">
                                <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-books"
                                        style="color:var(--violet)"></i></div>
                                <div class="sc-label">My Courses</div>
                                <div class="sc-val" style="color:var(--violet)">{{ $stats['total_courses'] ?? 0 }}</div>
                            </div>
                            <div class="sc">
                                <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-clipboard-list"
                                        style="color:var(--teal)"></i></div>
                                <div class="sc-label">My IEPs</div>
                                <div class="sc-val" style="color:var(--teal)">{{ $stats['total_ieps'] ?? 0 }}</div>
                            </div>
                            <div class="sc">
                                <div class="sc-ico" style="background:var(--al)"><i class="ti ti-message-circle"
                                        style="color:var(--ad)"></i></div>
                                <div class="sc-label">Active Chats</div>
                                <div class="sc-val" style="color:var(--ad)">{{ $recentStudents->count() ?? 0 }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- QUICK ACTIONS -->
                    @if(Auth::user()->hasRole('admin'))
                        <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
                        <div class="qa-grid" style="grid-template-columns: repeat(5, 1fr);">
                            <div class="qa" onclick="showPanel('assignments',null)">
                                <div class="qa-ico" style="background:var(--violet-ll)"><i class="ti ti-school"
                                        style="color:var(--violet)"></i></div>
                                <strong>Approve Educators</strong>
                                <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">{{ $stats['pending_requests'] ?? 0 }} Pending</span>
                            </div>
                            <div class="qa" onclick="showPanel('assignments',null)">
                                <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-heart-handshake"
                                        style="color:var(--rd)"></i></div>
                                <strong>Approve Therapists</strong>
                                <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">{{ $stats['pending_requests'] ?? 0 }} Pending</span>
                            </div>
                            <div class="qa" onclick="showPanel('courses',null)">
                                <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-book-upload"
                                        style="color:var(--teal)"></i></div>
                                <strong>Create Course</strong>
                                <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">New Module</span>
                            </div>
                            <div class="qa" onclick="showPanel('therapy-sessions',null)">
                                <div class="qa-ico" style="background:var(--bl)"><i class="ti ti-calendar-plus"
                                        style="color:var(--blue)"></i></div>
                                <strong>Schedule Therapy</strong>
                                <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">Book Session</span>
                            </div>
                            <div class="qa" onclick="showPanel('notifications',null)">
                                <div class="qa-ico" style="background:var(--al)"><i class="ti ti-broadcast"
                                        style="color:var(--ad)"></i></div>
                                <strong>Send Announcement</strong>
                                <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">Broadcast</span>
                            </div>
                        </div>

                        <!-- RECENT ACTIVITIES -->
                        <div class="eyebrow" style="margin-top:24px">Recent Activities</div>
                        <div class="card" style="margin-top:12px; max-height:300px; overflow-y:auto;">
                            @forelse($recentActivities ?? [] as $activity)
                                <div style="padding:12px 16px;border-bottom:1px solid var(--teal-ll);display:flex;justify-content:space-between;align-items:center;">
                                    <div>
                                        <div style="font-size:12px;font-weight:700;color:var(--navy)">{{ $activity->title }}</div>
                                        <div style="font-size:11px;color:var(--gray);margin-top:2px">{{ $activity->message }}</div>
                                    </div>
                                    <div style="font-size:10px;color:var(--teal)">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @empty
                                <div style="padding:20px;text-align:center;color:var(--gray);font-size:12px">No recent activities</div>
                            @endforelse
                        </div>

                    @elseif(Auth::user()->hasRole('student'))
                        <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
                        <div class="qa-grid">
                            @if(isset($user->student) && $user->student->assigned_educator_id)
                                <div class="qa" onclick="window.location.href='{{ route('tutoring.hub') }}'">
                                    <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-message-circle"
                                            style="color:var(--teal)"></i></div>
                                    <strong>Chat with Tutor</strong>
                                </div>
                            @else
                                <div class="qa" onclick="window.location.href='{{ route('tutoring.find-tutors') }}'">
                                    <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-user-search"
                                            style="color:var(--teal)"></i></div>
                                    <strong>Find a Tutor</strong>
                                </div>
                            @endif
                            <div class="qa" onclick="showPanel('courses',null)">
                                <div class="qa-ico" style="background:var(--violet-l)"><i class="ti ti-books"
                                        style="color:var(--violet)"></i></div>
                                <strong>My Courses</strong>
                            </div>
                            <div class="qa" onclick="showPanel('assessments',null)">
                                <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-writing"
                                        style="color:var(--rd)"></i></div>
                                <strong>Take Assessment</strong>
                            </div>
                            <div class="qa" onclick="showPanel('therapy',null)">
                                <div class="qa-ico" style="background:var(--al)"><i class="ti ti-heart"
                                        style="color:var(--ad)"></i></div>
                                <strong>My Therapy</strong>
                            </div>
                        </div>
                    @elseif(Auth::user()->hasRole('special_educator'))
                        <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
                        <div class="qa-grid">
                            <div class="qa" onclick="window.location.href='{{ route('tutoring.matching') }}'">
                                <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-user-search"
                                        style="color:var(--teal)"></i></div>
                                <strong>Find Students</strong>
                            </div>
                            <div class="qa" onclick="window.location.href='{{ route('tutoring.hub') }}'">
                                <div class="qa-ico" style="background:var(--violet-l)"><i class="ti ti-message-circle"
                                        style="color:var(--violet)"></i></div>
                                <strong>Chat with Students</strong>
                            </div>
                            <div class="qa" onclick="showPanel('courses',null)">
                                <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-book-plus"
                                        style="color:var(--rd)"></i></div>
                                <strong>Create Course</strong>
                            </div>
                            <div class="qa" onclick="showPanel('ieps',null)">
                                <div class="qa-ico" style="background:var(--al)"><i class="ti ti-clipboard-plus"
                                        style="color:var(--ad)"></i></div>
                                <strong>Create IEP</strong>
                            </div>
                        </div>
                    @endif
                </div><!-- /overview -->

                @php
                    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\User> $allStudents */
                    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\User> $allEducators */
                    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\User> $allTherapists */
                    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\TherapySession> $upcomingSessions */
                @endphp

                <!-- STUDENTS PANEL -->
                <div class="panel" id="panel-students">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                        <div>
                            <div class="eyebrow">Management</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                                All Students</div>
                        </div>
                        <button class="btn-teal" onclick="showModal('add-student-modal')"><i class="ti ti-user-plus"></i> Add Student</button>
                    </div>
                    <div style="display:flex; gap:12px; margin-bottom:16px;">
                        <div style="flex:1; position:relative;">
                            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
                            <input type="text" placeholder="Search students by name or email..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                        </div>
                        <select style="padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; cursor:pointer;">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="card">
                        @forelse($allStudents ?? [] as $student)
                            <div class="stu" style="padding:15px 10px">
                                <div class="stu-av"
                                    style="background:var(--teal-ll);color:var(--teal-d);width:40px;height:40px;font-size:14px">
                                    {{ substr($student->name, 0, 1) }}</div>
                                <div style="flex:1; display:flex; justify-content:space-between; align-items:center;">
                                    <div style="flex:1">
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-right:16px;">
                                            <div class="stu-name">{{ $student->name }}</div>
                                            <span class="pill"
                                                style="background:var(--teal-ll);color:var(--teal-d);font-size:9px">
                                                {{ $student->student?->disabilityProfile?->disability_type ?? 'No Disability' }}
                                            </span>
                                        </div>
                                        <div class="stu-meta">{{ $student->email }}</div>
                                        <div style="margin-top:6px;display:flex;gap:12px;font-size:10px;color:var(--gray)">
                                            <span><i class="ti ti-books"></i>
                                                {{ $student->student?->courseEnrollments?->count() ?? 0 }} Courses</span>
                                            <span><i class="ti ti-calendar"></i> Registered:
                                                {{ $student->created_at->format('M Y') }}</span>
                                        </div>
                                    </div>
                                    <div style="display:flex; gap:8px;">
                                        <form method="POST" action="{{ route('admin.users.toggle-status', $student->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $student->is_active ? 'var(--teal-ll)' : 'var(--gray)' }}; color:{{ $student->is_active ? 'var(--teal)' : '#fff' }}">
                                                {{ $student->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.destroy', $student->id) }}" onsubmit="return confirm('Delete this student?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="pill" style="border:none; cursor:pointer; background:var(--rose); color:#fff">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p style="text-align:center;color:var(--gray);padding:20px">No students found</p>
                        @endforelse
                    </div>
                </div>

                <!-- EDUCATORS PANEL -->
                <div class="panel" id="panel-educators">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                        <div>
                            <div class="eyebrow">Management</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                                All Educators</div>
                        </div>
                        <button class="btn-teal" style="background:var(--violet)" onclick="showModal('add-educator-modal')"><i class="ti ti-school"></i> Add Educator</button>
                    </div>
                    <div style="display:flex; gap:12px; margin-bottom:16px;">
                        <div style="flex:1; position:relative;">
                            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
                            <input type="text" placeholder="Search educators by name or email..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                        </div>
                        <select style="padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; cursor:pointer;">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="card">
                        @forelse($allEducators ?? [] as $educator)
                            <div class="stu" style="padding:15px 10px">
                                <div class="stu-av"
                                    style="background:var(--violet-l);color:var(--violet-d);width:40px;height:40px;font-size:14px">
                                    {{ substr($educator->name, 0, 1) }}</div>
                                <div style="flex:1; display:flex; justify-content:space-between; align-items:center;">
                                    <div style="flex:1">
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-right:16px;">
                                            <div class="stu-name">{{ $educator->name }}</div>
                                            <div style="display:flex;gap:4px">
                                                @foreach($educator->specialEducator?->disabilitySpecializations ?? [] as $spec)
                                                    <span class="pill"
                                                        style="background:var(--violet-l);color:var(--violet-d);font-size:8px">
                                                        {{ $spec->disability_type }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="stu-meta">{{ $educator->email }}</div>
                                        <div style="margin-top:6px;display:flex;gap:12px;font-size:10px;color:var(--gray)">
                                            <span><i class="ti ti-history"></i>
                                                {{ $educator->specialEducator?->experience_years ?? 0 }} Years Exp.</span>
                                            <span><i class="ti ti-certificate"></i>
                                                {{ $educator->specialEducator?->qualification ?? 'Certified' }}</span>
                                        </div>
                                    </div>
                                    <div style="display:flex; gap:8px;">
                                        <form method="POST" action="{{ route('admin.users.toggle-status', $educator->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $educator->is_active ? 'var(--violet-l)' : 'var(--gray)' }}; color:{{ $educator->is_active ? 'var(--violet)' : '#fff' }}">
                                                {{ $educator->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.destroy', $educator->id) }}" onsubmit="return confirm('Delete this educator?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="pill" style="border:none; cursor:pointer; background:var(--rose); color:#fff">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p style="text-align:center;color:var(--gray);padding:20px">No educators found</p>
                        @endforelse
                    </div>
                </div>

                <!-- THERAPY PANEL -->
                <div class="panel" id="panel-therapy">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                        <div>
                            <div class="eyebrow" style="color:var(--rd)">Wellness</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                                Therapy Specialists</div>
                        </div>
                        <button class="btn-teal" style="background:var(--rose)" onclick="showModal('add-therapist-modal')"><i class="ti ti-heart-handshake"></i> Add Therapist</button>
                    </div>
                    <div style="display:flex; gap:12px; margin-bottom:16px;">
                        <div style="flex:1; position:relative;">
                            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
                            <input type="text" placeholder="Search therapists by name or email..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                        </div>
                        <select style="padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; cursor:pointer;">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="card">
                        @forelse($allTherapists ?? [] as $therapist)
                            <div class="stu" style="padding:15px 10px">
                                <div class="stu-av"
                                    style="background:var(--rl);color:var(--rd);width:40px;height:40px;font-size:14px">
                                    {{ substr($therapist->name, 0, 1) }}</div>
                                <div style="flex:1; display:flex; justify-content:space-between; align-items:center;">
                                    <div style="flex:1">
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-right:16px;">
                                            <div class="stu-name">{{ $therapist->name }}</div>
                                            <span class="pill" style="background:var(--rl);color:var(--rd);font-size:9px">
                                                {{ $therapist->therapist?->specialization ?? 'General Therapy' }}
                                            </span>
                                        </div>
                                        <div class="stu-meta">{{ $therapist->email }}</div>
                                        <div style="margin-top:6px;display:flex;gap:12px;font-size:10px;color:var(--gray)">
                                            <span><i class="ti ti-certificate"></i>
                                                {{ $therapist->therapist?->certification ?? 'Licensed' }}</span>
                                            <span><i class="ti ti-history"></i>
                                                {{ $therapist->therapist?->experience_years ?? 0 }} Years Exp.</span>
                                        </div>
                                    </div>
                                    <div style="display:flex; gap:8px;">
                                        <form method="POST" action="{{ route('admin.users.toggle-status', $therapist->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $therapist->is_active ? 'var(--rl)' : 'var(--gray)' }}; color:{{ $therapist->is_active ? 'var(--rd)' : '#fff' }}">
                                                {{ $therapist->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.destroy', $therapist->id) }}" onsubmit="return confirm('Delete this therapist?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="pill" style="border:none; cursor:pointer; background:var(--rose); color:#fff">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p style="text-align:center;color:var(--gray);padding:20px">No therapists found</p>
                        @endforelse
                    </div>
                </div>

                <!-- THERAPY SESSIONS PANEL -->
                <div class="panel" id="panel-therapy-sessions">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                        <div>
                            <div class="eyebrow" style="color:var(--rd)">Wellness</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                                @if(Auth::user()->hasRole('student')) My Therapy Sessions @else Therapy Sessions @endif
                            </div>
                        </div>
                        @if(Auth::user()->hasRole('admin'))
                            <button class="btn-teal" style="background:var(--rose)" onclick="showModal('schedule-session-modal')"><i class="ti ti-calendar-plus"></i> Schedule Session</button>
                        @endif
                    </div>
                    
                    <div class="card">
                        @php 
                            $sessions = Auth::user()->hasRole('student') ? ($upcomingSessions ?? []) : ($allTherapySessions ?? []);
                        @endphp
                        @forelse($sessions as $session)
                            <div class="sess" style="justify-content:space-between; padding:16px; border-bottom:1px solid #f8fafc;">
                                <div style="display:flex; align-items:center; gap:12px; flex:1;">
                                    <div class="sess-ico" style="background:var(--rl)">
                                        <i class="ti ti-calendar-event" style="color:var(--rd)"></i>
                                    </div>
                                    <div>
                                        <span class="sess-name" style="font-weight:700; color:var(--navy);">
                                            @if(Auth::user()->hasRole('student'))
                                                {{ $session->therapist?->name ?? 'Therapist' }}
                                            @else
                                                {{ $session->student?->user?->name ?? 'Student' }}
                                            @endif
                                        </span>
                                        <span class="sess-who" style="font-size:11px; color:var(--gray); margin-left:4px;">
                                            @if(Auth::user()->hasRole('student')) (Your Therapist) @else with {{ $session->therapist?->name ?? 'Therapist' }} @endif
                                        </span>
                                        <div style="margin-top:4px; display:flex; gap:8px; align-items:center;">
                                            <span class="pill" style="background:var(--rl); color:var(--rd); font-size:9px; border:none; padding:2px 6px;">{{ ucfirst($session->session_type ?? 'General') }}</span>
                                            <span style="font-size:10px; color:var(--gray);"><i class="ti ti-clock"></i> {{ $session->duration ?? 60 }}min</span>
                                        </div>
                                    </div>
                                </div>
                                <div style="display:flex; align-items:center; gap:12px; flex-shrink:0;">
                                    <div class="sess-time" style="font-weight:600; color:var(--navy); font-size:13px;">{{ \Carbon\Carbon::parse($session->session_date)->format('M d, Y') }}</div>
                                    @php
                                        $statusColors = [
                                            'SCHEDULED'  => ['bg'=>'var(--bl)', 'color'=>'var(--blue)'],
                                            'COMPLETED'  => ['bg'=>'var(--gl)', 'color'=>'var(--green)'],
                                            'CANCELLED'  => ['bg'=>'var(--rl)', 'color'=>'var(--rd)'],
                                        ];
                                        $sc = $statusColors[$session->status ?? 'SCHEDULED'] ?? ['bg'=>'#f1f5f9','color'=>'#888'];
                                    @endphp
                                    <span class="pill" style="background:{{ $sc['bg'] }}; color:{{ $sc['color'] }}; font-size:10px; border:none;">{{ ucfirst(strtolower($session->status ?? 'Scheduled')) }}</span>
                                    
                                    @if(Auth::user()->hasRole('admin'))
                                        {{-- Admin actions omitted for brevity in student view but kept in code --}}
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center; padding:40px; color:var(--gray);">
                                <i class="ti ti-calendar-off" style="font-size:40px; display:block; margin-bottom:10px;"></i>
                                <p>No upcoming sessions found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- COURSES PANEL -->
                <div class="panel" id="panel-courses">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                        <div>
                            <div class="eyebrow">Education</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                                @if(Auth::user()->hasRole('student')) My Enrolled Courses @else All Courses @endif
                            </div>
                        </div>
                        @if(Auth::user()->hasRole('admin'))
                            <button class="btn-teal" onclick="showModal('add-course-modal')"><i class="ti ti-book-plus"></i> Create Course</button>
                        @endif
                    </div>

                    @if(Auth::user()->hasRole('student'))
                        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:20px;">
                            @forelse($enrolledCourses ?? [] as $course)
                                <div class="card" style="padding:20px; display:flex; flex-direction:column; justify-content:space-between;">
                                    <div>
                                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                            <div style="width:40px; height:40px; border-radius:10px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center;">
                                                <i class="ti ti-book" style="color:var(--teal); font-size:20px;"></i>
                                            </div>
                                            <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:10px;">Enrolled</span>
                                        </div>
                                        <h3 style="font-size:15px; font-weight:700; color:var(--navy); margin-bottom:6px;">{{ $course->title }}</h3>
                                        <div style="display:flex; gap:6px; margin-bottom:12px;">
                                            @if($isHearing)
                                                <span class="pill" style="background:var(--bl); color:var(--blue); font-size:9px;"><i class="ti ti-captions"></i> Captions</span>
                                            @endif
                                            @if($isVisual)
                                                <span class="pill" style="background:var(--al); color:var(--amber); font-size:9px;"><i class="ti ti-volume"></i> Audio</span>
                                            @endif
                                        </div>
                                        <p style="font-size:12px; color:var(--gray); margin-bottom:16px; line-height:1.4;">{{ Str::limit($course->description, 80) }}</p>
                                        
                                        <div style="margin-bottom:16px;">
                                            <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:6px;">
                                                <span style="color:var(--gray)">Progress</span>
                                                <span style="color:var(--teal); font-weight:700;">35%</span>
                                            </div>
                                            <div style="height:6px; background:var(--gray-b); border-radius:3px; overflow:hidden;">
                                                <div style="height:100%; width:35%; background:var(--teal); border-radius:3px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="display:flex; gap:8px;">
                                        <button class="btn-teal" style="flex:1; font-size:12px; padding:10px;">Continue Learning</button>
                                        <button class="btn-teal" style="background:var(--teal-ll); color:var(--teal); padding:10px;" title="Study Materials"><i class="ti ti-files"></i></button>
                                    </div>
                                </div>
                            @empty
                                <div class="card" style="grid-column: 1 / -1; padding:40px; text-align:center;">
                                    <i class="ti ti-book-off" style="font-size:48px; color:var(--gray-b); display:block; margin-bottom:12px;"></i>
                                    <p style="color:var(--gray)">You are not enrolled in any courses yet.</p>
                                </div>
                            @endforelse
                        </div>
                    @else
                        <div style="display:flex; gap:12px; margin-bottom:16px;">
                            <div style="flex:1; position:relative;">
                                <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
                                <input type="text" id="course-search" placeholder="Search courses..." oninput="filterCourses()" style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                            </div>
                            <select id="course-status-filter" onchange="filterCourses()" style="padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; cursor:pointer;">
                                <option value="">All Statuses</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div id="course-list">
                            @forelse($allCourses ?? [] as $course)
                                <div class="course-item" data-title="{{ strtolower($course->title) }}" data-status="{{ $course->is_active ? 'active' : 'inactive' }}"
                                    style="display:flex; align-items:center; justify-content:space-between; padding:16px; border-bottom:1px solid var(--teal-ll);">
                                    <div style="display:flex; align-items:center; gap:14px; flex:1;">
                                        <div style="width:44px; height:44px; border-radius:10px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                            <i class="ti ti-books" style="color:var(--teal); font-size:20px;"></i>
                                        </div>
                                        <div style="flex:1;">
                                            <div style="font-weight:700; color:var(--navy); font-size:14px;">{{ $course->title }}</div>
                                            <div style="font-size:11px; color:var(--gray); margin-top:2px;">
                                                <i class="ti ti-user"></i> {{ $course->creator->name ?? 'N/A' }} &nbsp;&bull;&nbsp;
                                                <i class="ti ti-users"></i> {{ $course->enrollments_count }} enrolled
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                                        @if(Auth::user()->hasRole('admin'))
                                            <form method="POST" action="{{ route('admin.courses.toggle-active', $course->id) }}">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $course->is_active ? 'var(--teal-ll)' : '#f1f5f9' }}; color:{{ $course->is_active ? 'var(--teal)' : 'var(--gray)' }}; padding:4px 10px;">
                                                    {{ $course->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div style="text-align:center; padding:40px; color:var(--gray);">
                                    <p>No courses found.</p>
                                </div>
                            @endforelse
                        </div>
                    @endif
                </div>

                <!-- PENDING APPROVALS PANEL -->
                <div class="panel" id="panel-assignments">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                        <div>
                            <div class="eyebrow" style="color:var(--ad)">Onboarding</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Pending Approval Requests</div>
                        </div>
                    </div>
                    <div class="card" style="padding:0; overflow:hidden;">
                        <table style="width:100%; border-collapse:collapse; text-align:left;">
                            <thead style="background:var(--page); font-size:11px; font-weight:800; color:var(--gray); text-transform:uppercase; letter-spacing:1px;">
                                <tr>
                                    <th style="padding:16px;">Name</th>
                                    <th style="padding:16px;">Role</th>
                                    <th style="padding:16px;">Specialization</th>
                                    <th style="padding:16px;">Status</th>
                                    <th style="padding:16px; text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingEducatorRequests ?? [] as $req)
                                    <tr style="border-bottom:1px solid #f1f5f9;">
                                        <td style="padding:16px;">
                                            <div style="font-weight:700; color:var(--navy); font-size:14px;">{{ $req->user->name ?? 'Unknown' }}</div>
                                            <div style="font-size:11px; color:var(--gray);">{{ $req->user->email ?? '' }}</div>
                                        </td>
                                        <td style="padding:16px;">
                                            <span class="pill" style="background:var(--violet-ll); color:var(--violet);">Educator</span>
                                        </td>
                                        <td style="padding:16px;">
                                            @if($req->specializations)
                                                @foreach((array)$req->specializations as $spec)
                                                    <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:10px; margin-right:4px;">{{ $spec }}</span>
                                                @endforeach
                                            @else
                                                <span style="color:var(--gray); font-size:12px;">Not provided</span>
                                            @endif
                                        </td>
                                        <td style="padding:16px;">
                                            <span class="pill" style="background:var(--al); color:var(--ad);"><i class="ti ti-clock"></i> Pending</span>
                                        </td>
                                        <td style="padding:16px; text-align:right;">
                                            <div style="display:flex; gap:8px; justify-content:flex-end;">
                                                <button class="btn-teal" style="padding:6px 12px; font-size:12px; background:var(--green);"><i class="ti ti-check"></i> Approve</button>
                                                <button class="btn-teal" style="padding:6px 12px; font-size:12px; background:var(--rose);"><i class="ti ti-x"></i> Reject</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="padding:40px; text-align:center; color:var(--gray);">
                                            <i class="ti ti-check" style="font-size:32px; color:var(--green); display:block; margin-bottom:8px;"></i>
                                            All caught up! No pending requests.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel" id="panel-reports">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
                        <div>
                            <div class="eyebrow" style="color:var(--amber)">Analytics</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Reports & Compliance</div>
                        </div>
                    </div>
                    @if(isset($analytics))
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                            <div class="card" style="padding:20px;">
                                <div style="font-weight:700; color:var(--navy); margin-bottom:16px;">Student Registrations</div>
                                <div style="position: relative; height: 250px; width: 100%;">
                                    <canvas id="usersChart"></canvas>
                                </div>
                            </div>
                            <div class="card" style="padding:20px;">
                                <div style="font-weight:700; color:var(--navy); margin-bottom:16px;">Course Completion Statistics</div>
                                <div style="position: relative; height: 250px; width: 100%;">
                                    <canvas id="sessionsChart"></canvas>
                                </div>
                            </div>
                            <div class="card" style="grid-column:1 / -1; padding:20px;">
                                <div style="font-weight:700; color:var(--navy); margin-bottom:16px;">Disability Category Distribution</div>
                                <div style="position: relative; height: 300px; width: 100%;">
                                    <canvas id="coursesChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const getCssVar = (name) => getComputedStyle(document.documentElement).getPropertyValue(name).trim();
                                
                                const usersCtx = document.getElementById('usersChart').getContext('2d');
                                new Chart(usersCtx, {
                                    type: 'bar',
                                    data: {
                                        labels: {!! json_encode(array_keys($analytics['studentRegistrations'])) !!},
                                        datasets: [{
                                            label: 'Registrations',
                                            data: {!! json_encode(array_values($analytics['studentRegistrations'])) !!},
                                            backgroundColor: getCssVar('--teal') || '#14b8a6'
                                        }]
                                    },
                                    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                                });

                                const sessionsCtx = document.getElementById('sessionsChart').getContext('2d');
                                new Chart(sessionsCtx, {
                                    type: 'bar',
                                    data: {
                                        labels: {!! json_encode(array_keys($analytics['courseCompletions'])) !!},
                                        datasets: [{
                                            label: 'Enrollments / Completions',
                                            data: {!! json_encode(array_values($analytics['courseCompletions'])) !!},
                                            backgroundColor: getCssVar('--amber') || '#f59e0b'
                                        }]
                                    },
                                    options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                                });

                                const coursesCtx = document.getElementById('coursesChart').getContext('2d');
                                new Chart(coursesCtx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: {!! json_encode(array_keys($analytics['disabilityDistribution'])) !!},
                                        datasets: [{
                                            data: {!! json_encode(array_values($analytics['disabilityDistribution'])) !!},
                                            backgroundColor: [
                                                getCssVar('--violet') || '#8b5cf6', 
                                                getCssVar('--teal') || '#14b8a6', 
                                                getCssVar('--rd') || '#f43f5e', 
                                                getCssVar('--amber') || '#f59e0b', 
                                                getCssVar('--blue') || '#3b82f6'
                                            ]
                                        }]
                                    },
                                    options: { responsive: true, maintainAspectRatio: false }
                                });
                            });
                        </script>
                    @else
                        <p style="text-align:center;color:var(--gray);padding:20px">Analytics data not available.</p>
                    @endif
                </div>
                <div class="panel" id="panel-notifications">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
                        <div>
                            <div class="eyebrow" style="color:var(--violet)">Communications</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                                @if(Auth::user()->hasRole('admin')) Broadcast Announcements @else My Notifications @endif
                            </div>
                        </div>
                    </div>
                    
                    @if(Auth::user()->hasRole('admin'))
                        <div style="display:grid; grid-template-columns:1fr 2fr; gap:24px;">
                            <div class="card" style="padding:24px;">
                                <h3 style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:16px;">Create Broadcast</h3>
                                <form method="POST" action="{{ route('admin.notifications.store') }}">
                                    @csrf
                                    <div style="display:flex; flex-direction:column; gap:16px;">
                                        <div>
                                            <label style="font-size:11px; font-weight:700; color:var(--gray); display:block; margin-bottom:4px;">Target Audience</label>
                                            <select name="target" required style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff;">
                                                <option value="all">All Users</option>
                                                <option value="student">Students Only</option>
                                                <option value="special_educator">Educators Only</option>
                                                <option value="therapist">Therapists Only</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="font-size:11px; font-weight:700; color:var(--gray); display:block; margin-bottom:4px;">Type</label>
                                            <select name="notification_type" required style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff;">
                                                <option value="announcement">Announcement</option>
                                                <option value="alert">Alert</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="font-size:11px; font-weight:700; color:var(--gray); display:block; margin-bottom:4px;">Message</label>
                                            <textarea name="message" required rows="4" placeholder="Type your message here..." style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; resize:none;"></textarea>
                                        </div>
                                        <button type="submit" class="btn-teal" style="background:var(--violet)">Send Notification</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card" style="padding:0; overflow:hidden;">
                                <div style="padding:16px 24px; border-bottom:1px solid #f1f5f9; font-weight:700; color:var(--navy);">Recent Broadcasts</div>
                                @forelse($allNotifications ?? [] as $notif)
                                    <div style="padding:16px 24px; border-bottom:1px solid #f1f5f9; display:flex; gap:16px;">
                                        <div style="width:32px; height:32px; border-radius:50%; background:{{ $notif->notification_type === 'alert' ? 'var(--rl)' : 'var(--violet-l)' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                            <i class="ti ti-{{ $notif->notification_type === 'alert' ? 'alert-triangle' : 'broadcast' }}" style="color:{{ $notif->notification_type === 'alert' ? 'var(--rd)' : 'var(--violet)' }}; font-size:16px;"></i>
                                        </div>
                                        <div style="flex:1;">
                                            <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                                                <span class="pill" style="background:var(--gray-b); color:var(--gray); font-size:9px;">To: {{ ucfirst($notif->target ?? 'all') }}</span>
                                                <span style="font-size:10px; color:var(--gray);">{{ $notif->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p style="font-size:13px; color:var(--navy); line-height:1.4;">{{ $notif->message }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p style="padding:24px; text-align:center; color:var(--gray);">No broadcasts sent yet.</p>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="card" style="padding:0; overflow:hidden;">
                            @forelse($notifications ?? [] as $notif)
                                <div style="padding:20px; border-bottom:1px solid #f1f5f9; display:flex; gap:16px; transition:background 0.2s; cursor:pointer;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                    <div style="width:40px; height:40px; border-radius:12px; background:var(--bl); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <i class="ti ti-bell" style="color:var(--blue); font-size:20px;"></i>
                                    </div>
                                    <div style="flex:1;">
                                        <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                                            <span style="font-weight:700; color:var(--navy); font-size:14px;">EduEcho Update</span>
                                            <span style="font-size:11px; color:var(--gray);">{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p style="font-size:13px; color:var(--gray); line-height:1.5; margin-bottom:0;">{{ $notif->message ?? $notif->data['message'] ?? 'No message content' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div style="padding:40px; text-align:center;">
                                    <i class="ti ti-bell-off" style="font-size:48px; color:var(--gray-b); display:block; margin-bottom:12px;"></i>
                                    <p style="color:var(--gray)">No notifications at this time.</p>
                                </div>
                            @endforelse
                        </div>
                    @endif
                </div>

                <!-- SUPPORT PANEL -->
                <div class="panel" id="panel-support">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
                        <div>
                            <div class="eyebrow" style="color:var(--rd)">Help Center</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Support & Reporting</div>
                        </div>
                    </div>
                    
                    <div style="display:grid; grid-template-columns: 1fr 1.5fr; gap:24px;">
                        <div class="card" style="padding:24px;">
                            <h3 style="font-size:15px; font-weight:700; color:var(--navy); margin-bottom:16px;">Submit a Ticket</h3>
                            <form method="POST" action="{{ route('support-tickets.store') }}">
                                @csrf
                                <div style="display:flex; flex-direction:column; gap:16px;">
                                    <div>
                                        <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Issue Title</label>
                                        <input type="text" name="title" required placeholder="e.g. Can't access my course" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                                    </div>
                                    <div>
                                        <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Description</label>
                                        <textarea name="description" required rows="5" placeholder="Please describe your issue in detail..." style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box; resize:none;"></textarea>
                                    </div>
                                    <button type="submit" class="btn-teal" style="background:var(--rose);">Submit Ticket</button>
                                </div>
                            </form>
                        </div>
                        <div class="card" style="padding:0; overflow:hidden;">
                            <div style="padding:16px 24px; border-bottom:1px solid #f1f5f9; font-weight:700; color:var(--navy);">My Support History</div>
                            <div style="max-height:400px; overflow-y:auto;">
                                @forelse($supportTickets ?? [] as $ticket)
                                    <div style="padding:16px 24px; border-bottom:1px solid #f1f5f9;">
                                        <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                                            <span style="font-weight:700; color:var(--navy); font-size:14px;">{{ $ticket->title }}</span>
                                            @php
                                                $statusStyles = [
                                                    'pending' => ['bg' => 'var(--al)', 'color' => 'var(--ad)'],
                                                    'open' => ['bg' => 'var(--bl)', 'color' => 'var(--blue)'],
                                                    'resolved' => ['bg' => 'var(--teal-ll)', 'color' => 'var(--teal)'],
                                                    'closed' => ['bg' => 'var(--gray-b)', 'color' => 'var(--gray)'],
                                                ];
                                                $ss = $statusStyles[$ticket->status] ?? ['bg' => '#f1f5f9', 'color' => '#888'];
                                            @endphp
                                            <span class="pill" style="background:{{ $ss['bg'] }}; color:{{ $ss['color'] }}; font-size:9px; border:none;">{{ ucfirst($ticket->status) }}</span>
                                        </div>
                                        <p style="font-size:12px; color:var(--gray); line-height:1.4; margin-bottom:8px;">{{ Str::limit($ticket->description, 100) }}</p>
                                        <span style="font-size:10px; color:var(--gray-d);">Submitted {{ $ticket->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <div style="padding:40px; text-align:center; color:var(--gray);">
                                        <p>No support tickets submitted yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PROFILE PANEL -->
                <div class="panel" id="panel-profile">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
                        <div>
                            <div class="eyebrow" style="color:var(--teal)">Account Settings</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">My Personal Profile</div>
                        </div>
                    </div>
                    
                    <div class="card" style="max-width:800px; padding:32px;">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')
                            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px; margin-bottom:24px;">
                                <div>
                                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Current Role</label>
                                    <input type="text" value="{{ ucfirst(str_replace('_', ' ', Auth::user()->getRoleNames()->first())) }}" disabled style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; background:#f8fafc; color:var(--gray); box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Member Since</label>
                                    <input type="text" value="{{ Auth::user()->created_at->format('F d, Y') }}" disabled style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; background:#f8fafc; color:var(--gray); box-sizing:border-box;">
                                </div>
                            </div>
                            <div style="border-top:1px solid #f1f5f9; padding-top:24px; display:flex; justify-content:flex-end;">
                                <button type="submit" class="btn-teal" style="padding:12px 32px;">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel" id="panel-accessibility">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
                        <div>
                            <div class="eyebrow" style="color:var(--teal)">Inclusivity</div>
                            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Global Accessibility Settings</div>
                        </div>
                    </div>
                    <div class="card" style="padding:24px;">
                        <p style="font-size:13px; color:var(--gray); margin-bottom:24px;">These settings apply accessibility overrides to the platform interface immediately.</p>
                        
                        <div style="display:flex; flex-direction:column; gap:20px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Dyslexia Friendly Font</div>
                                    <div style="font-size:12px; color:var(--gray);">Uses OpenDyslexic font and optimized spacing.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-dyslexia" {{ ($accessibilityProfile->font_family ?? '') === 'Dyslexia' ? 'checked' : '' }} onchange="toggleAccessibility('dyslexia-font', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Focus Mode</div>
                                    <div style="font-size:12px; color:var(--gray);">Simplifies the interface and minimizes distractions.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-focus" {{ ($accessibilityProfile->focus_mode ?? false) ? 'checked' : '' }} onchange="toggleAccessibility('focus-mode', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">High Contrast Mode</div>
                                    <div style="font-size:12px; color:var(--gray);">Increases contrast across text and interactive elements.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-contrast" onchange="toggleAccessibility('high-contrast', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Large Text</div>
                                    <div style="font-size:12px; color:var(--gray);">Increases base font size for better readability.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-text" onchange="toggleAccessibility('large-text', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Reduce Motion</div>
                                    <div style="font-size:12px; color:var(--gray);">Disables animations and smooth transitions.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-motion" onchange="toggleAccessibility('reduce-motion', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Accessibility Support Indicators</div>
                                    <div style="font-size:12px; color:var(--gray);">Highlights elements compatible with screen readers.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-a11y-ind" onchange="toggleAccessibility('show-a11y-indicators', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <div>
                                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Caption Support Indicators</div>
                                    <div style="font-size:12px; color:var(--gray);">Displays badges on media containing closed captions.</div>
                                </div>
                                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                                    <input type="checkbox" id="toggle-captions" onchange="toggleAccessibility('show-caption-indicators', this.checked)" style="opacity:0; width:0; height:0;">
                                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel" id="panel-settings">
                    <div style="text-align:center;padding:52px 20px">
                        <i class="ti ti-settings"
                            style="font-size:48px;color:var(--gray);display:block;margin-bottom:14px"></i>
                        <h2
                            style="font-family:var(--font-head);font-size:17px;font-weight:800;color:var(--navy);margin-bottom:6px">
                            Platform Settings</h2>
                        <p style="font-size:12px;color:var(--gray)">Manage your profile and preferences</p>
                    </div>
                </div>

            </div><!-- /content -->
        </div><!-- /main -->
    </div><!-- /app -->

    <script>
        const panels = ['overview', 'students', 'educators', 'courses', 'assignments', 'therapy', 'therapy-sessions', 'reports', 'notifications', 'accessibility', 'settings', 'ieps', 'support', 'profile'];
        const titles = { 
            overview: 'Dashboard', 
            students: 'Students', 
            educators: 'Educators', 
            courses: 'Courses', 
            assignments: 'Pending Approvals', 
            therapy: 'Therapists', 
            'therapy-sessions': 'Therapy Sessions', 
            reports: 'Reports & Analytics', 
            notifications: 'Notifications', 
            accessibility: 'Accessibility Settings', 
            settings: 'Settings', 
            ieps: 'IEPs',
            support: 'Support & Help',
            profile: 'My Profile'
        };

        const accessibilityUpdateUrl = "{{ Auth::user()->hasRole('student') && Auth::user()->student ? route('accessibility.update', Auth::user()->student->id) : '#' }}";
        const csrfToken = "{{ csrf_token() }}";

        function showPanel(id, clickedEl) {
            panels.forEach(p => {
                const el = document.getElementById('panel-' + p);
                if (el) el.className = 'panel' + (p === id ? ' show' : '');
            });
            document.querySelectorAll('.sb-item').forEach(i => i.classList.remove('active'));
            if (clickedEl) clickedEl.classList.add('active');
            const t = document.getElementById('pageTitle');
            if (t) t.textContent = titles[id] || id;
        }

        function toggleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '{{ route('logout') }}';
            }
        }

        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            if (menu) {
                menu.classList.toggle('show');
            }
        }

        function toggleAccessibility(setting, isEnabled) {
            const classMap = {
                'high-contrast': 'high-contrast',
                'large-text': 'large-text',
                'reduce-motion': 'reduce-motion',
                'dyslexia-font': 'font-dyslexia',
                'focus-mode': 'focus-mode',
                'show-caption-indicators': 'show-captions',
                'show-a11y-indicators': 'show-a11y'
            };
            
            const className = classMap[setting];
            if (className) {
                if (isEnabled) {
                    document.body.classList.add(className);
                } else {
                    document.body.classList.remove(className);
                }
            }

            // Save to database via AJAX
            if (accessibilityUpdateUrl !== '#') {
                const dbMap = {
                    'high-contrast': 'high_contrast',
                    'large-text': 'font_size', // Simplified for demo
                    'dyslexia-font': 'font_family',
                    'focus-mode': 'focus_mode',
                    'show-caption-indicators': 'show_caption_indicators',
                    'show-a11y-indicators': 'show_a11y_indicators'
                };

                const dbField = dbMap[setting];
                if (dbField) {
                    let value = isEnabled;
                    if (dbField === 'font_size') value = isEnabled ? 18 : 14;
                    if (dbField === 'font_family') value = isEnabled ? 'Dyslexia' : 'Roboto';

                    fetch(accessibilityUpdateUrl, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ [dbField]: value })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Setting saved:', setting);
                        }
                    })
                    .catch(error => console.error('Error saving setting:', error));
                }
            }
        }

        let synth = window.speechSynthesis;
        let isSpeaking = false;

        function toggleTTS() {
            if (isSpeaking) {
                synth.cancel();
                isSpeaking = false;
                document.getElementById('tts-btn').querySelector('i').className = 'ti ti-volume';
            } else {
                const text = document.querySelector('.main').innerText;
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.onend = () => {
                    isSpeaking = false;
                    document.getElementById('tts-btn').querySelector('i').className = 'ti ti-volume';
                };
                synth.speak(utterance);
                isSpeaking = true;
                document.getElementById('tts-btn').querySelector('i').className = 'ti ti-volume-off';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const userDropdown = document.querySelector('.user-dropdown');
            const userMenu = document.getElementById('userMenu');
            if (userDropdown && !userDropdown.contains(event.target)) {
                if (userMenu) userMenu.classList.remove('show');
            }
        });
    </script>

<!-- =================== ADD USER MODALS =================== -->
<div id="modal-overlay" onclick="closeModal()" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:9000;"></div>

<!-- Add Student Modal -->
<div id="add-student-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">User Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Add New Student</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Password</label>
                <input type="password" name="password" required placeholder="Create a password" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Phone</label>
                <input type="text" name="phone" placeholder="Enter phone number" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <input type="hidden" name="role" value="student">
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Create Student</button>
        </div>
    </form>
</div>

<!-- Add Educator Modal -->
<div id="add-educator-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--violet); margin-bottom:4px;">User Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Add New Educator</div>
        </div>
        <button onclick="closeModal()" style="background:var(--violet-l); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--violet); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Password</label>
                <input type="password" name="password" required placeholder="Create a password" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Qualification</label>
                <input type="text" name="qualification" placeholder="e.g. M.Ed. Special Education" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <input type="hidden" name="role" value="special_educator">
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--violet-l); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--violet); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px; background:var(--violet);">Create Educator</button>
        </div>
    </form>
</div>

<!-- Add Therapist Modal -->
<div id="add-therapist-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--rd); margin-bottom:4px;">User Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Add New Therapist</div>
        </div>
        <button onclick="closeModal()" style="background:var(--rl); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--rd); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Password</label>
                <input type="password" name="password" required placeholder="Create a password" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Specialization</label>
                <input type="text" name="specialization" placeholder="e.g. Speech Therapy, ABA Therapy" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <input type="hidden" name="role" value="therapist">
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--rl); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--rd); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px; background:var(--rose);">Create Therapist</button>
        </div>
    </form>
</div>

<script>
    function showModal(id) {
        document.getElementById('modal-overlay').style.display = 'block';
        document.getElementById(id).style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('modal-overlay').style.display = 'none';
        document.querySelectorAll('[id$="-modal"]').forEach(m => m.style.display = 'none');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    function filterCourses() {
        const search = (document.getElementById('course-search')?.value || '').toLowerCase();
        const status = document.getElementById('course-status-filter')?.value || '';
        document.querySelectorAll('.course-item').forEach(item => {
            const matchTitle  = item.dataset.title?.includes(search);
            const matchStatus = status === '' || item.dataset.status === status;
            item.style.display = (matchTitle && matchStatus) ? 'flex' : 'none';
        });
    }
</script>

<!-- Create Course Modal -->
<div id="add-course-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:500px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:90vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">Course Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Create New Course</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.courses.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Course Title <span style="color:var(--rd)">*</span></label>
                <input type="text" name="title" required placeholder="e.g. Introduction to Sign Language" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Description</label>
                <textarea name="description" rows="3" placeholder="Brief course description..." style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box; resize:vertical;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Assigned Educator <span style="color:var(--rd)">*</span></label>
                <select name="created_by_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select an Educator --</option>
                    @foreach($allEducators ?? [] as $edu)
                        <option value="{{ $edu->id }}">{{ $edu->name }} ({{ $edu->email }})</option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Max Students</label>
                    <input type="number" name="max_students" min="1" placeholder="e.g. 30" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Accessibility Level</label>
                    <select name="accessibility_level" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="">-- Select --</option>
                        <option value="basic">Basic</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Target Disabilities</label>
                <input type="text" name="target_disabilities" placeholder="e.g. Visual Impairment, Autism, Hearing Loss" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Create Course</button>
        </div>
    </form>
</div>

<!-- Schedule Therapy Session Modal -->
<div id="schedule-session-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:500px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:90vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--rd); margin-bottom:4px;">Therapy Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Schedule Session</div>
        </div>
        <button onclick="closeModal()" style="background:var(--rl); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--rd); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.therapy.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Student <span style="color:var(--rd)">*</span></label>
                <select name="student_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select a Student --</option>
                    @foreach($allStudents ?? [] as $stu)
                        <option value="{{ $stu->student?->id }}">{{ $stu->name }} ({{ $stu->email }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Therapist <span style="color:var(--rd)">*</span></label>
                <select name="therapist_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select a Therapist --</option>
                    @foreach($allTherapists ?? [] as $th)
                        <option value="{{ $th->id }}">{{ $th->name }} ({{ $th->email }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Session Type <span style="color:var(--rd)">*</span></label>
                <select name="session_type" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select Type --</option>
                    <option value="speech">Speech Therapy</option>
                    <option value="occupational">Occupational Therapy</option>
                    <option value="physical">Physical Therapy</option>
                    <option value="behavioral">Behavioral Therapy</option>
                    <option value="counseling">Counseling</option>
                    <option value="special_education">Special Education Support</option>
                </select>
            </div>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Session Date <span style="color:var(--rd)">*</span></label>
                    <input type="date" name="session_date" required min="{{ date('Y-m-d') }}" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Duration (minutes) <span style="color:var(--rd)">*</span></label>
                    <input type="number" name="duration" required min="15" max="300" value="60" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Notes</label>
                <textarea name="notes" rows="2" placeholder="Optional session notes..." style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box; resize:vertical;"></textarea>
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--rl); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--rd); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px; background:var(--rose);">Schedule Session</button>
        </div>
    </form>
</div>

</body>

</html>