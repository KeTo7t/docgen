# docgen
Excelの呪縛から逃れられない人向けDB定義書生成ツール

## Requirement

laravel: >= 6.0  
phpoffice/phpspreadsheet: "^1.9"


## setup
1) 以下の記述をcomposer.json に追記
```
 "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/KeTo7t/docgen"
        }
    ],

 ```
 
2) 以下コマンドでインストール
```
composer require KeTo7t/docgen
```
3) artisanコマンドの一覧にコマンドが追加されているか確認  
php artisan | grep DB　でコマンドが確認できればOK

## Usage
artisanコマンドとして下記実行
```
php artisan generate:DBdocment --name={filename} --type={typename} 
```
オプション:
filename → 出力するファイル名（拡張子抜き）
typename →　以下の出力形式
　　　　　　　　　excel→エクセルでのDB定義書
　　　　　　　　　md →markdownの表形式での定義書
　　


