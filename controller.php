<?php  

namespace Concrete\Package\OpenstreetMap;

defined('C5_EXECUTE') or die('Access Denied.');

use \Concrete\Core\Package\Package;
use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Asset\Asset;

class Controller extends Package
{
    protected $pkgHandle = 'openstreet_map';
    protected $appVersionRequired = '^8.5.1';
    protected $pkgVersion = '0.1.0';
    const OPENSTREETMAP_BLOCK_TYPE = 'openstreet_map';

    public function getPackageDescription()
    {
        return t('Adds the Openstreet Map block to your website.');
    }

    public function getPackageName()
    {
        return t('Openstreet Map');
    }

    public function on_start()
    {
        $al = AssetList::getInstance();
    
        $al->register('javascript', 'mapbox-gl', 'js/mapbox-gl.2.10.0.min.js', array('position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $this);
        $al->register('css', 'mapbox-gl', 'css/mapbox-gl.2.10.0.min.css', array('position' => Asset::ASSET_POSITION_HEADER, 'minify' => false, 'combine' => true), $this);
        $al->registerGroup('mapbox-gl', array(
            array('css', 'mapbox-gl'),
            array('javascript', 'mapbox-gl')
        ));
    }

    public function install()
    {
        $pkg = parent::install();

        $openstreet_map_block_type  = BlockType::getByHandle(self::OPENSTREETMAP_BLOCK_TYPE, $pkg);

        if (false === is_object($openstreet_map_block_type)) {
            BlockType::installBlockType(self::OPENSTREETMAP_BLOCK_TYPE, $pkg);
        }
    }

    public function upgrade()
    {
        parent::upgrade();
        // Our custom package upgrade code will go here.
    }
}