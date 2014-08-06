<?php
/***************************************************************
* Copyright notice
*
* (c) 2011-2014 Chi Hoang (info@chihoang.de)
*  All rights reserved
*
***************************************************************/
require_once ( "main.php" );

$example3 = Array (   1 => Array ( 1, 2, 3, 8, 7 ),
					  2 => Array ( 1, 3  ),
					  3 => Array ( 1, 2, 4, 7 ),
					  4 => Array ( 3, 7, 9, 5 ),
					  5 => Array ( 4, 9 ),
					  6 => Array ( 7, 9 ),
					  7 => Array ( 1, 3, 4, 6, 8, 9 ),
					  8 => Array ( 1, 7 ),
					  9 => Array ( 4, 5, 6, 7 ),
				  );
				  
$example2 = Array ( 1 => Array ( 2, 3 ),
					2 => Array ( 1,3,4,5 ),
					3 => Array ( 1,2,4,5 ), 
					4 => Array ( 2,3,5 ),
					5 => Array ( 2,3,4 )
				);

$example1 = Array (
					1 => Array ( 2, 3, 4, 5 ),
					2 => Array ( 1,4 ),
					3 => Array ( 1,4,5, 6 ), 
					4 => Array ( 1,2,3, 6 ),
					5 => Array ( 1, 3 ),
					6 => Array ( 3, 4 )
				);
				
$obj = new eulerCircuit ();
$start = $obj->begin ($example1);
$euler = $obj->find ($start);
$hamiltonian = $obj->HamiltonianPath ($euler);
var_dump($euler);
var_dump($hamiltonian);
?>