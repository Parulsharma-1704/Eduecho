<div class="panel" id="panel-students">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <div>
            <div class="eyebrow">Management</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                @if(Auth::user()->hasRole('admin')) All Students
                @elseif(Auth::user()->hasRole('therapist')) My Assigned Students
                @else My Students
                @endif
            </div>
        </div>
        @if(Auth::user()->hasRole('admin'))
            <button class="btn-teal" onclick="showModal('add-student-modal')"><i class="ti ti-user-plus"></i> Add Student</button>
        @endif
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
                    @if(Auth::user()->hasRole('therapist'))
                        {{ substr($student->user->name ?? '?', 0, 1) }}
                    @else
                        {{ substr($student->name ?? '?', 0, 1) }}
                    @endif
                </div>
                <div style="flex:1; display:flex; justify-content:space-between; align-items:center;">
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-right:16px;">
                            <div class="stu-name">
                                @if(Auth::user()->hasRole('therapist'))
                                    {{ $student->user->name ?? 'Unknown' }}
                                @else
                                    {{ $student->name ?? 'Unknown' }}
                                @endif
                            </div>
                            <span class="pill" style="background:var(--teal-ll);color:var(--teal-d);font-size:9px">
                                @if(Auth::user()->hasRole('therapist'))
                                    {{ $student->disabilityProfile->disability_type ?? 'No Disability Profile' }}
                                @else
                                    {{ $student->student?->disabilityProfile?->disability_type ?? 'No Disability' }}
                                @endif
                            </span>
                        </div>
                        <div class="stu-meta">
                            @if(Auth::user()->hasRole('therapist'))
                                {{ $student->user->email ?? '' }}
                            @else
                                {{ $student->email ?? '' }}
                            @endif
                        </div>
                        <div style="margin-top:6px;display:flex;gap:12px;font-size:10px;color:var(--gray)">
                            @if(Auth::user()->hasRole('therapist'))
                                {{-- Therapist view: Show session count and accessibility info --}}
                                <span><i class="ti ti-calendar-event"></i>
                                    {{ $allSessions->where('student_id', $student->id)->count() }} Sessions</span>
                                @if($student->accessibilityProfile)
                                    <span><i class="ti ti-accessible"></i>
                                        {{ $student->accessibilityProfile->text_to_speech ? 'TTS' : '' }}
                                        {{ $student->accessibilityProfile->high_contrast ? '· High Contrast' : '' }}
                                        {{ $student->accessibilityProfile->focus_mode ? '· Focus Mode' : '' }}
                                    </span>
                                @endif
                            @else
                                {{-- Admin/Educator view --}}
                                <span><i class="ti ti-books"></i>
                                    {{ $student->student?->courseEnrollments?->count() ?? 0 }} Courses</span>
                                <span><i class="ti ti-calendar"></i> Registered:
                                    {{ $student->created_at->format('M Y') }}</span>
                            @endif
                        </div>

                        {{-- Progress bar for therapist --}}
                        @if(Auth::user()->hasRole('therapist'))
                            @php
                                $totalSess = $allSessions->where('student_id', $student->id)->count();
                                $completedSess = $allSessions->where('student_id', $student->id)->where('status', 'COMPLETED')->count();
                                $pct = $totalSess > 0 ? round(($completedSess / $totalSess) * 100) : 0;
                            @endphp
                            <div style="margin-top:8px;">
                                <div style="display:flex; justify-content:space-between; font-size:9px; margin-bottom:2px;">
                                    <span style="color:var(--gray);">Therapy Progress</span>
                                    <span style="font-weight:700; color:var(--violet);">{{ $pct }}%</span>
                                </div>
                                <div style="width:100%; height:4px; background:#f1f5f9; border-radius:2px; overflow:hidden;">
                                    <div style="width:{{ $pct }}%; height:100%; background:var(--violet); transition:0.3s;"></div>
                                </div>
                            </div>
                        @else
                            <!-- Progress for the first course (Admin/Educator) -->
                            @if($student->student?->courseEnrollments && $student->student->courseEnrollments->isNotEmpty())
                                @php $firstEnrollment = $student->student->courseEnrollments->first(); @endphp
                                <div style="margin-top:8px;">
                                    <div style="display:flex; justify-content:space-between; font-size:9px; margin-bottom:2px;">
                                        <span style="color:var(--gray);">{{ $firstEnrollment->course->title }}</span>
                                        <span style="font-weight:700; color:var(--teal);">{{ $firstEnrollment->status === 'completed' ? '100%' : 'In Progress' }}</span>
                                    </div>
                                    <div style="width:100%; height:4px; background:#f1f5f9; border-radius:2px; overflow:hidden;">
                                        <div style="width: {{ $firstEnrollment->status === 'completed' ? '100%' : '35%' }}; height:100%; background:var(--teal); transition:0.3s;"></div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>

                    <div style="display:flex; gap:8px;">
                        @if(Auth::user()->hasRole('admin'))
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
                        @elseif(Auth::user()->hasRole('therapist'))
                            <button class="pill" style="border:none; cursor:pointer; background:var(--violet-l); color:var(--violet)" onclick="showPanel('therapy-notes', null)">
                                <i class="ti ti-notes"></i> Notes
                            </button>
                            <button class="pill" style="border:none; cursor:pointer; background:var(--teal-ll); color:var(--teal)" onclick="showPanel('progress', null)">
                                <i class="ti ti-chart-line"></i> Progress
                            </button>
                        @else
                            <button class="pill" style="border:none; cursor:pointer; background:var(--teal-ll); color:var(--teal)" onclick="showPanel('ieps', null)">View IEP</button>
                            <button class="pill" style="border:none; cursor:pointer; background:var(--violet-l); color:var(--violet)">Report</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align:center;color:var(--gray);padding:20px">No students found</p>
        @endforelse
    </div>
</div>
