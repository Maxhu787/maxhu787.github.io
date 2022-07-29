mysql -u root -p
GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' IDENTIFIED BY 'password';
\q

DELETE FROM mysql.user 
WHERE  user = 'root' 
     AND host = 'localhost';