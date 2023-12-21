<?php
get_header();
?>

<div class="content">
    <h1><?php the_title(); ?></h1>

    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
</div>

<?php
get_footer();
?>
