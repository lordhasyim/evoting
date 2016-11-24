<?php

class Event
{
    public function setEvent()
    {
        $ci = & get_instance();

        if ($ci->ion_auth->logged_in()) {

            $id = $ci->ion_auth->is_admin() === true ? $ci->session->userdata('user_id') : $ci->session->userdata('parent_id');
//            echo $ci->session->userdata('parent_id');
            $row = $ci->db->get_where('event',['user_id' => $id, 'status'=>true])->row();
            $ci->config->set_item('default_event_id', $row->event_id);

        }


    }
}