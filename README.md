# Final Exam Web Application

This is a web application built with Bootstrap, SASS, PHP, and MySQL.

## Features

- Bootstrap with custom SASS compilation
- Text-primary color customized to red
- Form to submit messages to database
- Display all records with delete functionality
- SQL injection protection using prepared statements

## File Structure

- `css/` - Compiled CSS files
- `scss/` - SASS source files
- `js/` - JavaScript files
- `includes/` - PHP includes (header, footer)
- `db/` - Database connection and setup files
- `index.php` - Main page with form
- `showAll.php` - Display all records and delete functionality
- `hello.html` - Test page for Bootstrap setup

## Bootstrap Customization

The `$primary` variable has been set to red in `scss/bootstrap.scss`, making all `.text-primary` classes display in red color.

## Security

All database operations use prepared statements to prevent SQL injection attacks.
