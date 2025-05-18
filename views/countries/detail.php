<h2><?php echo $country ? 'Edit Country' : 'Add New Country'; ?></h2>

<form method="post" action="">
    <?php if ($country): ?>
        <div class="form-group">
            <label>ID:</label>
            <div><?php echo htmlspecialchars($country['ID']); ?></div>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <label for="country">Country Name:</label>
        <input type="text" id="country" name="country" required value="<?php echo $country ? htmlspecialchars($country['COUNTRY']) : ''; ?>">
    </div>
    
    <div class="form-buttons">
        <button type="submit"><?php echo $country ? 'Update' : 'Create'; ?></button>
        <a href="countries.php">Cancel</a>
    </div>
</form>