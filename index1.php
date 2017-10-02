<?php
// use Composer autoloader
require 'vendor/autoload.php';
require 'config.php';

// configure Slim application instance
// initialize application
$app = new \Slim\Slim(array(
  'debug' => true,
  'templates.path' => './views'
));

$app->config = $config;

// extract database name from URI
// initialize PHP Mongo client
$dbn = substr(parse_url($app->config['db_uri'], PHP_URL_PATH), 1);
$mongo = new MongoClient($app->config['db_uri'], array("connectTimeoutMS" => 30000));
$db = $mongo->selectDb($dbn);

// index page handlers
$app->get('/', function () use ($app) {
  $app->redirect($app->urlFor('index'));
});

// handler to list available notes in database
// if query string included
// filter results to match query string
$app->get('/index', function () use ($app, $db) {
  $collection = $db->notes;  
  $q = trim(strip_tags($app->request->get('q')));
  $where = array();
  if (!empty($q)) {
    $where = array(
      '$or' => 
        array(
          array(
            'title' => array('$regex' => new MongoRegex("/$q/i"))), 
          array(
            'body' => array('$regex' => new MongoRegex("/$q/i")))
        )
    );  
  }
  $notes = $collection->find($where)->sort(array('updated' => -1));
  $app->render('index.tpl.php', array('notes' => $notes));
})->name('index');

// handler to display add/edit form
$app->get('/save(/:id)', function ($id = null) use ($app, $db) {
  $collection = $db->notes;
  $note = $collection->findOne(array('_id' => new MongoId($id)));
  $app->render('save.tpl.php', array('note' => $note));
});

// handler to process form input 
// save note content to database
$app->post('/save', function () use ($app, $db) {
  $collection = $db->notes;  
  $id = trim(strip_tags($app->request->post('id')));
  $note = new stdClass;
  $note->title = trim(strip_tags($app->request->post('title')));
  $note->body = trim(strip_tags($app->request->post('body')));
  $note->color = trim(strip_tags($app->request->post('color')));
  $note->updated = time();
  if (!empty($id)) {
    $note->_id = new MongoId($id);
  }
  $collection->save($note);
  $app->redirect($app->urlFor('index'));
});

// handler to delete specified note 
$app->get('/delete/:id', function ($id) use ($app, $db) {
  $collection = $db->notes;
  $collection->remove(array('_id' => new MongoId($id)));
  $app->redirect($app->urlFor('index'));
});

// handler to display specified note
$app->get('/view/:id', function ($id) use ($app, $db) {
  $collection = $db->notes;
  $note = $collection->findOne(array('_id' => new MongoId($id)));
  $app->render('view.tpl.php', array('note' => $note));
});

// handler to display legal terms
$app->get('/legal', function () use ($app) {
  $app->render('legal.tpl.php');
});


// hook to add request URI path as template variable
$app->hook('slim.before.dispatch', function() use ($app) {
  $app->view()->appendData(array(
    'baseUri' => $app->request()->getRootUri()
  ));
}); 

$app->run();