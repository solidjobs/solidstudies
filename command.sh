#!/bin/bash

case $1 in

    setup)
        php artisan migrate
        php artisan db:seed
        php artisan serve --host=0.0.0.0 --port=8001 > /dev/null 2>&1 &
        echo "
        setup and running
        "
        ;;

    serve)
        php artisan serve --host=0.0.0.0 --port=8001 > /dev/null 2>&1 &
        echo "
        artisan started.
        "
        ;;
    *)
        echo "
        setup - migrate, seed and serve
        serve - php artisan serve --host=0.0.0.0 --port=8001 > /dev/null 2>&1 &
        "
        ;;
esac
