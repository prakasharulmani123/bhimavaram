<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			print_r($data);
		}
		else
		{
			echo  validation_errors();
		}		
		//print_r($this->settings->getOgData());
		$data['content']['template']='test';		
		$data['content']['name']='Senthil Kumar';
		$data['header']['css']=array('stykle2.css','~general/base.css');
		$data['footer']['js']=array('stykle2.js','~general/base.js');
		$data['content']['adwidget']=$this->widgets->getWidget('ad',array('name'=>'Senthil Kumar','description'=>'Worldwide, there are about 150 million new businesses being started up each year. If each of those companies needs a web presence, then they each need a domain name – and a strategy and budget to match.
With some startups being funded to grow as quickly as possible, many are interested in purchasing killer domain names so they can create a memorable brand. Noted venture capitalist Fred Wilson of Union Square Ventures suggests to start-ups he invests in that they allocate $50,000 to buy a good domain name.'));
		$data['content']['usernames']=array(
										'senthil'=>array('value'=>'007','class'=>'first_list','id'=>'U005'),
										'Murali'=>array('value'=>'010','class'=>'seconst_list','id'=>'U0205'),
										'Dhoni'=>array('value'=>'099','class'=>'third_list','id'=>'U0099'),
										);
		$this->layout->publish($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */