<?php 

namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model
{


    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username','password','delete'];
 
    public function getUser($user,$password){
        $db = \Config\Database::connect();
		$sql = 'SELECT user.username,user.password,user.id
		FROM user 
		WHERE username = "'.$user.'" AND password = "'.$password.'"';

        $query = $db->query($sql);
     
        $results = $query->getRowArray();
       
        return $results;


    }
    public function uservalidate($user,$password)
    {   
       
        $users = $this->where('username',$user)->where('password',$password)->findAll();
      
        return $users;
    }

}