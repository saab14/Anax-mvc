<?php

require __DIR__.'/config_with_app.php'; 

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
 
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->session();

$di->set('form', 'Mos\HTMLForm\CForm');

// Include support for comments
$di->setShared('comments', 'Anax\Comments\Comment');
$di->setShared('pages', 'Anax\Comments\Page');

// Include database support
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_sqlite.php');
    $db->connect();
    return $db;
});

$di->set('UsersController', '\Anax\Users\UsersController');

$di->set('CommentController', function() use ($di) {
    $controller = new \Anax\Comments\CommentController();
    $controller->setDI($di);
    return $controller;
});

$baseUrl = $di->request->getBaseUrl();

$app->router->add('', function() use ($app, $di) {
  $app->theme->setTitle("Me");
 
    $content = $app->fileContent->get('me.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');



    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline
    ]);

   $app->views->addString('ruben-gris.png', 'banner');

    // Add comments section
  $di->comments->addToView('main-footer');

});

$app->router->add('redovisning', function() use ($app, $di) {
  $app->theme->setTitle("Redovisning");
 
    $content = $app->fileContent->get('report.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);

    // Add comments section
  $di->comments->addToView('main-footer');
  $app->views->addString('computer-work.png', 'banner');
});

$app->router->add('kmom01', function() use ($app) { 
   $app->theme->setTitle("kmom01 rapport"); 

    $content = $app->fileContent->get('kmom01.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
  
    $byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 

    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]); 
}); 

$app->router->add('kmom02', function() use ($app) { 
   $app->theme->setTitle("kmom02 rapport"); 

    $content = $app->fileContent->get('kmom02.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
  
    $byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 

    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]); 
});
 
$app->router->add('kmom03', function() use ($app) { 
   $app->theme->setTitle("kmom03 rapport"); 

    $content = $app->fileContent->get('kmom03.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
  
    $byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 

    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]); 
});

$app->router->add('kmom04', function() use ($app) { 
   $app->theme->setTitle("kmom04 rapport"); 

    $content = $app->fileContent->get('kmom04.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
  
    $byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 

    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]); 
});
 
$app->router->add('source', function() use ($app) {
 
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
 
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
 
});


$app->router->add('regioner', function() use ($app) { 
    $app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php'); 
    $app->theme->setTitle("Mina regioner"); 
    $app->theme->setVariable('class4wrapper','grid');                                                              
    $app->views->addString('featured-1', 'featured-1') 
               ->addString('featured-2', 'featured-2') 
               ->addString('featured-3', 'featured-3') 
               ->addString('main', 'main') 
               ->addString('sidebar', 'sidebar') 
               ->addString('footer-col-1', 'footer-col-1') 
               ->addString('footer-col-2', 'footer-col-2') 
               ->addString('footer-col-3', 'footer-col-3') 
               ->addString('footer-col-4', 'footer-col-4'); 
}); 


$app->router->add('fontochtypografi', function() use ($app) { 
    // Set configuration for theme 
    $app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php'); 
    $app->theme->setTitle("Mitt tema"); 
    $app->theme->setVariable('class4wrapper','grid'); 
    $content = $app->fileContent->get('typography.html'); 
    $contentFeatured1 = $app->fileContent->get('ikoner1.md'); 
    $contentFeatured1 = $app->textFilter->doFilter($contentFeatured1 , 'shortcode, markdown'); 
     
    $contentFeatured2 = $app->fileContent->get('ikoner2.md'); 
    $contentFeatured2 = $app->textFilter->doFilter($contentFeatured2 , 'shortcode, markdown'); 
     
    $contentFeatured3 = $app->fileContent->get('ikoner3.md'); 
    $contentFeatured3 = $app->textFilter->doFilter($contentFeatured3 , 'shortcode, markdown'); 
  
    $app->views->add('me/page', [ 
        'content' =>  $content, 
    ],'main'); 
     
    $app->views->add('me/page', [ 
        'content' => $contentFeatured1, 
    ],'featured-1'); 
     
      $app->views->add('me/page', [ 
        'content' => $contentFeatured2, 
    ],'featured-2'); 
     
      $app->views->add('me/page', [ 
        'content' => $contentFeatured3, 
    ],'featured-3'); 
     
     
     
  
    $app->views->addString('<h1>Coffee</h1> <i class="fa fa-coffee"></i> <i class="fa fa-coffee fa-2x"></i> <i class="fa fa-coffee fa-3x"></i> <i class="fa fa-coffee fa-4x"></i> <i class="fa fa-coffee  fa-5x"></i>', 'flash') 
               ->addString('<h2>Sidebar</h2> ', 'sidebar') 
               ->addString('<h2>Twitter</h2><i class="fa fa-twitter fa-5x"></i>', 'triptych-1') 
               ->addString('<h2>Instagram</h2><i class="fa fa-instagram fa-5x"></i>', 'triptych-2') 
               ->addString('<h2>FaceBook</h2><i class="fa fa-facebook fa-5x"></i>', 'triptych-3');
                
                
       $contentSidebar = $app->fileContent->get('sidebarLinks.md'); 
    $contentSidebar = $app->textFilter->doFilter($contentSidebar , 'shortcode, markdown');         
         $app->views->add('me/page', [ 
        'content' => $contentSidebar, 
    ],'sidebar'); 

}); 



$app->router->add('typografi', function() use ($app) { 
  
     
    $app->theme->setTitle("Typography"); 
    $app->views->add('me/typography'); 
     
    
}); 

$app->router->add('setup', function() use ($app) {
 
    $app->db->setVerbose();

    $app->db->dropTableIfExists('comment')->execute();

     $app->db->createTable(
        'comment',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'resource' => ['varchar(100)'],

            // http://www.eph.co.uk/resources/email-address-length-faq/#emailmaxlength
            'email' => ['varchar(254)'],
            'content' => ['text'],
            'name' => ['varchar(80)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime']
        ]
    )->execute();


    $app->db->dropTableIfExists('user')->execute();
 
    $app->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
        ]
    )->execute();

   $app->db->insert(
        'user',
        ['acronym', 'email', 'name', 'password', 'created', 'active']
    );
 
    $now = date(DATE_RFC2822);
 
    $app->db->execute([
        'admin',
        'admin@dbwebb.se',
        'Administrator',
        password_hash('admin', PASSWORD_DEFAULT),
        $now,
        $now
    ]);
 
    $app->db->execute([
        'doe',
        'doe@dbwebb.se',
        'John/Jane Doe',
        password_hash('doe', PASSWORD_DEFAULT),
        $now,
        $now
    ]);

    exit;

});

if( $di->request->getGet(null) == "show_grid" ) {
  $app->theme->addStylesheet('css/void-base/show-grid.css');
}


 
$app->router->handle();
$app->theme->render(); 