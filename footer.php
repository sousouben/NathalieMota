<footer>
    <?php
    // Affichage du menu de navigation du footer
    wp_nav_menu(['theme_location' => 'footer']);

    // Inclusion du template part pour la modale de contact
    get_template_part('templates_part/contact-modale');
    ?>
    <?php get_template_part('templates_part/lightBox'); ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>
