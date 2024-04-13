<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Job Seeker Sign Up</title>
</head>
<body>
  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Job Seeker Sign Up</h1>
            <!-- Job seeker sign up form -->
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="skills" class="form-label">Skills</label>
                    <textarea class="form-control" id="skills" name="skills"></textarea>
                </div>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume (PDF)</label>
                    <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf">
                </div>
                <button type="submit" class="btn btn-primary" name="register_job_seeker">Sign Up</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
