<?php
/**
* This is where you can copy and paste your functions !
*/


add_filter('tc_credits_display', 'my_custom_credits', 20);
function my_custom_credits(){ 
  $credits = '';
  $newline_credits = '';
  return '
  <div class="span6 credits">
      		    	<p> &copy; '.esc_attr( date( 'Y' ) ).' <a href="'.esc_url( home_url() ).'" title="'.esc_attr(get_bloginfo()).'" rel="bookmark">'.esc_attr(get_bloginfo()).'</a> &middot; '.($credits ? $credits : 'Designed by <a href="http://www.presscustomizr.com/">Press Customizr</a>') . '</p>		</div>';
}


add_action('__before_main_container' , 'k9_add_submenu');

function k9_add_submenu() {
  global $wp_query;
  if (empty($wp_query->post->post_parent)) {
    $parent = $wp_query->post->ID;
    $is_active = true;
  } else {
    $parent = $wp_query->post->post_parent;
    $is_active = false;
  }
  if (wp_list_pages("child_of=$parent&echo=0" )) {
    echo '<ul class="k9-submenu nav nav-pills">';
    echo '<li class="' . ($is_active ? 'active' : '') . '"><a href="' . esc_url(get_permalink($parent)) . '">' . get_the_title($parent) . '</a></li>';
    echo str_replace('current_page_item', 'active', wp_list_pages("title_li=&child_of=$parent&echo=0"));
    echo '</ul>';
  }
}

add_filter ( 'tc_social_in_header' , 'k9_add_events_subscribe' );
function k9_add_events_subscribe() {
  //class
  $class =  apply_filters( 'tc_social_header_block_class', 'span5' );
  ob_start();
?>
  <div class="social-block <?php echo $class ?>">
    <?php if ( 0 != tc__f( '__get_option', 'tc_social_in_header') ) : ?>
      <?php echo tc__f( '__get_socials' ) ?>
        <!-- Begin MailChimp Signup Form -->
        <form action="//sfk9unit.us12.list-manage.com/subscribe/post?u=d95a16f47be2acdbbff34e7f8&amp;id=c2216663af" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Fetch Email" required>
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_d95a16f47be2acdbbff34e7f8_c2216663af" tabindex="-1" value=""></div>
          <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" style>
        </form>
        
        <!--End mc_embed_signup-->
      <?php endif; ?>
  </div>
<?php
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
}