<div class="panel" id="panel-therapy-notes">
    @if(Auth::user()->hasRole('therapist'))
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--violet)">Documentation</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Therapy Notes & Recommendations</div>
        </div>
        <button class="btn-teal" style="background:var(--violet); color:white;" onclick="showModal('add-note-modal')">
            <i class="ti ti-plus"></i> New Note
        </button>
    </div>

    <div style="display:flex; gap:12px; margin-bottom:16px;">
        <div style="flex:1; position:relative;">
            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
            <input type="text" placeholder="Search by student or content..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
        </div>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:var(--violet-ll); color:var(--violet-d);">
                    <th style="padding:16px; text-align:left; font-size:12px;">Date</th>
                    <th style="padding:16px; text-align:left; font-size:12px;">Student</th>
                    <th style="padding:16px; text-align:left; font-size:12px;">Note/Recommendation</th>
                    <th style="padding:16px; text-align:right; font-size:12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($allSessions ?? collect())->whereNotNull('notes') as $session)
                    <tr style="border-bottom:1px solid var(--violet-ll);">
                        <td style="padding:16px; font-size:13px; color:var(--gray); white-space:nowrap;">
                            {{ $session->session_date->format('M d, Y') }}
                        </td>
                        <td style="padding:16px;">
                            <div style="font-weight:700; color:var(--navy);">{{ $session->student->user->name }}</div>
                            <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9px;">
                                {{ $session->student->disabilityProfile->disability_type ?? 'N/A' }}
                            </span>
                        </td>
                        <td style="padding:16px;">
                            <div style="font-size:13px; color:var(--navy); line-height:1.5;">
                                {{ Str::limit($session->notes, 100) }}
                            </div>
                            @if($session->progress)
                                <div style="margin-top:4px; font-size:11px; color:var(--teal); font-weight:600;">
                                    <i class="ti ti-bulb"></i> Recommended: {{ $session->progress }}
                                </div>
                            @endif
                        </td>
                        <td style="padding:16px; text-align:right;">
                            <button class="tb-icon-btn" style="color:var(--violet);"><i class="ti ti-eye"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:40px; text-align:center; color:var(--gray);">
                            <i class="ti ti-note-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                            <p>No therapy notes recorded yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @else
        <div style="text-align:center; padding:60px; color:var(--gray);">
            <i class="ti ti-lock" style="font-size:48px; display:block; margin-bottom:12px;"></i>
            <p>This section is only available to therapists.</p>
        </div>
    @endif
</div>
