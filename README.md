# 470-project

A web application designed to facilitate the trading of school materials such as textbooks.
Needs PHP to run https://windows.php.net/download#php-7.2

To  run:
1. Clone/download the repo.
2. Install Composer, dependency manager for PHP (https://getcomposer.org/download/)
3. Add the 'php' folder to PATH.
4. Download MongoDB Community Edition (https://docs.mongodb.com/manual/administration/install-community/)
5. Add the 'bin' folder inside the MongoDB install location to PATH.
6. Inside the top folder, run "composer install".
7. Run the database server locally by entering the command 'mongod --dbpath="\data\db"'.
8. Initialize the web application by running 'setup.php' within the 'setup' folder.
9. Run the web application by navigating to the 'webroot' folder and running 'php -S localhost:\<port\>'

<br>
Adding scripts to setup the web application (e.g. adding database scripts):
- Add the .php script to the 'setup' folder and include the file in 'setup.php'.
- The script can be loaded by running 'php \<scriptname\>' without having to reinitialize the web application. Otherwise, run 'setup.php' to load the script.

