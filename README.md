Silex Base Project
------------------

A simple Silex base project with routing, twig templates, database connection and some other cool stuff.

## Requirements

* PHP >= 5.5.9
* Composer
* Apache Web Server

*NOTE*: If you're using another webserver, take a look at the [official documentation](http://silex.sensiolabs.org/doc/2.0/web_servers.html) on how to properly set it up.

## Running the app

1. Clone the repo or get from Packagist by running `composer create-project --prefer-dist mathcale/silex-base-project` on your websever root (e.g. `/var/www/html` ou `C:/wamp/www`)
2. `cd silex-base-project`
3. Edit the `.env` file with your database connection
4. Start your web server and go to the project's url (e.g. `http://localhost/silex-base-project`)
5. Have fun using Silex!

## Tips
* If you want to use npm packages, make sure to update your `.gitignore` with the `node_modules` folder

## License

MIT License

Copyright (c) 2017 Matheus Calegaro

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.