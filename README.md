timber-oop-demo-theme
=====================

This is a bare bone Timber starter theme for Wordpress that tries to show how to start writing a WP theme in a OOP manner. At the moment it's very rough and doesn't contain anything else than just the Timber framework, a Theme base class and some basic templates from the original Timber starter theme.

#How to install
To do WP theme development I recommend that you use a virtual machine to run your dev environment. This can easily be achieved using [VirtualBox](https://www.virtualbox.org/wiki/Downloads), [Vagrant](http://www.vagrantup.com/downloads.html) and [PuPHPet](https://puphpet.com) completely free. Once you have your dev environment up and running. I recommend that you use symlinks to include your different theme projects in the `/wp-content/themes` folder so you easily can switch between your different themes. The symlink can easily be set up in the PuPHPet configuration UI `Deploy Target -> Sharing Folders with Local VM`.

```
cd /path/to/your/git/repos/folder
git clone git@github.com:ricwa230/timber-oop-demo-theme.git
cd timber-oop-demo-theme
composer install
```

Now your can head over to the WP site and login to activate the Timber theme. If you view the site you should see some unstyled bare bone markup.

#How to continue to develop
The key with this theme is that it uses [Composer](https://getcomposer.org) for dependency tracking and auto loading of the code. In the theme I have started with some conventions following the psr-0 standard when it comes to folder structure and namespaces. As mentioned the idea is the keep all spaghetti code that usually fills up the `functions.php` in a `Theme` class to get you started with OO programming. This will give you some hints how to write everything that you usually wrote like global function in a singleton class and extend the functionality of Timber and Twig.

The general way Timber is distributed is like a WP plugin and to make your theme work this plugin needs to be installed and activated. This theme includes Timber as a dependency declared in the `composer.json` and makes sure that the Timber code is autoloaded together with the Theme src by calling `require 'vendor/autoload.php';` in `functions.php`. So because of that you don't have to bother with installing the plugin and checking if it's activated. Just run `composer install` and add your code according to psr-0 in the `src/` dir and all your classes will be loaded automatically together with Timber and other dependencies tracked by Composer.

If you prefer psr-4 or some other standard this could be changed by changing the `autoload` property in the `composer.json` to psr-4 instead of psr-0.

```json
{
	...
	"autoload": {
        "files": ["wp-content/plugins/timber/timber.php"],
        "psr-0": {"TimberTheme\\": "src/"}
    }
}
```