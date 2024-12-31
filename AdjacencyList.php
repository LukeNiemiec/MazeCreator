<?php

// defines a point in the Adjacency list 
class point {
	public function __construct($value, $neighbors) {
		// contains the node number of this point
		$this->value = $value; 

		// array of neighbor nodes
    	$this->neighbors = $neighbors;

		// this is the value that will be used to 
		// backtrack through the nodes
    	$this->prev = null;
	}
}

// Adjacency list data structure implementation
class AdjacencyList {
	
	public function __construct($matrix) {
	
		// defines the matrix of the adjacency list 
		$this->matrix = $matrix;

		$this->length = count($matrix); // number of collumns in the matrix
		$this->width = count($matrix[0]); // number of rows in the matrix

		// the number of values in the adjacency list
		$this->values = ($this->length * $this->width);

		// contains references to keep track of indexes 
		// for each node in the adjacency list as x, y
		$this->ADJList = array();

		// contains a collection of all of the cordenates 
		// of each value in the adjacency list
		$this->ASList = array();

		// generate the adjacency list at initialization
		$this->generateADJList();
	}

	// collects all of the neighbors in the matrix
	protected function getNeighbors($point, $x, $y, $item) {

	    $neighbors = array();

		// indexes of all neighbor nodes
	    $left = $x - 1; 
	    $right = $x + 1;
	    $up = $point - $this->width;
	    $down = $point + $this->width;
	    
		// checks if the neighbors of the current node in 
		// the matrix are valid nodes and arent already filled in
	    if($left >= 0 && @$this->matrix[$y][$left] != 1) {

	      $neighbors[] = $point - 1;
	    }

	    if($up >= 0 && @$this->matrix[$y - 1][$x] != 1) {

	      $neighbors[] = $point - $this->width;
	    }

	    if($right < $this->width && @$this->matrix[$y][$right] != 1) {

	      $neighbors[] = $point + 1;
	    }

	    if($down < ($this->values - 1) && @$this->matrix[$y + 1][$x] != 1) {

	      $neighbors[] = $point + $this->width;
	    }

		// return the list of neighbor nodes
    	return $neighbors;
	}
  
	// generates the Adjascency list by 
	protected function generateADJList() {
	
		// counter for each node
    	$item = 0;

		// go through all of the rows and columns in the matrix
    	foreach($this->matrix as $y => $row) {
	    	foreach($row as $x => $column) {

				// add the cordenates/indexes to the cord list
	      		$this->ASList[] = array($x, $y);

				// if the value of the current matrix node is
				// not filled as a wall in the maze
	      		if($column != 1) {
	      
					// get all of the valid nodes that are directly
					// connected to the current matrix node
			        $neighbors = $this->getNeighbors($item, $x, $y, $item);

			  		// create the point object and put it into the adjacency list 
			        $point = new point($item, $neighbors);
			        $this->ADJList[$item] = $point;
	        
	      		}

				// increase node counter
				$item++;
      		}
    	}
	}
}


 ?>
