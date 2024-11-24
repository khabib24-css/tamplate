<?php 
require_once 'models/role_model.php';
require_once 'models/item_model.php';
require_once 'models/user_model.php';


session_start();
$obj_Role = new modelRole();
$obj_Item = new modelItem();
$obj_User = new modelUser();


if (isset($_GET['modul'])){
    $model = $_GET['modul'];
}else{
    $model = 'dashboard';
}

switch ($model){
    case 'dashboard':
        include 'views/kosong.php';
        break;
    case 'user':
        
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        switch ($fitur){
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $uname = $_POST["username"];
                    $pass = $_POST["password"];
                    $role_name = $_POST["role_name"];
                    $role = $obj_Role->getRoleByName($role_name);
                    $obj_User ->addUser($uname,$pass, $role);
                    header('location: index.php?modul=user');
                }else{
                    $roles = $obj_Role->getAllRoles();
                    include 'views/user_input.php';
                
                }
                break;
            default:
            $User = $obj_User->getUser();
            // print_r($users);
            include 'views/user_list.php';
        }
        break;

    case 'role':
        // $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        // $id = isset($_GET['id']) ? $_GET['id'] : null;
        // switch ($fitur) {
        //     case 'add':
        //         if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //             $role_name = $_POST['role_name'];
        //             $role_desc = $_POST['role_desc'];
        //             $role_status = $_POST['role_status'];
        //             if($role_status == 1){
        //                 $role_status =1;
        //             }else{
        //                 $role_status = 0;
        //             }
        //             $obj_Role->addRole($role_name,$role_desc,$role_status);
        //         }else{
        //             include 'views/role_list.php';
        //         }
        //         break;
        //     case 'edit':
        //         break;    
        // }
        // if (isset($_GET['fitur'])){
        //     $fitur = $_GET['fitur'];
        // }else{
        //     $fitur = null;
        // }

        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_desc'];
                    $role_status = $_POST['role_status'];
                    $obj_Role->addRole($role_name,$role_desc,$role_status);
                    header('location: index.php?modul=role');
                }else{
                    include 'views/role_input.php';
                }
                
                
                
                // echo "Masuk pak eko";
                break;
            case 'delete':
                // if(isset($_GET['role_id'])){
                //     $role_id = $_GET['role_id'];
                //     $obj_Role->deleteRole( $role_id );
                // }
                
                $obj_Role->deleteRole($id);
                
                        header('location: index.php?modul=role');
                        break;
            case 'update':
                $role = $obj_Role->getRoleById($_GET['id']);
                // print_r($role); untuk mengecek isi $role dengan id
                include 'views/role_edit.php';
                break;
            case 'edit':
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_desc'];
                    $role_status = $_POST['role_status'];
                    $obj_Role->updateRole($id,$role_name,$role_desc,$role_status);                    
                    header('location: index.php?modul=role');
                }else{
                    include 'views/role_list.php';
                }
                break;
                default:
                        $roles = $obj_Role->getAllRoles();
                        include 'views/role_list.php';
                    }
        break;
        
    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        $item_id = isset($_GET['id']) ? $_GET['id'] : null;
        switch ($fitur) {
            case 'tambah':
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $item_name = $_POST['item_name'];
                    $item_desc = $_POST['item_desc'];
                    $item_status = $_POST['item_status'];
                    $obj_Item->addRole($item_name,$item_desc,$item_status);
                    header('location: index.php?modul=barang');
                }else{
                    include 'views/item_input.php';
                }
                // echo "Masuk pak eko";
                break;
            case 'deleteBarang':
                $obj_Item->deleteBarang($item_id);
                        header('location: index.php?modul=barang');
                        break;
            case 'updateBarang':
                $data = $obj_Item->getRoleById($_GET['id']);
                // print_r($data); //untuk mengecek isi $role dengan id
                include 'views/item_edit.php';
                break;
            case 'editBarang':
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $item_name = $_POST['item_name'];
                    $item_desc = $_POST['item_desc'];
                    $item_status = $_POST['item_status'];
                    $obj_Item->updateRole($item_id,$item_name,$item_desc,$item_status);                    
                    header('location: index.php?modul=barang');
                }else{
                    include 'views/item_list.php';
                }
                break;
                default:
                        $items = $obj_Item->getAllRoles();
                        include 'views/item_list.php';
                        break;
                    }

}

?>