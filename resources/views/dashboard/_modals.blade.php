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
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Assigned Educator</label>
                <select name="created_by_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="">-- Select an Educator --</option>
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
                    @foreach($allStudents ?? [] as $stu)
                        <option value="{{ $stu->student?->id }}">{{ $stu->name }}</option>
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
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Date</label>
                    <input type="date" name="session_date" required min="{{ date('Y-m-d') }}" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
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
<div id="upload-material-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; border-radius:16px; padding:32px; width:460px; max-width:95vw; z-index:9001; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--teal); margin-bottom:4px;">Resource Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy);">Upload Learning Material</div>
        </div>
        <button onclick="closeModal()" style="background:var(--teal-ll); border:none; border-radius:50%; width:36px; height:36px; cursor:pointer; font-size:18px; color:var(--teal); display:flex; align-items:center; justify-content:center;"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ route('course-resources.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Select Course</label>
                <select name="course_id" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    @foreach($allCourses ?? [] as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Material Title</label>
                <input type="text" name="title" required placeholder="e.g. Lesson 1: Introduction" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Resource Type</label>
                <select name="resource_type" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; background:#fff; box-sizing:border-box;">
                    <option value="video">Video Lesson</option>
                    <option value="audio">Audio Resource</option>
                    <option value="pdf">PDF Document</option>
                    <option value="reading">Simplified Reading</option>
                </select>
            </div>
            <div>
                <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Accessibility Features</label>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; background:#f8fafc; padding:12px; border-radius:8px;">
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="has_captions" value="1" style="accent-color:var(--teal);"> Captions
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="has_transcript" value="1" style="accent-color:var(--teal);"> Transcript
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--navy); cursor:pointer;">
                        <input type="checkbox" name="has_audio_description" value="1" style="accent-color:var(--teal);"> Audio Desc.
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
