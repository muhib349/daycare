<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/8/17
 * Time: 8:38 PM
 */

interface Sisters
{
    public function currentAssignedBaby($sis_id);
    public function vistedBabyBySis($sis_id);
    public function saveVisitedBabySis($sis_id,$baby_id);
    public function getSister($user_id);
    public function numOfAssignedBaby($sis_id);
    public function duplicateAssign($b_id);
    public function assignBaby($b_id,$s_id);
    public function removeAssignedBaby($baby_id);

}