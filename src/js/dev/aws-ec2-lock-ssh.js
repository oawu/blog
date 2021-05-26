/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2020-10-28')

let blocks = [
  Header(
    H1('EC2 被鎖住不能使用 SSH 登入 怎麼辦？'),
    Span('不小心弄錯設定，造成 root 權限的 ubuntu 無法 SSH 登入了，怎辦？有辦法搶救嗎？'),
  ),

  H2('緣起'),
  P(Span('為了限制 AWS EC2 上某個 user 僅能使用 '), B('SFTP'), Span(' 在自己的'), B('家目錄'), Span('內運作，於是我更改 Server 的 '), Code('sshd_config'), Span('，加入了對該 '), B('user'), Span(' 的 '), Code('ChrootDirectory'), Span('、'), Code('ForceCommand'), Span(' 與 '), Code('AllowTcpForwarding'), Span(' 設定。')),
  P(Span('但手殘卻不小心把 '), Code('Match User'), Span(' 註解了…')),
  P(Span('如此一來會造成所有 User 皆只能使用 SFTP 連上 Server，並且根目錄僅能在自己的'), B('家目錄'), Span('內，而且'), B('不能往上層移動'), Span(' 😢')),

  H2('處理過程'),
  P('以下是我試圖搶救的過程，不是一個最佳的方式，如要了解最適合的方法可以直接看下方結論～'),
  P(Span('首先 root 權限的 ubuntu 因為 '), Code('sshd_config'), Span(' 的設定值關係所以無法 SSH 上 server'), Span('每當使用 SSH 連線時，就會有錯誤訊息：'), Code('This service allows sftp connections only.')),
  P('所以 SSH 這條路算是封死了…'),
  P(Span('那試著 '), Code('SFTP'), Span(' 上去看能不能修改與更新 '), Code('sshd_config'), Span('，然後'), B('重啟'), Span('讓系統自動 '), Code('ssh reload'), Span('但是由於'), B('不能往上層移動'), Span('的限制，自然的也就無法變更到 '), Code('sshd_config'), Span(' 😫')),
  P(Span('萬念俱灰之下還嘗試了將 Server build 出 '), Code('image'), Span('，想藉由 image launch 新的 EC2 instance，結果當然失敗，因為既然是 image…，所以設定值一模一樣，SSH 上這台新的 instance 也是一樣的錯誤訊息 '), Code('This service allows sftp connections only.'), Span('，所以 image 方式也是失敗…')),

  H2('備份資料'),
  P(Span('既然無法進去 Server，那換個角度，至少要想辦法備份資料吧？'), Span('雖然程式碼都有上 git，但是很多 config 都是被 gitignore 的，如果遺失勢必麻煩…')),
  P('此時我想起 AWS EC2 的服務是拆成'),
  Ol(Li('運算'), Li('儲存')),
  P('所以收費時有三個收費項目'),
  Ol(Li('運算'), Li('儲存'), Li('流量')),
  P(Span('那代表儲存是獨立切開的，而且資料是儲存在 EC2 的硬碟上的，也就是 '), B('Volume'), Span('，那就把腦筋動到 Volume 上吧！')),
  Figure('https://www.ioa.tw/img/956a3006c41b6528e0213c160ef53fd7.jpg'),

  H2('複製 Volume'),
  P(Span('以我這台主要的 EC2 '), Code('i-xxx'), Span(' 的機器來說，所搭配的硬碟是 '), Code('vol-xxx'), Span('，如下圖 '), B('1'), Span(' 代表的就是發生問題的 EC2 instance，而標示 '), B('3'), Span(' 則是這台 EC2 所掛載的 Volume '), Code('vol-xxx'), Span('。')),
  Figure('https://www.ioa.tw/img/84e4057829dd65edc3f322a6c8f48b52.jpg'),

  P(Span('點擊標示 3 的 '), Code('vol-xxx'), Span(' ID 後會跳至 Volumes 頁面，檢視其細節，如下圖可以得知當初我並未對硬碟座加密，所以看來是有機會的可以讀出內容！')),
  Figure('https://www.ioa.tw/img/b76e7b18a5b5264e532654a427796284.jpg'),
  P(Span('方法就是將此 '),Code('vol-xxx'),Span(' 的 volume clone 一份出來，並且開啟另一台 EC2 instance '),Code('i-ooo'),Span(' 然後掛載上去！'),Span('首先對這個 '),Code('vol-xxx'),Span(' 右鍵選擇 '),Code('Create Snapshot'),Span('，建立一份此 Volume 的 '),B('快照'),Span('。')),
  Figure('https://www.ioa.tw/img/5a0efe88aacd66ff2ca651ead106e2cb.jpg'),

  P('然後點擊去 Snapshots 頁面上看所產生的 Volume Snapshot。'),
  Figure('https://www.ioa.tw/img/8822751f9f380176300a16bc129ff56a.jpg'),

  P(Span('如下圖就是 '), Code('vol-xxx'), Span(' 所產生的快照 '), Code('snap-xxx'), Span('。')),
  Figure('https://www.ioa.tw/img/9a559abd274fddbc029a80cbf8313cb1.jpg'),
  P(Span('然後對著 '), Code('snap-xxx'), Span(' 右鍵選擇 '), Code('Create Volume'), Span('，建立一份與原本一樣的 Volume。')),
  Figure('https://www.ioa.tw/img/87fb064f0c419fa5ccc6a031199e0556.jpg'),
  P(Span('回到 Volumes 頁面，可以看到多出一顆新的 Volume，如下圖的綠框 '), Code('vol-ooo'), Span('。')),
  Figure('https://www.ioa.tw/img/8974810b521f17964c83b34c27fef917.jpg'),
  P('以上流程就是 Volume1 ➜ Snapshot ➜ Volume2，所以 Volume1 內容 == Volume2 內容'),

  H2('掛載 Volume 至新的 EC2'),
  P(Span('接著開一台新的 EC2 instance '), Code('i-ooo'), Span('，方法可以參考'), A('此篇').href('https://www.ioa.tw/AWS/EC2-Ubuntu.html'), Span('。'), Span('首先如下圖，開好後在 Instances 頁面看到多出一台全新的 EC2 實例，紅框為原本的 EC2 instance '), Code('i-xxx'), Span('，綠框為新的 EC2 instance '), Code('i-ooo'), Span('。')),
  Figure('https://www.ioa.tw/img/63bb34e4f2abfbe80cb08b8a76de7748.jpg'),

  P('當然新的 EC2 一開始會有一顆預載的 8G 硬碟，所以回到 Volumes 頁面看，也會看到多出來的那顆硬碟。'),
  P(Span('如下圖紅色為原本舊 EC2 instance '), Code('i-xxx'), Span(' 的 volume '), Code('vol-xxx'), Span('，綠色是 clone 出來的 volume '), Code('vol-ooo'), Span('，藍色就是新開啟的 EC2 instance '), Code('i-ooo'), Span(' 所使用的預設的 volume '), Code('vol-aaa'), Span('。')),
  Figure('https://www.ioa.tw/img/bd66351452d383269680ed62f9284024.jpg'),

  P(Span('接著掛載 '), Code('vol-ooo'), Span(' 到剛剛開啟的 '), Code('i-ooo'), Span(' instance 上，直接點選 '), Code('vol-ooo'), Span(' 右鍵選擇 '), Code('Attach Volume'), Span('。')),
  Figure('https://www.ioa.tw/img/178347c9c8e54834407d60fb5c1531ab.jpg'),
  P(Span('將 '), Code('vol-ooo'), Span(' 掛載到 '), Code('i-ooo'), Span(' instance 上，並且要注意一下 Device 此硬碟的編號（綠框）'), Code('sdf'), Span('，掛載好之後回到 Instances 頁面上，將 '), Code('i-ooo'), Span(' 的 EC2 instance 做 '), B('Reboot'), Span('。')),
  Figure('https://www.ioa.tw/img/de61146933c6d24413418c0dbd45063b.jpg'),

  H2('讀取掛載的 Volume'),
  P(Span('馬上使用 SSH 到 '), Code('i-ooo'), Span(' 的 EC2 instance 上，並且切換身份至 root，所以輸入指令 '), Code('sudo -s'), Span('。')),
  Figure('https://www.ioa.tw/img/1a395e5e475863e5e2df8311185fbfe2.jpg'),
  Figure('https://www.ioa.tw/img/97ee128e811a606210f6de6e74589ded.jpg'),
  
  P(Span('切換好身份後，輸入指令 '), Code('lsblk'), Span(' 列出此機器上有多少顆硬碟。'), Span('紅框代表預載的 8G volume '), Code('vol-aaa'), Span('，而綠框則舊是那刻 20G 的 '), Code('vol-ooo'), Span(' volume。')),
  P(Code('xvda'), Span(' 代表磁碟 '), Code('xvda1'), Span(' 則是第一個磁區，而 '), Code('xvdf'), Span(' 則就是 '), Code('vol-ooo'), Span(' 那顆磁碟，而 '), Code('xvdf1'), Span(' 就是他裡面的第一個磁區。')),
  P(Code('xvdf'), Span(' 與在掛載時 Device 所標示的 '), Code('sdf'), Span(' 尾數應該會是一樣的 '), Code('f'), Span('，所以掛載多顆硬碟時要注意一下才不會認錯顆。')),
  Figure('https://www.ioa.tw/img/40aad4083aed42b1c1dd2fbc5a8ba997.jpg'),

  P(Span('接著依然採用 root 身份，在 '), Code('/'), Span(' '), B('根目錄'), Span('下建立一個 '), Code('test'), Span(' 目錄！')),
  Figure('https://www.ioa.tw/img/29477d6dda0da80a60f82440da6efb27.jpg'),

  P(Span('建立好 '), Code('/test'), Span(' 目錄後，就要設定將 '), Code('xvdf1'), Span(' 磁區連結到 '), Code('/test'), Span(' 目錄，所以使用指令 '), Code('mount /dev/xvdf1 /test'), Span('。')),
  P(Span('接著再用指令 '), Code('lsblk'), Span(' 列出此機器上有多少顆硬碟。'), Span('如下圖可以看到 '), Code('xvda1'), Span(' 磁區 mount 到 '), Code('/'), Span(' 根目錄，而 '), Code('xvdaf'), Span(' 磁區 mount 到 '), Code('/test'), Span(' 目錄，那就代表完成了！')),
  Figure('https://www.ioa.tw/img/867377451487ea7c8898355902e7f93c.jpg'),

  P(Span('太好了！直接進入 '), Code('/test'), Span(' 目錄吧！'), Span('然後列出 '), Code('/test'), Span(' 目錄內的內容，完全的可以讀出資料就代表完成了！！！！😂')),
  Figure('https://www.ioa.tw/img/ebff779e93b2015131c9ad451d3be3f0.jpg'),

  H2('結論'),
  P('上述的過程是我自己的處理經驗流程，但是事後經由我自己的不斷再次嘗試，其實有更好的處理方式，方法總結如下：'),
  Ol(
    Li(Span('關閉舊的 EC2 instance '), Code('i-xxx')),
    Li(Span('將舊的 Volume '), Code('vol-xxx'), Span(' '), B('Detach'), Span('(卸下)')),
    Li(Span('Launch 一台新的 EC2 instance '), Code('i-ooo')),
    Li(Span('將卸下的 Volume '), Code('vol-xxx'), Span(' '), B('Attach'), Span('(掛載)到新的 EC2 instance '), Code('i-ooo'), Span('，並 '), B('Reboot'), Span('(重啟) '), Code('i-ooo')),
    Li(Span('SSH 上新的 EC2 instance '), Code('i-ooo'), Span(' 上，直接使用 '), B('sudo'), Span(' 權限 '), B('mount'), Span(' '), Code('vol-xxx'), Span(' 的磁區到 '), Code('/test'), Span(' 目錄')),
    Li(Span('使用 '), B('sudo'), Span(' 權限修正 '), Code('/test/etc/ssh/sshd_config'), Span(' 儲存')),
    Li(B('Stop'), Span('(關閉) EC2 instance '), Code('i-ooo')),
    Li(Span('將 Volume '), Code('vol-xxx'), Span(' 從 EC2 instance '), Code('i-ooo'), Span(' 上 '), B('Detach'), Span('(卸下)')),
    Li(Span('將Volume '), Code('vol-xxx'), Span(' '), B('Attach'), Span('(掛載)到原本的 EC2 instance '), Code('i-xxx'), Span('，並 '), B('Reboot'), Span('(重啟) '), Code('i-ooo')),
    Li(Span('就可以成功的 SSH 上原本的 EC2 instance '), Code('i-xxx'))
  ),
  P('以上是濃縮再濃縮、提鍊再提煉的處理步驟了，雖然前面走了很多冤旺路，但是也獲得了很多寶貴的技術知識 😳'),
  
  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('使 Amazon EBS 磁碟區可供在 Linux 上使用 - Amazon Elastic Compute Cloud').href('https://docs.aws.amazon.com/zh_tw/AWSEC2/latest/UserGuide/ebs-using-volumes.html')),
      Li(A('Locked myself out of Amazon EC2 SSH - This service allows sftp connections only').href('https://unix.stackexchange.com/questions/143925/locked-myself-out-of-amazon-ec2-ssh-this-service-allows-sftp-connections-only')),
      Li(A('This service allows sftp connections only - pu20065226 - 博客园').href('https://www.cnblogs.com/pu20065226/p/10962906.html')),
      Li(A('網友 黃聖雄 推薦不用 SSH 的作法').href('https://l.facebook.com/l.php?u=https%3A%2F%2Fbinx.io%2Fblog%2F2019%2F02%2F02%2Fhow-to-login-to-ec2-instances-without-ssh%2F%3Ffbclid%3DIwAR0V1i_fdY7UIbtxkTYqwMsmGX4vBWW_0YZCwHGStqcFd-3NVW_csgh39pU&h=AT0YkmI86R-rxuX_qr0-_nRYOu-8hmQaPTWoOyU0gBFTqnR8gm5RXAQqPoFPA-V2Wyn2UA6soye8e8EaUUlstR01n_WV3KVql6Vvi1WpZia3jgVqZxvr8Y5wkiC1FwnPYeGek_KZpnM')),
    )
  )
]

Load.init({
  data: { key: 'dev', blocks },
  template: El.render(`
    layout => :page=this
      block => *for=(paragraph, i) in blocks   :key=i   :bind=paragraph
  `)
})
