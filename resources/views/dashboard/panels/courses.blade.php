<div class="panel" id="panel-courses">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <div>
            <div class="eyebrow">Education</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                @if(Auth::user()->hasRole('student')) My Enrolled Courses @else All Courses @endif
            </div>
        </div>
        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('special_educator'))
            <button class="btn-teal" onclick="showModal('add-course-modal')"><i class="ti ti-book-plus"></i> Create Course</button>
        @endif
    </div>

    @if(Auth::user()->hasRole('student'))
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:20px;">
            @forelse($enrolledCourses ?? [] as $course)
                <div class="card" style="padding:20px; display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                            <div style="width:40px; height:40px; border-radius:10px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center;">
                                <i class="ti ti-book" style="color:var(--teal); font-size:20px;"></i>
                            </div>
                            <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:10px;">Enrolled</span>
                        </div>
                        <h3 style="font-size:15px; font-weight:700; color:var(--navy); margin-bottom:6px;">{{ $course->title }}</h3>
                        <p style="font-size:12px; color:var(--gray); margin-bottom:16px; line-height:1.4;">{{ Str::limit($course->description, 80) }}</p>
                    </div>
                    
                    <div style="display:flex; gap:8px;">
                        <button class="btn-teal" style="flex:1; font-size:12px; padding:10px;">Continue Learning</button>
                    </div>
                </div>
            @empty
                <div class="card" style="grid-column: 1 / -1; padding:40px; text-align:center;">
                    <i class="ti ti-book-off" style="font-size:48px; color:var(--gray-b); display:block; margin-bottom:12px;"></i>
                    <p style="color:var(--gray)">You are not enrolled in any courses yet.</p>
                </div>
            @endforelse
        </div>
    @else
        <div style="display:flex; gap:12px; margin-bottom:16px;">
            <div style="flex:1; position:relative;">
                <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
                <input type="text" placeholder="Search courses..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <div id="course-list">
            @forelse($allCourses ?? [] as $course)
                <div class="course-item" style="display:flex; align-items:center; justify-content:space-between; padding:16px; border-bottom:1px solid var(--teal-ll);">
                    <div style="display:flex; align-items:center; gap:14px; flex:1;">
                        <div style="width:44px; height:44px; border-radius:10px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="ti ti-books" style="color:var(--teal); font-size:20px;"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-weight:700; color:var(--navy); font-size:14px;">{{ $course->title }}</div>
                            <div style="font-size:11px; color:var(--gray); margin-top:2px;">
                                <i class="ti ti-user"></i> {{ $course->creator->name ?? 'N/A' }} &nbsp;&bull;&nbsp;
                                <i class="ti ti-users"></i> {{ $course->enrollments_count ?? 0 }} enrolled
                            </div>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                        @if(Auth::user()->hasRole('admin'))
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
