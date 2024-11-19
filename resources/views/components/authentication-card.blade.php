<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div>
        {{ $logo }}
    </div>

    <div class="content-container">
        {{ $slot }}
    </div>
</div>

<style>
    /* Estilos por defecto (modo claro) */
    .min-h-screen {
        background-color: #f7fafc;
        /* Color de fondo claro */
    }

    .logo-container {
        margin-bottom: 20px;
        /* Espacio entre el logo y el contenido */
    }

    .content-container {
        width: 100%;
        max-width: 480px;
        margin-top: 24px;
        padding: 24px;
        background-color: #ffffff;
        /* Fondo blanco */
        border-radius: 12px;
        /* Bordes redondeados */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Sombra para el contenedor */
        border: 2px solid #e2e8f0;
        /* Bordes sutiles para destacar el contenedor */
    }

    /* Estilos cuando el modo oscuro está activado */
    @media (prefers-color-scheme: dark) {
        .min-h-screen {
            background-color: #212529;
            /* Fondo oscuro */
        }

        .content-container {
            background-color: #212529;
            /* Fondo oscuro para el contenido */
            color: #ffffff;
            /* Texto blanco en modo oscuro */
            border-color: #444444;
            /* Bordes de color más oscuro en modo oscuro */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            /* Sombra más pronunciada en modo oscuro */
        }
    }
</style>
