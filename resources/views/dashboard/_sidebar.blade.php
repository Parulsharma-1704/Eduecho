@if(Auth::user()->hasRole('admin'))
    <div class="sb-group">Main</div>
    <button class="sb-item {{ $activePanel === 'overview' ? 'active' : '' }}" onclick="showPanel('overview',this)">
        <i class="ti ti-layout-dashboard"></i> Dashboard
    </button>
    <button class="sb-item {{ $activePanel === 'students' ? 'active' : '' }}" onclick="showPanel('students',this)">
        <i class="ti ti-users"></i> Students
    </button>
    <button class="sb-item {{ $activePanel === 'educators' ? 'active' : '' }}" onclick="showPanel('educators',this)">
        <i class="ti ti-school"></i> Educators
    </button>
    <button class="sb-item {{ $activePanel === 'therapy' ? 'active' : '' }}" onclick="showPanel('therapy',this)">
        <i class="ti ti-heart-handshake"></i> Therapists
    </button>

    <div class="sb-group">Management</div>
    <button class="sb-item {{ $activePanel === 'courses' ? 'active' : '' }}" onclick="showPanel('courses',this)">
        <i class="ti ti-books"></i> Courses
    </button>
    <button class="sb-item {{ $activePanel === 'therapy-sessions' ? 'active' : '' }}" onclick="showPanel('therapy-sessions',this)">
        <i class="ti ti-calendar-event"></i> Therapy Sessions
    </button>
    <button class="sb-item {{ $activePanel === 'reports' ? 'active' : '' }}" onclick="showPanel('reports',this)">
        <i class="ti ti-chart-bar"></i> Reports
    </button>
    <button class="sb-item {{ $activePanel === 'notifications' ? 'active' : '' }}" onclick="showPanel('notifications',this)">
        <i class="ti ti-bell"></i> Notifications
    </button>

    <div class="sb-group">System</div>
    <button class="sb-item {{ $activePanel === 'settings' ? 'active' : '' }}" onclick="showPanel('settings',this)">
        <i class="ti ti-settings"></i> Settings
    </button>

@elseif(Auth::user()->hasRole('student'))
    <div class="sb-group">Main</div>
    <button class="sb-item {{ $activePanel === 'overview' ? 'active' : '' }}" onclick="showPanel('overview',this)">
        <i class="ti ti-layout-dashboard"></i> Dashboard
    </button>
    <button class="sb-item {{ $activePanel === 'courses' ? 'active' : '' }}" onclick="showPanel('courses',this)">
        <i class="ti ti-books"></i> My Courses
    </button>
    <button class="sb-item {{ $activePanel === 'therapy-sessions' ? 'active' : '' }}" onclick="showPanel('therapy-sessions',this)">
        <i class="ti ti-calendar-event"></i> Therapy Sessions
    </button>

    <div class="sb-group">Information</div>
    <button class="sb-item {{ $activePanel === 'notifications' ? 'active' : '' }}" onclick="showPanel('notifications',this)">
        <i class="ti ti-bell"></i> Notifications
    </button>
    <button class="sb-item {{ $activePanel === 'accessibility' ? 'active' : '' }}" onclick="showPanel('accessibility',this)">
        <i class="ti ti-accessible"></i> Accessibility
    </button>

    <div class="sb-group">Account</div>
    <button class="sb-item {{ $activePanel === 'support' ? 'active' : '' }}" onclick="showPanel('support',this)">
        <i class="ti ti-headset"></i> Support
    </button>
    <button class="sb-item {{ $activePanel === 'profile' ? 'active' : '' }}" onclick="showPanel('profile',this)">
        <i class="ti ti-user"></i> Profile
    </button>

@elseif(Auth::user()->hasRole('special_educator'))
    <div class="sb-group">Main</div>
    <button class="sb-item {{ $activePanel === 'overview' ? 'active' : '' }}" onclick="showPanel('overview',this)">
        <i class="ti ti-layout-dashboard"></i> Dashboard
    </button>
    <button class="sb-item {{ $activePanel === 'students' ? 'active' : '' }}" onclick="showPanel('students',this)">
        <i class="ti ti-users"></i> My Students
    </button>
    <button class="sb-item {{ $activePanel === 'courses' ? 'active' : '' }}" onclick="showPanel('courses',this)">
        <i class="ti ti-books"></i> My Courses
    </button>
    <button class="sb-item {{ $activePanel === 'learning-materials' ? 'active' : '' }}" onclick="showPanel('learning-materials',this)">
        <i class="ti ti-files"></i> Learning Materials
    </button>

    <div class="sb-group">Management</div>
    <button class="sb-item {{ $activePanel === 'ieps' ? 'active' : '' }}" onclick="showPanel('ieps',this)">
        <i class="ti ti-clipboard-list"></i> IEPs
    </button>
    <button class="sb-item {{ $activePanel === 'notifications' ? 'active' : '' }}" onclick="showPanel('notifications',this)">
        <i class="ti ti-bell"></i> Notifications
    </button>

    <div class="sb-group">Account</div>
    <button class="sb-item {{ $activePanel === 'support' ? 'active' : '' }}" onclick="showPanel('support',this)">
        <i class="ti ti-headset"></i> Support
    </button>
    <button class="sb-item {{ $activePanel === 'profile' ? 'active' : '' }}" onclick="showPanel('profile',this)">
        <i class="ti ti-user"></i> Profile
    </button>

@elseif(Auth::user()->hasRole('therapist'))
    <div class="sb-group">Main</div>
    <button class="sb-item {{ $activePanel === 'overview' ? 'active' : '' }}" onclick="showPanel('overview',this)">
        <i class="ti ti-layout-dashboard"></i> Dashboard
    </button>
    <button class="sb-item {{ $activePanel === 'therapy-sessions' ? 'active' : '' }}" onclick="showPanel('therapy-sessions',this)">
        <i class="ti ti-calendar-event"></i> My Sessions
    </button>
    <button class="sb-item {{ $activePanel === 'students' ? 'active' : '' }}" onclick="showPanel('students',this)">
        <i class="ti ti-users"></i> My Students
    </button>
    <button class="sb-item {{ $activePanel === 'therapy-notes' ? 'active' : '' }}" onclick="showPanel('therapy-notes',this)">
        <i class="ti ti-notes"></i> Therapy Notes
    </button>
    <button class="sb-item {{ $activePanel === 'progress' ? 'active' : '' }}" onclick="showPanel('progress',this)">
        <i class="ti ti-chart-line"></i> Progress
    </button>

    <div class="sb-group">Management</div>
    <button class="sb-item {{ $activePanel === 'notifications' ? 'active' : '' }}" onclick="showPanel('notifications',this)">
        <i class="ti ti-bell"></i> Notifications
    </button>

    <div class="sb-group">Account</div>
    <button class="sb-item {{ $activePanel === 'support' ? 'active' : '' }}" onclick="showPanel('support',this)">
        <i class="ti ti-headset"></i> Support
    </button>
    <button class="sb-item {{ $activePanel === 'profile' ? 'active' : '' }}" onclick="showPanel('profile',this)">
        <i class="ti ti-user"></i> Profile
    </button>

@else
    <div class="sb-group">Main</div>
    <button class="sb-item active" onclick="showPanel('overview',this)">
        <i class="ti ti-layout-dashboard"></i> Dashboard
    </button>
@endif
