<?
/*
--File:functions.php
--Purpose: This file is a wrapper file that will hold include all of the various function files that allows the system to run smoothly.
--It will automatically load every required file within the classes and functions folders




*/
require('includes/configuration/config.php');  // this loads the configuration file that will hold all of the data to make the database work
require('includes/libraries/utilities.php');   // this loads the utilities library that will hold most generic functions such as bind, execute, and date conversions.  Most database functions are deprecated and should be used with the new Database object

require('includes/libraries/file_functions.php'); // this loads the file_functions library that will allow file uploads.

loadFiles();
loadClasses();
require('includes/libraries/connection.php');  //Holds the connection data for the database.

require($config_dir."classes.php");  //Require Site Specific Classes
require($config_dir."functions.php");  //Require Site Specific Functions
$document = new Document();

?>