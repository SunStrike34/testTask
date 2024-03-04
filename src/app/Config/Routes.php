<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CommentController::index');
$routes->get('/deleteComment/(:num)', 'CommentController::deleteComment/$1');
$routes->get('/getComments', 'CommentController::getComments');
$routes->get('/getCommentsReply/(:num)', 'CommentController::getCommentsReply/$1');
$routes->post('/addComment', 'CommentController::addComment');

