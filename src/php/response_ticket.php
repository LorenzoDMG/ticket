<?php

require_once './dbconn.php';
?>
<?php
if (isset($_POST['ticket_id']) && isset($_POST['response']) ) {
    $ticket_id = $_POST['ticket_id'];
    $response= $_POST['response'];

    // Validate the input
    

    // Insert into database
    $stmt = $db->prepare("INSERT INTO messages (Ticket_id, Message) VALUES (?, ?)");
    if ($stmt->execute([$ticket_id, $response])) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error submitting feedback.";
    }
}
?>
