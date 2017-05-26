<!DOCTYPE html>
<html lang="en">
<head>
  <title>Whois viewed</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Naim Ahmed" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="jqueryPagination/simplePagination.css" />
  <script src="jqueryPagination/jquery.simplePagination.js"></script>
</head>
<body>

<div class="containerCustom" style="margin: 0 auto; width: 90%; padding: 10px;">

<div class="container" style="width: 80%; margin-top: 25px; margin-bottom: 25px;">
<?php

/**
 * @author Naim Ahmed
 * @copyright 2017
 */

require ('db.php');




/** Page limit */
$limit = 10;

/** Get Page number */
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} 
else {
    $page=1; 
}

/** Start Page */
$start_from = ($page-1) * $limit;  

/** Fetch from db with limit */
$sql = "SELECT * FROM visitor ORDER BY id DESC LIMIT $start_from, $limit"; 
$result = $conn->query($sql);

/** Start Table */
echo '<table class="table table-bordered table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>IP</th>';
echo '<th>Country</th>';
echo '<th>Region</th>';
echo '<th>City</th>';
echo '<th>ISP</th>';
echo '<th>ORG</th>';
echo '<th>Date</th>';
echo '<th>Time</th>';
echo '<th>OS</th>';
echo '<th>Browser</th>';
echo '</tr>';
echo '</thead>';

echo '<tbody>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["ip"]."</td>";
        echo "<td>".$row["country"]."</td>";
        echo "<td>".$row["regionName"]."</td>";
        echo "<td>".$row["city"]."</td>";
        echo "<td>".$row["isp"]."</td>";
        echo "<td>".$row["org"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["time"]."</td>";
        echo "<td>".$row["os"]."</td>";
        echo "<td>".$row["browser"]."</td>";
        echo '</tr>';
    }
}
else {
    echo "no results";
    exit;
}
echo '</tbody>';
echo '</table>';

$sql = "SELECT COUNT(id) AS totalRaw FROM visitor";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); //$row = $result->fetch_row();
$totalRaw = $row['totalRaw']; //$totalRaw = $row[0];
//echo $totalRaw; // For Debug

$total_pages = ceil($totalRaw / $limit);  
$pagLink = "<nav><ul class='pagination'>";
$pageName = $_SERVER['PHP_SELF'];  
for ($i=1; $i<=$total_pages; $i++) {
    //$pagLink .= "<li><a href='whois.php?page=".$i."'>".$i."</a></li>";
    $pagLink .= "<li><a href='".$pageName."?page=".$i."'>".$i."</a></li>";
};  
echo $pagLink . "</ul></nav>";

?>
</div>
</div>

<script type="text/javascript">
<!--

$(document).ready(function(){
    $('.pagination').pagination({
        items: <?php echo $totalRaw;?>,
        itemsOnPage: <?php echo $limit;?>,
        cssStyle: 'light-theme',
		currentPage : <?php echo $page;?>,
        //hrefTextPrefix : 'whois.php?page='
		hrefTextPrefix : '<?php echo $pageName;?>?page='
    });
});

-->
</script>

</body>
</html>