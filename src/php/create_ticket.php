<?php
require_once 'header.php';
require_once '../php/dbconn.php';
?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    // Simulate saving the ticket (e.g., to a database)
    $success = !empty($title) && !empty($description);

    if ($success) {
        try {
            $sql = "INSERT INTO Ticket (Title, Description) 
                    VALUES (?, ? )";
            $stmt = $db->prepare($sql);
            $stmt->execute([$title, $description]);
    
            header("Location: ../../index.php?success=Your account has been created successfully");  
            exit;
        } catch (PDOException $e) {
            $em = "Error: " . $e->getMessage();
            header("Location: ../../signup.php?error=$em&$data");
            exit;
        }
        $message = "Ticket created successfully!";
    } else {
        $message = "Please fill in all fields.";
    }


}
// Fetch all tickets from the database
$tickets = [];
$ticketsDb="SELECT * FROM Ticket";
$stmt = $db->prepare($ticketsDb);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {
    $tickets[] = $row;
}
$stmt->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen relative pb-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">e-ticket</h1>
        <?php foreach ($tickets as $ticket) {
            echo "<div class='mb-4 p-4 bg-gray-200 rounded'>";
            echo "<h2 class='text-lg font-semibold'>" . htmlspecialchars($ticket['Title']) . "</h2>";
            echo "<p>" . htmlspecialchars($ticket['Description']) . "</p>";
            //add link
            echo "<a href='ticket.php?id=" . htmlspecialchars($ticket['Id']) . "' class='text-blue-500 hover:underline'>View Ticket</a>";
            echo "</div>";
        } ?>
        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 text-white <?= $success ? 'bg-green-500' : 'bg-red-500' ?> rounded">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Create Ticket
            </button>
        </form>
    </div>
    <?php
    require_once 'header.php';
    require_once 'footer.php';
    ?>
</body>
</html>
<?php
require_once 'header.php';
require_once 'footer.php';
?>