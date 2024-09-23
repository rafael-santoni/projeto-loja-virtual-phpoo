var gulp = require("gulp");
var uglify = require("gulp-uglify");
var concat = require("gulp-concat");

gulp.task("default", function() {
    // place code for your default task here
});

gulp.task("sitejs", function() {

    return gulp.src("./public/assets/js/site/*.js")
    .pipe(concat("all.js"))
    .pipe(uglify())
    .pipe(gulp.dest("./public/assets/js/dist/site"));

});

gulp.task("adminjs", function() {

    return gulp.src("./public/assets/js/admin/*.js")
    .pipe(concat("all.js"))
    .pipe(uglify())
    .pipe(gulp.dest("./public/assets/js/dist/admin"));

});
