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