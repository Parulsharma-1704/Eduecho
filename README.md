# Education Ecosystem

A Laravel-based platform for managing education, student accessibility, assessments, and learning support.

## About

The Education Ecosystem helps educators and therapists manage student records, accommodations, assessments, and adaptive learning content in an accessible way.

## Features

- Student and enrollment management
- Accessibility audits and accommodations
- Assessment and adaptive content
- User roles and permissions
- Messaging and notifications
- Activity logging

## Tech Stack

- **Backend**: Laravel
- **Frontend**: Vue.js with Vite
- **Styling**: Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Testing**: PHPUnit

## Installation

1. Install PHP and Node.js dependencies:
   ```bash
   composer install
   npm install
   ```

2. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Configure your database in `.env` and run:
   ```bash
   php artisan migrate
   ```

4. Build frontend assets:
   ```bash
   npm run build
   ```

## Running

**Development:**
```bash
php artisan serve
npm run dev
```

**Production:**
```bash
npm run build
```

## Testing

```bash
php artisan test
```

## License

MIT License
