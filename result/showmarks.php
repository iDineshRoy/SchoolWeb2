<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Show Marks</title>
	<?php require "connect.php"; ?>
	<?php include "../header.html" ?>


	<br>
	<h2 align="center">Rising Nepal Secondary Boarding School</h2>
	<h3 align="center">Mark-Sheet</h3>
	<hr>
	<div class="container">
<?php
	$query = "select NAME from studentdetails where STUDENTID='".$_POST["studentid"]."'";
	$result = mysqli_query($conn, $query)or trigger_error("Student not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	$row = "";
?>
<div class="alert alert-primary" role="alert">
<?php
	if ($row = mysqli_fetch_assoc($result)) {
		echo "Name: ".$row['NAME']."<br>Class: ".$_POST['clas'];
	}
?>
</div>
<hr>
<?php
	$querygetmarks = "select om.SUBJECTS, subject.FULLMARKS, subject.PASSMARKS, om.OBTAINEDMARKS from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='".$_POST['term']."' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resultom = mysqli_query($conn, $querygetmarks) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	$row2 = "";
	$numrows = mysqli_num_rows($resultom);
	$sumofom = "select sum(om.OBTAINEDMARKS) as value_sum, sum(subject.FULLMARKS) as fmsum from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='".$_POST['term']."' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resulttotalom = mysqli_query($conn, $sumofom) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
?>

<table class="table table-striped">
	<tr>
		<th>SUBJECTS</th><th>F.M.</th><th>P.M.</th><th>O.M.</th>
	</tr>	
	<?php while ($row2 = mysqli_fetch_assoc($resultom)) { ?>
	<tr>
		<td><?php echo $row2['SUBJECTS'];?></td><td><?php echo $row2['FULLMARKS']; ?></td><td><?php echo $row2['PASSMARKS']; ?></td><td><?php echo $row2['OBTAINEDMARKS']; ?></td> 
	</tr>

	<?php } ?>
</table>


	<div class="alert alert-success" role="alert">
<?php
	$row3 = 0;
	
	while ($row3=mysqli_fetch_assoc($resulttotalom)) {
		echo "TOTAL OBTAINED MARKS: ".$row3['value_sum']."<br>PERCENTAGE: ".round((($row3['value_sum']*100)/($row3['fmsum'])), 2);
	}
		
?>
</div>
</div>
	<?php mysqli_close($conn); ?>
	<?php include "../footer.html" ?>
</body>
</html>