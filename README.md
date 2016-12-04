# WebMdParser
URLに.mdファイルを指定しても整形された状態で見れます。

# sampleimage
<img src="https://tomo.syo.tokyo/openimg/mdparserimg.png" width="300px">

# Getting started
mdparserフォルダ  
.htaccessファイル  
この二つを同じ階層におきます  
すでに.htaccessファイルがある場合はこのコードの足りない部分を付け足します。  
<pre><code><IfModule mod_rewrite.c>  
RewriteEngine On  
RewriteRule ^(.+\.md)$ mdparser/main.php?file_name=$1 [L]  
</IfModule></code></pre> 