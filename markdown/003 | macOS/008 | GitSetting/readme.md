沒什麼，只是我個人的 Git 設定，像是短指令，以及設定編輯器.. 等。

# OA 個人常用的 Git 設定

## Youtube 影音教學版
* [https://www.youtube.com/watch?v=QYgOGgcydSU](https://www.youtube.com/watch?v=QYgOGgcydSU)

## 設定步驟
* 用 Sublime Text 打開編輯 `~/.gitconfig`，終端機執行指令 `subl ~/.gitconfig`
* 將內容修改成如下，主要針對 `user` 與 `alias` 做修改

```
[user]
  name = OA Wu
  email = comdan66@gmail.com

[alias]
  st = status
  co = checkout
  rb = rebase
  cp = cherry-pick
  ci = commit
  ss = stash
  cn = clean
  pu = push origin
  ps = push origin
  sl = shortlog -s -n
```

## 修改 git 編輯器改用 Sublime Text
* 終端機執行指令 `git config --global core.editor "subl -n -w"`

`#Git` `#管控工具`