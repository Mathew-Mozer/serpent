<?php

/**
 * User: Christopher Barbour
 * Date: 10/16/16
 * Time: 9:01 PM
 */
require '../dependencies/php/HelperFunctions.php';
require_once (getServerPath().'dbcon.php');

class ToolBarModel
{
    private $dbcon;
    private $casino;
    private $parentCompanyId;
    private $assetBundleUrl;
    private $assetBundleWindows;
    private $assetName;
    private $defaultSkin;
    private $defaultLogo;
    private $supportGroup;
    private $businessOpen;
    private $businessClose;

    /**
     * ToolBarModel constructor.
     * @param $casino
     * @param $parentCompanyId
     * @param $assetBundleUrl
     * @param $assetBundleWindows
     * @param $assetName
     * @param $defaultSkin
     * @param $defaultLogo
     * @param $supportGroup
     * @param $businessOpen
     * @param $businessClose
     */
    public function __construct($casino, $parentCompanyId, $assetBundleUrl, $assetBundleWindows, $assetName,
                                $defaultSkin, $defaultLogo, $supportGroup, $businessOpen, $businessClose)
    {
        $this->dbcon = new DbCon();
        $this->casino = $casino;
        $this->parentCompanyId = $parentCompanyId;
        $this->assetBundleUrl = $assetBundleUrl;
        $this->assetBundleWindows = $assetBundleWindows;
        $this->assetName = $assetName;
        $this->defaultSkin = $defaultSkin;
        $this->defaultLogo = $defaultLogo;
        $this->supportGroup = $supportGroup;
        $this->businessOpen = $businessOpen;
        $this->businessClose = $businessClose;
    }

	/**
	* Insert new casino
	* @return QueryResult
	*/
    public function insertCasino(){
        $conn = $this->dbcon->insert_database();
        if(!$conn instanceof PDO){
            return 'Failed to connect to db';
        } else {
            $insert = "INSERT INTO casino(casinoName, parentCompany, assetBundleUrl, assetBundleWindows, assetName,
                        defaultSkin, defaultLogo, supportGroup, businessOpen, businessClose)
                        VALUES(:casinoName, :parentCompany, :assetBundleUrl, :assetBundleWindows, :assetName,
                        :defaultSkin, :defaultLogo, :supportGroup, :businessOpen, :businessClose)";

            $sqlInsert = $conn->prepare($insert);

            $sqlInsert->bindParam(':casinoName', $this->casino, PDO::PARAM_STR);
            $sqlInsert->bindParam(':parentCompany', $this->parentCompanyId, PDO::PARAM_INT);
            $sqlInsert->bindParam(':assetBundleUrl', $this->assetBundleUrl, PDO::PARAM_STR);
            $sqlInsert->bindParam(':assetBundleWindows', $this->assetBundleWindows, PDO::PARAM_STR);
            $sqlInsert->bindParam(':assetName', $this->assetName, PDO::PARAM_STR);
            $sqlInsert->bindParam(':defaultSkin', $this->defaultSkin, PDO::PARAM_INT);
            $sqlInsert->bindParam(':defaultLogo', $this->defaultLogo, PDO::PARAM_STR);
            $sqlInsert->bindParam(':supportGroup', $this->supportGroup, PDO::PARAM_STR);
            $sqlInsert->bindParam(':businessOpen', $this->businessOpen, PDO::PARAM_STR);
            $sqlInsert->bindParam(':businessClose', $this->businessClose, PDO::PARAM_STR);

            return $sqlInsert->execute();
        }
    }

}
