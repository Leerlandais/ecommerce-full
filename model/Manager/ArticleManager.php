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
    public function addNewArticle($mapping): bool
    {
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

    public function getLastArticleId() {
        $stmt = $this->db->prepare("SELECT * FROM ecom_products ORDER BY prod_id DESC LIMIT 1");
        $stmt->execute();
        if ($stmt->rowCount() === 0) return false;
        $data = $stmt->fetch();
        return $data['prod_id'];
    }

    public function addArticleCategory(int $artId, int $catId) : bool {
        $stmt = $this->db->prepare("INSERT INTO ecom_products_has_ecom_categories(
                                                        ecom_prod_id,
                                                        ecom_cats_id)
                                                 VALUES (?,?)");
        $stmt->execute([$artId, $catId]);
        if ($stmt->rowCount() === 0) return false;
        return true;
    }

}