
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Registration Form</h3>
                </div>

                <div class="card-body p-4">

                    <form action="add.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                placeholder="Enter your username" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter your first name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="surname" class="form-control"
                                placeholder="Enter your surname" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Enter your email" required>
                        </div>

                        <div class="d-grid gap-2">

                            <button type="submit" name="submit" class="btn btn-primary">
                                Register
                            </button>

                            <button type="reset" class="btn btn-secondary">
                                Reset Form
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
