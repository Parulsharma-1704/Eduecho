<div class="panel" id="panel-reports">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
        <div>
            <div class="eyebrow" style="color:var(--violet)">Reports</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy)">Reports & Analytics</div>
        </div>
        <div style="display:flex; gap:10px;">
            <button class="btn-teal" style="background:var(--violet); color:#fff; border:none; box-shadow:0 4px 12px rgba(109,40,217,0.2)" onclick="window.print()">
                <i class="ti ti-printer"></i> Print Report
            </button>
        </div>
    </div>

    <!-- Analytics Dashboard Layout -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px; margin-bottom:24px;">
        
        <!-- Graph 1: Student Registrations -->
        <div class="card" style="padding:24px; display:flex; flex-direction:column; justify-content:space-between;">
            <div>
                <h3 style="font-family:var(--font-head); font-size:15px; font-weight:800; color:var(--navy); margin-bottom:4px; display:flex; align-items:center; gap:8px;">
                    <i class="ti ti-chart-bar" style="color:var(--violet); font-size:20px;"></i>
                    Student Registration Trends
                </h3>
                <p style="font-size:12px; color:var(--gray); margin-bottom:24px;">Monthly student registrations over the last 6 months</p>
            </div>
            
            <!-- Custom CSS Bar Graph -->
            <div style="display:flex; align-items:flex-end; justify-content:space-between; height:180px; padding:10px 0; border-bottom:2px solid var(--gray-b); margin-bottom:12px; position:relative;">
                @php
                    $maxReg = !empty($analytics['studentRegistrations']) ? max($analytics['studentRegistrations']) : 1;
                @endphp
                @forelse($analytics['studentRegistrations'] ?? [] as $month => $count)
                    @php
                        $heightPercent = $maxReg > 0 ? ($count / $maxReg) * 100 : 0;
                    @endphp
                    <div style="display:flex; flex-direction:column; align-items:center; flex:1;">
                        <span style="font-size:10px; font-weight:700; color:var(--violet); margin-bottom:4px;">{{ $count }}</span>
                        <div style="width:24px; height:{{ max($heightPercent, 10) }}%; background:linear-gradient(to top, var(--violet), var(--violet-m)); border-radius:6px 6px 0 0; transition:height 0.5s ease-out; cursor:pointer; position:relative;" title="{{ $count }} registrations"></div>
                        <span style="font-size:10px; font-weight:600; color:var(--gray); margin-top:8px; white-space:nowrap;">{{ \Carbon\Carbon::parse($month)->format('M y') }}</span>
                    </div>
                @empty
                    <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; color:var(--gray); font-size:12px;">
                        No registration data available
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Graph 2: Disability Category Distribution -->
        <div class="card" style="padding:24px;">
            <h3 style="font-family:var(--font-head); font-size:15px; font-weight:800; color:var(--navy); margin-bottom:4px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-activity-heartbeat" style="color:var(--rose); font-size:20px;"></i>
                Disability Category Distribution
            </h3>
            <p style="font-size:12px; color:var(--gray); margin-bottom:20px;">Course composition by disability target segments</p>

            <div style="display:flex; flex-direction:column; gap:14px; margin-top:10px;">
                @php
                    $colors = [
                        'Visual Impairment' => 'var(--rose)',
                        'Hearing Loss'      => 'var(--blue)',
                        'Autism'            => 'var(--teal)',
                        'ADHD'              => 'var(--amber)',
                        'Dyslexia'          => 'var(--violet)'
                    ];
                    $bgColors = [
                        'Visual Impairment' => 'var(--rl)',
                        'Hearing Loss'      => 'var(--bl)',
                        'Autism'            => 'var(--teal-l)',
                        'ADHD'              => 'var(--al)',
                        'Dyslexia'          => 'var(--violet-l)'
                    ];
                    $totalDistribution = array_sum($analytics['disabilityDistribution'] ?? []);
                    $totalDistribution = $totalDistribution > 0 ? $totalDistribution : 1;
                @endphp

                @foreach($analytics['disabilityDistribution'] ?? [] as $category => $count)
                    @php
                        $percentage = round(($count / $totalDistribution) * 100);
                        $col = $colors[$category] ?? 'var(--gray)';
                        $bgCol = $bgColors[$category] ?? 'var(--gray-l)';
                    @endphp
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px; font-size:12px; font-weight:700;">
                            <span style="color:var(--navy); display:flex; align-items:center; gap:6px;">
                                <span style="width:8px; height:8px; border-radius:50%; background:{{ $col }}"></span>
                                {{ $category }}
                            </span>
                            <span style="color:{{ $col }}">{{ $count }} Course(s) ({{ $percentage }}%)</span>
                        </div>
                        <div style="width:100%; height:8px; background:var(--gray-l); border-radius:99px; overflow:hidden;">
                            <div style="width:{{ $percentage }}%; height:100%; background:{{ $col }}; border-radius:99px;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Section 2: Top Courses & Enrollment Analytics -->
    <div style="display:grid; grid-template-columns:1fr; gap:24px;">
        <div class="card" style="padding:24px;">
            <h3 style="font-family:var(--font-head); font-size:15px; font-weight:800; color:var(--navy); margin-bottom:4px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-award" style="color:var(--teal); font-size:20px;"></i>
                Top Performing Accessibility Courses
            </h3>
            <p style="font-size:12px; color:var(--gray); margin-bottom:20px;">Most popular courses based on active student enrollments</p>

            <table style="width:100%; border-collapse:collapse; text-align:left; font-size:13px;">
                <thead>
                    <tr style="border-bottom:2px solid var(--teal-ll); color:var(--gray); font-weight:700;">
                        <th style="padding:10px 0;">Rank & Course Title</th>
                        <th style="padding:10px 0; text-align:center;">Active Enrollments</th>
                        <th style="padding:10px 0; text-align:right;">Popularity Index</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $rank = 1; 
                        $maxEnroll = !empty($analytics['courseCompletions']) ? max($analytics['courseCompletions']) : 1;
                        $maxEnroll = $maxEnroll > 0 ? $maxEnroll : 1;
                    @endphp
                    @forelse($analytics['courseCompletions'] ?? [] as $title => $enrollCount)
                        @php
                            $popPercentage = round(($enrollCount / $maxEnroll) * 100);
                        @endphp
                        <tr style="border-bottom:1px solid var(--teal-ll);">
                            <td style="padding:14px 0; font-weight:700; color:var(--navy);">
                                <span style="display:inline-flex; align-items:center; justify-content:center; width:22px; height:22px; border-radius:50%; background:{{ $rank === 1 ? 'var(--al)' : 'var(--teal-ll)' }}; color:{{ $rank === 1 ? 'var(--amber)' : 'var(--teal)' }}; font-size:11px; margin-right:10px; font-weight:800;">
                                    {{ $rank++ }}
                                </span>
                                {{ $title }}
                            </td>
                            <td style="padding:14px 0; text-align:center; font-weight:700; color:var(--teal);">
                                {{ $enrollCount }} student(s)
                            </td>
                            <td style="padding:14px 0; text-align:right;">
                                <div style="display:inline-flex; align-items:center; gap:8px;">
                                    <div style="width:100px; height:6px; background:#f1f5f9; border-radius:99px; overflow:hidden;">
                                        <div style="width:{{ $popPercentage }}%; height:100%; background:var(--teal); border-radius:99px;"></div>
                                    </div>
                                    <span style="font-weight:700; color:var(--gray); font-size:11px;">{{ $popPercentage }}%</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center; padding:30px; color:var(--gray);">
                                No course enrollment records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
