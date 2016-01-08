## Website Structure

All web pages are related to the file structure in the www directory.

### Page Creation
All pages start by correctly including the load.php, setting the site-title, and calling the get_header().

The main content and custom scripts are written in the middle.

And in the end, calling the get_footer().

### Scripting Structure
- load.php requires
	- configuration.php -> Settings
		- Database Info
		- Site Name
	- libraries.php -> Includes all libraries
	- utlities.php -> Free functions
	- session.php -> Session handling
	- theme.php -> Theme Handling
		- get_header() -> Includes header.php
		- get_nagivation() -> Includes navigation.php
		- get_footer() -> Includes footer.php




