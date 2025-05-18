<h2>Users List</h2>

<div class="filter-form">
    <form method="get" action="">
        <div class="form-group">
            <label for="filter_name">Filter by Name:</label>
            <input type="text" id="filter_name" name="filter_name" value="<?php echo isset($_GET['filter_name']) ? htmlspecialchars($_GET['filter_name']) : ''; ?>">
        </div>
        <button type="submit">Filter</button>
    </form>
    
    <form method="get" action="">
        <div class="form-group">
            <label for="filter_location">Filter by Location (Country or City):</label>
            <input type="text" id="filter_location" name="filter_location" value="<?php echo isset($_GET['filter_location']) ? htmlspecialchars($_GET['filter_location']) : ''; ?>">
        </div>
        <button type="submit">Filter</button>
    </form>
    
    <a href="users.php" style="align-self: flex-end; margin-left: auto;">Reset Filters</a>
</div>

<a href="user.php" class="add-button">Add New User</a>

<table>
    <thead>
        <tr>
            <th>
                <a href="?sort=Users.ID&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Users.ID' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    ID <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Users.ID') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>
                <a href="?sort=fullname&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'fullname' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    Full Name <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'fullname') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>
                <a href="?sort=Countries.COUNTRY&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Countries.COUNTRY' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    Country <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Countries.COUNTRY') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>
                <a href="?sort=Cities.CITY&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Cities.CITY' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    City <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Cities.CITY') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($users)): ?>
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['ID']); ?></td>
                    <td><?php echo htmlspecialchars($user['LAST_NAME'] . ' ' . $user['FIRST_NAME']); ?></td>
                    <td><?php echo htmlspecialchars($user['COUNTRY']); ?></td>
                    <td><?php echo htmlspecialchars($user['CITY']); ?></td>
                    <td>
                        <a href="user.php?id=<?php echo $user['ID']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>