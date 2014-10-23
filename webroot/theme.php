<?php

require __DIR__.'/config_with_app.php'; 

$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_grid.php');
 
// Include support for comments
$di->set('CommentController', 'Phpmvc\Comment\CommentController');
$di->setShared('comments', 'Phpmvc\Comment\PageComments');

$di->comments->removeExternalCss();

$app->router->add('', function() use ($app) {
  $app->theme->setTitle("Tema");
 
	$content = $app->fileContent->get('theme.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	$app->views->addString($content, 'main');

	// Add comments section
  $di->comments->addToPage($app);

});

$app->router->add('regions', function() use ($app) {
  $app->theme->setTitle("Tema");

//    $app->theme->addStylesheet('css/anax-grid/regions_demo.css');
    $app->theme->setTitle("Regioner");
 
    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
               ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4');

    if( !$di->request->getGet(null) == "show_grid" ) {
      $app->theme->addStylesheet('css/david-grid/show-grid.css');
    }
});


$app->router->add('type', function() use ($app, $di) {
  $app->theme->setTitle("Typografi");
 
    $content = $app->fileContent->get('typography.html');

    $app->views->addString($content, 'main')
               ->addString($content, 'sidebar');

  if( !$di->request->getGet(null) == "show_grid" ) {
    $app->theme->addStylesheet('css/david-grid/show-grid.css');
  }

});

$app->router->add('fontawsome', function() use ($app, $di) {
  $app->theme->setTitle("Font Awsome");
 
    $main = $app->fileContent->get('fa_main.html');
    $sidebar = $app->fileContent->get('fa_sidebar.html');

    $app->views->addString($main, 'main')
               ->addString($sidebar, 'sidebar');

});

$app->router->add('source', function() use ($app, $di) {
 
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
 
    $di->comments->includeParams(['path']);
    
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);

    if( $source->getRealPath() ) {
      $app->theme->setTitle("Källkod för " . basename($source->getRealPath()) );
    }

 
    $app->views->addString($source->View(), 'main');

    // Add comments section, also add the 
    // current file/folder being shown. That way
    // there will be different comment flows per
    // file
    $di->comments->addToPage($app);


});


if( $di->request->getGet(null) == "show_grid" ) {
  $app->theme->addStylesheet('css/david-grid/show-grid.css');
}


$app->router->handle();
$app->theme->render();