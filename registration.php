<?php
$student_num = trim($_POST['student_num'] ?? '');
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$section = trim($_POST['section'] ?? '');


$errors = [];
$success = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($student_num === '') {
        $errors[] = "Student Number is required.";
    } elseif (!preg_match('/^\d{4}-\d{5}$/', $student_num)) {
        $errors[] = "Student Number must follow YYYY-NNNNN format (example: 2026-12345).";
    }


    if ($full_name === '') {
        $errors[] = "Full Name is required.";
    }


    if ($email === '') {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }


    if ($section === '') {
        $errors[] = "Section is required.";
    }


    if (empty($errors)) {
        $success = "Registration successful! All fields are valid.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }


        .container {
            max-width: 450px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }


        h2 {
            text-align: center;
        }


        label {
            display: block;
            margin-top: 12px;
        }


        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }


        button {
            width: 100%;
            padding: 10px;
            margin-top: 18px;
            background-color: #2878c8;
            color: white;
            border: none;
            border-radius: 4px;
        }


        .error {
            background-color: #ffe5e5;
            color: #b00020;
            padding: 10px;
            margin-bottom: 10px;
        }


        .success {
            background-color: #e2f7e5;
            color: #176b2c;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>


<div class="container">
    <h2>Student Registration Form</h2>


    <?php if (!empty($errors)): ?>
        <div class="error">
            <strong>Please fix the following errors:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


    <?php if ($success !== ''): ?>
        <div class="success">
            <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>


    <form method="POST" action="" >
        <label for="student_num">Student Number:</label>
        <input type="text" id="student_num" name="student_num"
               placeholder="2026-12345" required
               value="<?= htmlspecialchars($student_num, ENT_QUOTES, 'UTF-8') ?>">


        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name"
               required
               value="<?= htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8') ?>">


        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email"
               required
               value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">


        <label for="section">Section:</label>
        <input type="text" id="section" name="section"
               required
               value="<?= htmlspecialchars($section, ENT_QUOTES, 'UTF-8') ?>">


        <button type="submit">Register</button>
    </form>
</div>


</body>
</html>


ito ba pwede rin?