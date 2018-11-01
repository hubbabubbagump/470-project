# 470-project

A web application designed to facilitate the trading of school materials such as textbooks.

TO RUN:
1. Complete Setup
2. Run the database server locally by entering the command 'mongod --dbpath="\data\db"'.
3. Initialize the web application by running 'php setup.php' within the 'setup' folder.
4. Run the web application by navigating to the 'webroot' folder and running 'php -S localhost:\<port\>'

Setup:
1. Clone/download the repo.
2. Install PHP (https://windows.php.net/download#php-7.2)
3. Install Composer, dependency manager for PHP (https://getcomposer.org/download/)
4. Add the 'php' folder to PATH.
5. Download MongoDB Community Edition (https://docs.mongodb.com/manual/administration/install-community/)
6. Add the 'bin' folder inside the MongoDB install location to PATH.
7. Inside /application AND /webroot, run "composer install"

To Run on Google Cloud Platform:
1. Start the VM called "instance-1"
2. Start the VM called "mongodb"

DevOps Info:
instance-1 is running the website through Windows IIS
The website files are located in "C:\Program Files\470-project-master"
mongodb is running a Mongodb Service
The database files are located in "C:\data\db"
Please contact Matthew if database changes need to be made
Both VM's should automatically start their respective parts, so there is no need to enter any commands.
The website connects to the internal IP, so the external IP should not matter.
Currently, the gcp firewall allows internal connections on port 27017
If you deploy changes to the Mongodb make sure you turn the service on and off, this can be done from Task Manager-> Services.
If you push changes to the website, make sure you restart the service through IIS. Also make sure your browser isn't keeping things in cache, force reload page with ctrl f5

<br>
Adding scripts to setup the web application (e.g. adding database scripts):
- Add the .php script to the 'setup' folder and include the file in 'setup.php'.
- The script can be loaded by running 'php \<scriptname\>' without having to reinitialize the web application. Otherwise, run 'setup.php' to load the script.
