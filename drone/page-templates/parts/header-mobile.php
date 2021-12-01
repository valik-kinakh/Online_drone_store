<div class="header-mobile hidden-lg hidden-md clearfix">
    <div class="container">
    <div class="row">
        <div class="col-xs-3">
            <div class="active-mobile pull-left">
                <button data-toggle="offcanvas" class="btn btn-sm btn-danger btn-offcanvas btn-toggle-canvas offcanvas" type="button">
                   <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="setting-popup pull-left">
                <div class="dropdown">
                    <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-user"></span></button>
                    <div class="dropdown-menu">
                        <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
                            <div class="pull-left">
                                <?php
                                    $args = array(
                                        'theme_location'  => 'topmenu',
                                        'container_class' => '',
                                        'menu_class'      => 'menu-topbar'
                                    );
                                    wp_nav_menu($args);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <?php
                $logo = drone_apus_get_config('media-mobile-logo');
            ?>

            <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php else: ?>
                <div class="logo logo-theme">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/mobile-logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xs-3">
            <div class="topbar-inner">
                <div class="search-popup pull-right">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-search"></span></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
                        </div>
                    </div>
                </div>
                <div class="active-mobile top-cart pull-right">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-shopping-cart"></span></button>
                        <div class="dropdown-menu">
                            <div class="widget_shopping_cart_content"></div>
                        </div>
                    </div>
                    
                </div>  
            </div>
        </div>
    </div>
    </div>
</div>