# simple-php-pdo-class

#This is a simple php pdo Database management class

# How to use
Edit the ugophppdo to set dataabse options i.e Database type, Database host, Database username, Dataabse password
Include the ugophppdo class into your php project
Then make an instance of the ugophppdo class and call needed functions

# Example
<?php
include "ugophppdo.php";
$instance_variable = new ugophppdo("Your_database_name");
$all = $instance_variable->execute_return("SELECT * FROM `Your_Table` WHERE 1"); //mysql select example
?>

For inquiries and support contact me at Mathewfortune54@gmail.com or call +2349083273485
