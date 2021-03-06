<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Prince Ivan Kent Tiburcio">
        <link rel="shortcut icon" type="image/x-icon" href="{{{ url('public/favicon.ico') }}}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ url('public/js/client.js') }}"></script>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('public/libraries/css/vuetify.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/libraries/adminlte/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/libraries/adminlte/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/libraries/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/css/styles.css') }}">
    </head>
    <body>
        <v-app id="app" v-cloak style="background-color: #222D32;">
            <v-toolbar 
            class="header"
            app fixed clipped-left style="background-color: #424242; z-index: 10;">
                <v-toolbar-title style="padding-top: 8px;">
                    <img src="{{ url('public/images/isuzu-logo-compressor.png') }}" alt="image not found" style="height: 35px;">
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn flat color="white">Fleet Training Request System</v-btn>
                </v-toolbar-items>
            </v-toolbar>
            
            <v-content dark>
                <v-container>
                    <template>
                        <div>
                            <v-alert
                            :value="true"
                            type="{{ $content['type'] }}"
                            >
                            {{ $content['message'] }}
                            </v-alert>
                        </div>
                    </template>
                </v-container>
            </v-content>

            <v-footer class="footer" app fixed>
                <span>&copy; 2017</span>
            </v-footer>
        </v-app>

        <script src="{{ url('public/libraries/js/vuetify.min.js') }}"></script>
        <script src="{{ url('public/libraries/js/moment.js') }}"></script>
        <script src="{{ url('public/libraries/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script>
            var app = new Vue({
                el: '#app',
                data() {
                    return {}
                },
                created() {},
                methods: {}
            })
        </script>
    </body>
</html>
