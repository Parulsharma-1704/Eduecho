<!-- =================== ADD USER MODALS =================== -->
<div id="modal-overlay" onclick="closeModal()" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:9000;"></div>

<!-- Add Student Modal -->
<div id="add-student-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">User Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Add New Student</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Password</label>
                <input type="password" name="password" required placeholder="Create a password" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <input type="hidden" name="role" value="student">
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Create Student</button>
        </div>
    </form>
</div>

<!-- Add Educator Modal -->
<div id="add-educator-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--violet); margin-bottom:4px;">User Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Add New Educator</div>
        </div>
        <button onclick="closeModal()" style="background:var(--violet-l); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--violet); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Password</label>
                <input type="password" name="password" required placeholder="Create a password" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <input type="hidden" name="role" value="special_educator">
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--violet-l); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--violet); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px; background:var(--violet);">Create Educator</button>
        </div>
    </form>
</div>

<!-- Add Therapist Modal -->
<div id="add-therapist-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--rd); margin-bottom:4px;">User Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Add New Therapist</div>
        </div>
        <button onclick="closeModal()" style="background:var(--rl); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--rd); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                <input type="text" name="name" required placeholder="Enter full name" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Password</label>
                <input type="password" name="password" required placeholder="Create a password" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
        </div>
        <input type="hidden" name="role" value="therapist">
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--rl); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--rd); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px; background:var(--rose);">Create Therapist</button>
        </div>
    </form>
</div>

