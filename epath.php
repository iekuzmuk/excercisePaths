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
		array(0,1,1,1,1),
		array(1,-1,1,1,1),
		array(1,1,-1,1,1),
		array(1,-1,1,1,1),
		array(1,1,1,-1,9));
  
echo $map[0][0]." ".$map[0][1]." ".$map[0][2]." ".$map[0][3]." ".$map[0][4]."<br>";
echo $map[1][0]." ".$map[1][1]." ".$map[1][2]." ".$map[1][3]." ".$map[1][4]."<br>";
echo $map[2][0]." ".$map[2][1]." ".$map[2][2]." ".$map[2][3]." ".$map[2][4]."<br>";
echo $map[3][0]." ".$map[3][1]." ".$map[3][2]." ".$map[3][3]." ".$map[3][4]."<br>";
echo $map[4][0]." ".$map[4][1]." ".$map[4][2]." ".$map[4][3]." ".$map[4][4]."<br>";

process_map($map);

echo "execution time: <b>" . (time()-$init_time) . "seconds </b";

function process_map($map){
	$x=0;$y=0;$a=array();$str='';$res= array();

	for ($i=0;$i<1000;$i++){
		if($x<=4 && $y<=4){
			if($x+1<=4){
				if($map[$y][$x+1]==1 || $map[$y][$x+1]==9 ){
				
					if($map[$y][$x+1]==9) {$x++;$str .= 'R';echo "end path: $str<br>";
					array_push($res, $str);
					$str=end($a);array_pop($a);
					$y = substr_count($str, "D");$x = substr_count($str, "R");
					}
					else{
						if($y+1<=4 && $map[$y+1][$x]>=1) array_push($a, "$str"."D");
						$x++;$str .= 'R';
					}
				}
			}
			if($y+1<=4){
				if($map[$y+1][$x]==1 || $map[$y+1][$x]==9 ){
					if($map[$y+1][$x]==9) {$y++;$str .= 'D';echo "end path: $str<br>";
					array_push($res, $str);
					$str=end($a);array_pop($a);
					$y = substr_count($str, "D");$x = substr_count($str, "R");
					}
					else{
						if($x+1<=4 && $map[$y][$x+1]>=1) array_push($a, "$str"."R");
						$y++;$str .= 'D';
					}
				}
			}
		}
	}
}

?>
