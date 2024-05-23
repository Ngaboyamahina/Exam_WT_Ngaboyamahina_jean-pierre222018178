<?php
// Include your database connection file
include_once "connection.php"; // Update with your actual file name

// Check if the connection is established
if ($conn) {
    // Check if the search query is submitted
    if (isset($_GET['query'])) {
        $searchQuery = $_GET['query'];

        // Define the columns you want to search across
        $columns = array("name", "description", "price"); // Update with your actual column names

        // Construct the WHERE clause dynamically to search across multiple columns
        $whereClause = "";
        foreach ($columns as $column) {
            $whereClause .= "$column LIKE '%$searchQuery%' OR ";
        }
        // Remove the last 'OR' from the WHERE clause
        $whereClause = rtrim($whereClause, "OR ");

        // Perform the search query in your database
        $sql = "SELECT * FROM products WHERE $whereClause";
        $result = mysqli_query($conn, $sql);

        // Display search results
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Display search results here, e.g., echo $row['column'];
            }
        } else {
            echo "No results found.";
        }

        // Close result set
        mysqli_free_result($result);
    } else {
        echo "No search query provided.";
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo "Failed to connect to the database.";
}
?>
