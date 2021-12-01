<?php $thumbsize = isset($thumbsize) ? $thumbsize : 'medium';?>
<?php
  $post_category = "";
  $categories = get_the_category();
  $separator = ' | ';
  $output = '';
  if($categories){
    foreach($categories as $category) {
      $output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'drone' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
    }
  $post_category = trim($output, $separator);
  }      
?>
<article class="post">
    <?php
    if ( has_post_thumbnail() ) {
        ?>
            <figure class="entry-thumb effect-v6">
                <a href="<?php the_permalink(); ?>" title="" class="entry-image">
                    <?php 
                        $post_thumbnail = wpb_getImageBySize( array( 'post_id' => get_the_ID(), 'thumb_size' => $thumbsize ) );
                        echo $post_thumbnail['thumbnail'];
                    ?>
                </a>
                <!-- vote    -->
                <?php do_action('drone_show_rating') ?>
                 <div class="category ">
                    <?php echo trim($post_category); ?>
                </div>
            </figure>
        <?php
    }
    ?>
    <div class="entry-content">
        <div class="entry-meta">
            <?php
                if (get_the_title()) {
                ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php
            }
            ?>
             <div class="entry-create">
                <span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
                <span class="author"><?php esc_html_e('/ By ', 'drone'); the_author_posts_link(); ?></span>
            </div>
        </div>
        <?php
            if (! has_excerpt()) {
                echo "";
            } else {
                ?>
                    <div class="entry-description"><?php echo drone_apus_substring( get_the_excerpt(), 100, '...' ); ?></div>
                <?php
            }
        ?>

    </div>
</article>