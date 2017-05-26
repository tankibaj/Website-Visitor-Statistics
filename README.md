# Website Visitor Statistics
## Installation 
1. Download all files and folder as a zip and unzip on webserver.
2. Import "visitor.sql" to MySQL server.
2. Change 'username', 'password' and 'dbname' in "db.php"
3. Add below code which pages you would want to see visitor statistics.

```
<?php
include ('visitor.php');
?>
