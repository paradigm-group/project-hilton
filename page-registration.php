<?php
/*
 Template Name: Registration Page
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

    <div id="content" class="wrapper">

        <div id="inner-content" class="container">

            <div class="main" role="main">
                <h1 class="page-title single-title">New User Registration</h1>
                <div class="entry-content">
                    <?php gravity_form( 1, false, false, false, '', false );?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
