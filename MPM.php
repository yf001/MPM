<?php
/**
 * MPM Library
 * 
 * Copyright (c) 2015 yf001
 * 
 * This software is released under the MIT License.
 * 
 * http://opensource.org/licenses/mit-license.php
*/
use pocketmine\Server;

class MPM{
	
	private static $obj = null;
	public static $API = 1.0.0;
	public static $MoneyPlugin = null;
	
	public function __construct(){
		if(!self::$obj instanceof MPM){
			self::$obj = $this;
		}
	}

	public static function init(){
		if(!self::$obj instanceof MPM){
			self::$obj = new self;
		}
	}
	
	public static function getInstance(){
		if(!self::$obj instanceof MPM){
			self::$obj = new self;
		}
		return self::$obj;
	}
	
	public function moneyPluginCheck(){
		if(Server::getInstance()->getPluginManager()->getPlugin("PocketMoney") !== null){
			$this->PocketMoney = Server::getInstance()->getPluginManager()->getPlugin("PocketMoney");
			self::MoneyPlugin = $this->PocketMoney;
			return true;
		}elseif($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") !== null){
			$this->EconomyS = Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI");
			self::MoneyPlugin = $this->EconomyS;
		}elseif(Server::getInstance()->getPluginManager()->getPlugin("MassiveEconomy") !== null){
			$this->ME = Server::getInstance()->getPluginManager()->getPlugin("MassiveEconomy");
			self::MoneyPlugin = $this->ME;
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * @param int|string $money
	 *
	 * @return string
	 */
	public function moneychange($money){
		if(isset($this->PocketMoney)){
			return $money . "mp";
		}elseif(isset($this->EconomyS)) {
			return "$" . $money;
		}elseif(isset($this->ME)) {
			return $this->ME->getMoneySymbol() . $money;
		}
	}
	/**
	 * @param string $player
	 *
	 * @return boolean
	 */
	public function accountExists($player){
		if(isset($this->PocketMoney)){
			return true;
		}elseif(isset($this->EconomyS)) {
			return $this->EconomyS->accountExists($player);
		}elseif(isset($this->ME)) {
			return $this->ME->isPlayerRegistered($player);
		}
	}
	
	/**
	 * @param string $player
	 * @param int $amount
	 */
	public function addMoney($player,$amount){
		if(isset($this->PocketMoney)){
			$this->PocketMoney->grantMoney($player,$amount);
		}elseif(isset($this->EconomyS)) {
			$this->EconomyS->addMoney($player,$amount);
		}elseif(isset($this->ME)) {
			$this->ME->payPlayer($player,$amount);
		}
	}
	
	/**
	 * @param string $player
	 * 
	 * @return int
	 */
	public function getMoney($player){
		if(isset($this->PocketMoney)){
			return $this->PocketMoney->getMoney($player);
		}elseif(isset($this->EconomyS)) {
			return $this->EconomyS->myMoney($player);
		}elseif(isset($this->ME)) {
			return $this->ME->myMoney($player);
		}
	}
	
	/**
	 * @param string $player
	 * @param int $amount
	 */
	public function setMoney($player,$amount){
		if(isset($this->PocketMoney)){
			$this->PocketMoney->setMoney($player,$amount);
		}elseif(isset($this->EconomyS)) {
			$this->EconomyS->setMoney($player,$amount);
		}elseif(isset($this->ME)) {
			$this->ME->setMoney($player,$amount);
		}
	}
	
	/**
	 * @param string $sender
	 * @param int $player
	 * @param int $amount
	 */
	public function payMoneyToPlayer($sender,$player,$amount){
		if(isset($this->PocketMoney)){
			$this->PocketMoney->payMoney($sender,$player,$amount);
		}elseif(isset($this->EconomyS)) {
			$this->EconomyS->reduceMoney($sender,$amount);
			$this->EconomyS->addMoney($player, $amount);
		}elseif(isset($this->ME)) {
			$this->ME->payMoneyToPlayer($sender,$amount,$player);
		}
	}
	
	/**
	 * @param string $player
	 * @param int $amount
	 */
	public function reduceMoney($player,$amount){
		if(isset($this->PocketMoney)){
			$money = $this->PocketMoney->getMoney($player) - $amount;
			$this->PocketMoney->setMoney($player,$money);
		}elseif(isset($this->EconomyS)) {
			$this->EconomyS->takeDebt($player,$amount);
		}elseif(isset($this->ME)) {
			$this->ME->takeMoney($player,$amount,$player);
		}
	}
}