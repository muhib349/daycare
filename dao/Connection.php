<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 11/23/17
 * Time: 11:45 PM
 */

class Connection
{

    public function get_connection(){
        return new mysqli('localhost','root','__muhib','daycare');
    }
}