<?php

// how it works:
//
// with the specified width and height of the maze, this 
// program makes a 2D matrix and turns that 2D matrix 
// into an Adjacency list, with that adjecency list 
// this program will create paths using a DFS algorithm 
// and populate the Adjacency list's points with previous
// node pointers, then through those pointers, the program 
// will backtrack through them and create the paths into a maze
//
//
// requirements: php-gd

include("AdjacencyList.php");
include("search.php");

// defines the matrix of the adjacency list
$matrix = array();


// defines the width and height of the maze/PNG
$width = 20;
$height = 20;


// Populates the matrix by creating the rows and 
// columns of the maze based on the width and height
for($i = 0; $i < $height; $i++) {
	$matrix[] = array();

	for($k = 0; $k < $width; $k++) {
		array_push($matrix[$i], 0);
   }
 }


// defines the location to start generating the maze
$startint = rand(0, ($width * $height) - 1); 

// create the adjacency list from the the matrix
$Graph = new AdjacencyList($matrix);

// generate the maze
$order = dfs($Graph->ADJList, $startint);
$cords = $Graph->ASList;

// creating the output image
$image = imagecreate((count($matrix[0])*2) + 1, (count($matrix)*2) + 1);

// define the colors for different pixel types in the PNG
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

$start = imagecolorallocate($image,151, 252, 242);
$end = imagecolorallocate($image, 250, 25, 25);

//initialize the image of the maze
imagefill($image, 0, 0, $black);


// fill the colors of the corresponding pixel of the adjacency list
for($i = 0; $i < count($order); $i++) {

	if($i == count($order) - 1) {
		$color = $end;
		
	} elseif($i == 0) {
		$color = $start;
		
	} else {
	 	$color = $white;

	}

	imagesetpixel($image, ($cords[$i][0] * 2) + 1, ($cords[$i][1] * 2) + 1, $color);
}


// set the color of each pixel on the image to 
// the corresponding value of a node in the 
// adjacency list/order
foreach($order as $index) {

	if($index->value != $startint) {
		$xdiff = $cords[$index->value][0] - $cords[$index->prev][0];
		$ydiff = $cords[$index->value][1] - $cords[$index->prev][1];

		$xdiff = ((($cords[$index->value][0]*2)+1) - $xdiff);
		$ydiff = ((($cords[$index->value][1]*2)+1) - $ydiff);

		imagesetpixel($image, $xdiff, $ydiff, $white);
	}
}


// write the image data to the png
imagepng($image, "maze.png");


?>
