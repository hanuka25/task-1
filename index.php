<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Kerja</title>
    <<link rel = "stylesheet" href = "style.css">
</head>
<body>
    <div class="container">
        <h1>Jadwal Kerja</h1>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="shift">Pilih Shift:</label>
            <select name="shift" id="shift" required>
                <option value="">-Pilih-</option>
                <option value="A">Shift A</option>
                <option value="B">Shift B</option>
            </select> 

            <label for="jam">Jam Bekerja:</label>
            <input type="number" name="jam" id="jam" min="1" max="10" required>

            <input type="submit" value="Tampilkan Jadwal">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $shift = $_POST["shift"];
            $jam = $_POST["jam"];

            $start_time = $shift == "A" ? 06 : 18; // Menentukan waktu awal shift
            $end_time = $start_time + $jam; // Menentukan waktu akhir shift

            echo "<h2>Shift $shift (Mulai: $start_time:00)</h2>";

            echo "<table>";
            echo "<tr><th>Waktu</th><th>Status</th></tr>";

            $break_interval = 3; // Interval waktu untuk istirahat
            $break_counter = 0;

            $break_total = 0; // Penghitung istirahat

            for ($i = $start_time; $i < $end_time + $break_total; $i++) {
                echo "<tr>";
                $hour = $i % 24;

                echo "<td>" . sprintf("%02d", $hour) . ":00</td>";


                if ($break_counter < $break_interval) {
                    echo "<td class='shift-$shift'>Bekerja</td>";
                    $break_counter++;
                } else {
                    echo "<td class='break'>Istirahat</td>";
                    $break_counter = 0;
                    $break_total++;
                }

                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
</body>
</html>