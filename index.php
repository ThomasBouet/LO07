<?php
header("Content-Type: text/html");
include dirname(__FILE__) . '/include/AltoRouter.php';
$router = new AltoRouter();
$router->setBasePath('');

/* Setup the URL routing. This is production ready. */
// Main routes that non-customers see

$router->map('GET','/', '/views/home.php', 'home');

$router->map('GET','/cursus/create', '/views/cursus/create.php', 'cursus-create');

$router->map('GET','/student/create', '/views/student/create.php', 'student-create');

$router->map('GET','/ue/', '/views/ue/show.php', 'ue-show');


// Special (payments, ajax processing, etc)
$router->map('GET','/charge/[*:customer_id]/','charge.php','charge');
$router->map('GET','/pay/[*:status]/','payment_results.php','payment-results');

// API Routes
$router->map('GET','/api/[*:key]/[*:name]/', 'json.php', 'api');
/* Match the current request */

$match = $router->match();

if($match) {
    require $match['target'];
}
else {
    header("HTTP/1.0 404 Not Found");
    require '404.html';
}
?>