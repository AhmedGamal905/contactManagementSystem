<!DOCTYPE html>
<html>
<head>
  <title>User Data Form</title>
  <style>
    .submit-btn {
      margin-top: 10px;
    }
    .view-btn {
      margin-top: 10px;
      margin-left: 10px;
    }
    .delete-section {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h1>User Data Form</h1>

  <form>
    <label for="name">Name:</label>
    <input type="text" id="name" required><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" required><br>

    <label for="email">Email Address:</label>
    <input type="email" id="email" required><br>

    <button type="submit" class="submit-btn">Submit</button>
  </form>

  <button id="view-btn" class="view-btn">View Submissions</button>

  <div class="delete-section">
    <label for="delete-id">Delete User Data (Enter ID):</label>
    <input type="text" id="delete-id">
    <button id="delete-btn">Delete</button>
  </div>
</body>
</html>