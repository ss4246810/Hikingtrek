<?php
/**
 * Search Section
 * 
 * @package Travel_Agency_Pro
 */

$ed_search = get_theme_mod( 'ed_search_bar', true );
if( is_wte_advanced_search_active() && $ed_search )
{
 ?>
 <div class="search-panel">
                <div class="header-row">
                    <div class="container">
                    <span>Find a Trip</span>
                    </div>
                </div>
                <div class="input-row">
                    <div class="container">
                    <div class="gh-act-search-row">
                            <div class="gh-act-search"> 
                            <?php echo do_shortcode( '[Wte_Advanced_Search_Form]' ); ?>                            
                            </div>
                          </div>
                  </div>
                </div>
            </div>
<?php
}