<?php
header("Content-Type: text/html");
include dirname(__FILE__) . '/include/AltoRouter.php';
include dirname(__FILE__) . '/include/bibliotheque.php';
$router = new AltoRouter();
$router->setBasePath('');

/* Setup the URL routing. This is production ready. */
// Main routes that non-customers see

$router->map('GET','', '/views/home.php', 'home');

$router->map('GET','/cursus', function (){
    flash( 'status', 'Pour afficher un cursus, merci de selectionner un utilisateur ci-dessous','alert alert-info');
    header('Location:'.$_SERVER['HTTP_REFERER'].'student');
}, 'cursus-list');
$router->map('GET','/cursus/create', '/views/cursus/create.php', 'cursus-create');
$router->map('POST','/cursus/create','/include/cursus_action.php','cursus-add');

$router->map('GET','/student', '/views/student/list.php', 'student-list');
$router->map('GET', '/student/[i:id]', '/views/student/show.php','student-show');
$router->map('GET', '/student/[i:id]/[i:cursus]', '/views/cursus/show.php','cursus-show');

$router->map('GET', '/student/[i:id]/[i:cursus]/duplicate', '/include/cursus_dup.php','cursus-duplicate');
$router->map('GET', '/student/[i:id]/[i:cursus]/export', '/include/csv_export.php','cursus-export');
$router->map('GET', '/student/[i:id]/[i:cursus]/delete', '/include/cursus_supr.php','cursus-del');

$router->map('GET', '/student/[i:id]/[i:cursus]/verif1', '/include/rgmt_actuel.php','cursus-verif1');
$router->map('GET', '/student/[i:id]/[i:cursus]/verif2', '/include/rgmt_futur.php','cursus-verif2');

$router->map('GET','/student/create', '/views/student/create.php', 'student-create');
$router->map('POST','/student/create', '/include/stud_action.php', 'student-add');

$router->map('GET','/ue', '/views/ue/list.php', 'ue-show');
$router->map('GET','/ue/create', '/views/ue/create.php', 'ue-create');
$router->map('POST','/ue/create', '/include/ue_action.php', 'ue-add');

$match = $router->match();

if($match && is_callable( $match['target'] )){
    call_user_func_array( $match['target'], $match['params'] );
} elseif($match) {
    require __DIR__ . $match['target'];
}
else {
    header("HTTP/1.0 404 Not Found");
    require __DIR__  . '/views/home.php';
}