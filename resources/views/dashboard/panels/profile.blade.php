<div class="panel" id="panel-profile">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--teal)">Account Settings</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">My Personal Profile</div>
        </div>
    </div>
    
    <div class="card" style="max-width:800px; padding:32px;">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px; margin-bottom:24px;">
                <div>
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
                <div>
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Email Address</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                </div>
                <div>
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Current Role</label>
                    <input type="text" value="{{ ucfirst(str_replace('_', ' ', Auth::user()->getRoleNames()->first() ?? 'User')) }}" disabled style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; background:#f8fafc; color:var(--gray); box-sizing:border-box;">
                </div>
                <div>
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Member Since</label>
                    <input type="text" value="{{ Auth::user()->created_at->format('F d, Y') }}" disabled style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; background:#f8fafc; color:var(--gray); box-sizing:border-box;">
                </div>
            </div>

            @if(Auth::user()->hasRole('special_educator'))
                <div style="margin-bottom:24px;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">My Specializations</label>
                    <div style="display:flex; flex-wrap:wrap; gap:10px; background:#f8fafc; padding:16px; border-radius:12px; border:1px dashed var(--teal-m);">
                        @foreach(['Visual Impairment', 'Hearing Impairment', 'Dyslexia', 'Autism', 'ADHD'] as $spec)
                            @php
                                $hasSpec = $educator->disabilitySpecializations->contains('disability_type', strtolower(str_replace(' ', '_', $spec)));
                            @endphp
                            <label style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--navy); cursor:pointer;">
                                <input type="checkbox" name="specializations[]" value="{{ strtolower(str_replace(' ', '_', $spec)) }}" {{ $hasSpec ? 'checked' : '' }} style="accent-color:var(--teal);">
                                {{ $spec }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @elseif(Auth::user()->hasRole('therapist'))
                <div style="margin-bottom:24px;">
                    <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:10px;">Therapy Specialization & Credentials</label>
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; background:#f8fafc; padding:16px; border-radius:12px; border:1px dashed var(--violet);">
                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Specialization Area</label>
                            <input type="text" name="specialization" value="{{ $therapist->specialization ?? '' }}" placeholder="e.g. Autism / ADHD Support" style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; box-sizing:border-box;">
                        </div>
                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">License / Certification No.</label>
                            <input type="text" name="certification" value="{{ $therapist->certification ?? '' }}" placeholder="License number" style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; box-sizing:border-box;">
                        </div>
                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Years of Experience</label>
                            <input type="number" name="experience_years" value="{{ $therapist->experience_years ?? '' }}" placeholder="e.g. 5" min="0" style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; box-sizing:border-box;">
                        </div>
                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Availability</label>
                            <select name="availability" style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                                <option value="available">Available</option>
                                <option value="limited">Limited Availability</option>
                                <option value="unavailable">Currently Unavailable</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div style="border-top:1px solid #f1f5f9; padding-top:24px; display:flex; justify-content:flex-end;">
                <button type="submit" class="btn-teal" style="padding:12px 32px;">Save Changes</button>
            </div>
        </form>
    </div>
</div>
