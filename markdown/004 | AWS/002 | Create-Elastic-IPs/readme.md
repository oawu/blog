# AWS Elastic IPs

每次重開 EC2 都會變換 Public IP，然後都要重新設定 DNS(Domain Name Server)，還要等他生肖，實在有點兒麻煩，所以我們可以設定 `Elastic IPs`，藉由聲請一個 Elastic IPs，然後關聯指定的 EC2 Instance，如此一來只要控制指向，IP 就不會一直亂變囉。

## 新增
* 點選左邊的 `Elastic IPs`
* 點選藍色按鈕 `Allocate new address`
* 點選藍色按鈕 `Allocate`

## 關聯
* 點選左邊的 `Elastic IPs`
* 點選你新增的 IP，對著他按右鍵選擇 `Associate address`，或者勾選該 IP 選擇上方 `Actions` 按鈕，然後選擇 `Associate address`
* 然後 `Instance` 選擇你新增的那台 EC2
* 然後 `Private IP` 選擇下拉，會看到該台 EC2 的 private ip
* 然後點選右下角藍色按鈕 `Associate` 即可
* 經過以上步驟，你這台 EC2 的 IP 就可採用此組 `Elastic IPs` 的 `ip`，dns 也可指向他！

`#AWS` `#EC2` `#Elastic IPs`