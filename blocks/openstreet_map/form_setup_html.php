<?php
defined('C5_EXECUTE') or die('Access Denied.');

/* @var Concrete\Core\Form\Service\Form $form */
/* @var string $title */
/* @var string $location */
/* @var string $latitude */
/* @var string $longitude */

/* @var int $zoom */
/* @var string $width */
/* @var string $height */
/* @var int $scrollwheel */

if (!isset($title)) {
    $title = '';
}
if (!isset($location)) {
    $location = '';
}
if (!isset($location)) {
    $location = '';
}
if (!isset($latitude)) {
    $latitude = '';
}
if (!isset($longitude)) {
    $longitude = '';
}
if (empty($zoom)) {
    $zoom = 14;
}
if (!isset($width)) {
    $width = '100%';
}
if (!isset($height)) {
    $height = '400px';
}
$scrollwheel = !empty($scrollwheel);
?>

<div class="ccm-google-map-block-container row">
    <div class="col-xs-12">
        <div class="form-group">
            <?= $form->label('apiKey', t('API Key') . ' <i class="fa fa-question-circle launch-tooltip" title="' . t('The API Key must be enabled for Google Maps and Google Places.') . "\n" . t('API keys can be obtained in the Google Developers Console.') . '"></i>') ?>
            <div class="input-group">
                <?= $form->text('apiKey', Config::get('app.api_keys.openstreet.maps')) ?>
                <span class="input-group-btn">
                    <a id="ccm-google-map-check-key" class="btn btn-default" href="#">
                        <?= t('Check') ?>
                        &nbsp;
                        <i id="ccm-google-map-check-key-spinner" class="fa fa-play"></i>
                    </a>
                </span>
            </div>
            <div id="block_note" class="alert alert-info" role="alert"><?= t('Checking API Key...') ?></div>
        </div>

        <div class="form-group">
        </div>

        <div class="form-group">
            <?= $form->label('title', t('Map Title (optional)')) ?>
            <?= $form->text('title', $title) ?>
        </div>

        <div id="ccm-google-map-block-location" class="form-group">
            <?= $form->label('location', t('Location')  . ' <i class="fa fa-question-circle launch-tooltip" title="' . t('Start typing a location (e.g. Apple Store or 235 W 3rd, New York) then click on the correct entry on the list.') . '"></i>') ?>
            <?= $form->text('location', $location) ?>
            <?= $form->hidden('latitude', $latitude) ?>
            <?= $form->hidden('longitude', $longitude) ?>
            <div id="map-canvas"></div>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <?= $form->label('zoom', t('Zoom')) ?>
            <?php
            $zoomLevels = range(0, 21);
            $zoomArray = array_combine($zoomLevels, $zoomLevels);
            ?>
            <?= $form->select('zoom', $zoomArray, $zoom) ?>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <?= $form->label('width', t('Map Width')) ?>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                <?= $form->text('width', $width) ?>
            </div>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <?= $form->label('height', t('Map Height')) ?>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                <?= $form->text('height', $height) ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <div class="checkbox">
                <label>
                <?= $form->checkbox('scrollwheel', 1, $scrollwheel) ?>
                <?= t('Enable Scroll Wheel') ?>
                </label>
            </div>
        </div>
    </div>
</div>
