<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Shoe.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    //root page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'shoes' => Shoe::getAll()));
    });

    //shoes page
    $app->get("/shoes", function() use ($app) {
      return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll(), 'stores' => Store::getAll()));
    });

$app->get("/stores", function() use ($app) {
  return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
});

$app->post("/stores", function() use ($app) {
  $store = new Store($_POST['store_name'], $_POST['crn']);
  $store->save();
  return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
});

$app->get("/stores/{id}", function($id) use ($app) {
  $store = Store::find($id);
  return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
});

$app->post("/stores/{id}/edit", function($id) use($app) {
    $store = Store::find($id);
    $store->update($_POST['store_name']);
    $store->updateCRN($_POST['crn']);
    return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
});

$app->get("/stores/{id}/delete", function($id) use($app) {
    $store = Store::find($id);
    $store->deleteOne();
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
});

$app->post("/shoes", function () use ($app) {
  $id = null;
  $shoe = new Shoe($_POST['shoe_name'], $_POST['enroll_date'], $id);
  $shoe->save();
  return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll(), 'stores' => Store::getAll()));
});

$app->get("/shoes/{id}", function ($id) use ($app) {
  $shoe = Shoe::find($id);
  return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
});

$app->post("/shoes/{id}/edit", function ($id) use ($app) {
    $shoe = Shoe::find($id);
    $shoe->update($_POST['shoe_name']);
    $shoe->updateEnroll($_POST['enroll_date']);
    return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
});

$app->get("/shoes/{id}/delete", function($id) use($app) {
    $shoe = Shoe::find($id);
    $shoe->deleteOne();
    return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
});

$app->post("/delete_shoes", function() use ($app) {
  Shoe::deleteAll();
  return $app['twig']->render('index.html.twig');
});

$app->post("/delete_stores", function() use ($app) {
  Store::deleteAll();
  return $app['twig']->render('index.html.twig');
});

$app->post("/add_shoes", function () use ($app){
 $store = Store::find($_POST['store_id']);
 $shoe = Shoe::find($_POST['shoe_id']);
 $store->addShoe($shoe);
 return $app['twig']->render('store.html.twig', array('store'=>$store, 'stores' => Store::getAll(), 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
});
$app->post("/add_stores", function () use ($app){
 $store = Store::find($_POST['store_id']);
 $shoe = Shoe::find($_POST['shoe_id']);
 $shoe->addStore($store);
 return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'shoes' => Shoe::getAll(), 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
});
    return $app;
?>
