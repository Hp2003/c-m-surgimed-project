To start Application run route.php on any port :-
Or run this command 
-> "php -S localhost:{portnumber} route.php"


/*****************************************************************************************************/


How flow works :-
-> From router request go to handler folder 

-> Handler handle request according to request method


/*****************************************************************************************************/

How to get database 
-> To get database run files from sql folder

/*****************************************************************************************************/


Start App when using xampp :-
-> Makesure dir is in htdocs folder with "C_M_surgimed" name

-> Goto "xampp\apache\conf" 

-> Open httpd.conf file

-> Go to line 252 DocumentRoot and changing following 

"C:/xampp/htdocs"
<Directory "C:/xampp/htdocs">

To 

"C:/xampp/htdocs/C_M_surgimed"
<Directory "C:/xampp/htdocs/C_M_surgimed">

-> Restart Apache server and start localhost site should run

-> To go back to normal remove "C_M_surgimed" and restart server


/*****************************************************************************************************/


How it works :-
-> Document root change root directory from htdocs to C_M_surgimed 


/*****************************************************************************************************/

