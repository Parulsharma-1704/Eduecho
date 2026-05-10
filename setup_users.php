<?php
// This file is run manually via Artisan to setup users

require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->call('tinker', [
    '--execute' => "
\$student = \App\Models\User::where('email', 'student@eduecho.test')->first();
if (\$student && !\$student->hasRole('student')) {
    \$student->assignRole('student');
    echo 'Student role assigned\n';
}

\$admin = \App\Models\User::where('email', 'admin@test.com')->first();
if (\$admin) {
    \$admin->givePermissionTo('view_students');
    \$admin->givePermissionTo('create_students');
    \$admin->givePermissionTo('edit_students');
    \$admin->givePermissionTo('delete_students');
    echo 'Admin permissions set\n';
}

echo 'Setup complete!';
"
]);

$kernel->terminate(new Symfony\Component\Console\Input\StringInput(''), $status);
