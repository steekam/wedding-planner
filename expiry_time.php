<?php
/*
* Returns the current time addes two hours which is the expiry time of the link
*@param none
*@return time string
*
*
*
*/
    function expire(){
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $expiry_time = date('Y-m-d H:i',strtotime('+2 hours',strtotime($now)));

        return $expiry_time;
    }    
    
?>