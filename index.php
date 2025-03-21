<?php get_header(); ?>

<main>
  <section class="container">
    <div class="row">
      <!-- Columna de las noticias -->
      <div class="col-md-8">
        <?php
        query_posts('posts_per_page=3'); // Trae 3 noticias
        if (have_posts()) :
          $contador = 0;
        ?>

          <div class="noticias-container">
            <?php
            while (have_posts()) : the_post();

              if ($contador == 0) : ?>

                <!-- Noticia destacada -->
                <article class="noticia destacada">
                  <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image-large responsive-image">
                      <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large'); ?>
                      </a>
                    </div>
                  <?php endif; ?>

                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                </article>

              <?php else : ?>

                <!-- Noticias normales -->
                <article class="noticia-normal">
                  <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image responsive-image">
                      <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                      </a>
                    </div>
                  <?php endif; ?>

                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                </article>

            <?php endif;

              $contador++;

            endwhile;
            wp_reset_query(); // Importante para restaurar query global
            ?>
          </div>

        <?php
        else :
          echo '<p>No hay contenido para mostrar.</p>';
        endif;
        ?>
        <hr class="separator-red">
      </div>

      <!-- Columna de la tabla de clasificación -->
      <div class="col-md-4">
        <section class="futbol-standings mb-5">
          <div class="container">
            <?php echo do_shortcode('[futbol_standings]'); ?> <!-- Aquí se muestra la tabla -->
          </div>
        </section>
      </div>
    </div>
  </section>

  <!-- ULTIMAS NOVEDADES -->
<section class="ultimas-novedades py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Últimas novedades</h2>

    <?php
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 4,  // Cuántos posts se mostrarán en esta sección
      'offset' => 3  // Si se desea saltar algunas publicaciones iniciales
    );

    $novedades_query = new WP_Query($args);

    if ($novedades_query->have_posts()) : ?>

      <div class="row g-4">
        <?php while ($novedades_query->have_posts()) : $novedades_query->the_post(); ?>
          <div class="col-12 col-md-6 col-lg-3">
            <article class="h-100 p-3 border rounded">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" class="d-block mb-3 featured-image-small">
                  <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                </a>
              <?php endif; ?>

              <h3 class="fs-5">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                  <?php the_title(); ?>
                </a>
              </h3>
            </article>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Enlace a la página de todas las noticias -->
      <div class="text-center mt-4">
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Ver todas las noticias</a>
      </div>

    <?php else : ?>
      <p class="text-center">No hay más novedades.</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
  </div>
</section>

</main>

<?php get_footer(); ?>
