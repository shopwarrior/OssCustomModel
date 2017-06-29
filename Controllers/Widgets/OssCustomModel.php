<?php
use OssCustomModel\Models\CustomModel\CustomModel;

class Shopware_Controllers_Widgets_OssCustomModel extends Enlight_Controller_Action
{
    public function indexAction()
    {
//        TODO: set perPage in config
        $perPage = (int) $this->Request()->getParam(
            'perPage', Shopware()->Config()->getByNamespace('OssCustomModel', 'amount')
        );
        $customId = (int)$this->Request()->getParam('customId', 0);
        $customBannerId = $predefined = $banner = null;

        if($customId){
            $attributes = Shopware()->Db()->fetchRow('SELECT * FROM `s_cms_static_attributes` WHERE `cmsStaticID`=?', [$customId]);
            $predefined = explode('|', trim($attributes['customize'], '|'));
            $customBannerId = $attributes['custombanner'];

//        Fetch Banner
            try {
                if ($customBannerId) {
                    $context = Shopware()->Container()->get('shopware_storefront.context_service')->getShopContext();
                    $media = Shopware()->Container()->get('shopware_storefront.media_service')->get(
                        $customBannerId, $context
                    );
                    $banner = Shopware()->Container()->get('legacy_struct_converter')->convertMediaStruct($media);
                }
            }catch(\Exception $e){}
        }

        $this->View()->ossCustomModels = $this->getAll($perPage, $predefined);
        $this->View()->ossCustomBanner = $banner;
    }

    private function getAll($perPage, $predefined)
    {
        $orderBy = array('date' => 'desc');
        $conditions['active'] = 1;

        if(!empty($predefined)) $conditions['id'] = $predefined;

        return $this->getRepository()->findBy( $conditions, $orderBy, $perPage);
    }


    /**
     * @return OssCustomModel\Models\CustomModel\Repository
     */
    private function getRepository()
    {
        return \Shopware()->Models()->getRepository(CustomModel::class);
    }
}