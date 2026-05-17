<div class="panel" id="panel-courses">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <div>
            <div class="eyebrow" style="color:var(--teal)">Education</div>
            <div style="font-family:var(--font-head);font-size:20px;font-weight:900;color:var(--navy)">
                @if(Auth::user()->hasRole('student')) Accessibility Learning Portal @else Accessibility Courses @endif
            </div>
        </div>
        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('special_educator'))
            <button class="btn-teal" onclick="showModal('add-course-modal')"><i class="ti ti-book-plus"></i> Create Course</button>
        @endif
    </div>

    @if(Auth::user()->hasRole('student'))
        <!-- Student Dashboard Layout -->
        
        <!-- Section 1: My Courses (Enrolled) -->
        <div style="margin-bottom:32px;">
            <h3 style="font-family:var(--font-head); font-size:15px; font-weight:800; color:var(--navy); margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-books" style="color:var(--teal); font-size:20px;"></i>
                My Enrolled Courses
            </h3>
            
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap:20px;">
                @forelse($enrollments ?? [] as $enrollment)
                    @php
                        $course = $enrollment->course;
                        $isApproved = $enrollment->status === 'Active';
                        $statusBadgeColor = $isApproved ? 'var(--teal)' : 'var(--amber)';
                        $statusBadgeBg = $isApproved ? 'var(--teal-ll)' : 'var(--al)';
                    @endphp
                    <div class="card" style="padding:24px; display:flex; flex-direction:column; justify-content:space-between; border-top: 4px solid {{ $statusBadgeColor }}">
                        <div>
                            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px;">
                                <div style="width:36px; height:36px; border-radius:8px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center;">
                                    <i class="ti ti-book" style="color:var(--teal); font-size:18px;"></i>
                                </div>
                                <span style="padding:4px 10px; border-radius:100px; font-size:10px; font-weight:800; background:{{ $statusBadgeBg }}; color:{{ $statusBadgeColor }}; text-transform:uppercase;">
                                    {{ $isApproved ? 'Approved' : 'Pending Approval' }}
                                </span>
                            </div>
                            
                            <h4 style="font-size:15px; font-weight:800; color:var(--navy); margin-bottom:6px;">{{ $course->title }}</h4>
                            <p style="font-size:12px; color:var(--gray); margin-bottom:16px; line-height:1.4;">{{ Str::limit($course->description, 100) }}</p>
                            
                            <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:20px; font-size:12px;">
                                <div style="display:flex; justify-content:space-between;">
                                    <span style="color:var(--gray);">Support Type:</span>
                                    <span style="font-weight:700; color:var(--navy);">{{ $course->support_type ?? 'Standard' }}</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="color:var(--gray);">Assigned Educator:</span>
                                    @if($isApproved)
                                        <span style="font-weight:700; color:var(--teal); text-align:right;">
                                            {{ $course->assignedEducator->name ?? 'Unassigned' }}
                                            @php
                                                $specializer = $course->assignedEducator?->specialEducator;
                                                $specializations = $specializer?->disabilitySpecializations->pluck('disability_type')->implode(', ');
                                            @endphp
                                            @if($specializations)
                                                <div style="font-size:9px; font-weight:600; color:var(--gray); font-style:italic;">
                                                    Spec: {{ $specializations }}
                                                </div>
                                            @endif
                                        </span>
                                    @else
                                        <span style="font-weight:700; color:var(--gray); font-style:italic;">Pending Approval</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            @if($isApproved)
                                <!-- Course progress -->
                                <div style="margin-bottom:16px;">
                                    <div style="display:flex; justify-content:space-between; font-size:11px; font-weight:700; color:var(--navy); margin-bottom:4px;">
                                        <span>Learning Progress</span>
                                        <span>35%</span>
                                    </div>
                                    <div style="width:100%; height:6px; background:#f1f5f9; border-radius:99px; overflow:hidden;">
                                        <div style="width:35%; height:100%; background:var(--teal); border-radius:99px;"></div>
                                    </div>
                                </div>
                                <button class="btn-teal" style="width:100%; font-size:12px; padding:10px;">
                                    <i class="ti ti-player-play"></i> Continue Learning
                                </button>
                            @else
                                <button class="btn-teal" disabled style="width:100%; font-size:12px; padding:10px; background:var(--gray-b); color:var(--gray); cursor:not-allowed; border:none; box-shadow:none;">
                                    <i class="ti ti-lock"></i> Materials Locked
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="card" style="grid-column: 1 / -1; padding:40px; text-align:center;">
                        <i class="ti ti-book-off" style="font-size:48px; color:var(--gray-b); display:block; margin-bottom:12px;"></i>
                        <p style="color:var(--gray)">You are not enrolled in any courses yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Section 2: Personalized Course Recommendations -->
        @if(isset($disabilityProfile) && $disabilityProfile)
            <div style="margin-bottom:32px; background:var(--teal-ll); border-radius:16px; padding:24px;">
                <h3 style="font-family:var(--font-head); font-size:16px; font-weight:900; color:var(--navy); margin-bottom:4px; display:flex; align-items:center; gap:8px;">
                    <i class="ti ti-sparkles" style="color:var(--teal); font-size:22px;"></i>
                    Recommended for You
                </h3>
                <p style="font-size:12px; color:var(--gray); margin-bottom:20px;">
                    Courses perfectly optimized for your disability category (<strong>{{ $disabilityProfile->disability_type }}</strong>) and accessibility needs.
                </p>
                
                <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:20px;">
                    @forelse($recommendedCourses ?? [] as $course)
                        <div class="card" style="padding:20px; display:flex; flex-direction:column; justify-content:space-between; background:#fff; border:1px solid var(--teal-l); box-shadow:0 8px 24px rgba(20,184,166,0.06);">
                            <div>
                                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                    <span class="pill" style="background:var(--teal); color:#fff; font-size:9px; font-weight:800; border:none; padding:3px 8px;">
                                        <i class="ti ti-star"></i> High Match
                                    </span>
                                    <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9px; font-weight:800; border:none;">
                                        {{ $course->support_type }}
                                    </span>
                                </div>
                                
                                <h4 style="font-size:14px; font-weight:800; color:var(--navy); margin-bottom:6px;">{{ $course->title }}</h4>
                                <p style="font-size:11.5px; color:var(--gray); margin-bottom:16px; line-height:1.4;">{{ Str::limit($course->description, 100) }}</p>
                                
                                <div style="display:flex; flex-direction:column; gap:6px; font-size:11px; margin-bottom:16px; border-top:1px solid #f1f5f9; padding-top:12px;">
                                    <div style="display:flex; justify-content:space-between;">
                                        <span style="color:var(--gray);">Support Category:</span>
                                        <span style="font-weight:700; color:var(--navy);">{{ $course->target_disabilities }}</span>
                                    </div>
                                    <div style="display:flex; justify-content:space-between;">
                                        <span style="color:var(--gray);">Educator:</span>
                                        <span style="font-weight:700; color:var(--navy);">{{ $course->assignedEducator->name ?? 'Unassigned' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
                                @csrf
                                <button type="submit" class="btn-teal" style="width:100%; font-size:11px; padding:8px 12px;">
                                    <i class="ti ti-user-plus"></i> Enroll in Course
                                </button>
                            </form>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align:center; padding:20px; color:var(--gray); font-size:12px;">
                            No new course recommendations currently match your accessibility category.
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        <!-- Section 3: Other Available Courses -->
        <div>
            <h3 style="font-family:var(--font-head); font-size:15px; font-weight:800; color:var(--navy); margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-grid-dots" style="color:var(--gray); font-size:20px;"></i>
                Other Available Courses
            </h3>
            
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:20px;">
                @forelse($availableCourses ?? [] as $course)
                    <div class="card" style="padding:20px; display:flex; flex-direction:column; justify-content:space-between;">
                        <div>
                            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                <span class="pill" style="background:#f1f5f9; color:var(--navy); font-size:9px; font-weight:800; border:none;">
                                    {{ $course->target_disabilities }}
                                </span>
                                <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9px; font-weight:800; border:none;">
                                    {{ $course->support_type }}
                                </span>
                            </div>
                            
                            <h4 style="font-size:14px; font-weight:800; color:var(--navy); margin-bottom:6px;">{{ $course->title }}</h4>
                            <p style="font-size:11.5px; color:var(--gray); margin-bottom:16px; line-height:1.4;">{{ Str::limit($course->description, 100) }}</p>
                            
                            <div style="display:flex; flex-direction:column; gap:6px; font-size:11px; margin-bottom:16px; border-top:1px solid #f1f5f9; padding-top:12px;">
                                <div style="display:flex; justify-content:space-between;">
                                    <span style="color:var(--gray);">Educator:</span>
                                    <span style="font-weight:700; color:var(--navy);">{{ $course->assignedEducator->name ?? 'Unassigned' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
                            @csrf
                            <button type="submit" class="btn-teal" style="width:100%; font-size:11px; padding:8px 12px; background:var(--gray-b); color:var(--navy); border:none; box-shadow:none;">
                                <i class="ti ti-user-plus"></i> Enroll
                            </button>
                        </form>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align:center; padding:30px; color:var(--gray); font-size:12px;">
                        No other courses available at this time.
                    </div>
                @endforelse
            </div>
        </div>

    @else
        <!-- Admin & Educator View -->
        
        @if(Auth::user()->hasRole('admin') && isset($pendingEnrollments) && $pendingEnrollments->count() > 0)
            <!-- Admin Enrollment Approval Queue -->
            <div style="margin-bottom:32px; background:var(--al); border-radius:12px; padding:20px; border:1px solid var(--amber); box-sizing:border-box;">
                <h3 style="font-family:var(--font-head); font-size:14px; font-weight:800; color:var(--navy); margin-bottom:4px; display:flex; align-items:center; gap:8px;">
                    <i class="ti ti-user-check" style="color:var(--amber); font-size:18px;"></i>
                    Course Enrollment Approval Requests
                </h3>
                <p style="font-size:11px; color:var(--gray); margin-bottom:16px;">Approve pending accessibility course enrollment requests filed by students.</p>
                
                <div style="display:flex; flex-direction:column; gap:10px;">
                    @foreach($pendingEnrollments as $req)
                        <div style="background:#fff; border-radius:8px; padding:12px 16px; border:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; gap:16px; box-sizing:border-box;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:36px; height:36px; border-radius:50%; background:var(--al); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="ti ti-user-exclamation" style="color:var(--amber); font-size:16px;"></i>
                                </div>
                                <div>
                                    <div style="font-size:13px; font-weight:700; color:var(--navy);">
                                        {{ $req->student->user->name ?? 'Unknown Student' }}
                                    </div>
                                    <div style="font-size:11px; color:var(--gray);">
                                        Wants to enroll in: <span style="font-weight:700; color:var(--teal);">{{ $req->course->title }}</span> ({{ $req->course->support_type }})
                                    </div>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('admin.courses.approve-enrollment', $req->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-teal" style="background:var(--teal); color:#fff; border:none; padding:8px 14px; font-size:11px; border-radius:6px; cursor:pointer;">
                                    <i class="ti ti-check"></i> Approve Enrollment
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div style="display:flex; gap:12px; margin-bottom:16px;">
            <div style="flex:1; position:relative;">
                <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
                <input type="text" placeholder="Search courses..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        
        <div id="course-list">
            @forelse($allCourses ?? [] as $course)
                <div class="course-item" style="display:flex; align-items:center; justify-content:space-between; padding:16px; border-bottom:1px solid var(--teal-ll);">
                    <div style="display:flex; align-items:flex-start; gap:14px; flex:1;">
                        <div style="width:44px; height:44px; border-radius:10px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="ti ti-books" style="color:var(--teal); font-size:20px;"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <div style="font-weight:700; color:var(--navy); font-size:14px;">{{ $course->title }}</div>
                                <div style="display:flex; gap:6px;">
                                    @if($course->support_type)
                                    <span class="pill" style="background:#f1f5f9; color:var(--navy); font-size:9px;">
                                        <i class="ti ti-accessible"></i> {{ $course->support_type }}
                                    </span>
                                    @endif
                                    @if($course->target_disabilities)
                                    <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9px;">
                                        {{ $course->target_disabilities }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="font-size:12px; color:var(--gray); margin-top:4px;">{{ Str::limit($course->description, 80) }}</div>
                            <div style="font-size:11px; color:var(--gray); margin-top:8px; display:flex; align-items:center; gap:16px;">
                                <span><i class="ti ti-user"></i> Educator: {{ $course->assignedEducator->name ?? 'Unassigned' }}</span>
                                <span><i class="ti ti-users"></i> {{ $course->enrollments_count ?? 0 }} Enrolled Students</span>
                            </div>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                        @if(Auth::user()->hasRole('admin'))
                            <form method="POST" action="{{ route('admin.courses.assign-educator', $course->id) }}">
                                @csrf @method('PATCH')
                                <select name="assigned_educator_id" onchange="this.form.submit()" style="padding:4px 8px; border:1px solid var(--teal); border-radius:12px; font-size:11px; outline:none; background:transparent; color:var(--teal); cursor:pointer;">
                                    <option value="">Assign Educator...</option>
                                    @foreach($allEducators ?? [] as $edu)
                                        @php
                                            $hasSpec = $edu->specialEducator?->disabilitySpecializations->contains('disability_type', $course->target_disabilities);
                                        @endphp
                                        @if($hasSpec)
                                            <option value="{{ $edu->id }}" {{ $course->assigned_educator_id == $edu->id ? 'selected' : '' }}>
                                                {{ $edu->name }} (Match)
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                            <form method="POST" action="{{ route('admin.courses.toggle-active', $course->id) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $course->is_active ? 'var(--teal-ll)' : '#f1f5f9' }}; color:{{ $course->is_active ? 'var(--teal)' : 'var(--gray)' }}; padding:4px 10px;">
                                    {{ $course->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        @elseif(Auth::user()->hasRole('special_educator'))
                            <button class="pill" style="border:1px solid var(--teal); background:transparent; color:var(--teal); cursor:pointer;" onclick="showPanel('learning-materials', null)">Manage Resources</button>
                            <button class="pill" style="border:none; background:var(--teal); color:#fff; cursor:pointer;">Edit</button>
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
