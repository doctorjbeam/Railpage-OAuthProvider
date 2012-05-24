Railpage-OAuthProvider
============

This project was forked from djpate/OAuthProviderExample

What is this project?
---------------------

I needed some way of authenticating users against the database when not using the Railpage site - the search API and any handheld apps spring to mind as examples.

What does it do?
----------------

* Creates token and token_secret
* Assigns a user ID to that token
* Provides a callback URL for each token

Contributing
------------

Anyone is free to fork this code as they see it, but be warned: it does have a lot of Railpage-specific alterations. RP devs can of course fork and use this code. 

Changes from upstream
---------------------

* The User class has been renamed to OAuthUser as it was causing conflicts. 
* Eventually this will be modified to use namespaces, as per RP's direction
* __autoload() functions have been replaced with spl_autoload_register(), which are defined in mainfile.php (outside the scope of this project)
* Database column names have been changed to suit Railpage

### Author
Authored by Michael Greenhill. Licensed under MIT License.
