<?php

namespace App\Validations;

use App\Models\EmployeeModel;
use App\Models\EquipmentModel;
use App\Models\SupplyModel;

class CustomRules
{
    function check_supply_qty(string $str, string $fields, array $data)
    {
        $equipmentModel = new EquipmentModel();
        $supplyModel = new SupplyModel();

        $newItem = explode('-', $data['item']);

        if ($newItem[0] == 'equipments') {
            $item = $equipmentModel->where('id', $newItem[1])->first();
        } else {
            $item = $supplyModel->where('id', $newItem[1])->first();
        }

        if ($data['requestQty'] <= $item['quantity'] || $newItem[0] != 'supplies')
            return true;

        return false;
    }

    function check_old_password(string $str)
    {
        $employeeModel = new EmployeeModel();

        $user = $employeeModel->where('id', session()->get('id'))->first();

        return (password_verify($str, $user['password']));
    }
}
