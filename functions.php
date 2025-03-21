<?php
// Funciones para el tema
function deportemas_setup() {
    // Registrar menús
    register_nav_menus(array(
        'main_menu' => 'Menú Principal', 
    ));

    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'deportemas_setup');

// Encolar scripts y estilos
function deportemas_scripts() {
    // Bootstrap CSS desde CDN
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');

    // jQuery para Bootstrap
    wp_enqueue_script('jquery');

    // Bootstrap CDN 
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);

    // Estilos del tema
    wp_enqueue_style('deportemas-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'deportemas_scripts');




// API football 
function get_futbol_data() {
    $url = 'https://api.football-data.org/v4/competitions/PD/standings';
    $args = array(
        'headers' => array(
            'X-Auth-Token' => 'a16bd86af13c4dc399d60c4c0a3b4259'  // 'tu-token-api' Insertar token (Token gratuito de prueba - 10 consultas por min)
                                                                    // 'X-Auth-Token' => getenv('FOOTBALL_API_KEY') // Usar .env para mayor seguridad en proyecto desplegado

        ),
    );
    $response = wp_remote_get($url, $args);
    
    if (is_wp_error($response)) {
        return 'Error al obtener datos';
    }
    
    $body = wp_remote_retrieve_body($response);
    return json_decode($body, true);
}

function display_futbol_standings() {
    $data = get_futbol_data(); // Llamar datos

    if (isset($data['standings'])) {
        $output = '<div class="futbol-standings-container">'; // Contenedor para scroll
        $output .= '<table class="table table-striped">';
        $output .= '<thead><tr><th>Posición</th><th>Equipo</th><th>Puntos</th></tr></thead><tbody>';
        
        foreach ($data['standings'][0]['table'] as $team) {
            $team_name = $team['team']['name'];
            $team_flag = isset($team['team']['crest']) ? $team['team']['crest'] : ''; // Agregar bandera

            // Equipo junto con su bandera
            $output .= '<tr>';
            $output .= '<td>' . $team['position'] . '</td>';
            if ($team_flag) {
                $output .= '<td><img src="' . $team_flag . '" alt="' . $team_name . '" style="width: 20px; margin-right: 10px;" />' . $team_name . '</td>';
            } else {
                $output .= '<td>' . $team_name . '</td>';
            }
            $output .= '<td>' . $team['points'] . '</td>';
            $output .= '</tr>';
        }
        
        $output .= '</tbody></table>';
        $output .= '</div>'; // Cierra el contenedor de la tabla con scroll
        return $output;
    }
    return 'No se pudo obtener la información de la clasificación';
}


add_shortcode('futbol_standings', 'display_futbol_standings');


?>
