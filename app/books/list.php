<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku</title>
    <link rel="stylesheet" href="list.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>
    <h3>Books List</h3>
    <a href="add_book.php" class="btn-add">Add Data</a>
    <form method="get" action="" class="filter-form">
        <select id="category" name="category_id">
            <option value="">All Categories</option>
            <?php
            include '../db.php'; // pastikan path ke file db.php benar

            // Fetch categories for filter dropdown
            $category_result = $conn->query("SELECT id, name FROM categories");
            while ($category = $category_result->fetch_assoc()) {
                $selected = isset($_GET['category_id']) && $_GET['category_id'] == $category['id'] ? 'selected' : '';
                echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <?php
    // Handle filtering logic
    $filter_query = "";
    if (isset($_GET['category_id']) && $_GET['category_id'] !== '') {
        $category_id = intval($_GET['category_id']);
        $filter_query = " WHERE category_id=$category_id";
    } elseif (isset($_GET['search_text'])) {
        $search_text = $conn->real_escape_string($_GET['search_text']);
        $filter_query = " WHERE title LIKE '%$search_text%' OR author LIKE '%$search_text%' OR publisher LIKE '%$search_text%'";
    }

    // Fetch books based on filter
    $result = $conn->query("SELECT * FROM books" . $filter_query);

    if ($result) {
        echo "<table class='book-table datatable'>";
        echo "<thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publication Date</th>
                    <th>Publisher</th>
                    <th>Pages</th>
                    <th>Category ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
              </thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr id='book-" . $row["id"] . "'>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["author"] . "</td>";
            echo "<td>" . $row["publication_date"] . "</td>";
            echo "<td>" . $row["publisher"] . "</td>";
            echo "<td>" . $row["pages"] . "</td>";
            echo "<td>" . $row["category_id"] . "</td>";
            echo "<td>";
            if (!empty($row["image"])) {
                echo "<img src='../uploads/" . $row["image"] . "' alt='Book Image' style='width: 50px; height: auto;'>";
            } else {
                echo "No Image";
            }
            echo "</td>";
            echo "<td>
                <div class = 'action-buttons'>
                    <a href='edit_book.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a> 
                    <a href='#' class='btn-delete' onclick='confirmDelete(" . $row['id'] . ")'>Delete</a>
                </div>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Error: " . $conn->error;
    }
    ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Initialization -->
    <script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });

    function confirmDelete(id) {
        if (confirm("Apakah anda yakin ingin menghapus data tersebut?")) {
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    if (response === 'success') {
                        $('#book-' + id).remove();
                    } else {
                        alert('Error deleting book.');
                    }
                },
                error: function() {
                    alert('Error deleting book.');
                }
            });
        }
    }
    </script>

</body>
</html>
