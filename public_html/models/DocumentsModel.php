<?php
if (!isset($_SESSION)) {
    session_start();
}
// PromotionModal class
//
// author: Alex Onorati
// This class contains all the legal queries on the database property_serpent.
class DocumentsModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //This retrives all promotions that are stored.
    public function getAllDocuments()
    {
        $sql = "select
                      *
                  from 
                      documents,promotion_type 
                  where 
                      promotion_type.promotion_type_id = documents.documents_promo_type
                  order by
                      promotion_type_title asc";
        $result = $this->db->prepare($sql);
        $result->execute();
        $Result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $Result;
    }

}

?>