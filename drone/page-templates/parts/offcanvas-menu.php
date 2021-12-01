<div id="apus-mobile-menu" class="apus-offcanvas hidden-lg hidden-md"> 
    <div class="apus-offcanvas-body">
        <div class="offcanvas-head bg-primary">
            <button type="button" class="btn btn-toggle-canvas btn-danger" data-toggle="offcanvas">
                <i class="fa fa-close"></i> 
            </button>
            <strong><?php esc_html_e( 'MENU', 'drone' ); ?></strong>
        </div>
        
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <?php
                    $args = array(
                        'theme_location' => 'primary',
                        'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb' => '',
                        'menu_id' => 'main-mobile-menu',
                        'walker' => new Drone_Mobile_Menu()
                    );
                    wp_nav_menu($args);
                ?>
            </nav>
        <?php endif; ?>

    </div>
</div>