<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\OrderMapping;

class OrderManager extends AbstractManager
{

    public function getOrderByUserId($user_id)
    {
        $this->db->exec("SET SESSION group_concat_max_len = 100000");

        $stmt = $this->db->prepare("
        SELECT 
            u.user_id,
            GROUP_CONCAT(o.order_content SEPARATOR '|||') AS all_order_contents
        FROM 
            `ecom_users` u
        LEFT JOIN 
            `ecom_users_has_ecom_orders` uho ON uho.`ecom_user_id` = u.`user_id`
        LEFT JOIN 
            `ecom_orders` o ON uho.`ecom_order_id` = o.`order_id`
        WHERE 
            u.user_id = ?
        GROUP BY 
            u.user_id
    ");

        $stmt->execute([$user_id]);
        if ($stmt->rowCount() === 0) return null;
        $datas = $stmt->fetchAll();

                $orderDatas = [];

        foreach ($datas as $data) {
            if ($data['all_order_contents'] !== null) {
                $orderContents = explode('|||', $data['all_order_contents']);

                for ($i = 0; $i < count($orderContents); $i++) {
                    $order = new OrderMapping([
                        'order_content' => $orderContents[$i]
                    ]);
                    $orderDatas[] = $order;
                }


            }
        }
                return $orderDatas;
    }
}