#!/bin/bash

case $1 in

    serve)
        php artisan serve --host=0.0.0.0 --port=8001 > /dev/null 2>&1 &
        echo "
        artisan started.
        "
        ;;
    *)
        echo "
        serve - php artisan serve --host=0.0.0.0 --port=8001 > /dev/null 2>&1 &
        "
        ;;
esac
