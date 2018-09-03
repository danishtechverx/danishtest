<?php if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}
date_default_timezone_set("America/Santiago");
$meses=array("","enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$ahora=date('Y-m-d H:i:s');

register_nav_menus( array(
	'menu'=>__('Menú', 'mokaller'),
));


function mokaller_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'mokaller' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'mokaller' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	));
	
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'mokaller' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'mokaller' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	));
}
add_action('widgets_init','mokaller_widgets_init');

if( !is_admin()){
	wp_deregister_script('jquery');
	wp_register_script('jquery', (""), false, '');
	wp_enqueue_script('jquery');
}

function extraerUrl($string,$return_always_array=FALSE) {
    $myarray = array();
    if (preg_match_all('/<img\s+.*?src=[\"\']?([^\"\' >]*)[\"\']?[^>]*>/i', $string, $matches, PREG_SET_ORDER))  {
        foreach ($matches as $match) {
            $myarray[] = $match[1];
        }
    }
    if ($return_always_array === FALSE && count($myarray) == 1 ) $myarray = array_pop($myarray);
    return $myarray;
}

function detectarExtension($url){
	$x=explode(".",$url);
	return $x[count($x)-1];
}

function validar( $variable, $tam ){
	$va=htmlspecialchars($va,ENT_QUOTES,"UTF-8");
	if(get_magic_quotes_gpc()){ $va=stripslashes($va); }
	$va=str_replace("\r\n","",nl2br($va));
	$va=substr ($variable, 0, $tam);
	return $va;
}

function varget($valor, $vacio, $tam){
	if (empty($_GET[$valor])) { $res=$vacio; }
	else { $res=validar($_GET[$valor],$tam); }
	return $res;
}

function varpost($valor, $vacio, $tam){
	if (empty($_POST[$valor])) { $res=$vacio; }
	else { $res=validar($_POST[$valor],$tam); }
	return $res;
}

function varcookie($valor, $vacio, $tam){
	if (empty($_COOKIE[$valor])) { $res=$vacio; }
	else { $res=validar($_COOKIE[$valor],$tam); }
	return $res;
}

function enviarEmail($asunto,$mensaje,$de="",$para,$emailRespuesta=""){
	$dominio="http://".$_SERVER['HTTP_HOST'];
						
	// Para enviar correo HTML, la cabecera Content-type debe definirse
	$cabeceras  = "MIME-Version: 1.0\r\n";
	$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
	//$cabeceras .= "To: $para\r\n";
	if($de){ $cabeceras .= "From: $de\r\n"; }
	if($emailRespuesta){
		$cabeceras .= "Reply-To: $emailRespuesta\r\n";
	}
	
	$mensajeHTML="
	<html>
		<head>
			<title>$asunto</title>
		</head>
		
		<body>
			$mensaje
		</body>
	</html>
	";
	
	// Enviarlo
	return wp_mail($para,$asunto,$mensajeHTML,$cabeceras);
}

function fechaHora($dato,$formato){
	global $meses;
	$fechaHora=explode(" ",$dato);
	$fecha=$fechaHora[0];
	$fecha=explode("-",$fecha);
	if($formato==1){ $fecha=$fecha[2]."/".$fecha[1]."/".$fecha[0]; }
	if($formato==2){
		$mes=(int)$fecha[1];
		$fecha=$fecha[2]." de ".$meses[$mes]." de ".$fecha[0];
	}
	if($formato==3){ $fecha=$fecha[2].".".$fecha[1].".".substr($fecha[0],2,2); }
	$hora=$fechaHora[1];
	
	return array($fecha,$hora);
}

function get_category_id($slug){
	$category=get_category_by_slug($slug);
	return $category->term_id;
}

function the_parent_slug() {
  global $post;
  if($post->post_parent == 0) return '';
  $post_data = get_post($post->post_parent);
  return $post_data->post_name;
}

function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function parent_category($catid) {
	while($catid){
		$cat=get_category($catid);
		$catid=$cat->category_parent;
		$catParent=$cat->slug;
	}
	return $catParent;
}

function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = &get_category($cat_id);
	return $category->slug;
}

function get_meta_values($key='',$type='post',$status='publish'){
	global $wpdb;
	
	if(empty($key))
	return;
	
	$r=$wpdb->get_col( $wpdb->prepare("SELECT pm.meta_value FROM {$wpdb->postmeta} pm	LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id	WHERE pm.meta_key='%s' AND p.post_status='%s' AND p.post_type='%s'", $key, $status, $type));
	return $r;
}

function ul_to_array ($ul) {
	if (is_string($ul)) {
		if (!$ul = simplexml_load_string("$ul")) {
			trigger_error("Syntax error in UL/LI structure");
			return FALSE;
		}
		return ul_to_array($ul);
	}
	else if (is_object($ul)) {
		$output = array();
		foreach ($ul->li as $li) {
			$output[] = (isset($li->ul)) ? ul_to_array($li->ul) : (string) $li;
		}
		return $output;
	} 
	else return FALSE;
}							

