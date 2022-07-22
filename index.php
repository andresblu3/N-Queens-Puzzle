<?php
error_reporting(0);
/* Getting the value of n from the URL and if it is not a number or it is less than 8, it is going to
set n to 8. */
$n = $_GET['n'];
if (is_nan($n) || $n < 8) {
    $n = 8;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N Queen - Andres A.</title>
    <style>
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            font-size: 16px;
            color: #333;
            background: #fafafa;
        }

        p {
            margin: 10px 0;
            padding: 0;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>N Queens Puzzle</h1>
    <p>Resultados para n = <?php echo $n; ?></p>
    <div class="result">
    </div>

    <script>
        const n = <?php echo $n; ?>;

        var solveNQueens = function(n) {

            let result = [];
            /* Creating an array of n elements and filling it with -1 to not be solved */
            const queens = Array(n).fill(-1);

            /* Creating a board with the queens in the correct position. */
            function makeBoard() {
                const board = [];
                for (let r = 0; r < n; ++r) {
                    let row = "";
                    for (let c = 0; c < n; ++c) {
                        if (queens[r] === c) {
                            row = row + 'Q';
                        } else {
                            row = row + '-';
                        }
                    }
                    /* Adding the row to the board. */
                    board.push(row);
                }
                return board;
            }

            function isValid(row, col) {
                for (let i = 0; i < row; ++i) {
                    //we check the diagonal
                    if (queens[i] == col || Math.abs(i - row) == Math.abs(queens[i] - col))
                        return false;
                }
                return true;
            }

            
            function solve(row) {
                if (row === n) {
                    const board = makeBoard();
                    result.push(board);
                }

                for (let col = 0; col < n; ++col) {
                    /* Checking if the position of the queen is valid. */
                    if (!isValid(row, col)) {
                        continue;
                    }

                    queens[row] = col;

                    solve(row + 1);
                    
                    queens[row] = -1;
                }
            }

            /* Calling the function solve with the first row. */
            solve(0);

            return result;
        };



        let tablero = solveNQueens(n);

        let result = document.getElementsByClassName("result")[0];

        for (let i = 0; i < tablero.length; ++i) {
            for (let j = 0; j < tablero[i].length; ++j) {
                let noQueen = parseInt(j) + 1;
                let noColumn = tablero[i][j].indexOf("Q");
                noColumn = parseInt(noColumn) + 1;
                //Example: Queen #1 [--Q--] (Fila 1, Columna 2)
                result.innerHTML += "Queen #" + noQueen + ": [" + tablero[i][j] + "] (Fila " + noQueen + ", Columna " + noColumn + ")<br>";
            }
            result.innerHTML += "<br>";
        }
    </script>
</body>

</html>
