<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    // $this->output->enable_profiler();
    $this->load->model('user');
  }

  public function index()
  {
    if($this->session->userdata('logged_in'))
    {
        redirect('profile');
    }
    $this->load->view('index');
  }

  public function register()
  {
    $is_valid = $this->user->register($this->input->post());
    //if the array
    if($is_valid[0] == 'valid')
    {
      //redirect to reviews index
      $user = $this->user->get_user_by_id($is_valid[1]);
      // var_dump($user);
      $this->session->set_userdata('id', $user['id']);
      $this->session->set_userdata('name', $user['first_name']);
      $this->session->set_userdata('logged_in', TRUE);
      redirect('profile');
    }
    else
    {
      // set session error messages to display on index
      $this->session->set_flashdata('reg_errors', $is_valid);
      // redirect to index
      redirect('/');
    }
  }


  public function login()
  {
    $is_logged = $this->user->login($this->input->post());
    if($is_logged)
    {
      $this->session->set_userdata('id', $is_logged['id']);
      $this->session->set_userdata('name', $is_logged['first_name']);
      $this->session->set_userdata('logged_in', TRUE);
      redirect('profile');
    }
    else
    {
      $this->session->set_flashdata('log_errors', "<p class='errors'>Invalid login credentials</p>");
      redirect('/');
    }
  }



  public function profile()
  {
    if(!$this->session->userdata('logged_in'))
    {
        redirect('/');
    }
    $id = $this->session->userdata('id');
    $users_trips = $this->user->get_trips($id);
    $other_users_trips = $this->user->other_users_trips($id);
    $this->load->view('profile', array( 'users_trips' => $users_trips, 'other_users_trips' => $other_users_trips));
  }

  public function log_out()
  {
    $this->session->set_userdata('id', null);
    $this->session->set_userdata('name', null);
    $this->session->set_userdata('logged_in', FALSE);
    redirect('/');
  }

  public function add()
  {
      $this->load->view('add');
  }

  public function trip_info($id)
  {
    //  $trip_info = $this->user->get_trip_by_id($id);
    //  $user_info = $this->user->info_stuff($id);
    // $other_users = $this->user->
    $trip_info = $this->user->trip_info($id);
    $this->load->view('info', array('trip_info' => $trip_info));
  }

  public function add_trip()
  {
    //$data = $this->input->post();
      $errors = $this->user->plan_trip($this->input->post());
      $this->session->set_flashdata('trip_errors', $errors);
      $this->load->view('add');
  }

  public function join_trip($id)
  {
      $destination = $this->user->join_trip($id, $this->session->userdata('id'));
      $this->session->set_flashdata("trip_joined", $destination['destination']);
      redirect('profile');
  }

  public function cancel_trip($id)
  {
    $this->user->cancel_trip($id, $this->session->userdata('id'));
    redirect('profile');
  }


}

//end of main controller
