<div class="action-page">
    <form action="" method="post">
        <div class="select-feature">
            <?php foreach ($data['features'] as $features): ?>
                <label for="<?= $features['id'] ?>" class="Checkbox-container">
                    <!-- Kiểm tra nếu feature_id có trong mảng productFeatures -->
                    <input name="features[]" type="checkbox" id="<?= $features['id'] ?>" value="<?= $features['id'] ?>"
                        <?php echo in_array($features['id'], $data['productFeatures']) ? 'checked' : ''; ?>>
                    <span class="Checkbox-checkmark Checkbox-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div class="Chechbox-textGroup">
                        <div class="sm Chechbox-title label"><?= $features['text'] ?></div>
                        <p class="sm"></p>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="flex align-center gap-16 actions">
            <button type="submit" class="btn btn-normal btn-primary">
                <div class="label md">Tạo</div>
            </button>
        </div>
    </form>
</div>
