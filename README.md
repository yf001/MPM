# MoneyPluginManagement

マネープラグインの違いを気にせず使えるようにするライブラリ?です。<br/>

#API

まず以下のコードで読み込んでください<br/>
```php
use MPM\MPM;
```
最初に以下のコードも実行してください<br/>
```php
MPM::getInstance->init();
MPM::getInstance->moneyPluginCheck();
```

moneyPluginCheck()はbooledが返ってきます。<br/>
falseの場合は対応しているプラグインがありません。<br/>
falseが返ってきた場合はシャットダウンなどをおこなってください。<br/>

関数を呼び出したいときは<br/>
```php
MPM::getInstance->(関数名);
```

##サンプルコード
```php
use MPM\MPM;

$this->getLogger()->info("マネープラグインをチェックしています...");
if(MPM::getInstance->moneyPluginCheck()){
	$this->getLogger()->info(MPM::getInstance->MoneyPlugin->getName() . "を検出しました。");
}else{
	$this->getLogger()->info(TextFormat::RED."対応しているマネープラグインが見つかりませんでした!");
	$this->getLogger()->info(TextFormat::RED."サーバーを停止します...");
	$this->getServer()->shutdown();
}
```