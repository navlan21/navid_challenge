<?php
class Cell
{
	public $cellRowNumber;
	public $cellColumnNumber;
	public $cellLiveNeighbourCount;
	public $cellStatus; //dead or alive
	public $grid;

	public function __construct($grid, $rowNumber, $columnNumber)
	{
		$this->cellRowNumber = $rowNumber;
		$this->cellcolumnNumber = $columnNumber;
		$this->grid = $grid;
	}

	private function getNeighbourCount($g, $i, $j)
	{
		$count = 0;
		//topleft
		if (isset($g[$i - 1][$j - 1]) && $g[$i - 1][$j - 1] == '*') {
			$count++;
		}
		//top
		if (isset($g[$i - 1][$j]) && $g[$i - 1][$j] == '*') {
			$count++;
		}
		//topright
		if (isset($g[$i - 1][$j + 1]) && $g[$i - 1][$j + 1] == '*') {
			$count++;
		}
		//right
		if (isset($g[$i][$j + 1]) && $g[$i][$j + 1] == '*') {
			$count++;
		}
		//rightbottom
		if (isset($g[$i + 1][$j + 1]) && $g[$i + 1][$j + 1] == '*') {
			$count++;
		}
		//bottom
		if (isset($g[$i + 1][$j]) && $g[$i + 1][$j] == '*') {
			$count++;
		}
		//bottomleft
		if (isset($g[$i + 1][$j - 1]) && $g[$i + 1][$j - 1] == '*') {
			$count++;
		}
		//left
		if (isset($g[$i][$j - 1]) && $g[$i][$j - 1] == '*') {
			$count++;
		}

		$this->cellLiveNeighbourCount = $count;
	}

	protected function getCellNeighbourCount($grid, $row, $col)
	{
		$this->getNeighbourCount($grid, $row, $col);
		return $this->cellLiveNeighbourCount;
	}
}

class Grid extends Cell
{
	public $gridRowCount;
	public $gridColumnCount;
	public $grid;
	public $cell;

	public function __construct($row, $col)
	{
		$this->gridRowCount = $row;
		$this->gridColumnCount = $col;
		$this->setRandomGrid();
		parent::__construct($this->grid, $row, $col);
	}

	function getNeighbourCount($grid, $r, $c)
	{
		return $this->getCellNeighbourCount($grid, $r, $c);
	}

	private function setRandomGrid()
	{
		$grid = [];
		for ($i = 0; $i < $this->gridRowCount; $i++) {
			for ($j = 0; $j < $this->gridColumnCount; $j++) {
				$grid[$i][$j] = rand(0, 10) % 10 ? "-" : "*";
			}
		}
		$this->grid = $grid;
	}

	public function getRandomGrid()
	{
		return $this->grid;
	}

	public function displayGrid($grid)
	{
		$height = count($grid);
		$width = count($grid[0]);
		for ($i = 0; $i < $height; $i++) {
			echo "\n";
			for ($j = 0; $j < $width; $j++) {
				echo $grid[$i][$j];
			}
		}
	}

	public function isAlive($grid)
	{
		$newGrid = [];
		$height = $this->gridRowCount;
		$width = $this->gridColumnCount;

		for ($i = 0; $i < $height; $i++) {
			for ($j = 0; $j < $width; $j++) {
				$newGrid[$i][$j] = $grid[$i][$j];
				$neighbourCount = $this->getNeighbourCount($grid, $i, $j);

				//if Live
				if ($grid[$i][$j] == '*') {
					if ($neighbourCount < 2 || $neighbourCount > 3) {
						$newGrid[$i][$j] = '-';
					}
				} else {
					if ($neighbourCount == 3) {
						$newGrid[$i][$j] = '*';
					}
				}
			}
		}
		return $newGrid;
	}
} //class Grid



function runTheGame($row, $column)
{
	$grid = new Grid($row, $column);
	$randomGrid = $grid->getRandomGrid();
	$grid->displayGrid($randomGrid);
	$newGrid = $grid->isAlive($randomGrid);

	$grid->displayGrid($newGrid);
	$counter = 0;
	while (true) {
		$newGrid = $grid->isAlive($newGrid);
		$grid->displayGrid($newGrid);

		$counter++;
		echo "\n======= $counter =======\n";
		sleep(1);
	}
}

// **********************************************************
// Run the game in command line by command: php grid_game.php
// **********************************************************
$input = readline('Enter Grid size - e.g. 12,44 - : ');

if (!preg_match('#^[1-9][0-9]*(,[1-9][0-9]*)*$#', $input)) {
	echo "Please only enter two numbers separated by comma, like 33,44\n";
	echo "Please start over!";
	exit;
}

$inputArr = explode(",", $input);
if (count($inputArr) != 2) {
	echo "Please only enter two numbers separated by comma, like 33,24\n";
	echo "Please start over!";
	exit;
}

//Calling the game
$row = $inputArr[0];
$column = $inputArr[1];
runTheGame($row, $column);
