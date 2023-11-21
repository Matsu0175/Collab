<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require_once('controller/User.php');

include __DIR__ . '/../vendor/autoload.php';

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'batangas_db';
DB::$encoding = 'utf8';


//http://159.223.58.80/phpmyadmin/

use Controller\User\User;


use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;


$router = new RouteCollector();
$user = new User();


date_default_timezone_set('Asia/Manila');


#User.php
$router->post('batangas/api/user-register', fn() => $user->register_user());
$router->post('batangas/api/user-login', fn() => $user->login_user());
$router->post('batangas/api/user-admin', fn() => $user->login_admin());
$router->post('batangas/api/user-logout', fn() => $user->logout());
$router->post('batangas/api/upload-images/{random}', fn($random) => $user->upload_images($random));
$router->post('batangas/api/upload-gallery', fn() => $user->upload_gallery());
$router->post('batangas/api/publish-post', fn() => $user->publish_post());
$router->post('batangas/api/load-single-post', fn() => $user->load_single_post());
$router->post('batangas/api/publish-comment', fn() => $user->publish_comment());
$router->post('batangas/api/sort-post', fn() => $user->sort_post());
$router->post('batangas/api/sort-category', fn() => $user->sort_category());
$router->post('batangas/api/update-profile', fn() => $user->update_profile());
$router->post('batangas/api/update-password', fn() => $user->update_password());
$router->post('batangas/api/send-feedback', fn() => $user->send_feedback());
$router->post('batangas/api/set-post', fn() => $user->set_post());
$router->post('batangas/api/view-post-details', fn() => $user->view_post_details());
$router->post('batangas/api/remove-user', fn() => $user->remove_user());
$router->post('batangas/api/search-place', fn() => $user->search_place());
$router->post('batangas/api/update-post-details', fn() => $user->update_post_details());
$router->post('batangas/api/delete-file', fn() => $user->delete_file());
$router->post('batangas/api/post-delete', fn() => $user->post_delete());


$router->get('batangas/api/load-dashboard', fn() => $user->load_dashboard());
$router->get('batangas/api/load-post', fn() => $user->load_post());
$router->get('batangas/api/load-post-all', fn() => $user->load_post_all());
$router->get('batangas/api/load-post-admin', fn() => $user->load_post_admin());
$router->get('batangas/api/load-gallery', fn() => $user->load_gallery());
$router->get('batangas/api/load-feed-admin', fn() => $user->load_feed_admin());
$router->get('batangas/api/load-users-admin', fn() => $user->load_user_admin());
$router->get('batangas/api/user-verify/{userid}', fn($userid) => $user->verify_user($userid));

$dispatcher = new Dispatcher($router->getData());
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
echo $dispatcher->dispatch($httpMethod, $uri), "\n";

    

?>