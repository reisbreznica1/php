
<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$is_admin = $_SESSION['is_admin'] ?? 'false';

if ($is_admin == 'true') {
    $sql = "SELECT movies.movie_name, users.email, bookings.id,
            bookings.nr_tickets, bookings.date, bookings.is_approved,
            bookings.time
            FROM movies
            INNER JOIN bookings ON movies.id = bookings.movie_id
            INNER JOIN users ON users.id = bookings.user_id";

    $selectBookings = $conn->prepare($sql);
} else {
    $sql = "SELECT movies.movie_name, users.email,
            bookings.nr_tickets, bookings.date,
            bookings.is_approved, bookings.time
            FROM movies
            INNER JOIN bookings ON movies.id = bookings.movie_id
            INNER JOIN users ON users.id = bookings.user_id
            WHERE bookings.user_id = :user_id";

    $selectBookings = $conn->prepare($sql);
    $selectBookings->bindParam(':user_id', $user_id);
}

$selectBookings->execute();
$bookings_data = $selectBookings->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Movie Bookings</h1>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>

    <a href="home.php" class="btn btn-primary mb-3">Home</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Dashboard</a>
    <a href="logout.php" class="btn btn-danger mb-3">Sign out</a>

    <div class="table-responsive">

        <table class="table table-striped table-bordered">

            <thead>
                <tr>
                    <th>Movie Name</th>
                    <th>User Email</th>
                    <th>Number of Tickets</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Approval Status</th>

                    <?php if ($is_admin == 'true') { ?>
                        <th>Actions</th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>

                <?php if (count($bookings_data) > 0) { ?>

                    <?php foreach ($bookings_data as $booking_data) { ?>

                        <tr>

                            <td><?php echo htmlspecialchars($booking_data['movie_name']); ?></td>

                            <td><?php echo htmlspecialchars($booking_data['email']); ?></td>

                            <td><?php echo htmlspecialchars($booking_data['nr_tickets']); ?></td>

                            <td><?php echo htmlspecialchars($booking_data['date']); ?></td>

                            <td><?php echo htmlspecialchars($booking_data['time']); ?></td>

                            <td>
                                <?php
                                if ($booking_data['is_approved'] == 'true') {
                                    echo '<span class="text-success">Approved</span>';
                                } else {
                                    echo '<span class="text-warning">Pending</span>';
                                }
                                ?>
                            </td>

                            <?php if ($is_admin == 'true') { ?>

                                <td>
                                    <a href="approve.php?id=<?php echo $booking_data['id']; ?>">Approve</a>
                                    |
                                    <a href="decline.php?id=<?php echo $booking_data['id']; ?>">Decline</a>
                                </td>

                            <?php } ?>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="<?php echo ($is_admin == 'true') ? 7 : 6; ?>">
                            You have no bookings yet.
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
