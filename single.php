<?php get_header(); ?>

<main>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article>
                <h1><?php the_title(); ?></h1>
                <p><strong>Publicado el:</strong> <?php the_date(); ?> por <?php the_author(); ?></p>
                <div>
                    <?php the_content(); ?>
                </div>
                
                <div class="comments">
                    <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        echo '<p>No hay contenido para mostrar.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
