# navid_challenge
assessment01
Author Navid Langaroudi
Date 10/15/2022

Conway's Game of Life

How to run the project locally:

	Note: This is running only Command line. You need to use your local terminal to run it.

	How to run: 
	1- Make sure you have PHP 7.0 or PHP 8.0 installed.
	2- Clone the repository. It is just one file for this assessment
	3- Run command: php grid_game.php
	4- You will get prompt to enter two numbers separated by comma, like 12,43
	5- So the game will run


How the game behaves:

	When program is running, it will generates a matix of Row x Column, with values - or * .
		meaning:
			- means dead
			* means alive

    The first matrix is generated with some random alive and dead cells, and next one is generated based on previous one, following the rulse.
	The program works in a infinite loop, it stops 1 second before next matrix is generated.
	The matrix is generated based on the rules given in requirement - see Rules below.
	The program will not clean up the previous matrix, it generate the next matrix on the next line. This way, if you stop the game, you can scroll up and see each generation and compare them. so you can verify if it is following the rules.

	Rules:
		As per given in requirement:

			Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
			Any live cell with two or three live neighbours lives on to the next generation.
			Any live cell with more than three live neighbours dies, as if by overpopulation.
			Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction.


How to stop the game:
	press Ctrl and C key


