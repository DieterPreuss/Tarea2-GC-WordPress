<?php
/*
Plugin Name: Proyectos
Plugin URI: http://www.yourpluginurlhere.com/
Version: 1
Author: Dieter
Description: CPT Proyectos
*/

// La función no será utilizada antes del 'init'.
add_action( 'init', 'ctp_proyectos' );
/* Etiquetas customizadas */
function ctp_proyectos() {
	$labels = array(
	'name' => _x( 'Proyectos', 'post type general name' ),
        'singular_name' => _x( 'Proyecto', 'post type singular name' ),
        'add_new' => _x( 'Añadir nuevo', 'book' ),
        'add_new_item' => __( 'Añadir nuevo Proyecto' ),
        'edit_item' => __( 'Editar Proyectos' ),
        'new_item' => __( 'Nuevo Proyectos' ),
        'view_item' => __( 'Ver Proyectos' ),
        'search_items' => __( 'Buscar Proyectos' ),
        'not_found' =>  __( 'No se han encontrado Proyectos' ),
        'not_found_in_trash' => __( 'No se han encontrado Proyectos en la papelera' ),
        'parent_item_colon' => ''
    );
 
    // Creamos un array para $args
    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
		'show_in_rest' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor',  'thumbnail', 'excerpt', 'custom-fields' )
    );
 
    register_post_type( 'proyecto', $args ); /* Registramos y a funcionar */
}

// Lo enganchamos en la acción init y llamamos a la función crear_taxonomias_peliculas() cuando arranque
add_action( 'init', 'crear_taxonomias_proyectos', 0 );
 
// Creamos dos taxonomías, género y director para el custom post type "pelicula"
function crear_taxonomias_proyectos() {
	// Añadimos nueva taxonomía y la hacemos jerárquica (como las categorías por defecto)
	$labels = array(
	'name' => _x( 'Empresas', 'taxonomy general name' ),
	'singular_name' => _x( 'Empresa', 'taxonomy singular name' ),
	'search_items' =>  __( 'Buscar por Empresa' ),
	'all_items' => __( 'Todas las Empresas' ),
	'parent_item' => __( 'Empresa padre' ),
	'parent_item_colon' => __( 'Empresa padre:' ),
	'edit_item' => __( 'Editar Empresa' ),
	'update_item' => __( 'Actualizar Empresa' ),
	'add_new_item' => __( 'Añadir nuevo Empresa' ),
	'new_item_name' => __( 'Nombre de la nueva Empresa' ),
	);
	register_taxonomy( 'empresa', array( 'proyecto' ), array(
		'hierarchical' => true,
		'labels' => $labels, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'empresa' ),
	));
	// Añado otra taxonomía, esta vez no es jerárquica, como las etiquetas.
	/*
	$labels = array(
		'name' => _x( 'Director', 'taxonomy general name' ),
		'singular_name' => _x( 'Director', 'taxonomy singular name' ),
		'search_items' =>  __( 'Buscar Director' ),
		'popular_items' => __( 'Director populares' ),
		'all_items' => __( 'Todos los directores' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Editar Director' ),
		'update_item' => __( 'Actualizar Director' ),
		'add_new_item' => __( 'Añadir nuevo Director' ),
		'new_item_name' => __( 'Nombre del nuevo Director' ),
		'separate_items_with_commas' => __( 'Separar Director por comas' ),
		'add_or_remove_items' => __( 'Añadir o eliminar Director' ),
		'choose_from_most_used' => __( 'Escoger entre los Director más utilizados' )
	);
	 
	register_taxonomy( 'director', 'proyecto', array(
		'hierarchical' => false,
		'labels' => $labels, // ADVERTENCIA: Aquí es donde se utiliza la variable $labels 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'director' ),
	));
	*/
} 

add_action( 'pre_get_posts', 'agregar_proyectos_listado' );

function agregar_proyectos_listado( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'page', 'proyecto' ) );
	return $query;
}


add_action( 'add_meta_boxes', 'proyectos_metabox' );


function proyectos_metabox()
{
	add_meta_box( 'my-meta-box-id', 'Datos adicionales', 'proyectos_metabox_c', 'proyecto', 'normal', 'high' );
}

function proyectos_metabox_c($post){
	$values = get_post_custom( $post->ID );
	$empresa = isset( $values['empresa'] ) ? esc_attr( $values['empresa'][0] ) : '';
	$link = isset( $values['link'] ) ? esc_attr( $values['link'][0] ) : '';
	$fecha = isset( $values['fecha'] ) ? esc_attr( $values['fecha'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
	<p>
		<label for="empresa">Empresa</label>
		<input type="text" name="empresa" id="empresa" value="<?php echo $empresa; ?>" />
    </p>
    <p>
		<label for="fecha">Fecha</label>
		<input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>" />
    </p>
	<p>
		<label for="link">Link</label>
		<input type="text" name="link" id="link" value="<?php echo $link; ?>" />
    </p>
	<?php
	/*
	$año = isset( $values['año'] ) ? esc_attr( $values['año'][0] ) : '';
	$duracion = isset( $values['duracion'] ) ? esc_attr( $values['duracion'][0] ) : '';
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
	<p>
		<label for="año">Año</label>
		<input type="text" name="año" id="año" value="<?php echo $año; ?>" />
    </p>
    <p>
		<label for="año">Duración</label>
		<input type="text" name="duracion" id="duracion" value="<?php echo $duracion; ?>" />
    </p>
    */
    
}

register_rest_field( 'proyecto', 'meta', array(
'get_callback' => function ( $data ) {
    return get_post_meta( $data['id'], '', '' );
}, ));

add_action( 'save_post', 'proyectos_metabox_save' );

function proyectos_metabox_save($post_id){
	// Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
 
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;
 
    // now we can actually save the data  
    $allowed = array(
        'a' => array( // on allow a tags  
            'href' => array() // and those anchors can only have href attribute  
        )
    );
 
    // Make sure your data is set before trying to save it  
    if( isset( $_POST['empresa'] ) )
        update_post_meta( $post_id, 'empresa', wp_kses( $_POST['empresa'], $allowed ) );
    if( isset( $_POST['fecha'] ) )
        update_post_meta( $post_id, 'fecha', wp_kses( $_POST['fecha'], $allowed ) );
	if( isset( $_POST['link'] ) )
        update_post_meta( $post_id, 'link', wp_kses( $_POST['link'], $allowed ) );
 
}


?>