<?php
class Bonjour_Model_UserGateway extends Bonjour_Core_Model_GateWay {
	
	/**
	 * add user
	 * 
	 * @param unknown $user        	
	 * @return number
	 */
	public function addUser($user) {
		$affected_rows = $this->db->insert ( 'users', $user );
		return $affected_rows > 0 ? $this->db->lastInsertId ( 'users' ) : 0;
	}
	/**
	 * find exist user
	 * 
	 * @param unknown $username        	
	 * @return boolean
	 */
	public function queryExistUsername($username) {
		$rs = $this->db->query ( "select count(*) cnt from users where username=?", $username )->fetch ();
		return $rs ['cnt'] == 0 ? false : true;
	}
	/**
	 * login find user
	 * 
	 * @param unknown $username        	
	 * @param unknown $userpass
	 */
	public function queryUser($username, $userpass) {
		$query = "select userid,username from users where username=? and userpass=?";
		$rs = $this->db->query ( $query, array (
				$username,
				$userpass 
		) )->fetch ();
		return $rs;
	}
}

?>