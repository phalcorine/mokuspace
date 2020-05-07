Requirements:
=============
1) PHP 7.2 or later
2) Phalcon PHP extension -
        version: 3.4
        architecture: 64-bit

Instructions:
=============

A guide for XAMPP installation is included in the
xampp_setup.txt file located in the project's
root directory

1) Download the Phalcon PHP extension from the official website:
        http://phalcon.io   > Downloads.
    For Windows
        - download the version labelled 'phalcon_x64_vc15_php{php_version}_3.4.5-4250.zip'

2) Extract the contents of the Phalcon PHP zip archive.

3) Copy the file labelled 'php_phalcon.dll' to the php ext directory

4) Enable the Phalcon extension in your php.ini file

5) Enable custom virtual hosts. Virtual host used are stored
in the examples.txt file contained in the project's root directory

Preparing the Application:
=========================

1) cd to the project directory.

2) Run:

        php run script init
        
to create the database tables and populate the database from 
public API. If the command does not work, please make sure your 
PHP CLI Interpreter path has been set in your environment
variable.

3) Visit this API Endpoint: 

        api.moviespace.code

7) On your browser, visit:

        API Docs - api.moviespace.code/index.html
        
        Web App: moviespace.code
        
to start up the application...
