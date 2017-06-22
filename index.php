<?php
header("Content-Type: text/html");
include dirname(__FILE__) . '/include/AltoRouter.php';
$router = new AltoRouter();
$router->setBasePath('');

/* Setup the URL routing. This is production ready. */
// Main routes that non-customers see

$router->map('GET','', '/views/home.php', 'home');

$router->map('GET','/cursus/create', '/views/cursus/create.php', 'cursus-create');
$router->map('POST','/cursus/create','/include/cursus_action.php','cursus-add');

$router->map('GET','/student', '/views/student/list.php', 'student-list');
$router->map('GET', '/student/[i:id]', '/views/student/show.php','student-show');
$router->map('GET', '/student/[i:id]/[i:cursus]', '/views/cursus/show.php','cursus-show');
$router->map('POST', '/student/[i:id]/[i:cursus]/delete', '/include/cursus_supr.php','cursus-del');
$router->map('GET', '/student/[i:id]/[i:cursus]/export', '/include/csv_export.php','cursus-export');

$router->map('GET','/student/create', '/views/student/create.php', 'student-create');
$router->map('POST','/student/create', '/include/stud_action.php', 'student-add');

$router->map('GET','/ue', '/views/ue/list.php', 'ue-show');
$router->map('GET','/ue/create', '/views/ue/create.php', 'ue-create');
$router->map('POST','/ue/create', '/include/ue_action.php', 'ue-add');

$match = $router->match();

if($match) {
    require __DIR__ . $match['target'];
}
else {
    header("HTTP/1.0 404 Not Found");
    require __DIR__  . '/views/home.php';
}