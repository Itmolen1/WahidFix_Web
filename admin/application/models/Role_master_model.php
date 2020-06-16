<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Role_master_model extends CI_Model
{
    function role_masterListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.roleId, BaseTbl.role');
        $this->db->from('tbl_roles as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.role  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function add_rights($data)
    {
        //echo "<pre>";print_r($data);die;
        $module_names=array_keys($data);
        //echo "<pre>";print_r($data);die;
        for($i=1;$i<count($data);$i++)
        {
            //echo "<pre>";print_r($value);die;
            //echo "<pre>123";print_r($data[$module_names[$i]]);die;
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
            'module_id'=>$module_names[$i],
            'p_view'=>$p_view,
            'p_add'=>$p_add,
            'p_update'=>$p_update,
            'p_delete'=>$p_delete,
            'roleId'=>$data['userId']
            );
            $this->db->insert('tbl_rights', $value);
            //echo $this->db->last_query();die;
        }        
    }

    function update_rights($data,$modules)
    {

        /////////////first find out whether there is any new module added for the user or not if yes then get diffrance of db modules and form submitted values module and set values for diffrance values rights then proceed as it is ///////////////////////////////////////
        //echo "<pre>123";print_r($data);die;
        $this->db->select('module_id');
        $query=$this->db->get_where('tbl_rights',array('roleId'=>$data['userId']));
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
                'roleId'=>$data['userId'],
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
                $this->db->where('roleId',$data['userId']);
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

    function get_modules()
    {
        $query=$this->db->get('tbl_modules');
        return $query->result_array();
    }

    function check_role_existance($id)
    {
        //$this->db->select('rights_id,roleId,module_id,p_view,p_add,p_update,p_delete');
        $query=$this->db->get_where('tbl_rights',array('roleId'=>$id));
        return $query->result_array();
    }
    
    function role_masterListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.roleId, BaseTbl.role');
        $this->db->from('tbl_roles as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        if(!empty($searchText)) {
           $likeCriteria = "(BaseTbl.role  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.roleId', 'DESC');
        $this->db->limit($page, $segment);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function add_new_role_master($servicesInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_roles', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    function get_role_master_info($id)
    {
         $this->db->select('BaseTbl.roleId, BaseTbl.role');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_roles as BaseTbl');
        $this->db->where('roleId', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_all_services()
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function edit_role_master($val)
    {
        $this->db->set('role',$val['role']);
        $this->db->where('roleId', $val['roleId']);
        $this->db->update('tbl_roles');
        return TRUE;
    }
    
    function delete_role_master($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('roleId', $id);
        $this->db->update('tbl_roles');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('tbl_modules', $servicesId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getservicesInfoWithRole($servicesId)
    {
        $this->db->select('BaseTbl.servicesId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_services as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.servicesId', $servicesId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  