<?php $pluginName = 'theinsertr' ?>

<div class="wrap">
    <h2>The Insertr Settings</h2>

    <?php if (isset($message)): ?>
        <p><?= $message; ?></p>
    <?php endif ?>

    <?php if (isset($errorMessage)): ?>
        <p><?= $errorMessage; ?></p>
    <?php endif ?>

    <form action="options-general.php?page=<?= $pluginName ?>" method="post">
        <p>
            <label for="<?= $pluginName ?>_acf_enable"><strong>Enable ACF field short codes</strong></label>
            <input name="<?= $pluginName ?>_acf_enable" id="<?= $pluginName ?>_acf_enable" type="checkbox" value="<?= htmlentities(get_option($pluginName . '_acf_enable')) ?>" />
        </p>
        <p>
            <label for="<?= $pluginName ?>_yoast_title_enable"><strong>Enable Yoast title short codes</strong></label>
            <input name="<?= $pluginName ?>_yoast_title_enable" id="<?= $pluginName ?>_yoast_title_enable" type="checkbox" value="<?= htmlentities(get_option($pluginName . '_yoast_title_enable')) ?>" />
        </p>
        <?php wp_nonce_field($pluginName, $pluginName . '_nonce'); ?>
        <p>
            <input name="submit" type="submit" name="Submit" class="button button-primary" value="Save" />
        </p>
    </form>

    <img src="https://herdl.com/theinsertr/" />
</div>