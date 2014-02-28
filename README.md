PHP-Command Application is for Creating New Issues To Bitbucket and GitHub.

This application can further extend for other domain, with the help of domain 
variable set in /Lib/Configuration/config.ini

Installation Instructions:

1. clone git repo to www directory via git clone https://github.com/priyanksaini2010/php-command.git
2. cd /path/to/php-command/
3. type export PATH=$PATH::directory and press enter.
4. run submit_issues -u username -p password repourl "title of issue" "body of issue"

Example : 
submit_issues -u priyanksaini2010 -p mypassword https://github.com/priyanksaini2010/php-command "Issue Title" "Content"

PS: if you have "#" in your password or username, please user " before and after same example "#mypassword".


Please see Code Documentation for class refferences.
Code Documentation can be found in folder CodeDocV.4 of this repository.


