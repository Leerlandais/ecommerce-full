<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\CategoryMapping;

class CategoryManager extends AbstractManager
{
    /*
     * Need functions for the following :-
     *      - Add Category
     *      - Update Category
     *      - Delete Category
     *      - Fetch Articles By Category (maybe extraneous as this will be handled by JS)
     */

    public function getCategories() {
        $query = $this->db->query("SELECT * FROM ecom_categories");
        $datas = $query->fetchAll();
        $query->closeCursor();
        $dataObject = [];
        foreach ($datas as $data) {
            $dataObject[] = new CategoryMapping($data);
        }
        var_dump($dataObject);
        return $dataObject;
    }


} // end class