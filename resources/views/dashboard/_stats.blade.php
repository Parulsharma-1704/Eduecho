@if(Auth::user()->hasRole('admin'))
    <div class="stat-row" style="grid-template-columns: repeat(3, 1fr);">
        <div class="sc" onclick="showPanel('students',null)">
            <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-users" style="color:var(--teal)"></i></div>
            <div class="sc-label">Total Students</div>
            <div class="sc-val" style="color:var(--teal)">{{ $stats['total_students'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('educators',null)">
            <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-school" style="color:var(--violet)"></i></div>
            <div class="sc-label">Total Educators</div>
            <div class="sc-val" style="color:var(--violet)">{{ $stats['total_educators'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy',null)">
            <div class="sc-ico" style="background:var(--rl)"><i class="ti ti-heart-handshake" style="color:var(--rd)"></i></div>
            <div class="sc-label">Total Therapists</div>
            <div class="sc-val" style="color:var(--rd)">{{ $stats['total_therapists'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('courses',null)">
            <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-books" style="color:var(--teal)"></i></div>
            <div class="sc-label">Total Courses</div>
            <div class="sc-val" style="color:var(--teal)">{{ $stats['total_courses'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="window.location.href='{{ route('educator-request.index') }}'">
            <div class="sc-ico" style="background:var(--al)"><i class="ti ti-clock" style="color:var(--ad)"></i></div>
            <div class="sc-label">Pending Requests</div>
            <div class="sc-val" style="color:var(--ad)">{{ $stats['pending_requests'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy-sessions',null)">
            <div class="sc-ico" style="background:var(--bl)"><i class="ti ti-calendar-event" style="color:var(--blue)"></i></div>
            <div class="sc-label">Upcoming Therapy Sessions</div>
            <div class="sc-val" style="color:var(--blue)">{{ $stats['upcoming_sessions'] ?? 0 }}</div>
        </div>
    </div>

@elseif(Auth::user()->hasRole('student'))
    <div class="stat-row" style="grid-template-columns: repeat(2, 1fr);">
        <div class="sc" onclick="showPanel('courses',null)">
            <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-books" style="color:var(--teal)"></i></div>
            <div class="sc-label">Enrolled Courses</div>
            <div class="sc-val" style="color:var(--teal)">{{ $stats['enrolled_courses'] ?? 0 }}</div>
        </div>
        <div class="sc">
            <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-checklist" style="color:var(--violet)"></i></div>
            <div class="sc-label">Completed Lessons</div>
            <div class="sc-val" style="color:var(--violet)">{{ $stats['completed_lessons'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy-sessions',null)">
            <div class="sc-ico" style="background:var(--rl)"><i class="ti ti-heart-handshake" style="color:var(--rd)"></i></div>
            <div class="sc-label">Upcoming Therapy Sessions</div>
            <div class="sc-val" style="color:var(--rd)">{{ $stats['therapy_sessions'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('notifications',null)">
            <div class="sc-ico" style="background:var(--bl)"><i class="ti ti-bell" style="color:var(--blue)"></i></div>
            <div class="sc-label">Notifications</div>
            <div class="sc-val" style="color:var(--blue)">{{ $stats['notifications'] ?? 0 }}</div>
        </div>
    </div>

@elseif(Auth::user()->hasRole('special_educator'))
    <div class="stat-row">
        <div class="sc" onclick="showPanel('students',null)">
            <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-users" style="color:var(--teal)"></i></div>
            <div class="sc-label">Assigned Students</div>
            <div class="sc-val" style="color:var(--teal)">{{ $stats['total_students'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('courses',null)">
            <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-books" style="color:var(--violet)"></i></div>
            <div class="sc-label">Active Courses</div>
            <div class="sc-val" style="color:var(--violet)">{{ $stats['total_courses'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('learning-materials',null)">
            <div class="sc-ico" style="background:var(--bl)"><i class="ti ti-files" style="color:var(--blue)"></i></div>
            <div class="sc-label">Learning Materials</div>
            <div class="sc-val" style="color:var(--blue)">{{ $stats['total_materials'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy-sessions',null)">
            <div class="sc-ico" style="background:var(--al)"><i class="ti ti-calendar-event" style="color:var(--ad)"></i></div>
            <div class="sc-label">Upcoming Sessions</div>
            <div class="sc-val" style="color:var(--ad)">{{ $stats['upcoming_activities'] ?? 0 }}</div>
        </div>
    </div>

@elseif(Auth::user()->hasRole('therapist'))
    <div class="stat-row">
        <div class="sc" onclick="showPanel('students',null)">
            <div class="sc-ico" style="background:var(--violet-l)"><i class="ti ti-users" style="color:var(--violet)"></i></div>
            <div class="sc-label">Assigned Students</div>
            <div class="sc-val" style="color:var(--violet)">{{ $stats['total_students'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy-sessions',null)">
            <div class="sc-ico" style="background:var(--teal-ll)"><i class="ti ti-calendar-event" style="color:var(--teal)"></i></div>
            <div class="sc-label">Upcoming Sessions</div>
            <div class="sc-val" style="color:var(--teal)">{{ $stats['upcoming_sessions'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy-sessions',null)">
            <div class="sc-ico" style="background:var(--bl)"><i class="ti ti-circle-check" style="color:var(--blue)"></i></div>
            <div class="sc-label">Completed Sessions</div>
            <div class="sc-val" style="color:var(--blue)">{{ $stats['completed_sessions'] ?? 0 }}</div>
        </div>
        <div class="sc" onclick="showPanel('therapy-notes',null)">
            <div class="sc-ico" style="background:var(--al)"><i class="ti ti-clipboard-text" style="color:var(--ad)"></i></div>
            <div class="sc-label">Pending Notes</div>
            <div class="sc-val" style="color:var(--ad)">{{ $stats['pending_notes'] ?? 0 }}</div>
        </div>
    </div>
@endif
