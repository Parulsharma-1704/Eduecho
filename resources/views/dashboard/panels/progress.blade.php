<div class="panel" id="panel-progress">
    @if(Auth::user()->hasRole('therapist'))
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--amber)">Analytics</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Student Progress Monitoring</div>
        </div>
    </div>

    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:20px;">
        @forelse($allStudents ?? [] as $student)
            @php
                $studentSessions = ($allSessions ?? collect())->where('student_id', $student->id);
                $totalSess       = $studentSessions->count();
                $completedSess   = $studentSessions->where('status', 'COMPLETED')->count();
                $attendancePct   = $totalSess > 0 ? round(($completedSess / $totalSess) * 100) : 0;
                $latestStrategy  = $studentSessions->whereNotNull('progress')->first()?->progress ?? 'No strategies suggested yet.';
            @endphp
            <div class="card" style="padding:20px; border-top:4px solid var(--amber);">
                <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:16px;">
                    <div>
                        <div style="font-weight:900; color:var(--navy); font-size:16px;">{{ $student->user->name }}</div>
                        <div style="font-size:12px; color:var(--gray);">{{ $student->disabilityProfile->disability_type ?? 'General' }} Support</div>
                    </div>
                    <div style="background:var(--al); color:var(--ad); padding:4px 10px; border-radius:6px; font-size:11px; font-weight:700;">
                        {{ $completedSess }} / {{ $totalSess }} Sessions
                    </div>
                </div>

                <div style="margin-bottom:12px;">
                    <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:4px;">
                        <span style="color:var(--gray);">Session Completion</span>
                        <span style="font-weight:700; color:var(--navy);">{{ $attendancePct }}%</span>
                    </div>
                    <div style="width:100%; height:6px; background:#f1f5f9; border-radius:3px; overflow:hidden;">
                        <div style="width:{{ $attendancePct }}%; height:100%; background:var(--amber); transition:0.3s;"></div>
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:4px;">
                        <span style="color:var(--gray);">Notes Documented</span>
                        <span style="font-weight:700; color:var(--teal);">{{ $studentSessions->whereNotNull('notes')->count() }} notes</span>
                    </div>
                    <div style="width:100%; height:6px; background:#f1f5f9; border-radius:3px; overflow:hidden;">
                        @php $notesPct = $totalSess > 0 ? round(($studentSessions->whereNotNull('notes')->count() / $totalSess) * 100) : 0; @endphp
                        <div style="width:{{ $notesPct }}%; height:100%; background:var(--teal); transition:0.3s;"></div>
                    </div>
                </div>

                @if($student->accessibilityProfile)
                    <div style="display:flex; flex-wrap:wrap; gap:6px; margin-bottom:12px;">
                        @if($student->accessibilityProfile->text_to_speech)
                            <span class="pill" style="background:var(--bl); color:var(--blue); font-size:9px;"><i class="ti ti-volume"></i> TTS</span>
                        @endif
                        @if($student->accessibilityProfile->high_contrast)
                            <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:9px;"><i class="ti ti-contrast"></i> High Contrast</span>
                        @endif
                        @if($student->accessibilityProfile->focus_mode)
                            <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9px;"><i class="ti ti-focus"></i> Focus Mode</span>
                        @endif
                    </div>
                @endif

                <div style="background:var(--page); padding:12px; border-radius:12px;">
                    <div style="font-size:11px; font-weight:700; color:var(--navy); margin-bottom:4px;"><i class="ti ti-bulb"></i> Latest Strategy</div>
                    <div style="font-size:12px; color:var(--gray); line-height:1.4;">{{ $latestStrategy }}</div>
                </div>
            </div>
        @empty
            <div class="card" style="grid-column: 1/-1; padding:40px; text-align:center; color:var(--gray);">
                <i class="ti ti-chart-bar-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                <p>No student progress data available.</p>
            </div>
        @endforelse
    </div>
    @else
        <div style="text-align:center; padding:60px; color:var(--gray);">
            <i class="ti ti-lock" style="font-size:48px; display:block; margin-bottom:12px;"></i>
            <p>This section is only available to therapists.</p>
        </div>
    @endif
</div>
