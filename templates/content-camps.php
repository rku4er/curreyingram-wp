<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>

  <div class="entry-summary">
    <?php if ( has_post_thumbnail() ): ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb', array( 'class' => 'thumb' ) ); ?></a>
    <?php endif; ?>
    <?php the_excerpt(); ?>
  </div>
</article>