<?php
 /*Template Name: Single-Proyect
 */
 
get_header(); ?>
<div id="primary">
    <div id="content" role="main">
    <?php
    $mypost = array( 'post_type' => 'proyecto', );
    $loop = new WP_Query( $mypost );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
 
                <!-- Display featured image in right-aligned floating div -->
                <div style="float: right; margin: 10px">
                    <?php the_post_thumbnail( array( 100, 100 ) ); ?>
                </div>
                <strong>Título: </strong><?php the_title(); ?><br />

                <?php 
                    $tax_terms = get_terms('empresa');
                    ?>
                    <strong>Empresa: </strong>
                    <?php
                    foreach ($tax_terms as $tax_term) {
                        echo '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "Ver todos las entradas de %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a> ';
                    }

                    $tax_terms = get_terms('fecha');
                    ?>
                    <br /><strong>Género: </strong>
                    <?php
                    foreach ($tax_terms as $tax_term) {
                        echo '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "Ver todos las entradas de %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a>, ';
                    }
                ?>

                    <br /><strong>Empresa: </strong>
                    <?php echo esc_html( get_post_meta( get_the_ID(), 'empresa', true ) ); ?>
                    <br />
                    <strong>Fecha: </strong>
                    <?php echo esc_html( get_post_meta( get_the_ID(), 'fecha', true ) ); ?>
            </header>
 
            <!-- Display movie review contents -->
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
 
    <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>