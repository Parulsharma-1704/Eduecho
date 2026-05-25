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
                            
                            <!-- Alignment Check for Special Educators -->
                            @php
                                $user = Auth::user();
                                $isAlignedSpecialization = false;
                                if ($user->hasRole('special_educator') && $user->specialEducator && $material->course) {
                                    $isAlignedSpecialization = $user->specialEducator->disabilitySpecializations->contains('disability_type', $material->course->target_disabilities);
                                }
                            @endphp
                            @if($isAlignedSpecialization)
                                <div style="margin-top:6px;">
                                    <span class="pill" style="font-size:9px; padding:2px 6px; background:var(--teal-ll); color:var(--teal); font-weight:700; border:none;" title="Aligned with your Specializations">
                                        <i class="ti ti-discount-check"></i> Specialization Match
                                    </span>
                                </div>
                            @endif
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
                                    elseif(str_contains(strtolower($material->resource_type), 'pdf')) $icon = 'file-text';
                                    elseif(str_contains(strtolower($material->resource_type), 'interactive')) $icon = 'devices';
                                @endphp
                                <i class="ti ti-{{ $icon }}"></i>
                                {{ ucfirst($material->resource_type) }}
                            </div>
                        </td>
                        <td style="padding:16px;">
                            <div style="display:flex; flex-direction:column; gap:4px;">
                                @if($material->disability_category)
                                    <div>
                                        <span class="pill" style="background:var(--violet-ll); color:var(--violet); font-size:9px; font-weight:800; border:none; text-transform:uppercase;">
                                            {{ $material->disability_category }}
                                        </span>
                                    </div>
                                @endif
                                @if($material->accessibility_support_type)
                                    <div>
                                        <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:9px; font-weight:800; border:none; text-transform:uppercase;">
                                            {{ $material->accessibility_support_type }}
                                        </span>
                                    </div>
                                @endif
                                <div style="display:flex; gap:6px; align-items:center; margin-top:2px;">
                                    @if($material->has_captions)
                                        <span title="Captions Supported" style="color:var(--teal); font-size:14px;"><i class="ti ti-closed-captioning"></i></span>
                                    @endif
                                    @if($material->has_transcript)
                                        <span title="Transcript Available" style="color:var(--blue); font-size:14px;"><i class="ti ti-file-text"></i></span>
                                    @endif
                                    @if($material->has_audio_description)
                                        <span title="Audio Description" style="color:var(--amber); font-size:14px;"><i class="ti ti-volume"></i></span>
                                    @endif
                                    @if($material->text_size_options)
                                        <span title="Screen-Reader Friendly" style="color:var(--violet); font-size:14px;"><i class="ti ti-eye"></i></span>
                                    @endif
                                    @if($material->high_contrast_version)
                                        <span title="Dyslexia-Friendly" style="color:var(--blue); font-size:14px;"><i class="ti ti-abc"></i></span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="padding:16px; text-align:right;">
                            <div style="display:flex; gap:8px; justify-content:flex-end; align-items:center;">
                                <a href="{{ route('course-resources.download', $material->id) }}" target="_blank" class="tb-icon-btn" style="width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color:var(--teal); text-decoration:none;" title="Download Material">
                                    <i class="ti ti-download"></i>
                                </a>
                                <form method="POST" action="{{ route('course-resources.destroy', $material->id) }}" onsubmit="return confirm('Are you sure you want to delete this resource?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="tb-icon-btn" style="width:32px; height:32px; color:var(--rose); border:none; cursor:pointer; background:none;" title="Delete Material">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
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
