# live-server
similar live server是一个类似于live-server的扩展。

live-server是一个具有实时加载功能的小型服务器，可以使用它来破解html/css/javascript，但是不能用于部署最终站点。也就是说我们可以在项目中实时用live-server作为一个实时服务器实时查看开发的网页或项目效果。

使用方法
------------	
	1.clone本项目之后，进入项目执行composer install命令


	2.运行websocket服务端
	php SocketService.php start -d
	
	3.使用浏览器访问地址127.0.0.1:5550即可。
	最后我们修改项目中任意文件内容保存，即可同步看到我们的浏览器刷新了。
