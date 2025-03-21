<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <!-- Menú de navegación con hamburguesa -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Nombre del sitio -->
                <a class="navbar-brand" href="<?php echo home_url(); ?>">
    <img src="http://localhost/wordpress/wp-content/uploads/2025/03/43.png" alt="<?php bloginfo('name'); ?>" class="img-fluid" />
</a>

                <!-- Botón hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menú -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main_menu', // Nombre del menú registrado
                        'container' => false,  // No envolver el menú en un contenedor adicional
                        'menu_class' => 'navbar-nav d-flex justify-content-center mt-2', // Cambia a esto
                        'depth' => 2, // Para mostrar submenús
                    ));
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <?php wp_footer(); ?>
</body>
</html>
