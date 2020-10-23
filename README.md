# boardgame-forum

## Installation & Running

### CLI

With `php` installed, navigate to the `pages/` directory and start up a test server:

```sh
git clone https://github.com/AlexisBouligand/boardgame-forum
cd boardgame-forum
# Fills in a basic configuration file
cp config.php.sample config.php
cd pages
# NOTE: We usually cannot listen on localhost:80 as it requires root privileges on most distros. Please don't run our code as root.
php -S localhost:8000
```

You might need to enable the `pdo_mysql` extension in your `php.ini`.
