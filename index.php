<?php
// ==========================================
// LÓGICA DE PROCESAMIENTO DE FORMULARIO (PHP)
// ==========================================
$mensaje_estado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización básica de los datos recibidos
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["mensaje"]);

    // Validación
    if (empty($nombre) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje_estado = "Por favor, completa el formulario correctamente.";
    } else {
        // Configuración del correo
        $destinatario = "campomax82@gmail.com";
        $asunto = "Nuevo contacto desde Portafolio de $nombre";
        $contenido = "Nombre: $nombre\n";
        $contenido .= "Email: $email\n\n";
        $contenido .= "Mensaje:\n$mensaje\n";
        $headers = "From: $nombre <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Envío del correo (funciona en hostings tradicionales con mail() habilitado)
        if (mail($destinatario, $asunto, $contenido, $headers)) {
            $mensaje_estado = "¡Mensaje enviado con éxito! Te contactaré pronto.";
        } else {
            $mensaje_estado = "Hubo un error al enviar el mensaje. Inténtalo de nuevo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta tags SEO -->
    <title>Max Campoverde | Portafolio Profesional IT</title>
    <meta name="description" content="Portafolio profesional de Max Campoverde, Bachiller Técnico en Informática especializado en desarrollo web, redes, y soporte técnico experto.">
    <meta name="author" content="Max Campoverde">
    
    <!-- Configuración de Tailwind CSS vía CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        midnight: '#0A192F',       // Fondo principal
                        cyanAccent: '#64FFDA',     // Color de acento
                        platinum: '#CCD6F6',       // Texto principal
                        whitePure: '#FFFFFF',      // Resaltados
                        darkCard: '#112240',       // Fondos de tarjetas
                        lightNavy: '#233554'       // Bordes y separadores
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Iconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation CSS para scroll dinámico -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- CSS Personalizado -->
    <style>
        body {
            background-color: #0A192F;
            color: #CCD6F6;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        /* Personalización de barra de desplazamiento */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #0A192F; }
        ::-webkit-scrollbar-thumb { background: #233554; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #64FFDA; }
        
        /* Utilidad de Glassmorphism */
        .glass {
            background: rgba(17, 34, 64, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(100, 255, 218, 0.1);
        }
        
        /* Texto con gradiente para destacar */
        .text-gradient {
            background: linear-gradient(90deg, #64FFDA, #CCD6F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Estilos interactivos para la navegación */
        .nav-link {
            position: relative;
            color: #CCD6F6;
            transition: color 0.3s;
        }
        .nav-link:hover { color: #64FFDA; }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #64FFDA;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }
        
        /* Corrección visual para el autocompletado en navegadores (modo oscuro) */
        input:-webkit-autofill,
        textarea:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #112240 inset !important;
            -webkit-text-fill-color: #CCD6F6 !important;
        }
    </style>
</head>
<body class="antialiased selection:bg-cyanAccent selection:text-midnight">

    <!-- ========================================== -->
    <!-- BARRA DE NAVEGACIÓN -->
    <!-- ========================================== -->
    <nav class="fixed w-full z-50 glass shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold text-cyanAccent tracking-tighter">&lt;Max.C/&gt;</a>
                </div>
                <!-- Menú Desktop -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#inicio" class="nav-link text-sm font-semibold uppercase tracking-wider">Inicio</a>
                    <a href="#academico" class="nav-link text-sm font-semibold uppercase tracking-wider">Académico</a>
                    <a href="#habilidades" class="nav-link text-sm font-semibold uppercase tracking-wider">Habilidades</a>
                    <a href="#portafolio" class="nav-link text-sm font-semibold uppercase tracking-wider">Portafolio</a>
                    <a href="#vision" class="nav-link text-sm font-semibold uppercase tracking-wider">Visión</a>
                    <a href="#contacto" class="px-5 py-2 border border-cyanAccent text-cyanAccent rounded hover:bg-cyanAccent hover:text-midnight transition-colors duration-300 font-semibold text-sm">Contacto</a>
                </div>
                <!-- Botón Menú Móvil -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-cyanAccent hover:text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Contenido Menú Móvil -->
        <div id="mobile-menu" class="hidden md:hidden bg-darkCard border-b border-lightNavy absolute w-full">
            <div class="px-4 pt-2 pb-6 space-y-2 shadow-2xl">
                <a href="#inicio" class="block px-3 py-2 rounded-md text-base font-medium text-platinum hover:text-cyanAccent hover:bg-lightNavy">Inicio</a>
                <a href="#academico" class="block px-3 py-2 rounded-md text-base font-medium text-platinum hover:text-cyanAccent hover:bg-lightNavy">Académico</a>
                <a href="#habilidades" class="block px-3 py-2 rounded-md text-base font-medium text-platinum hover:text-cyanAccent hover:bg-lightNavy">Habilidades</a>
                <a href="#portafolio" class="block px-3 py-2 rounded-md text-base font-medium text-platinum hover:text-cyanAccent hover:bg-lightNavy">Portafolio</a>
                <a href="#vision" class="block px-3 py-2 rounded-md text-base font-medium text-platinum hover:text-cyanAccent hover:bg-lightNavy">Visión</a>
                <a href="#contacto" class="block px-3 py-2 rounded-md text-base font-medium text-cyanAccent hover:bg-lightNavy">Contacto</a>
            </div>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- SECCIÓN HERO / INICIO -->
    <!-- ========================================== -->
    <section id="inicio" class="min-h-screen flex items-center pt-20 relative overflow-hidden">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyanAccent rounded-full mix-blend-multiply filter blur-[128px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 flex flex-col-reverse md:flex-row items-center gap-12">
            <!-- Contenido textual -->
            <div class="w-full md:w-3/5" data-aos="fade-right" data-aos-duration="1000">
                <p class="text-cyanAccent font-mono mb-4">Hola, mi nombre es</p>
                <h1 class="text-5xl md:text-7xl font-bold text-whitePure mb-4 tracking-tight">Max Campoverde.</h1>
                <h2 class="text-3xl md:text-5xl font-bold text-platinum opacity-80 mb-6 text-gradient">Construyo experiencias digitales.</h2>
                <p class="text-lg text-platinum mb-4 font-light max-w-2xl">
                    <strong class="text-cyanAccent">Slogan:</strong> Interfaces intuitivas y soporte técnico experto: tecnología con propósito y de impacto real.
                </p>
                <p class="text-base text-platinum opacity-80 mb-8 max-w-2xl leading-relaxed">
                    Me especializo en transformar ideas en interfaces intuitivas mediante el diseño web potenciado por inteligencia artificial y un aprendizaje acelerado. Gracias a mi experiencia previa en departamentos de nómina, diseño soluciones con una estructura impecable que resuelven problemas de flujo de trabajo y comunicación visual. Aporto el impacto tecnológico que las marcas necesitan para liderar su sector.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#portafolio" class="px-8 py-4 bg-cyanAccent text-midnight font-bold rounded shadow-lg hover:bg-white transition-colors duration-300 transform hover:-translate-y-1">Ver Proyectos</a>
                    <a href="#contacto" class="px-8 py-4 border border-cyanAccent text-cyanAccent font-bold rounded hover:bg-cyanAccent/10 transition-colors duration-300 transform hover:-translate-y-1">Contactar</a>
                </div>
            </div>
            <!-- Fotografía -->
            <div class="w-full md:w-2/5 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-cyanAccent rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative rounded-lg overflow-hidden border-2 border-cyanAccent/30 shadow-2xl">
                        <!-- El usuario debe colocar su foto llamada "foto_perfil.jpg" en el mismo directorio -->
                        <img src="fotos-perfil.jpg" alt="Max Campoverde" class="w-64 h-64 md:w-80 md:h-80 object-cover filter grayscale hover:grayscale-0 transition-all duration-500" onerror="this.src='https://via.placeholder.com/400x400/112240/64FFDA?text=Max+C'">
                        <div class="absolute inset-0 bg-cyanAccent mix-blend-overlay opacity-20 group-hover:opacity-0 transition duration-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECCIÓN PERFIL ACADÉMICO -->
    <!-- ========================================== -->
    <section id="academico" class="py-24 bg-midnight">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-whitePure"><span class="text-cyanAccent font-mono text-xl mr-2">01.</span> Perfil Académico</h2>
                <div class="h-px bg-lightNavy flex-grow ml-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Educación Formal -->
                <div class="glass p-8 rounded-lg" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-bold text-whitePure mb-2">Educación Formal</h3>
                    <p class="text-cyanAccent text-lg mb-4">Unidad Educativa Montepiedra</p>
                    <div class="flex items-start">
                        <i class="fas fa-graduation-cap text-cyanAccent mt-1 mr-3 text-xl"></i>
                        <div>
                            <h4 class="text-whitePure font-semibold">Bachiller Técnico en Informática</h4>
                            <p class="text-platinum opacity-80 mt-2">Formación integral enfocada en desarrollo tecnológico, soporte técnico y ofimática.</p>
                        </div>
                    </div>
                    <!-- Mención de Honor -->
                    <div class="mt-6 p-4 bg-cyanAccent/10 border border-cyanAccent/30 rounded-lg">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fas fa-medal text-yellow-400 text-xl"></i>
                            <h4 class="text-whitePure font-bold">Mención de Honor</h4>
                        </div>
                        <p class="text-platinum text-sm leading-relaxed">Durante 2 años consecutivos obtuve el cuadro de honor de oro, demostrando rigor académico e investigación científica.</p>
                    </div>
                </div>
                
                <!-- Certificaciones -->
                <div class="glass p-8 rounded-lg" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-bold text-whitePure mb-6">Certificaciones Adicionales</h3>
                    <p class="text-sm text-platinum opacity-70 mb-4 border-b border-lightNavy pb-2">Acreditaciones por <em>Capacítate para el empleo</em></p>
                    <ul class="space-y-5">
                        <li class="flex items-center gap-3">
                            <div class="w-8 flex justify-center"><i class="fas fa-microchip text-cyanAccent text-lg"></i></div>
                            <span class="text-platinum font-medium">Técnico en Electrónica</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 flex justify-center"><i class="fas fa-network-wired text-cyanAccent text-lg"></i></div>
                            <span class="text-platinum font-medium">Técnico en Redes</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 flex justify-center"><i class="fas fa-laptop-code text-cyanAccent text-lg"></i></div>
                            <span class="text-platinum font-medium">Desarrollo de Web Responsivos</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 flex justify-center"><i class="fas fa-tools text-cyanAccent text-lg"></i></div>
                            <span class="text-platinum font-medium">Técnico en Instalación y reparación de PC</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 flex justify-center"><i class="fas fa-file-word text-cyanAccent text-lg"></i></div>
                            <span class="text-platinum font-medium">Técnico en Informática (Ofimática)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECCIÓN ARSÉNAL TÉCNICO (SKILLS) -->
    <!-- ========================================== -->
    <section id="habilidades" class="py-24 bg-[#0B1B33]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-whitePure"><span class="text-cyanAccent font-mono text-xl mr-2">02.</span> Arsénal Técnico</h2>
                <div class="h-px bg-lightNavy flex-grow ml-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Desarrollo Web -->
                <div class="bg-darkCard p-6 rounded-lg border-t-4 border-cyanAccent hover:-translate-y-2 transition duration-300 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-full bg-cyanAccent/10 flex items-center justify-center mb-4">
                        <i class="fas fa-code text-cyanAccent text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-whitePure mb-4">Desarrollo Web</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Frontend (HTML/CSS/JS)</span>
                                <span class="text-cyanAccent font-mono text-xs">Básico</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-cyanAccent h-1.5 rounded-full" style="width: 40%"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Backend (Python/PHP/Java)</span>
                                <span class="text-cyanAccent font-mono text-xs">Intermedio</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-cyanAccent h-1.5 rounded-full" style="width: 70%"></div></div>
                        </div>
                    </div>
                </div>

                <!-- Redes y Comunicaciones -->
                <div class="bg-darkCard p-6 rounded-lg border-t-4 border-purple-500 hover:-translate-y-2 transition duration-300 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-full bg-purple-500/10 flex items-center justify-center mb-4">
                        <i class="fas fa-server text-purple-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-whitePure mb-4">Redes</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Enrutamiento (Cisco)</span>
                                <span class="text-purple-400 font-mono text-xs">Intermedio</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-purple-500 h-1.5 rounded-full" style="width: 70%"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Infraestructura (Racks)</span>
                                <span class="text-purple-400 font-mono text-xs">Intermedio</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-purple-500 h-1.5 rounded-full" style="width: 70%"></div></div>
                        </div>
                    </div>
                </div>

                <!-- Soporte Técnico y Hardware -->
                <div class="bg-darkCard p-6 rounded-lg border-t-4 border-blue-500 hover:-translate-y-2 transition duration-300 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center mb-4">
                        <i class="fas fa-desktop text-blue-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-whitePure mb-4">Soporte Hardware</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Hardware (Mantenimiento)</span>
                                <span class="text-blue-400 font-mono text-xs">Básico</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-blue-500 h-1.5 rounded-full" style="width: 40%"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Diagnóstico de fallas</span>
                                <span class="text-blue-400 font-mono text-xs">Básico</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-blue-500 h-1.5 rounded-full" style="width: 40%"></div></div>
                        </div>
                    </div>
                </div>

                <!-- Ofimática y Diseño -->
                <div class="bg-darkCard p-6 rounded-lg border-t-4 border-pink-500 hover:-translate-y-2 transition duration-300 shadow-lg" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 rounded-full bg-pink-500/10 flex items-center justify-center mb-4">
                        <i class="fas fa-paint-brush text-pink-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-whitePure mb-4">Gestión y Diseño</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Office (Excel Avanzado)</span>
                                <span class="text-pink-400 font-mono text-xs">Intermedio</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-pink-500 h-1.5 rounded-full" style="width: 70%"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span class="text-platinum">Diseño UI/UX (Figma)</span>
                                <span class="text-pink-400 font-mono text-xs">Básico</span>
                            </div>
                            <div class="w-full bg-midnight rounded-full h-1.5"><div class="bg-pink-500 h-1.5 rounded-full" style="width: 40%"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECCIÓN PORTAFOLIO (PROYECTOS) -->
    <!-- ========================================== -->
    <section id="portafolio" class="py-24 bg-midnight">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-whitePure"><span class="text-cyanAccent font-mono text-xl mr-2">03.</span> Proyectos Destacados</h2>
                <div class="h-px bg-lightNavy flex-grow ml-6"></div>
            </div>

            <div class="space-y-24">
                <!-- Proyecto 1: TechNova -->
                <div class="relative grid grid-cols-1 md:grid-cols-12 gap-8 items-center" data-aos="fade-up">
                    <div class="md:col-span-7 relative group">
                        <div class="absolute inset-0 bg-cyanAccent mix-blend-overlay opacity-30 group-hover:opacity-0 transition duration-500 rounded-lg z-10"></div>
                        <img src="technova.png" alt="TechNova Website" class="rounded-lg shadow-2xl w-full h-auto object-cover grayscale group-hover:grayscale-0 transition duration-500 border border-lightNavy">
                    </div>
                    <div class="md:col-span-5 md:text-right relative z-20">
                        <p class="font-mono text-cyanAccent text-sm mb-2">Sitio Web Comercial</p>
                        <h3 class="text-2xl font-bold text-whitePure mb-4 hover:text-cyanAccent transition">TechNova</h3>
                        <div class="glass p-6 rounded-lg text-platinum text-sm mb-4 md:-ml-12 shadow-xl relative z-30">
                            <p class="mb-2 leading-relaxed"><strong>Problema Resuelto:</strong> Diseñado para resolver la presentación deficiente de productos en línea. Se creó una plantilla e-commerce de alta calidad para la venta de productos electrónicos, con una interfaz personalizada y orientada al dueño del negocio.</p>
                        </div>
                        <ul class="flex flex-wrap md:justify-end gap-4 font-mono text-xs text-platinum opacity-80 mb-4">
                            <li>HTML5</li>
                            <li>CSS3</li>
                            <li>JavaScript</li>
                        </ul>
                        <div class="flex md:justify-end gap-4 text-xl">
                            <a href="https://github.com/ElMax20" target="_blank" class="text-platinum hover:text-cyanAccent transition" title="Ver Código en GitHub"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Proyecto 2: RPG en Python -->
                <div class="relative grid grid-cols-1 md:grid-cols-12 gap-8 items-center" data-aos="fade-up">
                    <div class="md:col-span-5 relative z-20 md:order-1 order-2">
                        <p class="font-mono text-cyanAccent text-sm mb-2">Desarrollo de Software</p>
                        <h3 class="text-2xl font-bold text-whitePure mb-4 hover:text-cyanAccent transition">Juego RPG</h3>
                        <div class="glass p-6 rounded-lg text-platinum text-sm mb-4 md:-mr-12 shadow-xl relative z-30">
                            <p class="mb-2 leading-relaxed"><strong>Problema Resuelto:</strong> Aprendizaje avanzado y estructuración lógica mediante el desarrollo de videojuegos de rol (RPG) utilizando Python y su librería gráfica Tkinter para la interfaz de usuario.</p>
                        </div>
                        <ul class="flex flex-wrap gap-4 font-mono text-xs text-platinum opacity-80 mb-4">
                            <li>Python</li>
                            <li>Tkinter (GUI)</li>
                            <li>Lógica de Juegos</li>
                        </ul>
                    </div>
                    <div class="md:col-span-7 relative group md:order-2 order-1">
                        <div class="absolute inset-0 bg-cyanAccent mix-blend-overlay opacity-30 group-hover:opacity-0 transition duration-500 rounded-lg z-10"></div>
                        <img src="rpg.png" alt="RPG Game en Python" class="rounded-lg shadow-2xl w-full h-auto object-cover grayscale group-hover:grayscale-0 transition duration-500 border border-lightNavy">
                    </div>
                </div>

                <!-- Proyecto 3: Verdad o Reto -->
                <div class="relative grid grid-cols-1 md:grid-cols-12 gap-8 items-center" data-aos="fade-up">
                    <div class="md:col-span-7 relative group">
                        <div class="absolute inset-0 bg-cyanAccent mix-blend-overlay opacity-30 group-hover:opacity-0 transition duration-500 rounded-lg z-10"></div>
                        <img src="verdad.png" alt="App Verdad o Reto" class="rounded-lg shadow-2xl w-full h-auto object-cover grayscale group-hover:grayscale-0 transition duration-500 border border-lightNavy">
                    </div>
                    <div class="md:col-span-5 md:text-right relative z-20">
                        <p class="font-mono text-cyanAccent text-sm mb-2">Aplicación Web Interactiva</p>
                        <h3 class="text-2xl font-bold text-whitePure mb-4 hover:text-cyanAccent transition">Verdad o Reto</h3>
                        <div class="glass p-6 rounded-lg text-platinum text-sm mb-4 md:-ml-12 shadow-xl relative z-30">
                            <p class="mb-2 leading-relaxed"><strong>Problema Resuelto:</strong> Una opción rápida y accesible para dinamizar reuniones sociales. Integra una ruleta aleatoria para los jugadores y utiliza Inteligencia Artificial para generar preguntas profundas o retos de actividad física.</p>
                        </div>
                        <ul class="flex flex-wrap md:justify-end gap-4 font-mono text-xs text-platinum opacity-80 mb-4">
                            <li>HTML/CSS/JS</li>
                            <li>Google Studio AI</li>
                            <li>Diseño Responsivo</li>
                        </ul>
                        <div class="flex md:justify-end gap-4 text-xl">
                            <a href="https://github.com/ElMax20" target="_blank" class="text-platinum hover:text-cyanAccent transition" title="Ver Código en GitHub"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECCIÓN VISIÓN Y EXPERIENCIA (FCT) -->
    <!-- ========================================== -->
    <section id="vision" class="py-24 bg-[#0B1B33]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-whitePure"><span class="text-cyanAccent font-mono text-xl mr-2">04.</span> Visión y Experiencia Profesional</h2>
                <div class="h-px bg-lightNavy flex-grow ml-6"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                <!-- Visión de Emprendimiento -->
                <div data-aos="fade-right">
                    <div class="glass p-10 rounded-lg h-full border border-cyanAccent/20 flex flex-col justify-between shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 text-cyanAccent opacity-5">
                            <i class="fas fa-rocket text-[15rem]"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="text-cyanAccent mb-6"><i class="fas fa-lightbulb text-4xl"></i></div>
                            <h3 class="text-2xl font-bold text-whitePure mb-8">Visión de Emprendimiento</h3>
                            
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-whitePure flex items-center gap-2"><i class="fas fa-store text-cyanAccent text-sm"></i> Idea de Negocio</h4>
                                <p class="text-platinum opacity-80 mt-3 text-sm leading-relaxed">Apertura de una agencia tecnológica boutique especializada en implementación de software inteligente y mantenimiento preventivo integral para PYMES.</p>
                            </div>
                            
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-whitePure flex items-center gap-2"><i class="fas fa-star text-cyanAccent text-sm"></i> Factor Diferenciador</h4>
                                <p class="text-platinum opacity-80 mt-3 text-sm leading-relaxed">¿Por qué elegirme sobre técnicos veteranos? Porque ofrezco <strong>tecnología con propósito</strong>: interfaces ultra modernas, soporte a domicilio, soluciones orientadas a procesos reales y un enfoque fresco que técnicos de 20 años rara vez aplican (como integración de IA y automatizaciones sencillas).</p>
                            </div>
                            
                            <div class="bg-darkCard/50 p-5 rounded-lg border-l-4 border-cyanAccent">
                                <h4 class="text-sm font-bold text-cyanAccent uppercase tracking-wider mb-2">Misión a 5 años</h4>
                                <p class="text-platinum italic text-sm">"Liderar proyectos de desarrollo de software a nivel nacional dentro del área de sistemas, creando infraestructuras robustas que mejoren la vida de las personas."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experiencia FCT -->
                <div data-aos="fade-left">
                    <div class="bg-darkCard p-10 rounded-lg h-full border border-lightNavy shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 text-platinum opacity-5">
                            <i class="fas fa-building text-[15rem]"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="text-cyanAccent mb-6"><i class="fas fa-briefcase text-4xl"></i></div>
                            <h3 class="text-2xl font-bold text-whitePure mb-2">Prácticas Pre-Profesionales (FCT)</h3>
                            <p class="text-cyanAccent font-mono mb-8 bg-cyanAccent/10 inline-block px-3 py-1 rounded">Empresa RESGASA S.A.</p>
                            
                            <h4 class="text-whitePure font-semibold mb-6">Funciones y Responsabilidades:</h4>
                            <ul class="space-y-6">
                                <li class="flex items-start bg-midnight/50 p-4 rounded-lg border border-lightNavy/50 transition hover:border-cyanAccent/50">
                                    <div class="bg-darkCard p-3 rounded-full mr-4 flex-shrink-0">
                                        <i class="fas fa-database text-cyanAccent"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-platinum font-semibold mb-1">Gestión de Datos</h5>
                                        <p class="text-platinum opacity-70 text-sm">Manejé la base de datos integrada de todos los trabajadores de la corporación asegurando la integridad de la información.</p>
                                    </div>
                                </li>
                                <li class="flex items-start bg-midnight/50 p-4 rounded-lg border border-lightNavy/50 transition hover:border-cyanAccent/50">
                                    <div class="bg-darkCard p-3 rounded-full mr-4 flex-shrink-0">
                                        <i class="fas fa-camera text-cyanAccent"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-platinum font-semibold mb-1">Soporte Multimedia</h5>
                                        <p class="text-platinum opacity-70 text-sm">Documentación visual mediante fotografías como evidencia de charlas institucionales.</p>
                                    </div>
                                </li>
                                <li class="flex items-start bg-midnight/50 p-4 rounded-lg border border-lightNavy/50 transition hover:border-cyanAccent/50">
                                    <div class="bg-darkCard p-3 rounded-full mr-4 flex-shrink-0">
                                        <i class="fas fa-users-cog text-cyanAccent"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-platinum font-semibold mb-1">Apoyo en Recursos Humanos</h5>
                                        <p class="text-platinum opacity-70 text-sm">Gestión de recursos didácticos para el área de ventas, filtración de hojas de vida y logística de entrega de uniformes.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECCIÓN CONTACTO / FOOTER -->
    <!-- ========================================== -->
    <section id="contacto" class="py-24 bg-midnight text-center relative">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-aos="fade-up">
            <p class="text-cyanAccent font-mono mb-4">05. ¿Qué sigue?</p>
            <h2 class="text-4xl md:text-5xl font-bold text-whitePure mb-6">Ponte en Contacto</h2>
            <p class="text-platinum opacity-80 mb-10 text-lg">
                Actualmente estoy dispuesto a nuevas oportunidades tecnológicas. Ya sea que tengas una propuesta, una pregunta o simplemente quieras conectar, ¡mi bandeja de entrada está siempre abierta!
            </p>

            <!-- Alerta de estado de envío de correo (PHP) -->
            <?php if (!empty($mensaje_estado)): ?>
                <div class="mb-8 p-4 rounded border font-semibold <?= strpos($mensaje_estado, 'éxito') !== false ? 'bg-green-900/30 border-green-500 text-green-400' : 'bg-red-900/30 border-red-500 text-red-400' ?>">
                    <?= htmlspecialchars($mensaje_estado) ?>
                </div>
            <?php endif; ?>

            <!-- Formulario de Contacto -->
            <form method="POST" action="#contacto" class="space-y-6 text-left glass p-8 rounded-lg mb-16 max-w-xl mx-auto shadow-2xl">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-platinum mb-2">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" required class="w-full bg-darkCard border border-lightNavy rounded px-4 py-3 text-platinum focus:outline-none focus:border-cyanAccent transition-colors" placeholder="Ej. Juan Pérez">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-platinum mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required class="w-full bg-darkCard border border-lightNavy rounded px-4 py-3 text-platinum focus:outline-none focus:border-cyanAccent transition-colors" placeholder="tu@correo.com">
                </div>
                <div>
                    <label for="mensaje" class="block text-sm font-medium text-platinum mb-2">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="4" required class="w-full bg-darkCard border border-lightNavy rounded px-4 py-3 text-platinum focus:outline-none focus:border-cyanAccent transition-colors resize-none" placeholder="Hola Max, me gustaría conversar sobre..."></textarea>
                </div>
                <button type="submit" class="w-full py-4 bg-transparent border border-cyanAccent text-cyanAccent font-bold rounded hover:bg-cyanAccent/10 transition-colors duration-300">
                    Enviar Mensaje <i class="fas fa-paper-plane ml-2"></i>
                </button>
            </form>

            <!-- Enlaces Sociales -->
            <div class="flex justify-center space-x-8 mb-10">
                <a href="https://github.com/ElMax20" target="_blank" class="text-platinum hover:text-cyanAccent hover:-translate-y-1 transform transition-all duration-300 text-2xl" title="GitHub">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/carlos-max-campoverde-ba941b364/" target="_blank" class="text-platinum hover:text-cyanAccent hover:-translate-y-1 transform transition-all duration-300 text-2xl" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://wa.me/593997766751" target="_blank" class="text-platinum hover:text-cyanAccent hover:-translate-y-1 transform transition-all duration-300 text-2xl" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="mailto:campomax82@gmail.com" class="text-platinum hover:text-cyanAccent hover:-translate-y-1 transform transition-all duration-300 text-2xl" title="Email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
            
            <p class="text-sm font-mono text-platinum opacity-50 hover:text-cyanAccent transition-colors cursor-default">
                Diseñado y Desarrollado por Max Campoverde &copy; <?= date("Y"); ?>
            </p>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SCRIPTS ADICIONALES -->
    <!-- ========================================== -->
    <!-- AOS Animate on Scroll JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inicializar animaciones de desplazamiento
        AOS.init({
            once: true, // La animación ocurre solo una vez
            offset: 100, // Offset antes de iniciar la animación (px)
            duration: 800, // Duración de la animación (ms)
            easing: 'ease-out-cubic',
        });

        // Lógica del menú móvil
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Cerrar menú móvil al hacer clic en un enlace interno
        const mobileLinks = menu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    </script>
</body>
</html>
