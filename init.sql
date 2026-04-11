CREATE DATABASE IF NOT EXISTS admin_edinz;
CREATE DATABASE IF NOT EXISTS admin_inspiress;
CREATE DATABASE IF NOT EXISTS edinztec_admin;

CREATE USER IF NOT EXISTS 'admin_edinz'@'%' IDENTIFIED BY 'Ke2FES@e4evxIUT';
GRANT ALL PRIVILEGES ON admin_edinz.* TO 'admin_edinz'@'%';

CREATE USER IF NOT EXISTS 'admin_inspiress'@'%' IDENTIFIED BY 'Ke2FES@e4evxIUT';
GRANT ALL PRIVILEGES ON admin_inspiress.* TO 'admin_inspiress'@'%';

CREATE USER IF NOT EXISTS 'edinztec_admin'@'%' IDENTIFIED BY 'Ke2FES@e4evxIUT';
GRANT ALL PRIVILEGES ON edinztec_admin.* TO 'edinztec_admin'@'%';

FLUSH PRIVILEGES;