<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Post a Job</title>
</head>
<body>
  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Post a Job</h1>
            <!-- Job posting form -->
            <form action="process_post_job.php" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="requirements" class="form-label">Job Requirements</label>
                    <textarea class="form-control" id="requirements" name="requirements" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Job</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
