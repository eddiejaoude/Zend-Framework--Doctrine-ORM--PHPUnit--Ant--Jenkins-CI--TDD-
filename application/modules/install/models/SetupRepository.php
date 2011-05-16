<?php
/**
 * Setup Repository
 * 
 * @author Koen Huybrechts
 */

use Doctrine\ORM\EntityRepository;
class Install_Model_SetupRepository extends EntityRepository
{
	/**
	 * Return file extension
	 */
	public function getFileExtension($fileName)
	{
	   $parts=explode(".",$fileName);
	   return $parts[count($parts)-1];
	}
}