<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\EquipmentModel;
use App\Models\LocationModel;
use App\Models\RequestItemModel;
use App\Models\RequestModel;
use App\Models\SupplyModel;
use App\Models\TrackerModel;
use App\Models\UnitModel;
use CodeIgniter\HTTP\Request;

class Pages extends BaseController
{
    protected $encrypter;

    public function __construct()
    {
        $this->encrypter = service('encrypter');
    }

    public function index()
    {
        echo view('index');
    }

    public function dashboard()
    {
        $employeeModel = new EmployeeModel();
        $equipmentModel = new EquipmentModel();
        $departmentModel = new DepartmentModel();
        $requestModel = new RequestModel();

        $employees = $employeeModel->findAll();
        $items = $equipmentModel->selectSum('quantity')->first();
        $departments = $departmentModel->findAll();
        $requests = $requestModel->findAll();
        $equipments = $equipmentModel->orderBy('accuisition_date', 'desc')->findAll();

        $requestsChart = $requestModel->select('DATE(created_at) as date, COUNT(*) as total')->groupBy('DATE(created_at)')->orderBy('date', 'ASC')->findAll();

        $data = [
            'title' => 'Dashboard',
            'employees' => $employees,
            'items' => $items,
            'departments' => $departments,
            'requests' => $requests,
            'requestsChart' => $requestsChart,
            'equipments' => $equipments,
        ];

        echo view('templates/header', $data);
        echo view('dashboard');
        echo view('templates/footer');
    }

    public function items($type)
    {
        $equipmentModel = new EquipmentModel();
        $supplyModel = new SupplyModel();

        if ($type == 'equipments')
            $items = $equipmentModel->select('equipments.id, equipments.name, equipments.property_no, units.name as unit, equipments.description, equipments.quantity, equipments.unit_cost, equipments.pr_no, equipments.iar_no, equipments.accuisition_date, employees.name as employeeName')->join('employees', 'employees.id = equipments.employee_id')->join('units', 'units.id = equipments.unit')->findAll();
        else
            $items = $supplyModel->select('supplies.id, supplies.name, supplies.stock_no, units.name as unit, supplies.description, supplies.quantity, supplies.unit_cost, supplies.pr_no, supplies.iar_no, supplies.accuisition_date, employees.name as employeeName')->join('employees', 'employees.id = supplies.employee_id')->join('units', 'units.id = supplies.unit')->findAll();

        $data = [
            'title' => ucfirst($type),
            'items' => $items,
            'type' => $type,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('items');
        echo view('templates/footer');
    }

    public function addItem($type)
    {
        $employeeModel = new EmployeeModel();
        $locationModel = new LocationModel();
        $unitModel = new UnitModel();

        $employees = $employeeModel->orderBy('name')->findAll();
        $locations = $locationModel->orderBy('name')->findAll();
        $units = $unitModel->orderBy('name')->findAll();

        $data = [
            'title' => ucfirst($type),
            'type' => $type,
            'employees' => $employees,
            'locations' => $locations,
            'units' => $units
        ];

        echo view('templates/header', $data);
        echo view('add_item');
        echo view('templates/footer');
    }

    public function editItem($type, $id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));
        $employeeModel = new EmployeeModel();
        $locationModel = new LocationModel();
        $unitModel = new UnitModel();

        $employees = $employeeModel->orderBy('name')->findAll();
        $locations = $locationModel->orderBy('name')->findAll();
        $units = $unitModel->orderBy('name')->findAll();

        if ($type == 'equipments') {
            $equipmentModel = new EquipmentModel();
            $item = $equipmentModel->select('equipments.id, equipments.name, equipments.property_no, equipments.unit, equipments.description, equipments.quantity, equipments.unit_cost, equipments.pr_no, equipments.iar_no, equipments.accuisition_date, equipments.employee_id')->join('employees', 'employees.id = equipments.employee_id')->where('equipments.id', $decryptedId)->first();
        } else {
            $supplyModel = new SupplyModel();
            $item = $supplyModel->select('supplies.id, supplies.name, supplies.stock_no, supplies.unit, supplies.description, supplies.quantity, supplies.unit_cost, supplies.pr_no, supplies.iar_no, supplies.accuisition_date, supplies.employee_id')->join('employees', 'employees.id = supplies.employee_id')->where('supplies.id', $decryptedId)->first();
        }

