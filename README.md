Please follow the below step for installing the project in the system:

-Clone project

-Run below command for installing composer
   composer install

-Create new database or use existing database

-Setup database credential in .env file

-Run below command for table structure:
   php artisan migrate
   
-Run below command for run the cron job
    php artisan schedule:run
    
=======================================================================
Task Info : 
- Please upload your all xml file inside the "public\all_xml_files" folder
    projectpath\public\all_xml_files 

- find the all xml file and store data in database
  there is two way to store the data:
1. Every 5 min job will run and insert the data (if you schedule)
2. If you want to run manually script, click on "fetch & store data" button in website

- Using author name we can find the book name in the dashboard
