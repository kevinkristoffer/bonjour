<?php
/**
 * 保单查询
 * @author hujianhong05
 *
 */
class Bonjour_Model_PolicyGateway extends Bonjour_Core_Model_GateWay {
	
	/**
	 * 查询保费
	 * @param STRING $comcode
	 * @param INTEGER $startdate1
	 * @param INTEGER $startdate2
	 */
	public function queryPolicy($startdate1,$startdate2,$comcode){
		
		$sql="select policyno,startdate,sumpremium from main".
			" where startdate between ? and ? and comcode=?".
			" and policyno<>'' and underwriteflag in (1,3)".
			" and riskcode='DAA' limit 5";
		
		return $this->db->fetchAll($sql,array($startdate1,$startdate2,$comcode));
		
	}
}

?>