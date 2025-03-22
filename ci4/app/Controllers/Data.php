<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\EquipmentModel;
use App\Models\ItemModel;
use App\Models\LocationModel;
use App\Models\RequestModel;
use App\Models\SupplyModel;
use App\Models\TrackerModel;
use App\Models\UnitModel;
use App\Models\UserModel;

class Data extends BaseController
{
    private $validation;
    protected $encrypter;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->encrypter = service('encrypter');
    }

    public function addItem()
    {
        $name = $this->request->getVar('name');
        $unit = $this->request->getVar('unit');
        $quantity = $this->request->getVar('quantity');
        $unit_cost = $this->request->getVar('unit_cost');
        $accuisition_date = $this->request->getVar('accuisition_date');
        $item_no = $this->request->getVar('item_no');
        $pr_no = $this->request->getVar('pr_no');
        $iar_no = $this->request->getVar('iar_no');
        $employee = $this->request->getVar('employee');
        $description = $this->request->getVar('description');
        $type = $this->request->getVar('type');

        $employeeModel = new EmployeeModel();

        $employees = $employeeModel->findAll();

        $data['employees'] = array_column($employees, 'id');

        $this->validation->setRules([
            'name' => [
                'rules' => 'required',
                'label' => 'item name'
            ],
            'unit' => 'required',
            'quantity' => 'required|integer',
            'unit_cost' => [
                'rules' => 'required|numeric',
                'label' => 'unit cost'
            ],
            'accuisition_date' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'label' => 'accuisition date'
            ],
            'item_no' => [
                'rules' => 'required',
                'label' => 'property no'
            ],
            'pr_no' => [
                'rules' => 'required',
                'label' => 'pr no'
            ],
            'iar_no' => [
                'rules' => 'required',
                'label' => 'iar no'
            ],
            'employee' => [
                'rules' => 'required|in_list[' . implode(',', $data['employees']) . ']',
                'label' => 'requested by',
                'errors' => [
                    'in_list' => 'The requested by field must be one of the employees.'
                ]
            ],
            'description' => 'required',
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $equipmentModel = new EquipmentModel();
            $supplyModel = new SupplyModel();

            if ($type == 'equipments') {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'employee_id' => $employee,
                    'property_no' => $item_no,
                    'pr_no' => $pr_no,
                    'iar_no' => $iar_no,
                    'unit' => $unit,
                    'quantity' => $quantity,
                    'unit_cost' => $unit_cost,
                    'accuisition_date' => $accuisition_date,
                ];

                session()->setFlashdata('success', 'Item successfully added!');

                $equipmentModel->insert($data);
            } else {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'employee_id' => $employee,
                    'stock_no' => $item_no,
                    'pr_no' => $pr_no,
                    'iar_no' => $iar_no,
                    'unit' => $unit,
                    'quantity' => $quantity,
                    'unit_cost' => $unit_cost,
                    'accuisition_date' => $accuisition_date,
                ];

                session()->setFlashdata('success', 'Item successfully added!');

                $supplyModel->insert($data);
            }

            return redirect()->to(base_url('items/' . $type));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('add-item/' . $type));
        }
    }

    public function editItem()
    {
        $name = $this->request->getVar('name');
        $unit = $this->request->getVar('unit');
        $quantity = $this->request->getVar('quantity');
        $unit_cost = $this->request->getVar('unit_cost');
        $accuisition_date = $this->request->getVar('accuisition_date');
        $item_no = $this->request->getVar('item_no');
        $pr_no = $this->request->getVar('pr_no');
        $iar_no = $this->request->getVar('iar_no');
        $employee = $this->request->getVar('employee');
        $location = $this->request->getVar('location');
        $description = $this->request->getVar('description');
        $type = $this->request->getVar('type');
        $id = $this->request->getVar('id');

        $employeeModel = new EmployeeModel();
        $locationModel = new LocationModel();

        $employees = $employeeModel->findAll();
        $locations = $locationModel->findAll();

        $data['employees'] = array_column($employees, 'id');
        $data['locations'] = array_column($locations, 'id');

        $this->validation->setRules([
            'name' => [
                'rules' => 'required',
                'label' => 'item name'
            ],
            'unit' => 'required',
            'quantity' => 'required|integer',
            'unit_cost' => [
                'rules' => 'required|numeric',
                'label' => 'unit cost'
            ],
            'accuisition_date' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'label' => 'accuisition date'
            ],
            'item_no' => [
                'rules' => 'required',
                'label' => 'property no'
            ],
            'pr_no' => [
                'rules' => 'required',
                'label' => 'pr no'
            ],
            'iar_no' => [
                'rules' => 'required',
                'label' => 'iar no'
            ],
            'employee' => [
                'rules' => 'required|in_list[' . implode(',', $data['employees']) . ']',
                'label' => 'requested by',
                'errors' => [
                    'in_list' => 'The requested by field must be one of the employees.'
                ]
            ],
            'location' => [
                'rules' => 'permit_empty|in_list[' . implode(',', $data['locations']) . ']',
                'label' => 'room/ location',
                'errors' => [
                    'in_list' => 'The room/ location field must be one of the room or locations.'
                ]
            ],
            'description' => 'required',
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            if ($type == 'equipments') {
                $equipmentModel = new EquipmentModel();
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'employee_id' => $employee,
                    'location_id' => $location,
                    'property_no' => $item_no,
                    'pr_no' => $pr_no,
                    'iar_no' => $iar_no,
                    'unit' => $unit,
                    'quantity' => $quantity,
                    'unit_cost' => $unit_cost,
                    'accuisition_date' => $accuisition_date,
                ];

                session()->setFlashdata('success-edit', 'Equipment successfully updated!');

                $equipmentModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);
            } else {
                $supplyModel = new SupplyModel();
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'employee_id' => $employee,
                    'location_id' => $location,
                    'stock_no' => $item_no,
                    'pr_no' => $pr_no,
                    'iar_no' => $iar_no,
                    'unit' => $unit,
                    'quantity' => $quantity,
                    'unit_cost' => $unit_cost,
                    'accuisition_date' => $accuisition_date,
                ];

                session()->setFlashdata('success-edit', 'Supply successfully updated!');

                $supplyModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);
            }

            return redirect()->to(base_url('items/' . $type));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-item/' . $id));
        }
    }

    public function deleteItem()
    {
        $id = $this->request->getVar('id');
        $type = $this->request->getVar('type');

        if ($type == 'equipments') {
            $equipmentModel = new EquipmentModel();

            $equipmentModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

            session()->setFlashdata('success-delete', 'Equipment successfully deleted!');
        } else {
            $supplyModel = new SupplyModel();

            $supplyModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

            session()->setFlashdata('success-delete', 'Supply successfully deleted!');
        }

        return redirect()->to(base_url('items/' . $type));
    }

    public function addDepartment()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');

        $this->validation->setRules([
            'name' => 'required|is_unique[departments.name]',
            'description' => 'required',
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $departmentModel = new DepartmentModel();
            $data = [
                'name' => $name,
                'description' => $description
            ];

            session()->setFlashdata('success', 'Department successfully added!');

            $departmentModel->insert($data);

            return redirect()->to(base_url('departments'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('add-department'));
        }
    }

    public function editDepartment()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $id = $this->request->getVar('id');

        $departmentModel = new DepartmentModel();

        $existingDepartment = $departmentModel->find($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        if ($existingDepartment['name'] == $name) {
            $this->validation->setRules([
                'description' => 'required',
            ]);
        } else {
            $this->validation->setRules([
                'name' => 'required|is_unique[departments.name]',
                'description' => 'required',
            ]);
        }

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'name' => $name,
                'description' => $description
            ];

            session()->setFlashdata('success-edit', 'Department successfully updated!');

            $departmentModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);

            return redirect()->to(base_url('departments'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-department/' . $id));
        }
    }

    public function deleteDepartment()
    {
        $id = $this->request->getVar('id');

        $departmentModel = new DepartmentModel();

        $departmentModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        session()->setFlashdata('success-delete', 'Department successfully deleted!');

        return redirect()->to(base_url('departments'));
    }

    public function addEmployee()
    {
        $name = $this->request->getVar('name');
        $department = $this->request->getVar('department');
        $designation = $this->request->getVar('designation');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->findAll();

        $data['options'] = array_column($departments, 'id');

        $this->validation->setRules([
            'name' => 'required|is_unique[employees.name]',
            'department' => [
                'rules' => 'required|in_list[' . implode(',', $data['options']) . ']',
                'errors' => [
                    'in_list' => 'The department field must be one of the department options.'
                ]
            ],
            'designation' => 'required',
            'username' => 'required|is_unique[employees.username]',
            'password' => 'required|min_length[8]',
            'confirm_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'The password did not match.'
                ]
            ]
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $employeeModel = new EmployeeModel();

            $data = [
                'name' => $name,
                'department_id' => $department,
                'designation' => $designation,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 15])
            ];

            session()->setFlashdata('success', 'Employee successfully added!');

            $employeeModel->insert($data);

            return redirect()->to(base_url('employees'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('add-employee'));
        }
    }

    public function editEmployee()
    {
        $name = $this->request->getVar('name');
        $designation = $this->request->getVar('designation');
        $department = $this->request->getVar('department');
        $id = $this->request->getVar('id');

        $departmentModel = new DepartmentModel();
        $employeeModel = new EmployeeModel();

        $departments = $departmentModel->findAll();
        $employee = $employeeModel->find($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        $data['options'] = array_column($departments, 'id');

        if ($employee['name'] == $name) {
            $this->validation->setRules([
                'name' => 'required',
                'designation' => 'required',
                'department' => [
                    'rules' => 'required|in_list[' . implode(',', $data['options']) . ']',
                    'errors' => [
                        'in_list' => 'The department field must be one of the department options.'
                    ]
                ]
            ]);
        } else {
            $this->validation->setRules([
                'name' => 'required|is_unique[employees.name]',
                'designation' => 'required',
                'department' => [
                    'rules' => 'required|in_list[' . implode(',', $data['options']) . ']',
                    'errors' => [
                        'in_list' => 'The department field must be one of the department options.'
                    ]
                ]
            ]);
        }

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'name' => $name,
                'designation' => $designation,
                'department_id' => $department
            ];

            session()->setFlashdata('success-edit', 'Employee successfully updated!');

            $employeeModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);

            return redirect()->to(base_url('employees'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-employee/' . $id));
        }
    }

    public function editEmployeePassword()
    {
        $password = $this->request->getVar('password');
        $confirm_password = $this->request->getVar('confirm_password');
        $id = $this->request->getVar('id');

        $employeeModel = new EmployeeModel();

        $employee = $employeeModel->find($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        $this->validation->setRules([
            'password' => 'required|min_length[8]',
            'confirm_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'The password did not match.'
                ]
            ]
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
            ];

            session()->setFlashdata('success-edit', 'Employee\'s password successfully updated!');

            $employeeModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);

            return redirect()->to(base_url('employees'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-employee/' . $id));
        }
    }

    public function deleteEmployee()
    {
        $id = $this->request->getVar('id');

        $employeeModel = new EmployeeModel();

        $employeeModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        session()->setFlashdata('success-delete', 'Employee successfully deleted!');

        return redirect()->to(base_url('employees'));
    }

    public function addLocation()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');

        $this->validation->setRules([
            'name' => 'required|is_unique[locations.name]',
            'description' => 'required',
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $locationModel = new LocationModel();
            $data = [
                'name' => $name,
                'description' => $description
            ];

            session()->setFlashdata('success', 'Room/ location successfully added!');

            $locationModel->insert($data);

            return redirect()->to(base_url('locations'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('add-location'));
        }
    }

    public function editLocation()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $id = $this->request->getVar('id');

        $locationModel = new LocationModel();

        $existingLocation = $locationModel->find($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        if ($existingLocation['name'] == $name) {
            $this->validation->setRules([
                'name' => 'required',
                'description' => 'required',
            ]);
        } else {
            $this->validation->setRules([
                'name' => 'required|is_unique[locations.name]',
                'description' => 'required',
            ]);
        }

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'name' => $name,
                'description' => $description
            ];

            session()->setFlashdata('success-edit', 'Location successfully updated!');

            $locationModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);

            return redirect()->to(base_url('locations'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-location/' . $id));
        }
    }

    public function deleteLocation()
    {
        $id = $this->request->getVar('id');

        $locationModel = new LocationModel();

        $locationModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        session()->setFlashdata('success-delete', 'Location successfully deleted!');

        return redirect()->to(base_url('locations'));
    }

    public function addUnit()
    {
        $name = $this->request->getVar('name');

        $this->validation->setRules([
            'name' => 'required|is_unique[units.name]',
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $unitModel = new UnitModel();
            $data = [
                'name' => $name,
            ];

            session()->setFlashdata('success', 'Unit successfully added!');

            $unitModel->insert($data);

            return redirect()->to(base_url('units'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('add-unit'));
        }
    }

    public function editUnit()
    {
        $name = $this->request->getVar('name');
        $id = $this->request->getVar('id');

        $unitModel = new UnitModel();

        $existingunit = $unitModel->find($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        if ($existingunit['name'] == $name) {
            $this->validation->setRules([
                'name' => 'required',
            ]);
        } else {
            $this->validation->setRules([
                'name' => 'required|is_unique[units.name]',
            ]);
        }

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'name' => $name,
            ];

            session()->setFlashdata('success-edit', 'Unit successfully updated!');

            $unitModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);

            return redirect()->to(base_url('units'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-unit/' . $id));
        }
    }

    public function deleteUnit()
    {
        $id = $this->request->getVar('id');

        $unitModel = new UnitModel();

        $unitModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        session()->setFlashdata('success-delete', 'Unit successfully deleted!');

        return redirect()->to(base_url('units'));
    }

    public function addPropertyCardEntry()
    {
        $id = $this->request->getVar('id');
        $department = $this->request->getVar('department');
        $location = $this->request->getVar('location');
        $employee = $this->request->getVar('employee');
        $date = $this->request->getVar('date');
        $referenceNo = $this->request->getVar('referenceNo');
        $issueQty = $this->request->getVar('issueQty');
        $thru = $this->request->getVar('thru');
        $remarks = $this->request->getVar('remarks');

        $employeeModel = new EmployeeModel();
        $locationModel = new LocationModel();
        $departmentModel = new DepartmentModel();
        $trackerModel = new TrackerModel();
        $equipmentModel = new EquipmentModel();

        $employees = $employeeModel->findAll();
        $locations = $locationModel->findAll();
        $departments = $departmentModel->findAll();
        $tracker = $trackerModel->select('balanceQty')->where('item_id', $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))))->orderBy('tracker.date', 'desc')->first();
        $item = $equipmentModel->select('quantity')->where('id', $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))))->first();

        if ($tracker) {
            $balanceQty = (int)$tracker['balanceQty'] - (int)$issueQty;
        } else {
            $balanceQty = (int)$item['quantity'] - (int)$issueQty;
        }

        $data['employees'] = array_column($employees, 'id');
        $data['locations'] = array_column($locations, 'id');
        $data['departments'] = array_column($departments, 'id');

        $this->validation->setRules([
            'department' => 'required|in_list[' . implode(',', $data['departments']) . ']',
            'location' => 'required|in_list[' . implode(',', $data['locations']) . ']',
            'employee' => 'required|in_list[' . implode(',', $data['employees']) . ']',
            'date' => 'required|valid_date[Y-m-d]',
            'referenceNo' => [
                'rules' => 'required',
                'label' => 'reference'
            ],
            'issueQty' => [
                'rules' => 'required|integer',
                'label' => 'issue qty'
            ],
            'remarks' => 'required'
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'item_id' => $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))),
                'department_id' => $department,
                'location_id' => $location,
                'employee_id' => $employee,
                'date' => $date,
                'referenceNo' => $referenceNo,
                'issueQty' => $issueQty,
                'balanceQty' => $balanceQty,
                'thru' => $thru,
                'remarks' => $remarks,
            ];

            session()->setFlashdata('success', 'Property card entry successfully added!');

            $trackerModel->insert($data);

            return redirect()->to(base_url('property-card/' . $id));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('add-property-card-entry/' . $id));
        }
    }

    public function editPropertyCardEntry()
    {
        $name = $this->request->getVar('name');
        $id = $this->request->getVar('id');

        $unitModel = new UnitModel();

        $existingunit = $unitModel->find($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        if ($existingunit['name'] == $name) {
            $this->validation->setRules([
                'name' => 'required',
            ]);
        } else {
            $this->validation->setRules([
                'name' => 'required|is_unique[units.name]',
            ]);
        }

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'name' => $name,
            ];

            session()->setFlashdata('success-edit', 'Unit successfully updated!');

            $unitModel->update($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))), $data);

            return redirect()->to(base_url('units'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('edit-unit/' . $id));
        }
    }

    public function deletePropertyCardEntry()
    {
        $id = $this->request->getVar('id');

        $unitModel = new UnitModel();

        $unitModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        session()->setFlashdata('success-delete', 'Unit successfully deleted!');

        return redirect()->to(base_url('units'));
    }

    public function editProfile()
    {
        $name = $this->request->getVar('name');
        $department = $this->request->getVar('department');
        $username = $this->request->getVar('username');

        $employeeModel = new EmployeeModel();

        if ($username == session()->get('username')) {
            $this->validation->setRules([
                'name' => 'required',
                'department' => 'required',
                'username' => 'required',
            ]);
        } else {
            $this->validation->setRules([
                'name' => 'required',
                'department' => 'required',
                'username' => 'required|is_unique[employees.username]',
            ]);
        }

        if ($this->validation->withRequest($this->request)->run()) {
            $employeeModel = new EmployeeModel();

            $data = [
                'name' => $name,
                'department_id' => $department,
                'username' => $username,
            ];

            session()->setFlashdata('success', 'Employee successfully updated!');

            $employeeModel->set($data)->where('username', session()->get('username'))->update();

            session()->set($data);

            return redirect()->to(base_url('profile'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('profile'));
        }
    }

    public function requestSupply()
    {
        $office = $this->request->getVar('office');
        $item = $this->request->getVar('item');
        $requestQty = $this->request->getVar('requestQty');
        $purpose = $this->request->getVar('purpose');
        $newItem = explode('-', $item);
        $type = $newItem[0];
        $item_id = $newItem[1];

        $this->validation->setRules([
            'office' => 'required',
            'item' => 'required',
            'requestQty' => [
                'label' => 'quantity',
                'rules' => 'required|numeric|check_supply_qty[item,requestQty]',
                'errors' => [
                    'check_supply_qty' => 'Your request exceeds the number on stock.'
                ]
            ],
            'purpose' => 'required'
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $requestModel = new RequestModel();

            $data = [
                'office' => $office,
                'item_id' => $item_id,
                'request_qty' => $requestQty,
                'purpose' => $purpose,
                'type' => $type,
                'requested_by' => session()->get('id'),
                'status' => 'pending'
            ];

            session()->setFlashdata('success', 'Request successfully added!');


            $requestModel->insert($data);

            return redirect()->to(base_url('request-supplies/' . $type));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('request-supply'));
        }
    }

    public function editRequestSupply()
    {
        $office = $this->request->getVar('office');
        $item = $this->request->getVar('item');
        $requestQty = $this->request->getVar('requestQty');
        $purpose = $this->request->getVar('purpose');
        $id = $this->request->getVar('id');
        $newItem = explode('-', $item);
        $type = $newItem[0];
        $item_id = $newItem[1];

        $this->validation->setRules([
            'office' => 'required',
            'item' => 'required',
            'requestQty' => [
                'label' => 'quantity',
                'rules' => 'required|numeric|check_supply_qty[item,requestQty]',
                'errors' => [
                    'check_supply_qty' => 'Your request exceeds the number on stock.'
                ]
            ],
            'purpose' => 'required'
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $requestModel = new RequestModel();

            $data = [
                'office' => $office,
                'item_id' => $item_id,
                'request_qty' => $requestQty,
                'purpose' => $purpose,
                'type' => $type,
                'requested_by' => session()->get('id'),
                'status' => 'pending'
            ];

            session()->setFlashdata('success', 'Request successfully updated!');


            $requestModel->set($data)->where('id', $id)->update();

            return redirect()->to(base_url('request-supplies/' . $type));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('request-supply'));
        }
    }

    public function deleteRequestSupply()
    {
        $id = $this->request->getVar('id');
        $type = $this->request->getVar('type');

        $requestModel = new RequestModel();

        $requestModel->delete($this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id))));

        session()->setFlashdata('success-delete', 'Request successfully deleted!');

        return redirect()->to(base_url('request-supplies/' . $type));
    }

    public function addRequestEntry()
    {
        $status = 'pending';
        $id = $this->request->getVar('id');
        $type = $this->request->getVar('type');
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $employeeModel = new EmployeeModel();
        $requestModel = new RequestModel();
        $supplyModel = new SupplyModel();

        $approve = $employeeModel->select('designation')->where('name', $this->request->getVar('approved_by'))->first();
        if (!$approve)
            $approve['designation'] = '';
        $issue = $employeeModel->select('designation')->where('name', $this->request->getVar('issued_by'))->first();
        if (!$issue)
            $issue['designation'] = '';
        $receive = $employeeModel->select('designation')->where('name', $this->request->getVar('received_by'))->first();
        if (!$receive)
            $receive['designation'] = '';

        $request = $requestModel->where('id', $decryptedId)->first();


        session()->setFlashdata('success', 'Request form successfully updated!');

        if ($this->request->getVar('received_by') != '' && $this->request->getVar('issue_qty') > 0 && $request['type'] == 'supplies') {
            $item = $supplyModel->select('quantity')->where('id', $this->request->getVar('item_id'))->first();

            $newQty = $item['quantity'] - $this->request->getVar('issue_qty');
            $supplyModel->set(['quantity' => $newQty])->where('id', $this->request->getVar('item_id'))->update();
        }

        if ($this->request->getVar('available') == 'Yes')
            $status = 'done';
        else
            $status = 'no stocks';

        $data = [
            'division' => $this->request->getVar('division'),
            'code' => $this->request->getVar('code'),
            'risNo' => $this->request->getVar('risNo'),
            'available' => $this->request->getVar('available'),
            'issue_qty' => $this->request->getVar('issue_qty'),
            'remarks' => $this->request->getVar('remarks'),
            'approved_by' => $this->request->getVar('approved_by'),
            'approved_designation' => $approve['designation'],
            'approved_date' => $this->request->getVar('approved_date'),
            'issued_by' => $this->request->getVar('issued_by'),
            'issued_designation' => $issue['designation'],
            'issued_date' => $this->request->getVar('issued_date'),
            'received_by' => $this->request->getVar('received_by'),
            'received_designation' => $receive['designation'],
            'received_date' => $this->request->getVar('received_date'),
            'status' => $status
        ];

        $requestModel->set($data)->where('id', $decryptedId)->update();

        return redirect()->to(base_url('/requested-item/' . $type . '/' . $id));
    }

    public function changePassword()
    {
        $current_password = $this->request->getVar('current_password');
        $new_password = $this->request->getVar('new_password');
        $confirm_password = $this->request->getVar('confirm_password');

        $employeeModel = new EmployeeModel();

        $this->validation->setRules([
            'current_password' => [
                'rules' => 'required|check_old_password',
                'label' => 'old password',
                'errors' => [
                    'check_old_password' => 'The old password is incorrect.'
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[8]',
                'label' => 'new password'
            ],
            'confirm_password' => [
                'rules' => 'required|matches[new_password]',
                'label' => 'confirm password',
                'errors' => [
                    'matches' => 'The password did not match.'
                ]
            ]
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $employeeModel = new EmployeeModel();

            $data = [
                'password' => password_hash($new_password, PASSWORD_BCRYPT),
            ];

            session()->setFlashdata('success', 'Password successfully updated!');


            $employeeModel->set($data)->where('id', session()->get('id'))->update();

            return redirect()->to(base_url('profile'));
        } else {
            session()->setFlashdata([
                'errors' => $this->validation->getErrors(),
                'input' => $this->request->getPost()
            ]);

            return redirect()->to(base_url('profile'));
        }
    }
}
