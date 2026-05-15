<div class="panel show" id="panel-overview">
    <div class="welcome">
        <div class="wb-left">
            @if(Auth::user()->hasRole('admin'))
                <div class="wb-eyebrow">Administrator Portal</div>
                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                <p>System operational and running smoothly.</p>
            @elseif(Auth::user()->hasRole('student'))
                <div class="wb-eyebrow">Student Dashboard</div>
                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                <p>Your learning journey continues here.</p>
            @elseif(Auth::user()->hasRole('special_educator'))
                <div class="wb-eyebrow">Educator Portal</div>
                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-top:8px;">
                    @foreach($educator->disabilitySpecializations ?? [] as $spec)
                        <span class="pill" style="background:var(--teal-ll); color:var(--teal-d); border:1px solid var(--teal); font-size:10px;">
                            <i class="ti ti-certificate"></i> {{ ucfirst(str_replace('_', ' ', $spec->disability_type)) }} Support
                        </span>
                    @endforeach
                </div>
            @elseif(Auth::user()->hasRole('therapist'))
                <div class="wb-eyebrow">Therapist Portal</div>
                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                @if(isset($therapist) && $therapist)
                    <div style="display:flex; flex-wrap:wrap; gap:8px; margin-top:8px;">
                        <span class="pill" style="background:var(--violet-ll); color:var(--violet); border:1px solid var(--violet); font-size:10px;">
                            <i class="ti ti-stethoscope"></i> {{ $therapist->specialization ?? 'General Therapy' }}
                        </span>
                        @if($therapist->certification)
                            <span class="pill" style="background:var(--teal-ll); color:var(--teal); font-size:10px;">
                                <i class="ti ti-certificate"></i> Lic: {{ $therapist->certification }}
                            </span>
                        @endif
                    </div>
                @endif
            @else
                <div class="wb-eyebrow">Dashboard</div>
                <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                <p>Access your educational tools and resources.</p>
            @endif
        </div>
        @if(Auth::user()->hasRole('student') && isset($disabilityProfile))
            <div class="wb-status">
                <div class="wb-stat-icon"><i class="ti ti-accessible"></i></div>
                <div class="wb-stat-label">Disability Profile</div>
                <div class="wb-stat-val">
                    <div class="wb-green"></div>
                    <span>{{ ucfirst(str_replace('_', ' ', $disabilityProfile->disability_type ?? 'Not specified')) }}</span>
                </div>
            </div>
        @endif
    </div>

    @if(Auth::user()->hasRole('student'))
        @php 
            $dType = trim(strtolower($disabilityProfile->disability_type ?? '')); 
            $isVisual = (strpos($dType, 'visual') !== false || strpos($dType, 'blind') !== false || strpos($dType, 'vision') !== false);
            $isHearing = (strpos($dType, 'hearing') !== false || strpos($dType, 'deaf') !== false || strpos($dType, 'audio') !== false);
            $isDyslexia = (strpos($dType, 'dyslexia') !== false || strpos($dType, 'reading') !== false || strpos($dType, 'font') !== false);
        @endphp
        <div class="eyebrow" style="margin-top:24px">Personalized Learning Resources</div>
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:16px; margin-top:12px;">
            @forelse($disabilityResources ?? [] as $res)
                <div class="card" onclick="showPanel('courses', null)" style="padding:16px; border-left:4px solid {{ $isVisual ? 'var(--amber)' : ($isHearing ? 'var(--blue)' : 'var(--teal)') }}; cursor:pointer;">
                    <div style="display:flex; gap:12px; align-items:center;">
                        <div style="width:36px; height:36px; border-radius:8px; background:{{ $isVisual ? 'var(--al)' : ($isHearing ? 'var(--bl)' : 'var(--teal-ll)') }}; display:flex; align-items:center; justify-content:center;">
                            <i class="ti ti-{{ $isVisual ? 'headphones' : ($isHearing ? 'captions' : 'typography') }}" style="color:{{ $isVisual ? 'var(--amber)' : ($isHearing ? 'var(--blue)' : 'var(--teal)') }}"></i>
                        </div>
                        <div>
                            @php /** @var \App\Models\Course $res */ @endphp
                            <div style="font-weight:700; font-size:13px; color:var(--navy)">{{ $res->title ?? 'Resource' }}</div>
                            <div style="font-size:11px; color:var(--gray)">{{ Str::limit($res->description ?? '', 40) }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card" style="padding:16px; border-left:4px solid var(--violet);">
                    <div style="display:flex; gap:12px; align-items:center;">
                        <div style="width:36px; height:36px; border-radius:8px; background:var(--violet-l); display:flex; align-items:center; justify-content:center;">
                            <i class="ti ti-star" style="color:var(--violet)"></i>
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:13px; color:var(--navy)">General Resources</div>
                            <div style="font-size:11px; color:var(--gray)">Recommended based on your profile</div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    @endif

    <!-- STATISTICS -->
    @include('dashboard._stats')

    <!-- QUICK ACTIONS -->
    @include('dashboard._quick_actions')

    @if(Auth::user()->hasRole('admin'))
        <!-- RECENT ACTIVITIES -->
        <div class="eyebrow" style="margin-top:24px">Recent Activities</div>
        <div class="card" style="margin-top:12px; max-height:300px; overflow-y:auto;">
            @forelse($recentActivities ?? [] as $activity)
                @php /** @var \App\Models\Notification $activity */ @endphp
                <div style="padding:12px 16px;border-bottom:1px solid var(--teal-ll);display:flex;justify-content:space-between;align-items:center;">
                    <div>
                        <div style="font-size:12px;font-weight:700;color:var(--navy)">{{ $activity->title ?? '—' }}</div>
                        <div style="font-size:11px;color:var(--gray);margin-top:2px">{{ $activity->message ?? '' }}</div>
                    </div>
                    <div style="font-size:10px;color:var(--teal)">
                        {{ optional($activity->created_at)->diffForHumans() ?? '' }}
                    </div>
                </div>
            @empty
                <div style="padding:20px;text-align:center;color:var(--gray);font-size:12px">No recent activities</div>
            @endforelse
        </div>
    @endif
</div>
