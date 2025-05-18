<h2>Cities List</h2>

<div class="filter-form">
    <form method="get" action="">
        <div class="form-group">
            <label for="filter_name">Filter by Name (City or Country):</label>
            <input type="text" id="filter_name" name="filter_name" value="<?php echo isset($_GET['filter_name']) ? htmlspecialchars($_GET['filter_name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>
        <button type="submit">Filter</button>
    </form>
    
    <form method="get" action="">
        <div class="form-group">
            <label for="filter_id">Filter by ID:</label>
            <input type="text" id="filter_id" name="filter_id" value="<?php echo isset($_GET['filter_id']) ? htmlspecialchars($_GET['filter_id'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>
        <button type="submit">Filter</button>
    </form>
    
    <a href="cities.php" style="align-self: flex-end; margin-left: auto;">Reset Filters</a>
</div>

<a href="city.php" class="add-button">Add New City</a>

<table>
    <thead>
        <tr>
            <th>
                <a href="?sort=Cities.ID&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Cities.ID' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    ID <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'Cities.ID') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>
                <a href="?sort=COUNTRY&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'COUNTRY' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    Country <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'COUNTRY') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>
                <a href="?sort=CITY&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'CITY' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="sort-link">
                    City <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'CITY') ? (isset($_GET['order']) && $_GET['order'] == 'ASC' ? '▲' : '▼') : ''; ?>
                </a>
            </th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($cities)): ?>
            <tr>
                <td colspan="4">No cities found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($cities as $city): ?>
                <tr>
                    <td><?php echo htmlspecialchars($city['ID'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($city['COUNTRY'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($city['CITY'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="city.php?id=<?php echo $city['ID']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>