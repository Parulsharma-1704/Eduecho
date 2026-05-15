<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approval | EduEcho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <style>
        :root {
            --teal: #0D9488;
            --teal-l: #CCFBF1;
            --navy: #1E1B4B;
            --gray: #6B7280;
            --page: #F0FDFA;
            --white: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--page);
            color: var(--navy);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            padding: 40px;
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(13, 148, 136, 0.1), 0 8px 10px -6px rgba(13, 148, 136, 0.1);
            text-align: center;
            border: 1.5px solid var(--teal-l);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: var(--teal-l);
            color: var(--teal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .icon-circle i {
            font-size: 40px;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        p {
            color: var(--gray);
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FEF3C7;
            color: #92400E;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #D97706;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--navy);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 27, 75, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            $educatorRequest = \App\Models\EducatorRequest::where('user_id', Auth::id())->first();
            $isRejected = $educatorRequest && $educatorRequest->status === 'rejected';
        @endphp

        <div class="icon-circle" style="{{ $isRejected ? 'background:#FCE7F3; color:#BE185D;' : '' }}">
            <i class="ti ti-{{ $isRejected ? 'x' : 'clock-hour-4' }}"></i>
        </div>
        
        @if($isRejected)
            <div class="status-badge" style="background:#FCE7F3; color:#BE185D;">
                <div class="dot" style="background:#BE185D;"></div>
                Application Rejected
            </div>
            <h1>Application Update</h1>
            <p>
                Hello {{ Auth::user()->name }},<br><br>
                Thank you for your interest in joining EduEcho. After reviewing your application, we regret to inform you that we cannot approve your request at this time.
            </p>
            @if($educatorRequest->review_notes)
                <div style="background: var(--page); padding: 16px; border-radius: 12px; margin-bottom: 24px; text-align: left; font-size: 13px;">
                    <strong style="display:block; margin-bottom:4px;">Reviewer Notes:</strong>
                    {{ $educatorRequest->review_notes }}
                </div>
            @endif
        @else
            @php
                $registrationData = $educatorRequest ? json_decode($educatorRequest->review_notes, true) : null;
                $requestedRole = (isset($registrationData['role']) && $registrationData['role'] === 'therapist') ? 'therapist' : 'educator';
            @endphp
            <div class="status-badge">
                <div class="dot"></div>
                Pending Approval
            </div>
            <h1>Verification in Progress</h1>
            <p>
                Hello {{ Auth::user()->name }},<br><br>
                Your <strong>{{ $requestedRole }} application</strong> has been submitted and is currently under review by our administrators. 
                Verification typically takes <strong>24 to 48 hours</strong>.
            </p>
        @endif

        <p style="font-size: 14px;">
            We will send an email to <strong>{{ Auth::user()->email }}</strong> as soon as there is an update.
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout" style="border:none; cursor:pointer; width: 100%; justify-content: center;">
                <i class="ti ti-logout"></i> Sign Out
            </button>
        </form>
    </div>
</body>
</html>