function crearSlug($str,$default="-") {
	$str=strtolower($str);
	$buscar=array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ','ä','ë','ï','ö','ü','Ä','Ë','Ï','Ö','Ü');
	$reemplazar=array('a','e','i','o','u','n','A','E','I','O','U','N','a','e','i','o','u','a','e','i','o','u');
	$str=str_replace($buscar,$reemplazar,$str);
	$tempStr=str_split($str);
	$str="";
	foreach($tempStr as $t){
		  if( !( (ord($t)>=97 and ord($t)<=122) || (ord($t)>=48 and ord($t)<=57) )){ $str.=$default; }
		  else{ $str.=$t; }
	}
	return $str;
}

function add_image_responsive_class($content) {
   global $post;
   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
   $replacement = '<img$1class="$2 img-responsive"$3>';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}
add_filter('the_content', 'add_image_responsive_class');

function change_category_order($query){
    if($query->is_category() && $query->is_main_query()){
        $query->set('order','ASC');
    }
}
add_action('pre_get_posts','change_category_order');

add_filter('wpseo_canonical','__return_false');

function custom_blog(){
	// Fire this during init
	register_post_type('magazin', array(
		'label' => __('Blog'),
		'singular_label' => __('Blog'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'rewrite' => array('slug'=>'magazin'),
		'hierarchical' => false,
		'query_var' => false,
		'supports' => array('title', 'editor','thumbnail'),
		'can_export'=>true,
		'has_archive'=> 'magazin',
		'exclude_from_search'=>false,
		'publicly_queryable'=>true,
	));
}
add_action( 'init', 'custom_blog', 0);

function custom_destinations(){
	// Fire this during init
	register_post_type('reiseziele', array(
		'label' => __('Destinations'),
		'singular_label' => __('Destinations'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'rewrite' => array('slug'=>'reiseziele'),
		'hierarchical' => false,
		'query_var' => false,
		'supports' => array('title', 'editor','thumbnail'),
		'can_export'=>true,
		'has_archive'=> true,
		'exclude_from_search'=>false,
		'publicly_queryable'=>true,
	));
}
add_action( 'init', 'custom_destinations', 0);

function custom_regions(){
	// Fire this during init
	register_post_type('regions', array(
		'label' => __('Regions'),
		'singular_label' => __('Regions'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'rewrite' => array('slug'=>'regions'),
		'hierarchical' => false,
		'query_var' => false,
		'supports' => array('title', 'editor','thumbnail'),
		'can_export'=>true,
		'has_archive'=> true,
		'exclude_from_search'=>false,
		'publicly_queryable'=>true,
	));
}
add_action( 'init', 'custom_regions', 0);

function taxonomies_tours(){
	register_taxonomy('reisen-liste', array('reisen'), array(
		'labels' => array(
			'name' => 'Tours categories'
		),
		'public' => true,
		'show_ui' => true,
		'show_tagcloud' => false,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite'       => array( 
			'slug'          => 'reisen-liste',
			'hierarchical'  => true,
		),
	));
}
add_action( 'init','taxonomies_tours');

function custom_tours(){
	// Fire this during init
	register_post_type('reisen', array(
		'label' => __('Tours'),
		'singular_label' => __('Tours'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'rewrite' => array('slug'=>'reisen'),
		'hierarchical' => false,
		'query_var' => false,
		'supports' => array('title', 'editor','thumbnail'),
		'can_export'=>true,
		'has_archive'=> true,
		'exclude_from_search'=>false,
		'publicly_queryable'=>true,
	));
}
add_action( 'init', 'custom_tours', 0);

function custom_faqs(){
	// Fire this during init
	register_post_type('faqs', array(
		'label' => __('FAQ'),
		'singular_label' => __('FAQ'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'rewrite' => array('slug'=>'faqs'),
		'hierarchical' => false,
		'query_var' => false,
		'supports' => array('title', 'editor','thumbnail'),
		'can_export'=>true,
		'has_archive'=> true,
		'exclude_from_search'=>false,
		'publicly_queryable'=>true,
	));
}
add_action( 'init', 'custom_faqs', 0);

function custom_form(){
	// Fire this during init
	register_post_type('form', array(
		'labels' => array(
		'name' => 'Form',
		'all_items' => 'Form'
	),
	'public' => true,
	'has_archive' => 'form',
	'rewrite' => array('slug' => 'form'),
	'exclude_from_search' => false,
	'supports' => array('title', 'editor', 'thumbnail'),
	));
}
add_action('init','custom_form',0);

function custom_slide(){
	// Fire this during init
	register_post_type('slide', array(
		'label' => __('Slide'),
		'singular_label' => __('Slide'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'rewrite' => false,
		'hierarchical' => false,
		'query_var' => false,
		'supports' => array('title', 'editor','thumbnail'),
		'can_export'=>true,
		'has_archive'=> true,
		'exclude_from_search'=>false,
		'publicly_queryable'=>true,
	));
}
add_action( 'init', 'custom_slide', 0);

function disable_wp_emojicons() {
// remove all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7 );
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
}
add_action('init', 'disable_wp_emojicons');

// remove Yoast Version
if (defined('WPSEO_VERSION')) {
    add_action('wp_head',function() { ob_start(function($o) {
        return preg_replace('/^\n?<!--.*?[Y]oast.*?-->\n?$/mi','',$o);
    }); },~PHP_INT_MAX);
}