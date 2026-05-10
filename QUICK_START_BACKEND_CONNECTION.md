# 🚀 COMPLETE GUIDE: Backend Connection & Viewing Registered Users

## ✅ YOUR APP IS NOW RUNNING!

**Backend:** http://localhost:8000 ✓  
**Frontend Vite:** http://localhost:5173 ✓  
**Database:** SQLite at `database/database.sqlite` ✓

---

## 📊 How to View Registered People/Users

### **Method 1: Via Web Browser (EASIEST)**

1. **Open:** `http://localhost:8000`
2. **Login with:**
   - Email: `admin@test.com`
   - Password: `password123`

3. **Once logged in, click "Students"** in the navigation menu
   - Shows list of all registered students
   - Click any student to see complete profile with:
     - Disability information
     - Accessibility settings
     - Enrolled courses
     - IEPs (Education Plans)
     - Therapy sessions
     - Assessment results
     - Progress reports

---

## 🔗 All Web URLs to View Registered Data

```
Students:         http://localhost:8000/students
Courses:          http://localhost:8000/courses
IEPs:             http://localhost:8000/ieps
Assessments:      http://localhost:8000/assessments
Therapy:          http://localhost:8000/therapy-sessions
Progress Reports: http://localhost:8000/progress-reports
```

---

## 🛠️ API Endpoints (for Frontend Integration)

### Get All Registered Students (JSON)
```bash
GET http://localhost:8000/api/students
Authorization: Bearer {token}
```

### JavaScript Example
```javascript
const token = localStorage.getItem('api_token');

async function getAllStudents() {
  const response = await fetch('http://localhost:8000/api/students', {
    headers: { 'Authorization': `Bearer ${token}` }
  });
  
  const data = await response.json();
  console.log('All Students:', data.data);
  
  // Display them
  data.data.forEach(student => {
    console.log(`${student.user.name} (${student.user.email})`);
  });
}

getAllStudents();
```

---

## 📋 Database Tables

All registered data is stored in SQLite:

**Location:** `c:\Users\DELL\Desktop\Eduecho\database\database.sqlite`

**Key Tables:**
- `users` - All user accounts
- `students` - Student profiles
- `disability_profiles` - Disability information
- `accessibility_profiles` - Accessibility settings
- `courses` - Educational courses
- `ieps` - Individualized Education Programs
- `therapy_sessions` - Therapy records
- `assessments` - Tests/Evaluations
- `progress_reports` - Student reports

---

## 🔐 Authentication & Tokens

### Login (Get Token)
```bash
POST http://localhost:8000/api/login
Content-Type: application/json

{
  "email": "admin@test.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "user": {
    "id": 3,
    "name": "Admin User",
    "email": "admin@test.com"
  }
}
```

### Use Token in API Requests
```javascript
const token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...";

// Store it
localStorage.setItem('api_token', token);

// Use it in requests
fetch('http://localhost:8000/api/students', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
})
```

---

## 📝 Sample API Response

When you fetch students, you get:

```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "enrollment_date": "2026-05-09",
      "is_active": true,
      "user": {
        "id": 1,
        "name": "John Test",
        "email": "student@test.com"
      },
      "disability_profile": {
        "id": 1,
        "disability_type": "visual",
        "severity": "moderate",
        "description": "...",
        "support_devices": ["screen_reader"]
      },
      "accessibility_profile": {
        "font_size": 16,
        "text_to_speech": true,
        "screen_reader_mode": true
      }
    }
  ]
}
```

---

## 📚 All REST API Endpoints

```
STUDENTS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET    /api/students              - List all
POST   /api/students              - Create
GET    /api/students/{id}         - Get one
PUT    /api/students/{id}         - Update
DELETE /api/students/{id}         - Delete

COURSES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET    /api/courses               - List all
POST   /api/courses               - Create
GET    /api/courses/{id}          - Get one
PUT    /api/courses/{id}          - Update
DELETE /api/courses/{id}          - Delete

IEPs
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET    /api/ieps                  - List all
POST   /api/ieps                  - Create
GET    /api/ieps/{id}             - Get one
PUT    /api/ieps/{id}             - Update
DELETE /api/ieps/{id}             - Delete

ASSESSMENTS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET    /api/assessments           - List all
POST   /api/assessments           - Create
GET    /api/assessments/{id}      - Get one
PUT    /api/assessments/{id}      - Update
DELETE /api/assessments/{id}      - Delete

THERAPY SESSIONS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET    /api/therapy-sessions      - List all
POST   /api/therapy-sessions      - Create
GET    /api/therapy-sessions/{id} - Get one
PUT    /api/therapy-sessions/{id} - Update
DELETE /api/therapy-sessions/{id} - Delete

PROGRESS REPORTS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET    /api/progress-reports      - List all (read-only)
GET    /api/progress-reports/{id} - Get one (read-only)

ADAPTIVE CONTENT
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
GET /api/adaptive-content
GET /api/adaptive-content/{id}/variations
GET /api/adaptive-content/{id}/student/{student}/recommended
```

