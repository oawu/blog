Add article.
git add -A && git commit -m 'Add article.' && git push origin master


Push gh-pages
git branch -D gh-pages && git branch -v gh-pages && git checkout gh-pages && cd gulp && npm install .  && gulp minify && gulp gh-pages && cd .. && git add -A && git commit -m 'Minify js、html, fix gh-pages path bug.' && git push origin gh-pages --force