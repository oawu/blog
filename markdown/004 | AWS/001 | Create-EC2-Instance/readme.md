# AWS 開設 EC2 Instance
* 點擊左上角藍色 `Launch Instance`
* 選擇要安裝的系統，若要使用免費版要選擇下面有 `Free tier eligible` 的字樣，這邊我們選擇 `Ubuntu Server 18.04 LTS (HVM), SSD Volume Type`，點擊該後面的藍色按鈕 `Select`
* 第二頁 `Choose an Instance Type`，主要是確認版本，免費版就確定有綠色的 `Free tier eligible` 即可，然後按下 `Next: Configure Instance Details`。(注：不是藍色按鈕)
* 第三頁 `Configure Instance Details`，確認內容細節，這邊基本上不用動，然後按下 `Next: Add Storage`。(注：不是藍色按鈕)
* 第四頁 `Add Storage`，主要是給你看你的 EC2 的容量，這邊基本上不用動，然後按下 `Next: Add Tag`。(注：不是藍色按鈕)
* 第五頁 `Add Tags`，主要是讓你新增「標籤」，但也是通常不太會用到，所以一樣按下 `Next: Configure Security Group`。(注：不是藍色按鈕)
* 第六頁 `Configure Security Group`，這頁是讓你設定「安全群組」，你可以設定你的 EC2 要採用哪個安全設定，基本上第一次應該沒有任何的 `Group`，所以你可以在 `Assign a security group` 選擇 `Create a new security group`，然後下方去設定這次要新增的 「Group」細節
	* 預設的 `SSH` 是一定要的，要不然你到時候沒辦法 SSH 連上線喔！
	* 再增加 `HTTP` 與 `HTTPS`，然後 `Source` 設定成 `0.0.0.0/0`，代表任何地方都可以用 HTTP 或 HTTPS 開。
	* 然後按下藍色的 `Review and Launch`
* 第七頁 `Review Instance Launch`，請你確認一下資訊，無誤後即可按下左下方的 `Launch`
* 跳出 `Select an existing key pair or create a new key pair`，這步驟很重要！下方選擇你這個 EC2 要採用哪個 key，第一次通常沒有，所以選擇 `Create a new key pair`，然後輸入 `Key pair name`，然後按下 `Download Key Pair`，下載後的 `.pem` 檔案很重要，到時候要藉由這個檔案做登入 EC2 的憑證！
* 下載完 `.pem` 後，按下藍色的 `Launch Instances` 即可。

`#AWS` `#EC2`