# Eduecho - Laravel Application Architecture Overview

**Generated:** May 9, 2026  
**Framework:** Laravel 12  
**Database:** SQLite (configurable to MySQL)  
**Key Packages:** Spatie Permission, Activity Log, Laravel Sanctum

---

## 📋 Table of Contents

1. [Directory Structure](#directory-structure)
2. [Database Models & Relationships](#database-models--relationships)
3. [HTTP Controllers](#http-controllers)
4. [Enumerations (Enums)](#enumerations-enums)
5. [Database Migrations & Tables](#database-migrations--tables)
6. [API Routes](#api-routes)
7. [Web Routes](#web-routes)
8. [Middleware](#middleware)
9. [Authorization Policies](#authorization-policies)
10. [Configuration Files](#configuration-files)

---

## 1. Directory Structure

### `/app/` Directory Overview

```
app/
├── Enums/                    # Type-safe enumerations for the application
├── Http/
│   ├── Controllers/          # Web & API request handlers
│   │   ├── Api/             # RESTful API controllers
│   │   ├── Auth/            # Authentication controllers
│   │   └── Student/         # Student-specific controllers
│   ├── Middleware/          # HTTP middleware (role/permission checks)
│   ├── Requests/            # Form request validation classes
│   └── Resources/           # API resource transformers
├── Mail/                     # Mailable email classes
├── Models/                   # Eloquent ORM models (30+ models)
├── Policies/                 # Authorization policies
├── Providers/               # Service providers
└── View/                    # View composers
```

---

## 2. Database Models & Relationships

### Core User Models

#### **User** ([app/Models/User.php](app/Models/User.php))
- **Purpose:** Base authentication model with role-based access control
- **Key Fields:** name, email, password, phone, address
- **Relationships:**
  - `hasOne` → Student, SpecialEducator, Therapist, CareGiver, SupportStaff
  - `hasMany` → Course (created_by), IEP (created_by), TherapySession (as therapist), BehavioralNote, Message (sent)
  - **Uses:** Spatie Permissions HasRoles trait for RBAC

#### **Student** ([app/Models/Student.php](app/Models/Student.php))
- **Purpose:** Represents enrolled learners with special education needs
- **Key Fields:** user_id, enrollment_date, is_active, assigned_educator_id
- **Relationships:**
  - `belongsTo` → User
  - `hasOne` → DisabilityProfile, AccessibilityProfile
  - `hasMany` → IEP, CourseEnrollment, TherapySession, BehavioralNote, AssessmentResponse, ProgressReport, AccommodationLog, StudentContentPreference
  - `hasMany` → through → Course (via CourseEnrollment)
  - `belongsToMany` → CareGiver (caregiver_student table)
- **Key Methods:** 
  - Loads complete disability and accessibility profiles
  - Tracks enrollment history and status

#### **SpecialEducator** ([app/Models/SpecialEducator.php](app/Models/SpecialEducator.php))
- **Purpose:** Teachers specialized in special education
- **Key Fields:** user_id, specialization, qualification, experience_years
- **Relationships:**
  - `belongsTo` → User
  - `hasMany` → through → Course (created via User)
  - `hasMany` → through → IEP (created via User)
  - `hasMany` → EducatorDisabilitySpecialization

#### **Therapist** ([app/Models/Therapist.php](app/Models/Therapist.php))
- **Purpose:** Physical, occupational, speech, and behavioral therapists
- **Key Fields:** user_id, specialization, certification, experience_years
- **Relationships:**
  - `belongsTo` → User
  - `hasMany` → through → TherapySession (via User as therapist_id)

#### **CareGiver** ([app/Models/CareGiver.php](app/Models/CareGiver.php))
- **Purpose:** Parents/guardians of students
- **Key Fields:** user_id, relation_to_student
- **Relationships:**
  - `belongsTo` → User
  - `belongsToMany` → Student (caregiver_student pivot table)

#### **SupportStaff** ([app/Models/SupportStaff.php](app/Models/SupportStaff.php))
- **Purpose:** Teaching assistants, para-educators, aides
- **Key Fields:** user_id, support_type, qualifications
- **Relationships:**
  - `belongsTo` → User

---

### Student Profile Models

#### **DisabilityProfile** ([app/Models/DisabilityProfile.php](app/Models/DisabilityProfile.php))
- **Purpose:** Document student's disability type, severity, and medical info
- **Key Fields:** 
  - student_id (unique)
  - disability_type (Enum: Visual, Hearing, Motor, Cognitive, Multiple)
  - severity (Enum: Mild, Moderate, Severe)
  - description, medical_history, medication_info, support_devices, emergency_contact
- **Relationships:** `belongsTo` → Student

#### **AccessibilityProfile** ([app/Models/AccessibilityProfile.php](app/Models/AccessibilityProfile.php))
- **Purpose:** Store student's accessibility preferences and settings
- **Key Fields:**
  - student_id (unique)
  - font_size, font_family, line_spacing, letter_spacing
  - high_contrast, invert_colors, text_to_speech, screen_reader_mode
  - voice_control, keyboard_only, reading_guide, focus_mode, color_scheme
- **Boolean Casts:** All accessibility features as boolean
- **Relationships:** `belongsTo` → Student

---

### Educational Content Models

#### **Course** ([app/Models/Course.php](app/Models/Course.php))
- **Purpose:** Represents educational courses with accessibility support
- **Key Fields:**
  - title, description
  - created_by_id (SpecialEducator or Admin)
  - accessibility_level (Enum: Basic, Intermediate, Advanced)
  - target_disabilities, max_students (default 50)
  - is_active
- **Relationships:**
  - `belongsTo` → User (creator)
  - `hasMany` → CourseResource, CourseEnrollment, Assessment
  - `hasManyThrough` → Student (via CourseEnrollment)
- **Authorization:** CoursePolicy controls access

#### **CourseResource** ([app/Models/CourseResource.php](app/Models/CourseResource.php))
- **Purpose:** Educational materials within a course
- **Key Fields:** course_id, resource_type, title, description, file_path, resource_url
- **Relationships:**
  - `belongsTo` → Course
  - `hasMany` → AdaptiveContent

#### **CourseEnrollment** ([app/Models/CourseEnrollment.php](app/Models/CourseEnrollment.php))
- **Purpose:** Track student enrollment in courses
- **Key Fields:**
  - course_id, student_id
  - status (Enum: Active, Completed, Dropped)
  - enrolled_at, completed_at (timestamps)
- **Relationships:**
  - `belongsTo` → Course, Student

---

### Assessment & Evaluation Models

#### **Assessment** ([app/Models/Assessment.php](app/Models/Assessment.php))
- **Purpose:** Adaptive and standard assessments for student evaluation
- **Key Fields:**
  - course_id
  - title, description
  - is_adaptive (Enum: Adaptive, Standard)
  - time_limit (minutes, nullable)
  - allow_extra_time, allow_breaks, allow_assistive_tech (boolean flags)
- **Relationships:**
  - `belongsTo` → Course
  - `hasMany` → AdaptiveQuestion, AssessmentResponse
- **Key Methods:**
  - `getAdaptedQuestionsForStudent()` - Returns questions adapted to student needs
- **Authorization:** AssessmentPolicy controls access

#### **AdaptiveQuestion** ([app/Models/AdaptiveQuestion.php](app/Models/AdaptiveQuestion.php))
- **Purpose:** Individual assessment questions with adaptive logic
- **Key Fields:**
  - assessment_id
  - question_text, difficulty_level
  - question_type (Enum: MCQ, ShortAnswer, Essay, TrueFalse)
  - options (JSON array), correct_answer
  - points
- **Relationships:** `belongsTo` → Assessment
- **Key Methods:**
  - `getFormattedOptions()` - Parse JSON options
  - `isCorrect($answer)` - Validate answer

#### **AssessmentResponse** ([app/Models/AssessmentResponse.php](app/Models/AssessmentResponse.php))
- **Purpose:** Student responses and scores for assessments
- **Key Fields:**
  - assessment_id, student_id
  - response_data (JSON), score, feedback
  - time_taken, used_extra_time (boolean)
  - completed_at (timestamp)
- **Relationships:**
  - `belongsTo` → Assessment, Student
- **Key Methods:**
  - `getScorePercentage()` - Calculate percentage score

---

### Individualized Education Program (IEP) Models

#### **IEP** ([app/Models/IEP.php](app/Models/IEP.php))
- **Purpose:** Individualized Education Plan for special education students
- **Key Fields:**
  - student_id, created_by_id
  - status (Enum: Draft, Active, Completed)
  - academic_goals, behavioral_goals, therapy_goals (longText)
  - review_date, notes
- **Relationships:**
  - `belongsTo` → Student, User (createdBy)
  - `hasMany` → IEPGoal, Accommodation
- **Authorization:** IEPPolicy controls access

#### **IEPGoal** ([app/Models/IEPGoal.php](app/Models/IEPGoal.php))
- **Purpose:** Individual goals within an IEP
- **Key Fields:**
  - iep_id
  - goal_type (Enum: Academic, Behavioral, Therapy)
  - goal_description, target_date, status
- **Relationships:** `belongsTo` → IEP

#### **Accommodation** ([app/Models/Accommodation.php](app/Models/Accommodation.php))
- **Purpose:** Accommodations/modifications specified in IEP
- **Key Fields:**
  - iep_id
  - accommodation_type (Enum: ExtraTime, BreakTime, AssistiveTech, TextToSpeech, ScreenReader, LargeFont, HighContrast, Scribe)
  - description, is_active (boolean)
- **Relationships:** `belongsTo` → IEP

#### **AccommodationLog** ([app/Models/AccommodationLog.php](app/Models/AccommodationLog.php))
- **Purpose:** Audit trail of accommodation changes
- **Key Fields:** student_id, accommodation_type, action, timestamp, notes
- **Relationships:** `belongsTo` → Student

---

### Therapy & Behavioral Models

#### **TherapySession** ([app/Models/TherapySession.php](app/Models/TherapySession.php))
- **Purpose:** Record therapy sessions (physical, occupational, speech, behavioral)
- **Key Fields:**
  - student_id, therapist_id
  - session_type (Enum: Physical, Occupational, Speech, Behavioral)
  - session_date, duration (minutes)
  - notes, progress, status (added)
- **Relationships:**
  - `belongsTo` → Student, User (as therapist)
  - `hasMany` → BehavioralNote
- **Key Methods:**
  - `getProgressPercentage()` - Extract progress metric
- **Authorization:** TherapySessionPolicy controls access

#### **BehavioralNote** ([app/Models/BehavioralNote.php](app/Models/BehavioralNote.php))
- **Purpose:** Document student behavior observations
- **Key Fields:**
  - student_id, created_by_id
  - observation_date, observation (text)
  - emotion_state (Enum: Happy, Frustrated, Distracted, Focused, Anxious)
  - support_provided
- **Relationships:**
  - `belongsTo` → Student, User (createdBy)
  - Also linked through TherapySession
- **Key Methods:**
  - `getEmotionStateColor()` - Color coding for UI
  - `getEmotionStateIcon()` - Icon mapping

---

### Progress & Reporting Models

#### **ProgressReport** ([app/Models/ProgressReport.php](app/Models/ProgressReport.php))
- **Purpose:** Comprehensive progress reports generated for students
- **Key Fields:**
  - student_id, period (Enum: Monthly, Quarterly, Yearly)
  - academic_progress, behavioral_progress, therapy_progress (scores)
  - accessibility_recommendations, overall_summary (text)
  - generated_by_id, generated_at (timestamp)
- **Relationships:**
  - `belongsTo` → Student, User (generatedBy)
- **Key Methods:**
  - `getAverageProgress()` - Calculate average of all progress scores
  - `getOverallStatus()` - Determine overall classification
- **Authorization:** ProgressReportPolicy - Read-only access

---

### Adaptive Content Models

#### **AdaptiveContent** ([app/Models/AdaptiveContent.php](app/Models/AdaptiveContent.php))
- **Purpose:** Original course content with adaptations for different needs
- **Key Fields:**
  - course_resource_id
  - original_content, content_type, difficulty_level
  - created_by_id, description, is_active
- **Relationships:**
  - `belongsTo` → CourseResource, User (creator)
  - `hasMany` → AdaptiveContentVariation
  - `hasManyThrough` → StudentContentPreference (via AdaptiveContentVariation)
- **Key Methods:**
  - Manage variations for different disability types

#### **AdaptiveContentVariation** ([app/Models/AdaptiveContentVariation.php](app/Models/AdaptiveContentVariation.php))
- **Purpose:** Specific adaptations of content for different disabilities
- **Key Fields:**
  - adaptive_content_id
  - variation_type, target_disability, adapted_content
  - accessibility_features (JSON array), is_default (boolean)
  - recommendation_score, description
- **Relationships:**
  - `belongsTo` → AdaptiveContent
  - `hasMany` → StudentContentPreference
  - `hasManyThrough` → Student (via StudentContentPreference)

#### **StudentContentPreference** ([app/Models/StudentContentPreference.php](app/Models/StudentContentPreference.php))
- **Purpose:** Track which content variations students prefer/use
- **Key Fields:** student_id, variation_id, preferred (boolean), usage_count
- **Relationships:**
  - `belongsTo` → Student, AdaptiveContentVariation

#### **EducatorDisabilitySpecialization** ([app/Models/EducatorDisabilitySpecialization.php](app/Models/EducatorDisabilitySpecialization.php))
- **Purpose:** Map educators to disabilities they specialize in
- **Key Fields:** educator_id, disability_type, certification_level
- **Relationships:** `belongsTo` → SpecialEducator

---

### Communication & Notification Models

#### **Message** ([app/Models/Message.php](app/Models/Message.php))
- **Purpose:** Direct messaging between users
- **Key Fields:**
  - sender_id, recipient_id
  - message_type (Enum: Text, Email, Notification)
  - content, attachment_path
  - is_read (boolean), read_at (timestamp)
- **Relationships:**
  - `belongsTo` → User (as sender, recipient)

#### **Notification** ([app/Models/Notification.php](app/Models/Notification.php))
- **Purpose:** System notifications for users
- **Key Fields:**
  - user_id, notification_type
  - title, message, data (JSON)
  - is_read (boolean), read_at (timestamp)
- **Relationships:** `belongsTo` → User

#### **UserInvitationMail** ([app/Mail/UserInvitationMail.php](app/Mail/UserInvitationMail.php))
- **Purpose:** Email class for sending user invitations
- **Usage:** Sends registration links to invited users

---

### Compliance & Audit Models

#### **AccessibilityAudit** ([app/Models/AccessibilityAudit.php](app/Models/AccessibilityAudit.php))
- **Purpose:** WCAG compliance audits of the application
- **Key Fields:**
  - auditor_id
  - audit_date, wcag_level (Enum: A, AA, AAA)
  - issues_found (JSON array), recommendations (JSON array)
  - status (Enum: Pending, InProgress, Completed, Failed)
- **Relationships:** `belongsTo` → User (auditor)
- **Key Methods:**
  - `getComplianceStatus()` - Return status with color/icon
  - `getIssuesCount()` - Count issues found
- **Authorization:** AccessibilityAuditPolicy controls access

#### **ComplianceLog** ([app/Models/ComplianceLog.php](app/Models/ComplianceLog.php))
- **Purpose:** Audit trail for data access, modification, deletion
- **Key Fields:**
  - user_id
  - action, action_type (Enum: Created, Updated, Deleted, Accessed, Downloaded, Exported)
  - details (JSON), timestamp
- **Relationships:** `belongsTo` → User
- **Key Methods:**
  - `getActionTypeInfo()` - Return label, color, icon for UI display
  - `getReadableActionDescription()` - Human-readable action text

---

### Invitation Model

#### **Invitation** ([app/Models/Invitation.php](app/Models/Invitation.php))
- **Purpose:** User registration invitation tokens
- **Key Fields:**
  - email, role, token (secure random)
  - invited_by (user_id), expires_at, used_at
- **Relationships:** `belongsTo` → User (invitedBy)
- **Key Methods:**
  - `isValid()` - Check if invitation is still valid
  - `markAsUsed()` - Mark as used after registration
  - `generateToken()` - Generate secure token (bin2hex random_bytes)

---

## 3. HTTP Controllers

### Main Controllers (Web Routes)

#### **DashboardController** ([app/Http/Controllers/DashboardController.php](app/Http/Controllers/DashboardController.php))
- **Routes:** GET `/dashboard`
- **Methods:**
  - `index()` - Display main dashboard

#### **StudentController** ([app/Http/Controllers/StudentController.php](app/Http/Controllers/StudentController.php))
- **Routes:** Resource routes (index, create, store, show, edit, update, destroy)
- **Base Route:** `/students`
- **Methods:**
  - `index()` - List students with search & pagination (15 per page)
  - `create()` - Show student creation form
  - `store()` - Create new student via StoreStudentRequest
  - `show()` - Display student with all related data
  - `edit()` - Show edit form
  - `update()` - Update student via UpdateStudentRequest
  - `destroy()` - Delete student
- **Authorization:** StudentPolicy enforces access control

#### **CourseController** ([app/Http/Controllers/CourseController.php](app/Http/Controllers/CourseController.php))
- **Routes:** Resource routes
- **Base Route:** `/courses`
- **Methods:** Standard CRUD operations
- **Authorization:** CoursePolicy controls access
- **Relationships Loaded:** creator, resources, students

#### **IEPController** ([app/Http/Controllers/IEPController.php](app/Http/Controllers/IEPController.php))
- **Routes:** Resource routes
- **Base Route:** `/ieps`
- **Methods:** Standard CRUD operations
- **Search:** By student name
- **Authorization:** IEPPolicy controls access

#### **AssessmentController** ([app/Http/Controllers/AssessmentController.php](app/Http/Controllers/AssessmentController.php))
- **Routes:**
  - Resource routes (index, create, store, show, edit, update, destroy)
  - `GET /assessments/{assessment}/students/{student}/take` - Student takes assessment
  - `POST /assessments/{assessment}/students/{student}/submit` - Submit responses
  - `GET /assessments/{assessment}/students/{student}/results` - View results
  - `GET /students/{student}/assessment-results` - All results for a student
  - `GET /assessments/{assessment}/analytics` - Analytics dashboard
- **Base Route:** `/assessments`
- **Authorization:** AssessmentPolicy controls access

#### **TherapySessionController** ([app/Http/Controllers/TherapySessionController.php](app/Http/Controllers/TherapySessionController.php))
- **Routes:**
  - Resource routes
  - `GET /therapy/dashboard` - Therapy dashboard
  - `GET /students/{student}/therapy-progress` - Progress tracking
  - `POST /therapy-sessions/{therapySession}/behavioral-note` - Add note
  - `GET /students/{student}/behavioral-notes` - View notes
  - `GET /students/{student}/therapy-progress/export` - Export progress
- **Base Route:** `/therapy-sessions`
- **Authorization:** TherapySessionPolicy controls access

#### **ProgressReportController** ([app/Http/Controllers/ProgressReportController.php](app/Http/Controllers/ProgressReportController.php))
- **Routes:** Resource routes (index, show only - read-only)
- **Base Route:** `/progress-reports`
- **Authorization:** ProgressReportPolicy - read-only access

#### **UserInvitationController** ([app/Http/Controllers/UserInvitationController.php](app/Http/Controllers/UserInvitationController.php))
- **Routes:** Resource routes
- **Base Route:** `/invitations`
- **Purpose:** Admin-only user invitation management

#### **AccessibilitySettingController** ([app/Http/Controllers/AccessibilitySettingController.php](app/Http/Controllers/AccessibilitySettingController.php))
- **Routes:**
  - `GET /students/{student}/accessibility` - Show settings
  - `PATCH /students/{student}/accessibility` - Update settings
  - `POST /students/{student}/accessibility/reset` - Reset to defaults
  - `GET /students/{student}/accessibility/preview` - Preview changes
- **Purpose:** Manage student accessibility preferences

#### **AdaptiveContentController** ([app/Http/Controllers/AdaptiveContentController.php](app/Http/Controllers/AdaptiveContentController.php))
- **Routes:**
  - Resource routes (CRUD)
  - `POST /adaptive-content/{adaptiveContent}/variations` - Create variation
  - `PATCH /adaptive-content/{adaptiveContent}/variations/{variation}` - Update variation
  - `DELETE /adaptive-content/{adaptiveContent}/variations/{variation}` - Delete variation
  - `GET /adaptive-content/{adaptiveContent}/student/{student}/recommended` - Get recommended
- **Base Route:** `/adaptive-content`
- **Purpose:** Manage adaptive content variations

#### **ComplianceController** ([app/Http/Controllers/ComplianceController.php](app/Http/Controllers/ComplianceController.php))
- **Routes:**
  - `GET /compliance/dashboard` - Compliance dashboard
  - `GET /compliance/audits` - List audits
  - `GET /compliance/audits/create` - Create form
  - `POST /compliance/audits` - Store audit
  - `GET /compliance/audits/{accessibilityAudit}` - Show audit
  - `GET /compliance/logs` - View compliance logs
  - `GET /compliance/reports` - Generate reports
  - `GET /compliance/export` - Export data
  - `GET /compliance/governance` - Governance info
- **Purpose:** Accessibility and WCAG compliance management

#### **ProfileController** ([app/Http/Controllers/ProfileController.php](app/Http/Controllers/ProfileController.php))
- **Routes:**
  - `GET /profile` → `profile.edit`
  - `PATCH /profile` → `profile.update`
  - `DELETE /profile` → `profile.destroy`
- **Purpose:** User profile management

---

### API Controllers

Located in `/app/Http/Controllers/Api/` - All require Sanctum authentication

#### **API\StudentController** ([app/Http/Controllers/Api/StudentController.php](app/Http/Controllers/Api/StudentController.php))
- **Routes:** `/api/students` (REST API)
- **Methods:** index, store, show, update, destroy
- **Returns:** JSON API responses

#### **API\CourseController** ([app/Http/Controllers/Api/CourseController.php](app/Http/Controllers/Api/CourseController.php))
- **Routes:** `/api/courses`
- **Methods:** CRUD operations

#### **API\IEPController** ([app/Http/Controllers/Api/IEPController.php](app/Http/Controllers/Api/IEPController.php))
- **Routes:** `/api/ieps`
- **Methods:** CRUD operations

#### **API\AssessmentController** ([app/Http/Controllers/Api/AssessmentController.php](app/Http/Controllers/Api/AssessmentController.php))
- **Routes:** `/api/assessments`
- **Methods:** CRUD operations

#### **API\TherapySessionController** ([app/Http/Controllers/Api/TherapySessionController.php](app/Http/Controllers/Api/TherapySessionController.php))
- **Routes:** `/api/therapy-sessions`
- **Methods:** CRUD operations

#### **API\ProgressReportController** ([app/Http/Controllers/Api/ProgressReportController.php](app/Http/Controllers/Api/ProgressReportController.php))
- **Routes:** `/api/progress-reports`
- **Methods:** index, show (read-only)

#### **API\AdaptiveContentAPIController** ([app/Http/Controllers/Api/AdaptiveContentAPIController.php](app/Http/Controllers/Api/AdaptiveContentAPIController.php))
- **Routes & Methods:**
  - `GET /api/adaptive-content` - List all
  - `GET /api/adaptive-content/course-resource/{resourceId}` - Get for resource
  - `GET /api/adaptive-content/{adaptiveContent}/variations` - Get variations
  - `GET /api/adaptive-content/{adaptiveContent}/variation/{variation}` - Get specific variation
  - `GET /api/adaptive-content/{adaptiveContent}/student/{student}/recommended` - Get recommended
  - `POST /api/adaptive-content/{adaptiveContent}/student/{student}/usage` - Record usage
  - `GET /api/students/{student}/content-preferences` - Get preferences
  - `POST /api/students/{student}/content-preferences/{variation}` - Update preference

---

### Authentication Controllers

Located in `/app/Http/Controllers/Auth/`

#### **Auth\AuthenticatedSessionController**
- `login()` - POST login form
- `store()` - Process login
- `destroy()` - Logout

#### **Auth\RegisteredUserController**
- `create()` - Show registration form
- `store()` - Create new user

#### **Auth\PasswordResetLinkController**
- `create()` - Show password reset form
- `store()` - Send reset link

#### **Auth\NewPasswordController**
- `create()` - Show password reset form
- `store()` - Reset password

#### **Auth\VerifyEmailController**
- `__invoke()` - Verify email token

#### **Auth\EmailVerificationNotificationController**
- `store()` - Resend verification

#### **Auth\ConfirmablePasswordController**
- `show()` - Show confirmation form
- `store()` - Confirm password

#### **Auth\InvitationController**
- Handles invitation registration flow

---

### Student Sub-Controller

#### **Student\ParticipationController** ([app/Http/Controllers/Student/ParticipationController.php](app/Http/Controllers/Student/ParticipationController.php))
- **Purpose:** Track student participation

---

## 4. Enumerations (Enums)

### User & Role Enums

**AccessibilityLevel** ([app/Enums/AccessibilityLevel.php](app/Enums/AccessibilityLevel.php))
```php
- Basic = 'basic'
- Intermediate = 'intermediate'
- Advanced = 'advanced'
```

---

### Student Profile Enums

**DisabilityType** ([app/Enums/DisabilityType.php](app/Enums/DisabilityType.php))
```php
- Visual = 'visual'
- Hearing = 'hearing'
- Motor = 'motor'
- Cognitive = 'cognitive'
- Multiple = 'multiple'
```

**DisabilitySeverity** ([app/Enums/DisabilitySeverity.php](app/Enums/DisabilitySeverity.php))
```php
- Mild = 'mild'
- Moderate = 'moderate'
- Severe = 'severe'
```

**EmotionState** ([app/Enums/EmotionState.php](app/Enums/EmotionState.php))
```php
- Happy = 'happy'
- Frustrated = 'frustrated'
- Distracted = 'distracted'
- Focused = 'focused'
- Anxious = 'anxious'
```

---

### Educational Program Enums

**CourseStatus** ([app/Enums/CourseStatus.php](app/Enums/CourseStatus.php))
```php
- Active = 'active'
- Inactive = 'inactive'
- Archived = 'archived'
```

**EnrollmentStatus** ([app/Enums/EnrollmentStatus.php](app/Enums/EnrollmentStatus.php))
```php
- Active = 'active'
- Completed = 'completed'
- Dropped = 'dropped'
```

**IEPStatus** ([app/Enums/IEPStatus.php](app/Enums/IEPStatus.php))
```php
- Draft = 'draft'
- Active = 'active'
- Completed = 'completed'
```

**IEPGoalType** ([app/Enums/IEPGoalType.php](app/Enums/IEPGoalType.php))
```php
- Academic = 'academic'
- Behavioral = 'behavioral'
- Therapy = 'therapy'
```

---

### Assessment Enums

**AssessmentType** ([app/Enums/AssessmentType.php](app/Enums/AssessmentType.php))
```php
- Adaptive = 'adaptive'
- Standard = 'standard'
```

**QuestionType** ([app/Enums/QuestionType.php](app/Enums/QuestionType.php))
```php
- MCQ = 'mcq'
- ShortAnswer = 'short_answer'
- Essay = 'essay'
- TrueFalse = 'true_false'
```

---

### Accommodation Enums

**AccommodationType** ([app/Enums/AccommodationType.php](app/Enums/AccommodationType.php))
```php
- ExtraTime = 'extra_time'
- BreakTime = 'break_time'
- AssistiveTech = 'assistive_tech'
- TextToSpeech = 'text_to_speech'
- ScreenReader = 'screen_reader'
- LargeFont = 'large_font'
- HighContrast = 'high_contrast'
- Scribe = 'scribe'
```

**SupportType** ([app/Enums/SupportType.php](app/Enums/SupportType.php))
```php
- TeachingAssistant = 'teaching_assistant'
- ParaEducator = 'para_educator'
- Aide = 'aide'
```

---

### Therapy Enums

**TherapyType** ([app/Enums/TherapyType.php](app/Enums/TherapyType.php))
```php
- Physical = 'physical'
- Occupational = 'occupational'
- Speech = 'speech'
- Behavioral = 'behavioral'
```

---

### Content & Reporting Enums

**ResourceType** ([app/Enums/ResourceType.php](app/Enums/ResourceType.php))
```php
- Text = 'text'
- Audio = 'audio'
- Video = 'video'
- PDF = 'pdf'
- SignLanguage = 'sign_language'
```

**ReportPeriod** ([app/Enums/ReportPeriod.php](app/Enums/ReportPeriod.php))
```php
- Monthly = 'monthly'
- Quarterly = 'quarterly'
- Yearly = 'yearly'
```

---

### Communication Enums

**MessageType** ([app/Enums/MessageType.php](app/Enums/MessageType.php))
```php
- Text = 'text'
- Email = 'email'
- Notification = 'notification'
```

---

### Compliance Enums

**AuditStatus** ([app/Enums/AuditStatus.php](app/Enums/AuditStatus.php))
```php
- Pending = 'pending'
- InProgress = 'in_progress'
- Completed = 'completed'
- Failed = 'failed'
```

**ActionType** ([app/Enums/ActionType.php](app/Enums/ActionType.php))
```php
- Created = 'created'
- Updated = 'updated'
- Deleted = 'deleted'
- Accessed = 'accessed'
- Downloaded = 'downloaded'
- Exported = 'exported'
```

**WCAGLevel** ([app/Enums/WCAGLevel.php](app/Enums/WCAGLevel.php))
```php
- A = 'A'
- AA = 'AA'
- AAA = 'AAA'
```

---

## 5. Database Migrations & Tables

### System Tables (Laravel Built-in)

#### **users** - [0001_01_01_000000_create_users_table.php](database/migrations/0001_01_01_000000_create_users_table.php)
- Columns: id, name, email, email_verified_at, password, remember_token, timestamps
- Purpose: Core authentication table

#### **cache** - [0001_01_01_000001_create_cache_table.php](database/migrations/0001_01_01_000001_create_cache_table.php)
- Purpose: Cache storage

#### **jobs** - [0001_01_01_000002_create_jobs_table.php](database/migrations/0001_01_01_000002_create_jobs_table.php)
- Purpose: Queue jobs (not actively used in current codebase)

---

### Permission & Audit Tables (Spatie)

#### **permission_tables** - [2026_04_28_120449_create_permission_tables.php](database/migrations/2026_04_28_120449_create_permission_tables.php)
- Tables: roles, permissions, model_has_permissions, model_has_roles, role_has_permissions
- Purpose: Role-based access control (Spatie/Laravel-Permission)

#### **activity_log** - [2026_04_30_165529_create_activity_log_table.php](database/migrations/2026_04_30_165529_create_activity_log_table.php)
- Columns: id, log_name, description, subject_id, subject_type, causer_id, causer_type, properties, created_at
- Variants:
  - [2026_04_30_165530_add_event_column_to_activity_log_table.php](database/migrations/2026_04_30_165530_add_event_column_to_activity_log_table.php) - Adds event column
  - [2026_04_30_165531_add_batch_uuid_column_to_activity_log_table.php](database/migrations/2026_04_30_165531_add_batch_uuid_column_to_activity_log_table.php) - Adds batch_uuid

---

### User Role Tables

#### **special_educators** - [2026_04_30_165557_create_special_educators_table.php](database/migrations/2026_04_30_165557_create_special_educators_table.php)
- Columns: id, user_id (FK), specialization, qualification, experience_years, timestamps

#### **therapists** - [2026_04_30_165558_create_therapists_table.php](database/migrations/2026_04_30_165558_create_therapists_table.php)
- Columns: id, user_id (FK), specialization, certification, experience_years, timestamps

#### **care_givers** - [2026_04_30_165559_create_care_givers_table.php](database/migrations/2026_04_30_165559_create_care_givers_table.php)
- Columns: id, user_id (FK), relation_to_student, timestamps

#### **support_staff** - [2026_04_30_165612_create_support_staff_table.php](database/migrations/2026_04_30_165612_create_support_staff_table.php)
- Columns: id, user_id (FK), support_type, qualifications, timestamps

---

### Student Profile Tables

#### **students** - [2026_04_30_165600_create_students_table.php](database/migrations/2026_04_30_165600_create_students_table.php)
- Columns: id, user_id (FK, unique), enrollment_date, is_active, timestamps
- Updated: [2026_05_06_123114_add_assigned_educator_id_to_students_table.php](database/migrations/2026_05_06_123114_add_assigned_educator_id_to_students_table.php) - Added assigned_educator_id

#### **disability_profiles** - [2026_04_30_165600_create_disability_profiles_table.php](database/migrations/2026_04_30_165600_create_disability_profiles_table.php)
- Columns: id, student_id (FK, unique), disability_type, severity, description, medical_history, medication_info, support_devices, emergency_contact, timestamps

#### **accessibility_profiles** - [2026_04_30_165601_create_accessibility_profiles_table.php](database/migrations/2026_04_30_165601_create_accessibility_profiles_table.php)
- Columns: id, student_id (FK, unique), font_size, font_family, line_spacing, letter_spacing, high_contrast, invert_colors, text_to_speech, screen_reader_mode, voice_control, keyboard_only, reading_guide, focus_mode, color_scheme, timestamps

---

### Educational Content Tables

#### **courses** - [2026_04_30_165607_create_courses_table.php](database/migrations/2026_04_30_165607_create_courses_table.php)
- Columns: id, title, description, created_by_id (FK), accessibility_level, target_disabilities, max_students, is_active, timestamps

#### **course_resources** - [2026_04_30_165608_create_course_resources_table.php](database/migrations/2026_04_30_165608_create_course_resources_table.php)
- Columns: id, course_id (FK), resource_type, title, description, file_path, resource_url, timestamps

#### **course_enrollments** - [2026_04_30_165609_create_course_enrollments_table.php](database/migrations/2026_04_30_165609_create_course_enrollments_table.php)
- Columns: id, course_id (FK), student_id (FK), status, enrolled_at, completed_at, timestamps

---

### Assessment Tables

#### **assessments** - [2026_04_30_165613_create_assessments_table.php](database/migrations/2026_04_30_165613_create_assessments_table.php)
- Columns: id, course_id (FK), title, description, is_adaptive, time_limit, allow_extra_time, allow_breaks, allow_assistive_tech, timestamps

#### **adaptive_questions** - [2026_04_30_165615_create_adaptive_questions_table.php](database/migrations/2026_04_30_165615_create_adaptive_questions_table.php)
- Columns: id, assessment_id (FK), question_text, difficulty_level, question_type, options (JSON), correct_answer, points, timestamps

#### **assessment_responses** - [2026_04_30_165614_create_assessment_responses_table.php](database/migrations/2026_04_30_165614_create_assessment_responses_table.php)
- Columns: id, assessment_id (FK), student_id (FK), response_data (JSON), score, feedback, time_taken, used_extra_time, completed_at, timestamps

---

### IEP Tables

#### **i_e_p_s** - [2026_04_30_165604_create_i_e_p_s_table.php](database/migrations/2026_04_30_165604_create_i_e_p_s_table.php)
- Columns: id, student_id (FK), created_by_id (FK), status, academic_goals, behavioral_goals, therapy_goals, review_date, notes, timestamps

#### **i_e_p_goals** - [2026_04_30_165605_create_i_e_p_goals_table.php](database/migrations/2026_04_30_165605_create_i_e_p_goals_table.php)
- Columns: id, iep_id (FK), goal_type, goal_description, target_date, status, timestamps

#### **accommodations** - [2026_04_30_165606_create_accommodations_table.php](database/migrations/2026_04_30_165606_create_accommodations_table.php)
- Columns: id, iep_id (FK), accommodation_type, description, is_active, timestamps

#### **accommodation_logs** - [2026_04_30_165619_create_accommodation_logs_table.php](database/migrations/2026_04_30_165619_create_accommodation_logs_table.php)
- Columns: id, student_id (FK), accommodation_type, action, timestamp, notes, created_at/updated_at

---

### Therapy Tables

#### **therapy_sessions** - [2026_04_30_165610_create_therapy_sessions_table.php](database/migrations/2026_04_30_165610_create_therapy_sessions_table.php)
- Columns: id, student_id (FK), therapist_id (FK), session_type, session_date, duration, notes, progress, timestamps
- Updated: [2026_05_06_125824_add_status_to_therapy_sessions_table.php](database/migrations/2026_05_06_125824_add_status_to_therapy_sessions_table.php) - Added status column

#### **behavioral_notes** - [2026_04_30_165611_create_behavioral_notes_table.php](database/migrations/2026_04_30_165611_create_behavioral_notes_table.php)
- Columns: id, student_id (FK), created_by_id (FK), observation_date, observation, emotion_state, support_provided, timestamps

---

### Assessment & Progress Tables

#### **progress_reports** - [2026_04_30_165616_create_progress_reports_table.php](database/migrations/2026_04_30_165616_create_progress_reports_table.php)
- Columns: id, student_id (FK), period, academic_progress, behavioral_progress, therapy_progress, accessibility_recommendations, overall_summary, generated_by_id (FK), generated_at, timestamps

---

### Compliance & Audit Tables

#### **accessibility_audits** - [2026_04_30_165617_create_accessibility_audits_table.php](database/migrations/2026_04_30_165617_create_accessibility_audits_table.php)
- Columns: id, auditor_id (FK), audit_date, wcag_level, issues_found (JSON), recommendations (JSON), status, timestamps

#### **compliance_logs** - [2026_04_30_165618_create_compliance_logs_table.php](database/migrations/2026_04_30_165618_create_compliance_logs_table.php)
- Columns: id, user_id (FK), action, action_type, details (JSON), timestamp, timestamps

---

### Communication Tables

#### **messages** - [2026_04_30_165620_create_messages_table.php](database/migrations/2026_04_30_165620_create_messages_table.php)
- Columns: id, sender_id (FK), recipient_id (FK), message_type, content, attachment_path, is_read, read_at, timestamps

#### **notifications** - [2026_04_30_165621_create_notifications_table.php](database/migrations/2026_04_30_165621_create_notifications_table.php)
- Columns: id, user_id (FK), notification_type, title, message, data (JSON), is_read, read_at, timestamps

---

### User Invitation Table

#### **invitations** - [2026_05_02_134044_create_invitations_table.php](database/migrations/2026_05_02_134044_create_invitations_table.php)
- Columns: id, email, role, token, invited_by (FK), expires_at, used_at, timestamps
- Purpose: Secure invitation links for new users

---

### Adaptive Content Tables

#### **adaptive_contents** - [2026_05_02_163625_create_adaptive_contents_table.php](database/migrations/2026_05_02_163625_create_adaptive_contents_table.php)
- Columns: id, course_resource_id (FK), original_content, content_type, difficulty_level, created_by_id (FK), description, is_active, timestamps

#### **adaptive_content_variations** - [2026_05_02_163634_create_adaptive_content_variations_table.php](database/migrations/2026_05_02_163634_create_adaptive_content_variations_table.php)
- Columns: id, adaptive_content_id (FK), variation_type, target_disability, adapted_content, accessibility_features (JSON), is_default, recommendation_score, description, timestamps

#### **student_content_preferences** - [2026_05_02_163643_create_student_content_preferences_table.php](database/migrations/2026_05_02_163643_create_student_content_preferences_table.php)
- Columns: id, student_id (FK), variation_id (FK), preferred, usage_count, timestamps

---

### Educator Specialization Table

#### **educator_disability_specializations** - [2026_05_07_120000_create_educator_disability_specializations_table.php](database/migrations/2026_05_07_120000_create_educator_disability_specializations_table.php)
- Columns: id, educator_id (FK), disability_type, certification_level, timestamps

---

### Pivot Tables

#### **caregiver_student** (Implicit)
- Columns: caregiver_id (FK), student_id (FK)
- Purpose: Many-to-many relationship between CareGiver and Student

#### **model_has_permissions** (Spatie)
- Links permissions to models

#### **model_has_roles** (Spatie)
- Links roles to models

#### **role_has_permissions** (Spatie)
- Links permissions to roles

---

## 6. API Routes

**File:** [routes/api.php](routes/api.php)

### Authentication
```
GET /api/user (middleware: auth:sanctum) - Get current user
```

### Resource Routes (All require auth:sanctum)

```
GET    /api/students               - List students
POST   /api/students               - Create student
GET    /api/students/{id}          - Show student
PUT    /api/students/{id}          - Update student
DELETE /api/students/{id}          - Delete student

GET    /api/courses                - List courses
POST   /api/courses                - Create course
GET    /api/courses/{id}           - Show course
PUT    /api/courses/{id}           - Update course
DELETE /api/courses/{id}           - Delete course

GET    /api/ieps                   - List IEPs
POST   /api/ieps                   - Create IEP
GET    /api/ieps/{id}              - Show IEP
PUT    /api/ieps/{id}              - Update IEP
DELETE /api/ieps/{id}              - Delete IEP

GET    /api/assessments            - List assessments
POST   /api/assessments            - Create assessment
GET    /api/assessments/{id}       - Show assessment
PUT    /api/assessments/{id}       - Update assessment
DELETE /api/assessments/{id}       - Delete assessment

GET    /api/therapy-sessions       - List therapy sessions
POST   /api/therapy-sessions       - Create session
GET    /api/therapy-sessions/{id}  - Show session
PUT    /api/therapy-sessions/{id}  - Update session
DELETE /api/therapy-sessions/{id}  - Delete session

GET    /api/progress-reports       - List reports (read-only)
GET    /api/progress-reports/{id}  - Show report (read-only)
```

### Adaptive Content Endpoints

```
GET    /api/adaptive-content                           - Get all adaptive content
GET    /api/adaptive-content/course-resource/{resourceId}  - Get for course resource
GET    /api/adaptive-content/{id}/variations           - Get all variations
GET    /api/adaptive-content/{id}/variation/{variation}    - Get specific variation
GET    /api/adaptive-content/{id}/student/{student}/recommended  - Get recommended
POST   /api/adaptive-content/{id}/student/{student}/usage    - Record usage
GET    /api/students/{student}/content-preferences     - Get student preferences
POST   /api/students/{student}/content-preferences/{variation}  - Update preference
```

---

## 7. Web Routes

**File:** [routes/web.php](routes/web.php)

### Public Routes

```
GET / - Welcome page
```

### Authenticated Routes (middleware: auth)

#### Dashboard
```
GET /dashboard - Main dashboard
```

#### Profile Management
```
GET    /profile - Edit profile (profile.edit)
PATCH  /profile - Update profile (profile.update)
DELETE /profile - Delete account (profile.destroy)
```

#### Students
```
GET    /students - List students (students.index)
GET    /students/create - Create form (students.create)
POST   /students - Store student (students.store)
GET    /students/{student} - Show student (students.show)
GET    /students/{student}/edit - Edit form (students.edit)
PUT    /students/{student} - Update student (students.update)
DELETE /students/{student} - Delete student (students.destroy)
```

#### Courses
```
GET    /courses - List courses
GET    /courses/create - Create form
POST   /courses - Store course
GET    /courses/{course} - Show course
GET    /courses/{course}/edit - Edit form
PUT    /courses/{course} - Update course
DELETE /courses/{course} - Delete course
```

#### IEPs
```
GET    /ieps - List IEPs
GET    /ieps/create - Create form
POST   /ieps - Store IEP
GET    /ieps/{iep} - Show IEP
GET    /ieps/{iep}/edit - Edit form
PUT    /ieps/{iep} - Update IEP
DELETE /ieps/{iep} - Delete IEP
```

#### Assessments
```
GET    /assessments - List assessments (assessments.index)
GET    /assessments/create - Create form (assessments.create)
POST   /assessments - Store assessment (assessments.store)
GET    /assessments/{assessment} - Show assessment (assessments.show)
GET    /assessments/{assessment}/edit - Edit form (assessments.edit)
PUT    /assessments/{assessment} - Update assessment (assessments.update)
DELETE /assessments/{assessment} - Delete assessment (assessments.destroy)
GET    /assessments/{assessment}/students/{student}/take - Take assessment (assessments.take)
POST   /assessments/{assessment}/students/{student}/submit - Submit responses (assessments.submit)
GET    /assessments/{assessment}/students/{student}/results - View results (assessments.results)
GET    /students/{student}/assessment-results - Student results (assessments.student-results)
GET    /assessments/{assessment}/analytics - Analytics (assessments.analytics)
```

#### Therapy Sessions
```
GET    /therapy-sessions - List sessions (therapy-sessions.index)
GET    /therapy-sessions/create - Create form (therapy-sessions.create)
POST   /therapy-sessions - Store session (therapy-sessions.store)
GET    /therapy-sessions/{therapySession} - Show session (therapy-sessions.show)
GET    /therapy-sessions/{therapySession}/edit - Edit form (therapy-sessions.edit)
PUT    /therapy-sessions/{therapySession} - Update session (therapy-sessions.update)
DELETE /therapy-sessions/{therapySession} - Delete session (therapy-sessions.destroy)
GET    /therapy/dashboard - Therapy dashboard (therapy.dashboard)
GET    /students/{student}/therapy-progress - Progress tracking (therapy.student-progress)
POST   /therapy-sessions/{therapySession}/behavioral-note - Add note (therapy.add-note)
GET    /students/{student}/behavioral-notes - Behavioral notes (therapy.behavioral-notes)
GET    /students/{student}/therapy-progress/export - Export progress (therapy.export-progress)
```

#### Progress Reports
```
GET    /progress-reports - List reports (progress-reports.index)
GET    /progress-reports/{progressReport} - Show report (progress-reports.show)
```

#### User Invitations
```
GET    /invitations - List invitations
GET    /invitations/create - Create form
POST   /invitations - Store invitation
GET    /invitations/{invitation} - Show invitation
GET    /invitations/{invitation}/edit - Edit form
PUT    /invitations/{invitation} - Update invitation
DELETE /invitations/{invitation} - Delete invitation
```

#### Accessibility Settings
```
GET    /students/{student}/accessibility - Show settings (accessibility.show)
PATCH  /students/{student}/accessibility - Update settings (accessibility.update)
POST   /students/{student}/accessibility/reset - Reset settings (accessibility.reset)
GET    /students/{student}/accessibility/preview - Preview settings (accessibility.preview)
```

#### Adaptive Content
```
GET    /adaptive-content - List content (adaptive-content.index)
GET    /adaptive-content/create - Create form (adaptive-content.create)
POST   /adaptive-content - Store content (adaptive-content.store)
GET    /adaptive-content/{adaptiveContent} - Show content (adaptive-content.show)
GET    /adaptive-content/{adaptiveContent}/edit - Edit form (adaptive-content.edit)
PUT    /adaptive-content/{adaptiveContent} - Update content (adaptive-content.update)
DELETE /adaptive-content/{adaptiveContent} - Delete content (adaptive-content.destroy)
POST   /adaptive-content/{adaptiveContent}/variations - Create variation (adaptive-content.variations.create)
PATCH  /adaptive-content/{adaptiveContent}/variations/{variation} - Update variation (adaptive-content.variations.update)
DELETE /adaptive-content/{adaptiveContent}/variations/{variation} - Delete variation (adaptive-content.variations.destroy)
GET    /adaptive-content/{adaptiveContent}/student/{student}/recommended - Get recommended (adaptive-content.recommended)
```

#### Compliance & Governance
```
GET  /compliance/dashboard - Dashboard (compliance.dashboard)
GET  /compliance/audits - List audits (compliance.audits)
GET  /compliance/audits/create - Create form (compliance.audits.create)
POST /compliance/audits - Store audit (compliance.audits.store)
GET  /compliance/audits/{accessibilityAudit} - Show audit (compliance.audits.show)
GET  /compliance/logs - View logs (compliance.logs)
GET  /compliance/reports - Generate reports (compliance.reports)
GET  /compliance/export - Export data (compliance.export)
GET  /compliance/governance - Governance info (compliance.governance)
```

### Authentication Routes
```
require __DIR__ . '/auth.php'
```

Includes:
- `POST /login` - Process login
- `POST /register` - Process registration
- `POST /forgot-password` - Request password reset
- `POST /reset-password` - Reset password
- `POST /verify-email/{id}/{hash}` - Verify email
- `POST /email/verification-notification` - Resend verification
- `POST /confirm-password` - Confirm password
- `POST /logout` - Logout

---

## 8. Middleware

**Location:** [app/Http/Middleware/](app/Http/Middleware/)

### CheckRole ([app/Http/Middleware/CheckRole.php](app/Http/Middleware/CheckRole.php))
- **Purpose:** Verify user has specific role(s)
- **Usage:** `middleware('role:admin,educator')`
- **Checks:** User authentication, role membership
- **Redirect:** Redirects to login if not authenticated

### CheckPermission ([app/Http/Middleware/CheckPermission.php](app/Http/Middleware/CheckPermission.php))
- **Purpose:** Verify user has specific permission(s)
- **Usage:** `middleware('permission:view_students,create_courses')`
- **Checks:** User authentication, permission membership
- **Redirect:** Redirects to login if not authenticated

---

## 9. Authorization Policies

**Location:** [app/Policies/](app/Policies/)

All policies use the `authorize()` method in controllers to gate access.

### StudentPolicy ([app/Policies/StudentPolicy.php](app/Policies/StudentPolicy.php))
- `viewAny()` - Check `view_students` permission
- `view()` - Students can view own profile; others with permission can view all
- `create()` - Check `create_students` permission
- `update()` - Students can edit own; others with permission can edit all
- `delete()` - Check `delete_students` permission
- `restore()` - Check permission
- `forceDelete()` - Check permission

### CoursePolicy ([app/Policies/CoursePolicy.php](app/Policies/CoursePolicy.php))
- Similar structure: viewAny, view, create, update, delete, restore, forceDelete
- Permission: `view_courses`, `create_courses`, `edit_courses`, `delete_courses`

### IEPPolicy ([app/Policies/IEPPolicy.php](app/Policies/IEPPolicy.php))
- Similar structure for IEP management

### AssessmentPolicy ([app/Policies/AssessmentPolicy.php](app/Policies/AssessmentPolicy.php))
- Similar structure for assessment management

### TherapySessionPolicy ([app/Policies/TherapySessionPolicy.php](app/Policies/TherapySessionPolicy.php))
- Similar structure for therapy session management

### ProgressReportPolicy ([app/Policies/ProgressReportPolicy.php](app/Policies/ProgressReportPolicy.php))
- Read-only: viewAny, view

### AccessibilityAuditPolicy ([app/Policies/AccessibilityAuditPolicy.php](app/Policies/AccessibilityAuditPolicy.php))
- Manage accessibility audits

### ComplianceLogPolicy ([app/Policies/ComplianceLogPolicy.php](app/Policies/ComplianceLogPolicy.php))
- View compliance logs

### AdaptiveContentPolicy ([app/Policies/AdaptiveContentPolicy.php](app/Policies/AdaptiveContentPolicy.php))
- Manage adaptive content variations

### InvitationPolicy ([app/Policies/InvitationPolicy.php](app/Policies/InvitationPolicy.php))
- Manage user invitations

---

## 10. Configuration Files

**Location:** [config/](config/)

### **app.php** - Application Configuration
- **Purpose:** Core Laravel application settings
- **Key Settings:**
  - `name` - Application name (from .env APP_NAME)
  - `env` - Environment (development/production)
  - `debug` - Debug mode toggle
  - `url` - Application URL
  - `locale`, `fallback_locale` - Localization
  - `timezone` - Default timezone
  - `key` - Encryption key
  - `providers` - Service providers
  - `aliases` - Class aliases

### **auth.php** - Authentication Configuration
- **Purpose:** Authentication guard and provider settings
- **Key Settings:**
  - `defaults.guard` - Default guard (web)
  - `defaults.passwords` - Password reset broker (users)
  - `guards.web` - Session-based web guard
  - `providers.users` - Eloquent user provider (User model)

### **database.php** - Database Configuration
- **Purpose:** Database connection settings
- **Default:** SQLite (can switch to MySQL)
- **Connections:**
  - `sqlite` - SQLite driver
  - `mysql` - MySQL driver (configured via .env)
- **Key Settings:**
  - `default` - Default connection
  - `migrations` - Migration paths

### **cache.php** - Cache Configuration
- **Purpose:** Cache driver and stores
- **Stores:**
  - `array` - In-memory cache
  - `database` - Database cache
  - `file` - File-based cache
  - `memcached` - Memcached
  - `redis` - Redis

### **mail.php** - Mail Configuration
- **Purpose:** Email sending configuration
- **Default Mailer:** log (logs to storage/logs)
- **Mailers:**
  - `smtp` - SMTP driver
  - `sendmail` - Sendmail driver
  - `log` - Log driver (for development)
  - `array` - Array driver (testing)
- **From Address:** Default sender email and name

### **queue.php** - Queue Configuration
- **Purpose:** Background job queue settings
- **Default Driver:** `sync` (synchronous - no queue)
- **Connections:**
  - `sync` - Synchronous execution
  - `database` - Database queue
  - `redis` - Redis queue

### **session.php** - Session Configuration
- **Purpose:** User session management
- **Driver:** `cookie` (or `database`)
- **Lifetime:** Session timeout (minutes)
- **Cookie Settings:** Secure, HttpOnly flags

### **filesystems.php** - File Storage Configuration
- **Purpose:** File storage disk configuration
- **Disks:**
  - `local` - Local storage (storage/app)
  - `public` - Public storage (storage/app/public)
  - `s3` - AWS S3 storage

### **logging.php** - Logging Configuration
- **Purpose:** Application logging channels
- **Channels:**
  - `stack` - Multiple log handlers
  - `single` - Single file
  - `daily` - Daily rotating files
  - `slack` - Slack integration
  - `syslog` - System log

### **permission.php** - Spatie Permission Configuration
- **Purpose:** Role-based access control settings
- **Models:**
  - `permission` - Permission model
  - `role` - Role model
- **Table Names:**
  - `roles` - Roles table
  - `permissions` - Permissions table
  - `model_has_permissions` - Model permissions pivot
  - `model_has_roles` - Model roles pivot
  - `role_has_permissions` - Role permissions pivot
- **Features:**
  - `teams` - Multi-tenancy support (optional)
  - `cache_expiration_time` - Cache TTL

### **activitylog.php** - Spatie Activity Log Configuration
- **Purpose:** Activity logging settings
- **Models:**
  - `activity_model` - Activity model class
- **Table Names:**
  - `activity_log` - Activity log table
- **Features:**
  - `log_only_dirty` - Log only changed fields
  - `log_only_changed` - Don't log unchanged data

### **services.php** - Third-party Services
- **Purpose:** External API credentials and configuration
- **Services:** Mailgun, Postmark, AWS credentials, etc.
- **Configuration:** Loaded from .env file

---

## Summary Statistics

- **Total Models:** 30+
- **Total Enums:** 18
- **Total Controllers:** 20+ (Web + API)
- **Total Migrations:** 32
- **Total Database Tables:** 30+
- **Total API Endpoints:** 50+
- **Total Web Routes:** 80+
- **Authorization Policies:** 10
- **Middleware:** 2 custom + Laravel built-in

---

## Architecture Patterns Used

1. **MVC Architecture** - Models, Views, Controllers separation
2. **Resource Controllers** - RESTful resource handling
3. **Policy-Based Authorization** - Gate/Authorize middleware
4. **Type-Safe Enums** - PHP 8.1+ Enums for type safety
5. **Eloquent ORM** - Database abstraction with relationships
6. **Sanctum API** - Token-based API authentication
7. **Role-Based Access Control (RBAC)** - Spatie Permission package
8. **Activity Logging** - Audit trail with Spatie Activity Log
9. **Request Validation** - Form Request classes
10. **Service Providers** - Application bootstrapping

---

**Last Updated:** May 9, 2026  
**Application Version:** 1.0.0 (Eduecho - Special Education Platform)
