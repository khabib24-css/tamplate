<?php 
require_once 'domain_Objek/data_item.php';

class modelItem
{
    private $items = [];
    private $nextId = 1;

    public function __construct() {
        if (isset($_SESSION['items'])) {
            $this->items = unserialize($_SESSION['items']);
            $this->nextId = count($this->items) + 1;
        } else {
            $this->initializeDefaultRole();
        }
    }

    public function initializeDefaultRole() {
        $this->addRole("Prnter", "Epason", 1);
        $this->addRole("Mouse", "Robot", 1);
        $this->addRole("keyboard", "Ajazz", 0);
    }

    public function addRole($item_name, $item_desc, $item_status) {
        $peran = new Item ($this->nextId++, $item_name, $item_desc, $item_status);
        $this->items[] = $peran;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['items'] = serialize($this->items);
    }

    public function getAllRoles() {
        return $this->items;
    }

    public function getRoleById($item_id) {
        foreach ($this->items as $data) {
            if ($data->item_id == $item_id) {
                return $data;
            }
        }
        return null;
    }
    // public function editById($item_id){
    //     $peran = $this->modelrole->getRoleById($item_id);
    //     include 'views/role_update';
    // }

    public function updateRole($item_id, $item_name, $item_desc, $item_status) {
        foreach ($this->items as $data) {
            if ($data->item_id == $item_id) {
                $data->item_name = $item_name;
                $data->item_desc = $item_desc;
                $data->item_status = $item_status;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function deleteBarang($item_id) {
        foreach ($this->items as $key => $data) {
            if ($data->item_id == $item_id) {
                unset($this->items[$key]);
                $this->items = array_values($this->items);
                $this->saveToSession();
                return true;
            }
        }
        return false;

        //$cek = $this->items->deleteRole($item_id);
        //if ($cek==false) {
        //    throw new Exception('gak da brooo');
        //}else{
        //    header('location: MainEntryPoint.php?modul=data');
        //}
    }

    public function getRoleByName($item_name) {
        foreach ($this->items as $data) {
            if ($data->item_name == $item_name) {
                return $data;
            }
        }
        return null;
    }
}
?>