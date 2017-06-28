<?php

namespace OssCustomModel;

use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Shopware-Plugin OssCustomModel.
 */
class OssCustomModel extends Plugin
{
    /**
     * Adds the widget and create the database schema.
     *
     * @param Plugin\Context\InstallContext $installContext
     */
    public function install(Plugin\Context\InstallContext $installContext)
    {
        parent::install($installContext);
        try{
            $this->createSchema();
            $this->updateSchema();
        }catch(\Exception $e){
            /** @var \Shopware\Components\Logger */
            Shopware()->Pluginlogger()->addError($e->getMessage());
        }
    }

    /**
     * @param ActivateContext $context
     */
    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache( array( InstallContext::CACHE_LIST_ALL ) );
    }

    /**
     * @param DeactivateContext $context
     */
    public function deactivate(DeactivateContext $context)
    {
        $context->scheduleClearCache( array( InstallContext::CACHE_LIST_ALL ) );
    }

    /**
     * Remove widget and remove database schema.
     *
     * @param Plugin\Context\UninstallContext $uninstallContext
     */
    public function uninstall(Plugin\Context\UninstallContext $uninstallContext)
    {
        parent::uninstall($uninstallContext);
        try{
            $this->removeSchema();
            $this->dropSchema();
        }catch(\Exception $e){
            /** @var \Shopware\Components\Logger */
            Shopware()->Pluginlogger()->addError($e->getMessage());
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('oss_custom_model.plugin_dir', $this->getPath());
        parent::build($container);
    }

    /**
     * create schema
     */
    private function createSchema()
    {
        $tool = new SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetadata(\OssCustomModel\Models\CustomModel\CustomModel::class)
        ];
        $tool->createSchema($classes);
    }

    /**
     * remove schema
     */
    private function removeSchema()
    {
//        TODO: uncomment
        return ;
        $tool = new SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetadata(\OssCustomModel\Models\CustomModel\CustomModel::class)
        ];
        $tool->dropSchema($classes);
    }

    /**
     * add attributes for `Shop Pages`
     */
    private function updateSchema()
    {
        $service = $this->container->get('shopware_attribute.crud_service');

        $service->update('s_cms_static_attributes', 'custombanner', 'single_selection', [
            'label' => Shopware()->Snippets()->getNamespace("backend/common/main")->get(
                'custombannerField', 'Banner', true
            ),
            'helpText' => Shopware()->Snippets()->getNamespace("backend/common/main")->get(
                'custombannerDescrption', 'Landing Page Banner', true
            ),
            'entity' => 'Shopware\Models\Media\Media',
            'displayInBackend' => true,
            'position' => 1
        ]);

        $service->update('s_cms_static_attributes', 'position', 'combobox', [
            'label' => Shopware()->Snippets()->getNamespace("backend/common/main")->get(
                'positionField', 'Banner Position', true
            ),
            'displayInBackend' => true,
            'arrayStore' => [
                ['key' => 'top', 'value' => 'On Top'],
                ['key' => 'bottom', 'value' => 'On THe Bottom']
            ],
            'position' => 2
        ]);

        $service->update('s_cms_static_attributes', 'customize', 'multi_selection', [
            'label' => Shopware()->Snippets()->getNamespace("backend/common/main")->get(
                'customizeField', 'Custom Models', true
            ),
            'helpText' => Shopware()->Snippets()->getNamespace("backend/common/main")->get(
                'customizeDescrption', 'Related Custom Models.', true
            ),
            'entity' => 'OssCustomModel\Models\CustomModel\CustomModel',
            'displayInBackend' => true,
            'position' => 3
        ]);

//        Regeneration attributes proxy for including this attributes
        Shopware()->Models()->generateAttributeModels( array('s_cms_static_attributes') );
    }

    /**
     * remove schema
     */
    private function dropSchema()
    {
//        TODO: uncomment
        return ;
        $service = $this->container->get('shopware_attribute.crud_service');

        $service->delete('s_cms_static_attributes', 'custombanner');
        $service->delete('s_cms_static_attributes', 'position');
        $service->delete('s_cms_static_attributes', 'customize');

//        Regeneration attributes proxy for excluding this attributes
        Shopware()->Models()->generateAttributeModels( array('s_cms_static_attributes') );
    }
}
