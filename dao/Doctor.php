<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/8/17
 * Time: 7:17 PM
 */

interface Doctor
{
    public function slotStatus($doc_id);
    public function unsetSlot_1($doc_id);
    public function unsetSlot_2($doc_id);
    public function unsetSlot_3($doc_id);
    public function setSlot_1($doc_id);
    public function setSlot_2($doc_id);
    public function setSlot_3($doc_id);
    public function visitedBabyByDoc($doc_id);
    public function saveVisitedBabyDoc($doc_id,$baby_id);
}