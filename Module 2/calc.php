<!DOCTYPE html>
<head><title>Calculator</title></head>
<body>

    <form action="calc.php" method="GET">
            <p>
                    <label for="firstnum">First Number:</label>
                    <input type="number" name="num1" id="firstnum" />
            </p>
            <p>
                    <strong>Opperation:</strong>
                    <input type="radio" name="opperation" value="+" id="additioninput" /> <label for="additioninput">+</label> &nbsp;
                    <input type="radio" name="opperation" value="-" id="subtractioninput" /> <label for="subtractioninput">-</label> &nbsp;
                    <input type="radio" name="opperation" value="X" id="multiplicationinput" /> <label for="multiplicationinput">X</label> &nbsp;
                    <input type="radio" name="opperation" value="/" id="divisioninput" /> <label for="divisioninput">/</label> &nbsp;
            </p>
            <p>
                    <label for="lastnum">Second Number:</label>
                    <input type="number" name="num2" id="lastnum" />
            </p>
            <p>
                    <input type="submit" value="Send" />
                    <input type="reset" />
            </p>
    </form>

    <?php
        if (isset($_GET['num2']) && isset($_GET['num1']) && isset($_GET['opperation'])){
            if ($_GET['opperation'] == "+") {
                $sum = $_GET['num1'] + $_GET['num2'];
                printf("<p><strong>Output: %s</strong></p>\n",
                htmlentities($sum));
            }
            if ($_GET['opperation'] == "-") {
                $sum = $_GET['num1'] - $_GET['num2'];
                printf("<p><strong>Output: %s</strong></p>\n",
                htmlentities($sum));
            }
            if ($_GET['opperation'] == "X") {
                $sum = $_GET['num1'] * $_GET['num2'];
                printf("<p><strong>Output: %s</strong></p>\n",
                htmlentities($sum));
            }
            if ($_GET['opperation'] == "/") {
                $sum = $_GET['num1'] / $_GET['num2'];
                printf("<p><strong>Output: %s</strong></p>\n",
                htmlentities($sum));
            }
        }
        else {
            printf("<p><strong>Make sure to fill out the entire form before submitting.</strong></p>\n");
        }
    ?>
</body>

