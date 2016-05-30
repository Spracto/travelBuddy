<?php

class User extends CI_Model
{
  public function get_user_by_id($id){
    // echo 'in the model getting user';
    $query = "SELECT id, first_name FROM users WHERE id = ?";
    return $this->db->query($query, array($id))->row_array();
  }

  public function register($post)
  {
    // this loads the built in CI form validation
    $this->load->library('form_validation');
    //change error delimiters
    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[2]');
    $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[confirmpassword]');
    $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'trim|required');
    if($this->form_validation->run())
    {
      $query = 'INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?, NOW(), NOW())';
      $values = array($post['firstname'], $post['lastname'], $post['email'], md5($post['password']));
      // if query runs correctly
      if($this->db->query($query, $values))
      {
        $id = $this->db->insert_id();
        $success = array('valid', $id);
        return $success;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return array(validation_errors());
    }
  }

  public function login($post){
    $check_user = "SELECT * FROM users WHERE users.email = ?";
    $user = $this->db->query($check_user, array($post['email']))->row_array();
    if($user){
      if(md5($post['password']) == $user['password']){
        return $user;
      }
      else {
        return false;
      }
    } else{
      return false;
    }
  }


  function destroy($email)
  {
    $query = "DELETE FROM userdash.users WHERE email=?";
    $value = array($email);
    return $this->db->query($query,$value);
  }



 function update($data)
 {
   $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, user_level = ?  WHERE id = ?";
   $values = array($data['first_name'],$data['last_name'],$data['email'],$data['user_level'],$data['id']);
   return $this->db->query($query, $values);
 }


    function get_all_users()
    {
    return $this->db->query("SELECT * FROM users")->result_array();

    }

    function plan_trip($data)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('destination', 'destination','required');
        $this->form_validation->set_rules('description', 'description','required');
        $this->form_validation->set_rules('start_date', 'Travel start date', 'required');
        $this->form_validation->set_rules('end_date', 'Travel end date', 'required');
        if($this->form_validation->run())
        {
            $query = "INSERT INTO trips (destination, description, start_date, end_date) VALUES (?,?,?,?)";
            $values = array($data['destination'], $data['description'], $data['start_date'], $data['end_date']);
            $add_trip = $this->db->query($query, $values);

            $query2 = "INSERT INTO users_has_trips (user_id, trip_id) VALUES (?,?)";
            $trip_id = $this->db->insert_id();
            $values2 = array($this->session->userdata('id'), $trip_id);
            $this->db->query($query2, $values2);
            //if query runs correctly
            if($this->db->query($query, $values))
            {
                redirect('profile');
            }
            else
            {
                echo 'broken';
            }
        }
        else
        {
            return array(validation_errors());
        }

    }
    function other_users_trips($id)
    {
        $query = "SELECT CONCAT(first_name, ' ', last_name) AS creator, destination, date_format(start_date, '%b %D, %Y') AS start_date, date_format(end_date, '%b %D, %Y') AS end_date, trip_id
        FROM users_has_trips
        JOIN users ON users.id = users_has_trips.user_id
        JOIN trips ON trips.id = users_has_trips.trip_id
        WHERE users.id != ? AND users_has_trips.trip_id NOT IN (SELECT trip_id FROM users_has_trips WHERE user_id = ?) GROUP BY trip_id";
        return $this->db->query($query, array($id, $id))->result_array();
    }

    function trip_info($id)
    {
        $query2 = "SELECT trips.*, users.*, date_format(start_date, '%b %D, %Y') AS start_date, date_format(end_date, '%b %D, %Y') AS end_date
        FROM trips JOIN users_has_trips ON trips.id = users_has_trips.trip_id
        JOIN users ON users.id = users_has_trips.user_id WHERE trips.id = ?";
        return $this->db->query($query2, $id)->result_array();
    }

    function get_trips($id)
    {
        $query = "SELECT trips.*, date_format(start_date, '%b %D, %Y') AS start_date, date_format(end_date, '%b %D, %Y') AS end_date FROM trips JOIN users_has_trips ON trips.id = users_has_trips.trip_id WHERE user_id = ?";
        return $this->db->query($query, $id)->result_array();
    }

    function get_trip_by_id($id)
    {
        $query = "SELECT * FROM trips WHERE id = ?";
        return $this->db->query($query, array($id))->row_array();
    }

    function join_trip($trip_id, $session_id)
    {
        $query = "INSERT INTO users_has_trips (trip_id, user_id) VALUES (?,?)";
        $values = array($trip_id, $this->session->userdata('id'));
        if($this->db->query($query, $values))
        {
            $trip_query = "SELECT destination FROM trips WHERE id = ?";
            $value = $trip_id;
            return $this->db->query($trip_query, $value)->row_array();
        }
        else
        {
            echo "something went wrong!";
        }
    }
    function cancel_trip($trip_id, $session_id){
      $query = "DELETE FROM users_has_trips WHERE trip_id = ? AND user_id = ?";
      $values = array($trip_id, $session_id);
      $this->db->query($query, $values);
      // var_dump('in the model', $trip_id, $session_id); die();
    }


}

?>
