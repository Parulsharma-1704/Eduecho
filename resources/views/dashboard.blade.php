<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduEcho — Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <style>
        :root {
            --teal: #0D9488; --teal-b: #10B981; --teal-l: #CCFBF1; --teal-ll: #F0FDFA; --teal-d: #0F766E; --teal-dd: #134E4A;
            --violet: #6D28D9; --violet-b: #7C3AED; --violet-l: #EDE9FE; --violet-ll: #F5F3FF; --violet-d: #4C1D95; --violet-m: #C4B5FD;
            --navy: #1E1B4B; --white: #ffffff; --gray: #6B7280; --gray-l: #F9FAFB; --gray-b: #E5E7EB; --page: #F0FDFA;
            --amber: #D97706; --al: #FEF3C7; --ad: #92400E;
            --rose: #BE185D; --rl: #FCE7F3; --rd: #9D174D;
            --green: #16A34A; --gl: #DCFCE7; --gd: #166534;
            --blue: #2563EB; --bl: #EFF6FF; --bd: #1E40AF;
            --font-head: 'Plus Jakarta Sans', sans-serif; --font-body: 'DM Sans', sans-serif;
            --r-sm: 8px; --r-md: 12px; --r-lg: 16px; --r-xl: 20px; --r-2xl: 24px;
            --sidebar-w: 224px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%;overflow:hidden}
        body{font-family:var(--font-body);background:var(--page);color:var(--navy);font-size:14px}
        button{cursor:pointer;font-family:var(--font-body)}
        a{text-decoration:none;color:inherit}
        
        @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-7px)}}
        @keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        @keyframes countIn{from{opacity:0;transform:scale(.85)}to{opacity:1;transform:scale(1)}}
        @keyframes progFill{from{width:0}to{width:var(--w)}}
        @keyframes pulseDot{0%,100%{box-shadow:0 0 0 0 rgba(190,24,93,.4)}70%{box-shadow:0 0 0 6px rgba(190,24,93,0)}}
        @keyframes panelIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        
        .app{display:flex;height:100vh;overflow:hidden}
        
        /* SIDEBAR */
        .sidebar{width:var(--sidebar-w);flex-shrink:0;background:var(--navy);display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden}
        .sidebar::-webkit-scrollbar{width:3px}
        .sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:3px}
        .sb-logo{display:flex;align-items:center;gap:10px;padding:20px 16px 16px;border-bottom:1px solid rgba(255,255,255,.06)}
        .sb-logo-icon{width:36px;height:36px;border-radius:10px;background:var(--teal);display:flex;align-items:center;justify-content:center;flex-shrink:0;animation:floatY 3s ease-in-out infinite}
        .sb-logo-icon i{font-size:18px;color:#fff}
        .sb-logo-name{font-family:var(--font-head);font-size:16px;font-weight:800;color:#fff}
        .sb-logo-name em{color:var(--teal-b);font-style:normal}
        .sb-nav{padding:8px 8px;flex:1}
        .sb-group{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.25);padding:12px 10px 5px}
        .sb-item{display:flex;align-items:center;gap:10px;padding:9px 12px;margin:1px 0;border-radius:var(--r-md);color:rgba(255,255,255,.5);font-size:13px;font-weight:600;border:none;background:none;width:100%;text-align:left;transition:all .18s}
        .sb-item i{font-size:17px;flex-shrink:0}
        .sb-item:hover{background:rgba(255,255,255,.07);color:#fff}
        .sb-item.active{background:var(--teal);color:#fff}
        .sb-badge{margin-left:auto;background:var(--rose);color:#fff;font-size:10px;font-weight:800;padding:2px 7px;border-radius:10px}
        .sb-user{margin-top:auto;border-top:1px solid rgba(255,255,255,.06);padding:12px;display:flex;align-items:center;gap:9px;cursor:pointer}
        .sb-user-av{width:32px;height:32px;border-radius:50%;background:var(--teal);color:#fff;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .sb-user-name{font-size:12px;font-weight:700;color:#fff;display:block}
        .sb-user-role{font-size:10px;color:rgba(255,255,255,.35)}
        
        /* MAIN */
        .main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0}
        
        /* TOPBAR */
        .topbar{background:var(--white);border-bottom:1.5px solid var(--teal-l);padding:0 22px;height:56px;display:flex;align-items:center;gap:12px;flex-shrink:0;z-index:10}
        .tb-title{font-family:var(--font-head);font-size:15px;font-weight:800;color:var(--navy)}
        .tb-search{display:flex;align-items:center;gap:8px;background:var(--teal-ll);border:1.5px solid var(--teal-l);border-radius:var(--r-md);padding:7px 13px;flex:1;max-width:280px}
        .tb-search i{font-size:15px;color:var(--teal)}
        .tb-search input{border:none;background:none;outline:none;font-size:12px;color:var(--navy);width:100%;font-family:var(--font-body)}
        .tb-search input::placeholder{color:var(--teal-d);opacity:.6}
        .tb-right{margin-left:auto;display:flex;align-items:center;gap:8px}
        .tb-icon-btn{width:36px;height:36px;border-radius:var(--r-md);background:var(--teal-ll);border:none;display:flex;align-items:center;justify-content:center;transition:background .18s;position:relative}
        .tb-icon-btn:hover{background:var(--teal-l)}
        .tb-icon-btn i{font-size:18px;color:var(--teal)}
        .notif-dot{position:absolute;top:6px;right:6px;width:7px;height:7px;border-radius:50%;background:var(--rose);animation:pulseDot 2s ease-in-out infinite}
        .tb-user{display:flex;align-items:center;gap:8px;padding:6px 12px;border-radius:var(--r-md);background:var(--teal-ll);border:1.5px solid var(--teal-l);transition:background .18s;cursor:pointer}
        .tb-user:hover{background:var(--teal-l)}
        .tb-user-av{width:26px;height:26px;border-radius:50%;background:var(--teal);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center}
        .tb-user span{font-size:12px;font-weight:700;color:var(--teal-d)}
        
        /* CONTENT */
        .content{flex:1;overflow-y:auto;padding:20px}
        .content::-webkit-scrollbar{width:5px}
        .content::-webkit-scrollbar-thumb{background:var(--teal-l);border-radius:5px}
        
        .panel{display:none;animation:panelIn .3s ease both}
        .panel.show{display:block}
        
        /* ANNOUNCE */
        .announce{background:var(--teal-ll);border:1.5px solid var(--teal-l);border-radius:var(--r-lg);padding:12px 16px;display:flex;align-items:flex-start;gap:12px;margin-bottom:16px;animation:fadeUp .4s ease both}
        .announce>i{font-size:19px;color:var(--teal);flex-shrink:0;margin-top:1px}
        .ann-body strong{font-size:12px;font-weight:800;color:var(--teal-dd);display:block;margin-bottom:2px}
        .ann-body span{font-size:11px;color:var(--teal-d)}
        .ann-close{margin-left:auto;flex-shrink:0;background:none;border:none;font-size:15px;color:var(--teal);padding:2px;line-height:1;cursor:pointer}
        
        /* WELCOME */
        .welcome{background:var(--navy);border-radius:var(--r-xl);padding:26px 30px;display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;position:relative;overflow:hidden;animation:fadeUp .5s ease .05s both}
        .welcome::before{content:'';position:absolute;width:280px;height:280px;border-radius:50%;background:rgba(13,148,136,.18);top:-100px;right:60px}
        .wb-left{position:relative;z-index:2}
        .wb-eyebrow{font-size:10px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:var(--teal-b);margin-bottom:6px}
        .wb-left h1{font-family:var(--font-head);font-size:26px;font-weight:900;color:#fff;margin-bottom:6px}
        .wb-left p{font-size:13px;color:rgba(255,255,255,.55)}
        .wb-status{position:relative;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.14);border-radius:var(--r-lg);padding:13px 18px;display:flex;align-items:center;gap:13px;z-index:2}
        .wb-stat-icon{width:42px;height:42px;border-radius:10px;background:var(--teal);display:flex;align-items:center;justify-content:center;animation:floatY 3s ease-in-out infinite;flex-shrink:0}
        .wb-stat-icon i{font-size:20px;color:#fff}
        .wb-stat-label{font-size:9px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.38);margin-bottom:4px}
        .wb-stat-val{display:flex;align-items:center;gap:7px}
        .wb-green{width:7px;height:7px;border-radius:50%;background:#22c55e}
        .wb-stat-val span{font-size:13px;font-weight:800;color:#fff}
        
        /* STAT CARDS */
        .stat-row{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px}
        .sc{background:var(--white);border-radius:var(--r-lg);padding:16px;border:1.5px solid var(--teal-l);text-align:center;transition:all .22s;cursor:pointer;animation:countIn .45s ease both}
        .sc:hover{transform:translateY(-4px);border-color:var(--teal);box-shadow:0 8px 24px rgba(13,148,136,.1)}
        .sc-ico{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px}
        .sc-ico i{font-size:20px}
        .sc-label{font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--gray);margin-bottom:4px}
        .sc-val{font-family:var(--font-head);font-size:28px;font-weight:900}
        .sc-trend{font-size:11px;font-weight:600;margin-top:4px;display:flex;align-items:center;justify-content:center;gap:3px}
        
        /* GRID */
        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
        .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:14px}
        .flex-col{display:flex;flex-direction:column;gap:12px}
        
        /* CARD */
        .card{background:var(--white);border-radius:var(--r-lg);border:1.5px solid var(--teal-l);padding:18px}
        .card-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
        .card-title-wrap{display:flex;align-items:center;gap:10px}
        .card-ico{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .card-ico i{font-size:17px}
        .card-title{font-family:var(--font-head);font-size:13px;font-weight:800;color:var(--navy)}
        .card-sub{font-size:11px;color:var(--gray);margin-top:1px}
        .card-action{font-size:11px;font-weight:700;color:var(--teal);background:none;border:none;display:flex;align-items:center;gap:3px;transition:color .18s;cursor:pointer}
        .card-action:hover{color:var(--teal-d)}
        
        /* STUDENT ROW */
        .stu{display:flex;align-items:center;gap:10px;padding:9px 6px;border-radius:var(--r-md);cursor:pointer;transition:background .16s;border-bottom:1px solid var(--teal-l)}
        .stu:last-child{border:none;padding-bottom:0}
        .stu:hover{background:var(--teal-ll)}
        .stu-av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;flex-shrink:0}
        .stu-name{font-size:12px;font-weight:700;color:var(--navy)}
        .stu-meta{font-size:10px;color:var(--gray);margin-top:1px}
        
        /* PILL */
        .pill{padding:3px 9px;border-radius:10px;font-size:10px;font-weight:700;white-space:nowrap;border:none;cursor:pointer}
        
        /* PROGRESS */
        .prog{margin-bottom:12px}
        .prog:last-child{margin-bottom:0}
        .prog-top{display:flex;justify-content:space-between;font-size:11px;font-weight:700;color:var(--navy);margin-bottom:5px}
        .prog-track{height:8px;background:var(--teal-l);border-radius:8px;overflow:hidden}
        .prog-bar{height:100%;border-radius:8px;animation:progFill .9s ease both}
        
        /* SESSION */
        .sess{display:flex;align-items:center;gap:10px;padding:9px 6px;border-radius:var(--r-md);cursor:pointer;transition:background .16s;border-bottom:1px solid var(--teal-l)}
        .sess:last-child{border:none;padding-bottom:0}
        .sess:hover{background:var(--teal-ll)}
        .sess-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0}
        .sess-ico{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .sess-ico i{font-size:13px}
        .sess-name{font-size:12px;font-weight:700;color:var(--navy);display:block}
        .sess-who{font-size:10px;color:var(--gray)}
        .sess-time{font-size:10px;font-weight:700;margin-left:auto;text-align:right}
        
        /* COMPLIANCE */
        .comp{display:flex;align-items:center;justify-content:space-between;padding:8px 6px;border-bottom:1px solid var(--teal-l);font-size:12px}
        .comp:last-child{border:none;padding-bottom:0}
        .comp-s{display:flex;align-items:center;gap:5px;font-size:11px;font-weight:700}
        .cdot{width:7px;height:7px;border-radius:50%}
        
        /* SCHEDULE */
        .sched{display:flex;align-items:flex-start;gap:10px;padding:8px 6px;border-bottom:1px solid var(--teal-l)}
        .sched:last-child{border:none;padding-bottom:0}
        .sched-t{font-size:10px;font-weight:700;color:var(--gray);min-width:36px;padding-top:2px}
        .sched-line{width:2px;border-radius:2px;min-height:34px;flex-shrink:0;margin-top:3px}
        .sched-name{font-size:12px;font-weight:700;color:var(--navy);display:block}
        .sched-loc{font-size:10px;color:var(--gray)}
        
        /* BUTTONS */
        .btn-teal{padding:10px 22px;border-radius:24px;background:var(--teal);color:#fff;font-size:13px;font-weight:700;border:none;display:inline-flex;align-items:center;gap:7px;transition:all .18s;cursor:pointer}
        .btn-teal:hover{background:var(--teal-d);transform:translateY(-1px)}
        
        .eyebrow{font-size:10px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:var(--teal);margin-bottom:8px}
        
        /* USER DROPDOWN */
        .user-dropdown{position:relative;}
        .user-menu{display:none;position:absolute;top:100%;right:0;background:#fff;border:1.5px solid var(--teal-l);border-radius:var(--r-md);width:150px;z-index:1000;box-shadow:0 4px 16px rgba(0,0,0,.1)}
        .user-menu.show{display:block}
        .user-menu a{display:flex;align-items:center;gap:10px;padding:12px 16px;border:none;background:none;color:var(--navy);font-size:13px;font-weight:600;text-decoration:none;cursor:pointer;border-bottom:1px solid var(--teal-l);width:100%;text-align:left;transition:background .2s}
        .user-menu a:last-child{border-bottom:none}
        .user-menu a:hover{background:var(--teal-ll)}
        .user-menu a i{font-size:15px;color:var(--teal)}
        .user-menu a.logout{color:var(--rose)}
        .user-menu a.logout i{color:var(--rose)}
        
        /* QA GRID */
        .qa-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:14px}
        .qa{background:var(--white);border:1.5px solid var(--teal-l);border-radius:var(--r-lg);padding:14px 10px;display:flex;flex-direction:column;align-items:center;gap:7px;cursor:pointer;transition:all .2s;text-align:center}
        .qa:hover{border-color:var(--teal);background:var(--teal-ll);transform:translateY(-3px)}
        .qa-ico{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center}
        .qa-ico i{font-size:19px}
        .qa strong{font-size:11px;font-weight:800;color:var(--navy)}
        .qa span{font-size:10px;color:var(--gray)}
        
        @media(max-width:768px){
            .stat-row{grid-template-columns:repeat(2,1fr)}
            .grid-2{grid-template-columns:1fr}
            .grid-3{grid-template-columns:repeat(2,1fr)}
            .qa-grid{grid-template-columns:repeat(2,1fr)}
            .sidebar{position:absolute;left:0;top:0;height:100%;z-index:100;transform:translateX(-100%);transition:transform .3s}
            .sidebar.open{transform:translateX(0)}
        }
    </style>
</head>
<body>

<div class="app">

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sb-logo">
        <div class="sb-logo-icon"><i class="ti ti-book-2"></i></div>
        <span class="sb-logo-name">Edu<em>Echo</em></span>
    </div>

    <div class="sb-nav">
        <div class="sb-group">Main</div>
        <button class="sb-item active" onclick="showPanel('overview',this)">
            <i class="ti ti-layout-dashboard"></i> Dashboard
        </button>
        <button class="sb-item" onclick="showPanel('students',this)">
            <i class="ti ti-users"></i> Students
        </button>
        <button class="sb-item" onclick="showPanel('courses',this)">
            <i class="ti ti-books"></i> Courses
        </button>
        <button class="sb-item" onclick="showPanel('ieps',this)">
            <i class="ti ti-clipboard-list"></i> IEPs
            <span class="sb-badge">3</span>
        </button>
        <button class="sb-item" onclick="window.location.href='{{ route('tutoring.hub') }}'">
            <i class="ti ti-message-circle"></i> Tutoring Chat
        </button>
        @if(Auth::user()->hasRole('special_educator'))
        <button class="sb-item" onclick="window.location.href='{{ route('tutoring.matching') }}'">
            <i class="ti ti-user-search"></i> Find Students
        </button>
        @endif

        <div class="sb-group">Support</div>
        <button class="sb-item" onclick="showPanel('therapy',this)">
            <i class="ti ti-heart"></i> Therapy
        </button>
        <button class="sb-item" onclick="showPanel('reports',this)">
            <i class="ti ti-chart-bar"></i> Reports
        </button>
        <button class="sb-item" onclick="showPanel('invites',this)">
            <i class="ti ti-mail"></i> Invites
        </button>

        <div class="sb-group">System</div>
        <button class="sb-item" onclick="showPanel('accessibility',this)">
            <i class="ti ti-accessible"></i> Accessibility
        </button>
        <button class="sb-item" onclick="showPanel('settings',this)">
            <i class="ti ti-settings"></i> Settings
        </button>
    </div>

    <div class="sb-user" onclick="window.location.href='{{ route('profile.edit') }}'">
        <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
        <div>
            <span class="sb-user-name">{{ explode(' ', Auth::user()->name)[0] }}</span>
            <span class="sb-user-role">{{ Auth::user()->getRoleNames()->first() ?? 'User' }}</span>
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
            <button class="tb-icon-btn" title="Notifications">
                <i class="ti ti-bell"></i>
                <div class="notif-dot"></div>
            </button>
            <button class="tb-icon-btn" title="Messages">
                <i class="ti ti-message-circle"></i>
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
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">
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
                    <div class="wb-eyebrow">Administrator Portal</div>
                    <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                    <p>System operational and running smoothly.</p>
                </div>
            </div>

            <!-- STAT CARDS -->
            <div class="stat-row">
                <div class="sc" onclick="showPanel('students',null)">
                    <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-users" style="color:var(--teal)"></i></div>
                    <div class="sc-label">Total Students</div>
                    <div class="sc-val" style="color:var(--teal)">{{ $stats['total_students'] ?? 0 }}</div>
                </div>
                <div class="sc" onclick="showPanel('courses',null)">
                    <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-books" style="color:var(--violet)"></i></div>
                    <div class="sc-label">Total Courses</div>
                    <div class="sc-val" style="color:var(--violet)">{{ $stats['total_courses'] ?? 0 }}</div>
                </div>
                <div class="sc" onclick="showPanel('ieps',null)">
                    <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-clipboard-list" style="color:var(--teal)"></i></div>
                    <div class="sc-label">Total IEPs</div>
                    <div class="sc-val" style="color:var(--teal)">{{ $stats['total_ieps'] ?? 0 }}</div>
                </div>
                <div class="sc">
                    <div class="sc-ico" style="background:var(--al)"><i class="ti ti-writing" style="color:var(--ad)"></i></div>
                    <div class="sc-label">Assessments</div>
                    <div class="sc-val" style="color:var(--ad)">{{ $stats['total_assessments'] ?? 0 }}</div>
                </div>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
            <div class="qa-grid">
                <div class="qa" onclick="showPanel('students',null)">
                    <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-user-plus" style="color:var(--teal)"></i></div>
                    <strong>Add Student</strong>
                </div>
                <div class="qa" onclick="showPanel('ieps',null)">
                    <div class="qa-ico" style="background:var(--violet-l)"><i class="ti ti-clipboard-plus" style="color:var(--violet)"></i></div>
                    <strong>Create IEP</strong>
                </div>
                <div class="qa" onclick="showPanel('therapy',null)">
                    <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-calendar-plus" style="color:var(--rd)"></i></div>
                    <strong>Book Therapy</strong>
                </div>
                <div class="qa" onclick="showPanel('reports',null)">
                    <div class="qa-ico" style="background:var(--al)"><i class="ti ti-file-analytics" style="color:var(--ad)"></i></div>
                    <strong>Generate Report</strong>
                </div>
            </div>
        </div><!-- /overview -->

        <!-- STUDENTS PANEL -->
        <div class="panel" id="panel-students">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                <div>
                    <div class="eyebrow">Management</div>
                    <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">All Students</div>
                </div>
                <button class="btn-teal"><i class="ti ti-user-plus"></i> Add Student</button>
            </div>
            <div class="card">
                @forelse($allStudents ?? [] as $student)
                    <div class="stu" style="padding:11px 8px">
                        <div class="stu-av" style="background:var(--teal-ll);color:var(--teal-d);width:36px;height:36px;font-size:13px">{{ substr($student->user->name, 0, 1) }}</div>
                        <div style="flex:1"><div class="stu-name">{{ $student->user->name }}</div><div class="stu-meta">{{ $student->user->email }}</div></div>
                        <span class="pill" style="background:var(--teal-ll);color:var(--teal-d)">Active</span>
                    </div>
                @empty
                    <p style="text-align:center;color:var(--gray);padding:20px">No students found</p>
                @endforelse
            </div>
        </div>

        <!-- IEP PANEL -->
        <div class="panel" id="panel-ieps">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                <div>
                    <div class="eyebrow">Education Plans</div>
                    <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">IEP Management</div>
                </div>
                <button class="btn-teal"><i class="ti ti-clipboard-plus"></i> Create IEP</button>
            </div>
            <div class="grid-3">
                <div class="card">
                    <span class="pill" style="background:var(--teal-ll);color:var(--teal-d)">Active</span>
                    <div style="font-size:14px;font-weight:700;color:var(--navy);margin:10px 0 2px 0">Sample IEP</div>
                    <div style="font-size:11px;color:var(--gray);margin-bottom:12px">Grade 4</div>
                    <div class="prog">
                        <div class="prog-top"><span>Goals met</span><span style="color:var(--teal)">6/8</span></div>
                        <div class="prog-track"><div class="prog-bar" style="--w:75%;background:var(--teal)"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- THERAPY PANEL -->
        <div class="panel" id="panel-therapy">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                <div>
                    <div class="eyebrow" style="color:var(--rd)">Wellness</div>
                    <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Therapy & Wellness</div>
                </div>
                <button class="btn-teal" style="background:var(--rose)"><i class="ti ti-calendar-plus"></i> Book New Session</button>
            </div>
            <div class="stat-row">
                <div class="sc"><div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-calendar-check" style="color:var(--teal)"></i></div><div class="sc-label">Today</div><div class="sc-val" style="color:var(--teal)">4</div></div>
                <div class="sc"><div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-calendar-week" style="color:var(--violet)"></i></div><div class="sc-label">This Week</div><div class="sc-val" style="color:var(--violet)">12</div></div>
                <div class="sc"><div class="sc-ico" style="background:var(--al)"><i class="ti ti-clock" style="color:var(--ad)"></i></div><div class="sc-label">Pending</div><div class="sc-val" style="color:var(--ad)">3</div></div>
                <div class="sc"><div class="sc-ico" style="background:var(--gl)"><i class="ti ti-check" style="color:var(--gd)"></i></div><div class="sc-label">Completed</div><div class="sc-val" style="color:var(--gd)">47</div></div>
            </div>
        </div>

        <!-- OTHER PANELS -->
        <div class="panel" id="panel-courses">
            <div style="text-align:center;padding:52px 20px">
                <i class="ti ti-books" style="font-size:48px;color:var(--teal);display:block;margin-bottom:14px"></i>
                <h2 style="font-family:var(--font-head);font-size:17px;font-weight:800;color:var(--navy);margin-bottom:6px">Course Catalogue</h2>
                <p style="font-size:12px;color:var(--gray)">12 active courses available</p>
            </div>
        </div>
        <div class="panel" id="panel-reports">
            <div style="text-align:center;padding:52px 20px">
                <i class="ti ti-chart-bar" style="font-size:48px;color:var(--amber);display:block;margin-bottom:14px"></i>
                <h2 style="font-family:var(--font-head);font-size:17px;font-weight:800;color:var(--navy);margin-bottom:6px">Reports & Compliance</h2>
                <p style="font-size:12px;color:var(--gray)">All regulatory reports in one place</p>
            </div>
        </div>
        <div class="panel" id="panel-invites">
            <div style="text-align:center;padding:52px 20px">
                <i class="ti ti-mail" style="font-size:48px;color:var(--violet);display:block;margin-bottom:14px"></i>
                <h2 style="font-family:var(--font-head);font-size:17px;font-weight:800;color:var(--navy);margin-bottom:6px">Invites & Onboarding</h2>
                <p style="font-size:12px;color:var(--gray)">Send invites to team members</p>
            </div>
        </div>
        <div class="panel" id="panel-accessibility">
            <div style="text-align:center;padding:52px 20px">
                <i class="ti ti-accessible" style="font-size:48px;color:var(--teal);display:block;margin-bottom:14px"></i>
                <h2 style="font-family:var(--font-head);font-size:17px;font-weight:800;color:var(--navy);margin-bottom:6px">Accessibility Settings</h2>
                <p style="font-size:12px;color:var(--gray)">Configure accessibility features</p>
            </div>
        </div>
        <div class="panel" id="panel-settings">
            <div style="text-align:center;padding:52px 20px">
                <i class="ti ti-settings" style="font-size:48px;color:var(--gray);display:block;margin-bottom:14px"></i>
                <h2 style="font-family:var(--font-head);font-size:17px;font-weight:800;color:var(--navy);margin-bottom:6px">Platform Settings</h2>
                <p style="font-size:12px;color:var(--gray)">Manage your profile and preferences</p>
            </div>
        </div>

    </div><!-- /content -->
</div><!-- /main -->
</div><!-- /app -->

<script>
const panels = ['overview','students','courses','ieps','therapy','reports','invites','accessibility','settings'];
const titles = {overview:'Dashboard',students:'Students',courses:'Courses',ieps:'IEP Plans',therapy:'Therapy & Wellness',reports:'Reports',invites:'Invites',accessibility:'Accessibility',settings:'Settings'};

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

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const userDropdown = document.querySelector('.user-dropdown');
    const userMenu = document.getElementById('userMenu');
    if (userDropdown && !userDropdown.contains(event.target)) {
        if (userMenu) userMenu.classList.remove('show');
    }
});
</script>

</body>
</html>
