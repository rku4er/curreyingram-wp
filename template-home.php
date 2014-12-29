<?php
/*
Template Name: Home
*/
?>

<?php
  $slider = function_exists('get_field') ? get_field('slider') : '';
  $slider_timeout = function_exists('get_field') ? get_field('slider_timeout') : '5000';
  $slider_animation = function_exists('get_field') ? get_field('slider_animation') : 'fade';
?>

<?php if($slider): ?>
  <section id="home-slider">
    <div class="container carousel slide <?php if($slider_animation == 'fade') echo 'carousel-fade'; ?>" data-ride="carousel" data-interval="<?php echo $slider_timeout; ?>">
      <div class="carousel-inner">
        <?php
          while(have_rows('slider')):
            the_row();
            $i++;
            $activeS = ($i == 1) ? 'active' : '';
            $img_src = wp_get_attachment_image_src(get_sub_field('image'), 'slider', false);
            $target = get_sub_field('open_in_new_tab') ? 'target="_blank"' : '';
            $image = '<img src="' . $img_src[0] . '" alt="">';
            $url = get_sub_field('url');
            $link = '<a href="' . $url . '" ' . $target . '>' . $image . '</a>';
        ?>
          <div class="item <?php echo $activeS; ?>">
            <?php echo $link; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<div id="home-content">
  <div class="container">

    <div class="row">
        <div class="col-sm-8">
            <?php while (have_posts()) : the_post(); ?>
              <article class="hentry">
                <div class="entry-content">
                  <?php get_template_part('templates/content', 'page'); ?>
                </div>
              </article>
            <?php endwhile; ?>
        </div>

        <div class="col-sm-4">
            <?php
              $testimonials = function_exists('get_field') ? get_field('testimonials') : '';
              $testimonials_timeout = function_exists('get_field') ? get_field('testimonials_timeout') : '5000';
              $testimonials_animation = function_exists('get_field') ? get_field('testimonials_animation') : 'fade';
            ?>

            <?php if($testimonials): ?>
                <section id="testimonials" class="carousel slide <?php if($testimonials_animation == 'fade') echo 'carousel-fade'; ?>" data-ride="carousel" data-interval="<?php echo $testimonials_timeout; ?>">
                  <h3 class="testimonials-head">What people are saying</h3>
                  <div class="carousel-inner">
                    <?php
                      while(have_rows('testimonials')):
                        the_row();
                        $j++;
                        $activeT = ($j == 1) ? 'active' : '';
                    ?>
                      <div class="item <?php echo $activeT; ?>">
                        <blockquote>
                          <p><?php echo get_sub_field('quote'); ?></p>
                          <cite><?php echo get_sub_field('author'); ?></cite>
                        </blockquote>
                      </div>
                    <?php endwhile; ?>
                  </div>
                </section>
            <?php endif; ?>
        </div>
    </div>

  </div>
</div>