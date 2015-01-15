# MPM

マネープラグインの違いを気にせず使えるようにするライブラリ?です。<br/>

#API

まず以下のコードで読み込んでください<br/>
```php
use MPM\MPM;
```
最初に以下のコードも必ず実行してください<br/>
```php
MPM::getInstance->init();
MPM::getInstance->moneyPluginCheck();
```

moneyPluginCheck()はbool値が返ってきます。<br/>
falseの場合は対応しているプラグインがありません。<br/>
falseが返ってきた場合はシャットダウンなどをおこなってください。<br/>

関数を呼び出したいときは<br/>
```php
MPM::getInstance->(関数名)(param1,param2, ...);
```
##関数、変数
※引数にプレーヤーを使用する場合はプレーヤー名を指定してください<br/>

MPMのAPIのバージョン<br/>
APIのバージョンが返ってきます(int)<br/>
```php
API;
```
MPMが使用するプラグイン<br/>
使用するプラグインのPluginオブジェクトが返ってきます。(obj)<br/>
```php
MoneyPlugin;
```
マネープラグインがあるかをチェックします。<br/>
これを実行しないとほとんどの関数が使えません(boolean)<br/>
```php
moneyPluginCheck()
```
マネープラグインの指定したマネーを通貨記号に変更します。<br/>
引数1:$money には数値または文字列を使用してください<br/>
通貨記号を加えた文字列が返ってきます。(string)<br/>
```php
moneychange($money);
```
アカウントがあるかをチェックします。<br/>
ブール値(boolean)で返ってきます。<br/>
```php
accountExists($player);
```
プレーヤーにマネーを付与します。<br/>
引数1:$playerはマネーを与えたいプレーヤーを指定します<br/>
引数2:$amountはプレーヤーに渡すマネーを指定します。<br/>
```php
addMoney($player,$amount);
```
プレーヤーの持っているマネーを返します。<br/>
引数1:$playerは取得したいプレーヤーを指定します。<br/>
```php
getMoney($player);
```
プレーヤーのマネーを設定します。<br/>
引数1:$playerはマネーを設定するプレーヤーを指定します。<br/>
引数2:$amountはプレーヤーに渡すマネーを指定します。<br/>
```php
setMoney($player,$amount);
```
プレーヤーからプレーヤーにマネーを与えます。<br/>
引数1:$senderはプレーヤーにマネーを与えるプレーヤーを指定します。<br/>
引数2:$playerはプレーヤーからマネーを貰う人を指定します。<br/>
引数3:$amountはプレーヤーに渡すマネーを指定します。<br/>
```php
payMoneyToPlayer($sender,$player,$amount);
```
プレーヤーからマネーを剥奪します。<br/>
引数1:$senderはマネーを剥奪するプレーヤーを指定します。<br/>
引数2:$amountはプレーヤーから剥奪するマネーの金額を指定します。<br/>
```php
reduceMoney($player,$amount);
```

##サンプルコード
```php
use MPM\MPM;

public function onEnable() {
	$this->getLogger()->info("マネープラグインをチェックしています...");
	if(MPM::getInstance->moneyPluginCheck()){
		$this->getLogger()->info(MPM::getInstance->MoneyPlugin->getName() . "を検出しました。");
	}else{
		$this->getLogger()->info(TextFormat::RED."対応しているマネープラグインが見つかりませんでした!");
		$this->getLogger()->info(TextFormat::RED."サーバーを停止します...");
		$this->getServer()->shutdown();
	}
}
```
<<<<<<< HEAD
#ライセンス
このライブラリは、MITライセンスのもとで公開されています。
ライセンスの詳細についてはLICENSEファイルまたは以下のサイトで確認できます。
The MIT License
http://opensource.org/licenses/mit-license.php
また以下のサイトに参考日本語訳もあります。
あくまでも参考なので必ず原文もご確認ください。
http://sourceforge.jp/projects/opensource/wiki/licenses%2FMIT_license
