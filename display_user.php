<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <style>
        body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0 10px; /* Adjusted left and right margins */
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #3498db, #e91e63);
        color: #000; /* Change text color to black or another suitable color */
        backdrop-filter: blur(10px);
    }
        

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        .card {
        width: 90%; /* Adjusted width to 90% */
        max-width: 1200px;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        overflow: hidden;
        margin-top: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: blue;
            color: #fff;
        }

        .card-tools a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #fff;
            transition: background 0.3s ease-in-out;
        }

        .card-tools a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
        padding: 2px; /* Adjusted padding for cells */
        }

        tr {
        margin-bottom: 2px; /* Adjusted margin for rows */
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
               <h1>Student user list</h1>
            </div>
        </div>
        <div class="card-body">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = $conn->query("SELECT * FROM students_user");
                    while ($row = $query->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td>
                            <button class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#userTable').dataTable();
            $('.view_user').click(function () {
                uni_modal("<i class='fa fa-id-card'></i> User Details", "view_user.php?id=" + $(this).attr('data-id'))
            })
            $('.delete_user').click(function () {
                _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
            })
        })

        function delete_user($id) {
            start_load()
            $.ajax({
                url: 'ajax.php?action=delete_user',
                method: 'POST',
                data: { id: $id },
                success: function (resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully deleted", 'success')
                        setTimeout(function () {
                            location.reload()
                        }, 1500)
                    }
                }
            })
        }
    </script>
</body>
</html>
