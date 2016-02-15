<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * application/controllers/Home.php
 */

class Home extends Application {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('_MasterpageHeader');
        $this->load->view('_MasterpageNavBar');
		$this->gameStatus();
        $this->playerInfo();
		$this->userLogin();
    }
	
	private function gameStatus() {
		$this->load->model('GameStatus');
		$query = $this->GameStatus->gameSummary();
		
		$gameStatus = array();
		
		foreach ($query as $stat) {
			$gameSummary[] = (array) $stat;	
		}
		
		$Status['seriesInfo'] = $gameSummary;
		
		$this->data['gameStatus'] = $this->parser->parse('_seriesInfo', $Status, true);
		
	}

    private function playerInfo() {
        $this->load->model('PlayerInfo');

        //try to call the query in the model to initialize it
        $query = $this->PlayerInfo->playerEC();


        $playerInfo = array();

        foreach ($query as $row) {
            $playerInfo[] = (array) $row;
        }
        
        $table = array();
        foreach ($playerInfo as $index => $row) {
            $new = $row;
            switch($index % 2 == 0){
                case TRUE:
                    $new['tableClass'] = "firstColumn";
                    break;
                case FALSE:
                    $new['tableClass'] = "secondColumn";
                    break;
            }
            $table[] = $new;
        }
        
        $players['playerTable'] = $table;

        $this->data['playerInfo'] = $this->parser->parse('_playerTable', $players, true);

        $this->parser->parse('Homepage', $this->data);
    }

}

/* End of file Home.php */
    /* Location: application/controllers/Home.php */

