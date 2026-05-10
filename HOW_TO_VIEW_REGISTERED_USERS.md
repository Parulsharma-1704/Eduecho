# How to View Registered People - EduEcho

## 🎯 Quick Ways to See Registered Users

---

## **Method 1: Via Web Browser (Easiest)**

### Step 1: Login
1. Go to `http://localhost:8000/login`
2. Use credentials:
   - Email: `student@eduecho.test`
   - Password: `password123`

### Step 2: View All Students
After login, go to: **`http://localhost:8000/students`**

This shows:
- ✅ All registered students
- ✅ Student names, emails, enrollment dates
- ✅ Enrollment status (Active/Inactive/Completed)
- ✅ Action buttons (View, Edit, Delete)

### Step 3: View Student Details
Click any student name to see:
- Student profile
- Disability information
- Accessibility settings
- Current IEPs
- Enrolled courses
- Assessment results
- Therapy sessions

---

## **Method 2: Via API (Programmatic Access)**

### Get All Students (JSON Format)
```bash
curl -X GET http://localhost:8000/api/students \
  -H "Authorization: Bearer YOUR_TOKEN"
```

**Response:**
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
        "disability_type": "visual",
        "severity": "moderate"
      }
    }
  ]
}
```

---

## **Method 3: Database Query**

Connect to SQLite database and query:

```sql
-- Get all users
SELECT * FROM users;

-- Get all students with their user info
SELECT 
  s.id,
  u.name,
  u.email,
  s.enrollment_date,
  s.is_active
FROM students s
JOIN users u ON s.user_id = u.id;

-- Get students with disability info
SELECT 
  u.name,
  u.email,
  d.disability_type,
  d.severity
FROM students s
JOIN users u ON s.user_id = u.id
LEFT JOIN disability_profiles d ON s.id = d.student_id;
```

**Database File Location:**
`c:\Users\DELL\Desktop\Eduecho\database\database.sqlite`

---

## 📊 Sample Data Output

When you query the database, you'll get:

| ID | Name | Email | Enrollment Date | Status |
|---|---|---|---|---|
| 1 | John Test | student@eduecho.test | 2026-05-09 | Active |
| 2 | Jane Doe | jane@example.com | 2026-05-08 | Active |
| 3 | Bob Smith | bob@example.com | 2026-05-07 | Completed |

---

## 🔗 All URLs to Access Registered Data

### Students
| What | URL | Method |
|-----|-----|--------|
| List all students | `http://localhost:8000/students` | GET |
| View student | `http://localhost:8000/students/{id}` | GET |
| Edit student | `http://localhost:8000/students/{id}/edit` | GET |
| Delete student | `http://localhost:8000/students/{id}` | DELETE |

### Courses (Registered Courses)
| What | URL |
|-----|-----|
| List courses | `http://localhost:8000/courses` |
| View course | `http://localhost:8000/courses/{id}` |

### IEPs (Individual Education Plans)
| What | URL |
|-----|-----|
| List IEPs | `http://localhost:8000/ieps` |
| View IEP | `http://localhost:8000/ieps/{id}` |

### Assessments (Tests/Evaluations)
| What | URL |
|-----|-----|
| List assessments | `http://localhost:8000/assessments` |
| View assessment | `http://localhost:8000/assessments/{id}` |

### Therapy Sessions
| What | URL |
|-----|-----|
| List sessions | `http://localhost:8000/therapy-sessions` |
| View session | `http://localhost:8000/therapy-sessions/{id}` |

---

## 📱 JavaScript to Fetch and Display Users

```javascript
// Login first
async function login() {
  const res = await fetch('http://localhost:8000/api/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      email: 'student@eduecho.test',
      password: 'password123'
    })
  });
  const data = await res.json();
  localStorage.setItem('token', data.token);
}

// Fetch all registered students
async function getAllStudents() {
  const token = localStorage.getItem('token');
  const res = await fetch('http://localhost:8000/api/students', {
    headers: { 'Authorization': `Bearer ${token}` }
  });
  const data = await res.json();
  
  // Display in console
  console.table(data.data.map(s => ({
    'ID': s.id,
    'Name': s.user.name,
    'Email': s.user.email,
    'Enrolled': s.enrollment_date,
    'Status': s.is_active ? 'Active' : 'Inactive'
  })));
}

// Run it
await login();
await getAllStudents();
```

