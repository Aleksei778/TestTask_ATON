<h2>Countries List</h2>

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
            <label for="filter_id">Filter by ID:</label>
            <input type="text" id="filter_id" name="filter_id" value="<?php echo isset($_GET['filter_id']) ? htmlspecialchars($_GET['filter_id']) : ''; ?>">
        </div>
        <button type="submit">Filter</button>
    </form>
    
    <a href="countries.php" style="align-self: flex-end; margin-left: auto;">Reset Filters</a>
</div>

<a href="country.php" class="add-button">Add New Country</a>

<table>
    <thead>
        <tr>
            <th>
                <a href="?sort=ID&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ID' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    ID <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ID') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>
                <a href="?sort=COUNTRY&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'COUNTRY' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    Country <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'COUNTRY') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($countries)): ?>
            <tr>
                <td colspan="3">No countries found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($countries as $country): ?>
                <tr>
                    <td><?php echo htmlspecialchars($country['ID']); ?></td>
                    <td><?php echo htmlspecialchars($country['COUNTRY']); ?></td>
                    <td>
                        <a href="country.php?id=<?php echo $country['ID']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>