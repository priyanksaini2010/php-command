#!/bin/bash
# This a Shell Script For creating new issues to Git And BitBucket
exec php -q index.php username $2 password $4 domail $5 repo $6 title "$7" content "$8"