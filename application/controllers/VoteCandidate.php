<?php
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 22/11/2016
 * Time: 13.40
 */

class VoteCandidate extends CI_Controller {

    public function index() {
        $this->load->view('vote-candidate/welcome_voter');
    }

    public function voteBEM() {
        $this->load->view('vote-candidate/vote_bem_candidate');
    }

    public function voteDPM() {
        $this->load->view('vote-candidate/vote_dpm_candidate');
    }

}