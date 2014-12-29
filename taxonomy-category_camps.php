<?php
  $current_tax_slug = $wp_query->query_vars['category_camps'];
  $tax_obj = get_term_by('slug', $current_tax_slug, 'category_camps');

  echo '<h1 class="camps-cat-title">' . $tax_obj->name . ' Camps</h1>'
?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="columns clearfix">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'camps'); ?>
  <?php endwhile; ?>
</div>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
