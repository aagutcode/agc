<?php /* AGC Video Player Shortcode */
function video_player_callback($attr){
  $params = shortcode_atts(array(
    'local_video' => '',
    'video_id' => '',
    'class' => ''
  ), $attr);
  $video = '';
  if($params["video_id"]){
    $video = '<iframe src="https://www.youtube.com/embed/'.$params["video_id"].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
  } else if($params['local_video']){
    $video_url = wp_get_attachment_url($params["local_video"]);
    $video = '<video role="presentation" autoplay="" preload="auto" controls src="'.$video_url.'"></video>';
  }


  $block = '
  <div class="agc-video-player '.$params['class'].'">
      <div class="video-container">
        '.$video.'
      </div>
  </div>';
 return $block;
}
add_shortcode('agc_video_player', 'video_player_callback');

function vc_map_video_player(){
  vc_map([
    "category" => "agutcode",
    "name" => __("Video Player", "agutcode"),
    "base" => "agc_video_player",
    "icon" => "icon-wpb-film-youtube",
    "show_settings_on_create" => true,
    "params" => array(
      array(
        "type" => "file_picker",
        "class" => "",
        "heading" => __( "Video", "js_composer" ),
        "param_name" => "local_video",
        "description" => __("Local Video", "agutcode")
      ),
      array(
        "type" => "textfield",
        "heading" => __("ID video Youtube", "agutcode"),
        "param_name" => "video_id",
        "description" => __("Agrege el ID del video de Youtube Ej: 3d2egGs3qzc (https://www.youtube.com/watch?v=3d2egGs3qzc)", "agutcode"),
        "admin_label"   => true
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra Class", "agutcode"),
        "param_name" => "class",
        "description" => __("Add extra class to elements", "agutcode")
      )
    )
  ]);
}
add_action('vc_before_init', 'vc_map_video_player');