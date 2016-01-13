Core Project Application
===========================================

### Contents
- [Application Setup](#application-setup)
- [Github Rules](#github-rules)
- [Code Rules](#code-rules)

### Application Setup ###

For the project to run properly on your computer, there will be a few steps before running the web app.

1. Install WAMP for Windows or MAMP for mac. 
  - Comes with PHP 5.5 (http://www.wampserver.com/en/)
2. Install PHP to PATH.
  - If you have wamp installed. The path to the php program is located in dir wamp\bin\php\php5.5.12
  - Google how to (https://www.google.ca/search?q=how+to+install+program+to+path&gws_rd=ssl)
  - To see if php was installed properly type in the command prompt "php v-"
  - If you have problems with php. Install the latest version of Visual C++ Redistributable Packages
3. Import database tables according to the latest version in dir AnotherOne\webroot\files_database
4. Configure database login in AnotherOne\webroot\config\database. If the user is root and pass '' then skip this step.
  - Please ignore this file when uploading to the git repository if your login is different. Or change your login details of your database.
5. If you have followed these instructions correctly, run the server.bat file in AnotherOne\webroot and the website is located at localhost:8000

In summary: install wamp, add php to PATH, config database, and run server.bat

##### Note

- PHP version 7 has a few problems with CodeIngniter. So just download Wamp.

### Github Rules ###

Before committing code to any branch of the repository make sure of the following.

1. If it's a coding commit, name it "Version *.**: @details" be consistent and short.
  - @details must report changes, implementations, improvements, bugs or deletions.
2. Never merge a huge branch to the master by yourself.

### Code Rules ###

A few rules in coding.

1. Comment tags are used to quick search in code to notify users what has to be done.
  1. "TODO: " describes what has to be created or done.
  2. "FIX: " describes what needs to be fixed.
  3. "BUG: " describes the bug executed at this line.
