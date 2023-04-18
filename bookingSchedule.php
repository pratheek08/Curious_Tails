<!DOCTYPE html>
<html>
    <head>
        <title>Pet Schedule</title>
        <style>
            .body{
                /* background-image: url('3.jpeg.jpeg'); */
                background-size: cover;
                color: black;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

            }
            .table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 1em;

            }

            th, td {
                text-align: left;
                padding: 0.5em;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
                color: #333;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1>Pet Schedule</h1>
        <style>h1{
                font-size: 40px;
            }</style>
        <form method="POST" action="">
            <p>Please select the service you would like to schedule:</p>
            <style>p{
                    font-size: 30px;
                }</style>

            <label>
                <input type="radio" name="service" value="daycare">
                Daycare
            </label>
            <style>body{
                    font-size: 20px;
                }</style>

            <br>

            <label>
                <input type="radio" name="service" value="grooming">
                Grooming Session
            </label>

            <br>

            <label>
                <input type="radio" name="service" value="pool">
                Pool Session
            </label>

            <br><br>

            <p>Please select the date and time:</p>

            <label>
                Date:
                <input type="date" name="date">
            </label>

            <br>

            <label>
                Time:
                <input type="time" name="time">
            </label>

            <br><br>

            <input type="submit" value="Schedule">
        </form>
    </body>

    <table>
        <tr>
            <th>ID</th>
            <th>Pet ID</th>
            <th>Service</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
        session_start();
        // $email = $_SESSION['email'];
        $id = $_SESSION['id'];
        $conn = new mysqli('localhost', 'root', 'Pr@theek08', 'sign');
        $sql = "SELECT * FROM pet_schedule WHERE pet_id = '$id'";
        $result = $conn->query($sql);

// Check for errors
        if (!$result) {
            die('Error retrieving pet information: ' . $conn->error);
        }

// Create an array to store pet information
        $pets = array();

// Loop through the results and add them to the array
        while ($row = $result->fetch_assoc()) {
            $pets[] = $row;
        }
        ?>
        <?php foreach ($pets as $pet): ?>
            <tr>
                <td><?php echo $pet['id']; ?></td>
                <td><?php echo $pet['pet_id']; ?></td>
                <td><?php echo $pet['service']; ?></td>
                <td><?php echo $pet['date']; ?></td>
                <td><?php echo $pet['time']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</html>