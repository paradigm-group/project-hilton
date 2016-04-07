<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="cf footer" role="contentinfo">

        <?php
            /* A sidebar in the footer? Yep. You can can customize
             * your footer with three columns of widgets.
             */
            get_sidebar( 'footer' );
        ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php 
    // do not display the admin-bar 
    // & other admin-related objects
    if (!current_user_can('subscriber')) {
	wp_footer();
    } ?>

<span id="logoutButton"><?php echo wp_logout_url(); ?></span>

</body>
</html>
