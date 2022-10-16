<?php  

namespace Concrete\Package\OpenstreetMap\Block\OpenstreetMap;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Block\BlockController;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Config;
use Concrete\Core\Error\ErrorList\ErrorList;
class Controller extends BlockController  
{

    protected $btTable = 'btOpenstreetMap';
    protected $btInterfaceWidth = 525;
    protected $btInterfaceHeight = 550;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btDefaultSet = 'multimedia';

    public function getBlockTypeDescription()
    {
        return t('Shows a Openstreet Map');
    }

    public function getBlockTypeName()
    {
        return t('Openstreet Map');
    }

    public function validate($args)
    {
        $error = $this->app->make(ErrorList::class);

        if (!trim($args['apiKey'])) {
            $error->add(t('Please enter a valid API key.'));
        }

        if (empty($args['location']) || $args['latitude'] === '' || $args['longtitude'] === '') {
            $error->add(t('You must select a valid location.'));
        }

        if (!is_numeric($args['zoom'])) {
            $error->add(t('Please enter a zoom number from 0 to 21.'));
        }

        if ($error->has()) {
            return $error;
        }
    }

    public function registerViewAssets($outputContent = '')
    {
        $c = Page::getCurrentPage();
        if (!$c->isEditMode()) {
            $this->requireAsset('mapbox-gl');
        }
    }

    public function save($data)
    {
        $data += [
           'title' => '',
           'location' => '',
           'zoom' => -1,
           'latitude' => 0,
           'longitude' => 0,
           'width' => null,
           'height' => null,
           'scrollwheel' => 0,
           'apiKey' => '',
        ];

        Config::save('app.api_keys.openstreet.maps', trim($data['apiKey']));

        $args['title'] = trim($data['title']);
        $args['location'] = trim($data['location']);
        $args['zoom'] = (intval($data['zoom']) >= 0 && intval($data['zoom']) <= 21) ? intval($data['zoom']) : 14;
        $args['latitude'] = is_numeric($data['latitude']) ? $data['latitude'] : 0;
        $args['longitude'] = is_numeric($data['longitude']) ? $data['longitude'] : 0;
        $args['width'] = $data['width'];
        $args['height'] = $data['height'];
        $args['scrollwheel'] = $data['scrollwheel'] ? 1 : 0;

        parent::save($args);
    }
}