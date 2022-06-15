<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Title
      |--------------------------------------------------------------------------
      |
      | Here you can change the default title of your admin panel.
      |
      | For detailed instructions you can look the title section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
      |
     */

    'title' => 'Santi Informática',
    'title_prefix' => '',
    'title_postfix' => '',
    /*
      |--------------------------------------------------------------------------
      | Favicon
      |--------------------------------------------------------------------------
      |
      | Here you can activate the favicon.
      |
      | For detailed instructions you can look the favicon section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
      |
     */
    'use_ico_only' => false,
    'use_full_favicon' => false,
    /*
      |--------------------------------------------------------------------------
      | Logo
      |--------------------------------------------------------------------------
      |
      | Here you can change the logo of your admin panel.
      |
      | For detailed instructions you can look the logo section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
      |
     */
    'logo' => 'Santi Informática',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogoPreto.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Santi Informática',
    /*
      |--------------------------------------------------------------------------
      | User Menu
      |--------------------------------------------------------------------------
      |
      | Here you can activate and change the user menu.
      |
      | For detailed instructions you can look the user menu section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
      |
     */
    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,
    /*
      |--------------------------------------------------------------------------
      | Layout
      |--------------------------------------------------------------------------
      |
      | Here we change the layout of your admin panel.
      |
      | For detailed instructions you can look the layout section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
      |
     */
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,
    /*
      |--------------------------------------------------------------------------
      | Authentication Views Classes
      |--------------------------------------------------------------------------
      |
      | Here you can change the look and behavior of the authentication views.
      |
      | For detailed instructions you can look the auth classes section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
      |
     */
    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',
    /*
      |--------------------------------------------------------------------------
      | Admin Panel Classes
      |--------------------------------------------------------------------------
      |
      | Here you can change the look and behavior of the admin panel.
      |
      | For detailed instructions you can look the admin panel classes here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
      |
     */
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',
    /*
      |--------------------------------------------------------------------------
      | Sidebar
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar of the admin panel.
      |
      | For detailed instructions you can look the sidebar section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
      |
     */
    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    /*
      |--------------------------------------------------------------------------
      | Control Sidebar (Right Sidebar)
      |--------------------------------------------------------------------------
      |
      | Here we can modify the right sidebar aka control sidebar of the admin panel.
      |
      | For detailed instructions you can look the right sidebar section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
      |
     */
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',
    /*
      |--------------------------------------------------------------------------
      | URLs
      |--------------------------------------------------------------------------
      |
      | Here we can modify the url settings of the admin panel.
      |
      | For detailed instructions you can look the urls section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
      |
     */
    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => 'usuarios/perfil',
    /*
      |--------------------------------------------------------------------------
      | Laravel Mix
      |--------------------------------------------------------------------------
      |
      | Here we can enable the Laravel Mix option for the admin panel.
      |
      | For detailed instructions you can look the laravel mix section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
      |
     */
    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',
    /*
      |--------------------------------------------------------------------------
      | Menu Items
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar/top navigation of the admin panel.
      |
      | For detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
      |
     */
    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Procurar',
        ],
        /*[
            'text' => 'Financeiro',
            'icon' => 'fas fa-chart-line',
            'icon_color' => 'default',
            'can' => 'menu-financeiro',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Clientes',
                    'icon' => 'fas fa-user-friends',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-clientes',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-clientes-cadastrar',
                            'url' => 'clientefin/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-clientes-listar',
                            'url' => 'clientefin/listar',
                            'active' => ['clientefin/listar', 'clientefin/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Fornecedores',
                    'icon' => 'fas fa-warehouse',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-fornecedores',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-fornecedores-cadastrar',
                            'url' => 'fornecedorfin/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-fornecedores-listar',
                            'url' => 'fornecedorfin/listar',
                            'active' => ['fornecedorfin/listar', 'fornecedorfin/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contas a Receber',
                    'icon' => 'fas fa-hand-holding-usd',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-contasareceber',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-contasareceber-cadastrar',
                            'url' => 'contasareceber/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-contasareceber-listar',
                            'url' => 'contasareceber/listar',
                            'active' => ['contasareceber/listar', 'contasareceber/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Gerar Mensalidades',
                            'can' => 'menu-financeiro-contasareceber-mensalidade',
                            'url' => 'contasareceber/gerarmensalidade',
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contas a Pagar',
                    'icon' => 'fas fa-donate',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-contasapagar',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-contasapagar-cadastrar',
                            'url' => 'contasapagar/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-contasapagar-listar',
                            'url' => 'contasapagar/listar',
                            'active' => ['contasapagar/listar', 'contasapagar/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Boletos',
                    'icon' => 'fas fa-barcode',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-boleto',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-boleto-cadastrar',
                            'url' => 'boleto/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-boleto-listar',
                            'url' => 'boleto/listar',
                            'active' => ['boleto/listar', 'boleto/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Remessa',
                            'can' => 'menu-financeiro-boleto-remessa',
                            'url' => 'boleto/remessa',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Retorno',
                            'can' => 'menu-financeiro-boleto-retorno',
                            'url' => 'boleto/retorno',
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Carnê',
                    'icon' => 'fas fa-money-check',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-carne',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-carne-cadastrar',
                            'url' => 'carne/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-carne-listar',
                            'url' => 'carne/listar',
                            'active' => ['carne/listar', 'carne/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Forma de Pagamento',
                    'icon' => 'fas fa-donate',
                    'icon_color' => 'primary',
                    'can' => 'menu-financeiro-formadepagamento',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-formadepagamento-cadastrar',
                            'url' => 'formadepagamento/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-formadepagamento-listar',
                            'url' => 'formadepagamento/listar',
                            'active' => ['formadepagamento/listar', 'formadepagamento/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],*/
        /*[
            'text' => 'Atendimento',
            'icon' => 'fas fa-user-circle',
            'icon_color' => 'default',
            'can' => 'menu-atendimento',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Agenda',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-agenda',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-agenda-cadastrar',
                            'url' => 'agenda/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-agenda-listar',
                            'url' => 'agenda/listar',
                            'active' => ['agenda/listar', 'agenda/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Clientes',
                    'icon' => 'fas fa-user-friends',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-clientes',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-clientes-cadastrar',
                            'url' => 'cliente/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-clientes-listar',
                            'url' => 'cliente/listar',
                            'active' => ['cliente/listar', 'cliente/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Fornecedores',
                    'icon' => 'fas fa-warehouse',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-fornecedores',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-fornecedores-cadastrar',
                            'url' => 'fornecedor/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-fornecedores-listar',
                            'url' => 'fornecedor/listar',
                            'active' => ['fornecedor/listar', 'fornecedor/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Produtos',
                    'icon' => 'fas fa-dolly',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-produtos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-produtos-cadastrar',
                            'url' => 'produto/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-produtos-listar',
                            'url' => 'produto/listar',
                            'active' => ['produto/listar', 'produto/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Serviços',
                    'icon' => 'fas fa-tools',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-servicos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-servicos-cadastrar',
                            'url' => 'servico/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-servicos-listar',
                            'url' => 'servico/listar',
                            'active' => ['servico/listar', 'servico/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Orçamentos',
                    'icon' => 'fas fa-clipboard',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-orcamentos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-orcamentos-cadastrar',
                            'url' => 'orcamento/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-orcamentos-listar',
                            'url' => 'orcamento/listar',
                            'active' => ['orcamento/listar', 'orcamento/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Ordem de Serviço',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-ordemdeservico',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-atendimento-ordemdeservico-cadastrar',
                            'url' => 'ordemdeservico/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-atendimento-ordemdeservico-listar',
                            'url' => 'ordemdeservico/listar',
                            'active' => ['ordemdeservico/listar', 'ordemdeservico/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Telemarketing',
                    'icon' => 'fas fa-phone-square',
                    'icon_color' => 'primary',
                    'can' => 'menu-atendimento-telemarketingtransporte',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Ligar',
                            'can' => 'menu-atendimento-telemarketingtransporte-cadastrar',
                            'url' => 'telemarketingtransporte/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Ligações Realizadas',
                            'can' => 'menu-atendimento-telemarketingtransporte-listar',
                            'url' => 'telemarketingtransporte/listar',
                            'active' => ['telemarketingtransporte/listar', 'telemarketingtransporte/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Clinica',
            'icon' => 'fas fa-stethoscope',
            'icon_color' => 'default',
            'can' => 'menu-clinica',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Agenda',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-agenda',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-agenda-cadastrar',
                            'url' => 'agenda/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-agenda-listar',
                            'url' => 'agenda/listar',
                            'active' => ['agenda/listar', 'agenda/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Consultas',
                    'icon' => 'fas fa-head-side-mask',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-consultas',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-consultas-cadastrar',
                            'url' => 'consulta/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-consultas-listar',
                            'url' => 'consulta/listar',
                            'active' => ['consulta/listar', 'consulta/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Pacientes',
                    'icon' => 'fas fa-user-friends',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-pacientes',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-pacientes-cadastrar',
                            'url' => 'cliente/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-pacientes-listar',
                            'url' => 'cliente/listar',
                            'active' => ['cliente/listar', 'cliente/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Especialidades',
                    'icon' => 'fas fa-diagnoses',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-especialidades',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-especialidades-cadastrar',
                            'url' => 'especialidade/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-especialidades-listar',
                            'url' => 'especialidade/listar',
                            'active' => ['especialidade/listar', 'especialidade/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Médicos',
                    'icon' => 'fas fa-user-md',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-medicos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-medicos-cadastrar',
                            'url' => 'medico/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-medicos-listar',
                            'url' => 'medico/listar',
                            'active' => ['medico/listar', 'medico/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Procedimentos',
                    'icon' => 'fas fa-procedures',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-procedimentos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-procedimentos-cadastrar',
                            'url' => 'procedimento/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-procedimentos-listar',
                            'url' => 'procedimento/listar',
                            'active' => ['procedimento/listar', 'procedimento/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Exames',
                    'icon' => 'fas fa-microscope',
                    'icon_color' => 'primary',
                    'can' => 'menu-clinica-exames',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-clinica-exames-cadastrar',
                            'url' => 'exame/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-clinica-exames-listar',
                            'url' => 'exame/listar',
                            'active' => ['exame/listar', 'exame/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],*/
        [
            'text' => 'Rebanho',
            'icon' => 'fas fa-democrat',
            'icon_color' => 'default',
            'can' => 'menu-rebanho',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Animais',
                    'icon' => 'fas fa-horse',
                    'icon_color' => 'primary',
                    'can' => 'menu-rebanho-animais',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-rebanho-animais-cadastrar',
                            'url' => 'animal/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-rebanho-animais-listar',
                            'url' => 'animal/listar',
                            'active' => ['animal/listar', 'animal/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Configuração',
                            'can' => 'menu-rebanho-animais-configuracao',
                            'url' => 'configuracao/editar',
                            'active' => ['configuracao/editar', 'configuracao/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Alimentação / Ração',
                    'icon' => 'fas fa-apple-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-rebanho-alimentacao',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar Alimento/Ração',
                            'can' => 'menu-rebanho-alimento-cadastrar',
                            'url' => 'alimento/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Lista de Alimentos',
                            'can' => 'menu-rebanho-alimento-listar',
                            'url' => 'alimento/listar',
                            'active' => ['alimento/listar', 'alimento/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cadastrar Alimentação',
                            'can' => 'menu-rebanho-alimentacao-cadastrar',
                            'url' => 'alimentacao/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Lista alimentados',
                            'can' => 'menu-rebanho-alimentacao-listar',
                            'url' => 'alimentacao/listar',
                            'active' => ['alimentacao/listar', 'alimentacao/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Produção',
                    'icon' => 'fas fa-glass-whiskey',
                    'icon_color' => 'primary',
                    'can' => 'menu-rebanho-producao',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Registro Individual',
                            'can' => 'menu-rebanho-producao-individual',
                            'url' => 'producao/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Registro em Grupo',
                            'can' => 'menu-rebanho-producao-grupo',
                            'url' => 'producao/cadastrargrupo',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-rebanho-producao-listar',
                            'url' => 'producao/listar',
                            'active' => ['producao/listar', 'producao/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Reprodução',
                    'icon' => 'fas fa-heartbeat',
                    'icon_color' => 'primary',
                    'can' => 'menu-rebanho-reproducao',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Inseminação',
                            'can' => 'menu-rebanho-reproducao-inseminacao',
                            'url' => 'inseminacao/cadastrar',
                            'submenu' => [
                                [
                                    'text' => 'Cadastrar',
                                    'can' => 'menu-rebanho-reproducao-inseminacao-cadastrar',
                                    'url' => 'inseminacao/cadastrar',
                                    'shift' => 'ml-2',
                                ],
                                [
                                    'text' => 'Listar',
                                    'can' => 'menu-rebanho-reproducao-inseminacao-listar',
                                    'url' => 'inseminacao/listar',
                                    'active' => ['inseminacao/listar', 'inseminacao/editar*'],
                                    'shift' => 'ml-2',
                                ],
                            ],
                        ],
                        [
                            'text' => 'Gestação',
                            'can' => 'menu-rebanho-reproducao-gestacao',
                            'url' => 'gestacao/cadastrar',
                            'submenu' => [
                                [
                                    'text' => 'Cadastrar',
                                    'can' => 'menu-rebanho-reproducao-gestacao-cadastrar',
                                    'url' => 'gestacao/cadastrar',
                                    'shift' => 'ml-2',
                                ],
                                [
                                    'text' => 'Listar',
                                    'can' => 'menu-rebanho-reproducao-gestacao-listar',
                                    'url' => 'gestacao/listar',
                                    'active' => ['gestacao/listar', 'gestacao/editar*'],
                                    'shift' => 'ml-2',
                                ],
                            ],
                        ],
                        [
                            'text' => 'Parto',
                            'can' => 'menu-rebanho-reproducao-parto',
                            'url' => 'parto/cadastrar',
                            'submenu' => [
                                [
                                    'text' => 'Cadastrar',
                                    'can' => 'menu-rebanho-reproducao-parto-cadastrar',
                                    'url' => 'parto/cadastrar',
                                    'shift' => 'ml-2',
                                ],
                                [
                                    'text' => 'Listar',
                                    'can' => 'menu-rebanho-reproducao-parto-listar',
                                    'url' => 'parto/listar',
                                    'active' => ['parto/listar', 'parto/editar*'],
                                    'shift' => 'ml-2',
                                ],
                            ],
                        ],
                        [
                            'text' => 'Relatórios',
                            'can' => 'menu-rebanho-reproducao-relatorios',
                            'url' => 'inseminacao/relatorio',
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Abates',
                    'can' => 'menu-rebanho-abates',
                    'icon' => 'fas fa-calendar-check',
                    'icon_color' => 'primary',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar Lote',
                            'can' => 'menu-rebanho-abates-cadastrar',
                            'url' => 'abates/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar Lotes',
                            'can' => 'menu-rebanho-abates-listar',
                            'url' => 'abates/listar',
                            'active' => ['abates/listar', 'abates/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Vacinas',
                    'can' => 'menu-rebanho-vacinas',
                    'icon' => 'fas fa-syringe',
                    'icon_color' => 'primary',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar Vacina',
                            'can' => 'menu-rebanho-vacinas-cadastrar',
                            'url' => 'vacina/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Lista de Vacinas',
                            'can' => 'menu-rebanho-vacinas-listar',
                            'url' => 'vacina/listar',
                            'active' => ['vacina/listar', 'vacina/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Vacinar Um',
                            'can' => 'menu-rebanho-vacinacao-vacinarum',
                            'url' => 'vacinacao/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Vacinar Grupo',
                            'can' => 'menu-rebanho-vacinacao-vacinargrupo',
                            'url' => 'vacinacao/cadastrargrupo',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Lista de Vacinação',
                            'can' => 'menu-rebanho-vacinacao-listar',
                            'url' => 'vacinacao/listar',
                            'active' => ['vacinacao/listar', 'vacinacao/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Relatório de Vacinação',
                            'can' => 'menu-rebanho-vacinacao-relatorio',
                            'url' => 'vacinacao/relatorio',
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        /*[
            'text' => 'Cartão AMENA',
            'icon' => 'fa fa-address-card',
            'icon_color' => 'default',
            'can' => 'menu-convenio',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Conveniados',
                    'icon' => 'fas fa-user-friends',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-conveniado',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-convenio-conveniado-cadastrar',
                            'url' => 'conveniado/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-convenio-conveniado-listar',
                            'url' => 'conveniado/listar',
                            'active' => ['conveniado/listar', 'conveniado/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cadastros Novos',
                            'can' => 'menu-convenio-conveniado-cadastrosnovos',
                            'url' => 'conveniado/cadastrosnovos',
                            'active' => ['conveniado/cadastrosnovos'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cadastros Pendentes',
                            'can' => 'menu-convenio-conveniado-cadastrospendentes',
                            'url' => 'conveniado/cadastrospendentes',
                            'active' => ['conveniado/cadastrospendentes'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cadastros Vencidos',
                            'can' => 'menu-convenio-conveniado-cadastrosvencidos',
                            'url' => 'conveniado/cadastrosvencidos',
                            'active' => ['conveniado/cadastrosvencidos'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Credenciados',
                    'icon' => 'fas fa-warehouse',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-credenciado',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-convenio-credenciado-cadastrar',
                            'url' => 'credenciado/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-convenio-credenciado-listar',
                            'url' => 'credenciado/listar',
                            'active' => ['credenciado/listar', 'credenciado/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Planos',
                    'icon' => 'fas fa-folder-plus',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-plano',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-convenio-plano-cadastrar',
                            'url' => 'plano/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-convenio-plano-listar',
                            'url' => 'plano/listar',
                            'active' => ['plano/listar', 'plano/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contratos',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-contratoconvenio',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-convenio-contratoconvenio-cadastrar',
                            'url' => 'contratoconvenio/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-convenio-contratoconvenio-listar',
                            'url' => 'contratoconvenio/listar',
                            'active' => ['contratoconvenio/listar', 'contratoconvenio/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Novos Contratos',
                            'can' => 'menu-convenio-contratoconvenio-novoscontratos',
                            'url' => 'contratoconvenio/novoscontratos',
                            'active' => ['contratoconvenio/novoscontratos'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Contratos Vencidos',
                            'can' => 'menu-convenio-contratoconvenio-contratosvencidos',
                            'url' => 'contratoconvenio/contratosvencidos',
                            'active' => ['contratoconvenio/contratosvencidos'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Cartões',
                    'icon' => 'fas fa-address-card',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-cartao',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Controle',
                            'can' => 'menu-convenio-cartao-controle',
                            'url' => 'cartao/controle',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cartões Entregues',
                            'can' => 'menu-convenio-cartao-cartoesentregues',
                            'url' => 'cartao/cartoesentregues',
                            'active' => ['cartao/cartoesentregues'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cartões para Entregar',
                            'can' => 'menu-convenio-cartao-cartoesparaentregar',
                            'url' => 'cartao/cartoesparaentregar',
                            'active' => ['cartao/cartoesparaentregar'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Cartões Aguardando Pedido',
                            'can' => 'menu-convenio-cartao-cartoesaguardandopedido',
                            'url' => 'cartao/cartoesaguardandopedido',
                            'active' => ['cartao/cartoesaguardandopedido'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Registro de Atendimento',
                    'icon' => 'fas fa-hand-holding-usd',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-convenioatendimento-cadastrar',
                    'url' => 'convenioatendimento/cadastrar',
                ],
                [
                    'text' => 'Relatório de Atendimento',
                    'icon' => 'fas fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-convenioatendimento-relatorio',
                    'url' => 'convenioatendimento/relatorio',
                ],
                [
                    'text' => 'Consultar Cartão',
                    'icon' => 'far fa-address-card',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-conveniado-consultarficha',
                    'url' => 'conveniado/consultarficha',
                ],
                [
                    'text' => 'Histórico de Consultas',
                    'icon' => 'far fa-address-book',
                    'icon_color' => 'primary',
                    'can' => 'menu-convenio-conveniado-historicoconsultas',
                    'url' => 'conveniado/historicoconsultas',
                ],
            ],
        ],
        [
            'text' => 'Transportadora',
            'icon' => 'fas fa-shipping-fast',
            'icon_color' => 'default',
            'can' => 'menu-transportadora',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Passagem',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-transportadora-passagem',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-transportadora-passagem-cadastrar',
                            'url' => 'passagem/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-transportadora-passagem-listar',
                            'url' => 'passagem/listar',
                            'active' => ['passagem/listar', 'passagem/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Viagem',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-transportadora-viagem',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-transportadora-viagem-cadastrar',
                            'url' => 'viagem/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-transportadora-viagem-listar',
                            'url' => 'viagem/listar',
                            'active' => ['viagem/listar', 'viagem/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Veículos',
                    'icon' => 'fas fa-truck',
                    'icon_color' => 'primary',
                    'can' => 'menu-transportadora-veiculo',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-transportadora-veiculo-cadastrar',
                            'url' => 'veiculotransportadora/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-transportadora-veiculo-listar',
                            'url' => 'veiculotransportadora/listar',
                            'active' => ['veiculotransportadora/listar', 'veiculotransportadora/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contrato de Viagem',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-transportadora-contratoviagem',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-transportadora-contratoviagem-cadastrar',
                            'url' => 'contratoviagem/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-transportadora-contratoviagem-listar',
                            'url' => 'contratoviagem/listar',
                            'active' => ['contratoviagem/listar', 'contratoviagem/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Associação',
            'icon' => 'fas fa-sitemap',
            'icon_color' => 'default',
            'can' => 'menu-associacao',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Associados',
                    'icon' => 'fas fa-user-friends',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-clientes',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-clientes-cadastrar',
                            'url' => 'cliente/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-clientes-listar',
                            'url' => 'cliente/listar',
                            'active' => ['cliente/listar', 'cliente/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Prestadores',
                    'icon' => 'fas fa-warehouse',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-fornecedores',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-fornecedores-cadastrar',
                            'url' => 'fornecedor/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-fornecedores-listar',
                            'url' => 'fornecedor/listar',
                            'active' => ['fornecedor/listar', 'fornecedor/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Veículos',
                    'icon' => 'fas fa-truck',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-veiculo',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-veiculo-cadastrar',
                            'url' => 'associacaoveiculo/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-veiculo-listar',
                            'url' => 'associacaoveiculo/listar',
                            'active' => ['veiculo/listar', 'veiculo/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contratos',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-contratoassociacao',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-contratoassociacao-cadastrar',
                            'url' => 'contratoassociacao/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-contratoassociacao-listar',
                            'url' => 'contratoassociacao/listar',
                            'active' => ['contratoassociacao/listar', 'contratoassociacao/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Rateio',
                    'icon' => 'fas fa-chart-pie',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-rateio',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-rateio-cadastrar',
                            'url' => 'rateio/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-rateio-listar',
                            'url' => 'rateio/listar',
                            'active' => ['rateio/listar', 'rateio/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Quota',
                    'icon' => 'fas fa-cheese',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-quota',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-quota-cadastrar',
                            'url' => 'quota/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-quota-listar',
                            'url' => 'quota/listar',
                            'active' => ['quota/listar', 'quota/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Fundo de Caixa',
                    'icon' => 'fas fa-cash-register',
                    'icon_color' => 'primary',
                    'can' => 'menu-associacao-fundodecaixa',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-associacao-fundodecaixa-cadastrar',
                            'url' => 'fundodecaixa/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-associacao-fundodecaixa-listar',
                            'url' => 'fundodecaixa/listar',
                            'active' => ['fundodecaixa/listar', 'fundodecaixa/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Escola',
            'icon' => 'fas fa-university',
            'icon_color' => 'default',
            'can' => 'menu-escola',
            //'label' => 0,
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Aluno / Criança',
                    'icon' => 'fas fa-child',
                    'icon_color' => 'primary',
                    'can' => 'menu-escola-aluno',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-escola-aluno-cadastrar',
                            'url' => 'aluno/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-aluno-listar',
                            'url' => 'aluno/listar',
                            'active' => ['aluno/listar', 'aluno/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Turmas / Salas',
                    'can' => 'menu-escola-turma',
                    'icon' => 'fas fa-address-book',
                    'icon_color' => 'primary',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-escola-turma-cadastrar',
                            'url' => 'turma/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-turma-listar',
                            'url' => 'turma/listar',
                            'active' => ['turma/listar', 'turma/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contratos',
                    'icon' => 'far fa-file-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-escola-contratoescola',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-escola-contratoescola-cadastrar',
                            'url' => 'contratoescola/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-contratoescola-listar',
                            'url' => 'contratoescola/listar',
                            'active' => ['contratoescola/listar', 'contratoescola/editar*', 'contratoescola/imprimircontrato*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Configuração',
                            'can' => 'menu-escola-contratoescola-config',
                            'url' => 'contratoescola/config',
                            'active' => ['contratoescola/config', 'contratoescola/atualizarconfig'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Matrículas',
                    'icon' => 'fas fa-address-card',
                    'icon_color' => 'primary',
                    'can' => 'menu-escola-matricula',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-escola-matricula-cadastrar',
                            'url' => 'matricula/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-matricula-listar',
                            'url' => 'matricula/listar',
                            'active' => ['matricula/listar', 'matricula/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Diário',
                    'icon' => 'fas fa-book',
                    'icon_color' => 'primary',
                    'can' => 'menu-escola-diario',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Registrar',
                            'can' => 'menu-escola-diario-cadastrar',
                            'url' => 'diario/registrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-diario-listar',
                            'url' => 'diario/listar',
                            'active' => ['diario/listar', 'diario/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Avisos',
                    'icon' => 'fas fa-exclamation',
                    'icon_color' => 'primary',
                    'can' => 'menu-escola-aviso',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-escola-aviso-cadastrar',
                            'url' => 'aviso/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-aviso-listar',
                            'url' => 'aviso/listar',
                            'active' => ['aviso/listar', 'aviso/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Agenda',
                    'icon' => 'fas fa-calendar',
                    'icon_color' => 'primary',
                    'can' => 'menu-escola-agenda',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-escola-agenda-cadastrar',
                            'url' => 'agenda/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-escola-agenda-listar',
                            'url' => 'agenda/listar',
                            'active' => ['agenda/listar', 'agenda/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'BI',
            'icon' => 'fas fa-chart-pie',
            'icon_color' => 'default',
            'can' => 'menu-bi',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Clientes',
                    'icon' => 'fas fa-user-friends',
                    'icon_color' => 'primary',
                    'can' => 'menu-bi-clientes',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-bi-clientes-cadastrar',
                            'url' => 'clientebi/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-bi-clientes-listar',
                            'url' => 'clientebi/listar',
                            'active' => ['clientebi/listar', 'clientebi/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Fornecedores',
                    'icon' => 'fas fa-warehouse',
                    'icon_color' => 'primary',
                    'can' => 'menu-bi-fornecedores',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-bi-fornecedores-cadastrar',
                            'url' => 'fornecedorbi/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-bi-fornecedores-listar',
                            'url' => 'fornecedorbi/listar',
                            'active' => ['fornecedorbi/listar', 'fornecedorbi/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contas a Receber',
                    'icon' => 'fas fa-hand-holding-usd',
                    'icon_color' => 'primary',
                    'can' => 'menu-bi-contasareceber',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-bi-contasareceber-cadastrar',
                            'url' => 'contasareceberbi/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-bi-contasareceber-listar',
                            'url' => 'contasareceberbi/listar',
                            'active' => ['contasareceberbi/listar', 'contasareceberbi/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Contas a Pagar',
                    'icon' => 'fas fa-donate',
                    'icon_color' => 'primary',
                    'can' => 'menu-bi-contasapagar',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-financeiro-contasapagar-cadastrar',
                            'url' => 'contasapagarbi/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-financeiro-contasapagar-listar',
                            'url' => 'contasapagarbi/listar',
                            'active' => ['contasareceberbi/listar', 'contasareceberbi/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Projetos',
            'icon' => 'fas fa-bezier-curve',
            'icon_color' => 'default',
            'can' => 'menu-projetos',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Projetos',
                    'icon' => 'fas fa-code-branch',
                    'icon_color' => 'primary',
                    'can' => 'menu-projetos-projetos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-projetos-projetos-cadastrar',
                            'url' => 'projetos/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-projetos-projetos-listar',
                            'url' => 'projetos/listar',
                            'active' => ['projetos/listar', 'projetos/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Tarefas',
                    'icon' => 'fas fa-calendar-alt',
                    'icon_color' => 'primary',
                    'can' => 'menu-projetos-tarefas',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-projetos-tarefas-cadastrar',
                            'url' => 'tarefas/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-projetos-tarefas-listar',
                            'url' => 'tarefas/listar',
                            'active' => ['tarefas/listar', 'tarefas/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Pessoas',
                    'icon' => 'fa fa-user-circle',
                    'icon_color' => 'primary',
                    'can' => 'menu-projetos-pessoas',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-projetos-pessoas-cadastrar',
                            'url' => 'pessoas/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-projetos-pessoas-listar',
                            'url' => 'pessoas/listar',
                            'active' => ['pessoas/listar', 'pessoas/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Importação',
            'icon' => 'fas fa-globe-americas',
            'icon_color' => 'default',
            'can' => 'menu-importacao',
            'label' => 0,
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'Casa da Lavoura',
                    'icon' => 'fas fa-seedling',
                    'icon_color' => 'primary',
                    'can' => 'menu-importacao-cliente01',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Importar clientes',
                            'url' => 'importarcasadalavoura/importarclientes',
                            'active' => ['importarcasadalavoura/importarclientes', 'importarcasadalavoura/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Fornecedores',
                            'url' => 'importarcasadalavoura/importarfornecedores',
                            'active' => ['importarcasadalavoura/importarfornecedores', 'importarcasadalavoura/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'Cooper Brasil',
                    'icon' => 'fas fa-truck',
                    'icon_color' => 'primary',
                    'can' => 'menu-importacao-cliente02',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Importar Clientes',
                            'url' => 'importarcooperbrasil/listarclientes', 'importarcooperbrasil/importarclientes',
                            'active' => ['importarcooperbrasil/listarclientes', 'importarcooperbrasil/importarclientes'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Fornecedores',
                            'url' => 'importarcooperbrasil/listarfornecedores', 'importarcooperbrasil/importarfornecedores',
                            'active' => ['importarcooperbrasil/listarfornecedores', 'importarcooperbrasil/importarfornecedores'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Veículos',
                            'url' => 'importarcooperbrasil/listarveiculos',
                            'active' => ['importarcooperbrasil/listarveiculos', 'importarcooperbrasil/importarveiculos*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Contratos',
                            'url' => 'importarcooperbrasil/listarcontratos',
                            'active' => ['importarcooperbrasil/listarcontratos', 'importarcooperbrasil/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Financeiro',
                            'url' => 'importarcooperbrasil/listarfinanceiros',
                            'active' => ['importarcooperbrasil/listarfinanceiros', 'importarcooperbrasil/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Boletos',
                            'url' => 'importarcooperbrasil/listarboletos',
                            'active' => ['importarcooperbrasil/listarboletos', 'importarcooperbrasil/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Importar Fundo de Caixa',
                            'url' => 'importarcooperbrasil/listarfundodecaixas',
                            'active' => ['importarcooperbrasil/listarfundodecaixas', 'importarcooperbrasil/editar*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Nota Fiscal',
            'icon' => 'fas fa-file-code',
            'icon_color' => 'default',
            'can' => 'menu-notafiscal',
            'label_color' => 'primary',
            'submenu' => [
                [
                    'text' => 'NF Produtos',
                    'icon' => 'fas fa-file-code',
                    'icon_color' => 'primary',
                    'can' => 'menu-notafiscal-produtos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-notafiscal-produtos-cadastrar',
                            'url' => 'notafiscalprodutos/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-notafiscal-produtos-listar',
                            'url' => 'notafiscalprodutos/listar',
                            'active' => ['notafiscalprodutos/listar', 'notafiscalprodutos/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Configuração',
                            'can' => 'menu-notafiscal-produtos-configuracao',
                            'url' => 'notafiscalprodutos/listar',
                            'active' => ['notafiscalprodutos/config', 'notafiscalprodutos/config*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
                [
                    'text' => 'NF Serviços',
                    'icon' => 'fas fa-file-code',
                    'icon_color' => 'primary',
                    'can' => 'menu-notafiscal-servicos',
                    'label_color' => 'success',
                    'submenu' => [
                        [
                            'text' => 'Cadastrar',
                            'can' => 'menu-notafiscal-servicos-cadastrar',
                            'url' => 'notafiscalservicos/cadastrar',
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Listar',
                            'can' => 'menu-notafiscal-servicos-listar',
                            'url' => 'notafiscalservicos/listar',
                            'active' => ['notafiscalservicos/listar', 'notafiscalservicos/editar*'],
                            'shift' => 'ml-2',
                        ],
                        [
                            'text' => 'Configuração',
                            'can' => 'menu-notafiscal-servicos-configuracao',
                            'url' => 'notafiscalservicos/listar',
                            'active' => ['notafiscalservicos/config', 'notafiscalservicos/config*'],
                            'shift' => 'ml-2',
                        ],
                    ],
                ],
            ],
        ],*/
        [
            'text' => 'Configurações',
            'icon' => 'fas fa-cogs',
            'icon_color' => 'default',
            'can' => 'menu-configuracoes',
            'label' => 4,
            'label_color' => 'primary',
            'classes' => 'text-white text-bold',
            'submenu' => [
                [
                    'text' => 'Cadastrar Empresa',
                    'url' => 'empresa/cadastrar',
                    'icon' => 'fas fa-hotel',
                    'icon_color' => 'primary',
                    'can' => 'menu-configuracoes-cadastrarempresas',
                    'label' => 1,
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Listar Empresas',
                    'url' => 'empresa/listar',
                    'active' => ['empresa/listar', 'empresa/editar*'],
                    'icon' => 'fas fa-hotel',
                    'icon_color' => 'primary',
                    'can' => 'menu-configuracoes-listarempresas',
                    'label' => 1,
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Cadastrar Usuário',
                    'url' => 'usuarios/cadastrar',
                    'icon' => 'fas fa-user',
                    'icon_color' => 'primary',
                    'can' => 'menu-configuracoes-cadastrarusuario',
                    'label' => 4,
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Listar Usuários',
                    'url' => 'usuarios/listar',
                    'active' => ['usuarios/listar', 'usuarios/editar*'],
                    'icon' => 'fas fa-user',
                    'icon_color' => 'primary',
                    'can' => 'menu-configuracoes-listarusuarios',
                    'label' => 4,
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Permissões de Usuário',
                    'url' => 'permissaousuario/listarusuarios',
                    'active' => ['permissaousuario/listarusuarios', 'permissaousuario/listar*'],
                    'icon' => 'fas fa-user-lock',
                    'icon_color' => 'primary',
                    'can' => 'menu-configuracoes-permissaoacesso',
                    'label' => 4,
                    'label_color' => 'success',
                ],
            ],
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url' => 'usuarios/perfil',
            'icon' => 'fas fa-fw fa-user',
            'icon_color' => 'alert',
        ],
        [
            'text' => 'change_password',
            'url' => 'usuarios/alterarsenha',
            'icon' => 'fas fa-fw fa-lock',
            'icon_color' => 'alert',
        ],
        [
            'text' => 'Sair',
            'route' => 'logout',
            'icon' => 'fas fa-fw fa-lock',
            'icon_color' => 'alert',
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Menu Filters
      |--------------------------------------------------------------------------
      |
      | Here we can modify the menu filters of the admin panel.
      |
      | For detailed instructions you can look the menu filters section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
      |
     */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],
    /*
      |--------------------------------------------------------------------------
      | Plugins Initialization
      |--------------------------------------------------------------------------
      |
      | Here we can modify the plugins used inside the admin panel.
      |
      | For detailed instructions you can look the plugins section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
      |
     */
    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'InputMask' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/inputmask/inputmask.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/inputmask/jquery.inputmask.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Livewire
      |--------------------------------------------------------------------------
      |
      | Here we can enable the Livewire support.
      |
      | For detailed instructions you can look the livewire here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
     */
    'livewire' => false,
];
