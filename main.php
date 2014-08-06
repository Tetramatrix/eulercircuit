<?php
/***************************************************************
* Copyright notice
*
* (c) 2011-2014 Chi Hoang (info@chihoang.de)
*  All rights reserved
*
***************************************************************/

class eulerCircuit 
{	
		/* The number of nodes in the graph */
	var $mapWidth;					
	var $eulerMap = Array ( );
    var $path = Array ( );
    	
	function begin ( $tree ) 
    {
            // Size of the map
        $this->mapWidth = 20;

		$odd = Array ( );
		$empty = true;
		
		foreach ( $tree as $k => $v ) 
        {
			if ( count ( $v ) % 2 != 0 ) 
            {
				$odd [ ] = $v;
				$empty = false;
			}
		}
		
		if ( $empty ) {
			$myStack = 0;
		} else if ( count ( $odd ) < 3 ) 
        {
			//~ $myStack = $odd [ 0 ] [ 0 ];
			$myStack = 0;
		} else {
			die ( "No Euler-Path" );
		}
		
			// prerequisuits
		for (	$i = 0; $i < $this->mapWidth; ++$i  ) 
        {
			for ( $j=0; $j < $this->mapWidth; ++$j ) 
            {
				$this->eulerMap [ $i ] [ $j ] = 0;
			}
		}
		
			// Read in the points and push them into the map		
		foreach ( $tree as $k => $v ) 
        {
			foreach ( $v as $node => $leaf ) 
            {
				$this->eulerMap [ $k ] [ $leaf ] = $this->eulerMap [ $leaf ] [ $k ] = 1;
			}
		}
		return $myStack;
	}
	
	function CanGoBack ( $x, $y ) 
    {
		$Queue = $Free = Array ( );		
		$this->eulerMap [ $x ] [ $y ] = $this->eulerMap [ $y ] [ $x ] = 0; 

		for ( $i = 0; $i < $this->mapWidth; ++$i ) 
        {
			$Free [ $i ]  = 1;
		}
		
		$Free [ $y ] = 0;
		$Queue [  ] = $y;

		do {
			$u = Array_shift ( $Queue ); 
			for ( $i = 0; $i < $this->mapWidth; ++$i  ) 
            {
				if ( $Free [ $i ] && ( $this->eulerMap [ $u ] [ $i ] > 0) ) 
                {
					$Queue  [ ] = $i;
					$Free [ $i  ] = 0;
					if  ( $Free [ $x ] ) Break;
				}
			}
		} while ( ! empty ( $Queue [ 0 ] )  );
		
		$this->eulerMap [ $x ] [ $y ] = $this->eulerMap [ $y ] [ $x ] = 1;
		return  ( $Free [ $x ] );
	}
	
	function find ( $Current ) 
    {
		$Next = -1;
		for ( $v = 0; $v < $this->mapWidth; ++$v ) {
			if ( $this->eulerMap [ $Current ] [ $v ] > 0 ) 
            {
				$Next = $v;
				if ( ! $this->CanGoBack ( $Current, $Next ) ) 
                {
					break;
				}
			} 
		}
		if ( $Next != -1 ) 
        {
				// echo circuit 
			$this->path [ ]  = $Next;
				// deleting
			$this->eulerMap [ $Current ] [ $Next ] = $this->eulerMap [ $Next ] [ $Current ] = 0;
			$this->FindEulerCircuit ( $Next );
			
		}  else 
        {
			for ( $i = 0; $i < $this->mapWidth; ++$i  ) 
            {
				for ( $j = 0; $j < $this->mapWidth; ++$j  ) 
                {
					if ( $this->eulerMap [ $i ] [ $j ] > 0 ) 
                    {
						$this->FindEulerCircuit ( $i );
					}
				}
			}
		}
		return $this->path;
	}
	    
	function HamiltonianPath ( $path ) 
    {
		$clean = Array ( );
		foreach ( $path as $k => $v ) 
        {
			if ( ! in_array ( $v, $clean ) ) 
            {
				$clean [ ] = $v;
			}
		}
		return $clean;
	}
}
?>