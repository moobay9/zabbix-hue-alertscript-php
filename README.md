zabbix 用 Hue controll スクリプト
===============================

* コレは何？

  * ZABBIX から PHP で Philips Hue のランプを光らせるだけのスクリプトです。


* 使い方


```
  cd  /path/to/zabbix/alertscripts
  git clone https://github.com/moobay9/zabbix-hue-alertscript-php.git
  mv zabbix-hue-alertscript-php/config.ini.sample zabbix-hue-alertscript-php/config.ini
  chmod +x zabbix-slack-alertscript-php/slack.php
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php -r "if (hash_file('sha384', 'composer-setup.php') ===   '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo   'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  php composer.phar install
```

  1. git からクローンする
    * 上記コマンドを参照

  2. zabbix-hue-alertscript-php 内の config.ini を変更
    * url に hue の URL を記載してください。ルータとかの設定は割愛
      * ex) http://hogehoge.com/
    * path に API のパスを書いておいてください。

  3. メディアタイプの追加
    * [管理] -> [メディアタイプ] から[メディアタイプの作成]

      * 名前 : 任意
      * タイプ : スクリプト
      * スクリプト名 : zabbix-hue-alertscript-php/hue.php

  4. ユーザーへのメディア追加
    * [管理] -> [ユーザー] からタブをユーザーグループからユーザーへ変更
    * 変更したいユーザーを選択
    * メディアのタブから[追加]
      * タイプ : 上記のメディアタイプで入力した名前
      * 送信先 : 適当な英数字のランダム文字列
      * ステータス : 有効
      * 他は変更なし
    * [保存] -> [保存]

  5. アクションへ追加
    * 適当にメール送信と同じ雰囲気で作ってください。
