<?php
class MY_Log extends CI_Log {
	
	function My_log()
    {
        parent::CI_Log();
//        echo "log lib loaded<br>";
    }
    
    function email($errorDump, $subject = null){
    	$this->load->library('email');
		try{
			$this->email->from('bugs@epicthanks.org');
			$this->email->to('shivaas@gmail.com');
			$this->email->subject('Thank you');
			$this->email->message($content);
			
			if(!$this->email->send()) {
				echo $this->email->print_debugger();
				return;
			}
			
			echo "email sent";
		}catch(Exception $e){
			echo $e->getMessage();
		}
    }
}