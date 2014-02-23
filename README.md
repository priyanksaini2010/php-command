PHP-Command Application is for Creating New Issues To Bitbucket and GitHub.

This application can further extend for other domain, with the help of domain 
variable set in /Lib/Configuration/config.ini

Installation Instructions:

1. clone git repo to www directory via git clone https://github.com/priyanksaini2010/php-command.git
2. cd /path/to/php-command/
3. type export PATH=$PATH::directory and press enter
4. run submit_issues -u "username" -p "password" "domain" "repo-slug" "title of issue" "body of Issue"

Domain : As we have configured only two domains right now so use  github/bitbucket <For Adding more Please See Extend.md> 


