<article <?php post_class(); ?>>
  <header class="clearfix">
    <h2 class="entry-title" style="float: left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="entry-meta"><?php the_field('date_offered'); ?> &bullet; <?php the_field('age'); ?></div>
  </header>

  <div class="entry-summary">
    <?php if ( has_post_thumbnail() ): ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb', array( 'class' => 'thumb' ) ); ?></a>
    <?php endif; ?>

    <?php echo excerpt_camps(get_the_ID(), 65, 'Expand+', 'Collapse'); ?>
  </div>
</article>