<p class="footer-comment-count">
  <?php
    comments_number( __( '<span>No</span> Comments', 'bonestheme' ),
    __( '<span>1</span> Comment', 'bonestheme' ),
    _n( '<span>%</span> Comments', '<span>%</span> Comments',
    get_comments_number(), 'bonestheme' ) );
  ?>
</p>
