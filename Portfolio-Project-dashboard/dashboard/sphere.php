<?php
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    $conn = new PDO($dsn, $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to get the count of males and females
    $stmt = $conn->query("SELECT gender, COUNT(*) as count FROM registration GROUP BY gender");
    $genderData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize variables for male and female counts
    $maleCount = 0;
    $femaleCount = 0;

    // Loop through the results and assign the counts
    foreach ($genderData as $row) {
        if ($row['gender'] == 'male') {
            $maleCount = $row['count'];
        } elseif ($row['gender'] == 'female') {
            $femaleCount = $row['count'];
        }
    }

    // Pass the counts to JavaScript
    echo "<script>
            var maleCount = $maleCount;
            var femaleCount = $femaleCount;
          </script>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('genderChart').getContext('2d');
    var genderChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [maleCount, femaleCount],  // Use PHP values here
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',  // Color for males
                    'rgba(255, 99, 132, 0.6)'   // Color for females
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 50,  // Makes the chart look like a donut/sphere
        }
    });
</script>
