[![Build Status](https://travis-ci.org/boehmers/gossenpoeten_theme.svg?branch=master)](https://travis-ci.org/boehmers/gossenpoeten_theme)

Getting started
===
1. clone or fork the project into the wordpress themes folder
2. be sure to have the latest LTS-version of node.js with npm installed
3. run the command `npm install` in the project root
4. after, run `bower install` npm script
5. finally, run `gulp icons` npm script to use the awesome fonts

taken from 
https://bootstrapwp.com/create-bootstrap-wordpress-theme-gulp-sass/

Building the project
===
* For development, run `npm run gulp-watch`. This will automatically compile sass and minify .js-files on saving files. If you activate the theme in your local wordpress installation (and cloned the project into the correct folder as described above), you'll be able to see changes on-the-fly.
* To build the project, use `npm run build`. This will zip the theme and all plugins in the plugin folder into a `build`-folder
* To use the theme and the plugins on a hosted wordpress site, simply upload the .zip's.

Based on '_s'
===

https://underscores.me
