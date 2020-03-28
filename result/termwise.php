<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Show Grade</title>
	<?php require "connect.php"; ?>
	<?php include "../header.html" ?>


	<br>
	<h2 align="center">Rising Nepal Secondary Boarding School</h2>
	<h3 align="center">Grade-Sheet</h3>
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
<?php $gpa=0; ?>
<table class="table table-striped">
	<tr>
		<th>SUBJECTS</th><th>F.G.</th><th>G.P.</th>
	</tr>	
	<?php while ($row2 = mysqli_fetch_assoc($resultom)) { ?>
	<tr>
		<td><?php echo $row2['SUBJECTS'];?></td>
		<td>
			<?php
				$totom=$row2['OBTAINEDMARKS']; 
				if (($totom*100)/$row2['FULLMARKS']>=90) {
					echo "A+";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=80 and ($totom*100)/$row2['FULLMARKS']<90) {
					echo "A";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=70 and ($totom*100)/$row2['FULLMARKS']<80) {
					echo "B+";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=60 and ($totom*100)/$row2['FULLMARKS']<70) {
					echo "B";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=50 and ($totom*100)/$row2['FULLMARKS']<60) {
					echo "C+";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=40 and ($totom*100)/$row2['FULLMARKS']<50) {
					echo "C";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=30 and ($totom*100)/$row2['FULLMARKS']<40) {
					echo "D+";
				}
				elseif (($totom*100)/$row2['FULLMARKS']>=20 and ($totom*100)/$row2['FULLMARKS']<30) {
					echo "D";
				}
				else{
					echo "E";
				}


			?>
		</td> 
		<td>
			<?php $totom=$row2['OBTAINEDMARKS']; 
			if (($totom*100)/$row2['FULLMARKS']>=90) {
				echo "4";
				$gpa=$gpa+4;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=80 and ($totom*100)/$row2['FULLMARKS']<90) {
				echo "3.6";
				$gpa=$gpa+3.6;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=70 and ($totom*100)/$row2['FULLMARKS']<80) {
				echo "3.2";
				$gpa=$gpa+3.2;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=60 and ($totom*100)/$row2['FULLMARKS']<70) {
				echo "2.8";
				$gpa=$gpa+2.8;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=50 and ($totom*100)/$row2['FULLMARKS']<60) {
				echo "2.4";
				$gpa=$gpa+2.4;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=40 and ($totom*100)/$row2['FULLMARKS']<50) {
				echo "2.0";
				$gpa=$gpa+2.0;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=30 and ($totom*100)/$row2['FULLMARKS']<40) {
				echo "1.6";
				$gpa=$gpa+1.6;
			}
			elseif (($totom*100)/$row2['FULLMARKS']>=20 and ($totom*100)/$row2['FULLMARKS']<30) {
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
	$row3 = 0;
	
	while ($row3=mysqli_fetch_assoc($resulttotalom)) {
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