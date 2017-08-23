# tgsp
The Garage Sale Tracker/Project - Written in PHP + MariaDB 

Track your garage sale! 


# For your own server: 

First, clone this project. 

<code>git clone https://github.com/cdknight/tgsp.git </code>
Have a working apache2 server and mariadb installation.

In MariaDB, create a user with name 'default_u' and set a password.
<code>mysql -u root -h localhost -p</code>
and enter your password. Change localhost to whatever the host name of the DB is. 
<code>CREATE USER 'default_u'@'localhost' IDENTIFIED BY 'your password here';</code><br>
Change the php code to reflect your password. 
<code>GRANT ALL ON tgsp_catalog.* TO 'default_u'@'localhost';</code><br>
<code>GRANT ALL ON tgsp_users.* TO 'default_u'@'localhost';</code><br>

Copy code to folder 'tgsp' in htdocs. 

Head to <a href="http://localhost/tgsp">http://localhost/tgsp</a>

Feel free to change the code and enjoy! (Of course, the password matching is not secure, will be fixed later)
