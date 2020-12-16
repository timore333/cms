const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')

    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        // require('tailwindcss'),
    ])
    .styles([
        'resources/theme/dark/style.css'
    ],'public/css/dark/style.css')

    .styles([
        'resources/theme/main/style.css'
    ],'public/css/light/style.css')

    .styles([
        'resources/theme/rtl/style.css'
    ],'public/css/rtl/style.css')

    .styles([
        'resources/theme/horizontal/style.css'
    ],'public/css/horizontal/style.css')

    // login page styles
    .styles([
        'resources/theme/pages/login-register-lock.css',
    ], 'public/css/pages/login.css')

    // multi select styles
    .styles([
        'resources/theme/assets/node_modules/multiselect/css/multi-select.css',
        'resources/theme/assets/node_modules/select2/dist/css/select2.min.css',
        'resources/theme/assets/node_modules/bootstrap-select/bootstrap-select.min.css',
        'resources/theme/assets/node_modules/switchery/dist/switchery.min.css',
        'resources/theme/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
        'resources/theme/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css',
    ], 'public/css/multi-select.css')

    // theme main scripts
    .scripts([
        'resources/theme/assets/node_modules/bootstrap/dist/js/bootstrap.min.js',
        'resources/theme/assets/js/waves.js',
        'resources/theme/assets/js/sidebarmenu.js',
        'resources/theme/assets/js/custom.min.js',
        'resources/theme/assets/js/perfect-scrollbar.jquery.min.js',
        'resources/theme/assets/node_modules/popper/popper.min.js',
        'resources/theme/assets/node_modules/toast-master/js/jquery.toast.js',
    ], 'public/js/main.js')

    // jquery
    .scripts([
        'resources/theme/assets/node_modules/jquery/jquery-3.2.1.min.js',
    ], 'public/js/jquery.js')

    // multi select scripts
    .scripts([
        'resources/theme/assets/node_modules/switchery/dist/switchery.min.js',
        'resources/theme/assets/node_modules/select2/dist/js/select2.full.min.js',
        'resources/theme/assets/node_modules/bootstrap-select/bootstrap-select.min.js',
        'resources/theme/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
        'resources/theme/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
        'resources/theme/assets/node_modules/multiselect/js/jquery.multi-select.js',
    ], 'public/js/multi-select.js')

    // .scripts([
    //     'node_modules/tableexport.jquery.plugin/libs/FileSaver/FileSaver.min.js',
    //     'node_modules/tableexport.jquery.plugin/libs/js-xlsx/xlsx.core.min.js',
    //     'node_modules/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js',
    //     'node_modules/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js',
    //     'node_modules/tableexport.jquery.plugin/libs/pdfmake/pdfmake.min.js',
    //     'node_modules/tableexport.jquery.plugin/libs/pdfmake/mirza_fonts.js',
    //     'node_modules/tableexport.jquery.plugin/tableExport.min.js',
    // ],  'public/js/datatable.js')

    .webpackConfig(require('./webpack.config'));

