<?php
include 'includes/header.php';
include 'db/conn.php';

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $string_id = $_POST['string_id'];
    
    // Prevent SQL injection using prepared statements
    if (!empty($string_id) && is_numeric($string_id)) {
        $stmt = $conn->prepare("DELETE FROM string_info WHERE string_id = ?");
        $stmt->bind_param("i", $string_id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo '<div class="alert alert-success">Record deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-warning">No record found with that ID.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Error deleting record.</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="alert alert-danger">Invalid ID provided.</div>';
    }
}

// Fetch all records
$result = $conn->query("SELECT string_id, message FROM string_info ORDER BY string_id DESC");
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Records</h3>
                </div>
                <div class="card-body">
                    <?php if ($result->num_rows > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>String ID</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['string_id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No records found.</p>
                    <?php endif; ?>
                    
                    <!-- Delete Form -->
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Delete Record</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="string_id" class="form-label">String ID to Delete:</label>
                                            <input type="number" class="form-control" id="string_id" name="string_id" required min="1">
                                        </div>
                                        <div class="col-md-6 d-flex align-items-end">
                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