---

## 🔍 What Data You Can See

### From Students List
- ✅ Name
- ✅ Email
- ✅ Enrollment Date
- ✅ Active Status
- ✅ Registration Timestamp

### From Individual Student Profile
- ✅ Disability Type (Visual, Hearing, Motor, Cognitive, Multiple)
- ✅ Severity Level (Mild, Moderate, Severe)
- ✅ Medical History
- ✅ Support Devices
- ✅ Accessibility Settings (Font size, contrast, text-to-speech, etc.)
- ✅ Assigned IEPs
- ✅ Enrolled Courses
- ✅ Assessment Results
- ✅ Therapy Sessions
- ✅ Progress Reports

---

## 🛠️ Testing with Postman

### Setup in Postman

1. **Get Token:**
   - Method: POST
   - URL: `http://localhost:8000/api/login`
   - Body (JSON):
     ```json
     {
       "email": "student@eduecho.test",
       "password": "password123"
     }
     ```
   - Copy the `token` from response

2. **List Students:**
   - Method: GET
   - URL: `http://localhost:8000/api/students`
   - Headers:
     - `Authorization: Bearer {paste_token_here}`
     - `Accept: application/json`

3. **View Specific Student:**
   - Method: GET
   - URL: `http://localhost:8000/api/students/1`
   - Same headers as above

---

## 🔐 User Roles Available

Different roles have access to different data:

| Role | Can See | Can Do |
|------|---------|--------|
| **Admin** | All students, courses, IEPs, reports | Create, edit, delete all |
| **Educator** | Assigned students, courses | Create courses, manage IEPs |
| **Therapist** | Assigned students | Record therapy sessions |
| **Support Staff** | All students | View and update records |
| **Care Giver** | Own children's data | View progress reports |
| **Student** | Own profile only | View own data |

---

## 💡 Common Queries

### Get Student Count
```bash
curl http://localhost:8000/api/students \
  -H "Authorization: Bearer {token}" | grep -o '"id"' | wc -l
```

### Get Active Students Only
```javascript
fetch('http://localhost:8000/api/students', {
  headers: { 'Authorization': `Bearer ${token}` }
})
.then(r => r.json())
.then(d => d.data.filter(s => s.is_active))
.then(active => console.log(`Active: ${active.length}`));
```

### Export Students to CSV
```javascript
const students = await fetch('http://localhost:8000/api/students', {
  headers: { 'Authorization': `Bearer ${token}` }
}).then(r => r.json()).then(d => d.data);

const csv = 'Name,Email,Enrolled\n' + 
  students.map(s => `${s.user.name},${s.user.email},${s.enrollment_date}`).join('\n');

const blob = new Blob([csv], { type: 'text/csv' });
const url = URL.createObjectURL(blob);
const a = document.createElement('a');
a.href = url;
a.download = 'students.csv';
a.click();
```

---

## ✅ Checklist: Connect Backend to Frontend

- [ ] Backend is running: `http://localhost:8000` ✓
- [ ] Frontend is running: `http://localhost:5173` or `http://localhost:8000`
- [ ] Database is populated with students
- [ ] Can login successfully
- [ ] Can view `/students` page
- [ ] Can fetch from `/api/students` with token
- [ ] Can display student data in your frontend

---

## 🚀 Quick Start

```bash
# 1. Open browser
http://localhost:8000

# 2. Register or Login
# Use: student@eduecho.test / password123

# 3. Click "Students" in navigation
# Now you see all registered people!

# 4. Click on any student
# See complete profile with all data
```

**That's it!** You're now connected to the backend and viewing real database data!
