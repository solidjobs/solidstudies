# source: https://medium.com/@juancarlosjc/angular-inside-laravel-b155736ea84b

npm install;
ng build --prod --aot;
rm -f ../../public/*.js;
rm -f ../../public/*.css;
rm -f ../../public/*.ico;
cp dist/solid-studies/*.js ../../public/;
cp dist/solid-studies/*.css ../../public/;
cp dist/solid-studies/*.ico ../../public/;
cp dist/solid-studies/index.html ../views/index.html;
