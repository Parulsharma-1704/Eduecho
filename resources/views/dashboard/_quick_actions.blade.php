@if(Auth::user()->hasRole('admin'))
    <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
    <div class="qa-grid" style="grid-template-columns: repeat(5, 1fr);">
        <div class="qa" onclick="showPanel('assignments',null)">
            <div class="qa-ico" style="background:var(--violet-ll)"><i class="ti ti-school" style="color:var(--violet)"></i></div>
            <strong>Approve Educators</strong>
            <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">{{ $stats['pending_requests'] ?? 0 }} Pending</span>
        </div>
        <div class="qa" onclick="showPanel('assignments',null)">
            <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-heart-handshake" style="color:var(--rd)"></i></div>
            <strong>Approve Therapists</strong>
            <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">{{ $stats['pending_requests'] ?? 0 }} Pending</span>
        </div>
        <div class="qa" onclick="showPanel('courses',null)">
            <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-book-upload" style="color:var(--teal)"></i></div>
            <strong>Create Course</strong>
            <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">New Module</span>
        </div>
        <div class="qa" onclick="showPanel('therapy-sessions',null)">
            <div class="qa-ico" style="background:var(--bl)"><i class="ti ti-calendar-plus" style="color:var(--blue)"></i></div>
            <strong>Schedule Therapy</strong>
            <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">Book Session</span>
        </div>
        <div class="qa" onclick="showPanel('notifications',null)">
            <div class="qa-ico" style="background:var(--al)"><i class="ti ti-broadcast" style="color:var(--ad)"></i></div>
            <strong>Send Announcement</strong>
            <span style="font-size:10px; color:var(--gray); display:block; margin-top:4px;">Broadcast</span>
        </div>
    </div>

@elseif(Auth::user()->hasRole('student'))
    <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
    <div class="qa-grid">
        @if(isset($user->student) && $user->student->assigned_educator_id)
            <div class="qa" onclick="window.location.href='{{ route('tutoring.hub') }}'">
                <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-message-circle" style="color:var(--teal)"></i></div>
                <strong>Chat with Tutor</strong>
            </div>
        @else
            <div class="qa" onclick="window.location.href='{{ route('tutoring.find-tutors') }}'">
                <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-user-search" style="color:var(--teal)"></i></div>
                <strong>Find a Tutor</strong>
            </div>
        @endif
        <div class="qa" onclick="showPanel('courses',null)">
            <div class="qa-ico" style="background:var(--violet-l)"><i class="ti ti-books" style="color:var(--violet)"></i></div>
            <strong>My Courses</strong>
        </div>
        <div class="qa" onclick="showPanel('assessments',null)">
            <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-writing" style="color:var(--rd)"></i></div>
            <strong>Take Assessment</strong>
        </div>
        <div class="qa" onclick="showPanel('therapy-sessions',null)">
            <div class="qa-ico" style="background:var(--al)"><i class="ti ti-heart" style="color:var(--ad)"></i></div>
            <strong>My Therapy</strong>
        </div>
    </div>

@elseif(Auth::user()->hasRole('special_educator'))
    <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
    <div class="qa-grid">
        <div class="qa" onclick="window.location.href='{{ route('tutoring.matching') }}'">
            <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-user-search" style="color:var(--teal)"></i></div>
            <strong>Find Students</strong>
        </div>
        <div class="qa" onclick="window.location.href='{{ route('tutoring.hub') }}'">
            <div class="qa-ico" style="background:var(--violet-l)"><i class="ti ti-message-circle" style="color:var(--violet)"></i></div>
            <strong>Chat with Students</strong>
        </div>
        <div class="qa" onclick="showPanel('courses',null)">
            <div class="qa-ico" style="background:var(--rl)"><i class="ti ti-book-plus" style="color:var(--rd)"></i></div>
            <strong>Create Course</strong>
        </div>
        <div class="qa" onclick="showPanel('ieps',null)">
            <div class="qa-ico" style="background:var(--al)"><i class="ti ti-clipboard-plus" style="color:var(--ad)"></i></div>
            <strong>Create IEP</strong>
        </div>
    </div>

@elseif(Auth::user()->hasRole('therapist'))
    <div class="eyebrow" style="margin-top:16px">Quick Actions</div>
    <div class="qa-grid">
        <div class="qa" onclick="showPanel('therapy-sessions',null)">
            <div class="qa-ico" style="background:var(--bl)"><i class="ti ti-calendar-event" style="color:var(--blue)"></i></div>
            <strong>Today's Schedule</strong>
        </div>
        <div class="qa" onclick="showPanel('students',null)">
            <div class="qa-ico" style="background:var(--teal-ll)"><i class="ti ti-users" style="color:var(--teal)"></i></div>
            <strong>Manage Students</strong>
        </div>
        <div class="qa" onclick="showPanel('notifications',null)">
            <div class="qa-ico" style="background:var(--al)"><i class="ti ti-bell" style="color:var(--ad)"></i></div>
            <strong>Notifications</strong>
        </div>
        <div class="qa" onclick="showPanel('profile',null)">
            <div class="qa-ico" style="background:var(--violet-l)"><i class="ti ti-user-circle" style="color:var(--violet)"></i></div>
            <strong>My Profile</strong>
        </div>
    </div>
@endif
