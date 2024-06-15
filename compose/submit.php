<?php
session_start();

try {
    $db = new PDO('sqlite:../chirp.db');

    // Define rate limiting parameters
    define('COOLDOWN_SECONDS', 10); // Example: 10 seconds cooldown between chirps

    // Check if the last submission time is stored in the session
    $lastSubmissionTime = isset($_SESSION['last_submission_time']) ? $_SESSION['last_submission_time'] : 0;
    $currentTime = time();

    // Check if cooldown period has elapsed
    if ($currentTime - $lastSubmissionTime < COOLDOWN_SECONDS) {
        // Rate limit exceeded, redirect back to compose page or show an error message
        $_SESSION['error_message'] = "You are posting too quickly. Slow down!";
        header('Location: /' . $chirpId);
        exit;
    }

    // Prepare SQL statement for inserting chirp into database
    $sql = "INSERT INTO chirps (chirp, user, timestamp) VALUES (:chirp, :user, :timestamp)";
    $stmt = $db->prepare($sql);

    // Bind parameters
    $chirp = $_POST['chirpComposeText'];
    $user = '@guest';
    $timestamp = time();

    $stmt->bindParam(':chirp', $chirp);
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':timestamp', $timestamp);

    // Execute the SQL statement
    $stmt->execute();

    // Store the ID of the newly inserted chirp
    $chirpId = $db->lastInsertId();

    // Update last submission time in session
    $_SESSION['last_submission_time'] = $currentTime;

    // Redirect to the chirp details page with the chirp ID
    header('Location: /chirp/index.php?id=' . $chirpId);
    exit;
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>