Setting Up a New Laravel Project and Adding TCPDF Library:
  
  1-Create a New Laravel Project:
    
    Use Composer to create a new Laravel project:
    css
    Copy code
    composer create-project --prefer-dist laravel/laravel [project-name]
    Replace [project-name] with the desired name for your project.
  
  2-Navigate to the Project Directory:
  
    Once the installation is complete, navigate to the newly created project directory:
    bash
    Copy code
    cd [project-name]
  
  3-Set Up the Database:
  
    Open your preferred database management tool (such as PHPMyAdmin or MySQL Workbench).
    Create a new database and name it "store".
    
  4-Import the SQL Database File:
  
    Access the "store" database you've created.
    Use the import function in your database management tool to import the provided SQL file from folder (SQL FILE).
 
  5-Add TCPDF Library:
  
    Download TCPDF library from https://sourceforge.net/projects/tcpdf/.
    After downloading, extract the files.
    Move the TCPDF folder you extracted into the vendor directory of your Laravel project.
