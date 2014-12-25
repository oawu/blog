### 說明
Mac OS X 安裝 MySQL！

<br/>
### 規格
* 作業系統 Mac OS x 10.9.5
* MySQL 5.6.21

<br/>
### 步驟
* 官網下載 .dmg 檔 [http://dev.mysql.com/downloads/file.php?id=454017](http://dev.mysql.com/downloads/file.php?id=454017)。  
	![download MySQL](./img/10.png)

* 一直下一步、下一步安裝。  
	![install MySQL](./img/11.png)

* 打開系統偏好設定，點選 MySQL。  
	![start Mysql](./img/12.png)  
	![start Mysql](./img/13.png)  
	![start Mysql](./img/14.png)

* 加 MySQL PATH 至 ZSH。
	* ```vim ~/.zshrc```  
		![add MySQL commend to ZSH](./img/15.png)

	* 確認是否成功 ```echo $PATH```。  
		![add MySQL commend to ZSH](./img/16.png)

	* 重新開啟 iTerm。

* 設定 root 密碼[^1]。

	* 進入 MySQL，指令: ```mysql -u root```。

	* 選擇資料庫，指令: ```use mysql;```。

	* 更新資料，指令: ```update user set password=PASSWORD("你的密碼") where User='root';```。

	* 刷新 MySQL 系統，指令: ```flush privileges;```。

	* 離開 MySQL，指令: ```quit```。

> 注意！設置密碼時，要記得加上**引號**，假設密碼為 1234，應該為: 
> ```update user set password=PASSWORD("1234") where User='root';```

[^1]: 參考: [http://stackoverflow.com/questions/6474775/setting-the-mysql-root-user-password-on-osx](http://stackoverflow.com/questions/6474775/setting-the-mysql-root-user-password-on-osx)
