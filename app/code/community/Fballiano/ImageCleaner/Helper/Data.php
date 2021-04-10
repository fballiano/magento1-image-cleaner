<?php

/**
 * FBalliano
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this Module to
 * newer versions in the future.
 *
 * @category   FBalliano
 * @package    FBalliano_ImageCleaner
 * @copyright  Copyright (c) 2021 Fabrizio Balliano (http://fabrizioballiano.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Fballiano_ImageCleaner_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function scandirRecursive($dir)
    {
        $result = array();
        $root = scandir($dir);
        foreach ($root as $value) {
            if ($value === '.' or $value === '..' or $value === 'cache' or $value === 'watermark' or $value === 'optimized' or $value === '.thumbs') continue;
            if (is_file("$dir/$value")) {
                $result[] = "$dir/$value";
                continue;
            }

            foreach ($this->scandirRecursive("$dir/$value") as $value) {
                $result[] = $value;
            }
        }
        return $result;
    }

    public function getMediaDirByEntityTypeId($entity_type_id)
    {
        $media_dir = Mage::getBaseDir('media') . '/';

        if ($entity_type_id == 3) return "{$media_dir}catalog/category/";
        if ($entity_type_id == 4) return "{$media_dir}catalog/product/";
        if ($entity_type_id == 98) return "{$media_dir}wysiwyg/";

        return $media_dir;
    }

    public function getAllCSSFilesContents()
    {
        $files = $this->getAllCSSFiles(Mage::getBaseDir('skin') . '/frontend');
        foreach ($files as $k=>$css_file_path) {
            $files[$k] = file_get_contents($css_file_path);
        }

        return $files;
    }

    public function getAllCSSFiles($dir)
    {
        $result = array();
        $root = scandir($dir);
        foreach ($root as $value) {
            if ($value === '.' or $value === '..') continue;
            if (substr($value, -4) === '.css' and is_file("$dir/$value")) {
                $result[] = "$dir/$value";
                continue;
            }

            if (is_dir("$dir/$value")) {
                foreach ($this->getAllCSSFiles("$dir/$value") as $value) {
                    $result[] = $value;
                }
            }
        }
        return $result;
    }
}