        $data = [
            'title' => ucfirst($type),
            'employees' => $employees,
            'locations' => $locations,
            'item' => $item,
            'units' => $units,
            'id' => $id,
            'type' => $type,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('edit_item');
        echo view('templates/footer');
    }

    public function propertyCard($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $equipmentModel = new EquipmentModel();
        $trackerModel = new TrackerModel();

        $item = $equipmentModel->select('equipments.id, equipments.name, equipments.property_no, equipments.unit, equipments.description, equipments.quantity, equipments.unit_cost, equipments.pr_no, equipments.iar_no, equipments.accuisition_date, equipments.employee_id')->join('employees', 'employees.id = equipments.employee_id')->where('equipments.id', $decryptedId)->first();
        $tracker = $trackerModel->select('tracker.date, tracker.referenceNo, tracker.issueQty, departments.name as departmentName, employees.name as employeeName, tracker.thru, tracker.balanceQty, tracker.remarks')->join('departments', 'departments.id = tracker.department_id')->join('employees', 'employees.id = tracker.employee_id')->join('locations', 'locations.id = tracker.location_id')->where('tracker.item_id', $decryptedId)->orderBy('tracker.date', 'asc')->findAll();

        $data = [
            'title' => 'Property Card',
            'item' => $item,
            'tracker' => $tracker,
            'id' => $id,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('property_card');
        echo view('templates/footer');
    }

    public function addPropertyCardEntry($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $equipmentModel = new EquipmentModel();
        $departmentModel = new DepartmentModel();
        $employeeModel = new EmployeeModel();
        $locationModel = new LocationModel();

        $item = $equipmentModel->select('equipments.id, equipments.name, equipments.property_no, equipments.unit, equipments.description, equipments.quantity, equipments.unit_cost, equipments.pr_no, equipments.iar_no, equipments.accuisition_date, equipments.employee_id')->join('employees', 'employees.id = equipments.employee_id')->where('equipments.id', $decryptedId)->first();
        $departments = $departmentModel->orderBy('name')->findAll();
        $employees = $employeeModel->select('employees.id, employees.name')->orderBy('name')->findAll();
        $locations = $locationModel->select('id, name')->findAll();

        $data = [
            'title' => 'Add Property Card Entry',
            'item' => $item,
            'departments' => $departments,
            'employees' => $employees,
            'locations' => $locations,
            'id' => $id,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('add_property_card_entry');
        echo view('templates/footer');
    }

    public function departments()
    {
        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->findAll();

        $data = [
            'title' => 'Departments',
            'departments' => $departments,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('departments');
        echo view('templates/footer');
    }

    public function department($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $trackerModel = new TrackerModel();
        $departmentModel = new DepartmentModel();

        $items = $trackerModel->select('equipments.name, equipments.property_no, equipments.unit, equipments.description, equipments.quantity, tracker.issueQty, equipments.unit_cost, equipments.pr_no, equipments.iar_no, tracker.date, units.name as unitName')->join('equipments', 'equipments.id = tracker.item_id')->join('units', 'units.id = equipments.unit')->where('tracker.department_id', $decryptedId)->findAll();
        $department = $departmentModel->where('id', $decryptedId)->first();

        $data = [
            'title' => $department['description'],
            'items' => $items,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('department');
        echo view('templates/footer');
    }

    public function addDepartment()
    {
        $data = [
            'title' => 'Add Department',
        ];

        echo view('templates/header', $data);
        echo view('add_department');
        echo view('templates/footer');
    }

    public function editDepartment($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $departmentModel = new DepartmentModel();

        $department = $departmentModel->where('id', $decryptedId)->first();

        $data = [
            'title' => 'Edit Department',
            'department' => $department,
            'id' => $id
        ];

        echo view('templates/header', $data);
        echo view('edit_department');
        echo view('templates/footer');
    }

    public function employees()
    {
        $employeeModel = new EmployeeModel();

        $employees = $employeeModel->select('employees.id, employees.name, employees.designation, departments.description')->join('departments', 'departments.id = employees.department_id')->findAll();

        $data = [
            'title' => 'Employees',
            'employees' => $employees,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('employees');
        echo view('templates/footer');
    }

    public function addEmployee()
    {
        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->orderBy('name')->findAll();

        $data = [
            'title' => 'Add Employee',
            'departments' => $departments
        ];

        echo view('templates/header', $data);
        echo view('add_employee');
        echo view('templates/footer');
    }

    public function editEmployee($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $employeeModel = new EmployeeModel();
        $departmentModel = new DepartmentModel();

        $employee = $employeeModel->where('id', $decryptedId)->first();
        $departments = $departmentModel->findAll();

        $data = [
            'title' => 'Edit Employee',
            'employee' => $employee,
            'departments' => $departments,
            'id' => $id
        ];

        echo view('templates/header', $data);
        echo view('edit_employee');
        echo view('templates/footer');
    }

    public function locations()
    {
        $locationModel = new LocationModel();

        $locations = $locationModel->orderBy('name')->findAll();

        $data = [
            'title' => 'Room/ Location',
            'locations' => $locations,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('locations');
        echo view('templates/footer');
    }

    public function addLocation()
    {
        $data = [
            'title' => 'Add Room/ Location',
        ];

        echo view('templates/header', $data);
        echo view('add_location');
        echo view('templates/footer');
    }

    public function editLocation($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $locationModel = new LocationModel();

        $location = $locationModel->where('id', $decryptedId)->first();

        $data = [
            'title' => 'Edit Room/ Location',
            'location' => $location,
            'id' => $id
        ];

        echo view('templates/header', $data);
        echo view('edit_location');
        echo view('templates/footer');
    }

    public function units()
    {
        $unitModel = new UnitModel();

        $units = $unitModel->orderBy('name')->findAll();

        $data = [
            'title' => 'Units',
            'units' => $units,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('units');
        echo view('templates/footer');
    }

    public function addUnit()
    {
        $data = [
            'title' => 'Add Unit',
        ];

        echo view('templates/header', $data);
        echo view('add_unit');
        echo view('templates/footer');
    }

    public function editUnit($id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $unitModel = new UnitModel();

        $unit = $unitModel->where('id', $decryptedId)->first();

        $data = [
            'title' => 'Edit Unit',
            'unit' => $unit,
            'id' => $id
        ];

        echo view('templates/header', $data);
        echo view('edit_unit');
        echo view('templates/footer');
    }

    public function requests()
    {
        $requestModel = new RequestModel();

        $requestSupplies = $requestModel->select('request.id, supplies.stock_no, units.name as unitName, supplies.name, request.request_qty, employees.name as employeeName, request.created_at, request.status, request.type')->join('employees', 'employees.id = request.requested_by')->join('supplies', 'supplies.id = request.item_id')->join('units', 'units.id = supplies.unit')->where('request.type', 'supplies')->findAll();
        $requestEquipments = $requestModel->select('request.id, equipments.property_no, units.name as unitName, equipments.name, request.request_qty, employees.name as employeeName, request.created_at, request.status, request.type')->join('employees', 'employees.id = request.requested_by')->join('equipments', 'equipments.id = request.item_id')->join('units', 'units.id = equipments.unit')->where('request.type', 'equipments')->findAll();

        $data = [
            'title' => 'Request Lists',
            'requestSupplies' => $requestSupplies,
            'requestEquipments' => $requestEquipments,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('requests');
        echo view('templates/footer');
    }

    public function requestSupplies($type)
    {
        $requestModel = new RequestModel();

        if ($type == 'supplies') {
            $requests = $requestModel->select('request.id, supplies.stock_no, units.name as unitName, supplies.name, request.request_qty, employees.name as employeeName, request.created_at, request.status')->join('employees', 'employees.id = request.requested_by')->join('supplies', 'supplies.id = request.item_id')->join('units', 'units.id = supplies.unit')->where('request.type', 'supplies')->groupStart()->where('request.deleted_at', '0000-00-00 00:00:00')->where('request.requested_by', session()->get('id'))->orWhere('employees.department_id', session()->get('department_id'))->groupEnd()->findAll();
        } else {
            $requests = $requestModel->select('request.id, equipments.property_no, units.name as unitName, equipments.name, request.request_qty, employees.name as employeeName, request.created_at, request.status')->join('employees', 'employees.id = request.requested_by')->join('equipments', 'equipments.id = request.item_id')->join('units', 'units.id = equipments.unit')->where('request.type', 'equipments')->groupStart()->where('request.deleted_at', '0000-00-00 00:00:00')->where('request.requested_by', session()->get('id'))->orWhere('employees.department_id', session()->get('department_id'))->groupEnd()->findAll();
        }

        $data = [
            'title' => 'Request Lists',
            'requests' => $requests,
            'type' => $type,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('request_supplies');
        echo view('templates/footer');
    }

    public function requestSupply()
    {
        $equipmentModel = new EquipmentModel();
        $supplyModel = new SupplyModel();
        $departmentModel = new DepartmentModel();

        $equipments = $equipmentModel->orderBy('name', 'asc')->findAll();
        $supplies = $supplyModel->orderBy('name', 'asc')->findAll();
        $departments = $departmentModel->orderBy('name', 'asc')->findAll();

        $data = [
            'title' => 'Request An Item',
            'equipments' => $equipments,
            'supplies' => $supplies,
            'departments' => $departments,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('request_supply');
        echo view('templates/footer');
    }

    public function editRequestSupply($type, $id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $requestModel = new RequestModel();
        $departmentModel = new DepartmentModel();
        $equipmentModel = new EquipmentModel();
        $supplyModel = new SupplyModel();

        $request = $requestModel->where('id', $decryptedId)->first();
        $departments = $departmentModel->orderBy('name')->findAll();
        if ($type == 'equipments')
            $items = $equipmentModel->orderBy('name')->findAll();
        else
            $items = $supplyModel->orderBy('name')->findAll();

        $data = [
            'title' => 'Edit Request Supply',
            'request' => $request,
            'departments' => $departments,
            'items' => $items,
            'type' => $type,
            'encrypter' => $this->encrypter
        ];

        echo view('templates/header', $data);
        echo view('edit_request_supply');
        echo view('templates/footer');
    }

    public function requestedItem($type, $id)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $requestModel = new RequestModel();

        if ($type == 'equipments') {
            $request = $requestModel->select('departments.name as officeName, equipments.property_no, units.name as unitName, equipments.description, request.request_qty, request.available, request.issue_qty, request.remarks, employees.name as employeeName, employees.designation, request.division, request.office, request.code, request.risNo, request.purpose, request.approved_by, issued_by, received_by, request.approved_by, request.approved_designation, request.issued_designation, request.received_designation, request.created_at, request.approved_date, request.issued_date, request.status, request.type')->join('employees', 'employees.id = request.requested_by')->join('departments', 'departments.id = request.office')->join('equipments', 'equipments.id = request.item_id')->join('units', 'units.id = equipments.unit')->where('request.id', $decryptedId)->first();
        } else {
            $request = $requestModel->select('departments.name as officeName, supplies.stock_no, units.name as unitName, supplies.description, request.request_qty, request.available, request.issue_qty, request.remarks, employees.name as employeeName, employees.designation, request.division, request.office, request.code, request.risNo, request.purpose, request.approved_by, issued_by, received_by, request.approved_by, request.approved_designation, request.issued_designation, request.received_designation, request.created_at, request.approved_date, request.issued_date, request.status, request.type')->join('employees', 'employees.id = request.requested_by')->join('departments', 'departments.id = request.office')->join('supplies', 'supplies.id = request.item_id')->join('units', 'units.id = supplies.unit')->where('request.id', $decryptedId)->first();
        }

        $data = [
            'title' => 'Request Form',
            'request' => $request,
            'encrypter' => $this->encrypter,
            'id' => $id,
            'type' => $type
        ];

        echo view('templates/header', $data);
        echo view('requested_item');
        echo view('templates/footer');
    }

    public function profile()
    {
        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->select('id, name')->orderBy('name', 'asc')->findAll();

        $data = [
            'title' => 'Profile',
            'encrypter' => $this->encrypter,
            'departments' => $departments
        ];

        echo view('templates/header', $data);
        echo view('profile');
        echo view('templates/footer');
    }

    public function addRequestEntry($id, $type)
    {
        $decryptedId = $this->encrypter->decrypt(base64_decode(str_replace(['-', '_'], ['+', '/'], $id)));

        $employeeModel = new EmployeeModel();
        $requestModel = new RequestModel();

        $employees = $employeeModel->orderBy('name')->findAll();
        $request = $requestModel->where('id', $decryptedId)->first();

        $data = [
            'title' => 'Add Entry',
            'encrypter' => $this->encrypter,
            'employees' => $employees,
            'request' => $request,
            'id' => $id,
            'type' => $type
        ];

        echo view('templates/header', $data);
        echo view('add_request_entry');
        echo view('templates/footer');
    }
}
