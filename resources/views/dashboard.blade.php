<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduEcho - Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234338ca' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z'/%3E%3Cpath d='m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65'/%3E%3Cpath d='m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65'/%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    
    @include('dashboard._styles')

    @php
        $bodyClasses = '';
        if (Auth::user()->hasRole('student') && isset($accessibilityProfile)) {
            if ($accessibilityProfile->high_contrast) $bodyClasses .= ' high-contrast';
            if ($accessibilityProfile->font_size > 14) $bodyClasses .= ' large-text';
            if ($accessibilityProfile->font_family === 'Dyslexia') $bodyClasses .= ' font-dyslexia';
            if ($accessibilityProfile->focus_mode) $bodyClasses .= ' focus-mode';
        }
    @endphp
</head>

<body class="{{ $bodyClasses }}">

    <div class="app">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="sb-logo">
                <div class="sb-logo-icon"><i class="ti ti-school"></i></div>
                <div class="sb-logo-name">Edu<em>Echo</em></div>
            </div>
            <div class="sb-nav">
                @include('dashboard._sidebar', ['activePanel' => $activePanel ?? 'overview'])
            </div>
            <div class="sb-user" onclick="showPanel('profile', null)">
                <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div style="flex:1; overflow:hidden;">
                    <span class="sb-user-name" style="white-space:nowrap; text-overflow:ellipsis; overflow:hidden;">{{ Auth::user()->name }}</span>
                    <span class="sb-user-role">{{ ucfirst(str_replace('_', ' ', Auth::user()->roles->first()->name ?? 'User')) }}</span>
                </div>
            </div>
        </div>

        <!-- MAIN -->
        <div class="main">
            <!-- TOPBAR -->
            <div class="topbar">
                <div class="tb-title" id="pageTitle">Dashboard</div>
                
                <div class="tb-search">
                    <i class="ti ti-search"></i>
                    <input type="text" placeholder="Quick search...">
                </div>

                <div class="tb-right">
                    <button class="tb-icon-btn" id="tts-btn" onclick="toggleTTS()" title="Text to Speech"><i class="ti ti-volume"></i></button>
                    <button class="tb-icon-btn" onclick="showPanel('notifications', null)" title="Notifications">
                        <i class="ti ti-bell"></i>
                        @if(isset($notifications) && $notifications->where('read_at', null)->count() > 0)
                            <div class="notif-dot"></div>
                        @endif
                    </button>
                    <div class="tb-user" onclick="toggleLogout()">
                        <div class="tb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <span>Logout</span>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                @include('dashboard.panels.overview')
                @include('dashboard.panels.students')
                @include('dashboard.panels.educators')
                @include('dashboard.panels.therapy')
                @include('dashboard.panels.courses')
                @include('dashboard.panels.therapy_sessions')
                @include('dashboard.panels.notifications')
                @include('dashboard.panels.settings')
                @include('dashboard.panels.support')
                @include('dashboard.panels.profile')
                @include('dashboard.panels.accessibility')
                @include('dashboard.panels.learning_materials')
                @include('dashboard.panels.reports')
                @include('dashboard.panels.support_tickets')

                @include('dashboard.panels.therapy-notes')
                @include('dashboard.panels.progress')

            </div>
        </div>
    </div>

    @include('dashboard._modals')

    <script>
        const panels = [
            'overview', 'profile', 'courses', 'students', 'ieps', 'notifications', 'support',
            'adaptive-content', 'learning-materials', 'therapy-sessions', 'therapy-notes', 'progress',
            'educators', 'therapy', 'reports', 'settings', 'accessibility', 'support-tickets'
        ];
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
            'support-tickets': 'Support Tickets',
            profile: 'My Profile'
        };

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
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('logout') }}';
                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = csrfToken;
                form.appendChild(token);
                document.body.appendChild(form);
                form.submit();
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
                const text = document.querySelector('.content').innerText;
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

        // Global Search & Filter Functionality
        function applyFilters(container) {
            if (!container) return;

            // Get search term (either panel specific or global)
            let searchInput = container.querySelector('input[placeholder*="earch"]');
            let globalInput = document.querySelector('.tb-search input');
            const searchTerm = (searchInput ? searchInput.value : (globalInput ? globalInput.value : '')).toLowerCase();

            // Get filter value if a select exists
            const selectFilter = container.querySelector('select');
            const filterValue = selectFilter ? selectFilter.value.toLowerCase() : '';

            // Find searchable items in the panel
            let items = container.querySelectorAll('.stu, .course-item, tbody tr:not(.empty-state)');
            
            // Fallback for grid layouts
            if (items.length === 0) {
                items = Array.from(container.querySelectorAll('.card')).filter(card => {
                    return !card.classList.contains('welcome') && !card.classList.contains('sc') && !card.classList.contains('qa');
                });
            }

            items.forEach(item => {
                const text = item.innerText.toLowerCase();
                const matchesSearch = text.includes(searchTerm);
                
                let matchesFilter = true;
                if (filterValue) {
                    // Check specifically for active/inactive text to avoid partial matches
                    const pills = Array.from(item.querySelectorAll('.pill, button'));
                    const statusEl = pills.find(p => {
                        const t = p.innerText.trim().toLowerCase();
                        return t === 'active' || t === 'inactive';
                    });
                    
                    if (statusEl) {
                        matchesFilter = statusEl.innerText.trim().toLowerCase() === filterValue;
                    } else {
                        const regex = new RegExp(`\\b${filterValue}\\b`, 'i');
                        matchesFilter = regex.test(text);
                    }
                }
                
                item.style.display = (matchesSearch && matchesFilter) ? '' : 'none';
            });
        }

        function handleInput(e) {
            let container = e.target.closest('.panel');
            if (!container) container = document.querySelector('.panel.show');
            applyFilters(container);
        }

        // Initialize first panel and search listeners
        document.addEventListener('DOMContentLoaded', () => {
            const activePanel = '{{ $activePanel ?? 'overview' }}';
            showPanel(activePanel, document.querySelector(`.sb-item[onclick*="${activePanel}"]`));

            // Attach search listeners
            document.querySelectorAll('input[placeholder*="earch"], select').forEach(input => {
                input.addEventListener('input', handleInput);
                input.addEventListener('change', handleInput);
            });
        });
    </script>
</body>

</html>