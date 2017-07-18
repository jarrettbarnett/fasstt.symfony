Symfony 3 Issue Tracker
==========

Setup projects and create issues, for the fun of it!
-----


Getting Started
-------------

1. Update app configuration as needed for your dev environment:


    /app/config/config.yml
    /app/config/config_dev.yml
    /app/config/config_test.yml
    /app/config/config_prod.yml
    /app/config/parameters.yml

2. Run database schema (Important: note that Symfony 3 changed app/console to bin/console):


    $ php bin/console doctrine:schema:update --force
    
3. Compile front-end assets using npm (node package manager) and grunt

    $ cd static
    $ npm install
    $ grunt
    