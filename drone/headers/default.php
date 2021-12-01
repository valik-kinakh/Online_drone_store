<header id="apus-header" class="hidden-sm hidden-xs site-header header-default <?php echo (drone_apus_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                <div class="row">
                    <!-- LOGO -->
                    <div class="logo-in-theme col-md-2">
                        <?php get_template_part( 'page-templates/parts/logo' ); ?>
                    </div>
                    <!-- //LOGO -->
                    <div class="main-content-header col-md-10 hidden-sm hidden-xs">

                        <div class="pull-right  header-setting">
                            <?php if ( has_nav_menu( 'topmenu' ) ): ?>
                            <div class="dropdown pull-right">
                                <button class="button-setting" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-setting fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php
                                        $args = array(
                                            'theme_location'  => 'topmenu',
                                            'menu_class'      => 'apus-menu-top ',
                                            'fallback_cb'     => '',
                                            'menu_id'         => 'topmenu'
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                </div>
                            </div>
                            <?php endif; ?>
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
                            <div class="pull-right">
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