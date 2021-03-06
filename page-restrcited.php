<?php
/*
 Template Name: Restricted Page
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
                <h1 class="page-title entry-title">Restricted Access</h1>
                <div class="entry-content login-box">
                    <h2>Login</h2>
                    <p>To access this content, please login via this form:</p>

                    <?php wp_login_form(); ?>
                </div>
                <div class="entry-content login-box">
                    <h2>Register</h2>
                    <p>If you do not already have a login please register below:</p>

                    <?php gravity_form( 1, false, false, false, '', false );?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
