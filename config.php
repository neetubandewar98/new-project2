<?php
//session_start();
$conn = mysqli_connect("localhost","root","","school_plan");
$contest = 'asdss';
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}



function shorten_string($string, $wordsreturned)
{
    $retval = $string;  //  Just in case of a problem
    $array = explode(" ", $string);
    /*  Already short enough, return the whole thing*/
    if (count($array)<=$wordsreturned)
    {
        $retval = $string;
    }
    /*  Need to chop of some words*/
    else
    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

function connet(){
    $conn = mysqli_connect("localhost","root","","school_plan");
    return $conn;
}

function insertdata($tbname,$data){
    $conn = connet();
    unset($data['submit']);
    //print_r($data); exit();
    if($tbname !='' && $data!='' && is_array($data)){
        
        $keys=array_keys($data);
        $values=array_values($data);
        
        foreach ($data as $key => $value) {
            $set[]='"'.$value.'"';
        
        }
        
        $keys=implode('`,`',$keys);
        
        $set=implode(',',$set);
        
        
        $query='INSERT INTO '.$tbname.'(`'.$keys.'`) VALUES('.$set.')';
        if(mysqli_query($conn,$query)){
            //echo 'insert';
            return true;
        }else{
            //echo 'not insert';
            return false;
        };
        
        
    }else{
        return false;
    }
    
}

function get_data($tbname,$where=null,$select='*'){
    $conn = connet();
    $sql = 'SELECT '.$select.' FROM '.$tbname;
    $sql .= ($where!='') ? ' where '.$where : '';
    //echo mysqli_num_rows($sql_resp); exit();
    $sql_resp = mysqli_query($conn,$sql);
    if(mysqli_num_rows($sql_resp)>0){
        return $sql_resp;
    }else{
        return mysqli_num_rows($sql_resp);
    }
}

function result_array($table_name,$where_condition,$extra_where=null)
{
    $conn = connet();

    $where="";
    if(!empty($where_condition))
    {
        $where=where($where_condition);
        $where=" where $where";
    }
    if($extra_where==null)
    {
        $extra_where="";
    }
    
    
    $query="SELECT * FROM ".$table_name."".$where.""."  ".$extra_where." order by id DESC";
    
    $row=mysqli_query($conn,$query);

    $result = array();
    //$row=mysqli_fetch_assoc($row);
    //echo mysqli_num_rows($row);
    //echo $query;die;

    while ($row1=mysqli_fetch_assoc($row)) {
    
    $result[]=$row1;
    }

    return $result; 

}

function delete_row($tbname,$id){
    $conn = connet();
    if(mysqli_num_rows(mysqli_query($conn,'select id from '.$tbname.' where id='.$id))>0){
        $sql = 'DELETE FROM '.$tbname.' WHERE id= '.$id;
        $resp = mysqli_query($conn,$sql);
        if($resp){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function update_new($table_name,$data,$where_condition)
{
    $conn = connet();

    foreach ($data as $key => $value) {
        $set[]=$key.'="'.$value.'"';
    }
    //print_r($data);exit();
    //$keys=implode(',',$keys);
    $where="";
    $set=implode(',',$set);
    
    
    if(!empty($where_condition))
    {   
        if(is_array($where_condition))
        {
        $where=where($where_condition);
        
        }
        else 
        {         
        $where=" $where_condition ";
        }
        //$where=" where $where";
    }
    //$where=where($where_condition);
    
    $query='update '.$table_name.' set '.$set.' where '.$where;
    //echo $query;die;
    mysqli_query($conn,$query);
    return true;
}


function where($where_condition)
{
    foreach ($where_condition as $key => $value) {
        if(!empty($value))
        {
            $value=trim($value);
            $where[]=$key ."=".'"'.$value.'"';
        }  
    }
    $where=implode(' and ',$where);
    
    return $where;
}

?>