# Backend Connection Guide - EduEcho API

## 📌 Overview
Your backend is running at **http://localhost:8000**  
Frontend communicates with backend via REST API endpoints

---

## 🔐 1. Authentication & Getting a Token

### Register a User
```bash
POST /api/auth/register
Content-Type: application/json

{
  "name": "John Test",
  "email": "student@test.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Login & Get Token
```bash
POST /api/login
Content-Type: application/json

{
  "email": "student@test.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "user": {
    "id": 1,
    "name": "John Test",
    "email": "student@test.com"
  }
}
```

**Store this token in localStorage:**
```javascript
localStorage.setItem('api_token', response.token);
```

---

## 🔗 2. Making API Requests

### Basic Request Pattern
All API requests need the `Authorization` header:

```javascript
const token = localStorage.getItem('api_token');

const headers = {
  'Authorization': `Bearer ${token}`,
  'Content-Type': 'application/json',
  'Accept': 'application/json'
};

fetch('http://localhost:8000/api/students', {
  method: 'GET',
  headers: headers
})
.then(response => response.json())
.then(data => console.log(data));
```

---

## 👥 3. Get All Registered Users/Students

### Endpoint
```
GET /api/students
Authorization: Bearer {token}
```

### JavaScript Example
```javascript
async function getStudents() {
  const token = localStorage.getItem('api_token');
  
  try {
    const response = await fetch('http://localhost:8000/api/students', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      }
    });
    
    const data = await response.json();
    console.log('All Students:', data);
    return data;
  } catch (error) {
    console.error('Error fetching students:', error);
  }
}

// Call it
getStudents();
```

### Response Format
```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "name": "John Test",
      "email": "student@test.com",
      "enrollment_date": "2026-05-09",
      "is_active": true,
      "created_at": "2026-05-09T10:00:00Z",
      "updated_at": "2026-05-09T10:00:00Z"
    },
    {
      "id": 2,
      "user_id": 2,
      "name": "Jane Doe",
      "email": "jane@test.com",
      ...
    }
  ]
}
```

---

## 🎯 4. Get Specific Student Data

### Get Single Student
```javascript
async function getStudent(studentId) {
  const token = localStorage.getItem('api_token');
  
  const response = await fetch(`http://localhost:8000/api/students/${studentId}`, {
    headers: { 'Authorization': `Bearer ${token}` }
  });
  
  const data = await response.json();
  return data.data;
}

getStudent(1);
```

### Includes Student Relations
```json
{
  "id": 1,
  "name": "John Test",
  "email": "student@test.com",
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
    "medical_history": "...",
    "support_devices": ["screen_reader", "magnifier"]
  },
  "accessibility_profile": {
    "font_size": 16,
    "font_family": "arial",
    "text_to_speech": true,
    "screen_reader_mode": true,
    "high_contrast": true
  },
  "courses": [...],
  "ieps": [...],
  "therapy_sessions": [...]
}
```

---

## 📚 5. Key API Endpoints

### Students
```
GET    /api/students              - List all students
POST   /api/students              - Create student
GET    /api/students/{id}         - Get student
PUT    /api/students/{id}         - Update student
DELETE /api/students/{id}         - Delete student
```

### Courses
```
GET    /api/courses               - List courses
POST   /api/courses               - Create course
GET    /api/courses/{id}          - Get course details
PUT    /api/courses/{id}          - Update course
DELETE /api/courses/{id}          - Delete course
```

### Assessments
```
GET    /api/assessments           - List assessments
POST   /api/assessments           - Create assessment
GET    /api/assessments/{id}      - Get assessment
PUT    /api/assessments/{id}      - Update assessment
DELETE /api/assessments/{id}      - Delete assessment
```

### IEPs
```
GET    /api/ieps                  - List IEPs
POST   /api/ieps                  - Create IEP
GET    /api/ieps/{id}             - Get IEP
PUT    /api/ieps/{id}             - Update IEP
DELETE /api/ieps/{id}             - Delete IEP
```

### Therapy Sessions
```
GET    /api/therapy-sessions      - List sessions
POST   /api/therapy-sessions      - Create session
GET    /api/therapy-sessions/{id} - Get session
PUT    /api/therapy-sessions/{id} - Update session
DELETE /api/therapy-sessions/{id} - Delete session
```

### Progress Reports
```
GET    /api/progress-reports      - List reports
GET    /api/progress-reports/{id} - Get report
```

### Adaptive Content
```
GET    /api/adaptive-content                      - List all
GET    /api/adaptive-content/{id}/variations      - Get variations
GET    /api/adaptive-content/{id}/student/{student}/recommended  - Get recommended
```

---

## 🛠️ 6. Complete Example: Display Registered Users

### HTML
```html
<!DOCTYPE html>
<html>
<head>
  <title>Registered Users</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    .user-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin: 10px 0;
      border-radius: 8px;
    }
    .user-name { font-weight: bold; font-size: 18px; }
    .user-email { color: #666; }
  </style>
</head>
<body>

<h1>All Registered Users</h1>
<div id="users-container"></div>

<script>
  // Get token from localStorage
  const token = localStorage.getItem('api_token');

  // Fetch and display users
  async function loadUsers() {
    try {
      const response = await fetch('http://localhost:8000/api/students', {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json'
        }
      });

      const result = await response.json();
      const users = result.data || [];

      // Display users
      const container = document.getElementById('users-container');
      users.forEach(user => {
        const userCard = document.createElement('div');
        userCard.className = 'user-card';
        userCard.innerHTML = `
          <div class="user-name">${user.user.name}</div>
          <div class="user-email">${user.user.email}</div>
          <div>Enrolled: ${user.enrollment_date}</div>
          <div>Status: ${user.is_active ? 'Active' : 'Inactive'}</div>
        `;
        container.appendChild(userCard);
      });

      console.log('Total Users:', users.length);
    } catch (error) {
      console.error('Error:', error);
      alert('Failed to load users');
    }
  }

  // Load users when page loads
  loadUsers();
