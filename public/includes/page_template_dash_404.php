<?php

require_once('config.php');
global $config;

require_once('page_template_dash_head.php');
require_once('page_template_dash_sidebar.php');

?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Not Found
      </h1>
      <ol class="breadcrumb">
        <li class="active">404</li>
      </ol>
    </section>

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="/dashboard">return to dashboard</a>.
          </p>
        </div>
      </div>
    </section>
  </div>

<?php 

require_once('page_template_dash_foot.php');

?>