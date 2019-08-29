# 歡迎來到 OA Wu's Blog
這是一套採用 OA 製作的前端框架 [Ginkgo](https://github.com/comdan66/Ginkgo) 所實作的部落格！

---
## 說明
主要是將 markdown 內的文章轉換成 html 格式，輸出的目錄在 `dist`

## 使用
### 開發
* 版型 - 終端機進入專案目錄下的 `cmd 目錄`，在 cmd 目錄下執行指令 `node watch` 即可！
* 編譯 - 終端機進入專案目錄下的 `cmd 目錄`，在 cmd 目錄下執行指令 `php libs/plugin/Cover.php -u http://127.0.0.1/blog/dist/` 即可！

### 部署
終端機進入專案目錄下的 `cmd 目錄`，在 cmd 目錄下執行指令 `node deploy`，再依據步驟完成輸入即可！  
目前僅開放 `S3` 功能。
