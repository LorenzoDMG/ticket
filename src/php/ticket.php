<?php
require_once 'header.php';
require_once './dbconn.php';

// Définir un utilisateur connecté temporairement pour les tests
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 7; // Utilisez un ID existant, comme 7
}

$createdBy = $_SESSION['id'] ?? null; // Récupérez l'ID de l'utilisateur connecté

if (!$createdBy) {
    die("User not authenticated."); // Gérer les utilisateurs non connectés
}

// Vérifiez si l'utilisateur connecté existe dans la base de données
$userCheckStmt = $db->prepare("SELECT * FROM Users WHERE Id = ?");
$userCheckStmt->execute([$createdBy]);
$user = $userCheckStmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Débogage : Affichez tous les utilisateurs pour vérifier la base de données
    $debugStmt = $db->query("SELECT * FROM Users");
    $allUsers = $debugStmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($allUsers);
    echo "</pre>";
    die("Error: The user with ID $createdBy does not exist in the database. Please ensure the user is correctly set up.");
}

// get ticket id from url and fetch it 
$ticketId = $_GET['id'] ?? null;
if ($ticketId) {
    $ticketId = (int) $ticketId;
    $stmt = $db->prepare("SELECT * FROM Ticket WHERE Id = ?");
    $stmt->execute([$ticketId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch messages related to the ticket
    $messageStmt = $db->prepare("SELECT * FROM messages WHERE Ticket_id = ? ORDER BY Created_at ASC");
    $messageStmt->execute([$ticketId]);
    $messages = $messageStmt->fetchAll(PDO::FETCH_ASSOC);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['response'], $_POST['ticket_id'])) {
    $response = $_POST['response'];
    $ticketId = (int) $_POST['ticket_id'];

    $insertStmt = $db->prepare("INSERT INTO messages (Ticket_id, Message, Created_by) VALUES (?, ?, ?)");
    $insertStmt->execute([$ticketId, $response, $createdBy]);

    // Refresh the page to display the new message
    header("Location: ticket.php?id=" . $ticketId);
    exit;
}

// Close the database connection
$db = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 text-gray-300 font-sans relative pb-20">

    <div class="mt-16 w-7/12 mx-auto px-4 py-12 pb-20 text-center">
        <div class="bg-gray-700 p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
            <h1 class="text-3xl font-bold text-indigo-400 mb-6">e-ticket</h1>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium">Ticket ID:</label>
                <p class="text-gray-100"><?php echo htmlspecialchars($result['Id']); ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium">Title:</label>
                <p class="text-gray-100"><?php echo htmlspecialchars($result['Title']); ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium">Description:</label>
                <p class="text-gray-100"><?php echo htmlspecialchars($result['Description']); ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium">Created At:</label>
                <p class="text-gray-100"><?php echo htmlspecialchars($result['Created_at']); ?></p>
            </div>
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-indigo-400 mb-4">Messages</h2>
                <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $message): ?>
                            <div class="mb-4 text-left">
                                <p class="text-gray-100"><strong>Message:</strong> <?php echo htmlspecialchars($message['Message']); ?></p>
                                <p class="text-gray-400 text-sm"><strong>Created At:</strong> <?php echo htmlspecialchars($message['Created_at']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-400">No messages yet.</p>
                    <?php endif; ?>
                </div>
            </div>
            <form action="ticket.php?id=<?php echo htmlspecialchars($result['Id']); ?>" method="post">
                <div class="mb-4">
                    <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($result['Id']); ?>">   
                    <label for="response" class="block text-gray-300 font-medium">Response:</label>
                    <textarea id="response" name="response" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                    Submit Response
                </button>
            </form>
        </div>
    </div>
    <?php require_once 'footer.php'; ?>
</body>
</html>

<?php
require_once 'header.php';
require_once 'footer.php';
?>