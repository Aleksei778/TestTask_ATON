<h2><?php echo $city ? 'Edit City' : 'Add New City'; ?></h2>

<form method="post" action="">
    <?php if ($city): ?>
        <div class="form-group">
            <label>ID:</label>
            <div><?php echo htmlspecialchars($city['ID'], ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <label for="country_id">Country:</label>
        <select id="country_id" name="country_id" required>
            <option value="">Select a country</option>
            <?php foreach ($countries as $country): ?>
                <option value="<?php echo $country['ID']; ?>" <?php echo ($city && $city['COUNTRY_ID'] == $country['ID']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($country['COUNTRY'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="city">City Name:</label>
        <input type="text" id="city" name="city" required value="<?php echo $city ? htmlspecialchars($city['CITY'], ENT_QUOTES, 'UTF-8') : ''; ?>">
    </div>
    
    <div class="form-buttons">
        <button type="submit"><?php echo $city ? 'Update' : 'Create'; ?></button>
        <a href="cities.php">Cancel</a>
    </div>
</form>