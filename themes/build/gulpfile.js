/*
 * gulp                                         - clean & build & watch
 * gulp build                                   - clean & build & minify
 * gulp clean                                   - clean
 * gulp build -- mask gov1 --theme default      - можно указать отдельно маску и тему
 */

var gulp = require("gulp"),
    del = require("del"),
    argv = require("yargs").argv,
    pipeline = require("readable-stream").pipeline,
    mergeStream = require("merge-stream"),
    sourcemaps = require("gulp-sourcemaps"),
    /* css */
    sass = require("gulp-sass"),
    cleanCss = require("gulp-clean-css"),
    /* js */
    browserify = require("browserify"),
    babelify = require("babelify"),
    uglify = require("gulp-uglify"),
    watchify = require("watchify"),
    source = require("vinyl-source-stream"),
    buffer = require("vinyl-buffer"),
    log = require("gulplog");

var mask = argv.mask || "*",
    theme = argv.theme || "*";

// пришлось все перечислить, т.к. не знаю как в dest правильно прописать значение
var masks = ["base"];

var dst = "../../public";

gulp.task("clean", function () {
    return del(
        [
            dst + "/css/themes/" + mask + "/" + theme + "/*.css",
            dst + "/css/themes/" + mask + "/" + theme + "/*.css.map",
            dst + "/js/themes/" + mask + "/" + theme + "/main.js",
            dst + "/js/themes/" + mask + "/" + theme + "/main.js.map",
        ],
        { force: true }
    );
});

/* CSS */

gulp.task("build-css", function () {
    if (mask != "*") {
        masks = [mask];
    }

    var streams = [];
    for (var i in masks) {
        streams.push(
            gulp
                .src("../" + masks[i] + "/sass/" + theme + "/theme.scss")
                .pipe(sass().on("error", sass.logError))
                // опять же хитрости с dist, подскажите, если есть способ проще
                .pipe(
                    gulp.dest(
                        theme == "*"
                            ? dst + "/css/themes/" + masks[i]
                            : dst + "/css/themes/" + masks[i] + "/" + theme
                    )
                )
        );
    }
    return mergeStream(streams);
});

gulp.task("minify-css", function () {
    if (mask != "*") {
        masks = [mask];
    }

    var streams = [];
    for (var i in masks) {
        streams.push(
            gulp
                .src("css/themes/" + masks[i] + "/" + theme + "/*.css")
                .pipe(sourcemaps.init())
                .pipe(cleanCss())
                .pipe(sourcemaps.write("."))
                // опять же хитрости с dist, подскажите, если есть способ проще
                .pipe(
                    gulp.dest(
                        theme == "*"
                            ? dst + "/css/themes/" + masks[i]
                            : dst + "/css/themes/" + masks[i] + "/" + theme
                    )
                )
        );
    }
    return mergeStream(streams);
});

gulp.task("watch-css", function () {
    gulp.watch("../**/*.scss", gulp.series("build-css"));
});

/* JS */
// без watchify код вы глядел намного аккуратнее, но работало медленно

var jsBundleOpts,
    jsBundler,
    browserifyOpts = {
        entries: "../" + mask + "/js/main.js",
        debug: true,
        // defining transforms here will avoid crashing your stream
        transform: [
            babelify.configure({
                presets: ["@babel/preset-env"],
            }),
        ],
        paths: ["./node_modules"],
    };

function jsBundle() {
    return jsBundler
        .bundle()
        .on("error", log.error.bind(log, "Browserify Error"))
        .pipe(source("main.js"))
        .pipe(buffer())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(uglify())
        .on("error", log.error)
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest(dst + "/js/themes/" + mask + "/" + theme));
}

function jsWatchBundle() {
    return jsBundler
        .bundle()
        .on("error", log.error.bind(log, "Browserify Error"))
        .pipe(source("main.js"))
        .pipe(buffer())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest(dst + "/js/themes/" + mask + "/" + theme));
}

gulp.task("config-js", function (done) {
    jsBundleOpts = browserifyOpts;
    jsBundler = browserify(jsBundleOpts);
    done();
});

gulp.task("config-watch-js", function (done) {
    jsBundleOpts = Object.assign({}, watchify.args, browserifyOpts);
    jsBundler = watchify(browserify(jsBundleOpts));
    jsBundler.on("update", jsWatchBundle); // on any dep update, runs the bundler
    jsBundler.on("log", log.info); // output build logs to terminal
    done();
});

gulp.task("build-js", jsBundle);
gulp.task("build-n-watch-js", jsWatchBundle);

gulp.task("minify-js", function () {
    return pipeline(
        gulp.src(dst + "/js/themes/**/main.js"),
        uglify(),
        gulp.dest(dst + "/js/themes")
    );
});

/* EXPORT */

exports.default = gulp.series(
    "clean",
    "build-css",
    "config-watch-js",
    "build-n-watch-js",
    "watch-css"
);

exports.build = gulp.series(
    "clean",
    "build-css",
    "minify-css",
    "config-js",
    "build-js"
    // 'minify-js' уже мумифицируется в build-js
);

exports.clean = gulp.series("clean");
