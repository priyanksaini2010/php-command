<?php
/**
 * This is a help File called from the bash file
 * 
 * PHP 5
 * 
 * @category Configuration
 * @package  php-command
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */

$content = "Please follow following instructions".PHP_EOL;
$content = '1. Using php-command example submit_issues -u <username> -p <password> <repo url> "<title of issue >" "<content of issue>"'.PHP_EOL;
$example = 'submit_issues -u priyanksaini2010 -p mypassword https://github.com/priyanksaini2010/php-command "Title Of an issue" "this is a body/content of an issue";'.PHP_EOL;
$ps = 'PS: If username or password have # mark please use " i.e. doublequotes for username or password ';
$contact = "Contact me in case of any issue or query : priyanksaini2010@gmail.com";
echo $content.PHP_EOL;
echo 'Example:'.PHP_EOL;
echo $example.PHP_EOL;
echo $ps.PHP_EOL;
echo  $contact.PHP_EOL;
?>