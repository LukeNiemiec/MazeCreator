<?php


// depth first search function
// that searches through the adjacency list 
// and marks nodes  
function dfs($ADJList, $start) {

	// lists containing the queued and the visited
	// nodes to keep track of what nodes to visit 
	// and which ones have already been visited 
	$queue = array($start);
	$visited = array();

	// initialize the visited list
	for($i = 0; $i < count($ADJList); $i++) {

		$visited[] = false;
	}

	$count = 0;

	// loops until there are no 
	// other nodes in the queue
	do {
	
		// number of queued nodes
		$cq = count($queue);

		// picks a random index for the next
		// node in the queue(for randomness of maze)
		$index = rand(($cq - $count), $cq);

		if($index) {

			$index--;
		}
		
		// current node to search
		$current = $queue[$index];

		// counter for all of the nodes 
		// the search has reached
		$count = 0;

		// adds neighbors of the current node to the queue
		// if they arent visited and arent in the queue already
		foreach($ADJList[$current]->neighbors as $neighbor) {
	    	if(!$visited[$neighbor] && !in_array($neighbor, $queue)) {

	      		$queue[] = $neighbor;
				
	      		if($ADJList[$neighbor]->prev == null) {
	      			
	        		$ADJList[$neighbor]->prev = $current;
	      		}
	      		
				// increase the count of nodes reached
				$count++;
	    	}
	  	}
	  
		// marks the current node as visited
	  	$visited[$current] = true;
	  	
	  	// remove it from the queue
	 	unset($queue[$index]);

	  	//re-init queue keys & values
	  	$queue = array_values($queue);

	} while(count($queue) != 0);

	// when done return the adjusted adjacency list
	return $ADJList;
}




?>
