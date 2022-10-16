<?php defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Page\Page;
use Concrete\Core\Localization\Localization;

$c = Page::getCurrentPage();
if ($c->isEditMode()) {
    $loc = Localization::getInstance();
    $loc->pushActiveContext(Localization::CONTEXT_UI);
    ?>
	<div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
		<div style="padding: 80px 0px 0px 0px"><?=t('Open Street Map disabled in edit mode.')?></div>
	</div>
    <?php
    $loc->popActiveContext();
} else { ?>
	<?php  if( strlen($title)>0) { ?><h3><?=$title?></h3><?php  } ?>
    <div class="map-wrapper" id="map-wrapper-<?= $bID ?>">
        <div class="loader-wrapper">
            <div class="loader" id="loader-<?= $bID ?>">
                <div class="loader-inner">
                    <div class="spinner">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container for the Map -->
        <div class='map'></div> 
        <!-- End of Container -->
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const map = new Mapbox (
                "#map-wrapper-<?= $bID ?>",
                '.loader-wrapper .loader',
                '.map',
                'pk.eyJ1IjoibXVyYXR5aWwiLCJhIjoiY2w5YjM1bXJuMGZjajN4bGV5bDNxZnVydiJ9.QIqmJixrZfWmYKJhLjVqFg',
                'icon icon-icon-marker feature-icon-small',
                16,
                47.0,
                9.5,
                'marker',
                'mapbox://styles/mapbox/light-v10',
            );       
        });
    </script>
<?php  } ?>