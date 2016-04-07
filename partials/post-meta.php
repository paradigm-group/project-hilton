<p class="byline vcard">
  <?php printf( __( 'Posted', 'bonestheme' ) .
    ' <time itemprop="datePublished" content="2014-07-10" class="updated" datetime="%1$s" pubdate>%2$s</time> '
    . __('by', 'bonestheme' ) .
    ' <span itemprop="author" itemscope itemtype="http://schema.org/Person" class="author">
      <span class="fn">%3$s</span>
    </span>',
    get_the_time('Y-m-j'),
    get_the_time(get_option('date_format')),
    get_the_author_meta( 'display_name' ) );
  ?>
</p>
