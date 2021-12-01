<?php
   $job = get_post_meta( get_the_ID(), 'apus_testimonial_job', true );
?>
<div class="testimonials-body testimonials-v1">
   <div class="testimonials-profile"> 
      <div class="wrapper-avatar">
         <div class=" testimonial-avatar">
         <?php the_post_thumbnail('widget') ?>
         </div>
      </div>
      <div class="testimonial-meta">
         <h3 class="name-client"> <?php the_title(); ?></h3>
         <div class="job"><?php echo $job; ?></div>
      </div> 
   </div> 
   <div class="description"><?php the_content() ?></div>
</div>