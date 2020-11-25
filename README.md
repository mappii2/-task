
# タスク管理ツール

会社向けに作ったツールで、管理者が当日の仕事内容や従業員の日報を簡易的に管理できるようなツールです
ユーザが管理者と従業員に分けられ、それぞれできることが異なります。

# デモ

![デモ](https://github.com/mappii2/-task/blob/images/ss1.png)
![デモ](https://github.com/mappii2/-task/blob/images/ss2.png)
![デモ](https://github.com/mappii2/-task/blob/images/ss3.png)

## 使い方

* 従業員ユーザはログインすると1日の業務内容の確認や日報を送信できる。

  テストアカウント　メールアドレス：<emp@gmail.com>　パスワード：emppass
* 管理者ユーザは従業員登録や仕事振り分け、日報の管理ができる。

  テストアカウント　メールアドレス：<admin@gmail.com>　パスワード：adminpass

## 環境

- Atom
- PHP 7.3.11
- phpMyAdmin

## データベース

私のデータベースは「phpmMyadmin.txt」をインポートして使ってください。
ユーザアカウントを
- ユーザ名 root
- ホスト名 localhost
- パスワード root
で作ってください。

## 文責

* 作成者　masukawa
* E-mail mail@mail.com

## 参考文献

[ログイン機能](https://qiita.com/ryo-futebol/items/5fb635199acc2fcbd3ff "PHPログイン機能 - Qiita")
[instagram API](https://www.e-pokke.com/blog/instagram-basic-display-api.html "Instagram Graph API v6.0 を使ってインスタの投稿を埋め込む方法")
