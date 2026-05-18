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
        
        <div id="course-list" style="display:flex; flex-direction:column; gap:16px;">
            @forelse($allCourses ?? [] as $course)
                @if(Auth::user()->hasRole('special_educator'))
                    <!-- Special Educator Rich Card with Collapsable Enrolled Students List -->
                    <div class="course-card" style="border:1px solid var(--teal-ll); border-radius:12px; background:#fff; overflow:hidden; box-sizing:border-box;">
                        <div class="course-item" style="display:flex; align-items:center; justify-content:space-between; padding:20px; background:var(--teal-ll);">
                            <div style="display:flex; align-items:flex-start; gap:14px; flex:1;">
                                <div style="width:44px; height:44px; border-radius:10px; background:#fff; display:flex; align-items:center; justify-content:center; flex-shrink:0; border:1px solid var(--teal-l);">
                                    <i class="ti ti-books" style="color:var(--teal); font-size:20px;"></i>
                                </div>
                                <div style="flex:1;">
                                    <div style="display:flex; justify-content:space-between; align-items:center;">
                                        <div style="font-weight:900; color:var(--navy); font-size:16px;">{{ $course->title }}</div>
                                        <div style="display:flex; gap:6px;">
                                            @if($course->support_type)
                                            <span class="pill" style="background:#fff; color:var(--navy); font-size:9.5px; border:1px solid var(--teal-l);">
                                                <i class="ti ti-accessible"></i> {{ $course->support_type }}
                                            </span>
                                            @endif
                                            @if($course->target_disabilities)
                                            <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9.5px; border:none;">
                                                {{ $course->target_disabilities }}
                                            </span>
                                            @endif
                                            <span class="pill" style="background:{{ $course->is_active ? 'var(--teal-ll)' : '#f1f5f9' }}; color:{{ $course->is_active ? 'var(--teal)' : 'var(--gray)' }}; font-size:9.5px; border:none; font-weight:700;">
                                                {{ $course->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div style="font-size:12.5px; color:var(--gray); margin-top:6px; line-height:1.4;">{{ Str::limit($course->description, 160) }}</div>
                                    <div style="font-size:11.5px; color:var(--gray); margin-top:10px; display:flex; align-items:center; gap:16px; font-weight:600;">
                                        <span><i class="ti ti-user"></i> Creator: {{ $course->creator->name ?? 'Admin' }}</span>
                                        <span><i class="ti ti-users"></i> {{ $course->enrollments->count() }} Enrolled Students</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="display:flex; align-items:center; gap:8px; flex-shrink:0; margin-left:16px;">
                                <button class="pill" style="border:1px solid var(--teal); background:#fff; color:var(--teal); cursor:pointer; font-weight:700; padding:6px 12px;" onclick="showPanel('learning-materials', null)">Manage Resources</button>
                                <button class="pill btn-teal" style="border:none; cursor:pointer; font-weight:700; padding:6px 12px; display:flex; align-items:center; gap:4px;" onclick="toggleCourseStudents({{ $course->id }})">
                                    <i class="ti ti-users"></i> Students <i class="ti ti-chevron-down" id="chevron-{{ $course->id }}"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Enrolled Students Table (Collapsable) -->
                        <div id="course-students-{{ $course->id }}" style="display:none; border-top:1px solid var(--teal-ll); padding:16px; background:#fafbfc; box-sizing:border-box;">
                            <div style="font-family:var(--font-head); font-size:13px; font-weight:800; color:var(--navy); margin-bottom:12px;">Enrolled Students & Progress</div>
                            <table style="width:100%; border-collapse:collapse; background:#fff; border-radius:8px; border:1px solid #f1f5f9; overflow:hidden;">
                                <thead>
                                    <tr style="background:#f8fafc; border-bottom:1px solid #f1f5f9;">
                                        <th style="padding:12px; text-align:left; font-size:11px; color:var(--gray); font-weight:700;">Student Name</th>
                                        <th style="padding:12px; text-align:left; font-size:11px; color:var(--gray); font-weight:700;">Disability Type</th>
                                        <th style="padding:12px; text-align:left; font-size:11px; color:var(--gray); font-weight:700;">Accessibility Preferences</th>
                                        <th style="padding:12px; text-align:left; font-size:11px; color:var(--gray); font-weight:700;">Learning Metrics & Progress</th>
                                        <th style="padding:12px; text-align:left; font-size:11px; color:var(--gray); font-weight:700;">Status</th>
                                        <th style="padding:12px; text-align:right; font-size:11px; color:var(--gray); font-weight:700;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($course->enrollments as $enrollment)
                                        @php
                                            $st = $enrollment->student;
                                            $stUser = $st->user ?? null;
                                            $dp = $st->disabilityProfile ?? null;
                                            $ap = $st->accessibilityProfile ?? null;
                                            $progress = $enrollment->status === 'Completed' ? 100 : ($enrollment->status === 'Active' ? 35 : 0);
                                        @endphp
                                        @if($stUser)
                                            <tr style="border-bottom:1px solid #f8fafc;">
                                                <td style="padding:12px;">
                                                    <div style="display:flex; align-items:center; gap:8px;">
                                                        <div style="width:28px; height:28px; border-radius:50%; background:var(--teal-ll); color:var(--teal); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:12px;">
                                                            {{ substr($stUser->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <div style="font-weight:700; color:var(--navy); font-size:13px;">{{ $stUser->name }}</div>
                                                            <div style="font-size:10px; color:var(--gray);">{{ $stUser->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="padding:12px;">
                                                    <span style="font-weight:600; color:var(--navy); font-size:12.5px;">{{ $dp->disability_type ?? 'N/A' }}</span>
                                                </td>
                                                <td style="padding:12px;">
                                                    <div style="display:flex; flex-wrap:wrap; gap:4px; max-width:180px;">
                                                        @if($ap)
                                                            @if($ap->text_to_speech) <span class="pill" style="font-size:9px; padding:2px 6px; background:var(--teal-ll); color:var(--teal);">TTS</span> @endif
                                                            @if($ap->screen_reader_support) <span class="pill" style="font-size:9px; padding:2px 6px; background:var(--teal-ll); color:var(--teal);">SR</span> @endif
                                                            @if($ap->high_contrast) <span class="pill" style="font-size:9px; padding:2px 6px; background:var(--al); color:var(--amber);">Contrast</span> @endif
                                                            @if($ap->focus_mode) <span class="pill" style="font-size:9px; padding:2px 6px; background:var(--violet-ll); color:var(--violet);">Focus</span> @endif
                                                            @if($ap->font_family === 'Dyslexia') <span class="pill" style="font-size:9px; padding:2px 6px; background:#f1f5f9; color:var(--navy);">Dyslexia-Font</span> @endif
                                                        @else
                                                            <span style="font-size:11px; color:var(--gray); font-style:italic;">Standard</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td style="padding:12px; width:220px;">
                                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px; font-size:10px; color:var(--gray); margin-bottom:6px;">
                                                        <span>Lessons: <strong>{{ $enrollment->status === 'Completed' ? '6/6' : ($enrollment->status === 'Active' ? '2/6' : '0/6') }}</strong></span>
                                                        <span>Engagement: <strong>{{ $enrollment->status === 'Completed' ? 'High' : ($enrollment->status === 'Active' ? 'Med' : 'None') }}</strong></span>
                                                    </div>
                                                    <div style="display:flex; align-items:center; gap:8px;">
                                                        <div style="flex:1; height:6px; background:#f1f5f9; border-radius:99px; overflow:hidden;">
                                                            <div style="width:{{ $progress }}%; height:100%; background:var(--teal); border-radius:99px;"></div>
                                                        </div>
                                                        <span style="font-size:11px; font-weight:700; color:var(--navy);">{{ $progress }}%</span>
                                                    </div>
                                                </td>
                                                <td style="padding:12px;">
                                                    @if($enrollment->status === 'Active')
                                                        <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:10px;">Active</span>
                                                    @elseif($enrollment->status === 'Completed')
                                                        <span class="pill" style="background:var(--bl); color:var(--blue); font-size:10px;">Completed</span>
                                                    @else
                                                        <span class="pill" style="background:#f1f5f9; color:#475569; font-size:10px;">Pending</span>
                                                    @endif
                                                </td>
                                                <td style="padding:12px; text-align:right;">
                                                    <button class="tb-icon-btn" style="width:28px; height:28px;" onclick="openStudentDetailsModal({{ json_encode($stUser) }}, {{ json_encode($st) }})" title="View Profile & Needs">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="6" style="padding:20px; text-align:center; color:var(--gray); font-size:12px;">
                                                No students enrolled in this course yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <!-- Original Admin/Default Flat Row Design -->
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
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <div style="text-align:center; padding:40px; color:var(--gray);">
                    <p>No courses found.</p>
                </div>
            @endforelse
        </div>
    @endif
</div>

<script>
    function toggleCourseStudents(courseId) {
        const div = document.getElementById('course-students-' + courseId);
        const icon = document.getElementById('chevron-' + courseId);
        if (div) {
            if (div.style.display === 'none') {
                div.style.display = 'block';
                if (icon) icon.className = 'ti ti-chevron-up';
            } else {
                div.style.display = 'none';
                if (icon) icon.className = 'ti ti-chevron-down';
            }
        }
    }
</script>
