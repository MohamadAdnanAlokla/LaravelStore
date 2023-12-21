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

6-for login as admin :
  
   Email : admin@example.com
   password : password
   
   ![1](https://github.com/MohamadAdnanAlokla/LaravelStore/assets/154502735/f90e80e3-6a26-4b37-bd32-45d6403f9e2e)

![2](https://github.com/MohamadAdnanAlokla/LaravelStore/assets/154502735/9a9b51c4-a664-4400-a4ec-034fa2ef05a2)
![3](https://github.com/MohamadAdnanAlokla/LaravelStore/assets/154502735/6d231a99-8965-458f-b2cd-c9ba0743027c)



   
