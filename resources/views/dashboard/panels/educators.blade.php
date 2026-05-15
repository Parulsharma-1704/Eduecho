<div class="panel" id="panel-educators">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <div>
            <div class="eyebrow">Management</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                All Educators</div>
        </div>
        @if(Auth::user()->hasRole('admin'))
            <button class="btn-teal" style="background:var(--violet)" onclick="showModal('add-educator-modal')"><i class="ti ti-school"></i> Add Educator</button>
        @endif
    </div>
    <div style="display:flex; gap:12px; margin-bottom:16px;">
        <div style="flex:1; position:relative;">
            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
            <input type="text" placeholder="Search educators by name or email..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
        </div>
    </div>
    <div class="card">
        @forelse($allEducators ?? [] as $educator)
            <div class="stu" style="padding:15px 10px">
                <div class="stu-av"
                    style="background:var(--violet-l);color:var(--violet-d);width:40px;height:40px;font-size:14px">
                    {{ substr($educator->name, 0, 1) }}</div>
                <div style="flex:1; display:flex; justify-content:space-between; align-items:center;">
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-right:16px;">
                            <div class="stu-name">{{ $educator->name }}</div>
                            <div style="display:flex;gap:4px">
                                @foreach($educator->specialEducator?->disabilitySpecializations ?? [] as $spec)
                                    <span class="pill"
                                        style="background:var(--violet-l);color:var(--violet-d);font-size:8px">
                                        {{ $spec->disability_type }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="stu-meta">{{ $educator->email }}</div>
                        <div style="margin-top:6px;display:flex;gap:12px;font-size:10px;color:var(--gray)">
                            <span><i class="ti ti-history"></i>
                                {{ $educator->specialEducator?->experience_years ?? 0 }} Years Exp.</span>
                            <span><i class="ti ti-certificate"></i>
                                {{ $educator->specialEducator?->qualification ?? 'Certified' }}</span>
                        </div>
                    </div>
                    <div style="display:flex; gap:8px;">
                        @if(Auth::user()->hasRole('admin'))
                            <form method="POST" action="{{ route('admin.users.toggle-status', $educator->id) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $educator->is_active ? 'var(--violet-l)' : 'var(--gray)' }}; color:{{ $educator->is_active ? 'var(--violet)' : '#fff' }}">
                                    {{ $educator->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.destroy', $educator->id) }}" onsubmit="return confirm('Delete this educator?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="pill" style="border:none; cursor:pointer; background:var(--rose); color:#fff">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align:center;color:var(--gray);padding:20px">No educators found</p>
        @endforelse
    </div>
</div>