<!-- Create Course Modal -->
<div id="add-course-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:500px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:90vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">Course Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Create New Course</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.courses.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Course Title</label>
                <input type="text" name="title" required placeholder="e.g. Introduction to Sign Language" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Description</label>
                <textarea name="description" rows="3" placeholder="Brief course description..." style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box; resize:vertical;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Disability Support Category</label>
                <select name="target_disabilities" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select Category --</option>
                    <option value="Visual Impairment">Visual Impairment</option>
                    <option value="Hearing Impairment">Hearing Impairment</option>
                    <option value="Dyslexia">Dyslexia</option>
                    <option value="Autism / ADHD">Autism / ADHD</option>
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Learning Format / Support Type</label>
                <select name="support_type" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select Support Type --</option>
                    <option value="Audio-Based">Audio-Based</option>
                    <option value="Caption-Supported">Caption-Supported</option>
                    <option value="Text-Based">Text-Based</option>
                    <option value="Interactive Learning">Interactive Learning</option>
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Assigned Educator (Optional)</label>
                <select name="created_by_id" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="{{ Auth::id() }}">-- Assign Later (Self) --</option>
                    @foreach($allEducators ?? [] as $edu)
                        <option value="{{ $edu->id }}">{{ $edu->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Create Course</button>
        </div>
    </form>
</div>

<!-- Schedule Therapy Session Modal -->
<div id="schedule-session-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:500px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:90vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--rd); margin-bottom:4px;">Therapy Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Schedule Session</div>
        </div>
        <button onclick="closeModal()" style="background:var(--rl); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--rd); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.therapy.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Student</label>
                <select name="student_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select Student --</option>
                    @foreach($allStudents ?? [] as $stu)
                        @if($stu->student)
                            <option value="{{ $stu->student->id }}">{{ $stu->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Therapist</label>
                <select name="therapist_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    @foreach($allTherapists ?? [] as $th)
                        <option value="{{ $th->id }}">{{ $th->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Session Type</label>
                    <select name="session_type" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="">-- Select Type --</option>
                        <option value="speech">Speech Therapy</option>
                        <option value="occupational">Occupational Therapy</option>
                        <option value="physical">Physical Therapy</option>
                        <option value="behavioral">Behavioral Therapy</option>
                        <option value="counseling">Counseling</option>
                        <option value="special_education">Special Education</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Duration (min)</label>
                    <select name="duration" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="30">30 minutes</option>
                        <option value="45">45 minutes</option>
                        <option value="60" selected>60 minutes</option>
                        <option value="90">90 minutes</option>
                    </select>
                </div>
            </div>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Date</label>
                    <input type="date" name="session_date" required min="{{ date('Y-m-d') }}" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Time</label>
                    <input type="time" name="session_time" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--rl); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--rd); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px; background:var(--rose);">Schedule Session</button>
        </div>
    </form>
</div>

<!-- Upload Learning Material Modal -->
<div id="upload-material-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:480px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:90vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">Resource Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Upload Learning Material</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    
    @php
        $educatorSpecializations = [];
        if (Auth::check() && Auth::user()->hasRole('special_educator')) {
            $specialEducator = Auth::user()->specialEducator;
            if ($specialEducator) {
                $educatorSpecializations = $specialEducator->disabilitySpecializations->pluck('disability_type')->map(fn($item) => strtolower($item))->toArray();
            }
        }
        $isAdmin = Auth::check() && Auth::user()->hasRole('admin');
    @endphp

    <form method="POST" action="{{ route('course-resources.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Select Course</label>
                <select name="course_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Choose Aligned Course --</option>
                    @foreach($allCourses ?? [] as $course)
                        @php
                            $courseTarget = strtolower($course->target_disabilities ?? '');
                            $isMatch = $isAdmin;
                            if (!$isAdmin) {
                                if (str_contains($courseTarget, 'visual') && in_array('visual', $educatorSpecializations)) { $isMatch = true; }
                                elseif (str_contains($courseTarget, 'hearing') && in_array('hearing', $educatorSpecializations)) { $isMatch = true; }
                                elseif (str_contains($courseTarget, 'dyslexia') && in_array('dyslexia', $educatorSpecializations)) { $isMatch = true; }
                                elseif ((str_contains($courseTarget, 'autism') || str_contains($courseTarget, 'adhd')) && (in_array('autism', $educatorSpecializations) || in_array('adhd', $educatorSpecializations))) { $isMatch = true; }
                            }
                        @endphp
                        @if($isMatch)
                            <option value="{{ $course->id }}">{{ $course->title }} ({{ $course->target_disabilities }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Material Title</label>
                <input type="text" name="title" required placeholder="e.g. Lesson 1: Introduction" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Description</label>
                <textarea name="description" placeholder="Brief explanation or overview of the material..." rows="2" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; box-sizing:border-box; resize:vertical;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Resource Format Type</label>
                <select name="resource_type" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="pdf">PDF Document Notes</option>
                    <option value="audio">Audio Lesson</option>
                    <option value="video">Caption-Supported Video</option>
                    <option value="reading">Simplified Reading</option>
                    <option value="interactive">Interactive Learning Resource</option>
                </select>
            </div>
            
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
                <div>
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Disability Support Category</label>
                    <select name="disability_category" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="Visual Impairment">Visual Impairment</option>
                        <option value="Hearing Impairment">Hearing Impairment</option>
                        <option value="Dyslexia">Dyslexia</option>
                        <option value="Autism / ADHD">Autism / ADHD</option>
                    </select>
                </div>
                <div>
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Accessibility Support Type</label>
                    <select name="accessibility_support_type" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="Audio-Based">Audio-Based</option>
                        <option value="Caption-Supported">Caption-Supported</option>
                        <option value="Dyslexia-Friendly">Dyslexia-Friendly</option>
                        <option value="Screen-Reader Friendly">Screen-Reader Friendly</option>
                        <option value="Interactive Learning">Interactive Learning</option>
                    </select>
                </div>
            </div>

            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Accessibility Quick Features</label>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:8px; background:#f8fafc; padding:12px; border-radius:8px;">
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="has_captions" value="1" style="accent-color:var(--teal);"> Captions
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="has_transcript" value="1" style="accent-color:var(--teal);"> Transcript
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="has_audio_description" value="1" style="accent-color:var(--teal);"> Audio Desc.
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="text_size_options" value="1" style="accent-color:var(--teal);"> Screen-Reader Friendly
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="high_contrast_version" value="1" style="accent-color:var(--teal);"> Dyslexia-Friendly
                    </label>
                </div>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">File Upload</label>
                <input type="file" name="file" required style="width:100%; font-size:12px;">
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Upload Resource</button>
        </div>
    </form>
</div>

<!-- Create IEP Modal -->
<div id="create-iep-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:520px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:85vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">IEP Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Create IEP Plan</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('ieps.store') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Select Student</label>
                <select name="student_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="" disabled selected>Choose a student...</option>
                    @foreach($allStudents ?? [] as $stUser)
                        @if(isset($stUser->student))
                            <option value="{{ $stUser->student->id }}">{{ $stUser->name }} ({{ $stUser->student->disabilityProfile->disability_type ?? 'N/A' }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">IEP Status</label>
                    <select name="status" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="draft" selected>Draft</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Review Date</label>
                    <input type="date" name="review_date" required min="{{ date('Y-m-d') }}" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Academic Goals</label>
                <textarea name="academic_goals" placeholder="Specify measurable academic milestones..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Behavioral & Social Goals</label>
                <textarea name="behavioral_goals" placeholder="Recommended teaching and behavioral strategies..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Accessibility & Therapy Accommodations</label>
                <textarea name="therapy_goals" placeholder="Therapeutic accommodations and environmental support..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Progress Notes & Recommendations</label>
                <textarea name="notes" placeholder="General updates, support recommendations and notes..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Save IEP Plan</button>
        </div>
    </form>
</div>

<!-- Edit IEP Modal -->
<div id="edit-iep-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:520px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:85vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">IEP Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Edit IEP Plan</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form id="edit-iep-form" method="POST" action="">
        @csrf
        @method('PUT')
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Student Name</label>
                <input type="text" id="edit-iep-student-name" disabled style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#f1f5f9; box-sizing:border-box; color:var(--gray);">
            </div>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">IEP Status</label>
                    <select name="status" id="edit-iep-status" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="draft">Draft</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Review Date</label>
                    <input type="date" name="review_date" id="edit-iep-review-date" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Academic Goals</label>
                <textarea name="academic_goals" id="edit-iep-academic-goals" placeholder="Specify measurable academic milestones..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Behavioral & Social Goals</label>
                <textarea name="behavioral_goals" id="edit-iep-behavioral-goals" placeholder="Recommended teaching and behavioral strategies..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Accessibility & Therapy Accommodations</label>
                <textarea name="therapy_goals" id="edit-iep-therapy-goals" placeholder="Therapeutic accommodations and environmental support..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Progress Notes & Recommendations</label>
                <textarea name="notes" id="edit-iep-notes" placeholder="General updates, support recommendations and notes..." rows="3" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; resize:vertical; box-sizing:border-box;"></textarea>
            </div>
        </div>
        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="button" onclick="closeModal()" style="flex:1; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Cancel</button>
            <button type="submit" class="btn-teal" style="flex:2; padding:12px; font-size:14px;">Update IEP Plan</button>
        </div>
    </form>
</div>

<!-- View Student Profile & Learning Needs Modal -->
<div id="student-details-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:500px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2); max-height:80vh; overflow-y:auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">Student Profile</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Learning Needs & Profile</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <div style="display:flex; flex-direction:column; gap:20px;">
        <!-- General Information -->
        <div style="display:flex; align-items:center; gap:16px; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
            <div style="width:54px; height:54px; border-radius:50%; background:var(--teal-ll); color:var(--teal); display:flex; align-items:center; justify-content:center; font-size:24px; font-weight:900;" id="student-modal-avatar">S</div>
            <div>
                <div style="font-family:var(--font-head); font-size:18px; font-weight:900; color:var(--navy);" id="student-modal-name">Student Name</div>
                <div style="font-size:13px; color:var(--gray);" id="student-modal-email">student@example.com</div>
            </div>
        </div>

        <!-- Disability Profile Details -->
        <div>
            <div style="font-size:12px; font-weight:700; color:var(--teal); margin-bottom:8px; text-transform:uppercase; letter-spacing:1px;">Disability Profile</div>
            <div style="background:#f8fafc; padding:12px; border-radius:8px; border:1px solid #e2e8f0;">
                <div style="font-weight:700; color:var(--navy); margin-bottom:4px;" id="student-modal-disability-type">Visual Impairment</div>
                <div style="font-size:13px; color:var(--navy); line-height:1.5;" id="student-modal-disability-desc">No details provided.</div>
            </div>
        </div>

        <!-- Accessibility Preferences -->
        <div>
            <div style="font-size:12px; font-weight:700; color:var(--teal); margin-bottom:8px; text-transform:uppercase; letter-spacing:1px;">Accessibility Preferences</div>
            <div style="display:grid; grid-template-columns: 1fr; gap:8px;" id="student-modal-preferences">
                <!-- Dynamically Populated Preferences -->
            </div>
        </div>
    </div>
    <div style="margin-top:28px;">
        <button onclick="closeModal()" style="width:100%; padding:12px; background:var(--teal-ll); border:none; border-radius:8px; font-family:var(--font-body); font-size:14px; font-weight:700; color:var(--teal); cursor:pointer;">Close Window</button>
    </div>
</div>

<script>
    function openEditIepModal(iep, studentName) {
        document.getElementById('edit-iep-student-name').value = studentName;
        document.getElementById('edit-iep-status').value = iep.status;
        
        // Format review date to YYYY-MM-DD
        if (iep.review_date) {
            // Take date part directly to prevent timezone shift issues
            const formattedDate = iep.review_date.substring(0, 10);
            document.getElementById('edit-iep-review-date').value = formattedDate;
        } else {
            document.getElementById('edit-iep-review-date').value = '';
        }
        
        document.getElementById('edit-iep-academic-goals').value = iep.academic_goals || '';
        document.getElementById('edit-iep-behavioral-goals').value = iep.behavioral_goals || '';
        document.getElementById('edit-iep-therapy-goals').value = iep.therapy_goals || '';
        document.getElementById('edit-iep-notes').value = iep.notes || '';
        
        const form = document.getElementById('edit-iep-form');
        form.action = `/ieps/${iep.id}`;
        
        showModal('edit-iep-modal');
    }

    function openStudentDetailsModal(studentUser, studentDetails) {
        document.getElementById('student-modal-name').innerText = studentUser.name;
        document.getElementById('student-modal-email').innerText = studentUser.email;
        document.getElementById('student-modal-avatar').innerText = studentUser.name.charAt(0).toUpperCase();

        if (studentDetails) {
            const dp = studentDetails.disability_profile;
            const ap = studentDetails.accessibility_profile;

            document.getElementById('student-modal-disability-type').innerText = dp ? dp.disability_type : 'Not Specified';
            document.getElementById('student-modal-disability-desc').innerText = dp ? (dp.description || 'No detailed descriptions registered.') : 'No description provided.';

            const prefsContainer = document.getElementById('student-modal-preferences');
            prefsContainer.innerHTML = '';

            if (ap) {
                const addPreference = (label, val) => {
                    const el = document.createElement('div');
                    el.style.display = 'flex';
                    el.style.justifyContent = 'space-between';
                    el.style.padding = '8px 12px';
                    el.style.background = '#f8fafc';
                    el.style.border = '1px solid #f1f5f9';
                    el.style.borderRadius = '6px';
                    el.style.fontSize = '13px';
                    el.innerHTML = `<span style="font-weight:600; color:var(--navy);">${label}</span><span style="color:var(--teal); font-weight:700;">${val}</span>`;
                    prefsContainer.appendChild(el);
                };

                addPreference('Text to Speech (TTS) Enabled', ap.text_to_speech ? 'Yes' : 'No');
                addPreference('Screen Reader Support', ap.screen_reader_support ? 'Yes' : 'No');
                addPreference('High Contrast Theme', ap.high_contrast ? 'Yes' : 'No');
                addPreference('Keyboard Navigation', ap.keyboard_navigation ? 'Yes' : 'No');
                if (ap.font_size) addPreference('Font Size Preferred', ap.font_size + 'px');
                if (ap.font_family) addPreference('Font Family Preferred', ap.font_family);
                addPreference('Focus Mode Support', ap.focus_mode ? 'Yes' : 'No');
                addPreference('Reading Guide Focus', ap.reading_guide ? 'Yes' : 'No');
            } else {
                prefsContainer.innerHTML = '<div style="font-size:13px; color:var(--gray); font-style:italic;">No customized accessibility preferences specified.</div>';
            }
        } else {
            document.getElementById('student-modal-disability-type').innerText = 'N/A';
            document.getElementById('student-modal-disability-desc').innerText = 'No disability information available.';
            document.getElementById('student-modal-preferences').innerHTML = '<div style="font-size:13px; color:var(--gray); font-style:italic;">No preferences recorded.</div>';
        }

        showModal('student-details-modal');
    }
</script>
