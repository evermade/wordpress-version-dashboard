# WordPress Version Dashboard
Ever wanted to display version information from multiple WordPress blogs in one place? This small standalone backendless php app does just that. It's designed to be simple, lightweight and secure.

App required that you install the client plugin to your WordPress.

# Requirements
Web server capable of running php files is all you need.

# Configuring the server
* Copy files to your web server. It might be a good idea to prevent unwanted access for example with htaccess.
* Add list of your site urls to config.php:

  ```
  $config = array(
	  'http://www.officeanimals.com',
	  'http://www.kampiapina.com',
  );
  ```

* Change $apiKey to something secret.

  ```
  $apiKey = 'changethistosomethingelse';
  ```

# Configuring the client
* Install Version Dashboard Client plugin to your WordPress.
* Add your key to wp-config.php:

  ```define('WP_VERSION_DASHBOARD_KEY', 'changethistosomethingelse');```

# Support
Found an issue? Please tell me about it :)

https://github.com/evermade/wordpress-version-dashboard/issues

# Author

This plugins is created by [@jalajoki](https://twitter.com/jalajoki) from [Evermade](http://www.evermade.fi/).
