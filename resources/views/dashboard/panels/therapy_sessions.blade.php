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
            $sessionsData = Auth::user()->hasRole('student') ? ($upcomingSessions ?? []) : (Auth::user()->hasRole('therapist') ? ($upcomingSessions ?? []) : ($allTherapySessions ?? []));
        @endphp
        @forelse($sessionsData as $session)
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
                    
                    @if(Auth::user()->hasRole('therapist'))
                        <button class="pill" style="background:var(--teal-ll); color:var(--teal); border:none; cursor:pointer;" onclick="addNote({{ $session->id }})"><i class="ti ti-notes"></i> Add Note</button>
                    @endif
                </div>
            </div>
        @empty
            <div style="text-align:center; padding:40px; color:var(--gray);">
                <p>No sessions found.</p>
            </div>
        @endforelse
    </div>
</div>
