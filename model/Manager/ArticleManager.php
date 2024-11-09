<?php

namespace model\Manager;

use model\Abstract\AbstractManager;

class ArticleManager extends AbstractManager
{
    /*
     * Needs functions for :-
     *      - Add new Item
     *      - Update Item
     *      - Delete Item
     */
    public function addNewArticle($mapping) {
        $name =$mapping->getProdName();
        $desc =$mapping->getProdDesc();
        $price =$mapping->getProdPrice();
        $img =$mapping->getProdImg();
        $amount =$mapping->getProdAmount();

        $stmt = $this->db->prepare("INSERT INTO ecom_products(
                                                        prod_name, 
                                                        prod_desc, 
                                                        prod_price, 
                                                        prod_img, 
                                                        prod_amount) 
                                          VALUES (?,?,?,?,?)");
        $stmt->execute([$name, $desc, $price, $img, $amount]);
        if ($stmt->rowCount() === 0) return false;
        return true;
    }
}