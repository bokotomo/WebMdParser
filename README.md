# WebMdParser
URLに.mdファイルを指定しても整形された状態で見れます。  
通常.txtファイルとして表示されてしまい誰かに.mdファイル形式で共有できません。  
WebMdParserをディレクトリに入れれば、サーバにmdファイルを貼って誰かに内容共有ができます。  

# sampleimage
<img src="https://tomo.syo.tokyo/openimg/webmdparserimg2.png" width="340px">

# DEMO
https://tomo.syo.tokyo/memo/text.md

# Getting started
mdparserフォルダ  
.htaccessファイル  
この二つを同じ階層におくだけで、対応します。  
すでに.htaccessファイルがある場合はこのコードの足りない部分を付け足します。  
<pre><code>&lt;IfModule mod_rewrite.c&gt;  
RewriteEngine On  
RewriteRule ^(.+\.md)$ webmdparser/run.php?file_name=$1 [L]  
&lt;/IfModule&gt;</code></pre> 

# .htaccessの説明
.mdの拡張子をつくアクセスを全てwebmdparser/run.phpに飛ばしています。

# Using
PHP
.htaccess