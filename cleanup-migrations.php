<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Mark duplicate migrations as completed
$duplicates = [
    '2026_04_30_165600_create_disability_profiles_table',
    '2026_04_30_165601_create_accessibility_profiles_table',
    '2026_04_30_165630_create_i_e_p_s_table',
    '2026_04_30_165631_create_i_e_p_goals_table',
    '2026_04_30_165632_create_accommodations_table',
    '2026_04_30_165633_create_courses_table',
    '2026_04_30_165634_create_course_resources_table',
    '2026_04_30_165635_create_course_enrollments_table',
    '2026_04_30_165650_create_therapy_sessions_table',
    '2026_04_30_165651_create_behavioral_notes_table',
    '2026_04_30_165652_create_support_staff_table',
    '2026_04_30_165653_create_assessment_responses_table',
    '2026_04_30_165654_create_adaptive_questions_table',
    '2026_04_30_165715_create_progress_reports_table',
    '2026_04_30_165716_create_accessibility_audits_table',
    '2026_04_30_165717_create_compliance_logs_table',
    '2026_04_30_165718_create_accommodation_logs_table',
    '2026_04_30_165718_create_messages_table',
    '2026_04_30_165719_create_notifications_table'
];

// Delete existing duplicate entries
DB::table('migrations')->whereIn('migration', $duplicates)->delete();

// Insert them back as completed (batch 1)
foreach ($duplicates as $migration) {
    DB::table('migrations')->insert([
        'migration' => $migration,
        'batch' => 1
    ]);
}

echo "✓ Marked " . count($duplicates) . " duplicate migrations as completed\n";

