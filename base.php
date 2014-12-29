<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php $page_bg = function_exists('get_field') ? get_field('page_bg', 'options') : '#E7E7E7'; ?>

  <div class="wrap" style="background-color: <?php echo $page_bg; ?>">

    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <?php if(is_page_template('template-home.php')): ?>

      <?php echo do_shortcode('[promo_tiles]'); ?>

      <?php include roots_template_path(); ?>

    <?php else: ?>

      <?php echo do_shortcode('[promo_tiles]'); ?>

      <div class="middle-holder container">

        <div class="content row" role="document">
          <main class="main <?php echo roots_main_class(); ?>" role="main">
            <?php if(!is_front_page()): ?>
              <div class="breadcrumbs">
                <?php if(function_exists('bcn_display')) bcn_display(); ?>
              </div>
            <?php endif; ?>
            <?php include roots_template_path(); ?>
          </main><!-- /.main -->
          <?php if (roots_display_sidebar()) : ?>
            <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
              <?php include roots_sidebar_path(); ?>
            </aside><!-- /.sidebar -->
          <?php endif; ?>
        </div><!-- /.content -->

      </div>

    <?php endif; ?>

  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

  <?php if (WP_ENV === 'development'): ?>
    <!-- Livereload page -->
    <script src="//localhost:35729/livereload.js"></script>
  <?php endif; ?>

</body>
</html>
