<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\ArticleMapping;

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

    public function getArticles(): array
    {
        $query = $this->db->query("SELECT * FROM ecom_products");
        $datas = $query->fetchAll();
        $query->closeCursor();
        $dataObject = [];
        foreach ($datas as $data) {
            $dataObject[] = new ArticleMapping($data);
        }
        return $dataObject;
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

    public function getOneArticleById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM ecom_products WHERE prod_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function editArticle($mapping) {
        $id =$mapping->getProdId();
        $name =$mapping->getProdName();
        $desc =$mapping->getProdDesc();
        $price =$mapping->getProdPrice();
        $img =$mapping->getProdImg();
        $amount =$mapping->getProdAmount();

        $stmt = $this->db->prepare("UPDATE ecom_products 
                                          SET `prod_name`= :name,
                                              `prod_desc`= :descrpt, 
                                              `prod_price` = :price, 
                                              `prod_img`= :img, 
                                              `prod_amount`= :amount 
                                          WHERE prod_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":descrpt", $desc);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":img", $img);
        $stmt->bindParam(":amount", $amount);

        $stmt->execute();
        if ($stmt->rowCount() === 0) return false;
        return true;
    }
}