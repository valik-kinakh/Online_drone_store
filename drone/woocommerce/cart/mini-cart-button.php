<?php   global $woocommerce; ?>
<div class="apus-topcart">
 <div id="cart" class="dropdown version-1">
        
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'drone'); ?>">
            <span class="text-skin cart-icon">
                <i class="fa fa-cart-plus"></i>
            </span>
        </a>            
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>    