---

## 🎯 Test Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@test.com | password123 |
| Student | student@eduecho.test | password123 |

---

## 🔍 Query Examples

### Get Student Count
```bash
curl http://localhost:8000/api/students \
  -H "Authorization: Bearer {token}" | jq '.data | length'
```

### Get Only Active Students
```javascript
fetch('http://localhost:8000/api/students', {
  headers: { 'Authorization': `Bearer ${token}` }
})
.then(r => r.json())
.then(d => d.data.filter(s => s.is_active))
.then(active => console.log(`Active: ${active.length}`))
```

### Get Student Details
```javascript
fetch('http://localhost:8000/api/students/1', {
  headers: { 'Authorization': `Bearer ${token}` }
})
.then(r => r.json())
.then(d => {
  const s = d.data;
  console.log(`Name: ${s.user.name}`);
  console.log(`Email: ${s.user.email}`);
  console.log(`Disability: ${s.disability_profile.disability_type}`);
  console.log(`Enrolled: ${s.enrollment_date}`);
})
```

---

## 🚀 Frontend Integration

### In Blade Template (PHP)
```blade
@if(Auth::user()->hasRole('admin'))
    <div>
        <h1>Registered Students</h1>
        <table>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->enrollment_date }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endif
```

### In Vue/React
```javascript
import { useEffect, useState } from 'react';

export function StudentsList() {
  const [students, setStudents] = useState([]);
  const token = localStorage.getItem('api_token');

  useEffect(() => {
    fetch('http://localhost:8000/api/students', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(r => r.json())
    .then(d => setStudents(d.data))
  }, []);

  return (
    <div>
      <h1>Students ({students.length})</h1>
      {students.map(s => (
        <div key={s.id}>
          <h3>{s.user.name}</h3>
          <p>{s.user.email}</p>
        </div>
      ))}
    </div>
  );
}
```

---

## 💡 Key Points to Remember

✅ Backend always needs `Authorization: Bearer {token}` header  
✅ Token lasts until user logs out  
✅ All requests return JSON format  
✅ Database updates in real-time  
✅ Roles control who can see what  
✅ Permissions control what actions users can perform

---

## 🐛 Common Issues & Solutions

| Problem | Solution |
|---------|----------|
| 401 Unauthorized | Get new token with login endpoint |
| 403 Forbidden | User lacks permissions |
| 404 Not Found | Check endpoint URL |
| CORS Error | Backend CORS is configured, check headers |
| Empty data | Check user role and permissions |

---

## 📖 Architecture

```
┌─────────────────────────────────────────┐
│         Frontend (Vite)                  │
│  http://localhost:5173 or 8000           │
│  ├─ Blade templates                      │
│  ├─ Alpine.js                            │
│  └─ Tailwind CSS                         │
└────────────────┬────────────────────────┘
                 │ HTTP Requests
                 ▼
┌─────────────────────────────────────────┐
│  Backend (Laravel 12)                    │
│  http://localhost:8000/api               │
│  ├─ REST API Routes                      │
│  ├─ Controllers                          │
│  ├─ Models & ORM                         │
│  └─ Authentication (Sanctum)             │
└────────────────┬────────────────────────┘
                 │ SQL Queries
                 ▼
┌─────────────────────────────────────────┐
│  Database (SQLite)                       │
│  database/database.sqlite                │
│  ├─ users table                          │
│  ├─ students table                       │
│  ├─ disability_profiles table            │
│  └─ 30+ other tables                     │
└─────────────────────────────────────────┘
```

---

## 📞 Support

If you need to:
- **View registered users** → Go to `http://localhost:8000/students`
- **Fetch via API** → Use `/api/students` endpoint with token
- **Query database** → Use SQLite browser with `database.sqlite`
- **Debug issues** → Check Laravel logs at `storage/logs/laravel.log`

---

**Last Updated:** May 9, 2026  
**Framework:** Laravel 12  
**Database:** SQLite  
**Frontend:** Vite + Blade + Alpine.js + Tailwind CSS  
**API Auth:** Sanctum Bearer Tokens  

---

## ✨ You're All Set!

Your application is fully functional. You can now:
1. ✅ Register users
2. ✅ View registered people on the web
3. ✅ Query backend API for data
4. ✅ Integrate frontend with backend
5. ✅ Manage student profiles & disabilities
6. ✅ Track IEPs, assessments, therapy, reports

**Start with:** `http://localhost:8000/students`
