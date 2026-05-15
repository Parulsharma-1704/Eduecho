<div class="panel" id="panel-therapy">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <div>
            <div class="eyebrow" style="color:var(--rd)">Wellness</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">
                Therapy Specialists</div>
        </div>
        @if(Auth::user()->hasRole('admin'))
            <button class="btn-teal" style="background:var(--rose)" onclick="showModal('add-therapist-modal')"><i class="ti ti-heart-handshake"></i> Add Therapist</button>
        @endif
    </div>
    <div style="display:flex; gap:12px; margin-bottom:16px;">
        <div style="flex:1; position:relative;">
            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
            <input type="text" placeholder="Search therapists by name or email..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
        </div>
    </div>
    <div class="card">
        @forelse($allTherapists ?? [] as $therapist)
            <div class="stu" style="padding:15px 10px">
                <div class="stu-av"
                    style="background:var(--rl);color:var(--rd);width:40px;height:40px;font-size:14px">
                    {{ substr($therapist->name, 0, 1) }}</div>
                <div style="flex:1; display:flex; justify-content:space-between; align-items:center;">
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-right:16px;">
                            <div class="stu-name">{{ $therapist->name }}</div>
                            <span class="pill" style="background:var(--rl);color:var(--rd);font-size:9px">
                                {{ $therapist->therapist?->specialization ?? 'General Therapy' }}
                            </span>
                        </div>
                        <div class="stu-meta">{{ $therapist->email }}</div>
                        <div style="margin-top:6px;display:flex;gap:12px;font-size:10px;color:var(--gray)">
                            <span><i class="ti ti-certificate"></i>
                                {{ $therapist->therapist?->certification ?? 'Licensed' }}</span>
                            <span><i class="ti ti-history"></i>
                                {{ $therapist->therapist?->experience_years ?? 0 }} Years Exp.</span>
                        </div>
                    </div>
                    <div style="display:flex; gap:8px;">
                        @if(Auth::user()->hasRole('admin'))
                            <form method="POST" action="{{ route('admin.users.toggle-status', $therapist->id) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="pill" style="border:none; cursor:pointer; background:{{ $therapist->is_active ? 'var(--rl)' : 'var(--gray)' }}; color:{{ $therapist->is_active ? 'var(--rd)' : '#fff' }}">
                                    {{ $therapist->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.destroy', $therapist->id) }}" onsubmit="return confirm('Delete this therapist?');">
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
            <p style="text-align:center;color:var(--gray);padding:20px">No therapists found</p>
        @endforelse
    </div>
</div>
