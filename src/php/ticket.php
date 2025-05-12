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
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">e-ticket</h1>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Ticket ID:</label>
            <p class="text-gray-900"><?php echo htmlspecialchars($result['Id']); ?></p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Title:</label>
            <p class="text-gray-900"><?php echo htmlspecialchars($result['Title']); ?></p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Description:</label>
            <p class="text-gray-900"><?php echo htmlspecialchars($result['Description']); ?></p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Created At:</label>
            <p class="text-gray-900"><?php echo htmlspecialchars($result['Created_at']); ?></p>
        </div>
        <form action="./response_ticket.php" method="post">
            <div class="mb-4">
                <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($result['Id']); ?>">   
                <label for="response" class="block text-gray-700 font-medium">Response:</label>
                <textarea id="response" name="response" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Submit Response
            </button>
        </form>
    </div>
        </body>
</html>

<?php
require_once 'header.php';
require_once 'footer.php';
?>