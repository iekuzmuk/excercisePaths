<?php
/*
objective: find all path from 0 to 9
rules only can go right R or down D
1) verify that vales of x and y are in valid range (in the grid 0 to 4)
2) verify if there is a valid move in that case save it in str variable
3) verify if there is an alternative path in that case save it to the array $a 
4) after finishing 1 path (getting the 9 value) save it in results array $res
	- recall the last saved value in alternative paths array $a and delete it from the stack
5) after finding all path end.. it is expected not too many moves (1000 max)
*/

  	$init_time = time();

	$map = array(
		array(0,1,1,-1,1),
		array(1,-1,1,1,1),
		array(1,1,-1,1,1),
		array(1,-1,1,1,1),
		array(1,1,1,1,9));
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>  
<?php

print_map($map,0);
process_map($map);

echo "execution time: <b>" . (time()-$init_time) . "seconds </b";

function print_map($map,$str){
	$color_map = array(
		array(1,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0));

	if(strlen($str)>0){
		$y = 0;$x=0;
		for ($c=0;$c<strlen($str);$c++){
			if(substr($str, $c,1)=="D")$y++;
			elseif(substr($str, $c,1)=="R")$x++;
			$color_map[$y][$x]=1;
		}
	}
  	echo "<table>";
	for ($y=0;$y<5;$y++){
		echo "<tr>";
		for ($x=0;$x<5;$x++){
			if(strlen($str)>0){
				if($color_map[$y][$x])
					echo "<td bgcolor=\"#00FF00\">".$map[$y][$x]."</td>";
				else
					echo "<td bgcolor=\"#FFFFFF\">".$map[$y][$x]."</td>";
			}
			else echo "<td bgcolor=\"#FFFFFF\">".$map[$y][$x]."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

function process_map($map){
	$x=0;$y=0;$a=array();$str='';$res= array();

	for ($i=0;$i<120;$i++){
		if($x<=4 && $y<=4){
			if($x+1<=4){
				if($map[$y][$x+1]==1 || $map[$y][$x+1]==9){
					if($map[$y][$x+1]==9){
						$x++;$str .= 'R';
						array_push($res, $str);
					}
					else{
						if($y+1<=4 && $map[$y+1][$x]>=1) array_push($a, "$str"."D");
						$x++;$str .= 'R';
					}
				}
			}
			if($y+1<=4){
				if($map[$y+1][$x]==1 || $map[$y+1][$x]==9){

					if($map[$y+1][$x]==9){
						$y++;$str .= 'D';
						array_push($res, $str);
					}
					else{
						if($x+1<=4 && $map[$y][$x+1]>=1) array_push($a, "$str"."R");
						$y++;$str .= 'D';
					}
				}
			}
		}
		//decide if it is the end of a path and to leave it and try another one.
		$leavePath = $leaveX = $leaveY = false;
		
		if ($x<4 && $map[$y][$x+1]==-1) $leaveX = true;
		if ($x==4) $leaveX = true;
		
		if ($y<4 && $map[$y+1][$x]==-1) $leaveY = true;
		if ($y==4) $leaveY = true;
		
		if ($leaveX && $leaveY){
			$str=end($a);array_pop($a);
			$y = substr_count($str, "D");$x = substr_count($str, "R");
		}
	}
	$xxx = array_unique($res);
	echo "<br><br>";
	for ($c=0;$c<count($xxx);$c++){
		echo ($c+1).")result: ". $xxx[$c]."<br>"; print_map($map,$xxx[$c]);
	}
}
?>
</body>
</html>
