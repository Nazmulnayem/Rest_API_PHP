<?php

class country
{
    public $id;
    public $name;
    public function Index(){
        $cn = mysqli_connect("localhost","root","","rest_api");
        $sql = "select id, name from country";
        if($this->id > 0)
        {
            $sql .= " where id = ".$this->id;
        }

        $table =mysqli_query($cn,$sql);

        $a =array();
        while ($row = mysqli_fetch_assoc($table)){
            $a[] = $row;
        }
        print json_encode($a);
    }

    public function Insert(){
        $cn = mysqli_connect("localhost","root","","rest_api");
        $sql = "insert into country (name) values ('".$this->name."')";
        if(mysqli_query($cn,$sql)){
            print '{"result":"1", "message":"country data saved"}';
        }
        else
        {
            print '{"result":"0","message":"'.mysqli_error($cn).'""}';
        }
    }

    public function Update(){
        $cn = mysqli_connect("localhost","root","","rest_api");
        $sql = "update country set name ='".$this->name."' where id = ".$this->id;
        if(mysqli_query($cn,$sql)){
            print '{"result":"1","message":"country data update"}';
        }
        else
        {
            print '{"result":"0","message":"'.mysqli_error($cn).'""}';
        }
    }

    public function Delete(){
        $cn = mysqli_connect("localhost","root","","rest_api");
        $sql = "delete from country where id = ".$this->id;
        if(mysqli_query($cn,$sql)){
            print '{"result":"1","message":"country data delete"}';
        }
        else
        {
            print '{"result":"0","message":"'.mysqli_error($cn).'""}';
        }
    }
}