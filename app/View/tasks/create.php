<?php
    use Core\Csrf;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Task</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .task-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .task-card {
            background: #ffffff;
            padding: 32px;
            border-radius: 14px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .task-card h1 {
            margin-bottom: 8px;
            font-size: 28px;
            color: #111827;
        }

        .task-card .subtitle {
            margin-bottom: 28px;
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;

            border: 1px solid #d1d5db;
            border-radius: 8px;

            font-size: 15px;
            outline: none;

            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .create-btn {
            width: 100%;
            padding: 13px;

            border: none;
            border-radius: 8px;

            background: #2563eb;
            color: white;

            font-size: 15px;
            font-weight: 600;

            cursor: pointer;

            transition: background 0.2s, transform 0.1s;
        }

        .create-btn:hover {
            background: #1d4ed8;
        }

        .create-btn:active {
            transform: scale(0.98);
        }

        .errors {
            margin-bottom: 20px;
            padding: 12px 14px;

            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;

            color: #dc2626;
            font-size: 14px;
        }

        .errors div {
            margin-bottom: 4px;
        }

        .errors div:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>

<div class="task-container">

    <div class="task-card">

        <h1>Create Task</h1>

        <p class="subtitle">
            Add a new task to your task manager.
        </p>

        <?php if (isset($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <div>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/PHP_Review/Public/tasks">

            <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars(Csrf::generateToken()); ?>"
            />

            <div class="form-group">
                <label for="title">Task Title</label>

                <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="Enter task title..."
                        value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                />
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <input
                        type="text"
                        id="description"
                        name="description"
                        placeholder="Enter task description..."
                        value="<?= htmlspecialchars($_POST['description'] ?? '') ?>"
                />
            </div>

            <button type="submit" class="create-btn">
                Create Task
            </button>

        </form>

    </div>

</div>

</body>
</html>