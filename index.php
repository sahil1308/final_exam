<?php
include 'includes/header.php';
include 'db/conn.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $message = $_POST['message'];
    
    // Prevent SQL injection using prepared statements
    if (!empty($message)) {
        // Validate message length (max 50 characters)
        if (strlen($message) > 50) {
            echo '<div class="alert alert-danger">Message must be 50 characters or less.</div>';
        } else {
            $stmt = $conn->prepare("INSERT INTO string_info (message) VALUES (?)");
            $stmt->bind_param("s", $message);
            
            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Message saved successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error saving message.</div>';
            }
            $stmt->close();
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Enter Your Message</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="message" class="form-label">Message (max 50 characters):</label>
                            <input type="text" class="form-control" id="message" name="message" required maxlength="50">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                    <div class="mt-3">
                        <a href="showAll.php" class="btn btn-secondary">Show all records</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>