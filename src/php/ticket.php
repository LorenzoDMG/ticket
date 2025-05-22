<?php
require_once 'header.php';
require_once './dbconn.php';
?>
<?php
// get tickjet id from url and fetch it 
$ticketId = $_GET['id'] ?? null;
if ($ticketId) {
    $ticketId = (int) $ticketId;
    $stmt = $db->prepare("SELECT * FROM Ticket WHERE Id = ?");
    $stmt->execute([$ticketId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
    
// Close the database connection
$db = null;

if (isset($_POST))
?>

<!DOCTYPE html>
<html lang="en">
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
            <form action="./response_ticket.php" method="post">
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