</script>

</body>
</html>
```

---

## 📊 7. Axios Alternative (Easier)

If you prefer Axios (already in your package.json):

```javascript
// Install: npm install axios

import axios from 'axios';

const token = localStorage.getItem('api_token');

// Configure axios instance
const api = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
});

// Get all students
api.get('/students')
  .then(response => {
    console.log('Students:', response.data.data);
  })
  .catch(error => console.error('Error:', error));

// Get specific student
api.get(`/students/1`)
  .then(response => console.log(response.data.data))
  .catch(error => console.error('Error:', error));

// Create new student
api.post('/students', {
  name: 'New Student',
  email: 'new@test.com',
  // ... other fields
})
  .then(response => console.log('Created:', response.data.data))
  .catch(error => console.error('Error:', error));
```

---

## 🔍 8. Web Request with cURL (Testing)

### Get Students
```bash
curl -X GET http://localhost:8000/api/students \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

### Create Student
```bash
curl -X POST http://localhost:8000/api/students \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New Student",
    "email": "newstudent@test.com",
    "disability_type": "visual",
    "severity": "moderate"
  }'
```

---

## ⚙️ 9. CORS Settings

Your backend is already configured for CORS. If you get CORS errors:

**File:** `config/cors.php` is already set up
**Allowed Origins:** `localhost` and `127.0.0.1`
**Allowed Methods:** `GET, POST, PUT, DELETE, OPTIONS`

---

## 🚀 10. Quick Start Code

```javascript
// Step 1: Login and get token
async function login() {
  const response = await fetch('http://localhost:8000/api/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      email: 'student@eduecho.test',
      password: 'password123'
    })
  });
  
  const data = await response.json();
  const token = data.token;
  localStorage.setItem('api_token', token);
  return token;
}

// Step 2: Fetch students with token
async function getStudents() {
  const token = localStorage.getItem('api_token');
  const response = await fetch('http://localhost:8000/api/students', {
    headers: { 'Authorization': `Bearer ${token}` }
  });
  
  return await response.json();
}

// Step 3: Use it
await login(); // Do this once
const students = await getStudents(); // Now you have all students
console.log(students);
```

---

## 🐛 Troubleshooting

### Error: 401 Unauthorized
- Token is missing or expired
- Solution: Call login() again to get a new token

### Error: 403 Forbidden
- User doesn't have permission
- Solution: Check user role/permissions

### Error: 404 Not Found
- Endpoint doesn't exist
- Solution: Check endpoint URL

### Error: CORS Error
- Cross-Origin Request blocked
- Solution: Make sure backend is running and CORS is configured

---

## 📝 Database Tables

All registered users are stored in:
- **users** table - Authentication
- **students** table - Student profiles
- **disability_profiles** table - Disability info
- **accessibility_profiles** table - Accessibility settings

---

**Backend Running At:** `http://localhost:8000`  
**API Base URL:** `http://localhost:8000/api`  
**Use Token in:** `Authorization: Bearer {token}` header
