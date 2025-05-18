<h2><?php echo $user ? 'Edit User' : 'Add New User'; ?></h2>

<form method="post" action="">
    <?php if ($user): ?>
        <div class="form-group">
            <label>ID:</label>
            <div><?php echo htmlspecialchars($user['ID']); ?></div>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <label for="city_id">City:</label>
        <select id="city_id" name="city_id" required>
            <option value="">Select a city</option>
            <?php foreach ($cities as $city): ?>
                <option value="<?php echo $city['ID']; ?>" <?php echo ($user && $user['CITY_ID'] == $city['ID']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($city['COUNTRY'] . ' - ' . $city['CITY']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required value="<?php echo $user ? htmlspecialchars($user['FIRST_NAME']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $user ? htmlspecialchars($user['LAST_NAME']) : ''; ?>">
    </div>
    
    <div class="form-buttons">
        <button type="submit"><?php echo $user ? 'Update' : 'Create'; ?></button>
        <a href="users.php">Cancel</a>
    </div>
</form>