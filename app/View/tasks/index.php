<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tasks</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;

            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            color: #111827;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        /* Buttons */

        .btn {
            display: inline-block;

            padding: 10px 16px;

            border: none;
            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;

            text-decoration: none;
            cursor: pointer;

            transition: background 0.2s, transform 0.1s;
        }

        .btn:active {
            transform: scale(0.97);
        }

        .btn-new {
            background: #2563eb;
            color: #ffffff;
        }

        .btn-new:hover {
            background: #1d4ed8;
        }

        .btn-update {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-update:hover {
            background: #e5e7eb;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .btn-logout {
            background: #111827;
            color: #ffffff;
        }

        .btn-logout:hover {
            background: #374151;
        }

        /* Task list */

        .tasks {
            display: flex;
            flex-direction: column;
            gap: 14px;

            list-style: none;
        }

        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;

            padding: 20px;

            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .task-info {
            flex: 1;
            min-width: 0;
        }

        .task-title {
            margin-bottom: 6px;

            font-size: 18px;
            font-weight: 600;

            color: #111827;
        }

        .task-description {
            color: #6b7280;
            font-size: 14px;

            word-break: break-word;
        }

        .task-actions {
            display: flex;
            align-items: center;
            gap: 8px;

            flex-shrink: 0;
        }

        .delete-form {
            display: inline;
        }

        /* Empty state */

        .empty {
            padding: 40px;

            text-align: center;

            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            color: #6b7280;
        }

        /* Bottom */

        .bottom-actions {
            display: flex;
            justify-content: flex-end;

            margin-top: 25px;
        }

        /* Responsive */

        @media (max-width: 600px) {

            .container {
                padding: 25px 15px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .task {
                align-items: flex-start;
                flex-direction: column;
            }

            .task-actions {
                width: 100%;
            }

            .task-actions .btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Header -->

    <div class="header">

        <h1>My Tasks</h1>

        <div class="header-actions">

            <a
                    href="/PHP_Review/Public/tasks/create"
                    class="btn btn-new"
            >
                + New Task
            </a>

        </div>

    </div>


    <!-- Tasks -->

    <?php if (!empty($tasks)): ?>

        <ul class="tasks">

            <?php foreach ($tasks as $t): ?>

                <?php $id = $t['id']; ?>

                <li class="task">

                    <div class="task-info">

                        <div class="task-title">
                            <?= htmlspecialchars($t['title']) ?>
                        </div>

                        <div class="task-description">
                            <?= htmlspecialchars($t['description']) ?>
                        </div>

                    </div>


                    <div class="task-actions">

                        <!-- Update -->

                        <a
                                href="/PHP_Review/Public/tasks/edit/<?= $id ?>"
                                class="btn btn-update"
                        >
                            Update
                        </a>


                        <!-- Delete -->

                        <form
                                method="POST"
                                action="/PHP_Review/Public/tasks/delete/<?= $id ?>"
                                class="delete-form"
                        >

                            <input
                                    type="hidden"
                                    name="csrf_token"
                                    value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
                            >

                            <button
                                    type="submit"
                                    class="btn btn-delete"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </li>

            <?php endforeach; ?>

        </ul>

    <?php else: ?>

        <div class="empty">

            <p>You don't have any tasks yet.</p>

        </div>

    <?php endif; ?>


    <!-- Logout -->

    <div class="bottom-actions">

        <form
                method="POST"
                action="/PHP_Review/Public/auth/logout"
        >

            <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
            >

            <button
                    type="submit"
                    class="btn btn-logout"
            >
                Logout
            </button>

        </form>

    </div>

</div>

</body>
</html>
