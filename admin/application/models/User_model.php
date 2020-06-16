<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function add_rights($data)
    {
        $module_names=array_keys($data);
        //echo "<pre>";print_r($data);die;
        for($i=1;$i<count($data);$i++)
        {
            //echo "<pre>";print_r($value);die;
            $p_view=0;$p_add=0;$p_update=0;$p_delete=0;
            if(in_array('p_view', $data[$module_names[$i]]))
            {
                $p_view=1;
            }
            if(in_array('p_add', $data[$module_names[$i]]))
            {
                $p_add=1;
            }
            if(in_array('p_update', $data[$module_names[$i]]))
            {
                $p_update=1;
            }
            if(in_array('p_delete', $data[$module_names[$i]]))
            {
                $p_delete=1;
            }
            $value=array(
            'userId'=>$data['userId'],
            'module_id'=>$module_names[$i],
            'p_view'=>$p_view,
            'p_add'=>$p_add,
            'p_update'=>$p_update,
            'p_delete'=>$p_delete
            );
            $this->db->insert('tbl_rights', $value);
        }        
    }

    function array_keys_exists(array $keys, array $arr) {
       return !array_diff_key(array_flip($keys), $arr);
    }

    function update_rights($data,$modules)
    {

        /////////////first find out whether there is any new module added for the user or not if yes then get diffrance of db modules and form submitted values module and set values for diffrance values rights then proceed as it is ///////////////////////////////////////
        //echo "<pre>123";print_r($data);die;
        $this->db->select('module_id');
        $query=$this->db->get_where('tbl_rights',array('userId'=>$data['userId']));
        $res=$query->result_array();
        $res=array_column($res, 'module_id');
        //echo "<pre>";print_r($res);//die;
        $newdata=$data;
        unset($newdata['userId']);unset($newdata['update']);
        //echo "<pre>123";print_r($newdata);die;
        if(count($res)<count($newdata))//there need to be add new module which is not in db
        {
            $arrayone=array_flip($res);
            $final=array_diff_key($newdata,$arrayone );
            //echo "<pre>";print_r($fina);die;
            $module_names=array_keys($final);
            //echo "<pre>";print_r($data);die;
            for($i=0;$i<count($final);$i++)
            {
                //echo "<pre>";print_r($value);die;
                $p_view=0;$p_add=0;$p_update=0;$p_delete=0;
                if(in_array('p_view', $final[$module_names[$i]]))
                {
                    $p_view=1;
                }
                if(in_array('p_add', $final[$module_names[$i]]))
                {
                    $p_add=1;
                }
                if(in_array('p_update', $final[$module_names[$i]]))
                {
                    $p_update=1;
                }
                if(in_array('p_delete', $final[$module_names[$i]]))
                {
                    $p_delete=1;
                }
                $value=array(
                'userId'=>$data['userId'],
                'module_id'=>$module_names[$i],
                'p_view'=>$p_view,
                'p_add'=>$p_add,
                'p_update'=>$p_update,
                'p_delete'=>$p_delete
                );
                $this->db->insert('tbl_rights', $value);
            } 
        }
        

        ///////////////////////////////////////////////
        $module_names=array_keys($data);
        //echo "<pre>";print_r(array_column($modules, 'module_name'));die;
        $module_master=array_column($modules, 'module_name');
        $up=array_diff($module_master, $module_names);
        $newarray=array_values($up);
        //echo "<pre>";print_r($newarray);die;
        for($i=2;$i<count($data);$i++)
        {
            //
            if(in_array($module_names[$i], $module_master))
            {
                //echo "coming if";die;
                //echo "<pre>";print_r($module_names[$i]);print_r($module_master);die;
                $p_view=0;$p_add=0;$p_update=0;$p_delete=0;
                if(in_array('p_view', $data[$module_names[$i]]))
                {
                    $p_view=1;
                }
                if(in_array('p_add', $data[$module_names[$i]]))
                {
                    $p_add=1;
                }
                if(in_array('p_update', $data[$module_names[$i]]))
                {
                    $p_update=1;
                }
                if(in_array('p_delete', $data[$module_names[$i]]))
                {
                    $p_delete=1;
                }
                $value=array(
                'p_view'=>$p_view,
                'p_add'=>$p_add,
                'p_update'=>$p_update,
                'p_delete'=>$p_delete
                );
                // 'userId'=>$data['userId'],
                // 'module_id'=>$module_names[$i],
                $this->db->where('userId',$data['userId']);
                $this->db->where('module_id',$module_names[$i]);
                $this->db->update('tbl_rights', $value);
            }
        }
        if(!empty($newarray))
        {
            for($k=0;$k<count($newarray);$k++)
            {
                $value=array(
                'p_view'=>0,
                'p_add'=>0,
                'p_update'=>0,
                'p_delete'=>0
                );
                $this->db->where('module_id',$newarray[$k]);
                $this->db->update('tbl_rights', $value);
            }
        }
    }

    function check_user_existance($id)
    {
        $query=$this->db->get_where('tbl_rights',array('userId'=>$id));
        return $query->result_array();
    }

    function get_modules()
    {
        $query=$this->db->get('tbl_modules');
        return $query->result_array();
    }

    function update_role_for_user($data)
    {
        $this->db->set('roleId',$data['roleId']);
        $this->db->where('userId', $data['userId']);
        $this->db->update('tbl_users');        
        return $this->db->affected_rows();
    }

    function get_roles()
    {
        $this->db->where('roleId !=',1);
        $query=$this->db->get('tbl_roles');
        return $query->result_array();
    }

    function get_user($id)
    {
        $query=$this->db->get_where('tbl_users',array('userId'=>$id));
        return $query->row_array();
    }

    function get_dashboard_data()
    {

        $this->db->where('status !=',2);
        $this->db->where('status !=',6);
        $this->db->where('status !=',7);
        $this->db->where('isDeleted',0);
        $query=$this->db->get_where('tbl_service_request');
        $res=$query->result_array();
        $new_task=$query->num_rows();
        $data['new_task']=$new_task;

        $this->db->where('status',6);
        $this->db->where('isDeleted',0);
        $query=$this->db->get_where('tbl_service_request');
        $res=$query->result_array();
        $completed_task=$query->num_rows();
        $data['completed_task']=$completed_task;

        //$this->db->where('status',6);
        $this->db->where('isDeleted',0);
        $query=$this->db->get_where('tbl_employee');
        $res=$query->result_array();
        $total_employees=$query->num_rows();
        $data['total_employees']=$total_employees;

        //$this->db->where('status',6);
        $this->db->where('isDeleted',0);
        $query=$this->db->get_where('tbl_user');
        $res=$query->result_array();
        $total_users=$query->num_rows();
        $data['total_users']=$total_users;
        return $data;
    }
    
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }

    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
}  