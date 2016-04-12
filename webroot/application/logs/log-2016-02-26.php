<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-02-26 13:45:53 --> Severity: Warning --> mysqli::real_connect(): php_network_getaddresses: getaddrinfo failed: No such host is known.  C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 161
ERROR - 2016-02-26 13:45:53 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): php_network_getaddresses: getaddrinfo failed: No such host is known.  C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 161
ERROR - 2016-02-26 13:45:53 --> Unable to connect to the database
ERROR - 2016-02-26 13:46:51 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 161
ERROR - 2016-02-26 13:46:51 --> Unable to connect to the database
ERROR - 2016-02-26 13:47:01 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 161
ERROR - 2016-02-26 13:47:01 --> Unable to connect to the database
ERROR - 2016-02-26 13:49:18 --> Severity: Warning --> mysqli::query(): MySQL server has gone away C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 264
ERROR - 2016-02-26 13:49:18 --> Severity: Warning --> mysqli::query(): Error reading result set's header C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 264
ERROR - 2016-02-26 13:49:18 --> Query error: MySQL server has gone away - Invalid query: 
            SELECT
              *
            FROM semesters
            WHERE semesters.end >= NOW()
ERROR - 2016-02-26 13:58:11 --> Severity: Warning --> mysqli::query(): MySQL server has gone away C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 264
ERROR - 2016-02-26 13:58:11 --> Severity: Warning --> mysqli::query(): Error reading result set's header C:\Users\Annamalai\Desktop\AnotherOne\webroot\system\database\drivers\mysqli\mysqli_driver.php 264
ERROR - 2016-02-26 13:58:11 --> Query error: MySQL server has gone away - Invalid query: 
            SELECT
              courseprequisites.prerequisite_course_id
            FROM courseprequisites
            WHERE courseprequisites.course_id = '39'
