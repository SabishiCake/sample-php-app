<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
</head>

<body>
    <div class="container-fluid bg-light">
        <div class="row p-5">
            <div class="col ">
                <div class="card bg-white ">
                    <h5 class="card-header bg-success text-white">USER LIST</h5>
                    <div class="card-body ">
                        <div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" name="searchInput"
                                    id="searchInput">
                                <div class="input-group-append">
                                    <!-- <button class="btn btn-success" type="submit" name="searchBtn">Search</button> -->
                                    <span class="input-group-text bg-success text-white" id="basic-addon2">Search</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="listTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listTableBody">
                                        <?php
                                        include_once("controller/controller.users.php");
                                        $users = new Users();
                                        $list = $users->getAllUserData();

                                        foreach ($list as $user) {
                                            echo "<tr>";
                                            echo "<td>" . $user["user_id"] . "</td>";
                                            echo "<td>" . $user["f_name"] . "</td>";
                                            echo "<td>" . $user["l_name"] . "</td>";
                                            echo "<td><button class='btn btn-primary' onclick='handleEdit(" . json_encode($user) . ")'>Edit</button></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <ul class="pagination justify-content-center" id="pagination"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-white">
                    <h5 class="card-header bg-success text-white ">INFORMATION</h5>
                    <div class="card-body">
                        <h5 class="card-title text-center" id="user_id_header"> # </h5>
                        <hr class="hr">

                        <div>
                            <form method="POST" action="" id="userForm">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id_form"
                                        placeholder="Enter ID">
                                </div>

                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" id="f_name" name="f_name_form"
                                        placeholder="Enter First Name">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" id="l_name" name="l_name_form"
                                        placeholder="Enter Last Name">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label> Birthday</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday_form"
                                        placeholder="Enter Birthday">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" id="gender" name="gender_form">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address_form"
                                        placeholder="Enter Address" rows="3"></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="email" name="email_form"
                                        placeholder="Enter Email">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone_form"
                                        placeholder="Enter Phone">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="alert alert-primary" id="alert" role="alert" style="display:none;">
                                </div>

                                <hr class="hr">
                                <div class="container-fl">
                                    <div class="row" id="addContainer" style="display: block;">
                                        <div class="col">
                                            <button type="submit" class="btn btn-success btn-block" name="addBtn"
                                                id="addBtn">Add</button>
                                        </div>
                                    </div>
                                    <div class="row" id="updateContainer" style="display: none;">
                                        <div class="col">
                                            <button class="btn btn-primary btn-block" name="updateBtn"
                                                id="updateBtn">Update</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button class="btn btn-danger btn-block" name="deleteBtn"
                                                id="deleteBtn">Delete</button>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-secondary btn-block" name="clearBtn"
                                                id="clearBtn">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/index.js"></script>
    <script>
        const itemsPerPage = 10;
        let currentPage = 1;

        const displayData = (data, page) => {
            const start = (page - 1) * itemsPerPage;
            const end = page * itemsPerPage;
            const paginatedData = data.slice(start, end);

            const tblBody = document.getElementById("listTableBody");
            tblBody.innerHTML = "";
            paginatedData.forEach((user) => {
                const row = document.createElement("tr");
                row.innerHTML = `<td>${user.user_id}</td>
                    <td>${user.f_name}</td>
                    <td>${user.l_name}</td>
                    <td><button class='btn btn-primary' onclick='handleEdit(${JSON.stringify(
                    user
                )})'>Edit</button></td>`;

                tblBody.appendChild(row);
            });

            const remainingRows = itemsPerPage - paginatedData.length;
            for (let i = 0; i < remainingRows; i++) {
                const row = document.createElement("tr");
                row.innerHTML = "<td>&nbsp;</td>".repeat(4);

                tblBody.appendChild(row);
            }

        };

        const displayPagination = (data, page) => {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            const totalRows = data.length;
            const totalPages = Math.ceil(totalRows / itemsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement("li");
                li.classList.add("page-item");

                const a = document.createElement("a");
                a.classList.add("page-link");
                a.textContent = i;
                a.href = "#";

                a.addEventListener("click", (event) => {
                    event.preventDefault();
                    currentPage = i;
                    displayData(data, currentPage);
                    highlightCurrentPage(i);
                });

                li.appendChild(a);
                pagination.appendChild(li);
            }

            highlightCurrentPage(1);
        };


        const highlightCurrentPage = (page) => {
            const paginationLinks = document.querySelectorAll(".page-link");
            paginationLinks.forEach((link) => {
                link.classList.remove("active");
            });

            const linkIndex = page - 1;
            if (paginationLinks.length > linkIndex && linkIndex >= 0) {
                paginationLinks[linkIndex].classList.add("active");
            }
        };

        // const usersData = <?php echo json_encode($list); ?>;
        const usersData = <?php echo json_encode($list); ?>;
        console.log(usersData);

        displayData(usersData, currentPage);
        displayPagination(usersData);

        const searchInput = document.getElementById("searchInput");
        if (searchInput) {
            searchInput.addEventListener("input", (event) => {
                console.log("searching");
                const searchTerm = searchInput.value.toLowerCase();
                const filteredData = usersData.filter((user) => {
                    return (
                        user.user_id.toLowerCase().includes(searchTerm) ||
                        user.f_name.toLowerCase().includes(searchTerm) ||
                        user.l_name.toLowerCase().includes(searchTerm)
                    );
                });

                displayData(filteredData, currentPage);
                displayPagination(filteredData, currentPage);
            });
        }

    </script>

</body>

</html>