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
        $predefined = (array)$this->Request()->getParam('predefined', []);
        $customBannerId = (int)$this->Request()->getParam('customBannerId', 0);

//        Fetch Banner
        $banner = null;
        try {
            $context = Shopware()->Container()->get('shopware_storefront.context_service')->getShopContext();
            if ($customBannerId) {
                $media = Shopware()->Container()->get('shopware_storefront.media_service')->get(
                    $customBannerId, $context
                );
                $banner = Shopware()->Container()->get('legacy_struct_converter')->convertMediaStruct($media);
            }
        }catch(\Exception $e){}

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