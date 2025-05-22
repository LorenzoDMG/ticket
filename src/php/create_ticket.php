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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket - e-ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 text-gray-300 font-sans relative pb-20">
    <!-- Nav -->
    <?php require_once 'header.php'; ?>

    <!-- Main Content -->
    <main class="mt-16 w-7/12 mx-auto px-4 py-12 pb-20 text-center">
        <h2 class="text-3xl font-bold text-indigo-400 mb-4">Créer un Ticket</h2>
        <?php foreach ($tickets as $ticket): ?>
            <div class="mb-4 p-4 bg-gray-700 rounded">
                <h2 class="text-lg font-semibold text-indigo-300"><?= htmlspecialchars($ticket['Title']) ?></h2>
                <p class="text-gray-400"><?= htmlspecialchars($ticket['Description']) ?></p>
                <a href="ticket.php?id=<?= htmlspecialchars($ticket['Id']) ?>" class="text-blue-400 hover:underline">Voir le Ticket</a>
            </div>
        <?php endforeach; ?>
        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 text-white <?= $success ? 'bg-green-500' : 'bg-red-500' ?> rounded">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300">Titre</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Créer un Ticket
            </button>
        </form>
    </main>
    <?php require_once 'footer.php'; ?>
</body>
</html>