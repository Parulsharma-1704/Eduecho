<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapy Progress Report - {{ $student->user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #7c3aed;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #7c3aed;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .header p {
            color: #666;
            font-size: 14px;
        }
        .student-info {
            background: #f8fafc;
            border-left: 4px solid #7c3aed;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }
        .student-info h2 {
            color: #1e293b;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            font-size: 13px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .info-item label {
            font-weight: bold;
            color: #475569;
        }
        .info-item value {
            color: #1e293b;
        }
        .section {
            margin-bottom: 40px;
        }
        .section-title {
            color: #1e293b;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        th {
            background: #f1f5f9;
            color: #1e293b;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #e2e8f0;
        }
        td {
            padding: 12px;
            border: 1px solid #e2e8f0;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-box {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #7c3aed;
            text-align: center;
        }
        .stat-box .number {
            font-size: 28px;
            font-weight: bold;
            color: #7c3aed;
        }
        .stat-box .label {
            color: #64748b;
            font-size: 12px;
            margin-top: 5px;
        }
        .emotion-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .emotion-happy { background: #dcfce7; color: #166534; }
        .emotion-calm { background: #dbeafe; color: #0c4a6e; }
        .emotion-anxious { background: #fef08a; color: #713f12; }
        .emotion-frustrated { background: #fed7aa; color: #7c2d12; }
        .emotion-angry { background: #fecaca; color: #7f1d1d; }
        .emotion-sad { background: #f5f3ff; color: #581c87; }
        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
            margin-top: 40px;
        }
        .page-break {
            page-break-after: always;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Therapy Progress Report</h1>
            <p>Generated on {{ now()->format('F j, Y') }}</p>
        </div>

        <!-- Student Information -->
        <div class="student-info">
            <h2>Student Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Name:</label>
                    <value>{{ $student->user->name }}</value>
                </div>
                <div class="info-item">
                    <label>Email:</label>
                    <value>{{ $student->user->email }}</value>
                </div>
                <div class="info-item">
                    <label>Report Generated:</label>
                    <value>{{ now()->format('M d, Y g:i A') }}</value>
                </div>
                <div class="info-item">
                    <label>Total Sessions:</label>
                    <value>{{ $sessions->count() }}</value>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="section">
            <div class="section-title">Summary Statistics</div>
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="number">{{ $sessions->count() }}</div>
                    <div class="label">Total Sessions</div>
                </div>
                <div class="stat-box">
                    <div class="number">{{ $sessions->where('session_date', '<=', now())->count() }}</div>
                    <div class="label">Completed Sessions</div>
                </div>
                <div class="stat-box">
                    <div class="number">{{ round($sessions->avg('progress')) }}%</div>
                    <div class="label">Average Progress</div>
                </div>
            </div>
        </div>

        <!-- Therapy Sessions -->
        <div class="section">
            <div class="section-title">Therapy Sessions Details</div>
            @if($sessions->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Therapist</th>
                            <th>Duration</th>
                            <th>Progress</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{ $session->session_date->format('M d, Y') }}</td>
                                <td>{{ $session->getTherapyTypeLabel() }}</td>
                                <td>{{ $session->therapist->name ?? 'Unassigned' }}</td>
                                <td>{{ $session->getSessionDurationFormatted() }}</td>
                                <td>{{ $session->getProgressPercentage() }}%</td>
                                <td>{{ $session->isCompleted() ? 'Completed' : 'Scheduled' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #94a3b8;">No therapy sessions recorded.</p>
            @endif
        </div>

        <!-- Behavioral Notes -->
        @if($notes->count() > 0)
            <div class="section">
                <div class="section-title">Behavioral Observations</div>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Emotion State</th>
                            <th>Observation</th>
                            <th>Support Provided</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                            <tr>
                                <td>{{ $note->observation_date->format('M d, Y') }}</td>
                                <td>
                                    <span class="emotion-badge emotion-{{ $note->emotion_state }}">
                                        {{ ucfirst($note->emotion_state) }}
                                    </span>
                                </td>
                                <td>{{ Str::limit($note->observation, 100) }}</td>
                                <td>{{ $note->support_provided ? Str::limit($note->support_provided, 50) : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>This report was automatically generated by the Education Ecosystem system.</p>
            <p>For more information, please contact your school administrator.</p>
        </div>
    </div>
</body>
</html>
