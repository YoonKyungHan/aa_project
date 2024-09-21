   // webpack.mix.js
   const mix = require('laravel-mix');

   mix.js('resources/js/firebase.js', 'public/js')
       .postCss('resources/css/app.css', 'public/css', [
           //
       ]);