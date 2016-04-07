<?php get_header(); ?>

    <div id="content" class="wrapper">

        <div id="inner-content" class="container">

            <div class="main"  role="main">

                <article id="post-not-found" class="hentry">

                    <header class="article-header">

                        <h1><?php _e( '404 - Article Not Found', 'guybrush' ); ?></h1>

                    </header>

                    <div class="entry-content">

                        <p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>

                    </div>

                    <div class=" entry-content search">

                            <p><?php get_search_form(); ?></p>

                    </div>

                    <footer class="article-footer">

                            <p><?php _e( 'This is the 404.php template.', 'bonestheme' ); ?></p>

                    </footer>

                </article>

            </div>

        </div>

    </div>

<?php get_footer(); ?>
