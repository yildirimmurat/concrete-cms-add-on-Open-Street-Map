<?php  

namespace Concrete\Package\OpenstreetMap;

defined('C5_EXECUTE') or die('Access Denied.');

use \Concrete\Core\Package\Package;
use Concrete\Core\Block\BlockType\BlockType;

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