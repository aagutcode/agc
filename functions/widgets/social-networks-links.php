<?php /* Social Network Links Widgets */
class social_media_Widget extends WP_Widget {
    public function __construct() {
        $widget_options = array( 
          'classname' => 'social_media_widget',
          'description' => 'Widget to display social media links.',
        );
        parent::__construct( 'social_media_widget', 'Social Networks', $widget_options );
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        $facebook = apply_filters( 'widget_title', $instance[ 'facebook' ] );
        $twitter = apply_filters( 'widget_title', $instance[ 'twitter' ] );
        $instagram = apply_filters( 'widget_title', $instance[ 'instagram' ] );
        $linkedin = apply_filters( 'widget_title', $instance[ 'linkedin' ] );
        $mail = apply_filters( 'widget_title', $instance[ 'mail' ] );
        echo $args['before_widget']; ?>
        <?php if($title !== ''){ ?>
            <h3><?php echo $title; ?></h3>
        <?php } ?>
        <ul class="social-networks">
            <?php if($facebook !== ''){ ?>
                <li><a href="<?php echo $facebook; ?>" target="_blank" class="icon-facebook"></a></li>
            <?php } if($linkedin !== ''){ ?>
                <li><a href="<?php echo $linkedin; ?>" target="_blank" class="icon-linkedin"></a></li>
            <?php } if($instagram !== ''){ ?>
                <li><a href="<?php echo $instagram; ?>" target="_blank" class="icon-instagram"></a></li>
            <?php } if($twitter !== ''){ ?>
                <li><a href="<?php echo $twitter; ?>" target="_blank" class="icon-twitter"></a></li>
            <?php } if($mail !== ''){ ?>
                <li><a href="mailto:<?php echo $mail; ?>" target="_blank" class="icon-mail"></a></li>
            <?php } ?> 
        </ul>

        <?php echo $args['after_widget'];
    }
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $facebook = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
        $instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
        $linkedin = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
        $twitter = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
        $mail = ! empty( $instance['mail'] ) ? $instance['mail'] : ''; ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Título :</label><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook :</label><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $facebook ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter:</label><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $twitter ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('instagram'); ?>">Instagram:</label><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_attr( $instagram ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('linkedin'); ?>">Linkedin:</label><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $linkedin ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('mail'); ?>">Mail:</label><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'mail' ); ?>" name="<?php echo $this->get_field_name( 'mail' ); ?>" value="<?php echo esc_attr( $mail ); ?>" /></p>
        <?php 
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        $instance[ 'facebook' ] = strip_tags( $new_instance[ 'facebook' ] );
        $instance[ 'twitter' ] = strip_tags( $new_instance[ 'twitter' ] );
        $instance[ 'instagram' ] = strip_tags( $new_instance[ 'instagram' ] );
        $instance[ 'linkedin' ] = strip_tags( $new_instance[ 'linkedin' ] );
        $instance[ 'mail' ] = strip_tags( $new_instance[ 'mail' ] );
        return $instance;
    }
}
function register_social_media_widget() { 
  register_widget( 'social_media_Widget' );
}
add_action( 'widgets_init', 'register_social_media_widget' );
