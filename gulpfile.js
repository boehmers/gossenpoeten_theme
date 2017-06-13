// Load all the modules from package.json
var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    autoprefixer = require('gulp-autoprefixer'),
    watch = require('gulp-watch'),
    livereload = require('gulp-livereload'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    include = require('gulp-include'),
    sass = require('gulp-sass');
imagemin = require('gulp-imagemin');
bower = require('gulp-bower');
zip = require('gulp-zip');
fs = require('fs');
path = require('path');

var config = {
    bowerDir: './bower_components'
};

// Default error handler
var onError = function (err) {
    console.log('An error occured:', err.message);
    this.emit('end');
};

// Zip theme files up
gulp.task('zip', function () {
    return gulp.src([
        '*',
        './fonts/*',
        './images/*',
        './inc/*',
        './js/**/*',
        './languages/*',
        './sass/**/*',
        './template-parts/*',
        './favicon.ico',
        '!bower_components',
        '!node_modules',
        '!plugins',
    ], {base: "."})
        .pipe(zip('gossenpoeten_theme.zip'))
        .pipe(gulp.dest('./build'));
});

var pluginsPath = 'plugins';

function getFolders(dir) {
    return fs.readdirSync(dir)
        .filter(function(file) {
            return fs.statSync(path.join(dir, file)).isDirectory();
        });
}

gulp.task('plugins', function() {
    var folders = getFolders(pluginsPath);

    var tasks = folders.map(function(folder) {
        return gulp.src(path.join(pluginsPath, folder, '/**'))
            .pipe(zip(folder + '.zip'))
            .pipe(gulp.dest('./build'))
    });

    return tasks;
});

// Install all Bower components
gulp.task('bower', function () {
    return bower()
        .pipe(gulp.dest(config.bowerDir))
});

gulp.task('icons', function () {
    return gulp.src(config.bowerDir + '/fontawesome/fonts/**.*')
        .pipe(gulp.dest('./fonts'));
});

// Jshint outputs any kind of javascript problems you might have
// Only checks javascript files inside /src directory
gulp.task('jshint', function () {
    return gulp.src('./js/src/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter(stylish))
        .pipe(jshint.reporter('fail'));
});

// Concatenates all files that it finds in the manifest
// and creates two versions: normal and minified.
// It's dependent on the jshint task to succeed.
gulp.task('scripts', ['jshint'], function () {
    return gulp.src('./js/manifest.js')
        .pipe(include())
        .pipe(rename({basename: 'scripts'}))
        .pipe(gulp.dest('./js/dist'))
        // Normal done, time to create the minified javascript (scripts.min.js)
        // remove the following 3 lines if you don't want it
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./js/dist'))
        .pipe(notify({title: 'Javascript', message: 'scripts task complete'}))
    //.pipe( livereload() );
});

// Different options for the Sass tasks
var options = {};
options.sass = {
    errLogToConsole: true,
    precision: 8,
    noCache: true,
    //imagePath: 'assets/img',
    includePaths: [
        config.bowerDir + '/bootstrap-sass/assets/stylesheets',
        config.bowerDir + '/fontawesome/scss',
    ]
};

options.sassmin = {
    errLogToConsole: true,
    precision: 8,
    noCache: true,
    outputStyle: 'compressed',
    //imagePath: 'assets/img',
    includePaths: [
        config.bowerDir + '/bootstrap-sass/assets/stylesheets',
        config.bowerDir + '/fontawesome/scss',
    ]
};

// Sass
gulp.task('sass', function () {
    return gulp.src('./sass/style.scss')
        .pipe(plumber())
        .pipe(sass(options.sass))
        .pipe(autoprefixer())
        .pipe(gulp.dest('.'))
        .pipe(notify({title: 'Sass', message: 'sass task complete'}));
});

// Sass-min - Release build minifies CSS after compiling Sass
gulp.task('sass-min', function () {
    return gulp.src('./sass/style.scss')
        .pipe(plumber())
        .pipe(sass(options.sassmin))
        .pipe(autoprefixer())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('.'))
        .pipe(notify({title: 'Sass', message: 'sass-min task complete'}));
});

// Optimize Images
gulp.task('images', function () {
    return gulp.src('./images/**/*')
        .pipe(imagemin({progressive: true, svgoPlugins: [{removeViewBox: false}]}))
        .pipe(gulp.dest('./images'))
        .pipe(notify({title: 'Images', message: 'images task complete'}));
});


// Start the livereload server and watch files for change
gulp.task('watch', function () {
    //livereload.listen();

    // don't listen to whole js folder, it'll create an infinite loop
    gulp.watch(['./js/**/*.js', '!./js/dist/*.js'], ['scripts']);

    gulp.watch('./sass/**/*.scss', ['sass']);

    gulp.watch('./images/**/*', ['images']);

    gulp.watch('./**/*.php').on('change', function (file) {
        // reload browser whenever any PHP file changes
        //livereload.changed( file );
    });
});


gulp.task('default', ['watch'], function () {
    // Does nothing in this task, just triggers the dependent 'watch'
});