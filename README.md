# boardgame-forum

## Installation & Running

Before all, you will need an executable of `php` installed and a mysql server running.
You can get both from your distributions' package manager (they are usually distributed under `php` and `mariadb`, unless you're on Windows or OSX) or by installing XAMPP.

The MySQL server shall be spun up, a database created (you may name it `boardgameforum`) and the SQL dump imported from `SQL_table/boardgameforum.sql`.

### CLI

Clone this repository, navigate to the `pages/` directory and start up a test server:

```sh
git clone https://github.com/AlexisBouligand/boardgame-forum
cd boardgame-forum

cp config.php.sample config.php # Fills in a basic configuration file; feel free to edit the new `config.php` file

cd pages
# NOTE: We usually cannot listen on localhost:80 as it requires root privileges on most distros. Please don't run our code as root.
php -S localhost:8000
```

You might need to enable the `pdo_mysql` extension in your `php.ini`.

### PHPStorm

<!--
Why are you doing this to yourself?
Why am I doing this to myself?
This whole section is nonsense, why do people think they ever need an IDE for that kind of things?
-->

1. Get this project from version control, with as URL `https://github.com/AlexisBouligand/boardgame-forum`
2. Go to *R**u**n*, *Edit Configu**r**ations*
3. Add a new configuration (with the `+` icon on the top-left) as a *PHP Built-in Web Server*
4. Give it a cute name, like `boardgame-forum-with-extra-love`
5. Set the document root to the `pages/` folder
6. Set the port to 8000, unless your distribution lets you go with 80 without root privileges. Please don't run our code as root.
7. Hit `OK` (unless PHPStorm warns you about stuff you hadn't set up yet, in which case you should deal with that)
8. Copy the `config.php.sample` file to `config.php` and enter in your credentials for your MySQL database
9. You may now run the server using *R**u**n*, *Start*
10. The website will now be accessible by navigating to `http://localhost:8000/` in your browser
