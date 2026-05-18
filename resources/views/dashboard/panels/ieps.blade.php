<div class="panel" id="panel-ieps">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--teal)">Personalized Learning</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">IEP Management</div>
        </div>
        <button class="btn-teal" onclick="showModal('create-iep-modal')">
            <i class="ti ti-plus"></i> Create IEP
        </button>
    </div>

    <!-- Responsive Search Filter -->
    <div style="display:flex; gap:12px; margin-bottom:16px;">
        <div style="flex:1; position:relative;">
            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
            <input type="text" id="iep-search-input" onkeyup="filterIEPs()" placeholder="Search IEPs by student name or goals..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
        </div>
    </div>

    <!-- IEPs Card Table -->
    <div class="card" style="padding:0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:var(--teal-ll);">
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Student Info</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">IEP Goals & Accommodations</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Notes & Progress</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Review Date</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Status</th>
                    <th style="padding:16px; text-align:right; font-size:12px; color:var(--teal-d);">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allIeps ?? [] as $iep)
                    <tr class="iep-row" data-student="{{ $iep->student->user->name ?? 'N/A' }}" data-goals="{{ ($iep->academic_goals ?? '') . ' ' . ($iep->behavioral_goals ?? '') . ' ' . ($iep->therapy_goals ?? '') }}" style="border-bottom:1px solid var(--teal-ll);">
                        <!-- Student Info -->
                        <td style="padding:16px; vertical-align:top;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:36px; height:36px; border-radius:50%; background:var(--teal-ll); color:var(--teal); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px;">
                                    {{ substr($iep->student->user->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color:var(--navy);">{{ $iep->student->user->name ?? 'N/A' }}</div>
                                    <div style="font-size:11px; color:var(--gray);">{{ $iep->student->disabilityProfile->disability_type ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Goals Details -->
                        <td style="padding:16px; vertical-align:top; max-width:280px;">
                            <div style="display:flex; flex-direction:column; gap:8px;">
                                @if($iep->academic_goals)
                                    <div>
                                        <div style="font-size:10px; font-weight:700; color:var(--teal); text-transform:uppercase;">Academic Goals</div>
                                        <div style="font-size:12px; color:var(--navy); line-height:1.4;">{{ Str::limit($iep->academic_goals, 100) }}</div>
                                    </div>
                                @endif
                                @if($iep->behavioral_goals)
                                    <div>
                                        <div style="font-size:10px; font-weight:700; color:var(--blue); text-transform:uppercase;">Behavioral Strategies</div>
                                        <div style="font-size:12px; color:var(--navy); line-height:1.4;">{{ Str::limit($iep->behavioral_goals, 100) }}</div>
                                    </div>
                                @endif
                                @if($iep->therapy_goals)
                                    <div>
                                        <div style="font-size:10px; font-weight:700; color:var(--amber); text-transform:uppercase;">Therapy Accommodations</div>
                                        <div style="font-size:12px; color:var(--navy); line-height:1.4;">{{ Str::limit($iep->therapy_goals, 100) }}</div>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <!-- Notes & Progress Recommendations -->
                        <td style="padding:16px; vertical-align:top; max-width:200px;">
                            <div style="font-size:12px; color:var(--navy); line-height:1.4;">
                                {{ Str::limit($iep->notes ?? 'No additional support recommendations or notes.', 120) }}
                            </div>
                        </td>

                        <!-- Review Date -->
                        <td style="padding:16px; vertical-align:top;">
                            <div style="font-size:13px; font-weight:600; color:var(--navy);">
                                {{ $iep->review_date ? $iep->review_date->format('M d, Y') : 'N/A' }}
                            </div>
                            @if($iep->review_date && $iep->review_date->isPast())
                                <div style="font-size:10px; color:var(--rose); font-weight:700; margin-top:4px;"><i class="ti ti-alert-triangle"></i> Needs Review</div>
                            @endif
                        </td>

                        <!-- Status Badge -->
                        <td style="padding:16px; vertical-align:top;">
                            @if(strtolower($iep->status) === 'active')
                                <span class="pill" style="background:var(--teal-ll); color:var(--teal);">Active</span>
                            @elseif(strtolower($iep->status) === 'completed')
                                <span class="pill" style="background:var(--bl); color:var(--blue);">Completed</span>
                            @else
                                <span class="pill" style="background:#f1f5f9; color:#475569;">Draft</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td style="padding:16px; vertical-align:top; text-align:right;">
                            <div style="display:flex; gap:8px; justify-content:flex-end; align-items:center;">
                                <!-- Edit Button -->
                                <button class="tb-icon-btn" onclick="openEditIepModal({{ json_encode($iep) }}, '{{ addslashes($iep->student->user->name ?? 'N/A') }}')" style="width:32px; height:32px;" title="Edit IEP"><i class="ti ti-edit"></i></button>
                                
                                <!-- Delete Action -->
                                <form method="POST" action="{{ route('ieps.destroy', $iep->id) }}" onsubmit="return confirm('Are you sure you want to delete this IEP?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tb-icon-btn" style="width:32px; height:32px; color:var(--rose);" title="Delete IEP"><i class="ti ti-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:40px; text-align:center; color:var(--gray);">
                            <i class="ti ti-clipboard-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                            <p>No IEPs created yet. Start by defining one for an enrolled student.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterIEPs() {
        const query = document.getElementById('iep-search-input').value.toLowerCase();
        const rows = document.querySelectorAll('.iep-row');
        rows.forEach(row => {
            const student = row.getAttribute('data-student').toLowerCase();
            const goals = row.getAttribute('data-goals').toLowerCase();
            if (student.includes(query) || goals.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
