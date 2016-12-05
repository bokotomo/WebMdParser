# WebMdParser
URLに.mdファイルを指定しても整形された状態で見れます。

# sampleimage
<img src="https://tomo.syo.tokyo/openimg/webmdparserimg2.png" width="340px">

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