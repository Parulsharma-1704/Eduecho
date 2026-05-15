<div class="panel" id="panel-learning-materials">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--teal)">Resource Center</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">My Learning Materials</div>
        </div>
        <button class="btn-teal" onclick="showModal('upload-material-modal')">
            <i class="ti ti-file-upload"></i> Upload Material
        </button>
    </div>

    <div style="display:flex; gap:12px; margin-bottom:16px;">
        <div style="flex:1; position:relative;">
            <i class="ti ti-search" style="position:absolute; margin:12px; color:var(--gray)"></i>
            <input type="text" placeholder="Search materials by title or course..." style="width:100%; padding:10px 10px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
        </div>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:var(--teal-ll);">
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Material Title</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Course</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Type</th>
                    <th style="padding:16px; text-align:left; font-size:12px; color:var(--teal-d);">Accessibility</th>
                    <th style="padding:16px; text-align:right; font-size:12px; color:var(--teal-d);">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allMaterials ?? [] as $material)
                    <tr style="border-bottom:1px solid var(--teal-ll);">
                        <td style="padding:16px;">
                            <div style="font-weight:700; color:var(--navy);">{{ $material->title }}</div>
                            <div style="font-size:11px; color:var(--gray);">{{ Str::limit($material->description, 50) }}</div>
                        </td>
                        <td style="padding:16px;">
                            <span class="pill" style="background:var(--bl); color:var(--blue);">{{ $material->course->title ?? 'N/A' }}</span>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:var(--navy);">
                                @php
                                    $icon = 'file';
                                    if(str_contains(strtolower($material->resource_type), 'video')) $icon = 'video';
                                    elseif(str_contains(strtolower($material->resource_type), 'audio')) $icon = 'volume';
                                    elseif(str_contains(strtolower($material->resource_type), 'pdf')) $icon = 'pdf';
                                @endphp
                                <i class="ti ti-{{ $icon }}"></i>
                                {{ ucfirst($material->resource_type) }}
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex; gap:6px;">
                                @if($material->has_captions)
                                    <span title="Captions Supported" style="color:var(--teal); font-size:16px;"><i class="ti ti-closed-captioning"></i></span>
                                @endif
                                @if($material->has_transcript)
                                    <span title="Transcript Available" style="color:var(--blue); font-size:16px;"><i class="ti ti-file-text"></i></span>
                                @endif
                                @if($material->has_audio_description)
                                    <span title="Audio Description" style="color:var(--amber); font-size:16px;"><i class="ti ti-volume"></i></span>
                                @endif
                                @if(!$material->has_captions && !$material->has_transcript && !$material->has_audio_description)
                                    <span style="font-size:11px; color:var(--gray);">Standard</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding:16px; text-align:right;">
                            <div style="display:flex; gap:8px; justify-content:flex-end;">
                                <button class="tb-icon-btn" style="width:32px; height:32px;"><i class="ti ti-edit"></i></button>
                                <button class="tb-icon-btn" style="width:32px; height:32px; color:var(--rose);"><i class="ti ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:40px; text-align:center; color:var(--gray);">
                            <i class="ti ti-files-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                            <p>No learning materials uploaded yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
