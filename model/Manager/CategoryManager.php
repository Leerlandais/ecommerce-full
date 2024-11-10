<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\CategoryMapping;

class CategoryManager extends AbstractManager
{

    public function getCategories() {
        $query = $this->db->query("SELECT * FROM ecom_categories");
        $datas = $query->fetchAll();
        $query->closeCursor();
        $dataObject = [];
        foreach ($datas as $data) {
            $dataObject[] = new CategoryMapping($data);
        }
        return $dataObject;
    }

    public function getOneCategoryById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM ecom_categories WHERE cats_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();

    }
    public function addNewCategory($mapping) {
        $name =$mapping->getCatsName();
        $desc =$mapping->getCatsDesc();
        $img = $mapping->getCatsImg();

        $stmt = $this->db->prepare("INSERT INTO ecom_categories(
                                                        cats_name, 
                                                        cats_desc,
                                                        cats_img) 
                                          VALUES (?,?,?)");
        $stmt->execute([$name, $desc, $img]);
        if ($stmt->rowCount() === 0) return false;
        return true;
    }

    public function editCategory($mapping) {
        $id =$mapping->getCatsId();
        $name =$mapping->getCatsName();
        $desc =$mapping->getCatsDesc();
        $img = $mapping->getCatsImg();

        $stmt = $this->db->prepare("UPDATE ecom_categories 
                                          SET `cats_name`= :name,
                                              `cats_desc`= :descrpt,
                                              `cats_img`= :img
                                          WHERE cats_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":descrpt", $desc);
        $stmt->bindParam(":img", $img);
        $stmt->execute();
        if ($stmt->rowCount() === 0) return false;
        return true;
    }

} // end class