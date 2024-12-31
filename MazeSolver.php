<?php

include("find.php");
include("AdjacencyList.php");

// collect the image instance from the maze image
$image = imagecreatefrompng("maze.png");

// gets the width and height of the image
$size = getimagesize("maze.png");

$width = ($size[0]);
$height = ($size[1]);

// define the 2D matrix for generating 
// the path to salve the maze
$matrix = array();

// counter of pixels/nodes in the image/maze
$item = 0;

// iterate through each pixel in the image
for($y = 0; $y < $height; $y++) {

	$matrix[] = array();

	for($x = 0; $x < $width; $x++) {

		// get current pixel color that
		// coresponds to the maze node type
		// Ex: start, end or path nodes
    	$color = imagecolorat($image, $x, $y);

		// identify the starting and ending node
	    if($color == 2) {
	    	$start = $item;
	    	
	    } elseif($color == 3) {
			$end = $item;
			
	    }

	   	// add the color value to the node matrix
		$matrix[$y][] = $color;

		// update pixel counter
		$item++;
	}
}

// creates the Adjacency list
$Graph = new AdjacencyList($matrix);

// contains the path from start to end of the maze
// from backtracking the previous attribute
// from the visited points in the adjacency list
$path = find($Graph->ADJList, $start, $end);

//create image
$blue = imagecolorallocate($image, 0, 0, 225);

// sets the pixel in the image 
foreach($path as $index) {

	// get the cordenates of the solved path pixel
	$cords = $Graph->ASList[$index];
	
	// set that unsolved path pixel to the 
	// solved pixel path color/ blue
	imagesetpixel($image, $cords[0], $cords[1], $blue);
}

// create image of the solved maze
imagepng($image, "solved_maze.png");


 ?>
