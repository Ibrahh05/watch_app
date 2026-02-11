<?php  

shell_exec('php ../artisan config:clear');
shell_exec('php ../artisan cache:clear');

require __DIR__ . '/../public/index.php';