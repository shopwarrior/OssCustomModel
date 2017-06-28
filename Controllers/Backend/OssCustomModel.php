<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
 */

class Shopware_Controllers_Backend_OssCustomModel extends Shopware_Controllers_Backend_Application
{
    protected $model = 'OssCustomModel\Models\CustomModel\CustomModel';
    protected $alias = 'oss_custom_model';
}
