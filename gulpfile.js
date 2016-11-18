var gulp        = require('gulp'),
    less        = require('gulp-less'),
    minifyCss   = require('gulp-minify-css'),
    plumber     = require('gulp-plumber'),
    babel       = require('gulp-babel'),
    uglify      = require('gulp-uglify'),
    clearnHtml  = require("gulp-cleanhtml");
    imagemin    = require('gulp-imagemin');
    browserSync = require('browser-sync').create(),
    reload      = browserSync.reload;
    
// 定义源代码的目录和编译压缩后的目录
var src='Template/default_src',
    dist='Template/default'

// 编译全部less 并压缩
gulp.task('css', function(){
    gulp.src(src+'/**/*.less')
        .pipe(less())
        .pipe(minifyCss())
        .pipe(gulp.dest(dist))
})

// 编译全部js 并压缩
gulp.task('js', function() {
  gulp.src(src+'/**/*.js')
    .pipe(plumber())
    .pipe(babel({
      presets: ['es2015']
    }))
    .pipe(uglify())
    .pipe(gulp.dest(dist));
});

// 压缩全部html
gulp.task('html', function () {
    gulp.src(src+'/**/*.html')
    .pipe(clearnHtml())
    .pipe(gulp.dest(dist));
});

// 压缩全部html
gulp.task('image', function () {
    gulp.src([src+'/**/image/*'])
    .pipe(imagemin())
    .pipe(gulp.dest(dist));
});

// 自动刷新
gulp.task('server', function() {
    browserSync.init({
        proxy: "tbjyblog.com", // 指定代理url
        notify: false, // 刷新不弹出提示
        open: false, // 不自动打开浏览器
    });
    // 监听less文件编译
    gulp.watch(src+'/**/*.less', ['css']);   
    // 监听html文件变化后刷新页面
    gulp.watch(src+"/**/*.js", ['js']).on("change", reload);
    // 监听html文件变化后刷新页面
    gulp.watch(src+"/**/*.html", ['html']).on("change", reload);
    // 监听css文件变化后刷新页面
    gulp.watch(src+"/**/*.css").on("change", reload);
});

// 监听事件
gulp.task('default', ['server'])