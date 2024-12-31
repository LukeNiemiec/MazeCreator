<?php


// breath first search algorithm to search through the
// maze from the starting node to the ending node
function bfs($ADJList, $start, $end) {

	$queue = array($start);
	$visited = array();
	
	foreach($ADJList as $value => $point) {

		$visited[$value] = false;
	}


	do {

		$el = array_shift($queue);
	    $current = $ADJList[$el];

	    if($current->value == $end) {
	    	break;
	    }
		
	    $visited[$current->value] = true;

	    foreach($current->neighbors as $neighbor) {

		    if(!$visited[$neighbor]) {

				array_unshift($queue, $neighbor);
				$ADJList[$neighbor]->prev = $current->value;
		    }
	    }

	} while(count($queue) != 0);
  
	// return the adjusted adjacency list
	return $ADJList;
}

// finds the valid path through the maze
function find($ADJList, $start, $end) {

	// search through the Adjacency List for a 
	// valid path populate the adjacecy list with 
	// pointers to the previous visited node
	$ADJList = bfs($ADJList, $start, $end);

	// initialize the list of nodes in the path
	$path = array();

	// start with the end node in the adjacency list
	$current = $end;

	// backtrack through the previous 
	// nodes in the adjacency list 
	// from the end node
	do {
		if($current != $end) {
		  $path[] = $current;
		  
		}
		
		$current = $ADJList[$current]->prev;
		
	// stops when the path reaches the start node
	} while($current != $start);
	
	// return the resulting path
	return $path;
}

 ?>
