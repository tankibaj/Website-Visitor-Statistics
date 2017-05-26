DROP TABLE IF EXISTS visitor;

CREATE TABLE IF NOT EXISTS visitor (
id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
ip varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
country varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
countryCode varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
regionName varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
region varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
city varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
zip varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
lat varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
lon varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
timezone varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
isp varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
org varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
date varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
time varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
query_string varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
http_referer varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
os varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
browser varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
web_page varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
isbot varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
);