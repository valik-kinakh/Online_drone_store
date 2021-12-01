<header id="apus-header" class="site-header hidden-sm hidden-xs  header-v2 <?php echo (drone_apus_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
	<div id="apus-topbar" class="apus-topbar hidden-sm hidden-xs">
		<div class="container">
            <div class="topbar-inner clearfix">
                
                <div class="user-login pull-left">
                    <ul class="list-inline acount">
                        <?php if( !is_user_logged_in() ){ ?>
                            <li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Login','drone'); ?>"> <?php esc_html_e('Login', 'drone'); ?> </a></li>
                            <li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Register','drone'); ?>"> <?php esc_html_e('Register', 'drone'); ?> </a></li>
                        <?php }else{ ?>
                            <?php $current_user = wp_get_current_user(); ?>
                          <li>  <span class="hidden-xs"><?php esc_html_e('Welcome ','drone'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
                          <li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php esc_html_e('Logout ','drone'); ?></a></li>
                        <?php } ?>
                    </ul>   
                </div>

                <?php if ( is_active_sidebar('info-topbar') ): ?>
                    <div class="pull-left info-topbar">
                        <?php dynamic_sidebar('info-topbar'); ?>
                    </div>
                <?php endif; ?>

                <?php if ( is_active_sidebar('social-topbar') ): ?>
                    <div class="pull-right social-topbar">
                        <?php dynamic_sidebar('social-topbar'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div> 
	</div>

	<div class="header-main clearfix">
        <div class="container">
            <div class="header-center-inner clearfix">
                <div class="row">
                    <!-- LOGO -->
                    <div class="logo-in-theme col-md-2">
                        <?php get_template_part( 'page-templates/parts/logo' ); ?>
                    </div>
                    <!-- //LOGO -->
                    <div class="logo-in-theme col-md-10 hidden-sm hidden-xs">

                        <div class="pull-right header-setting">
                            <?php if ( defined('DRONE_WOOCOMMERCE_ACTIVED') && DRONE_WOOCOMMERCE_ACTIVED ): ?>
                                <div class="pull-right">
                                    <!-- Setting -->
                                    <div class="top-cart hidden-xs">
                                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="apus-search pull-right">
                               <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
                            </div>
                        </div>


                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="pull-right site-header-mainmenu ">
                                <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                <?php
                                    $args = array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse',
                                        'menu_class' => 'nav navbar-nav megamenu',
                                        'fallback_cb' => '',
                                        'menu_id' => 'primary-menu',
                                        'walker' => new Drone_Apus_Nav_Menu()
                                    );
                                    wp_nav_menu($args);
                                ?>
                                </nav>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
	</div>
</header>