<!DOCTYPE html>
<html>
<head>
	<!-- Annual Grade-Sheet -->
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
	<h3 align="center">Annual Grade-Sheet<?php echo " ".$_POST['year']; ?></h3>
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
	$querygetmarks1 = "select om.SUBJECTS, subject.FULLMARKS, subject.PASSMARKS, om.OBTAINEDMARKS from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='1' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resultom1 = mysqli_query($conn, $querygetmarks1) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	$rowom1 = "";
	$querygetmarks2 = "select om.SUBJECTS, subject.FULLMARKS, subject.PASSMARKS, om.OBTAINEDMARKS from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='2' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resultom2 = mysqli_query($conn, $querygetmarks2) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	$rowom2 = "";

	$querygetmarks3 = "select om.SUBJECTS, subject.FULLMARKS, subject.PASSMARKS, om.OBTAINEDMARKS from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='3' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resultom3 = mysqli_query($conn, $querygetmarks3) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	$rowom3 = "";

	$querygetmarks4 = "select om.SUBJECTS, subject.FULLMARKS, subject.PASSMARKS, om.OBTAINEDMARKS from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='4' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resultom4 = mysqli_query($conn, $querygetmarks4) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	$rowom4 = "";


	$numrows = mysqli_num_rows($resultom1);
	$sumofom1 = "select sum(om.OBTAINEDMARKS) as value_sum, sum(subject.FULLMARKS) as fmsum from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='1' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resulttotalom1 = mysqli_query($conn, $sumofom1) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

	$sumofom2 = "select sum(om.OBTAINEDMARKS) as value_sum, sum(subject.FULLMARKS) as fmsum from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='2' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resulttotalom2 = mysqli_query($conn, $sumofom2) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

	$sumofom3 = "select sum(om.OBTAINEDMARKS) as value_sum, sum(subject.FULLMARKS) as fmsum from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='3' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resulttotalom3 = mysqli_query($conn, $sumofom3) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

	$sumofom4 = "select sum(om.OBTAINEDMARKS) as value_sum, sum(subject.FULLMARKS) as fmsum from om RIGHT JOIN subject on om.SUBJECTS=subject.SUBJECTS and om.CLASS=subject.CLASS WHERE om.CLASS='".$_POST['clas']."' and om.STUDENTID='".$_POST['studentid']."' and om.TERM='4' and om.YEAR='".$_POST['year']."' and subject.YEAR='".$_POST['year']."'";
	$resulttotalom4 = mysqli_query($conn, $sumofom4) or trigger_error("Mark-Sheet not found! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
?>
<?php $gpa=0; ?>
<table class="table table-striped">
	
	<tr>
		<th>SUBJECTS</th><th>F.G.</th><th>G.P.</th>	
	</tr>	
	
	<?php while (($rowom1 = mysqli_fetch_assoc($resultom1)) and ($rowom2 = mysqli_fetch_assoc($resultom2)) and ($rowom3 = mysqli_fetch_assoc($resultom3)) and ($rowom4 = mysqli_fetch_assoc($resultom4))) { ?>
	<tr>
		<td><?php echo $rowom1['SUBJECTS'];?></td>
		<td>
		<?php  
			$totom=(0.1*$rowom1['OBTAINEDMARKS']+0.2*$rowom2['OBTAINEDMARKS']+0.3*$rowom3['OBTAINEDMARKS']+0.4*$rowom4['OBTAINEDMARKS']); 
			if (($totom*100)/$rowom4['FULLMARKS']>=90) {
				echo "A+";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=80 and ($totom*100)/$rowom4['FULLMARKS']<90) {
				echo "A";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=70 and ($totom*100)/$rowom4['FULLMARKS']<80) {
				echo "B+";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=60 and ($totom*100)/$rowom4['FULLMARKS']<70) {
				echo "B";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=50 and ($totom*100)/$rowom4['FULLMARKS']<60) {
				echo "C+";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=40 and ($totom*100)/$rowom4['FULLMARKS']<50) {
				echo "C";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=30 and ($totom*100)/$rowom4['FULLMARKS']<40) {
				echo "D+";
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=20 and ($totom*100)/$rowom4['FULLMARKS']<30) {
				echo "D";
			}
			else{
				echo "E";
			}

		?></td> 
		<td>
			<?php $totom=(0.1*$rowom1['OBTAINEDMARKS']+0.2*$rowom2['OBTAINEDMARKS']+0.3*$rowom3['OBTAINEDMARKS']+0.4*$rowom4['OBTAINEDMARKS']); 
			if (($totom*100)/$rowom4['FULLMARKS']>=90) {
				echo "4";
				$gpa=$gpa+4;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=80 and ($totom*100)/$rowom4['FULLMARKS']<90) {
				echo "3.6";
				$gpa=$gpa+3.6;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=70 and ($totom*100)/$rowom4['FULLMARKS']<80) {
				echo "3.2";
				$gpa=$gpa+3.2;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=60 and ($totom*100)/$rowom4['FULLMARKS']<70) {
				echo "2.8";
				$gpa=$gpa+2.8;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=50 and ($totom*100)/$rowom4['FULLMARKS']<60) {
				echo "2.4";
				$gpa=$gpa+2.4;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=40 and ($totom*100)/$rowom4['FULLMARKS']<50) {
				echo "2.0";
				$gpa=$gpa+2.0;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=30 and ($totom*100)/$rowom4['FULLMARKS']<40) {
				echo "1.6";
				$gpa=$gpa+1.6;
			}
			elseif (($totom*100)/$rowom4['FULLMARKS']>=20 and ($totom*100)/$rowom4['FULLMARKS']<30) {
				echo "1.2";
				$gpa=$gpa+1.2;
			}
			else{
				echo "0.8";
				$gpa=$gpa+.8;
			} ?>
		</td>
	</tr>

	<?php } ?>
</table>


	<div class="alert alert-success" role="alert">
<?php
	$rowtotom1 = 0;
	$rowtotom2 = 0;
	$rowtotom3 = 0;
	$rowtotom4 = 0;
	
	while (($rowtotom1=mysqli_fetch_assoc($resulttotalom1)) and ($rowtotom2=mysqli_fetch_assoc($resulttotalom2)) and ($rowtotom3=mysqli_fetch_assoc($resulttotalom3)) and ($rowtotom4=mysqli_fetch_assoc($resulttotalom4))) {

		echo "GRADE POINT AVERAGE: ".round(($gpa/$numrows),3);
		
		if (round(($gpa/$numrows),3)>=3.6) {
				echo "<br>GRADE: A+";
		}
		elseif (round(($gpa/$numrows),3)>=3.2 and round(($gpa/$numrows),3)<3.6) {
			echo "<br>GRADE: A";
		}
		elseif (round(($gpa/$numrows),3)>=2.8 and round(($gpa/$numrows),3)<3.2) {
			echo "<br>GRADE: B+";
		}
		elseif (round(($gpa/$numrows),3)>=2.4 and round(($gpa/$numrows),3)<2.8) {
			echo "<br>GRADE: B";
		}
		elseif (round(($gpa/$numrows),3)>=2 and round(($gpa/$numrows),3)<2.4) {
			echo "<br>GRADE: C+";
		}
		elseif (round(($gpa/$numrows),3)>=1.6 and round(($gpa/$numrows),3)<2) {
			echo "<br>GRADE: C";
		}
		elseif (round(($gpa/$numrows),3)>=1.2 and round(($gpa/$numrows),3)<1.6) {
			echo "<br>GRADE: D+";
		}
		elseif (round(($gpa/$numrows),3)>=0.8 and round(($gpa/$numrows),3)<1.2) {
			echo "<br>GRADE: D";
		}
		else{
			echo "<br>GRADE: E";
		}
	}
		
?>
</div>
</div>
	<?php mysqli_close($conn); ?>
	<?php include "../footer.html" ?>
</body>
</html>